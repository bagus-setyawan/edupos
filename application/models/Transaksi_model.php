<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model{

    public function __construct() {
		parent::__construct();
		//Construct Disini
	}
	
	public function get_barang(){
		$this->db->select('a.id, nama_barang, nama_vendor, nama_kategori, a.deskripsi, a.harga_jual, a.satuan, barcode, a.foto');
		$this->db->join('kategori b', 'b.id=a.id_kategori', 'left');
		$this->db->join('vendor c', 'c.id=a.id_vendor', 'left');
		$this->db->where('a.aktif', 1);
		$this->db->order_by('b.nama_kategori','ASC');
		return $this->db->get('barang a')->result_array();
	}
	
	public function get_kategori(){
		$this->db->where('a.aktif', 1);
		$this->db->order_by('a.nama_kategori','ASC');
		return $this->db->get('kategori a')->result_array();
	}
	
}
?>