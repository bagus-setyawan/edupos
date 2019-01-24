<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model{

    public function __construct() {
		parent::__construct();
		//Construct Disini
	}
	
	public function get_vendor(){
		$this->db->select('id, nama_vendor, logo, telepon, alamat');
		$this->db->where('aktif', 1);
		return $this->db->get('vendor')->result_array();
	}
	
	public function get_barang(){
		$this->db->select('a.id, nama_barang, nama_vendor, nama_kategori, barcode');
		$this->db->join('kategori b', 'b.id=a.id_kategori', 'left');
		$this->db->join('vendor c', 'c.id=a.id_vendor', 'left');
		$this->db->where('a.aktif', 1);
		return $this->db->get('barang a')->result_array();
	}
	
	public function get_kategori(){
		$this->db->select('id, nama_kategori, deskripsi');
		$this->db->where('aktif', 1);
		return $this->db->get('kategori')->result_array();
	}
	
	public function get_pelanggan(){
		$this->db->select('*');
		$this->db->where('aktif', 1);
		return $this->db->get('pelanggan')->result_array();
	}
	
}
?>