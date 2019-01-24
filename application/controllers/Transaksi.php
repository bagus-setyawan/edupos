<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	 
	public function __construct() {
		parent::__construct();
		$this->load->model('Transaksi_model');
		cek_login();
	}
	
	public function index()
	{
		redirect('');
	}
	
	public function depan() {
		$this->breadcrumbs->add('Beranda', '#', 'fa fa-dashboard');
		$this->breadcrumbs->add('Transaksi Depan', site_url('transaksi/depan'));
		$data['content_header'] = array(
			'title' => 'Transaksi Depan',
			'subtitle' => 'Tr',
			'breadcrumbs' => $this->breadcrumbs->render()
		);
		$data['content'] = $this->load->view('backend/transaksi/depan', 
		array(
			'listproduk' => $this->Transaksi_model->get_barang(),
			'listkategori' => $this->Transaksi_model->get_kategori()
			), true);
		$data['script'] = "
		$(document).ready(function(){
			load_cart();
		});";
		$this->load->view('backend/tpl/site',$data);
	}
	
}
