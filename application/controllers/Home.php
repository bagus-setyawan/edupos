<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct() {
		parent::__construct();
		
		$this->load->model('Home_model');
		// $this->output->enable_profiler(TRUE);
	}
	
	public function index()
	{
		cek_login();
		$data['content'] = $this->load->view('backend/dashboard', 
		array(
			'notice' => $this->Dblib_model->getsetting(array('key'=>'pengumuman')),
			'listcount' => $this->Home_model->get_listcount(),
			'logs' => $this->Home_model->get_timeline()
			), true);
		$this->load->view('backend/tpl/site',$data);
	}
	
	public function daftar()
	{
		if(!empty($this->session->userdata('ses_id'))){
			redirect();
		}
		$this->load->view('auth/daftar');
	}
	
	public function login()
	{
		if(!empty($this->session->userdata('ses_id'))){
			redirect();
		}else{
			$this->load->view('auth/login');
		}
	}
	
}
