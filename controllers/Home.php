<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// $this->load->model('loginmodel');
		// $this->load->model('registrasiusermodel');
		// $this->load->model('frontmodel');
		// $this->load->library('form_validation');
	}

	function index($jenis_menu = NULL, $id_halaman = NULL)
	{
		// $data['judul'] = "Log in";
		// $where = array(
		// 	'status' => 'active'
		// );
		// $where2 = array(
		// 	'validasi' => 'Sudah Di Validasi'
		// );
		// $data['menu_utama'] = $this->frontmodel->select_data("menu_utama", $where)->result_array();
		// $data['menu_turunan'] = $this->frontmodel->select_data("menu_turunan", $where)->result_array();
		// $data['promosi'] = $this->frontmodel->select_data("promosi", $where2)->result_array();
		// if (empty($jenis_menu) || $jenis_menu == 'utama' && $id_halaman == '1') {
		// 	$this->template->ketiga('home/index', $data);
		// } else {
		// 	$this->template->ketiga('home/pages', $data);
		// }
		echo 'test';
	}

	function pages_promosi($id = NULL)
	{
		$data['judul'] = "Promosi";
		$where = array(
			'status' => 'active'
		);
		$where2 = array(
			'validasi' => 'Sudah Di Validasi',
			'id' => $id
		);
		$data['menu_utama'] = $this->frontmodel->select_data("menu_utama", $where)->result_array();
		$data['menu_turunan'] = $this->frontmodel->select_data("menu_turunan", $where)->result_array();
		$data['promosi'] = $this->frontmodel->select_data("promosi", $where2)->result_array();
		$this->template->ketiga('home/pages_promosi', $data);
	}

	function list_pcare()
	{
		echo "tes";
		// $data['data']['query'] = $this->registrasiusermodel->getlistpcare();
		// $this->template->utama('admin/list_pcare');  
	}
}
