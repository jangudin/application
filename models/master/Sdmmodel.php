<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sdmmodel extends CI_Model{	

public function __construct()
    {
        parent::__construct();
    }

	function select_data($table,$where){		
	
		return $this->db->get_where($table,$where);
	
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

		$sql = $this->db->query(" SELECT * FROM `data_sdm`WHERE deleted='0' ORDER BY id DESC");
		return $sql->result_array();
	}
	
	function get_list_by_id($id=NULL)
	{
		
		$sql = $this->db->query(" SELECT * FROM `data_sdm` WHERE id='".$id."' ");
		return $sql->result_array();
	}
	
	
		
}

