<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Model_profile');
		$this->load->model('Model_fasyankes');
		if($this->session->userdata('logged') !=TRUE){
            $uri = "https://dfo.kemkes.go.id/tes";
            $encodedUri = urlencode($uri);
            $url = "http://202.70.136.86/single/?continued=";
            $url = $url.$encodedUri;
            // $url=base_url('login');
            redirect($url);
		}
	}
	
	public function index()
	{	
		$get = $this->input->get();
		if(isset($get['token'])){
			$data_token = $this->token($get['token']);
			// var_dump($data);

			if($data_token['status'] == true){
				$where2 = array(
					'email' => $email
				);
				$show_user2 = $this->Mlogin->cek_login("registrasi_user", $where2)->result_array();

				if ($cek > 0) {
					// $data = array("lastlogin" => $date, "pass_baru" => $hashed);
					// // End update password

					// $this->db->where('email', $email);
					// $this->db->update('registrasi_user', $data);

					if ($show_user2[0]['validate'] == 2) {
						date_default_timezone_set("Asia/Jakarta");
						$time1 = new DateTime(date("Y-m-d"));
						$time2 = new DateTime($show_user2[0]['tanggal_update_password']);
						$interval = $time2->diff($time1)->format("%r%a");
						if($interval <90){
							$data_session = array(
								'email' => $email,
								'status' => "login",
								'user_id' => $show_user2[0]['id'],
								'nama_lengkap' => $show_user2[0]['nama_lengkap'],
								'no_ktp' => $show_user2[0]['no_ktp'],
								'jabatan' => $show_user2[0]['jabatan'],
								'tgl_buat_user' => $show_user2[0]['tgl_buat_user'],
								'id_kategori' => $show_user2[0]['id_kategori'],
								'id_kota' => $show_user2[0]['id_kota'],
								'id_prov' => $show_user2[0]['id_prov'],
								'id_camat' => $show_user2[0]['id_camat'],
								'type_user' => $show_user2[0]['type_user']
							);

							$this->session->set_userdata($data_session);
							//code udin
							$validasi_email = $this->Mlogin->query_validasi_email($email);
							if ($validasi_email->num_rows() > 0) {
								$validate_ps = $this->Mlogin->query_validasi_email($email);
								if ($validate_ps->num_rows() > 0) {
									$x = $validate_ps->row_array();
									if ($x['user_status'] == '1') {
										// echo '<pre>';
										// print_r($x);
										// echo '</pre>';
										// exit;
										$this->session->set_userdata('logged', TRUE);
										$this->session->set_userdata('user', $email);
										$id = $x['id'];
										if ($x['id_kategori'] == '1') { //Administrator

											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];
											$this->session->set_userdata('access', 'Kemenkes');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
											//var_dump($name); exit();
										} else if ($x['id_kategori'] == '2') {
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];
											$this->session->set_userdata('access', 'Dinkes Provinsi');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										} else if ($x['id_kategori'] == '3') {
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];
											$this->session->set_userdata('access', 'Dinkes Kab/Kota');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										} else if ($x['id_kategori'] == '4') {
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];
											$this->session->set_userdata('access', 'RS');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										} else if ($x['id_kategori'] == '5') {
											$dataKlinik =  $this->Model_fasyankes->select_data('trans_final', array('id_faskes' => $this->session->userdata('user_id')))->result_array();
											$id_faskes =  $dataKlinik[0]['kode_faskes'];
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];

											$this->session->set_userdata('id_faskes', $id_faskes);
											$this->session->set_userdata('access', 'Klinik');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										} else if ($x['id_kategori'] == '6') {
											$datautd = $this->Model_fasyankes->select_data('trans_final', array('id_faskes' => $this->session->userdata('user_id')))->result_array();
											$id_faskes =  $datautd[0]['id_faskes'];
											$data_kepemilikan = $this->Model_fasyankes->select_data('data_utd', array('id_faskes' => $id_faskes))->result_array();
											$kepemilikan = $data_kepemilikan[0]['status_kepemilikan'];
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];
											$this->session->set_userdata('id_faskes', $id_faskes);
											$this->session->set_userdata('kepemilikan', $kepemilikan);
											$this->session->set_userdata('access', 'UTD');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										} else if ($x['id_kategori'] == '7') {
											$dataLabkes =  $this->Model_fasyankes->select_data('trans_final', array('id_faskes' => $this->session->userdata('user_id')))->result_array();
											$id_faskes =  $dataLabkes[0]['kode_faskes'];
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];

											$this->session->set_userdata('id_faskes', $id_faskes);
											$this->session->set_userdata('access', 'Laboratorium/Bank Jaringan');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										} else if ($x['id_kategori'] == '8') {
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];
											$this->session->set_userdata('access', 'P2JK');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										} else if ($x['id_kategori'] == '9') {
											// $name = $x['nama_lengkap'];
											// $faskes = $x['nama_fasyankes'];
											// $this->session->set_userdata('access', 'Praktik Mandiri');
											// $this->session->set_userdata('id', $id);
											// $this->session->set_userdata('name', $name);
											// $this->session->set_userdata('nmfaskes', $faskes);

											//$url=base_url('login');
											echo $this->session->set_flashdata('msg', '<span onclick="this.parentElement.style.display=`none`" class="w3-button w3-large w3-display-topright">&times;</span>
											<h3>Pembatasan Login!</h3>
											<p>Silahkan mengakses ke halaman registrasi fasyankes!</p>');
											//redirect($url);
											// redirect('login');
											// redirect('PraktikMandiri');
											redirect('https://registrasifasyankes.kemkes.go.id/admin/index');
											// return;
										} else if ($x['id_kategori'] == '10') {
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];
											$this->session->set_userdata('access', 'Admin view');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										} else if ($x['id_kategori'] == '11') {
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];
											$id_faskes = $x['id_faskes'];
											$this->session->set_userdata('access', 'Puskesmas');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('id_faskes', $id_faskes);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										}else if ($x['id_kategori'] == '12') {
											$name = $x['nama_lengkap'];
											$faskes = $x['nama_fasyankes'];
											$this->session->set_userdata('access', 'BPJS Kesehatan');
											$this->session->set_userdata('id', $id);
											$this->session->set_userdata('name', $name);
											$this->session->set_userdata('nmfaskes', $faskes);
										}
								} else {
									//$url=base_url('login');
									echo $this->session->set_flashdata('msg', '<span onclick="this.parentElement.style.display=`none`" class="w3-button w3-large w3-display-topright">&times;</span>
									<h3>Uupps!</h3>
									<p>Akun Belum di validasi. Silahkan hubungi Dinnkes Kab / Kot.</p>');
									//redirect($url);
									redirect('login');
								}
							} else {
								$url = base_url('login');
								echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">Pasword yg anda masukan salah</div>');
								//redirect($url);
								redirect('login');
							}
						} else {
							$url = base_url('login');
							echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">Email yg anda masukan salah</div>');
							redirect($url);
						}
						// DELETE ELSE INI kalo error
						// print_r($interval) ;
						}else{
							// print_r('testing') ;
							$id = $show_user2[0]['id'];
							$email = $show_user2[0]['email'];
							$this->session->set_userdata('id', $id);
							$this->session->set_userdata('email', $email);
							// print_r($email);
							//var_dump($name); exit();
							redirect('reset_password');
						}
					} else {
						// code tambah untuk jika belum validasi
						$url = base_url('login');
						echo $this->session->set_flashdata('pesan_validasi', '<font style="color: red"><b>User belum di validasi, Silahkan menghubungi Dinkes Kab/Kota masing-masing</b></font><br/><br/>');
						redirect($url);
					}
				} else {
					$url = base_url('login');
					echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">Email / Password yg anda masukan salah</div>');
					redirect($url);
				}
			}
		}

		$id=$this->session->userdata();
		$data = array('content' =>'view-profil',
					  'datauser'=>$this->Model_profile->Profile_view($id['id'])
					);
		$data['dasar'] = $this->Model_fasyankes->getdataklinik($id['id']);
		$this->load->view('template',$data);

		// echo $this->session->userdata('name');
	}

	public function token($token){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://202.70.136.86/sso/v1/token?value='.$token.'&serviceProviderId=2',
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
		// echo $return;
		$response2 = json_decode($response, true);	
		// echo $response2['data']['email'];
		// var_dump($response2['status']);
		return $response2;
	}

	public function update_profil()
	{
		$nama_lengkap=$this->input->post('nama_lengkap');
		$jabatan=$this->input->post('jabatan');
		$jenis_kelamin=$this->input->post('jenis_kelamin');
		$noktp=$this->input->post('noktp');
		$tempat_lahir=$this->input->post('tempat_lahir');
		$tgl_lahir=$this->input->post('tgl_lahir');
		$nohp=$this->input->post('nohp');
		$alamat=$this->input->post('alamat');
		$this->Model_profile->update_profile($nama_lengkap,$jabatan,$jenis_kelamin,$noktp,$tempat_lahir,$tgl_lahir,$nohp,$alamat);
		redirect('profil');
	}

	public function update_pass()
	{
		date_default_timezone_set("Asia/Jakarta");
        $date = date('Y-m-d');
		$pass=$this->input->post('password');

		$uppercase = preg_match('@[A-Z]@', $pass);
		$lowercase = preg_match('@[a-z]@', $pass);
		$number    = preg_match('@[0-9]@', $pass);
		$specialChars = preg_match('@[^\w]@', $pass);
		if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
		$url=base_url('profil');
		echo $this->session->set_flashdata('msg','<div class="alert alert-danger">Pasword setidaknya harus 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan spesial karakter.</div>');
		  redirect($url);

		}else{
   		$this->Model_profile->update_password($pass,$date);
   		echo $this->session->set_flashdata('msg','<div class="alert alert-success">Pasword Berhasil Diubah. Silahkan Login kembali</div>');
		redirect('profil');
			}
	}
}