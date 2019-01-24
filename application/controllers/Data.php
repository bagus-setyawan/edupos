<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

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
		$this->load->model('Data_model');
		cek_login();
	}
	
	public function index()
	{
		redirect('');
	}
	
	public function vendor() {
		$this->breadcrumbs->add('Data', '#', 'fa fa-dashboard');
		$this->breadcrumbs->add('Vendor', site_url('data/vendor'));
		$data['content_header'] = array(
			'title' => 'Vendor',
			'subtitle' => 'View',
			'breadcrumbs' => $this->breadcrumbs->render()
		);
		$data['content'] = $this->load->view('backend/data/vendor', 
		array(
			'listvendor' => $this->Data_model->get_vendor()
			), true);
		$this->load->view('backend/tpl/site',$data);
	}
	
	public function barang() {
		$this->breadcrumbs->add('Data', '#', 'fa fa-dashboard');
		$this->breadcrumbs->add('Barang', site_url('data/barang'));
		$data['content_header'] = array(
			'title' => 'Barang',
			'subtitle' => 'Form',
			'breadcrumbs' => $this->breadcrumbs->render()
		);
		$data['content'] = $this->load->view('backend/data/barang', 
		array(
			'listbarang' => $this->Data_model->get_barang()
			), true);
		$this->load->view('backend/tpl/site',$data);
	}
	
	public function kategori() {
		$this->breadcrumbs->add('Data', '#', 'fa fa-dashboard');
		$this->breadcrumbs->add('Kategori', site_url('data/kategori'));
		$data['content_header'] = array(
			'title' => 'Kategori',
			'subtitle' => 'Form',
			'breadcrumbs' => $this->breadcrumbs->render()
		);
		$data['content'] = $this->load->view('backend/data/kategori', 
		array(
			'listkategori' => $this->Data_model->get_kategori()
			), true);
		$this->load->view('backend/tpl/site',$data);
	}
	
	public function pelanggan() {
		$this->breadcrumbs->add('Data', '#', 'fa fa-dashboard');
		$this->breadcrumbs->add('Pelanggan', site_url('data/pelanggan'));
		$data['content_header'] = array(
			'title' => 'Pelanggan',
			'subtitle' => 'Form',
			'breadcrumbs' => $this->breadcrumbs->render()
		);
		$data['content'] = $this->load->view('backend/data/pelanggan', 
		array(
			'listpelanggan' => $this->Data_model->get_pelanggan()
			), true);
		$this->load->view('backend/tpl/site',$data);
	}
	
	public function add($label){
		switch($label){
			case "vendor":
				$this->form_validation->set_rules('nama', 'Nama Vendor', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				$this->form_validation->set_rules('pic', 'PIC', 'trim|required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('telepon', 'Telepon', 'trim|required|is_natural');
				
				$config['upload_path'] = 'assets/images/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = 2000;
				// $config['encrypt_name'] = true;
				
				$this->load->library('upload', $config);
				if(!empty($_FILES['logo']['name'])){
					if($this->upload->do_upload('logo')){
						$filenya = $this->upload->data('file_name');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Kesalahan saat mengupload logo'
						));
						redirect('data/vendor');
					}
				}else{
					$filenya = "placeholder.jpg";
				}
				
				if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => validation_errors()
					));
					redirect('data/vendor');
				}else{
					$data = array(
						'nama_vendor' => $this->input->post('nama'),
						'deskripsi' => $this->input->post('deskripsi'),
						'pic' => $this->input->post('pic'),
						'alamat' => $this->input->post('alamat'),
						'telepon' => $this->input->post('telepon'),
						'logo' => $filenya
					);
					
					$result = $this->Dblib_model->simple_insert('vendor', $data);
					if($result){
						$this->session->set_flashdata(array(
							'stat' => 'success',
							'msg' => 'Vendor berhasil ditambahkan'
						));
						redirect('data/vendor');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Vendor gagal ditambahkan'
						));
						redirect('data/vendor');
					}
				}
			break;
			case "kategori":
				$this->form_validation->set_rules('nama', 'Nama Kategori', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				
				if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => validation_errors()
					));
					redirect('data/kategori');
				}else{
					$data = array(
						'nama_kategori' => $this->input->post('nama'),
						'deskripsi' => $this->input->post('deskripsi')
					);
					
					$result = $this->Dblib_model->simple_insert('kategori', $data);
					if($result){
						$this->session->set_flashdata(array(
							'stat' => 'success',
							'msg' => 'Kategori berhasil ditambahkan'
						));
						redirect('data/kategori');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Kategori gagal ditambahkan'
						));
						redirect('data/kategori');
					}
				}
			break;
			case "barang":
				$this->form_validation->set_rules('nama', 'Nama Barang', 'trim|required');
				$this->form_validation->set_rules('vendor', 'Vendor', 'trim|required');
				$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
				$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
				$this->form_validation->set_rules('beli', 'Harga Beli', 'trim|required|is_natural');
				$this->form_validation->set_rules('jual', 'Harga Jual', 'trim|required|is_natural');
				
				$config['upload_path'] = 'assets/images/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = 2000;
				// $config['encrypt_name'] = true;
				
				$this->load->library('upload', $config);
				if(!empty($_FILES['foto']['name'])){
					if($this->upload->do_upload('foto')){
						$filenya = $this->upload->data('file_name');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Kesalahan saat mengupload foto'
						));
						redirect('data/barang');
					}
				}else{
					$filenya = "placeholder.jpg";
				}
				
				if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => validation_errors()
					));
					redirect('data/barang');
				}else{
					$data = array(
						'barcode' => $this->input->post('barcode'),
						'nama_barang' => $this->input->post('nama'),
						'deskripsi' => $this->input->post('deskripsi'),
						'id_vendor' => $this->input->post('vendor'),
						'id_kategori' => $this->input->post('kategori'),
						'satuan' => $this->input->post('satuan'),
						'harga_beli' => $this->input->post('beli'),
						'harga_jual' => $this->input->post('jual'),
						'foto' => $filenya
					);
					
					$result = $this->Dblib_model->simple_insert('barang', $data);
					if($result){
						$this->session->set_flashdata(array(
							'stat' => 'success',
							'msg' => 'Barang berhasil ditambahkan'
						));
						redirect('data/barang');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Barang gagal ditambahkan'
						));
						redirect('data/Barang');
					}
				}
			break;
			case "pelanggan":
				$this->form_validation->set_rules('nama', 'Nama Pelanggan', 'trim|required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('telepon', 'Telepon', 'is_natural|required');
				
				if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => validation_errors()
					));
					redirect('data/pelanggan');
				}else{
					$data = array(
						'nama_pelanggan' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'telepon' => $this->input->post('telepon')
					);
					
					$result = $this->Dblib_model->simple_insert('pelanggan', $data);
					if($result){
						$this->session->set_flashdata(array(
							'stat' => 'success',
							'msg' => 'Pelanggan berhasil ditambahkan'
						));
						redirect('data/pelanggan');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Pelanggan gagal ditambahkan'
						));
						redirect('data/pelanggan');
					}
				}
			break;
			default:
				show_404();
		}
	}
	
	public function edit($label){
		switch($label){
			case "vendor":
				$this->form_validation->set_rules('id', 'Id', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama Vendor', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				$this->form_validation->set_rules('pic', 'PIC', 'trim|required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('telepon', 'Telepon', 'trim|required|is_natural');
				
				$config['upload_path'] = 'assets/images/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = 2000;
				// $config['encrypt_name'] = true;
				
				$this->load->library('upload', $config);
				if(!empty($_FILES['logo']['name'])){
					if($this->upload->do_upload('logo')){
						$filenya = $this->upload->data('file_name');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Kesalahan saat mengupload logo'
						));
						redirect('data/vendor');
					}
				}else{
					$filenya = "";
				}
				
				if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => validation_errors()
					));
					redirect('data/vendor');
				}else{
					$data = array(
						'nama_vendor' => $this->input->post('nama'),
						'deskripsi' => $this->input->post('deskripsi'),
						'pic' => $this->input->post('pic'),
						'alamat' => $this->input->post('alamat'),
						'telepon' => $this->input->post('telepon')
					);
					if($filenya != ""){
						$data['logo'] = $filenya;
					}
					$result = $this->Dblib_model->simple_update('vendor', $data, $this->input->post('id'));
					if($result){
						$this->session->set_flashdata(array(
							'stat' => 'success',
							'msg' => 'Vendor berhasil diubah'
						));
						redirect('data/vendor');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Vendor gagal diubah'
						));
						redirect('data/vendor');
					}
				}
			break;
			case "barang":
				$this->form_validation->set_rules('nama', 'Nama Barang', 'trim|required');
				$this->form_validation->set_rules('vendor', 'Vendor', 'trim|required');
				$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
				$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
				$this->form_validation->set_rules('beli', 'Harga Beli', 'trim|required|is_natural');
				$this->form_validation->set_rules('jual', 'Harga Jual', 'trim|required|is_natural');
				
				$config['upload_path'] = 'assets/images/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size'] = 2000;
				// $config['encrypt_name'] = true;
				
				$this->load->library('upload', $config);
				if(!empty($_FILES['foto']['name'])){
					if($this->upload->do_upload('foto')){
						$filenya = $this->upload->data('file_name');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Kesalahan saat mengupload foto'
						));
						redirect('data/barang');
					}
				}else{
					$filenya = "";
				}
				
				if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => validation_errors()
					));
					redirect('data/barang');
				}else{
					$data = array(
						'barcode' => $this->input->post('barcode'),
						'nama_barang' => $this->input->post('nama'),
						'deskripsi' => $this->input->post('deskripsi'),
						'id_vendor' => $this->input->post('vendor'),
						'id_kategori' => $this->input->post('kategori'),
						'satuan' => $this->input->post('satuan'),
						'harga_beli' => $this->input->post('beli'),
						'harga_jual' => $this->input->post('jual')
					);
					if($filenya != ""){
						$data['foto'] = $filenya;
					}
					$result = $this->Dblib_model->simple_update('barang', $data, $this->input->post('id'));
					if($result){
						$this->session->set_flashdata(array(
							'stat' => 'success',
							'msg' => 'Barang berhasil diubah'
						));
						redirect('data/barang');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Barang gagal diubah'
						));
						redirect('data/barang');
					}
				}
			break;
			case "kategori":
				$this->form_validation->set_rules('nama', 'Nama Kategori', 'trim|required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');
				
				if($this->form_validation->run() == FALSE){
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => validation_errors()
					));
					redirect('data/kategori');
				}else{
					$data = array(
						'nama_kategori' => $this->input->post('nama'),
						'deskripsi' => $this->input->post('deskripsi')
					);
					
					$result = $this->Dblib_model->simple_update('kategori', $data, $this->input->post('id'));
					if($result){
						$this->session->set_flashdata(array(
							'stat' => 'success',
							'msg' => 'Kategori berhasil diubah'
						));
						redirect('data/kategori');
					}else{
						$this->session->set_flashdata(array(
							'stat' => 'danger',
							'msg' => 'Kategori gagal diubah'
						));
						redirect('data/kategori');
					}
				}
			break;
			default:
				show_404();
		}
	}
	
}
