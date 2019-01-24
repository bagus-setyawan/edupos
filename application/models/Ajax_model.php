<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model{

	private $satuan = array(
		array('id'=>'gelas','nama_satuan'=>'Gelas'),
		array('id'=>'pcs','nama_satuan'=>'Pcs'),
		array('id'=>'porsi','nama_satuan'=>'Porsi')
	);
	
    public function __construct() {
		parent::__construct();
		//Construct Disini
	}
	
	public function get_add_vendor(){
		$form = "<form role='form' id='form-modal' action='".site_url('data/add/vendor')."' method='POST' enctype='multipart/form-data'>
			<div class='form-group'>
				<label>Nama Vendor</label>
				<input type='text' class='form-control' name='nama' required>
			</div>
			<div class='form-group'>
				<label>Deskripsi</label>
				<textarea class='form-control' name='deskripsi' required></textarea>
			</div>
			<div class='form-group'>
				<label>Person In Charge (PIC)</label>
				<input type='text' class='form-control' name='pic' required>
			</div>
			<div class='form-group'>
				<label>Alamat</label>
				<textarea class='form-control' name='alamat' required></textarea>
			</div>
			<div class='form-group'>
				<label>Telepon</label>
				<input type='text' class='form-control' name='telepon' required>
			</div>
			<div class='form-group'>
				<label>Logo</label>
				<input type='file' class='form-control' name='logo' required>
				<span class='text-sm text-red'>* Ukuran Maksimal upload foto 2MB.</span>
			</div>
		</form>";
		return $form;
	}
	
	public function get_add_barang(){
		$vendor = $this->db->get_where('vendor',array('aktif'=>1))->result_array();
		$kategori = $this->db->get_where('kategori',array('aktif'=>1))->result_array();
		$form = "<form role='form' id='form-modal' action='".site_url('data/add/barang')."' method='POST' enctype='multipart/form-data'>
			<div class='form-group'>
				<label>Barcode</label>
				<input type='text' class='form-control' name='barcode'>
			</div>
			<div class='form-group'>
				<label>Nama Barang</label>
				<input type='text' class='form-control' name='nama' required>
			</div>
			<div class='form-group'>
				<label>Vendor</label>
				<select class='form-control' name='vendor'>";
				if(count($vendor) > 0){
					foreach($vendor as $v){
						$form .= "<option value='$v[id]'>$v[nama_vendor]</option>";
					}
				}else{
					$form .= "<option>Data Vendor Kosong</option>";
				}
				$form .= "</select>
			</div>
			<div class='form-group'>
				<label>Kategori</label>
				<select class='form-control' name='kategori'>";
				if(count($kategori) > 0){
					foreach($kategori as $v){
						$form .= "<option value='$v[id]'>$v[nama_kategori]</option>";
					}
				}else{
					$form .= "<option>Data Kategori Kosong</option>";
				}
				$form .= "</select>
			</div>
			<div class='form-group'>
				<label>Satuan</label>
				<select class='form-control' name='satuan'>
					<option value='gelas'>Gelas</option>
					<option value='pcs'>Pcs</option>
					<option value='porsi'>Porsi</option>
				</select>
			</div>
			<div class='form-group'>
				<label>Deskripsi</label>
				<textarea class='form-control' name='deskripsi'></textarea>
			</div>
			<div class='form-group'>
				<label>Harga Beli</label>
				<input type='text' class='form-control' name='beli' required>
			</div>
			<div class='form-group'>
				<label>Harga Jual</label>
				<input type='text' class='form-control' name='jual' required>
			</div>
			<div class='form-group'>
				<label>Foto</label>
				<input type='file' class='form-control' name='foto' required>
				<span class='text-sm text-red'>* Ukuran Maksimal upload foto 2MB.</span>
			</div>
		</form>";
		return $form;
	}
	
	public function get_add_kategori(){
		$form = "<form role='form' id='form-modal' action='".site_url('data/add/kategori')."' method='POST'>
			<div class='form-group'>
				<label>Nama Kategori</label>
				<input type='text' class='form-control' name='nama' required>
			</div>
			<div class='form-group'>
				<label>Deskripsi</label>
				<textarea class='form-control' name='deskripsi' required></textarea>
			</div>
		</form>";
		return $form;
	}
	
	public function get_add_pelanggan(){
		$form = "<form role='form' id='form-modal' action='".site_url('data/add/pelanggan')."' method='POST'>
			<div class='form-group'>
				<label>Nama Pelanggan</label>
				<input type='text' class='form-control' name='nama' required>
			</div>
			<div class='form-group'>
				<label>Alamat</label>
				<textarea class='form-control' name='alamat' required></textarea>
			</div>
			<div class='form-group'>
				<label>No Telp</label>
				<input type='text' class='form-control' name='telepon' required>
			</div>
		</form>";
		return $form;
	}
	
	public function get_view_vendor($id){
		$data = $this->Dblib_model->get_record_id('vendor', $id);
		if(!empty($data)){
			$form = "<form role='form'>
			<div class='form-group'>
				<label>Nama Vendor</label>
				<input type='text' class='form-control' name='nama' value='$data[nama_vendor]' readonly>
			</div>
			<div class='form-group'>
				<label>Deskripsi</label>
				<textarea class='form-control' name='deskripsi' readonly>$data[deskripsi]</textarea>
			</div>
			<div class='form-group'>
				<label>Person In Charge (PIC)</label>
				<input type='text' class='form-control' name='pic' value='$data[pic]' readonly>
			</div>
			<div class='form-group'>
				<label>Alamat</label>
				<textarea class='form-control' name='alamat' readonly>$data[alamat]</textarea>
			</div>
			<div class='form-group'>
				<label>Telepon</label>
				<input type='text' class='form-control' name='telepon' value='$data[telepon]' readonly>
			</div>
			<div class='form-group'>
				<label>Logo</label>
				<img src='".site_url('assets/images/'.$data['logo'])."' class='img-responsive' />
			</div>
		</form>";
		}else{
			$form = "Maaf data tidak ada";
		}
		return $form;
	}
	
	public function get_view_barang($id){
		$data = $this->Dblib_model->get_record_id('barang', $id);
		$vendor = $this->db->get_where('vendor',array('aktif'=>1))->result_array();
		$kategori = $this->db->get_where('kategori',array('aktif'=>1))->result_array();
		if(!empty($data)){
			$form = "<form role='form'>
			<div class='form-group'>
				<label>Barcode</label>
				<input type='text' class='form-control' name='barcode' value='$data[barcode]' readonly>
			</div>
			<div class='form-group'>
				<label>Nama Barang</label>
				<input type='text' class='form-control' name='nama' value='$data[nama_barang]' readonly>
			</div>
			<div class='form-group'>
				<label>Vendor</label>
				<select class='form-control' name='vendor' readonly>";
				if(count($vendor) > 0){
					foreach($vendor as $v){
						if($v['id'] == $data['id_vendor'])
							$form .= "<option value='$v[id]' selected>$v[nama_vendor]</option>";
						else
							$form .= "<option value='$v[id]'>$v[nama_vendor]</option>";
					}
				}else{
					$form .= "<option>Data Vendor Kosong</option>";
				}
				$form .= "</select>
			</div>
			<div class='form-group'>
				<label>Kategori</label>
				<select class='form-control' name='kategori' readonly>";
				if(count($kategori) > 0){
					foreach($kategori as $v){
						if($v['id'] == $data['id_kategori'])
							$form .= "<option value='$v[id]' selected>$v[nama_kategori]</option>";
						else
							$form .= "<option value='$v[id]'>$v[nama_kategori]</option>";
					}
				}else{
					$form .= "<option>Data Kategori Kosong</option>";
				}
				$form .= "</select>
			</div>
			<div class='form-group'>
				<label>Satuan</label>
				<select class='form-control' name='satuan' readonly>";
					if(count($this->satuan) > 0){
						foreach($this->satuan as $v){
							if($v['id'] == $data['satuan'])
								$form .= "<option value='$v[id]' selected>$v[nama_satuan]</option>";
							else
								$form .= "<option value='$v[id]'>$v[nama_satuan]</option>";
						}
					}else{
						$form .= "<option>Data Satuan Kosong</option>";
					}
				$form .= "</select>
			</div>
			<div class='form-group'>
				<label>Deskripsi</label>
				<textarea class='form-control' name='deskripsi' readonly>$data[deskripsi]</textarea>
			</div>
			<div class='form-group'>
				<label>Harga Beli</label>
				<input type='text' class='form-control' name='beli' value='$data[harga_beli]' readonly>
			</div>
			<div class='form-group'>
				<label>Harga Jual</label>
				<input type='text' class='form-control' name='jual' value='$data[harga_jual]' readonly>
			</div>
			<div class='form-group'>
				<label>Foto</label>
				<img src='".site_url('assets/images/'.$data['foto'])."' class='img-responsive' />
			</div>
		</form>";
		}else{
			$form = "Maaf data tidak ada";
		}
		return $form;
	}
	
	public function get_edit_vendor($id){
		$data = $this->Dblib_model->get_record_id('vendor', $id);
		if(!empty($data)){
			$form = "<form role='form' id='form-modal' action='".site_url('data/edit/vendor')."' method='POST' enctype='multipart/form-data'>
			<input type='hidden' name='id' value='$data[id]' required>
			<div class='form-group'>
				<label>Nama Vendor</label>
				<input type='text' class='form-control' name='nama' value='$data[nama_vendor]' required>
			</div>
			<div class='form-group'>
				<label>Deskripsi</label>
				<textarea class='form-control' name='deskripsi' required>$data[deskripsi]</textarea>
			</div>
			<div class='form-group'>
				<label>Person In Charge (PIC)</label>
				<input type='text' class='form-control' name='pic' value='$data[pic]' required>
			</div>
			<div class='form-group'>
				<label>Alamat</label>
				<textarea class='form-control' name='alamat' required>$data[alamat]</textarea>
			</div>
			<div class='form-group'>
				<label>Telepon</label>
				<input type='text' class='form-control' name='telepon' value='$data[telepon]' required>
			</div>
			<div class='form-group'>
				<label>Logo</label>
				<img src='".site_url('assets/images/'.$data['logo'])."' class='img-responsive' />
				<input type='file' class='form-control' name='logo' required>
				<span class='text-sm text-red'>* Ukuran Maksimal upload foto 2MB.</span>
			</div>
		</form>";
		}else{
			$form = "Maaf data tidak ada";
		}
		return $form;
	}
	
	public function get_edit_barang($id){
		$data = $this->Dblib_model->get_record_id('barang', $id);
		$vendor = $this->db->get_where('vendor',array('aktif'=>1))->result_array();
		$kategori = $this->db->get_where('kategori',array('aktif'=>1))->result_array();
		if(!empty($data)){
			$form = "<form role='form' id='form-modal' action='".site_url('data/edit/barang')."' method='POST' enctype='multipart/form-data'>
			<input type='hidden' name='id' value='$data[id]' required>
			<div class='form-group'>
				<label>Barcode</label>
				<input type='text' class='form-control' name='barcode' value='$data[barcode]' >
			</div>
			<div class='form-group'>
				<label>Nama Barang</label>
				<input type='text' class='form-control' name='nama' value='$data[nama_barang]' required>
			</div>
			<div class='form-group'>
				<label>Vendor</label>
				<select class='form-control' name='vendor' required>";
				if(count($vendor) > 0){
					foreach($vendor as $v){
						if($v['id'] == $data['id_vendor'])
							$form .= "<option value='$v[id]' selected>$v[nama_vendor]</option>";
						else
							$form .= "<option value='$v[id]'>$v[nama_vendor]</option>";
					}
				}else{
					$form .= "<option>Data Vendor Kosong</option>";
				}
				$form .= "</select>
			</div>
			<div class='form-group'>
				<label>Kategori</label>
				<select class='form-control' name='kategori' required>";
				if(count($kategori) > 0){
					foreach($kategori as $v){
						if($v['id'] == $data['id_kategori'])
							$form .= "<option value='$v[id]' selected>$v[nama_kategori]</option>";
						else
							$form .= "<option value='$v[id]'>$v[nama_kategori]</option>";
					}
				}else{
					$form .= "<option>Data Kategori Kosong</option>";
				}
				$form .= "</select>
			</div>
			<div class='form-group'>
				<label>Satuan</label>
				<select class='form-control' name='satuan' required>";
					if(count($this->satuan) > 0){
						foreach($this->satuan as $v){
							if($v['id'] == $data['satuan'])
								$form .= "<option value='$v[id]' selected>$v[nama_satuan]</option>";
							else
								$form .= "<option value='$v[id]'>$v[nama_satuan]</option>";
						}
					}else{
						$form .= "<option>Data Satuan Kosong</option>";
					}
				$form .= "</select>
			</div>
			<div class='form-group'>
				<label>Deskripsi</label>
				<textarea class='form-control' name='deskripsi'>$data[deskripsi]</textarea>
			</div>
			<div class='form-group'>
				<label>Harga Beli</label>
				<input type='text' class='form-control' name='beli' value='$data[harga_beli]' required>
			</div>
			<div class='form-group'>
				<label>Harga Jual</label>
				<input type='text' class='form-control' name='jual' value='$data[harga_jual]' required>
			</div>
			<div class='form-group'>
				<label>Foto</label>
				<img src='".site_url('assets/images/'.$data['foto'])."' class='img-responsive' />
				<input type='file' class='form-control' name='foto' required>
				<span class='text-sm text-red'>* Ukuran Maksimal upload foto 2MB.</span>
			</div>
		</form>";
		}else{
			$form = "Maaf data tidak ada";
		}
		return $form;
	}
	
	public function get_edit_kategori($id){
		$data = $this->Dblib_model->get_record_id('kategori', $id);
		if(!empty($data)){
		$form = "<form role='form' id='form-modal' action='".site_url('data/edit/kategori')."' method='POST'>
			<input type='hidden' name='id' value='$data[id]' required>
			<div class='form-group'>
				<label>Nama Kategori</label>
				<input type='text' class='form-control' name='nama' value='$data[nama_kategori]' required>
			</div>
			<div class='form-group'>
				<label>Deskripsi</label>
				<textarea class='form-control' name='deskripsi' required>$data[deskripsi]</textarea>
			</div>
		</form>";
		}else{
			$form = "Maaf data tidak ada";
		}
		return $form;
	}
	
}
?>