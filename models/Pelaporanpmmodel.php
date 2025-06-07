<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pelaporanpmmodel extends CI_Model{	

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
	
    function get_pembiayaan_kesehatan_pasien($user_id=null,$tahun=NULL)
	{
        $sql = $this->db->query("SELECT
                * 
            FROM
                pembiayaan_kesehatan_pasien 
            WHERE
                id_faskes = ".$user_id."
                AND tahun = ".$tahun);
		return $sql->result_array();
	}

	function get_pelaporan_prognas($user_id=null,$tahun=NULL)
	{
        $sql = $this->db->query("SELECT
                * 
            FROM
				pelaporan_prognas 
            WHERE
                id_faskes = ".$user_id."
                AND tahun = ".$tahun);
		return $sql->result_array();
	}

	function get_penurunan_skor_ohis_pasien($user_id=null,$tahun=NULL)
	{
        $sql = $this->db->query("SELECT
                * 
            FROM
				penurunan_skor_ohis_pasien 
            WHERE
                id_faskes = ".$user_id."
                AND tahun = ".$tahun);
		return $sql->result_array();
	}

	function get_kepatuhan_kunjungan_pasien_hipertensi($user_id=null,$tahun=NULL)
	{
        $sql = $this->db->query("SELECT
                * 
            FROM
				kepatuhan_kunjungan_pasien_hipertensi 
            WHERE
                id_faskes = ".$user_id."
                AND tahun = ".$tahun);
		return $sql->result_array();
	}
}

