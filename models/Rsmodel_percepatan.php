<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rsmodel extends CI_Model{	

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


	function getlistpengajuanrs($id_kategori=null,$id_kota=NULL,$id_prov=NULL)
	{
	
	if($id_kategori=='1'){
		$where ='  AND trans_final.kode_faskes!="" AND (data_rs.pemilik_modal="2" OR (data_rs.pemilik_modal="1" AND data_rs.kelas="1"))';
		$where_type_jenis =' AND status_validasi_kemkes="Sudah Validasi"';
		$where_prov ='';
	}else if($id_kategori=='2'){
		$where =' AND trans_final.kode_faskes!=""  AND data_rs.pemilik_modal="1" AND data_rs.kelas="2"';
		$where_type_jenis =' AND status_validasi_prov="Sudah Validasi"';
		$where_prov =' AND data_rs.id_prov="'.$id_prov.'"';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="4" AND data_rs.pemilik_modal="1" AND data_rs.kelas IN(3,4,5,6)';
		$where_type_jenis =' AND status_validasi_kota="Sudah Validasi"';
		$where_prov ='';
	}
	
	
	

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_rs.nama_rs,data_rs.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_rs ON data_rs.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.final='1' ".$where.$where_type_jenis.$where_prov." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	
	function getlistpengajuanbelumvalidasirs($id_kategori=null,$id_kota=NULL,$id_prov=NULL)
	{
	if($id_kategori=='1'){
		$where ='  AND (data_rs.pemilik_modal="2" OR (data_rs.pemilik_modal="1" AND data_rs.kelas="1"))';
		$where_type_jenis =' AND status_validasi_kemkes="Belum Validasi"';
		$where_prov ='';
	}else if($id_kategori=='2'){
		$where ='  AND data_rs.pemilik_modal="1" AND data_rs.kelas="2"';
		$where_type_jenis =' AND status_validasi_prov="Belum Validasi"';
		$where_prov =' AND data_rs.id_prov="'.$id_prov.'"';
	}else{
		/*$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="4" AND data_rs.pemilik_modal="1" AND data_rs.kelas IN(3,4,5,6)';
		$where_type_jenis =' AND status_validasi_kota="Belum Validasi"';
		$where_prov ='';*/
        
        $where =' AND registrasi_user.id_kategori="4" AND data_rs.pemilik_modal="1"';
        $where_type_jenis ='';
        $where_prov ='';
	}
	


		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_rs.nama_rs,data_rs.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_rs ON data_rs.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.final='1' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL) ".$where.$where_type_jenis.$where_prov." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	
	function getlistpengajuanbelumvalidasiperbaikanrs($id_kategori=null,$id_kota=NULL,$id_prov=NULL)
	{
	if($id_kategori=='1'){
		$where ='  AND (data_rs.pemilik_modal="2" OR (data_rs.pemilik_modal="1" AND data_rs.kelas="1"))';
		$where_type_jenis =' AND status_validasi_kemkes="Perbaikan"';
		$where_prov ='';
	}else if($id_kategori=='2'){
		$where ='  AND data_rs.pemilik_modal="1" AND data_rs.kelas="2"';
		$where_type_jenis =' AND status_validasi_prov="Perbaikan"';
		$where_prov =' AND data_rs.id_prov="'.$id_prov.'"';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="4" AND data_rs.pemilik_modal="1" AND data_rs.kelas IN(3,4,5,6)';
		$where_type_jenis =' AND status_validasi_kota="Perbaikan"';
		$where_prov ='';
	}
	
	



		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_rs.nama_rs,data_rs.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_rs ON data_rs.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.catatan !='' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL)  ".$where.$where_type_jenis.$where_prov." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	function getdatalabkes($user_id=NULL)
	{
	
	 
			$raw_user_id=" and data_labkes.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT data_labkes.*,propinsi.kode_regional FROM data_labkes  LEFT JOIN propinsi ON data_labkes.id_prov = propinsi.id_prop WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
		
}

