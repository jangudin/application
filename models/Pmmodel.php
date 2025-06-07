<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pmmodel extends CI_Model{	

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


	function getlistpengajuanpm($id_kategori=null,$id_prov=NULL,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where =' AND registrasi_user.id_kategori_pm IN (4,5,6,7)';
	} else if($id_kategori=='2'){
		$where ='AND LEFT(trans_final.id_link, 2)="'.$id_prov.'" AND registrasi_user.id_kategori_pm IN (4,5,6,7)';
	} else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori_pm IN (4,5,6,7)';
	}
	

		$sql = $this->db->query("SELECT registrasi_user.*,kategori_pm.kategori_user,kategori_pm.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_pm.nama_pm,data_pm.alamat_faskes,data_pm.status_pm
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		INNER JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		LEFT JOIN kategori_pm ON registrasi_user.id_kategori_pm=kategori_pm.id 
		WHERE trans_final.final='1' AND trans_final.kode_faskes!='' AND registrasi_user.id IS NOT NULL ".$where." ");
		return $sql->result_array();
	}

	function getlistpengajuanbelumvalidasipm($id_kategori=null,$id_prov=NULL,$id_kota=NULL)
	{
		if($id_kategori=='1'){
			$where =' AND registrasi_user.id_kategori_pm IN (4,5,6,7)';
		} else if($id_kategori=='2'){
			$where ='AND LEFT(trans_final.id_link, 2)="'.$id_prov.'" AND registrasi_user.id_kategori_pm IN (4,5,6,7)';
		} else{
			$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori_pm IN (4,5,6,7)';
		}
	// echo '<br><br><br>';
"SELECT registrasi_user.*,kategori_pm.kategori_user,kategori_pm.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_pm.nama_pm,data_pm.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		LEFT JOIN kategori_pm ON registrasi_user.id_kategori_pm=kategori_pm.id 
		WHERE trans_final.final='1' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL) AND registrasi_user.id IS NOT NULL ".$where."  ";
		
		$sql = $this->db->query("SELECT registrasi_user.*,kategori_pm.kategori_user,kategori_pm.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_pm.nama_pm,data_pm.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		LEFT JOIN kategori_pm ON registrasi_user.id_kategori_pm=kategori_pm.id 
		WHERE trans_final.final='1' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL) AND registrasi_user.id IS NOT NULL ".$where."  ");
		return $sql->result_array();
	}

	function getlistpengajuanbelumvalidasiperbaikanpm($id_kategori=null,$id_prov=NULL,$id_kota=NULL)
	{
		if($id_kategori=='1'){
			$where =' AND registrasi_user.id_kategori_pm IN (4,5,6,7)';
		} else if($id_kategori=='2'){
			$where ='AND LEFT(trans_final.id_link, 2)="'.$id_prov.'" AND registrasi_user.id_kategori_pm IN (4,5,6,7)';
		} else{
			$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori_pm IN (4,5,6,7)';
		}


		$sql = $this->db->query("SELECT registrasi_user.*,kategori_pm.kategori_user,kategori_pm.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_pm.nama_pm,data_pm.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		LEFT JOIN kategori_pm ON registrasi_user.id_kategori_pm=kategori_pm.id 
		WHERE trans_final.catatan !='' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL) AND registrasi_user.id IS NOT NULL ".$where." ");
		return $sql->result_array();
	}

    function findNoFaskes($id_link=NULL,$kategori=NULL) {	
		//$kategori='5';
		$kode_umum='01';
	
		$sql = $this->db->query("SELECT
        MAX(
        RIGHT ( kode_faskes, 5 )) AS kode_faskes 
    FROM
        trans_final
        LEFT JOIN registrasi_user r ON r.id = trans_final.id_faskes 
    WHERE
        SUBSTRING( kode_faskes, 1, 4 )= '".$id_link."'
        AND r.id_kategori=9
        #AND LENGTH( kode_faskes )= 11");
        
		if ($sql->num_rows() > 0) {
			$rs = $sql->result_array();
			$str = $rs[0]['kode_faskes'] + 1;
			return $id_link. $kode_umum . str_pad($str, 5, "0", STR_PAD_LEFT);
		} else {
			return $id_link. $kode_umum . str_pad('1', 5, "0", STR_PAD_LEFT);
		}
	}
	
	function getdatalabkes($user_id=NULL)
	{
	
	 
			$raw_user_id=" and data_labkes.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT data_labkes.*,propinsi.kode_regional FROM data_labkes  LEFT JOIN propinsi ON data_labkes.id_prov = propinsi.id_prop WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}

    function getbylistpendaftaran($id=NULL)
	{
	
		     
		
		$sql = $this->db->query("SELECT registrasi_user.*,kategori_pm.kategori_user,kategori_pm.keterangan,propinsi.nama_prop,kota.nama_kota,data_pm.nama_pm,kategori_pm.jenis_satker
		FROM registrasi_user LEFT JOIN kategori_pm ON kategori_pm.id=registrasi_user.id_kategori 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov_pm 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		LEFT JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		WHERE 1=1  AND registrasi_user.id='".$id."'  ");
		return $sql->result_array();
	}

	function getDaftarNIK($id=NULL){
		$sql = $this->db->query("SELECT
		a.id_faskes,
		b.no_ktp
	FROM
		trans_final a
		INNER JOIN data_pm b ON a.id_faskes = b.id_faskes
		LEFT JOIN propinsi c ON c.id_prop = b.id_prov_pm
		LEFT JOIN kota d ON d.id_kota = b.id_kota_pm
		LEFT JOIN kecamatan e ON e.id_camat = b.id_camat_pm
		JOIN kategori_pm f ON f.id = b.id_kategori 
	WHERE
		a.kode_faskes IS NOT NULL 
		AND a.kode_faskes != '' 
		AND b.id_kategori IN (4,5)
		AND b.id_prov_pm IN (01)
		AND b.no_ktp IS NOT NULL
		AND b.no_ktp != '' 
		AND b.no_ktp != 0
		");
		return $sql->result_array();
	}

	


    function getrekap_data($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori_pm = '".$id_kategori."' AND registrasi_user.id_kategori = '9' ";
		}else{
			$kategori=" AND registrasi_user.id_kategori_pm IN (4,5,6,7) AND registrasi_user.id_kategori = '9' ";
		}
        
        if($id_prov != 9999){
            $trans =" AND trans_final.kode_faskes = 0 ";
        }else{
            $trans =" AND trans_final.kode_faskes != '' ";
        }
		

		$sql = $this->db->query("SELECT registrasi_user.*,kategori_pm.kategori_user,kategori_pm.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_pm.nama_pm,data_pm.alamat_faskes,data_pm.latitude,data_pm.longitude,data_pm.alamat_faskes,propinsi.nama_prop,kota.nama_kota, data_pm.no_telp,data_pm.no_hp,
		IF(data_pm.dokumen_komitmen is NOT NULL,'Ada', NULL) AS dokumen_komitmen, data_pm.status_pm AS status_aktif,
		CONCAT('https://registrasifasyankes.kemkes.go.id/assets/uploads/berkas_registrasi/',data_pm.dokumen_komitmen) as url_dokumen_komitmen,
		data_pm.email AS email_pm
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		INNER JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		LEFT JOIN kategori_pm ON registrasi_user.id_kategori_pm=kategori_pm.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		WHERE 1=1 ".$prov.$kota.$kategori." ORDER BY trans_final.kode_faskes DESC
		");
        
        //echo $this->db->last_query();
       
		return $sql->result_array();
	}

	function get_review($user_id=null,$bulan=NULL,$tahun=NULL)
	{
	
		
		if(!empty($bulan) && $bulan !=9999){
			$where_bulan=" AND MONTH ( d.review_time ) = '".$bulan."'";
		}else{
			$where_bulan="";
		}
		
		$sql = $this->db->query("SELECT
		a.qustion_id,
		a.question_description,
		(
		SELECT
			COUNT( qustion_id ) 
		FROM
			review_detail c
			JOIN review d ON c.review_id = d.id 
		WHERE
			c.qustion_id = a.qustion_id 
			AND c.answer = 'Ya' 
			AND d.fasyankes_code = b.fasyankes_code 
			".$where_bulan." AND YEAR ( d.review_time ) = ".$tahun."
			) ya,
			(
			SELECT
				COUNT( qustion_id ) 
			FROM
				review_detail c
				JOIN review d ON c.review_id = d.id 
			WHERE
				c.qustion_id = a.qustion_id 
				AND c.answer = 'Tidak' 
				AND d.fasyankes_code = b.fasyankes_code 
				".$where_bulan." AND YEAR ( d.review_time ) = ".$tahun."
			) tidak 
		FROM
			review_detail a
			JOIN review b ON a.review_id = b.id
			JOIN trans_final z ON b.fasyankes_code = z.kode_faskes 
		WHERE
			1=1
			".$where_bulan." AND YEAR ( d.review_time ) = ".$tahun."
			AND z.id_faskes = ".$user_id."
		GROUP BY
			a.qustion_id,
			a.question_description
			");
		return $sql->result_array();
	}

	function get_satu_sehat_terkoneksi($id_prov=null,$id_kota=NULL,$kode_faskes=NULL,$quartal=NULL,$tahun=NULL,$terkoneksi=NULL)
	{
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND provinsi = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND kabkota = '".$id_kota."'";
		}else{
			$kota="";
		}

		if(!empty($kode_faskes)){
			$kode_faskes=" AND kode_kmk = '".$kode_faskes."'";
		}else{
			$kode_faskes="";
		}

		if(!empty($quartal) && !empty($tahun)){
			$quartal=" AND quartal = '".$quartal." ".$tahun."'";
		}else{
			$quartal="";
		}

		if(!empty($terkoneksi)){
			$terkoneksi=" AND is_terkoneksi = '".$terkoneksi."'";
		}else{
			$terkoneksi="";
		}

		$sql = $this->db->query("SELECT
					* 
				FROM
					terkoneksi_satusehat_by_quartal 
				WHERE
					1 = 1" .$prov.$kota.$kode_faskes.$quartal.$terkoneksi
					
			);
		return $sql->result_array();


	}
		
}

