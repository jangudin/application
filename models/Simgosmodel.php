<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Simgosmodel extends CI_Model{	

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
	
	function delete_data($table,$where){		
	$this->db->delete($table, $where); 
	}

	function getdatasimgos($user_id=NULL)
	{
		$raw_user_id=" and id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT * FROM simgos WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}

		
}

