<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('format_tanggal')){
	function format_tanggal($date){
		$date = str_replace("/","-",$date);
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
}
if(!function_exists('format_tanggal_sql')){
	function format_tanggal_sql($date){
		$date = str_replace("-","/",$date);
		$exp = explode('/',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'/'.$exp[1].'/'.$exp[0];
		}
		return $date;
	}
}
if(!function_exists('format_rupiah')){
	function format_rupiah($angka){
	  $rupiah=number_format($angka,0,',','.');
	  return $rupiah;
	}
}
if(!function_exists('slugify')){
	function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
		return 'n-a';
	  }

	  return $text;
	}
}
if(!function_exists('generatekode')){
	function generatekode($length = 12) {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return strtolower($randomString);
	}
}
if(!function_exists('form_return')){
	function form_return($arr, $key){
		if(is_array($arr) && !empty($arr)){
			if(array_key_exists($key,$arr)){
				return $arr[$key];
			}else{
				return "";
			}
		}else{
			return "";
		}
	}
}
if(!function_exists('ses_data')){
	function ses_data($key, $flash=FALSE){
		$CI =& get_instance();
		if($flash){
			return empty($CI->session->flashdata($key)) ? "":$CI->session->flashdata($key);
		}else{
			return empty($CI->session->userdata($key)) ? "":$CI->session->userdata($key);
		}
	}
}
if(!function_exists('cek_login')){
	function cek_login(){
		$CI =& get_instance();
		if(empty($CI->session->userdata('ses_id'))){
			redirect('login');
		}
	}
}
if(!function_exists('add_log')){
	function add_log($data){
		$CI =& get_instance();
		$log = array(
			'id_users' => ses_data('ses_id'),
			'class' => ($data['class'] != "") ? $data['class']:"fa fa-info bg-aqua",
			'judul' => ($data['judul'] != "") ? $data['judul']:"Tidak diketahui",
			'isi' => ($data['isi'] != "") ? $data['isi']:""
		);
		return $CI->Dblib_model->simple_insert("log", $log);
	}
}
?>