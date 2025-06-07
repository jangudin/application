<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Useraksesmodel extends CI_Model{	

	
		function select_data($table,$where){		
		$this->db->get_where('registrasi_user',$where);
	}
	
	function input_data($table,$data){
		return $this->db->insert($table,$data);
	}
	
	function edit_data($table,$where,$data){		
	$this->db->where($where);
	return $this->db->update($table,$data);
	}
	
	function get_list($filters=NULL, $order=NULL)
	{
	

		$sql = $this->db->query(" SELECT * FROM `registrasi_user`  ORDER BY id DESC limit 0,100");
		return $sql->result_array();
	}
	
	function get_list_by_id($id=NULL)
	{
		
		$sql = $this->db->query(" SELECT * FROM `registrasi_user` WHERE id='".$id."' ");
		return $sql->result_array();
	}
		
}

