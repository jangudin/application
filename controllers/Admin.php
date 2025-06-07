<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */



	function __construct()
	{
		parent::__construct();

		$this->load->model('loginmodel');
		$this->load->model('registrasiusermodel');
		//$this->load->model('masterrsmodel');		
		$this->load->library('form_validation');
		$this->load->helper('myform_helper');
	}

	function index()
	{
		// $data['judul'] = "Log in";
		// $this->template->kedua('admin/index', $data);
		redirect('Landing');
	}

	function halaman_juknis()
	{
		$data['judul'] = "Halaman Juknis";
		$this->template->utama('admin/halaman_juknis', $data);
	}

	function cek_login()
	{

		$email = $this->input->post('email');
		$kata_sandi = $this->input->post('kata_sandi');


		//$password1 = $this->input->post('pass');
		$salt      = 'hello_1m_@_SaLT_0f_F45ke5';
		$hashed    = hash('sha256', $kata_sandi . $salt);

		$sql = $this->db->query("UPDATE registrasi_user SET pass_baru=$hashed WHERE email='$email'");

		if (!isset($email) && !isset($kata_sandi)) {
			$this->session->sess_destroy();
			redirect(base_url('admin/index'));
		}

		$where = array(
			'email' => $email,
			'kata_sandi' => md5($kata_sandi),
		);
		$cek = $this->loginmodel->cek_login("registrasi_user", $where)->num_rows();
		$show_user = $this->loginmodel->cek_login("registrasi_user", $where)->result_array();

		//var_dump($show_user);
		$where2 = array(
			'email' => $email
		);
		$show_user2 = $this->loginmodel->cek_login("registrasi_user", $where2)->result_array();
		if ($cek > 0) {
			$data = array("lastlogin" => $date, "pass_baru" => $hashed);
			// End update password

			$this->db->where('email', $email);
			$this->db->update('registrasi_user', $data);

			if ($show_user[0]['validate'] == 2) {
				date_default_timezone_set("Asia/Jakarta");
				$time1 = new DateTime(date("Y-m-d"));
				$time2 = new DateTime($show_user[0]['tanggal_update_password']);
				$interval = $time2->diff($time1)->format("%r%a");
				if ($interval < 90) {
					$data_session = array(
						'email' => $email,
						'status' => "login",
						'id' => $show_user[0]['id'],
						'user_id' => $show_user[0]['id'],
						'nama_lengkap' => $show_user[0]['nama_lengkap'],
						'no_ktp' => $show_user[0]['no_ktp'],
						'jabatan' => $show_user[0]['jabatan'],
						'tgl_buat_user' => $show_user[0]['tgl_buat_user'],
						'id_kategori' => $show_user[0]['id_kategori'],
						'id_kategori_pm' => $show_user[0]['id_kategori_pm'],
						'id_kota' => $show_user[0]['id_kota'],
						'id_prov' => $show_user[0]['id_prov'],
						'id_camat' => $show_user[0]['id_camat'],
						'type_user' => $show_user[0]['type_user']
					);

					$this->session->set_userdata($data_session);

					redirect(base_url("dashboard"));
				} else {
					$data_session = array(
						'email' => $email,
						'status' => "login",
						'user_id' => $show_user[0]['id'],
						'id' => $show_user[0]['id']
					);

					$this->session->set_userdata($data_session);
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Silahkan update password karena password telah kadaluarsa. </br> Password minimal 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan karakter khusus(!,@,#,$,^,*,(,)).');
					//redirect($url);
					redirect('password');
				}
			} else if ($show_user[0]['validate'] == 1) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Akun Belum Di Validasi Harap Cek Email Anda!');
				redirect(base_url("admin/index"));
			} else if ($show_user[0]['validate'] == 0) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Validasi User, Silahkan hubungi Dinkes Kab/Kota / Provinsi/ Kemenkes berdasarkan kewenangan wilayah tugasnya masing-masing sesuai juknis!!');
				redirect(base_url("admin/index"));
			}
		} else {

			if ($show_user2[0]['validate'] == NULL) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Akun Belum Terdaftar!, Harap Mendaftar Lebih Dahulu.');
				redirect(base_url("admin/index"));
			} else if ($show_user2[0]['validate'] == 2) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('post', $email);
				$this->session->set_flashdata('message_name', 'Email Atau Password Salah!&nbsp;&nbsp;&nbsp;<a href="' . site_url('register/lupa_password/') . urlencode($email) . '"  >Lupa Password?</a>');
				redirect(base_url("admin/index"));
			} else if ($show_user2[0]['validate'] == 1) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Akun Belum Di Validasi Harap Cek Email Anda!');
				redirect(base_url("admin/index"));
			} else if ($show_user2[0]['validate'] == 0) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Validasi User, Silahkan hubungi Dinkes Kab/Kota / Provinsi/ Kemenkes berdasarkan kewenangan wilayah tugasnya masing-masing sesuai juknis!!');
				redirect(base_url("admin/index"));
			}
		}
	}

	function logout()
	{
		// $this->session->sess_destroy();
		// redirect(base_url('admin/index'));
		redirect('Landing/logout');
	}

	public function daftar_user()
	{
		$data['judul'] = "Daftar User Baru";

		$post = $this->input->post();
		if (isset($post['submit'])) {


			$datas = array(
				'email' => $post['email'],
				'nama' => $post['nama'],
				'no_tlpn' => $post['no_tlpn'],
				'upload_ke_jurnal' => $post['upload_ke_jurnal']
			);


			$this->masterrsmodel->input_data('master_rs', $datas);
			$id = $this->db->insert_id();


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Mendaftar!, Harap Menunggu Untuk Di Konfirmasi, Terima Kasih.');
			redirect('register_format_proposal/index');
		}

		$where = array(
			'status_spesialisasi' => 'active'
		);
		$data['master_spesialisasi'] = $this->masterrsmodel->select_data("master_spesialisasi", $where)->result_array();
		$this->template->kedua('admin/daftar_user', $data);
	}

	function validasi_link($token)
	{

		if (empty($token)) {
			redirect(base_url("admin/index"));
		}
		$where = array(
			'token' => $token,
			'validate' => 1
		);
		$cek = $this->loginmodel->cek_login("registrasi_user", $where)->num_rows();
		if ($cek >= 1) {
			$show_user = $this->loginmodel->cek_login("registrasi_user", $where)->result_array();

			$where_edit = array(
				'token' => $token
			);
			$datas = array(
				'validate' => 2
			);
			$this->registrasiusermodel->edit_data('registrasi_user', $where_edit, $datas);
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Validasi Sukses, Akun Sudah Bisa Untuk Login!');
			redirect(base_url("admin/index"));
		} else {
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Kode Token Tidak Valid Atau Sudah Dipakai!');
			redirect(base_url("admin/index"));
		}
	}


	function validasi_link_kode_faskes($token, $id_link)
	{
		$where = array(
			'token_kode_faskes' => $token,
			'validate_token' => 0
		);
		$cek = $this->loginmodel->cek_login("trans_final", $where)->num_rows();
		if ($cek > 0) {
			//$show_user = $this->loginmodel->cek_login("registrasi_user",$where)->result_array();

			$where_edit = array(
				'token_kode_faskes' => $token
			);
			$datas = array(
				'validate_token' => 1,
				'kode_faskes' => $this->registrasiusermodel->findNoFaskes($id_link)
			);
			$this->registrasiusermodel->edit_data('trans_final', $where_edit, $datas);
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Kode Faskes Sudah Aktif');
			redirect(base_url("admin/index"));
		} else {
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Link Aktifasi Tidak Valid Atau Sudah Dipakai!');
			redirect(base_url("admin/index"));
		}
	}
}
