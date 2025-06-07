<?php
class Landing extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");


		$this->load->library('pagination');
		$this->load->library('secure');
		$this->load->library('secure2');
		$this->load->model('registrasiusermodel');
		$this->load->model('labkesmodel');
		$this->load->model('rsmodel');
		$this->load->model('utdmodel');
		// $this->load->model('pmmodel');
		$this->load->model('loginmodel');
		$this->load->model('reviewmodel');
		$this->load->model('pelaporanpmmodel');
		$this->load->model('akreditasipmmodel');
		define('MB', 1048576);
	}

	public function index()
	{
		// if($this->session->userdata('status') == "login"){
		// 	redirect(base_url("dashboard"));
		// }

		$get = $this->input->get();
		// print_r($get['token']);

		if (isset($get['token'])) {
			if ($this->session->userdata('status') != "login") {
				$data = $this->token($get['token']);

				if ($data['status'] == true) {
					$where2 = array(
						'email' => $data['data']['email']
					);
					$show_user2 = $this->loginmodel->cek_login("registrasi_user", $where2)->result_array();
					$cek = $this->loginmodel->cek_login("registrasi_user", $where2)->num_rows();
					if ($cek > 0) {
						if($show_user2[0]['status'] == 1){
						// echo 1;
						$data = array("lastlogin" => $date, "pass_baru" => $hashed);
						// End update password

						$this->db->where('email', $email);
						$this->db->update('registrasi_user', $data);

						if ($show_user2[0]['validate'] == 2) {
							date_default_timezone_set("Asia/Jakarta");
							$time1 = new DateTime(date("Y-m-d"));
							$time2 = new DateTime($show_user2[0]['tanggal_update_password']);
							$interval = $time2->diff($time1)->format("%r%a");
							// if ($interval < 90) {
							$data_session = array(
								'email' => $email,
								'status' => "login",
								'id' => $show_user2[0]['id'],
								'user_id' => $show_user2[0]['id'],
								'nama_lengkap' => $show_user2[0]['nama_lengkap'],
								'no_ktp' => $show_user2[0]['no_ktp'],
								'jabatan' => $show_user2[0]['jabatan'],
								'tgl_buat_user' => $show_user2[0]['tgl_buat_user'],
								'id_kategori' => $show_user2[0]['id_kategori'],
								'id_kategori_pm' => $show_user2[0]['id_kategori_pm'],
								'id_kota' => $show_user2[0]['id_kota'],
								'id_prov' => $show_user2[0]['id_prov'],
								'id_camat' => $show_user2[0]['id_camat'],
								'type_user' => $show_user2[0]['type_user']
							);

							$this->session->set_userdata($data_session);

							redirect(base_url("dashboard"));
							// } else {
							// 	$data_session = array(
							// 		'email' => $email,
							// 		'status' => "login",
							// 		'user_id' => $show_user2[0]['id'],
							// 		'id' => $show_user2[0]['id']
							// 	);

							// 	$this->session->set_userdata($data_session);
							// 	$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
							// 	$this->session->set_flashdata('icon_name', 'warning');
							// 	$this->session->set_flashdata('message_name', 'Silahkan update password karena password telah kadaluarsa. </br> Password minimal 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan karakter khusus(!,@,#,$,^,*,(,)).');
							// 	//redirect($url);
							// 	redirect('password');
							// }
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

					}else{
					
						$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
						$this->session->set_flashdata('icon_name', 'warning');
						$this->session->set_flashdata('message_name', 'Akun sudah di Nonaktifkan');
						// alert('Akun sudah di Nonaktifkan');
						redirect(base_url("Landing"));
					
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
			} else {
				redirect(base_url("dashboard"));
			}
		} else {
			if ($this->session->userdata('status') != "login") {
				$this->load->view('landing');
			} else {
				redirect(base_url("dashboard"));
			}
		}
	}


	// public function testSSO()
	// {
	// 	phpinfo();
	// 	// $token = 'eyJwYXlsb2FkIjp7ImlkIjo1ODA2NSwiZW1haWwiOiJsYWJfbWFiZXNAYmlvbWVkaWthLmNvLmlkIiwic2VydmljZVByb3ZpZGVySWQiOlsid0lLS05uQ09FRzh0WjU0eG5PT1YiLCJERnNrZUlFNGw2Q1VDdHBxdWJsaSIsIks1VFV1NGNvMUFCZ2EzczF2eGVtIiwiaVpMQjNqWFE4VWkwWDBNTkVUbFEiXSwiY2F0ZWdvcnlVc2VyIjo3fSwiZXhwaXJlc0luIjo5MDAsImNyZWF0ZWRBdCI6MTczMTI4OTE5NH0.rj06AkI9SAokFqipHDhYnU8XyPYe5UOPBbc6q5wE6k';
	// 	// $curl = curl_init();

	// 	// $url = 'https://akun-yankes.kemkes.go.id/sso/v1/token?value=' . $token . '&serviceProviderId=DFskeIE4l6CUCtpqubli';
	// 	// // return $url;

	// 	// curl_setopt_array($curl, array(
	// 	// 	CURLOPT_URL => $url,
	// 	// 	CURLOPT_RETURNTRANSFER => true,
	// 	// 	CURLOPT_ENCODING => '',
	// 	// 	CURLOPT_MAXREDIRS => 10,
	// 	// 	CURLOPT_TIMEOUT => 0,
	// 	// 	CURLOPT_FOLLOWLOCATION => true,
	// 	// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 	// 	CURLOPT_CUSTOMREQUEST => 'GET',
	// 	// ));
	// 	// curl_setopt(
	// 	// 	$curl,
	// 	// 	CURLOPT_HTTPHEADER,
	// 	// 	array('Content-Type:application/json',)
	// 	// );

	// 	// if (curl_exec($curl) === FALSE) {
	// 	// 	echo '2';
	// 	// 	// die("Curl Failed: " . curl_error($curl));
	// 	// } else {
	// 	// 	// echo '1';
	// 	// 	return curl_exec($curl);
	// 	// }

	// 	// Create a cURL handle
	// 	// $ch = curl_init('http://www.google.com/');

	// 	// // Execute
	// 	// curl_exec($ch);

	// 	// // Check if any error occurred
	// 	// if (!curl_errno($ch)) {
	// 	// 	$info = curl_getinfo($ch);
	// 	// 	echo 'Took ', $info['total_time'], ' seconds to send a request to ', $info['url'], "\n";
	// 	// }

	// 	// // Close handle
	// 	// curl_close($ch);
	// }

	public function token($token)
	{
		$curl = curl_init();

		$url = 'http://192.168.50.86/sso/v1/token?value=' . $token . '&serviceProviderId=DFskeIE4l6CUCtpqubli';
		// return $url;

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response2 = json_decode($response, true);
		return $response2;
	}

	private function check_token($url_controller)
	{
		$uri = base_url('Landing/get_token');
		$encodedUri = urlencode($uri);

		$url = "http://192.168.50.86/single-sign-on?continued=";
		$url = $url . $encodedUri;
		$this->session->set_flashdata('url', $url_controller);
		redirect($url);
	}

	public function get_token()
	{
		$get = $this->input->get();
		$url = $this->session->flashdata('url');
		if ($url != NULL) {
			if (isset($get['token'])) {
				$data_token = $this->token($get['token']);
				$email = $data_token['data']['email'];
				// print_r($email);

				$where2 = array(
					'email' => $email
				);

				$show_user2 = $this->loginmodel->cek_login("registrasi_user", $where2)->result_array();
				$cek = $this->loginmodel->cek_login("registrasi_user", $where2)->num_rows();

				// // var_dump($cek);
				if ($cek > 0) {

					if($show_user2[0]['status'] == 1){

					
					$date = date("Y-m-d H:i:s");
					$data = array("lastlogin" => $date);
					// End update password

					$this->db->where('email', $email);
					$this->db->update('registrasi_user', $data);

					if ($show_user2[0]['validate'] == 2) {
						date_default_timezone_set("Asia/Jakarta");
						$time1 = new DateTime(date("Y-m-d"));
						$time2 = new DateTime($show_user2[0]['tanggal_update_password']);
						$interval = $time2->diff($time1)->format("%r%a");
						// if ($interval < 90) {
						$data_session = array(
							'email' => $email,
							'status' => "login",
							'id' => $show_user2[0]['id'],
							'user_id' => $show_user2[0]['id'],
							'nama_lengkap' => $show_user2[0]['nama_lengkap'],
							'no_ktp' => $show_user2[0]['no_ktp'],
							'jabatan' => $show_user2[0]['jabatan'],
							'tgl_buat_user' => $show_user2[0]['tgl_buat_user'],
							'id_kategori' => $show_user2[0]['id_kategori'],
							'id_kategori_pm' => $show_user2[0]['id_kategori_pm'],
							'id_kota' => $show_user2[0]['id_kota'],
							'id_prov' => $show_user2[0]['id_prov'],
							'id_camat' => $show_user2[0]['id_camat'],
							'type_user' => $show_user2[0]['type_user']
						);

						$this->session->set_userdata($data_session);
						$this->session->set_flashdata('check', 'done');
						redirect($url);
						// redirect(base_url("Landing/dashboard"));
						// } else {
						// 	$data_session = array(
						// 		'email' => $email,
						// 		'status' => "login",
						// 		'user_id' => $show_user2[0]['id'],
						// 		'id' => $show_user2[0]['id']
						// 	);

						// 	$this->session->set_userdata($data_session);
						// 	$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
						// 	$this->session->set_flashdata('icon_name', 'warning');
						// 	$this->session->set_flashdata('message_name', 'Silahkan update password karena password telah kadaluarsa. </br> Password minimal 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan karakter khusus(!,@,#,$,^,*,(,)).');
						// 	//redirect($url);
						// 	redirect('password');
						// }
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

				}else{
					
						$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
						$this->session->set_flashdata('icon_name', 'warning');
						$this->session->set_flashdata('message_name', 'Akun sudah di Nonaktifkan');
						redirect(base_url("tes"));
					
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
			} else {
				redirect(base_url('Landing/dashboard'));
			}
		} else {
			redirect(base_url('Landing/dashboard'));
		}
	}

	public function dashboard()
	{
		if ($this->session->flashdata('check', 1) == 'done') {
			$data['data'] = $this->registrasiusermodel->getprofile($this->session->userdata('user_id'));
			$data['getinbox'] = $this->registrasiusermodel->getinbox($this->session->userdata('user_id'));
			$this->template->utama('profile/index', $data);
		} else {
			$this->check_token(base_url('/Landing/dashboard'));
		}
	}

	function logout()
	{
		$this->session->sess_destroy();

		$uri = "https://registrasifasyankes.kemkes.go.id/landing";
		// $uri = "http://192.168.67.130/registrasifaskes/";
		$encodedUri = urlencode($uri);
		//$url = "https://akun-yankes.kemkes.go.id/logout/?continued=";
		$url = "http://192.168.50.86/single/logout/?continued=";
		$url = $url . $encodedUri;
		redirect($url);
	}
}
