<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
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

		if ($this->session->userdata('status') == "login") {
			redirect(base_url("dashboard"));
		}
		$this->load->model('Registrasiusermodel');
		$this->load->model('loginmodel');
		$this->psc = $this->load->database('psc', TRUE);
	}

	public function index()
	{
		$data['judul'] = "Register User Baru";
		$this->load->model('Registrasiusermodel');
		$this->load->helper(['security', 'email']); // gunakan helper email dan security

		$post = $this->input->post(NULL, TRUE); // TRUE untuk XSS filtering

		if ($post && isset($post['submit'])) {

			// Blok email tertentu
			if ($post['email'] === 'sample@email.tst') {
				$this->session->set_flashdata('pesan_form', '<b>Email tidak valid</b>');
				return redirect('register/index');
			}

			// Validasi format email
			if (!valid_email($post['email'])) {
				$this->session->set_flashdata('pesan_form', '<b>Format email salah!</b>');
				return redirect('register/index');
			}

			// Cek IP
			$ip = $this->input->ip_address();
			$blacklist_ips = ["111.68.126.27", "103.210.15.9", "103.77.234.182", "193.32.162.32"];
			if (in_array($ip, $blacklist_ips)) {
				$this->session->set_flashdata('pesan_form', '<b>Akses tidak diizinkan</b>');
				return redirect('register/index');
			}

			// Validasi captcha
			$captcha_input = $post['captcha'];
			$captcha_session = $this->session->userdata('captcha_tambah');
			if (empty($captcha_input) || $captcha_input != $captcha_session) {
				$this->session->set_flashdata('pesan_form', '<font style="color: red"><b>Captcha salah!</b></font><br/><br/>');
				return redirect('register/index');
			}

			// Token & tanggal
			date_default_timezone_set("Asia/Jakarta");
			$token = bin2hex(random_bytes(16));
			$date_update = date('Y-m-d');
			$tgl_lahir = date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_lahir'])));

			// Siapkan data bersih
			$datas = [
				'id_kategori'        => $post['id_kategori'],
				'id_kategori_pm'     => $post['id_kategori_pm'],
				'jabatan'            => strip_tags($post['jabatan']),
				'kewarganegaraan'    => strip_tags($post['kewarganegaraan']),
				'nama_fasyankes'     => strip_tags($post['nama_fasyankes']),
				'email'              => $post['email'],
				'kata_sandi'         => md5($post['kata_sandi']), // password hash bisa diganti bcrypt di masa depan
				'nama_lengkap'       => strip_tags($post['nama_lengkap']),
				'jenis_kelamin'      => $post['jenis_kelamin'],
				'no_hp'              => preg_replace('/[^0-9]/', '', $post['no_hp']),
				'no_ktp'             => preg_replace('/[^0-9]/', '', $post['no_ktp']),
				'tempat_lahir'       => strip_tags($post['tempat_lahir']),
				'tgl_lahir'          => $tgl_lahir,
				'id_prov'            => $post['propinsi'],
				'id_kota'            => $post['kota'],
				'id_camat'           => $post['kecamatan'],
				'id_prov_pm'         => !empty($post['propinsi_pm']) ? $post['propinsi_pm'] : NULL,
				'id_kota_pm'         => !empty($post['kota_pm']) ? $post['kota_pm'] : NULL,
				'id_camat_pm'        => !empty($post['kecamatan_pm']) ? $post['kecamatan_pm'] : NULL,
				'alamat'             => strip_tags($post['alamat']),
				'alamat_pm'          => strip_tags($post['alamat_pm']),
				'token'              => $token,
				'ip_user'            => $ip,
				'tanggal_update_password' => $date_update
			];

			// Simpan ke DB
			$this->Registrasiusermodel->input_data('registrasi_user', $datas);
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Mendaftar! Mohon tunggu validasi. Info validasi akan dikirim ke email Anda.');

			return redirect('register/index');
		}

		// Buat captcha text
		$bil1 = rand(0, 9);
		$bil2 = rand(0, 9);
		$hasil = $bil1 + $bil2;
		$data['captcha_new'] = 'Jawab: ' . $bil1 . ' + ' . $bil2 . ' =';
		$this->session->set_userdata('captcha_tambah', $hasil);

		// Buat captcha image
		$vals = [
			'word'          => substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8),
			'img_path'      => './assets/images/captcha/',
			'img_url'       => base_url('assets/images/captcha/'),
			'font_path'     => FCPATH . 'system/fonts/texb.ttf',
			'img_width'     => 250,
			'img_height'    => 50,
			'expiration'    => 7200,
			'word_length'   => 8,
			'font_size'     => 20,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'colors'        => [
				'background' => [255, 255, 255],
				'border'    => [255, 255, 255],
				'text'      => [0, 0, 0],
				'grid'      => [255, 40, 40]
			]
		];
		$captcha = create_captcha($vals);
		$this->session->set_userdata('captcha', $captcha['word']);
		$data['captcha'] = ['captcha' => $captcha['image']];

		// Tampilkan view
		$this->template->utama('register/index', $data);
	}


	public function cek_email($email = NULL)
	{
		if (!empty($email)) {
			$where = array("email" => "" . urldecode($email) . "");
			$cek = $this->loginmodel->cek_login("registrasi_user", $where)->result_array();
			echo json_encode(array(array('id' => $cek[0]['id'])));
		} else {
			return false;
		}
	}

	public function index_dinkes_kota()
	{
		$data['judul'] = "Register User Dinkes Kota Baru";
		$this->load->model('Registrasiusermodel');
		$this->load->helper('security');

		$post = $this->input->post();

		if (isset($post['submit'])) {
			// Sanitasi input untuk mencegah XSS
			$email = $this->input->post('email', TRUE);
			$nama_lengkap = $this->input->post('nama_lengkap', TRUE);
			$no_hp = $this->input->post('no_hp', TRUE);
			$no_ktp = $this->input->post('no_ktp', TRUE);
			$kata_sandi = $this->input->post('kata_sandi', TRUE);
			$jabatan = $this->input->post('jabatan', TRUE);
			$tempat_lahir = $this->input->post('tempat_lahir', TRUE);
			$tgl_lahir = $this->input->post('tgl_lahir', TRUE);
			$type_user = $this->input->post('type_user', TRUE);
			$jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
			$propinsi = $this->input->post('propinsi', TRUE);
			$kota = $this->input->post('kota', TRUE);
			$dinkes = $this->input->post('dinkes', TRUE);
			$captcha_input = $this->input->post('captcha', TRUE);

			// Validasi email menggunakan regex yang lebih baik
			$regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
			if (!preg_match($regex, $email)) {
				$this->session->set_flashdata('pesan_form', '<font style="color: red"><b>Format email tidak valid.</b></font><br/><br/>');
				redirect('register/index_dinkes_kota');
			}

			// Validasi CAPTCHA
			$captcha = $this->session->userdata('captcha_tambah');
			if ($captcha_input != $captcha) {
				$this->session->set_flashdata('pesan_form', '<font style="color: red"><b>Captcha yang Anda ketik salah!</b></font><br/><br/>');
				redirect('register/index_dinkes_kota');
			}

			// Menentukan alamat IP pengguna
			$ip = $this->input->ip_address();

			// Mengamankan password dengan password_hash dan password_verify
			$hashed_password = password_hash($kata_sandi, PASSWORD_BCRYPT);

			// Memastikan tanggal lahir dalam format yang benar
			$date = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_lahir)));

			// Menyusun data untuk disimpan ke dalam database
			$datas = array(
				'jabatan' => $jabatan,
				'email' => $email,
				'kata_sandi' => $hashed_password,
				'nama_lengkap' => $nama_lengkap,
				'type_user' => $type_user,
				'jenis_kelamin' => $jenis_kelamin,
				'no_hp' => str_replace(["-", "_"], "", $no_hp),
				'no_ktp' => str_replace(["-", "_"], "", $no_ktp),
				'tempat_lahir' => $tempat_lahir,
				'tgl_lahir' => $date,
				'id_prov' => $propinsi,
				'id_kota' => ($kota == 9999 ? '' : $kota),
				'id_kategori' => $dinkes,
				'ip_user' => $ip,
				'tanggal_update_password' => date('Y-m-d')
			);

			// Menyimpan data pengguna
			$this->Registrasiusermodel->input_data('registrasi_user', $datas);

			// Set flashdata untuk pesan sukses
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Mendaftar!, Mohon Ditunggu Untuk Di Validasi, Terima Kasih.');
			redirect('register/index_dinkes_kota');
		}

		// Menghasilkan CAPTCHA
		$bil1 = rand(0, 9);
		$bil2 = rand(0, 9);
		$hasil = $bil1 + $bil2;
		$data['captcha_new'] = 'Jawab penjumlahan berikut: ' . $bil1 . ' + ' . $bil2 . ' =';
		$this->session->set_userdata('captcha_tambah', $hasil);

		// Menyiapkan CAPTCHA untuk ditampilkan
		$vals = [
			'word'          => substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8),
			'img_path'      => './assets/images/captcha/',
			'img_url'       => base_url('assets/images/captcha/'),
			'font_path'     => FCPATH . 'system/fonts/texb.ttf',
			'img_width'     => '250',
			'img_height'    => 50,
			'expiration'    => 7200,
			'word_length'   => 8,
			'font_size'     => 20,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'colors'        => [
				'background' => [255, 255, 255],
				'border'    => [255, 255, 255],
				'text'      => [0, 0, 0],
				'grid'      => [255, 40, 40]
			]
		];

		$captcha = create_captcha($vals);
		$this->session->set_userdata('captcha', $captcha['word']);
		$data['captcha'] = ['captcha' => $captcha['image']];

		$this->template->utama('register/index_dinkes_kota', $data);
	}


	function daftar_baru()
	{

		$post = $this->input->post();
		$username = $post['username'];
		$email = $post['email'];
		$password =  md5($post['password']);
		$retype_password = md5($post['retype_password']);

		if ($post['submit']) {



			redirect('register/index');
		}
	}

	function send_email($emaildari, $namadari, $password, $subjek, $emailtujuan, $namatujuan, $pesan)
	{
		$this->load->library('SMTP');
		$this->load->library('PHPMailer');


		$mail             = new PHPMailer();

		$mail->IsSMTP(); // mengirimkan sinyal ke class PHPMail untuk menggunakan SMTP
		$mail->SMTPDebug  = 1;                     // mengaktifkan debug mode (untuk ujicoba)
		// 1 = Error dan pesan
		//	var_dump($emailadmin);									   // 2 = Pesan saja
		$mail->SMTPAuth   = true;                  // aktifkan autentikasi SMTP
		$mail->SMTPSecure = "ssl";                 // jenis kemananan
		$mail->Host       = "proxy.kemkes.go.id";      // masukkan GMAIL sebagai smtp server
		//$mail->Host       = "ssl://proxy.kemkes.go.id";
		$mail->Port       = "465";                   // masukkan port yang digunakan oleh SMTP Gmail
		$mail->Username   = $emaildari;  // GMAIL username
		$mail->Password   = $password;            // GMAIL password
		$mail->SetFrom($emaildari, $namadari); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
		$mail->Subject    = $subjek; //masukkan subject
		$mail->MsgHTML($pesan); //masukkan isi dari email
		$mail->IsHTML(true);

		//$mail->AddAttachment('../folder_file/'.$attach, $name = $attach,  $encoding = 'base64', $type = 'application/pdf');
		$mail->AddAddress($emailtujuan, $namatujuan); //masukkan penerima

		if (!$mail->Send()) {
			return 'Mailer Error: ' . $mail->ErrorInfo; // jika pesan tidak terkirim
		} else {
			return 'The email message was sent.'; //jika pesan terkirim
		}
		return $status;
	}

	function lupa_password($email = NULL)
	{

		$email  = urldecode($email);
		$title   = "Registrasi Fasyankes(Lupa Password)";
		$message = "Selamat datang di Aplikasi Registrasi Fasyankes Online.<br>
" . urldecode($email) . " Telah Lupa Password, Password Akan Di Reset Harap Klik Link Berikut Untuk Mendapatkan Password Baru :
<a href='" . base_url('register/validasi_link_lupa_password') . "/" . urlencode($email) . "'>RESET PASSWORD!</a>
<br><br>
Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
registrasifasyankes@kemkes.go.id<br>
<br><br>
Salam<br>
Sekretariat Direktorat Jenderal Pelayanan Kesehatan";

		$mail = $this->send_email("infoyankes@kemkes.go.id", "Sekretariat Direktorat Jenderal Pelayanan Kesehatan", "n3nceY@D", $title, $email, urldecode($email), $message);

		if ($mail) {
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Link Lupa Password Telah Dikirim Ke Email, Terima Kasih.');
			//exit();
			redirect(base_url("admin/index"), 'refresh');
		}
	}


	function validasi_link_lupa_password($email = NULL)
	{
		$new_pass = rand(100000, 999999);
		$where = array('email' => urldecode($email));
		$datas = array('kata_sandi' => md5($new_pass));
		$this->Registrasiusermodel->edit_data('registrasi_user', $where, $datas);

		$this->session->set_flashdata('kode_name', 'success');
		$this->session->set_flashdata('icon_name', 'check');
		$this->session->set_flashdata('message_name', 'Password Baru Anda Adalah ' . $new_pass . ', Terima Kasih.');
		redirect(base_url("admin/index"), 'refresh');
	}



	public function dropdown4($id = null, $filters = '')
	{
		//if ($this->input->is_ajax_request()) {
		//$this->load->model('helpdesksubprojectmodel');
		$filters .= "id_prop = '" . urldecode($id) . "' AND status='Aktif'";
		$order = " nama_kota ASC";

		$rsData = $this->Registrasiusermodel->get_kota_by_prop($filters, $order); //exit(show_last_query());
		echo json_encode($rsData);
		//}
		return;
	}

	public function dropdown5($id = null, $filters = '')
	{
		//if ($this->input->is_ajax_request()) {
		//$this->load->model('helpdesksubprojectmodel');
		$filters .= "id_prop = '" . urldecode($id) . "' ";
		$order = " nama_kota ASC";

		$rsData = $this->Registrasiusermodel->get_kota_by_prop($filters, $order); //exit(show_last_query());
		echo json_encode($rsData);
		//}
		return;
	}

	public function dropdown6($id_prop = null, $id_kota = null, $filters = '')
	{

		//if ($this->input->is_ajax_request()) {
		//$this->load->model('helpdesksubprojectmodel');
		$filters .= "id_prop = '" . urldecode($id_prop) . "' AND id_kota = '" . urldecode($id_kota) . "' ";
		$order = " nama_camat ASC";

		$rsData = $this->Registrasiusermodel->get_kec_by_kota_prop($filters, $order); //exit(show_last_query());
		echo json_encode($rsData);
		//}
		return;
	}

	public function kirim_kode_faskes_to_inm()
	{
		$post = $this->input->post();
		if (isset($post['submit'])) {

			$wheregetkodefaskes = array('kode_faskes' => $post['kode_faskes']);

			$data['trans_final'] = $this->Registrasiusermodel->gettransfinal($post['kode_faskes']);

			$data['data'] = $this->Registrasiusermodel->getbylistpendaftaran($data['trans_final'][0]['id_faskes']);

			$wheregetkodelink = array('link_pusdatin' => $data['trans_final'][0]['id_link']);
			$data['kab_kota_new'] = $this->Registrasiusermodel->select_data('kab_kota_new', $wheregetkodelink)->result_array();

			if ($post['jenis_kategori'] == 'klinik') {


				$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_klinik'], $data['data'][0]['jenis_satker'], $data['data'][0]['id_kota'], $data['trans_final'][0]['kode_faskes_lama'], $data['data'][0]['jenis_klinik_data_klinik'], '', $data['data'][0]['jenis_perawatan'], $data['trans_final'][0]['kode_faskes_baru']);
			} else if ($post['jenis_kategori'] == 'pm') {
				$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_pm'], 'tpmd', $data['data'][0]['id_kota'], '', 'tpmd', $data['data'][0]['jenis_tpmd'], '', $data['trans_final'][0]['kode_faskes_baru']);
			} else if ($post['jenis_kategori'] == 'lab') {
				$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_lab'], $data['data'][0]['jenis_satker'], $data['data'][0]['id_kota'], $data['trans_final'][0]['kode_faskes_lama'], $data['data'][0]['jenis_lab'], '', '', $data['trans_final'][0]['kode_faskes_baru']);
			} else if ($post['jenis_kategori'] == 'utd') {
				$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_utd'], 'utd', $data['data'][0]['id_kota'], $data['trans_final'][0]['kode_faskes_lama'], $data['data'][0]['jenis_klinik_data_klinik'], '', '', $data['trans_final'][0]['kode_faskes_baru']);
			} else if ($post['jenis_kategori'] == 'rs') {

				$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_rs'], 'rs', $data['data'][0]['id_kota'], $data['trans_final'][0]['kode_faskes_lama'], $data['data'][0]['jenis_rs'], '', '', '');

				/*$this->service_kirim_kode_rs($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_rs'], $data['data'][0]['kelas'], $data['data'][0]['nama_kota'], $data['trans_final'][0]['kode_faskes_lama'], $data['data'][0]['jenis_rs'], $data['data'][0]['nama_prop'], $data['trans_final'][0]['create_trans'], $data['data'][0]['nama_direktur'], $data['data'][0]['alamat_rs'], $data['data'][0]['no_telp_rs'], $data['data'][0]['email_rs'], $data['data'][0]['website_rs'], $data['data'][0]['luas_tanah_rs'], $data['data'][0]['luas_bangunan_rs'], $data['data'][0]['nomor_surat_izin_usaha_rs'], $data['data'][0]['tanggal_surat_izin_usaha_rs'], $data['data'][0]['tanggal_berlaku_surat_izin_usaha'], $data['data'][0]['tahun_berdiri_rs'], $data['data'][0]['status_blu_rs'], $data['data'][0]['simrs'], $data['trans_final'][0]['link'], $data['data'][0]['nama_penyelenggara'], $data['data'][0]['nama_kepemilikan'], $data['kab_kota_new'][0]['propinsi_kode'], $data['kab_kota_new'][0]['link'], $data['data'][0]['kepemilikan']);*/

				$this->service_kirim_reg_rs($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_rs'], $data['data'][0]['kelas'], $data['data'][0]['nama_kota'], $data['trans_final'][0]['kode_faskes_lama'], $data['data'][0]['jenis_rs'], $data['data'][0]['nama_prop'], $data['trans_final'][0]['create_trans'], $data['data'][0]['nama_direktur'], $data['data'][0]['alamat_rs'], $data['data'][0]['no_telp_rs'], $data['data'][0]['email_rs'], $data['data'][0]['website_rs'], $data['data'][0]['luas_tanah_rs'], $data['data'][0]['luas_bangunan_rs'], $data['data'][0]['nomor_surat_izin_usaha_rs'], $data['data'][0]['tanggal_surat_izin_usaha_rs'], $data['data'][0]['tanggal_berlaku_surat_izin_usaha'], $data['data'][0]['tahun_berdiri_rs'], $data['data'][0]['status_blu_rs'], $data['data'][0]['simrs'], $data['trans_final'][0]['link'], $data['data'][0]['nama_penyelenggara'], $data['data'][0]['nama_kepemilikan'], $data['kab_kota_new'][0]['propinsi_kode'], $data['kab_kota_new'][0]['link'], $data['data'][0]['kepemilikan']);
			}



			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Kirim Data!');
			//redirect('register/kirim_kode_faskes_to_inm');
		}
		$this->template->utama('register/input_kode_faskes', $data);
	}


	public function getlonglatbykodefaskes()
	{

		$body = file_get_contents("php://input");
		$post = json_decode($body);

		$headers = apache_request_headers();

		$requestContentType = $headers['Content-Type'];
		$requestmethod = $_SERVER['REQUEST_METHOD'];
		$xid = isset($headers['X-id']) ? $headers['X-id'] : $headers['X-id'];
		$password = $headers['X-pass'];
		$body = file_get_contents("php://input");

		$body = json_decode($body);

		if ($requestmethod == 'POST') {

			if ($xid == "registrasifasyankes" && $password == md5("fasyankes54321")) {

				$sql = $this->db->query("SELECT gabung.latitude,gabung.longitude
FROM
(
SELECT
	kategori.kategori_user, data_klinik.latitude,data_klinik.longitude
FROM
	trans_final 
	INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
	LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
	LEFT JOIN data_klinik ON trans_final.id_faskes = data_klinik.id_faskes
WHERE
	trans_final.kode_faskes = '" . $post->kodefasyankes . "'
	UNION ALL
	SELECT
	kategori.kategori_user, data_labkes.latitude,data_labkes.longitude
FROM
	trans_final 
	INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
	LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
	LEFT JOIN data_labkes ON trans_final.id_faskes = data_labkes.id_faskes
WHERE
	trans_final.kode_faskes = '" . $post->kodefasyankes . "'
	UNION ALL
	SELECT
	kategori.kategori_user, data_rs.latitude,data_rs.longitude
FROM
	trans_final 
	INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
	LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
	LEFT JOIN data_rs ON trans_final.id_faskes = data_rs.id_faskes
WHERE
	trans_final.kode_faskes = '" . $post->kodefasyankes . "'
	UNION ALL
	SELECT
	kategori.kategori_user, data_utd.latitude,data_utd.longitude
FROM
	trans_final 
	INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
	LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
	LEFT JOIN data_utd ON trans_final.id_faskes = data_utd.id_faskes
WHERE
	trans_final.kode_faskes = '" . $post->kodefasyankes . "'
	UNION ALL
	SELECT
	kategori.kategori_user, data_pm.latitude,data_pm.longitude
FROM
	trans_final 
	INNER JOIN registrasi_user ON trans_final.id_faskes = registrasi_user.id AND registrasi_user.validate='2'
	LEFT JOIN kategori ON registrasi_user.id_kategori = kategori.id
	LEFT JOIN data_pm ON trans_final.id_faskes = data_pm.id_faskes
WHERE
	trans_final.kode_faskes = '" . $post->kodefasyankes . "'
	) gabung WHERE gabung.latitude IS NOT NULL AND gabung.longitude IS NOT NULL");
				$data = $sql->result_array();

				if (!empty($data)) {
					echo '{"Code":"200","pesan":"Sukses","data":' . json_encode($data) . '}';
				} else {
					echo '{"Code":"401","pesan":"Kode Fasyankes Tidak Ditemukan!"}';
				}
			} else {
				echo '{"Code":"401","pesan":"Autentication failed"}';
			}
		} else {
			echo '{"Code":"401","pesan":"Method Hanya POST"}';
		}
	}

	function service_kirim_kode($kode, $nama, $jenis, $kota, $kode_lama, $jenis_klinik, $jenis_tpmd, $jenis_perawatan, $kodesatkerbaru)
	{

		$xid = 'mutukemenkes';
		$time = time();
		date_default_timezone_set('UTC');
		$data_send = '{"kodesatker":"' . $kode . '","namasatker":"' . $nama . '","jenis_satker":"' . $jenis . '","kodekota":"' . $kota . '","kodelama":"' . $kode_lama . '","jenis":"' . strtolower($jenis_klinik) . '","jenis_tpmd":"' . $jenis_tpmd . '","jenisklinik":"' . $jenis_perawatan . '","kodesatkerbaru":"' . $kodesatkerbaru . '"}';
		$url = "https://mutufasyankes.kemkes.go.id/api/insert_satker";
		$process = curl_init($url);
		curl_setopt(
			$process,
			CURLOPT_HTTPHEADER,
			array("Content-Type: application/json\r\n" . "X-Id:$xid\r\n" . "X-Timestamp:$time")
		);
		curl_setopt($process, CURLOPT_HEADER, false);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_POST, true);
		curl_setopt($process, CURLOPT_POSTFIELDS, $data_send);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$return = curl_exec($process);
		curl_close($process);
		$response2 = (object) json_decode($return);
		$sml = $response2;
		// var_dump($sml);
		//echo 'aa';
		var_dump($return);
	}


	function service_kirim_kode_rs($kode, $nama, $kelas, $kota, $kode_lama, $jenis_rs, $prov, $create_trans, $nama_direktur, $alamat_faskes, $no_telp_rs, $email_rs, $website_rs, $luas_tanah_rs, $luas_bangunan_rs, $nomor_surat_izin_usaha_rs, $tanggal_surat_izin_usaha_rs, $tanggal_berlaku_surat_izin_usaha, $tahun_berdiri_rs, $status_blu_rs, $simrs, $link, $nama_penyelenggara, $nama_kepemilikan, $id_prov, $id_kota, $kepemilikan)
	{
		$xid = 'regfasyankes';
		$time = time();
		$xpass = '@R3gf45yanK3s!';
		$xappauth = 'cfe6fd00816330ad7f18d8e6a12d879693c3ee2321631b7fb17dd914b0625853';

		date_default_timezone_set('UTC');
		$data_send = '{
   "Propinsi" : "' . $kode . '",
   "TglReg" : "' . date('Y-m-d', strtotime($create_trans)) . '",
   "RUMAH_SAKIT" : "' . $nama . '",
   "JENIS" : "' . $jenis_rs . '",
   "KLS_RS" : "' . $kelas . '",
   "DIREKTUR_RS" : "' . $nama_direktur . '",
   "ALAMAT" : "' . $alamat_faskes . '",
   "STATUS_PENYELENGGARA" : "' . $nama_kepemilikan . '",
   "KAB/KOTA" : "' . $kota . '",
   "KODE" : "-",
   "TELEPON" : "' . $no_telp_rs . '",
   "FAX" : "-",
   "EMAIL" : "' . $email_rs . '",
   "TELEPON_HUMAS" : "' . $no_telp_rs . '",
   "WEBSITE" : "' . $website_rs . '",
   "LUAS_TANAH" : "' . $luas_tanah_rs . '",
   "LUAS_BANGUNAN" : "' . $luas_bangunan_rs . '",
   "NO_SURAT_IJIN" : "' . $nomor_surat_izin_usaha_rs . '",
   "TANGGAL_SURAT_IJIN" : "' . $tanggal_surat_izin_usaha_rs . '",
   "OLEH_SURAT_IJIN" : "-",
   "SIFAT_SURAT_IJIN" : "-",
   "MASA_BERLAKU_SURAT_IJIN" : "' . $tanggal_berlaku_surat_izin_usaha . '",
   "NAMA_PENYELENGGARA" : "' . $nama_penyelenggara . '",
   "PENYELENGGARA" : "' . $kepemilikan . '",
   "SWASTA" : "-",
   "PENTAHAPAN_AKREDITASI" : "-",
   "STATUS_AKREDITASI" : "-",
   "Tglakreditas" : "-",
   "keterangan_akreditasi" : "-",
   "target_akreditasi" : "-",
   "aktive" : "1",
   "profile" : "-",
   "usrpwd2" : "' . $id_prov . '",
   "provinsi_id" : "' . substr($id_prov, 0, 2) . '",
   "TANGGAL_UPDATE" : "' . date('Y-m-d') . '",
   "today" : "' . date('Y-m-d H:i:s') . '",
   "link" : "' . $id_kota . '",
   "kab_kota_id" : "' . $id_kota . '",
   "ambulan" : "-",
   "simrs" : "' . ($simrs == 'Punya' ? '1' : '0') . '",
   "bank_darah" : "-",
   "layanan_unggulan" : "-",
   "blu" : "' . $status_blu_rs . '",
   "masa_berlaku_surat" : "-",
   "masa_berlaku_akreditasi" : "-",
   "status_kirim_sisrute" : "-",
   "tahun_berdiri" : "' . $tahun_berdiri_rs . '",
   "valid_agustus" : "-",
   "rujukan_pie" : "1",
   "kerjasama_bpjs" : "-",
   "kerjasama_bpjs" : "-",
   "tanggal_mulai_kerjasama" : "-",
   "tgl_sk_tempattidur" : "-",
   "no_sk_tt" : "-",
   "akreditasi_internasional" : "-",
   "rs_pendidikan" : "-",
   "no_sk_rspendidikan" : "-",
   "tgl_sk_rspendidikan" : "-",
   "rs_ipwl" : "-",
   "no_sk_ipwl" : "-",
   "tgl_sk_ipwl" : "-",
   "komite_bankdarah" : "-",
   "audit_bankdarah" : "-",
   "kepala_farmasi" : "-",
   "nokepala_farmasi" : "-",
   "email_farmasi" : "-",
   "kerjasama_psef" : "-",
   "kerjasama_fkfkg" : "-"
}';
		//var_dump($data_send);exit();
		$url = "https://sirs.kemkes.go.id/fo/index.php/Fasyankes/reg_rs";
		$process = curl_init($url);
		curl_setopt(
			$process,
			CURLOPT_HTTPHEADER,
			array("Content-Type: application/json\r\n" . "x-rs-id:$xid\r\n" . "x-timestamp:$time\r\n" . "x-pass:$xpass\r\n" . "x-app-auth:$xappauth")
		);
		curl_setopt($process, CURLOPT_HEADER, false);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_POST, true);
		curl_setopt($process, CURLOPT_POSTFIELDS, $data_send);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$return = curl_exec($process);

		curl_close($process);
		$response2 = (object) json_decode($return);
		$sml = $response2;
		var_dump($sml);
	}

	public function cek_service()
	{
		$this->load->model('Registrasiusermodel');
		$query = $this->Registrasiusermodel->cek_service(date('Y-m-d'));





		foreach ($query as $key => $value) {

			$email  = urldecode($value['email']);
			$title   = "Registrasi Fasyankes(UTD)";
			$message = "Tanggal Berakhir Surat Izin UTD anda 3 Bulan Lagi Akan Habis!";

			$mail = $this->send_email("infoyankes@kemkes.go.id", "Sekretariat Direktorat Jenderal Pelayanan Kesehatan", "n3nceY@D", $title, $email, urldecode($email), $message);

			$where = array('id' => $value['id']);
			$datas = array('flag_kirim_email_tanggal_berakhir_surat_izin' => 1);
			$this->Registrasiusermodel->edit_data('data_utd', $where, $datas);
		}
		/* $where = array('email' =>urldecode($email));
		 $datas = array('kata_sandi' =>md5($new_pass));	
		 $this->Registrasiusermodel->edit_data('registrasi_user',$where,$datas);*/
	}


	public function map_dev()
	{
		$this->load->model('Registrasiusermodel');
		$this->load->view('register/map_dev', $data);
	}

	public function landing_page()
	{
		//$this->load->model('Registrasiusermodel');
		$this->load->view('register/landing_page', $data);
	}




	public function check_captcha()
	{
		$vals = [
			'word'          => substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8),
			'img_path'      => './assets/images/captcha/',
			'img_url'       => base_url('assets/images/captcha/'),
			'img_width'     => '150',
			'img_height'    => 30,
			'expiration'    => 7200,
			'word_length'   => 8,
			'font_size'     => 16,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

			'colors'        => [
				'background' => [255, 255, 255],
				'border'    => [255, 255, 255],
				'text'      => [0, 0, 0],
				'grid'      => [255, 40, 40]
			]
		];

		$captcha = create_captcha($vals);

		$this->session->set_userdata('captcha', $captcha['word']);
		$this->load->view('register/captcha.php', ['captcha' => $captcha['image']]);
	}

	public function check_captcha_fix()
	{
		$post_code  = $this->input->post('captcha');
		$captcha    = $this->session->userdata('captcha');

		if ($post_code && ($post_code == $captcha))
			$this->session->set_flashdata('pesan_form', '<font style="color: green"><b>Berhasil memverifikasi captcha.</b></font><br/><br/>');
		else
			$this->session->set_flashdata('pesan_form', '<font style="color: red"><b>Captcha yang Anda ketik salah!</b></font><br/><br/>');

		redirect('register/check_captcha');
	}

	/* public function test(){
		phpinfo();
	}
	 */
	public function service_kirim_reg_rs($kode, $nama, $kelas, $kota, $kode_lama, $jenis_rs, $prov, $create_trans, $nama_direktur, $alamat_faskes, $no_telp_rs, $email_rs, $website_rs, $luas_tanah_rs, $luas_bangunan_rs, $nomor_surat_izin_usaha_rs, $tanggal_surat_izin_usaha_rs, $tanggal_berlaku_surat_izin_usaha, $tahun_berdiri_rs, $status_blu_rs, $simrs, $link, $nama_penyelenggara, $nama_kepemilikan, $id_prov, $id_kota, $kepemilikan)
	{
		$data_send = array(
			'Propinsi' => $kode,
			'TglReg' => date('Y-m-d', strtotime($create_trans)),
			'RUMAH_SAKIT' => $nama,
			'JENIS' => $jenis_rs,
			'KLS_RS' => $kelas,
			'DIREKTUR_RS' => $nama_direktur,
			'ALAMAT' => $alamat_faskes,
			'STATUS_PENYELENGGARA' => $nama_kepemilikan,
			'KAB/KOTA' => $kota,
			'KODE' => '-',
			'TELEPON' => $no_telp_rs,
			'FAX' => '-',
			'EMAIL' => $email_rs,
			'TELEPON_HUMAS' => $no_telp_rs,
			'WEBSITE' => $website_rs,
			'LUAS_TANAH' => $luas_tanah_rs,
			'LUAS_BANGUNAN' => $luas_bangunan_rs,
			'NO_SURAT_IJIN' => $nomor_surat_izin_usaha_rs,
			'TANGGAL_SURAT_IJIN' => $tanggal_surat_izin_usaha_rs,
			'OLEH_SURAT_IJIN' => '-',
			'SIFAT_SURAT_IJIN' => '-',
			'MASA_BERLAKU_SURAT_IJIN' => $tanggal_berlaku_surat_izin_usaha,
			'NAMA_PENYELENGGARA' => $nama_penyelenggara,
			'PENYELENGGARA' => $kepemilikan,
			'SWASTA' => '-',
			'PENTAHAPAN_AKREDITASI' => '-',
			'STATUS_AKREDITASI' => '-',
			'Tglakreditas' => '-',
			'keterangan_akreditasi' => '-',
			'target_akreditasi' => '-',
			'aktive' => '1',
			'profile' => '-',
			'usrpwd2' => $id_prov,
			'provinsi_id' => substr($id_prov, 0, 2),
			'TANGGAL_UPDATE' => date('Y-m-d'),
			'today' => date('Y-m-d H:i:s'),
			'link' => $id_kota,
			'kab_kota_id' => $id_kota,
			'ambulan' => '-',
			'simrs' => ($simrs == 'Punya' ? '1' : '0'),
			'bank_darah' => '-',
			'layanan_unggulan' => '-',
			'blu' => $status_blu_rs,
			'masa_berlaku_surat' => '-',
			'masa_berlaku_akreditasi' => '-',
			'status_kirim_sisrute' => '-',
			'tahun_berdiri' => $tahun_berdiri_rs,
			'valid_agustus' => '-',
			'rujukan_pie' => '1',
			'kerjasama_bpjs' => '-',
			'kerjasama_bpjs' => '-',
			'tanggal_mulai_kerjasama' => '-',
			'tgl_sk_tempattidur' => '-',
			'no_sk_tt' => '-',
			'akreditasi_internasional' => '-',
			'rs_pendidikan' => '-',
			'no_sk_rspendidikan' => '-',
			'tgl_sk_rspendidikan' => '-',
			'rs_ipwl' => '-',
			'no_sk_ipwl' => '-',
			'tgl_sk_ipwl' => '-',
			'komite_bankdarah' => '-',
			'audit_bankdarah' => '-',
			'kepala_farmasi' => '-',
			'nokepala_farmasi' => '-',
			'email_farmasi' => '-',
			'kerjasama_psef' => '-',
			'kerjasama_fkfkg' => '-'
		);

		// var_dump($data_send);
		$dibuat = date('Y-m-d', strtotime($create_trans));
		$prov_id = substr($id_prov, 0, 2);
		$query = ("INSERT INTO `db_fasyankes`.`data` (
        `Propinsi`, `TglReg`, `RUMAH_SAKIT`, `JENIS`, `KLS_RS`, `DIREKTUR_RS`, `ALAMAT`, `STATUS_PENYELENGGARA`, `KAB/KOTA`, `KODE`, `TELEPON`, `FAX`, `EMAIL`, `TELEPON_HUMAS`, `WEBSITE`, `LUAS_TANAH`, 
        `LUAS_BANGUNAN`, `NO_SURAT_IJIN`, `TANGGAL_SURAT_IJIN`, `OLEH_SURAT_IJIN`, `SIFAT_SURAT_IJIN`, `MASA_BERLAKU_SURAT_IJIN`, `NAMA_PENYELENGGARA`, `PENYELENGGARA`, `SWASTA`, `PENTAHAPAN_AKREDITASI`, 
        `STATUS_AKREDITASI`, `Tglakreditas`, `keterangan_akreditasi`, `target_akreditasi`, `aktive`, `profile`, `usrpwd2`, `provinsi_id`, `TANGGAL_UPDATE`, `today`, `link`, `kab_kota_id`, `ambulan`, `simrs`, 
        `bank_darah`, `layanan_unggulan`, `blu`, `masa_berlaku_surat`, `masa_berlaku_akreditasi`, `status_kirim_sisrute`, `tahun_berdiri`, `valid_agustus`, `rujukan_pie`, `kerjasama_bpjs`, `tanggal_mulai_kerjasama`, 
        `tgl_sk_tempattidur`, `no_sk_tt`, `akreditasi_internasional`, `rs_pendidikan`, `no_sk_rspendidikan`, `tgl_sk_rspendidikan`, `rs_ipwl`, `no_sk_ipwl`, `tgl_sk_ipwl`, `komite_bankdarah`, `audit_bankdarah`, 
        `kepala_farmasi`, `nokepala_farmasi`, `email_farmasi`, `kerjasama_psef`, `kerjasama_fkfkg`) 
        VALUES ($kode,
             '$dibuat',
             '$nama' ,
             $jenis_rs ,
             $kelas ,
             '$nama_direktur' ,
             '$alamat_faskes' ,
             '$nama_kepemilikan' ,
             '$kota' ,
              '-',
             '$no_telp_rs' ,
              '-',
             '$email_rs' ,
             '$no_telp_rs' ,
             '$website_rs' ,
             '$luas_tanah_rs' ,
             '$luas_bangunan_rs' ,
             '$nomor_surat_izin_usaha_rs' ,
             '$tanggal_surat_izin_usaha_rs' ,
              '-',
              '-',
             '$tanggal_berlaku_surat_izin_usaha' ,
             '$nama_penyelenggara' ,
             '$kepemilikan' ,
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              1,
              '-',
             '$id_prov' ,
             $prov_id,
             date(now()) ,
             now() ,
             $id_kota ,
             $id_kota ,
              '-',
             0,
              '-',
              '-',
             '$status_blu_rs' ,
              '-',
              '-',
              '-',
             '$tahun_berdiri_rs' ,
              '-',
              1,
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-',
              '-')");
		$this->psc->query($query);
		//print_r($this->psc->last_query());

		$sml = "Registrasi RS Berhasil Disimpan";
		var_dump($sml);
	}
}
