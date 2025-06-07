<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Reviewmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function select_data($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function input_data($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    function edit_data($table, $where, $data)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    function delete_data($table, $where)
    {
        $this->db->delete($table, $where);
    }

    function get_review($user_id = null, $bulan = NULL, $tahun = NULL)
    {



        if (!empty($bulan) && $bulan != 9999) {
            $where_bulan = "AND MONTH ( d.review_time )='" . $bulan . "'";
            $where_bulan2 = "AND MONTH ( b.review_time )='" . $bulan . "'";
        } else {
            $where_bulan = "";
            $where_bulan2 = "";
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
                " . $where_bulan . "
                AND YEAR ( d.review_time ) = " . $tahun . "
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
                " . $where_bulan . "
                AND YEAR ( d.review_time ) = " . $tahun . "
		AND d.id > 192
            ) tidak 
        FROM
            review_detail a
            JOIN review b ON a.review_id = b.id
            JOIN trans_final z ON b.fasyankes_code = z.kode_faskes 
        WHERE
            1=1 
            " . $where_bulan2 . "
            AND YEAR ( b.review_time ) = " . $tahun . "
            #AND b.fasyankes_code = 13070100002 
            AND z.id_faskes = " . $user_id . "
	    AND b.id > 192
        GROUP BY
            a.qustion_id,
            a.question_description,
            ya,
            tidak
        ");
        return $sql->result_array();

        // return $where_bulan;
    }

    function get_review_star($user_id = null, $bulan = NULL, $tahun = NULL)
    {



        if (!empty($bulan) && $bulan != 9999) {
            $where_bulan = "AND MONTH ( b.review_time )='" . $bulan . "'";
        } else {
            $where_bulan = "";
        }

        $sql = $this->db->query("SELECT
            x.id,
            x.nama,
            (
            SELECT
                COUNT( b.result_point_review ) 
            FROM
                review b
                LEFT OUTER JOIN trans_final z ON b.fasyankes_code = z.kode_faskes 
            WHERE
                b.result_point_review = x.id 
                AND z.id_faskes = " . $user_id . "
                " . $where_bulan . "
                AND YEAR ( b.review_time ) = " . $tahun . "
		AND b.id > 192
            ) AS jumlah 
        FROM
            master_review_bintang x
            LEFT OUTER JOIN review a ON a.result_point_review = x.id 
        GROUP BY
            x.nama,
            x.id");
        return $sql->result_array();
    }

    function get_satu_sehat($user_id = null)
    {
        $sql = $this->db->query("SELECT
        a.* 
    FROM
        satu_sehat_id a
        JOIN trans_final b ON a.kode_baru_faskes = b.kode_faskes_baru 
    WHERE
        b.id_faskes =" . $user_id);
        return $sql->result_array();
    }

    function get_satu_sehat_dev($user_id = null)
    {
        $sql = $this->db->query("SELECT
        a.* 
    FROM
        satu_sehat_id_dev a
        JOIN trans_final b ON a.kode_baru_faskes = b.kode_faskes_baru 
    WHERE
        b.id_faskes =" . $user_id);
        return $sql->result_array();
    }

    function get_satu_sehat_pic($user_id = null)
    {
        $sql = $this->db->query("SELECT
        a.* 
    FROM
        satu_sehat a
    WHERE
        a.id_faskes =" . $user_id);
        return $sql->result_array();
    }

    function get_api_odelia($user_id = null)
    {
        $sql = $this->db->query("SELECT
        a.* 
    FROM
        api_odelia a
    WHERE
        a.id_faskes =" . $user_id);
        return $sql->result_array();
    }

    function get_pic_faskes($user_id = null)
    {
        $sql = $this->db->query("SELECT
        a.* 
    FROM
        penanggung_jawab_faskes a
    WHERE
        a.id_faskes =" . $user_id);
        return $sql->result_array();
    }
}
