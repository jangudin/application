<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( !function_exists('dropdown_propinsi')) {
   function dropdown_propinsi() {
        $ci = & get_instance();
	  $select = $ci->db->query("SELECT id_prop as id,nama_prop as keterangan 
FROM propinsi WHERE status='Aktif'");
      $rsData = $select->result();
	 
      return _parseDropdown($rsData, 'keterangan','id','semua'); //$data;
   }
}

if ( !function_exists('dropdown_kota')) {
   function dropdown_kota($id_prop=null) {
        $ci = & get_instance();
	  $select = $ci->db->query("SELECT id_kota as id,nama_kota as keterangan 
FROM kota  WHERE status='Aktif' AND id_prop='".$id_prop."'");
      $rsData = $select->result();
	 
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_kab_kota')) {
   function dropdown_kab_kota($id_prop=null) {
        $ci = & get_instance();
	  $select = $ci->db->query("SELECT link as id,kab_kota as keterangan 
FROM kab_kota  WHERE  prop_id='".$id_prop."'");
      $rsData = $select->result();
	 
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_kecamatan')) {
   function dropdown_kecamatan($id_prop=null,$id_kota=null) {
        $ci = & get_instance();
	  $select = $ci->db->query("SELECT id_camat as id,nama_camat as keterangan 
FROM kecamatan  WHERE  id_prop='".$id_prop."' AND id_kota='".$id_kota."'");
      $rsData = $select->result();
	 
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_puskesmas')) {
   function dropdown_puskesmas($id_kota=null) {
        $ci = & get_instance();
	  $select = $ci->db->query("SELECT kode_satker as id, nama as keterangan 
FROM daftar_puskesmas  WHERE kode_kabupaten='".$id_kota."'");
      $rsData = $select->result();
	 
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_klinik_rs_dll')) {
   function dropdown_klinik_rs_dll($id_prop=null,$id_kota=null,$id_camat=null) {
        $ci = & get_instance();
	  $select = $ci->db->query("SELECT id as id,nama_fasyankes as keterangan 
FROM registrasi_user  WHERE  id_prov='".$id_prop."' AND id_kota='".$id_kota."' AND id_camat='".$id_camat."' AND validate='2' AND id_kategori!='7'");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_kategori')) {
   function dropdown_kategori($id_prop=null) {
        $ci = & get_instance();
	  $select = $ci->db->query("SELECT id as id,kategori_user as keterangan 
FROM kategori WHERE id IN('5','7','4','6','9') ORDER BY urutan ASC  ");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_kategori_pm')) {
   function dropdown_kategori_pm($id_prop=null) {
        $ci = & get_instance();
	  $select = $ci->db->query("SELECT id as id,kategori_user as keterangan 
FROM kategori_pm WHERE id IN('4','5','6','7') ORDER BY urutan ASC  ");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_sarpras_alkes_klinik')) {
   function dropdown_sarpras_alkes_klinik($type=NULL) {
        $ci = & get_instance();
		if(!empty($type)){
		$where="WHERE jenis_perawatan='".$type."'";
	  $select = $ci->db->query("SELECT id as id,sarpras_alkes as keterangan 
FROM sarpras_alkes_klinik  ".$where." ORDER BY type ASC,type_bangunan DESC  ");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
   }
}

if ( !function_exists('dropdown_sarpras_alkes_labkes')) {
   function dropdown_sarpras_alkes_labkes($type=NULL) {
        $ci = & get_instance();
		//if(!empty($type)){
		//$where="WHERE jenis_perawatan='".$type."'";
	  $select = $ci->db->query("SELECT id as id,nama_sarpras as keterangan 
FROM sarpras_alkes_labkes  ".$where." ORDER BY id ASC  ");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  //}else{
		  
	 // }
   }
}

if ( !function_exists('dropdown_sarpras_alkes_utd')) {
   function dropdown_sarpras_alkes_utd($jenis_utd=NULL) {
        $ci = & get_instance();
		//if(!empty($type)){
		//$where="WHERE jenis_perawatan='".$type."'";
		if($jenis_utd=='UTD Kelas Utama'){
			$where='WHERE utama="1"';
		}else if($jenis_utd=='UTD Kelas Madya'){
			$where='WHERE madya="1"';
		}else if($jenis_utd=='UTD Kelas Pratama'){
			$where='WHERE pratama="1"';
		}
		
	  $select = $ci->db->query("SELECT id as id,nama_sarpras as keterangan 
FROM sarpras_alkes_utd ".$where." AND deleted='0'  ORDER BY id ASC  ");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  //}else{
		  
	 // }
   }
}

if ( !function_exists('dropdown_alkes_utd')) {
   function dropdown_alkes_utd($jenis_utd=NULL) {
        $ci = & get_instance();
		//if(!empty($type)){
		//$where="WHERE jenis_perawatan='".$type."'";
		if($jenis_utd=='UTD Kelas Utama'){
			$where='WHERE utama="1"';
		}else if($jenis_utd=='UTD Kelas Madya'){
			$where='WHERE madya="1"';
		}else if($jenis_utd=='UTD Kelas Pratama'){
			$where='WHERE pratama="1"';
		}
		
	  $select = $ci->db->query("SELECT id as id,nama_alkes as keterangan 
FROM alkes_utd ".$where." AND deleted='0'   ORDER BY id ASC  ");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  //}else{
		  
	 // }
   }
}
if ( !function_exists('dropdown_alkes_nama_ruang')) {
   function dropdown_alkes_nama_ruang($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,nama_ruang as keterangan FROM alkes_utd ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_alkes_utd_sub_keterangan')) {
   function dropdown_alkes_utd_sub_keterangan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,sub_keterangan as keterangan FROM alkes_utd ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_klinik_keterangan')) {
   function dropdown_sarpras_alkes_klinik_keterangan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,keterangan as keterangan FROM sarpras_alkes_klinik ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_klinik_type_bangunan')) {
   function dropdown_sarpras_alkes_klinik_type_bangunan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,type_bangunan as keterangan FROM sarpras_alkes_klinik ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_klinik_type')) {
   function dropdown_sarpras_alkes_klinik_type($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,type as keterangan FROM sarpras_alkes_klinik ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_klinik_auth')) {
   function dropdown_sarpras_alkes_klinik_auth($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,auth as keterangan FROM sarpras_alkes_klinik ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sdm_auth')) {
   function dropdown_sdm_auth($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,auth as keterangan FROM data_sdm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}



if ( !function_exists('dropdown_sarpras_alkes_klinik_sub_keterangan')) {
   function dropdown_sarpras_alkes_klinik_sub_keterangan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,sub_keterangan as keterangan FROM sarpras_alkes_klinik ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_data_sdm_sub_keterangan')) {
   function dropdown_data_sdm_sub_keterangan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,sub_keterangan as keterangan FROM data_sdm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_data_sdm_utd_sub_keterangan')) {
   function dropdown_data_sdm_utd_sub_keterangan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,sub_keterangan as keterangan FROM data_sdm_utd ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}


if ( !function_exists('dropdown_sarpras_alkes_utd_sub_keterangan')) {
   function dropdown_sarpras_alkes_utd_sub_keterangan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,sub_keterangan as keterangan FROM sarpras_alkes_utd ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_utd_type')) {
   function dropdown_sarpras_alkes_utd_type($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,type as keterangan FROM sarpras_alkes_utd ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_utd_sub_type')) {
   function dropdown_sarpras_alkes_utd_sub_type($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,sub_type as keterangan FROM sarpras_alkes_utd ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sdm')) {
   function dropdown_sdm($type=NULL) {
        $ci = & get_instance();
		if(!empty($type)){
		$where="WHERE jenis_klinik='".$type."'";
		$select = $ci->db->query("SELECT id as id,sdm as keterangan FROM data_sdm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sdm_keterangan')) {
   function dropdown_sdm_keterangan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,keterangan as keterangan FROM data_sdm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sdm_labkes_pendidikan')) {
   function dropdown_sdm_labkes_pendidikan($id=NULL) {
        $ci = & get_instance();

		$select = $ci->db->query("SELECT id as id,pendidikan as keterangan FROM data_sdm_labkes_pendidikan ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;

	  
   }
}

if ( !function_exists('dropdown_sdm_labkes_jabatan')) {
   function dropdown_sdm_labkes_jabatan($id=NULL) {
        $ci = & get_instance();

		$select = $ci->db->query("SELECT id as id,jabatan as keterangan FROM data_sdm_labkes_jabatan ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;

	  
   }
}


if ( !function_exists('dropdown_sdm_rs')) {
   function dropdown_sdm_rs() {
        $ci = & get_instance();
	
		$where="";
		$select = $ci->db->query("SELECT id as id,sdm as keterangan FROM data_sdm_rs ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	 
	  
   }
}

if ( !function_exists('dropdown_sdm_utd')) {
   function dropdown_sdm_utd() {
        $ci = & get_instance();
	
		$where="";
		$select = $ci->db->query("SELECT id as id,sdm as keterangan FROM data_sdm_utd WHERE deleted='0' ORDER BY data_sdm_utd.urut ASC ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	 
	  
   }
}

if ( !function_exists('dropdown_tt_rs')) {
   function dropdown_tt_rs() {
        $ci = & get_instance();
	
		$where="";
		$select = $ci->db->query("SELECT id as id,tt as keterangan FROM data_tt_rs ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	 
	  
   }
}

if ( !function_exists('dropdown_pelayanan_rs')) {
   function dropdown_pelayanan_rs() {
        $ci = & get_instance();
	
		$where="";
		$select = $ci->db->query("SELECT id as id,pelayanan as keterangan FROM data_pelayanan_rs ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	 
	  
   }
}


if ( !function_exists('dropdown_rs_jenis')) {
   function dropdown_rs_jenis($id=NULL) {
        $ci = & get_instance();

		$select = $ci->db->query("SELECT id as id,keterangan as keterangan FROM master_rs_jenis ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;

	  
   }
}


if ( !function_exists('dropdown_rs_kelas')) {
   function dropdown_rs_kelas($jenis=NULL) {
        $ci = & get_instance();
		
		   if($jenis=='1'){
			$where = "WHERE 1=1 AND id NOT IN('6') ";
			}else if($jenis=='20'){
			$where = "WHERE 1=1 AND id IN('6') ";
			}else{
			$where = "WHERE id NOT IN('4','5','6') ";
			}

		$select = $ci->db->query("SELECT id as id,kelas as keterangan FROM master_rs_kelas ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;

	  
   }
}


if ( !function_exists('dropdown_rs_kepemilikan')) {
   function dropdown_rs_kepemilikan($id=NULL) {
        $ci = & get_instance();

		$select = $ci->db->query("SELECT id as id,kepemilikan as keterangan FROM master_rs_kepemilikan ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;

	  
   }
}

if ( !function_exists('dropdown_rs_pemilik_modal')) {
   function dropdown_rs_pemilik_modal($id=NULL) {
        $ci = & get_instance();

		$select = $ci->db->query("SELECT id as id,keterangan as keterangan FROM master_rs_pemilik_modal ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;

	  
   }
}



function _parseDropdown($rsData, $field_value='nama', $field_key='id',$semua=null) {
    if($semua == 'awal-kosong'){
	$data = array('' => '');
   }else{
	   if($semua)
		$data = array(9999 => 'ALL');
	   else
		$data = array(9999 => '');
   }
   
	foreach ((array) $rsData as $val) {
		if(is_array($val))
			$data[$val[$field_key]] = $val[$field_value];
		else
			$data[$val->{$field_key}] = $val->{$field_value};
	}
   
   return $data;
}

function _parseDropdownblank($rsData, $field_value='nama', $field_key='id',$semua=null,$type=null) {

   foreach ((array) $rsData as $val) {
      $data[$val->{$field_key}] = $val->{$field_value};
   }
   
   return $data;
}

function _parseDropdownnot9999($rsData, $field_value='nama', $field_key='id',$semua=null,$type=null) {
if($type!='1'){
   $data = array('' => 'Tidak');
   }
   foreach ((array) $rsData as $val) {
      $data[$val->{$field_key}] = $val->{$field_value};
   }
   
   return $data;
}

function _parseDropdownMulti($rsData, $field_value='nama', $field_key='id',$semua=null,$field_key2=null) {
    if($semua == 'awal-kosong'){
	$data = array('' => '');
   }else{
	   if($semua)
		$data = array(9999 => 'semua');
	   else
		$data = array(9999 => '');
   }
   
   foreach ((array) $rsData as $val) {
      $data[$val->{$field_key}] = $val->{$field_key2}.'&nbsp;-&nbsp;'.$val->{$field_value};
   }
   
   return $data;
}

if ( !function_exists('dropdown_jenis_klinik')) {
   function dropdown_jenis_klinik($id_prop=null) {
      return array('Utama'=>'Utama','Pratama'=>'Pratama'); //$data;
   }
}

if ( !function_exists('dropdown_jenis_klinik_all')) {
   function dropdown_jenis_klinik_all($id_prop=null) {
      return array(''=>'Semua','Utama'=>'Utama','Pratama'=>'Pratama'); //$data;
   }
}

if ( !function_exists('dropdown_jenis_perawatan')) {
   function dropdown_jenis_perawatan($id_prop=null) {
      return array('Rawat Inap'=>'Rawat Inap','Non Rawat Inap'=>'Non Rawat Inap'); //$data;
   }
}

if ( !function_exists('dropdown_jenis_perawatan_all')) {
   function dropdown_jenis_perawatan_all($id_prop=null) {
      return array(''=>'Semua','Rawat Inap'=>'Rawat Inap','Non Rawat Inap'=>'Non Rawat Inap'); //$data;
   }
}

if ( !function_exists('dropdown_jenis_modal_usaha')) {
   function dropdown_jenis_modal_usaha($id_prop=null) {
      return array('Penanaman Modal Dalam Negeri'=>'Penanaman Modal Dalam Negeri','Penanaman Modal Asing'=>'Penanaman Modal Asing','Pemerintah'=>'Pemerintah'); //$data;
   }
}

if ( !function_exists('dropdown_pemilik')) {
   function dropdown_pemilik($id_prop=null) {
      return array('Kementerian/Lembaga'=>'Kementerian/Lembaga','TNI'=>'TNI','POLRI'=>'POLRI','Pemerintah Daerah'=>'Pemerintah Daerah','Masyarakat/Swasta'=>'Masyarakat/Swasta'); //$data;
   }
}



/* if ( !function_exists('dropdown_pemilik')) {
   function dropdown_pemilik($id_prop=null) {
      return array('Perorangan'=>'Perorangan','Pemerintah'=>'Pemerintah','Perusahaan/Badan hukum'=>'Perusahaan/Badan hukum','Yayasan'=>'Yayasan','TNI'=>'TNI','POLRI'=>'POLRI'); //$data;
   }
} */

if ( !function_exists('dropdown_pemilik_labkes')) {
   function dropdown_pemilik_labkes($id_prop=null) {
      return array('Pemerintah Pusat'=>'Pemerintah Pusat','Pemerintah Daerah Provinsi'=>'Pemerintah Daerah Provinsi','Pemerintah Daerah Kabupaten/kota'=>'Pemerintah Daerah Kabupaten/kota','Masyarakat/Swasta'=>'Masyarakat/Swasta'); //$data;
   }
}
if ( !function_exists('dropdown_jenis_pelayanan')) {
   function dropdown_jenis_pelayanan($id_prop=null) {
      return array('Laboratorium Kesehatan'=>'Laboratorium Kesehatan','Laboratorium Sel Punca'=>'Laboratorium Sel Punca','Bank Jaringan'=>'Bank Jaringan'); //$data;
   }
}



if ( !function_exists('dropdown_jenis_lab')) {
   function dropdown_jenis_lab($jenis_pelayanan=NULL) {
        $ci = & get_instance();
		
			if(!empty($jenis_pelayanan)){
			$where = "WHERE 1=1 AND parent LIKE '%".urldecode($jenis_pelayanan)."%' ";
			}else{
			$where = "WHERE 1=1  ";
			}

		$select = $ci->db->query("SELECT kode_jenis_pelayanan as id,nama_jenis_pelayanan as keterangan FROM master_labkes_jenis_pelayanan ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;

	  
   }
}

if ( !function_exists('dropdown_pelayanan_lain')) {
   function dropdown_pelayanan_lain($id_prop=null) {
      return array('Laboratorium Kesehatan Masyarakat'=>'Laboratorium Kesehatan Masyarakat','Pengolahan Sel dan Sel Punca'=>'Pengolahan Sel dan Sel Punca','Penyimpanan Sel dan/atau Jaringan'=>'Penyimpanan Sel dan/atau Jaringan'); //$data;
   }
}

if ( !function_exists('dropdown_lab_medis_khusus')) {
   function dropdown_lab_medis_khusus($id_prop=null) {
      return array('Khusus Patologi Klinik'=>'Khusus Patologi Klinik','Mikrobiologi Klinik'=>'Mikrobiologi Klinik','Parasitologi Klinik'=>'Parasitologi Klinik','Patologi Anatomi'=>'Patologi Anatomi'); //$data;
   }
}

if ( !function_exists('dropdown_status_akreditasi')) {
   function dropdown_status_akreditasi($id_prop=null) {
      return array(''=>'Belum Di Isi','Sudah'=>'Sudah','Belum'=>'Belum'); //$data;
   }
}

if ( !function_exists('dropdown_bentuk_pelayanan')) {
   function dropdown_bentuk_pelayanan($id_prop=null) {
      return array('Pengambilan spesimen  klinis secara mobile/bergerak'=>'Pengambilan spesimen  klinis secara mobile/bergerak','Penerimaan pemeriksaan spesimen klinis dari luar negeri'=>'Penerimaan pemeriksaan spesimen klinis dari luar negeri','Telemedicine'=>'Telemedicine'); //$data;
   }
}

if ( !function_exists('dropdown_bentuk_lab')) {
   function dropdown_bentuk_lab($id_prop=null) {
      //return array('Mandiri'=>'Mandiri','Terintegrasi (RS, Klinik, Puskesmas, Balai Kesehatan)'=>'Terintegrasi (RS, Klinik, Puskesmas, Balai Kesehatan)'); //$data;
	  return array('Mandiri'=>'Mandiri');
   }
}

if ( !function_exists('dropdown_persalinan')) {
   function dropdown_persalinan() {
      return array('Tidak'=>'Tidak','Ya'=>'Ya'); //$data;
   }
}

if ( !function_exists('dropdown_persalinan_all')) {
   function dropdown_persalinan_all() {
      return array(''=>'Semua','Tidak'=>'Tidak','Ya'=>'Ya'); //$data;
   }
}

if ( !function_exists('dropdown_type_sarpras')) {
   function dropdown_type_sarpras() {
      return array('Sarana'=>'Sarana','Prasarana'=>'Prasarana'); //$data;
   }
}


if ( !function_exists('dropdown_type_bangunan_sarpras')) {
   function dropdown_type_bangunan_sarpras() {
      return array(''=>'','Bangunan Klinik Rawat Inap'=>'Bangunan Klinik Rawat Inap','Bangunan Klinik Non Rawat Inap'=>'Bangunan Klinik Non Rawat Inap'); //$data;
   }
}

if ( !function_exists('dropdown_auth')) {
   function dropdown_auth() {
      return array('wajib ada'=>'wajib ada','tidak wajib ada'=>'tidak wajib ada'); //$data;
   }
}

if ( !function_exists('dropdown_sub_keterangan')) {
   function dropdown_sub_keterangan() {
      return array('Tidak Ada'=>'Tidak Ada','Ada'=>'Ada'); //$data;
   }
}


if ( !function_exists('dropdown_jenis_kelamin')) {
   function dropdown_jenis_kelamin() {
      return array('L'=>'Laki-laki','P'=>'Perempuan'); //$data;
   }
}

if ( !function_exists('dropdown_status_login')) {
   function dropdown_status_login() {
      return array('0'=>'Belum Di Validasi','1'=>'Sudah Di Validasi, Belum Di Aktivasi User','2'=>'Sudah Di Validasi, Sudah Di Aktivasi User'); //$data;
   }
}

if ( !function_exists('dropdown_status_login_dfo')) {
   function dropdown_status_login_dfo() {
      return array('0'=>'Belum Di Validasi','1'=>'Sudah Di Validasi -  Aktif','2'=>'Sudah Di Validasi - Tidak Aktif'); //$data;
   }
}

if ( !function_exists('dropdown_fungsional_labkes')) {
   function dropdown_fungsional_labkes() {
      return array('Dokter Spesialis Mikrobiologi  Klinik'=>'Dokter Spesialis Mikrobiologi  Klinik','Dokter Spesialis Patologi Klinik'=>'Dokter Spesialis Patologi Klinik','Dokter Spesialis Patologi Anatomi'=>'Dokter Spesialis Patologi Anatomi','Dokter Spesialis Parasitologi Klinik'=>'Dokter Spesialis Parasitologi Klinik','Tenaga Ahli Teknis Laboratorium Medik'=>'Tenaga Ahli Teknis Laboratorium Medik','S1 Biologi/tenaga non kesehatan lain'=>'S1 Biologi/tenaga non kesehatan lain','Dokter Spesialis Lainnya'=>'Dokter Spesialis Lainnya','Tidak ada dokter spesialis'=>'Tidak ada dokter spesialis'); //$data;
   }
}

if ( !function_exists('dropdown_jenis_pemeriksaan')) {
   function dropdown_jenis_pemeriksaan() {
      return array('Urinalisis'=>'Urinalisis','Tinja'=>'Tinja','Hematologi'=>'Hematologi','Hemostatis'=>'Hemostatis','Kimia klinik'=>'Kimia klinik','Imunologi'=>'Imunologi','Mikrobiologi'=>'Mikrobiologi','Pemeriksaan dan Identifikasi Kuman Aerob'=>'Pemeriksaan dan Identifikasi Kuman Aerob','Lainnya'=>'Lainnya'); //$data;
   }
}

if ( !function_exists('dropdown_pemeriksaan_tambahan')) {
   function dropdown_pemeriksaan_tambahan() {
      return array('RT-PCR'=>'RT-PCR','Swab Antigen'=>'Swab Antigen','Rapid Anti Body'=>'Rapid Anti Body','Pemeriksaan Covid-19'=>'Pemeriksaan Covid-19'); //$data;
   }
}

if ( !function_exists('dropdown_jenis_pemeriksaan_type')) {
   function dropdown_jenis_pemeriksaan_type() {
      return array(''=>'','Pelayanan Patologi Klinik'=>'Pelayanan Patologi Klinik','Pelayanan Mikrobiologi Klinik'=>'Pelayanan Mikrobiologi Klinik','Pelayanan Parasitologi Klinik'=>'Pelayanan Parasitologi Klinik','Pelayanan Patologi Anatomik'=>'Pelayanan Patologi Anatomik','Pengolahan sel/sel punca dan penyimpanan sel/jaringan'=>'Pengolahan sel/sel punca dan penyimpanan sel/jaringan'); //$data;
   }
}

if ( !function_exists('dropdown_type_user')) {
   function dropdown_type_user() {
      return array(''=>'','Klinik'=>'Klinik','Labkes'=>'Labkes','RS'=>'RS','UTD'=>'UTD','Praktik Mandiri'=>'Praktik Mandiri','Puskesmas'=>'Puskesmas'); //$data;
   }
}

if ( !function_exists('dropdown_type_user_all')) {
   function dropdown_type_user_all() {
      return array(''=>'','Admin'=>'Admin','Klinik'=>'Klinik','Labkes'=>'Labkes','RS'=>'RS','UTD'=>'UTD'); //$data;
   }
}

if ( !function_exists('dropdown_status_kepemilikan_utd')) {
   function dropdown_status_kepemilikan_utd() {
      return array(''=>'','Unit Pelayanan RS'=>'Unit Pelayanan RS','UTD PMI'=>'UTD PMI','UPTD Pemerintah Daerah'=>'UPTD Pemerintah Daerah','UPT Pemerintah'=>'UPT Pemerintah'); //$data;
   }
}

if ( !function_exists('dropdown_jenis_utd')) {
   function dropdown_jenis_utd() {
      return array(''=>'','UTD Kelas Utama'=>'UTD Kelas Utama','UTD Kelas Madya'=>'UTD Kelas Madya','UTD Kelas Pratama'=>'UTD Kelas Pratama'); //$data;
   }
}

if ( !function_exists('dropdown_status_ada_tidak')) {
   function dropdown_status_ada_tidak() {
      return array('0'=>'Tidak Ada','1'=>'Ada'); //$data;
   }
}


if ( !function_exists('dropdown_type_sarpras_alkes_utd')) {
   function dropdown_type_sarpras_alkes_utd() {
      return array('KENDARAAN'=>'KENDARAAN','PRASARANA & SARANA'=>'PRASARANA & SARANA','PRASARANA'=>'PRASARANA','SARANA'=>'SARANA','PERSYARATAN RUANG BANGUNAN MINIMAL'=>'PERSYARATAN RUANG BANGUNAN MINIMAL'); //$data;
   }
}

if ( !function_exists('dropdown_sub_type_sarpras_alkes_utd')) {
   function dropdown_sub_type_sarpras_alkes_utd() {
      return array('AREA PENUNJANG'=>'AREA PENUNJANG','AREA PERKANTORAN'=>'AREA PERKANTORAN','AREA LABORATORIUM'=>'AREA LABORATORIUM','AREA PELAYANAN DONOR DARAH'=>'AREA PELAYANAN DONOR DARAH','AREA PENERIMAAN'=>'AREA PENERIMAAN'); //$data;
   }
}

if ( !function_exists('dropdown_akreditasi_utd')) {
   function dropdown_akreditasi_utd() {
      return array('Belum Akreditasi'=>'Belum Akreditasi','Akreditasi UTD'=>'Akreditasi UTD','Akreditasi RS'=>'Akreditasi RS'); //$data;
   }
}

if ( !function_exists('dropdown_cpob_utd')) {
   function dropdown_cpob_utd() {
      return array('Belum'=>'Belum','Sudah'=>'Sudah'); //$data;
   }
}

if ( !function_exists('dropdown_sip_ke_brp')) {
   function dropdown_sip_ke_brp($id_prop=null) {
      return array('1'=>'1','2'=>'2','3'=>'3'); //$data;
   }
}

if ( !function_exists('dropdown_hari_praktik')) {
   function dropdown_hari_praktik($id_prop=null) {
      return array('Senin'=>'Senin','Selasa'=>'Selasa','Rabu'=>'Rabu','Kamis'=>'Kamis','Jumat'=>'Jumat','Sabtu'=>'Sabtu','Minggu'=>'Minggu'); //$data;
   }
}

if ( !function_exists('dropdown_kepemilikan_tempat')) {
   function dropdown_kepemilikan_tempat() {
      return array('Sewa'=>'Sewa','Milik Pribadi'=>'Milik Pribadi'); //$data;
   }
}

if ( !function_exists('dropdown_sarpras_alkes_pm')) {
   function dropdown_sarpras_alkes_pm($type=NULL) {
        $ci = & get_instance();
		if(!empty($type)){
		$where="WHERE id_kategori='".$type."'";
	  $select = $ci->db->query("SELECT id as id,sarpras_alkes as keterangan 
FROM sarpras_alkes_pm  ".$where." ORDER BY type ASC  ");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
   }
}

if ( !function_exists('dropdown_sarpras_alkes_pm_type')) {
   function dropdown_sarpras_alkes_pm_type($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,type as keterangan FROM sarpras_alkes_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_pm2')) {
   function dropdown_sarpras_alkes_pm2($type=NULL) {
        $ci = & get_instance();
		if(!empty($type)){
		$where="WHERE id_kategori='".$type."'";
	  $select = $ci->db->query("SELECT id as id,nama_elemen as keterangan 
FROM alkes_obat_pm  ".$where." ORDER BY type ASC  ");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
   }
}

if ( !function_exists('dropdown_sarpras_alkes_pm_type2')) {
   function dropdown_sarpras_alkes_pm_type2($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,type as keterangan FROM alkes_obat_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}


if ( !function_exists('dropdown_sarpras_alkes_pm_keterangan')) {
   function dropdown_sarpras_alkes_pm_keterangan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,keterangan as keterangan FROM sarpras_alkes_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_pm_type_bangunan')) {
   function dropdown_sarpras_alkes_pm_type_bangunan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,type_bangunan as keterangan FROM sarpras_alkes_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_pm_auth')) {
   function dropdown_sarpras_alkes_pm_auth($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,auth as keterangan FROM sarpras_alkes_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sarpras_alkes_pm_sub_keterangan')) {
   function dropdown_sarpras_alkes_pm_sub_keterangan($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,sub_keterangan as keterangan FROM sarpras_alkes_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sdm_pm')) {
   function dropdown_sdm_pm($type=NULL) {
        $ci = & get_instance();
		if(!empty($type)){
		$where="WHERE id_kategori='".$type."'";
		$select = $ci->db->query("SELECT id as id,sdm as keterangan FROM data_sdm_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sdm_auth_pm')) {
   function dropdown_sdm_auth_pm($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,auth as keterangan FROM data_sdm_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sdm_max_pm')) {
   function dropdown_sdm_max_pm($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,max as keterangan FROM data_sdm_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_data_sdm_sub_keterangan_pm')) {
   function dropdown_data_sdm_sub_keterangan_pm($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,sub_keterangan as keterangan FROM data_sdm_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_sdm_keterangan_pm')) {
   function dropdown_sdm_keterangan_pm($id=NULL) {
        $ci = & get_instance();
		if(!empty($id)){
		$where="WHERE id='".$id."'";
		$select = $ci->db->query("SELECT id as id,keterangan as keterangan FROM data_sdm_pm ".$where." ");
        $rsData = $select->result();		 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  }else{
		  
	  }
	  
   }
}

if ( !function_exists('dropdown_pelayanan_klinik')) {
   function dropdown_pelayanan_klinik($jenis_klinik=NULL) {
        $ci = & get_instance();
		//if(!empty($type)){
		$where="WHERE jenis_klinik='".$jenis_klinik."'";
		
		
	  $select = $ci->db->query("SELECT id as id,nama_pelayanan_klinik as keterangan 
FROM master_klinik_pelayanan_klinik ".$where." AND deleted='0'  ORDER BY id ASC  ");
      $rsData = $select->result();
	 
      return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
	  //}else{
		  
	 // }
   }
}

if ( !function_exists('dropdown_alkes_pm')) {
   function dropdown_alkes_pm($type=NULL) {
         $ci = & get_instance();
         if(!empty($type)){
         $where="WHERE id_kategori='".$type."'";
      $select = $ci->db->query("SELECT id as id,nama_elemen as keterangan 
   FROM alkes_obat_pm  ".$where."   ");
         $rsData = $select->result();
      
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
         
      }
   }
}

if ( !function_exists('dropdown_alkes_pm_type')) {
   function dropdown_alkes_pm_type($id=NULL) {
         $ci = & get_instance();
         if(!empty($id)){
         $where="WHERE id='".$id."'";
         $select = $ci->db->query("SELECT id as id,type as keterangan FROM alkes_obat_pm ".$where." ");
         $rsData = $select->result();		 
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
         
      }
      
   }
}

if ( !function_exists('dropdown_alkes_pm_label_nilai_satu')) {
   function dropdown_alkes_pm_label_nilai_satu($id=NULL) {
      $ci = & get_instance();
        if(!empty($id)){
        $where="WHERE id='".$id."'";
        $select = $ci->db->query("SELECT id as id,label_nilai_satu as keterangan FROM alkes_obat_pm ".$where." ");
         $rsData = $select->result();		 
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
      }
   }
}

if ( !function_exists('dropdown_alkes_pm_label_nilai_dua')) {
   function dropdown_alkes_pm_label_nilai_dua($id=NULL) {
      $ci = & get_instance();
        if(!empty($id)){
        $where="WHERE id='".$id."'";
        $select = $ci->db->query("SELECT id as id,label_nilai_dua as keterangan FROM alkes_obat_pm ".$where." ");
         $rsData = $select->result();		 
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
      }
   }
}

if ( !function_exists('dropdown_alkes_pm_label_nilai_tiga')) {
   function dropdown_alkes_pm_label_nilai_tiga($id=NULL) {
      $ci = & get_instance();
        if(!empty($id)){
        $where="WHERE id='".$id."'";
        $select = $ci->db->query("SELECT id as id,label_nilai_tiga as keterangan FROM alkes_obat_pm ".$where." ");
         $rsData = $select->result();		 
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
      }
   }
}

if ( !function_exists('dropdown_alkes_pm_auth')) {
   function dropdown_alkes_pm_auth($id=NULL) {
         $ci = & get_instance();
         if(!empty($id)){
         $where="WHERE id='".$id."'";
         $select = $ci->db->query("SELECT id as id,auth as keterangan FROM alkes_obat_pm ".$where." ");
         $rsData = $select->result();		 
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
         
      }
      
   }
}

if ( !function_exists('dropdown_obat_pm')) {
   function dropdown_obat_pm($type=NULL) {
         $ci = & get_instance();
         if(!empty($type)){
         $where="WHERE id_kategori='".$type."'";
      $select = $ci->db->query("SELECT id as id,nama_elemen as keterangan 
   FROM obat_pm  ".$where."   ");
         $rsData = $select->result();
      
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
         
      }
   }
}

if ( !function_exists('dropdown_obat_pm_auth')) {
   function dropdown_obat_pm_auth($id=NULL) {
         $ci = & get_instance();
         if(!empty($id)){
         $where="WHERE id='".$id."'";
         $select = $ci->db->query("SELECT id as id,auth as keterangan FROM obat_pm ".$where." ");
         $rsData = $select->result();		 
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
         
      }
      
   }
}

if ( !function_exists('dropdown_obat_pm_label_nilai_satu')) {
   function dropdown_obat_pm_label_nilai_satu($id=NULL) {
      $ci = & get_instance();
        if(!empty($id)){
        $where="WHERE id='".$id."'";
        $select = $ci->db->query("SELECT id as id,label_nilai_satu as keterangan FROM obat_pm ".$where." ");
         $rsData = $select->result();		 
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
      }
   }
}

if ( !function_exists('dropdown_obat_pm_keterangan')) {
   function dropdown_obat_pm_keterangan($id=NULL) {
      $ci = & get_instance();
        if(!empty($id)){
        $where="WHERE id='".$id."'";
        $select = $ci->db->query("SELECT id as id,keterangan as keterangan FROM obat_pm ".$where." ");
         $rsData = $select->result();		 
         return _parseDropdownblank($rsData, 'keterangan','id','awal-kosong'); //$data;
      }else{
      }
   }
}

if ( !function_exists('dropdown_rme')) {
    function dropdown_rme() {
       $ci = & get_instance();
        $select = $ci->db->query("SELECT id as id,nama as keterangan FROM m_status_rme ");
       $rsData = $select->result();
       return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
    }
 }

if ( !function_exists('dropdown_jenis_vendor_rme')) {
   function dropdown_jenis_vendor_rme() {
      $ci = & get_instance();
       $select = $ci->db->query("SELECT id as id,nama as keterangan FROM m_jenis_vendor ");
      $rsData = $select->result();
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_sumber_air')) {
   function dropdown_sumber_air() {
      $ci = & get_instance();
       $select = $ci->db->query("SELECT id as id,nama as keterangan FROM master_sumber_air ");
      $rsData = $select->result();
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_sumber_listrik')) {
   function dropdown_sumber_listrik() {
      $ci = & get_instance();
       $select = $ci->db->query("SELECT id as id,nama as keterangan FROM master_sumber_listrik ");
      $rsData = $select->result();
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_nama_obat')) {
   function dropdown_nama_obat() {
      $ci = & get_instance();
       $select = $ci->db->query("SELECT id as id,nama as keterangan FROM m_obat ");
      $rsData = $select->result();
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_jenis_sediaan')) {
   function dropdown_jenis_sediaan() {
      $ci = & get_instance();
       $select = $ci->db->query("SELECT id as id,nama as keterangan FROM m_jenis_sediaan ");
      $rsData = $select->result();
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}

if ( !function_exists('dropdown_sumber_pembelian')) {
   function dropdown_sumber_pembelian() {
      $ci = & get_instance();
       $select = $ci->db->query("SELECT id as id,nama as keterangan FROM m_sumber_pembelian_obat ");
      $rsData = $select->result();
      return _parseDropdown($rsData, 'keterangan','id','awal-kosong'); //$data;
   }
}