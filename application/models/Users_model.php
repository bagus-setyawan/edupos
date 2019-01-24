<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

    public function __construct() {
		parent::__construct();
		//Construct Disini
	}
	
	public function get_login($username){
		$this->db->select('a.id_users, password, fullname, role, nama_roles, foto');
		$this->db->join('users_roles b', 'a.role=b.id_roles', 'left');
		$this->db->where(array(
			'nama_user' => $username,
			'aktif' => 1
		));		
		return $this->db->get('users a')->row_array();
	}
	
	public function after_login(){
		$data = array(
			'class' => 'fa fa-sign-in bg-green',
			'judul' => 'telah login ke sistem'
		);
		return add_log($data);
	}
	
	public function add_users($data,$id){
		if(empty($id)){
			return $this->db->insert('users', $data);
		}else{
			$this->db->where('id_users',$id);
			return $this->db->update('users', $data);
		}
	}
	
	public function get_users($id=""){
		if(!empty($id)){
			$query = $this->db->query("SELECT * FROM users a INNER JOIN users_roles b ON a.role=b.id_roles WHERE id_users='$id' ORDER BY nama_user ASC");
			$result = $query->row_array();
		}else{
			$query = $this->db->query("SELECT * FROM users a INNER JOIN users_roles b ON a.role=b.id_roles WHERE id_users!='1' AND role != '1' AND role != '3' ORDER BY nama_user ASC");
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function del_users($id){
		return $this->db->simple_query("DELETE FROM users WHERE id_users='$id'");
	}
	
}

?>