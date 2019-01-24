<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model{

    public function __construct() {
		parent::__construct();
		//Construct Disini
	}
	
	public function get_listcount(){				
		$data = array();
		
		$this->db->select("SUM(total) AS total");
		$this->db->from("penjualan");
		$data['jmljual'] = $this->db->get()->row()->total;
		
		$this->db->select("SUM(total) AS total");
		$this->db->from("pembelian");
		$data['jmlbeli'] = $this->db->get()->row()->total;
		
		$this->db->select("COUNT(id) AS total");
		$this->db->from("barang");
		$this->db->where("aktif", 1);
		$data['jmlprod'] = $this->db->get()->row()->total;
		
		$this->db->select("COUNT(id) AS total");
		$this->db->from("vendor");
		$this->db->where("aktif", 1);
		$data['jmlvendor'] = $this->db->get()->row()->total;
		
		$this->db->select("COUNT(id_users) AS total");
		$this->db->from("users");
		$this->db->where("aktif", 1);
		$data['jmlusers'] = $this->db->get()->row()->total;
		
		return $data;		
	}
	
	public function get_timeline($limit = 5){
		$this->db->select('fullname, class, judul, isi, a.created_at');
		$this->db->join('users b', 'b.id_users=a.id_users', 'left');
		$this->db->order_by('a.created_at', 'DESC');
		$this->db->limit($limit);
		return $this->db->get('log a')->result_array();
	}
	
}
?>