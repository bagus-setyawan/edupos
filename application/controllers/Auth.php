<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
		$this->load->model('Users_model');
	}
	
	public function index()
	{
		redirect('login');
	}
	
	public function login()
	{
		$this->form_validation->set_rules('username', 'Nama User', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata(array(
				'stat' => 'danger',
				'msg' => validation_errors(),
				'return' => $_REQUEST
			));
			redirect('login');
		}else{
			$username = $this->input->post('username');
			$pass = $this->input->post('password');
			$profile = $this->Users_model->get_login($username,$pass);
			
			if(!empty($profile['id_users']) && password_verify($pass,$profile['password'])){
				
				$this->session->set_userdata('ses_id', $profile['id_users']);
				$this->session->set_userdata('ses_fullname', $profile['fullname']);
				$this->session->set_userdata('ses_role', $profile['role']);
				$this->session->set_userdata('ses_rolename', $profile['nama_roles']);
				$this->session->set_userdata('ses_foto', $profile['foto']);
				$this->session->set_userdata('ses_cart', array());
				$this->Users_model->after_login();
				redirect('');
			}else{
				$this->session->set_flashdata(array(
					'stat' => 'danger',
					'msg' => "Akun tidak cocok dengan sistem. Hubungi admin",
					'return' => $_REQUEST
				));
				redirect('login');
			}
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('ses_id');
		$this->session->unset_userdata('ses_fullname');
		$this->session->unset_userdata('ses_role');
		$this->session->unset_userdata('ses_rolename');
		$this->session->unset_userdata('ses_foto');
		$this->session->sess_destroy();
		redirect('login?logout=true&msg=Terima kasih! Berhasil keluar');
	}
}
