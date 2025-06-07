<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Propinsimodel extends CI_Model{	

	
		function select_data($table,$where){		
		$this->db->get_where('propinsi',$where);
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

		$sql = $this->db->query(" SELECT * FROM `propinsi` WHERE status IN('Aktif') ORDER BY id_prop DESC");
		return $sql->result_array();
	}
	
	function get_list_by_id($id=NULL)
	{
		
		$sql = $this->db->query(" SELECT * FROM `propinsi` WHERE status='Aktif' AND id_prop='".$id."' ");
		return $sql->result_array();
	}
		
}

