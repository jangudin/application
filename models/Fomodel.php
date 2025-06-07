<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registrasiusermodel extends CI_Model{	

	public function __construct()
    {
        parent::__construct();
    }

    function getdatauser($user_id=NULL)
	{
	
	 
			$raw_user_id=" and registrasi_user.id='".$user_id."' ";

		$sql = $this->db->query("SELECT registrasi_user.* FROM registrasi_user  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}

    function getdataklinik($user_id=NULL)
	{
	
	 
			$raw_user_id=" and data_klinik.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT data_klinik.*,propinsi.kode_regional FROM data_klinik  LEFT JOIN propinsi ON data_klinik.id_prov = propinsi.id_prop WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	
		
}

