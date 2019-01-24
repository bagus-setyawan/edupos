<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dblib_model extends CI_Model{

    public function __construct() {
		parent::__construct();
		//Construct Disini
	}
	
	public function get_count($tbname, $opt = array()){
		$this->db->select("COUNT(*) AS numrows");
		if(count($opt) > 0){
			$this->db->or_like($opt);
		}
		return $this->db->get($tbname)->row()->numrows;
	}
	
	public function get_current_page_records($tbname, $opt, $limit, $start) 
    {
		$this->db->select("*,$tbname.id");
		$this->db->limit($limit, $start);
		if(count($opt) > 0){
			$this->db->or_like($opt);
		}
		$this->db->where("$tbname.publish","1");
		$this->db->join("users","users.id=$tbname.users_id", "left");
		$this->db->order_by("$tbname.updated_at", "DESC");
        $query = $this->db->get($tbname);
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result_array() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
	
	public function get_all_records($tbname){
		return $this->db->get($tbname)->result_array();
	}
	
	public function get_record_id($tbname, $id){
		$this->db->where('id', $id);
		return $this->db->get($tbname)->row_array();
	}
	
	public function simple_insert($tbname, $data){
		return $this->db->insert($tbname, $data);
	}
	
	public function simple_update($tbname, $data, $id){
		$this->db->where('id', $id);
		return $this->db->update($tbname, $data);
	}
	
	public function simple_delete($tbname, $id){
		$this->db->where('id', $id);
		return $this->db->update($tbname, array('aktif'=>0));
	}
	
	public function getsetting($params){
		if(!empty($params)){
			$this->db->where($params);
			$result = $this->db->get('setting')->row_array();
		}else{
			$query = $this->db->get('setting');
			foreach($query->result_array() as $d){
				$result[$d['key']] = $d['value'];
			}
		}
		return $result;
	}
	
	public function updatesetting($d){
		foreach($d as $key=>$val){
			$result = $this->db->query("UPDATE setting SET value='$val' WHERE setting.key='$key'");
			if(!$result){
				return false;
			}
		}
		return true;
	}
}
?>