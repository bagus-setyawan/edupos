<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	 
	public function __construct() {
		parent::__construct();
		$this->load->model('Ajax_model');
		// $this->output->enable_profiler(true);
	}
	
	public function add_data(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$id = $this->input->post('label');
		switch($id){
			case "vendor":
				$result = $this->Ajax_model->get_add_vendor();
				echo $result;
			break;
			case "barang":
				$result = $this->Ajax_model->get_add_barang();
				echo $result;
			break;
			case "kategori":
				$result = $this->Ajax_model->get_add_kategori();
				echo $result;
			break;
			case "pelanggan":
				$result = $this->Ajax_model->get_add_pelanggan();
				echo $result;
			break;
			case "delete":
				$result = $this->Ajax_model->del_user($this->input->post('data'));
				echo $result;
			break;
			default:
				show_404();
		}
	}
	
	public function view_data(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$label = $this->input->post('label');
		$id = $this->input->post('id');
		switch($label){
			case "vendor":
				$result = $this->Ajax_model->get_view_vendor($id);
				echo $result;
			break;
			case "barang":
				$result = $this->Ajax_model->get_view_barang($id);
				echo $result;
			break;
			case "delete":
				$result = $this->Ajax_model->del_user($this->input->post('data'));
				echo $result;
			break;
			default:
				show_404();
		}
	}
	
	public function edit_data(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$label = $this->input->post('label');
		$id = $this->input->post('id');
		switch($label){
			case "vendor":
				$result = $this->Ajax_model->get_edit_vendor($id);
				echo $result;
			break;
			case "kategori":
				$result = $this->Ajax_model->get_edit_kategori($id);
				echo $result;
			break;
			case "barang":
				$result = $this->Ajax_model->get_edit_barang($id);
				echo $result;
			break;
			case "delete":
				$result = $this->Ajax_model->del_user($this->input->post('data'));
				echo $result;
			break;
			default:
				show_404();
		}
	}
	
	public function delete_data(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$label = $this->input->post('label');
		$id = $this->input->post('id');
		switch($label){
			case "vendor":
				$result = $this->Dblib_model->simple_delete($label, $id);
				if($result){
					$this->session->set_flashdata(array(
						'stat' => 'success',
						'msg' => 'Vendor berhasil dihapus'
					));
					redirect('data/vendor');
				}else{
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => 'Vendor gagal dihapus'
					));
					redirect('data/vendor');
				}
			break;
			case "barang":
				$result = $this->Dblib_model->simple_delete($label, $id);
				if($result){
					$this->session->set_flashdata(array(
						'stat' => 'success',
						'msg' => 'Barang berhasil dihapus'
					));
					redirect('data/barang');
				}else{
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => 'Barang gagal dihapus'
					));
					redirect('data/barang');
				}
			break;
			case "kategori":
				$result = $this->Dblib_model->simple_delete($label, $id);
				if($result){
					$this->session->set_flashdata(array(
						'stat' => 'success',
						'msg' => 'Kategori berhasil dihapus'
					));
					redirect('data/kategori');
				}else{
					$this->session->set_flashdata(array(
						'stat' => 'danger',
						'msg' => 'Kategori gagal dihapus'
					));
					redirect('data/kategori');
				}
			break;
			default:
				show_404();
		}
	}
	
	public function addtocart(){
		$carts = $this->session->userdata('ses_cart');
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$harga = $this->input->post('harga');
		$qty = $this->input->post('qty');
		$ket = $this->input->post('ket');
		
		if(array_key_exists($id, $carts)){
			$carts["$id"]['qty'] += $qty;
			if($ket != ""){
				$carts[$id]['ket'] = $ket;
			}
			echo "tr";
		}else{
			$carts[$id] = array(
				'qty' => $qty,
				'ket' => $ket,
				'harga' => $harga,
				'nama' => $nama
			);
		}
		$_SESSION['ses_cart'] = $carts;
	}
	
	public function load_cart(){
		echo "<table class='table table-stripped table-bordered'>
			<thead>
				<tr>
					<th>Nama Item</th>
					<th>Qty</th>
					<th>Subtotal</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>";
		$carts = $this->session->userdata('ses_cart');
		if(count($carts) > 0){
			$total = 0;
			foreach($carts as $k => $c){
				$subtot = $c['qty']*$c['harga'];
				$total += $subtot;
				echo "<tr>
						<td>$c[nama]</td>
						<td>$c[qty]</td>
						<td>Rp. $subtot</td>
						<td><button onclick='del_cart(\"".site_url("ajax/del_cart/$k")."\")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Hapus</button></td>
					  </tr>";
			}
			echo "<tr><td colspan='2'>Total : </td><td colspan='2' style='font-weight:bold;font-size:16pt;'>Rp $total</td></tr>";
			
		}else{
			echo "<tr>
					<td colspan='4'>Keranjang kosong</td>
				  </tr>";
		}
		echo "</tbody></table>";
	}
	
	public function del_cart($id){
		$carts = $this->session->userdata('ses_cart');
		unset($carts[$id]);
		$_SESSION['ses_cart'] = $carts;
	}
	
	public function clear_cart(){
		$this->session->unset_userdata('ses_cart');
	}
	
}
