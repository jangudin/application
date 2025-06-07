<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Akreditasipmmodel extends CI_Model{	

	public function __construct()
    {
        parent::__construct();
    }
	
	function select_data($table,$where){		
        $mutu = $this->load->database('inm', TRUE);
		return $mutu->get_where($table,$where);
	}
	
	function input_data($table,$data){
        $mutu = $this->load->database('inm', TRUE);
		return $mutu->insert($table,$data);
	}
	
	function edit_data($table,$where,$data){		
        $mutu = $this->load->database('inm', TRUE);
        $mutu->where($where);
        return $mutu->update($table,$data);
	}
	
	function delete_data($table,$where){		
        $mutu = $this->load->database('inm', TRUE);
	    $mutu->delete($table, $where); 
	}
	
    function get_data_dasar($user_id=null)
	{
        $sql = $this->db->query("SELECT
                nama_pm AS nama,
                no_sip,
            IF
                ( dokumen_sip IS NULL, null, CONCAT('https://registrasifasyankes.kemkes.go.id/assets/uploads/berkas_sip/', dokumen_sip )) AS url_dokumen_sip,
                pelayanan_yang_diberikan,
                pelayanan_yang_diberikan_lainnya,
                pelatihan_program_prioritas,
                pelatihan_program_prioritas_lainnya,
                jam_praktik_senin_pagi,
                jam_praktik_senin_sore,
                jam_praktik_selasa_pagi,
                jam_praktik_selasa_sore,
                jam_praktik_rabu_pagi,
                jam_praktik_rabu_sore,
                jam_praktik_kamis_pagi,
                jam_praktik_kamis_sore,
                jam_praktik_jumat_pagi,
                jam_praktik_jumat_sore,
                jam_praktik_sabtu_pagi,
                jam_praktik_sabtu_sore,
                jam_praktik_minggu_pagi,
                jam_praktik_minggu_sore 
            FROM
                dbfaskes.data_pm
            WHERE
                id_faskes=".$user_id);
		return $sql->result_array();
	}

	function get_data_dokumen($user_id=null)
	{
        $sql = $this->db->query("SELECT
            gambar AS jenis_dokumen,
            url_full AS url 
        FROM
            t_img_faskes
        WHERE
            id_faskes= ".$user_id);
		return $sql->result_array();
	}

    function get_data_alkes($user_id=null)
	{
        $sql = $this->db->query("SELECT
            b.type AS tipe,
            b.nama_elemen,
            b.label_nilai_satu,
            a.is_checked AS nilai_satu,
            b.label_nilai_dua,
            a.nilai_dua,
            b.label_nilai_tiga,
            a.nilai_tiga
            
        FROM
            trans_alkes_pm a
            JOIN alkes_obat_pm b ON a.id_alkes_obat = b.id 
        WHERE
        a.id_faskes= ".$user_id);
		return $sql->result_array();
	}

    function get_pembiayaan($user_id=null,$bulan=NULL,$tahun=NULL)
	{
        $sql = $this->db->query("SELECT
                umum,
                ( umum / jumlah * 100 ) AS persen_umum,
                jkn,
                ( jkn / jumlah * 100 ) AS persen_jkn,
                asuransi_lainnya,
                ( asuransi_lainnya / jumlah * 100 ) AS persen_asuransi_lainnya,
                jumlah,
                ( jumlah / jumlah * 100 ) AS persen_jumlah,
                bulan,
                tahun 
            FROM
                pembiayaan_kesehatan_pasien 
            WHERE
                id_faskes = ".$user_id."
                AND bulan = ".$bulan."
                AND tahun = ".$tahun);
		return $sql->result_array();
	}

    function get_prognas($user_id=null,$bulan=NULL,$tahun=NULL)
	{
        $sql = $this->db->query("SELECT
                stunting_wasting,
                ( stunting_wasting / jumlah_pasien_satu_bulan * 100 ) AS persen_stunting_wasting,
                tuberculosis,
                ( tuberculosis / jumlah_pasien_satu_bulan * 100 ) AS persen_tuberculosis,
                hipertensi,
                ( hipertensi / jumlah_pasien_satu_bulan * 100 ) AS persen_hipertensi,
                diabetes_melitus,
                ( diabetes_melitus / jumlah_pasien_satu_bulan * 100 ) AS persen_diabetes_melitus,
                kehamilan_risiko_tinggi,
                ( kehamilan_risiko_tinggi / jumlah_pasien_satu_bulan * 100 ) AS persen_kehamilan_risiko_tinggi,
                imunisasi,
                ( imunisasi / jumlah_pasien_satu_bulan * 100 ) AS persen_imunisasi,
                jumlah_pasien_satu_bulan,
                ( jumlah_pasien_satu_bulan / jumlah_pasien_satu_bulan * 100 ) AS persen_jumlah,
                bulan,
                tahun 
            FROM
                pelaporan_prognas 
            WHERE
                id_faskes = ".$user_id."
                AND bulan = ".$bulan."
                AND tahun = ".$tahun);
		return $sql->result_array();
	}

    function get_hipertensi($user_id=null,$bulan=NULL,$tahun=NULL)
	{
        $sql = $this->db->query("SELECT
                pasien_patuh,
                jumlah_pasien_hipertensi,
                persentase,
                bulan,
                tahun 
            FROM
                kepatuhan_kunjungan_pasien_hipertensi 
            WHERE
                id_faskes = ".$user_id."
                AND bulan = ".$bulan."
                AND tahun = ".$tahun);
		return $sql->result_array();
	}

    function get_ohis($user_id=null,$bulan=NULL,$tahun=NULL)
	{
        $sql = $this->db->query("SELECT
                pasien_gigi_dengan_penurunan_skor_ohis,
                jumlah_pasien_gigi,
                persentase,
                bulan,
                tahun 
            FROM
                penurunan_skor_ohis_pasien
            WHERE
                id_faskes = ".$user_id."
                AND bulan = ".$bulan."
                AND tahun = ".$tahun);
		return $sql->result_array();
	}

    function get_review($user_id=null)
	{
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
                   
                    AND d.id > 192 
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
                   
                    AND d.id > 192 
                ) tidak 
            FROM
                review_detail a
                JOIN review b ON a.review_id = b.id
                JOIN trans_final z ON b.fasyankes_code = z.kode_faskes 
            WHERE
                1 = 1 
              
                AND z.id_faskes = ".$user_id."
                AND b.id > 192 
            
                "
                );
		return $sql->result_array();
	}

    function get_review_star($user_id=null)
	{
        $sql = $this->db->query("SELECT
                x.id,
                x.nama,
                (
                SELECT
                    COUNT( b.result_point_review ) 
                FROM
                    dbfaskes.review b
                    LEFT OUTER JOIN trans_final z ON b.fasyankes_code = z.kode_faskes 
                WHERE
                    b.result_point_review = x.id 
                    AND z.id_faskes = ".$user_id."
                 
                    AND b.id > 192 
                ) AS jumlah 
            FROM
                master_review_bintang x
                LEFT OUTER JOIN review a ON a.result_point_review = x.id 
            "
                );
		return $sql->result_array();
	}

    function get_id($user_id=null)
	{
        $mutu = $this->load->database('inm', TRUE);
        $sql = $mutu->query("SELECT
            id
        FROM
            usulan_akreditasi_pm
        WHERE
            id_faskes= ".$user_id."
        ORDER BY id DESC");
		return $sql->result_array();
	}

    function get_pengajuan_usulan($user_id=null)
	{
        $mutu = $this->load->database('inm', TRUE);
        $sql = $mutu->query("SELECT
            *
        FROM
            usulan_akreditasi_pm
        WHERE
            id_faskes= ".$user_id."
        ORDER BY id DESC");
		return $sql->result_array();
	}

    function get_sertifikat($user_id=null)
	{
        $mutu = $this->load->database('akreditasi', TRUE);
        $sql = $mutu->query("SELECT
            *
        FROM
            TPMD_tte_dirjen
        WHERE
            id_faskes= ".$user_id."
        ORDER BY id DESC");
		return $sql->result_array();
	}

    function get_asri($id_prov, $id_kota)
	{
        if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND c.id_prov_pm = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND c.id_kota_pm = '".$id_kota."'";
		}else{
			$kota="";
		}

        $sql = $this->db->query("SELECT
        a.kode_faskes,
        c.nama_pm,
        c.email,
        h.organization_id,
        h.created_at tanggal_satset,
        d.`status`,
        e.nameFacility vendor,
        f.nama_prop provinsi,
        g.nama_kota kabkota,
        d.modified_at tanggal_isi_rme,
        i.kategori_user,
        k.id cek_sdm,
        IF(j.id is NOT NULL,'Sudah', NULL) AS kirim_satu_sehat
    FROM
        asri_verifikasi a
        JOIN trans_final b ON b.kode_faskes = a.kode_faskes
        JOIN data_pm c ON b.id_faskes = c.id_faskes
        LEFT JOIN data_rme d ON b.id_faskes = d.id_faskes
        LEFT JOIN sim_pengembang e ON d.sim_pengembang_id = e.id
        LEFT JOIN propinsi f ON c.id_prov_pm = f.id_prop
        LEFT JOIN kota g ON c.id_kota_pm = g.id_kota
        LEFT JOIN satu_sehat_id h ON h.kode_baru_faskes = b.kode_faskes 
        LEFT JOIN kategori_pm i ON i.id = c.id_kategori
        LEFT JOIN tpmd_sudah_satusehat j on j.kode_faskes = a.kode_faskes
        LEFT JOIN ( SELECT id, id_faskes FROM data_sisdmk GROUP BY id_faskes ) k ON k.id_faskes = b.id_faskes
            WHERE 1=1".$prov.$kota." GROUP BY a.kode_faskes");
        return $sql->result_array();
	}

    function get_satu_sehat($user_id=null)
	{
        

        $sql = $this->db->query("SELECT
        a.kode_faskes
        
    FROM
        tpmd_sudah_satusehat a
        JOIN trans_final b ON b.kode_faskes = a.kode_faskes
        WHERE 
        b.id_faskes= ".$user_id);
        return $sql->result_array();
	}
	
}

