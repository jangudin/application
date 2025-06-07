<?php
class Labkes extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("admin"));
		}

		$this->load->library('pagination');
		$this->load->model('registrasiusermodel');
		$this->load->model('labkesmodel');
		$this->load->model('loginmodel');
		$this->load->library('encrypt.php');
		define('MB', 1048576);
	}

	function list_user_yang_mengajukan_labkes_utama($id = 0)
	{
		$data['data']['query'] = $this->labkesmodel->getlistpengajuanlabkes($this->session->userdata('id_kategori'), $this->session->userdata('id_kota'), 'Utama');
		$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes_utama', $data);
	}

	function list_user_yang_mengajukan_labkes_utama_belum_validasi($id = 0)
	{
		$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasilabkes($this->session->userdata('id_kategori'), $this->session->userdata('id_kota'), 'Utama');
		$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes_utama_belum_validasi', $data);
	}

	function list_user_yang_mengajukan_labkes_utama_perbaikan($id = 0)
	{
		$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasiperbaikanlabkes($this->session->userdata('id_kategori'), $this->session->userdata('id_kota'), 'Utama');
		$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes_utama_perbaikan', $data);
	}

	function list_user_yang_mengajukan_labkes_pratama($id = 0)
	{
		$data['data']['query'] = $this->labkesmodel->getlistpengajuanlabkes($this->session->userdata('id_kategori'), $this->session->userdata('id_kota'), 'Pratama', $this->session->userdata('id_prov'));
		$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes_pratama', $data);
	}

	function list_user_yang_mengajukan_labkes_pratama_belum_validasi($idx = 0)
	{
		$id = $this->encrypt->decode($idx);
		$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasilabkes($this->session->userdata('id_kategori'), $this->session->userdata('id_kota'), 'Pratama', $this->session->userdata('id_prov'));
		$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes_pratama_belum_validasi', $data);
	}

	function list_user_yang_mengajukan_labkes_pratama_perbaikan($id = 0)
	{
		$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasiperbaikanlabkes($this->session->userdata('id_kategori'), $this->session->userdata('id_kota'), 'Pratama', $this->session->userdata('id_prov'));
		$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes_pratama_perbaikan', $data);
	}


	function list_user_yang_mengajukan_labkes($idx = 0)
	{
		$id = $this->encrypt->decode($idx);
		$data['data']['query'] = $this->labkesmodel->getlistpengajuanlabkes($this->session->userdata('id_kategori'), $this->session->userdata('id_kota'));
		$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes', $data);
	}

	function list_user_yang_mengajukan_belum_validasi_labkes($idx = 0)
	{
		$id = $this->encrypt->decode($idx);
		$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasilabkes($this->session->userdata('id_kategori'), $this->session->userdata('id_kota'));
		$this->template->utama('adminlabkes/list_user_yang_mengajukan_belum_validasi_labkes', $data);
	}

	function list_user_yang_mengajukan_belum_validasi_perbaikan_labkes($id = 0)
	{
		$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasiperbaikanlabkes($this->session->userdata('id_kategori'), $this->session->userdata('id_kota'));
		$this->template->utama('adminlabkes/list_user_yang_mengajukan_belum_validasi_perbaikan_labkes', $data);
	}


	function verifikasi_pengajuan_faskes_labkes($idx = NULL)
	{
		$id = $this->encrypt->decode($idx);
		// $id = $idx;
		$post = $this->input->post();

		if (isset($post['submit'])) {
			$json_validasi = '{"field":{"nama_lab_validasi":{"nilai":"' . (isset($post["nama_lab_validasi"]) ? $post["nama_lab_validasi"] : null) . '","keterangan":"' . (isset($post["keterangan_nama_lab_validasi"]) ? $post["keterangan_nama_lab_validasi"] : null) . '"},"pemilik_validasi":{"nilai":"' . (isset($post["pemilik_validasi"]) ? $post["pemilik_validasi"] : null) . '","keterangan":"' . (isset($post["keterangan_pemilik_validasi"]) ? $post["keterangan_pemilik_validasi"] : null) . '"},"alamat_validasi":{"nilai":"' . (isset($post["alamat_validasi"]) ? $post["alamat_validasi"] : null) . '","keterangan":"' . (isset($post["keterangan_alamat_validasi"]) ? $post["keterangan_alamat_validasi"] : null) . '"} }}';

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);

			$datas_detail = array(
				'validasi_field' => $json_validasi
			);

			$this->registrasiusermodel->edit_data('data_labkes', $where2, $datas_detail);
			//echo $this->db->last_query();


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Di Validasi');
			redirect('labkes/verifikasi_pengajuan_faskes_labkes/' . $id);
		}

		$data['data'] = $this->labkesmodel->getdatalabkes($id);

		$data['user_id'] = $id;

		$this->template->utama('adminlabkes/verifikasi_pengajuan_faskes_labkes', $data);
	}


	function verifikasi_pengajuan_faskes_labkes_copy($idx = NULL)
	{
		// $id = $this->encrypt->decode($idx);
		$id = $idx;
		$post = $this->input->post();

		if (isset($post['submit'])) {
			$json_validasi = '{"field":{"nama_lab_validasi":{"nilai":"' . (isset($post["nama_lab_validasi"]) ? $post["nama_lab_validasi"] : null) . '","keterangan":"' . (isset($post["keterangan_nama_lab_validasi"]) ? $post["keterangan_nama_lab_validasi"] : null) . '"},"pemilik_validasi":{"nilai":"' . (isset($post["pemilik_validasi"]) ? $post["pemilik_validasi"] : null) . '","keterangan":"' . (isset($post["keterangan_pemilik_validasi"]) ? $post["keterangan_pemilik_validasi"] : null) . '"},"alamat_validasi":{"nilai":"' . (isset($post["alamat_validasi"]) ? $post["alamat_validasi"] : null) . '","keterangan":"' . (isset($post["keterangan_alamat_validasi"]) ? $post["keterangan_alamat_validasi"] : null) . '"} }}';

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);

			$datas_detail = array(
				'validasi_field' => $json_validasi
			);

			$this->registrasiusermodel->edit_data('data_labkes', $where2, $datas_detail);
			//echo $this->db->last_query();


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Di Validasi');
			redirect('labkes/verifikasi_pengajuan_faskes_labkes/' . $id);
		}

		$data['data'] = $this->labkesmodel->getdatalabkes($id);

		$data['user_id'] = $id;

		print_r($data);

		// $this->template->utama('adminlabkes/verifikasi_pengajuan_faskes_labkes', $data);
	}


	function verifikasi_pengajuan_faskes_alkes_labkes($idx = NULL)
	{

		$id = $this->encrypt->decode($idx);

		$where = array('id_faskes' => $id);
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatasarprasalkeslabkes($id);
		$data['user'] = $this->registrasiusermodel->getdatalabkes($id);
		$data['user_id'] = $id;
		$post = $this->input->post();



		$this->template->utama('adminlabkes/verifikasi_pengajuan_faskes_alkes_labkes', $data);
	}

	function verifikasi_pengajuan_faskes_sdm_labkes($idx = NULL)
	{
		$id = $this->encrypt->decode($idx);
		$post = $this->input->post();

		//$data['user']= $this->registrasiusermodel->getdatauser($id);	
		$data['user'] = $this->registrasiusermodel->getdatalabkes($id);
		$data['data'] = $this->registrasiusermodel->getdatasdmlabkes($id);
		$data['user_id'] = $id;

		$this->template->utama('adminlabkes/verifikasi_pengajuan_faskes_sdm_labkes', $data);
	}


	function verifikasi_pengajuan_faskes_jenis_pemeriksaan_labkes($idx = NULL)
	{
		$id = $this->encrypt->decode($idx);
		$post = $this->input->post();

		//$data['user']= $this->registrasiusermodel->getdatauser($id);	
		$data['user'] = $this->registrasiusermodel->getdatalabkes($id);
		$data['data'] = $this->registrasiusermodel->getdatajenispemeriksaanlabkes($id);
		$data['user_id'] = $id;

		$this->template->utama('adminlabkes/verifikasi_pengajuan_faskes_jenis_pemeriksaan_labkes', $data);
	}


	function verifikasikan_kirim_labkes($idx = NULL)
	{
		$id = $this->encrypt->decode($idx);
		$post = $this->input->post();
		if (isset($post['submit'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);

			$datas_detail = array(
				'id_link' => $post["kota"]
			);

			$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Kirim Ke Dinkes Terkait!');
			redirect('labkes/verifikasikan_kirim_labkes/' . $id);
		}


		if (isset($post['submit_validasi'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);

			if ($post["jenis_pratama_utama"] == 'Pratama') {
				$datas_detail = array('id_validate_kota' => $this->session->userdata('user_id'), 'status_validasi_kota' => 'Sudah Validasi', 'status_validasi_prov' => 'Belum Validasi');
			} else if ($post["jenis_pratama_utama"] == 'Utama') {
				$datas_detail = array('id_validate_kota' => $this->session->userdata('user_id'), 'status_validasi_kota' => 'Sudah Validasi', 'status_validasi_kemkes' => 'Belum Validasi');
			}


			$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);

			$datas_log = array(
				'id_faskes' => $post["id_faskes"],
				'id_dinkes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Di Setujui Oleh Dinkes Kota'
			);
			$where = array('id_faskes' => $post["id_faskes"]);
			$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
			// $this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"]);


			$this->registrasiusermodel->input_data('timeline', $datas_log);
			if ($post["jenis_pratama_utama"] == 'Utama') {
				$dinkes_kemkes = 'Kemkes';
			} else {
				$dinkes_kemkes = 'Dinkes Provinsi';
			}

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Data Akan Di Teruskan Ke ' . $dinkes_kemkes . ' Terkait');
			redirect('labkes/verifikasikan_kirim_labkes/' . $id);
		}


		/* 	if(isset($post['submit_setujui'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); 
				$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


						$datas_detail = array('token_kode_faskes' =>$token,'id_validate_prov' =>$this->session->userdata('user_id'));
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Di Setujui Oleh Dinkes Provinsi'
				);
					$where = array('id_faskes' => $post["id_faskes"]);
					$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
				    $this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"]);
				
				
					$this->registrasiusermodel->input_data('timeline',$datas_log);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Pemberitahuan Akan Di Kirimkan Melalui Aplikasi Registrasi Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi');
					redirect('labkes/verifikasikan_kirim_labkes/'.$id);
				} */

		if (isset($post['submit_setujui_prov'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
			$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


			$datas_detail = array('token_kode_faskes' => $token, 'id_validate_prov' => $this->session->userdata('user_id'), 'status_validasi_prov' => 'Sudah Validasi');

			$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);

			$datas_log = array(
				'id_faskes' => $post["id_faskes"],
				'id_dinkes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Di Setujui Oleh Dinkes Provinsi'
			);
			$where = array('id_faskes' => $post["id_faskes"]);
			$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
			$this->validasi_link_kode_faskes($token, $data['data2'][0]["id_link"], $id, $data['data2'][0]["kode_regional_link"]);


			$this->registrasiusermodel->input_data('timeline', $datas_log);


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Pemberitahuan Akan Di Kirimkan Melalui Aplikasi Registrasi Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi');
			redirect('labkes/verifikasikan_kirim_labkes/' . $id);
		}


		if (isset($post['submit_setujui_kemkes'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
			$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


			$datas_detail = array('token_kode_faskes' => $token, 'id_validate_kemkes' => $this->session->userdata('user_id'), 'status_validasi_kemkes' => 'Sudah Validasi');

			$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);

			$datas_log = array(
				'id_faskes' => $post["id_faskes"],
				'id_dinkes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Di Setujui Oleh Kemkes'
			);
			$where = array('id_faskes' => $post["id_faskes"]);
			$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
			$this->validasi_link_kode_faskes($token, $data['data2'][0]["id_link"], $id, $data['data2'][0]["kode_regional_link"]);


			$this->registrasiusermodel->input_data('timeline', $datas_log);


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Pemberitahuan Akan Di Kirimkan Melalui Aplikasi Registrasi Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi');
			redirect('labkes/verifikasikan_kirim_labkes/' . $id);
		}

		if (isset($post['submit_perbaikan'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
			//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);

			if ($post["jenis_pratama_utama"] == 'Pratama') {
				$datas_detail = array('final' => 0, 'catatan' => $post["catatan"], 'token_kode_faskes' => '', 'id_validate_kota' => null, 'status_validasi_kota' => 'Perbaikan', 'status_validasi_prov' => '');
			} else if ($post["jenis_pratama_utama"] == 'Utama') {
				$datas_detail = array('final' => 0, 'catatan' => $post["catatan"], 'token_kode_faskes' => '', 'id_validate_kota' => null, 'status_validasi_kota' => 'Perbaikan', 'status_validasi_kemkes' => '');
			}


			$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);

			$datas_log = array(
				'id_faskes' => $post["id_faskes"],
				'id_dinkes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Minta Diperbaiki Oleh Dinkes Kab/Kota Ke User Labkes/Bank Jaringan(' . $post["catatan"] . ')'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);



			$data['data'] = $this->registrasiusermodel->getbylistpendaftaran($post["id_faskes"]);
			$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
			$data['trans_final'] = $this->registrasiusermodel->select_data('trans_final', $wheregetkodefaskes)->result_array();
			$email  = $data['data'][0]['email'];
			$title   = "Registrasi Faskes";
			$message = "Yth,<br><br>
		" . $data['data'][0]['nama_lengkap'] . ",
		<br><br>
		Selamat datang di Aplikasi Registrasi Faskes Online.<br>
		Data Fasyankes Anda Di minta Untuk Diperbaiki, Harap Buka Aplikasi https://registrasifasyankes.kemkes.go.id
		<br><br>
		Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
		egistrasifasyankes@kemkes.go.id<br>
		<br><br>
		Salam<br>
		Sekretariat Direktorat Jenderal Pelayanan Kesehatan";

			//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
			$mail = $this->send_email("infoyankes@kemkes.go.id", "Sekretariat Direktorat Jenderal Pelayanan Kesehatan", "n3nceY@D", $title, $email, $data['data'][0]['nama_lengkap'], $message);


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
			redirect('labkes/verifikasikan_kirim_labkes/' . $id);
		}


		if (isset($post['submit_perbaikan_prov'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
			//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


			$datas_detail = array('id_validate_kota' => null, 'catatan' => $post["catatan"], 'status_validasi_kota' => 'Belum Validasi', 'status_validasi_prov' => 'Perbaikan');

			$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);
			//echo  $this->db->last_query();
			//exit();
			$datas_log = array(
				'id_faskes' => $post["id_faskes"],
				'id_dinkes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Minta Diperbaiki Oleh Dinkes Provinsi Ke Dinkes Kota(' . $post["catatan"] . ')'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);





			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
			redirect('labkes/verifikasikan_kirim_labkes/' . $id);
		}

		if (isset($post['submit_perbaikan_kemkes'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
			//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


			$datas_detail = array('id_validate_kota' => null, 'catatan' => $post["catatan"], 'status_validasi_kota' => 'Belum Validasi', 'status_validasi_kemkes' => 'Perbaikan');

			$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);
			//	echo  $this->db->last_query();
			//exit();
			$datas_log = array(
				'id_faskes' => $post["id_faskes"],
				'id_dinkes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Minta Diperbaiki Oleh Kemkes Ke Dinkes Kota(' . $post["catatan"] . ')'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);





			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
			redirect('labkes/verifikasikan_kirim_labkes/' . $id);
		}

		$where = array('id_faskes' => $id);
		$data['data'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->getdatalabkes($id);


		$data['user_id'] = $id;

		$this->template->utama('adminlabkes/verifikasikan_kirim_labkes', $data);
	}


	public function inputan_data_faskes_labkes()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));

		$post = $this->input->post();


		if (isset($post['submit'])) {

			// $type1 = explode('.', $_FILES["upload_surat_permohonan_kode_lab_medis"]["name"]); // data file
			// $type1 = strtolower($type1[count($type1) - 1]); // data type like .jpg//exit(dump($type));
			// $filename1 = "upload_surat_permohonan_kode_lab_medis" . uniqid(rand()) . '.' . $type1;
			// $inputFileName1 = "./assets/uploads/berkas_operasional/" . $filename1; // hash unik
			// $surat_permohonan_kode_lab_medis = $post['old_surat_permohonan_kode_lab_medis'];

			// $type2 = explode('.', $_FILES["upload_surat_izin_operasional_lab_medis"]["name"]); // data file
			// $type2 = strtolower($type2[count($type2) - 1]); // data type like .jpg//exit(dump($type));
			// $filename2 = "upload_surat_izin_operasional_lab_medis" . uniqid(rand()) . '.' . $type2;
			// $inputFileName2 = "./assets/uploads/berkas_operasional/" . $filename2; // hash unik
			// $surat_izin_operasional_lab_medis = $post['old_surat_izin_operasional_lab_medis'];

			// $type3 = explode('.', $_FILES["upload_visi_misi"]["name"]); // data file
			// $type3 = strtolower($type3[count($type3) - 1]); // data type like .jpg//exit(dump($type));
			// $filename3 = "upload_visi_misi" . uniqid(rand()) . '.' . $type3;
			// $inputFileName3 = "./assets/uploads/berkas_operasional/" . $filename3; // hash unik
			// $surat_visi_misi = $post['old_visi_misi'];

			// $type4 = explode('.', $_FILES["upload_struktur_organisasi"]["name"]); // data file
			// $type4 = strtolower($type4[count($type4) - 1]); // data type like .jpg//exit(dump($type));
			// $filename4 = "upload_struktur_organisasi" . uniqid(rand()) . '.' . $type4;
			// $inputFileName4 = "./assets/uploads/berkas_operasional/" . $filename4; // hash unik
			// $surat_struktur_organisasi = $post['old_struktur_organisasi'];

			// $type5 = explode('.', $_FILES["upload_dokumen_sertifikat_dokumen"]["name"]); // data file
			// $type5 = strtolower($type5[count($type5) - 1]); // data type like .jpg//exit(dump($type));
			// $filename5 = "upload_dokumen_sertifikat_dokumen" . uniqid(rand()) . '.' . $type5;
			// $inputFileName5 = "./assets/uploads/berkas_operasional/" . $filename5; // hash unik
			// $surat_dokumen_sertifikat_dokumen = $post['old_dokumen_sertifikat_dokumen'];





			// if (!empty($_FILES["upload_surat_permohonan_kode_lab_medis"]["name"])) {
			// 	if (in_array($type1, array("pdf"))) {


			// 		// if (is_uploaded_file($_FILES["upload_surat_permohonan_kode_lab_medis"]["tmp_name"])) {

			// 		// 	if (move_uploaded_file($_FILES["upload_surat_permohonan_kode_lab_medis"]["tmp_name"], $inputFileName1)) {
			// 		// 		$surat_permohonan_kode_lab_medis = $filename1;
			// 		// 	}
			// 		// }
			// 	} else {
			// 		$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			// 		$this->session->set_flashdata('icon_name', 'warning');
			// 		$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
			// 		redirect('labkes/inputan_data_faskes_labkes');
			// 	}
			// }

			// if (!empty($_FILES["upload_surat_izin_operasional_lab_medis"]["name"])) {
			// 	if (in_array($type2, array("pdf"))) {



			// 		// if (is_uploaded_file($_FILES["upload_surat_izin_operasional_lab_medis"]["tmp_name"])) {

			// 		// 	if (move_uploaded_file($_FILES["upload_surat_izin_operasional_lab_medis"]["tmp_name"], $inputFileName2)) {
			// 		// 		$surat_izin_operasional_lab_medis = $filename2;
			// 		// 	}
			// 		// }
			// 	} else {
			// 		$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			// 		$this->session->set_flashdata('icon_name', 'warning');
			// 		$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
			// 		redirect('labkes/inputan_data_faskes_labkes');
			// 	}
			// }

			// if (!empty($_FILES["upload_visi_misi"]["name"])) {
			// 	if (in_array($type3, array("pdf"))) {



			// 		// if (is_uploaded_file($_FILES["upload_visi_misi"]["tmp_name"])) {

			// 		// 	if (move_uploaded_file($_FILES["upload_visi_misi"]["tmp_name"], $inputFileName3)) {
			// 		// 		$surat_visi_misi = $filename3;
			// 		// 	}
			// 		// }
			// 	} else {
			// 		$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			// 		$this->session->set_flashdata('icon_name', 'warning');
			// 		$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
			// 		redirect('labkes/inputan_data_faskes_labkes');
			// 	}
			// }

			// if (!empty($_FILES["upload_struktur_organisasi"]["name"])) {
			// 	if (in_array($type4, array("pdf"))) {


			// 		// if (is_uploaded_file($_FILES["upload_struktur_organisasi"]["tmp_name"])) {

			// 		// 	if (move_uploaded_file($_FILES["upload_struktur_organisasi"]["tmp_name"], $inputFileName4)) {
			// 		// 		$surat_struktur_organisasi = $filename4;
			// 		// 	}
			// 		// }
			// 	} else {
			// 		$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			// 		$this->session->set_flashdata('icon_name', 'warning');
			// 		$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
			// 		redirect('labkes/inputan_data_faskes_labkes');
			// 	}
			// }



			// if (!empty($_FILES["upload_dokumen_sertifikat_dokumen"]["name"])) {
			// 	if (in_array($type5, array("pdf"))) {




			// 		// if (is_uploaded_file($_FILES["upload_dokumen_sertifikat_dokumen"]["tmp_name"])) {

			// 		// 	if (move_uploaded_file($_FILES["upload_dokumen_sertifikat_dokumen"]["tmp_name"], $inputFileName5)) {
			// 		// 		$surat_dokumen_sertifikat_dokumen = $filename5;
			// 		// 	}
			// 		// }
			// 	} else {
			// 		$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			// 		$this->session->set_flashdata('icon_name', 'warning');
			// 		$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
			// 		redirect('labkes/inputan_data_faskes_labkes');
			// 	}
			// }

			$jenis_pelayanan = implode(",", $post['jenis_pelayanan']);
			$pelayanan_lain = implode(",", $post['pelayanan_lain']);
			$bentuk_pelayanan = implode(",", $post['bentuk_pelayanan']);
			/* if(in_array('Bank Jaringan',$post['jenis_pelayanan'])){
				$var_bank_jaringan="Utama";
			}else{
				$var_bank_jaringan=$post['jenis_lab'];
			} */
			$datas = array(
				'nama_lab' => $post['nama_lab'],
				'jenis_pelayanan' => $post['jenis_pelayanan'],
				'jenis_lab' => $post['jenis_lab'],
				'lab_medis_khusus' => $post['lab_medis_khusus'],
				'bentuk_pelayanan' => $bentuk_pelayanan,
				'bentuk_lab' => $post['bentuk_lab'],
				'pelayanan_lain' => $pelayanan_lain,
				'nama_fasyankes_terintegrasi' => $post['nama_fasyankes_terintegrasi'],
				'pemilik' => $post['pemilik'],
				'nama_pemilik' => $post['nama_pemilik'],
				'rumah_sakit_yang_bekerja_sama' => $post['rumah_sakit_yang_bekerja_sama'],
				'alamat_faskes' => $post['alamat_faskes'],
				'id_prov' => $post['id_prov'],
				'id_kota' => $post['id_kota'],
				'id_camat' => $post['id_camat'],
				'no_telp' => $post['no_telp'],
				'email' => $post['email'],
				'id_faskes' => $post['id_faskes'],
				'upload_surat_permohonan_kode_lab_medis' => $post['upload_surat_permohonan_kode_lab_medis'],
				'upload_surat_izin_operasional_lab_medis' => $post['upload_surat_izin_operasional_lab_medis'],
				'tanggal_berakhir_izin_operasional' => date('Y-m-d', strtotime($post['tanggal_berakhir_izin_operasional'])),
				'upload_visi_misi' => $post['upload_visi_misi'],
				'upload_struktur_organisasi' => $post['upload_struktur_organisasi'],
				'status_akreditasi' => $post['status_akreditasi'],
				'tanggal_berakhir_sertifikat_akreditasi' => date('Y-m-d', strtotime($post['tanggal_berakhir_sertifikat_akreditasi'])),
				'upload_dokumen_sertifikat_dokumen' => $post['upload_dokumen_sertifikat_dokumen'],
				'rencana_survey_akreditasi' => date('Y-m-d', strtotime($post['rencana_survey_akreditasi'])),
				'latitude' => $post['latitude'],
				'longitude' => $post['longitude']
			);







			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('data_labkes', $where, $datas);
				$this->registrasiusermodel->edit_data('registrasi_user', array('id' => $post['id_faskes']), array('id_camat' => $post['id_camat']));
				if ($post['jenis_perawatan_old'] != $post['jenis_perawatan']) {
					$where2 = array(
						'id_faskes' => $post["id_faskes"]
					);
					$this->registrasiusermodel->delete_data('trans_labkes_sarpras_alkes', $where2);
				}

				if ($post['jenis_klinik_old'] != $post['jenis_klinik']) {
					$where2 = array(
						'id_faskes' => $post["id_faskes"]
					);
					$this->registrasiusermodel->delete_data('trans_labkes_sdm', $where2);
				}

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data Labkes'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			} else {

				$this->registrasiusermodel->input_data('data_labkes', $datas);
				//echo  $this->db->last_query();
				//exit();
				//exit();
				//$id = $this->db->insert_id();
				$this->registrasiusermodel->edit_data('registrasi_user', array('id' => $post['id_faskes']), array('id_camat' => $post['id_camat']));
				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Labkes'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			}


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('labkes/inputan_data_faskes_labkes');
		}

		$this->template->utama('datalabkes/index', $data);
	}
	public function inputan_data_faskes_labkes_dev()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));

		$post = $this->input->post();


		if (isset($post['submit'])) {

			$type1 = explode('.', $_FILES["upload_surat_permohonan_kode_lab_medis"]["name"]); // data file
			$type1 = strtolower($type1[count($type1) - 1]); // data type like .jpg//exit(dump($type));
			$filename1 = "upload_surat_permohonan_kode_lab_medis" . uniqid(rand()) . '.' . $type1;
			$inputFileName1 = "./assets/uploads/berkas_operasional/" . $filename1; // hash unik
			$surat_permohonan_kode_lab_medis = $post['old_surat_permohonan_kode_lab_medis'];

			$type2 = explode('.', $_FILES["upload_surat_izin_operasional_lab_medis"]["name"]); // data file
			$type2 = strtolower($type2[count($type2) - 1]); // data type like .jpg//exit(dump($type));
			$filename2 = "upload_surat_izin_operasional_lab_medis" . uniqid(rand()) . '.' . $type2;
			$inputFileName2 = "./assets/uploads/berkas_operasional/" . $filename2; // hash unik
			$surat_izin_operasional_lab_medis = $post['old_surat_izin_operasional_lab_medis'];

			$type3 = explode('.', $_FILES["upload_visi_misi"]["name"]); // data file
			$type3 = strtolower($type3[count($type3) - 1]); // data type like .jpg//exit(dump($type));
			$filename3 = "upload_visi_misi" . uniqid(rand()) . '.' . $type3;
			$inputFileName3 = "./assets/uploads/berkas_operasional/" . $filename3; // hash unik
			$surat_visi_misi = $post['old_visi_misi'];

			$type4 = explode('.', $_FILES["upload_struktur_organisasi"]["name"]); // data file
			$type4 = strtolower($type4[count($type4) - 1]); // data type like .jpg//exit(dump($type));
			$filename4 = "upload_struktur_organisasi" . uniqid(rand()) . '.' . $type4;
			$inputFileName4 = "./assets/uploads/berkas_operasional/" . $filename4; // hash unik
			$surat_struktur_organisasi = $post['old_struktur_organisasi'];

			$type5 = explode('.', $_FILES["upload_dokumen_sertifikat_dokumen"]["name"]); // data file
			$type5 = strtolower($type5[count($type5) - 1]); // data type like .jpg//exit(dump($type));
			$filename5 = "upload_dokumen_sertifikat_dokumen" . uniqid(rand()) . '.' . $type5;
			$inputFileName5 = "./assets/uploads/berkas_operasional/" . $filename5; // hash unik
			$surat_dokumen_sertifikat_dokumen = $post['old_dokumen_sertifikat_dokumen'];





			if (!empty($_FILES["upload_surat_permohonan_kode_lab_medis"]["name"])) {
				if (in_array($type1, array("pdf"))) {


					if (is_uploaded_file($_FILES["upload_surat_permohonan_kode_lab_medis"]["tmp_name"])) {

						if (move_uploaded_file($_FILES["upload_surat_permohonan_kode_lab_medis"]["tmp_name"], $inputFileName1)) {
							$surat_permohonan_kode_lab_medis = $filename1;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('labkes/inputan_data_faskes_labkes');
				}
			}

			if (!empty($_FILES["upload_surat_izin_operasional_lab_medis"]["name"])) {
				if (in_array($type2, array("pdf"))) {



					if (is_uploaded_file($_FILES["upload_surat_izin_operasional_lab_medis"]["tmp_name"])) {

						if (move_uploaded_file($_FILES["upload_surat_izin_operasional_lab_medis"]["tmp_name"], $inputFileName2)) {
							$surat_izin_operasional_lab_medis = $filename2;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('labkes/inputan_data_faskes_labkes');
				}
			}

			if (!empty($_FILES["upload_visi_misi"]["name"])) {
				if (in_array($type3, array("pdf"))) {



					if (is_uploaded_file($_FILES["upload_visi_misi"]["tmp_name"])) {

						if (move_uploaded_file($_FILES["upload_visi_misi"]["tmp_name"], $inputFileName3)) {
							$surat_visi_misi = $filename3;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('labkes/inputan_data_faskes_labkes');
				}
			}

			if (!empty($_FILES["upload_struktur_organisasi"]["name"])) {
				if (in_array($type4, array("pdf"))) {


					if (is_uploaded_file($_FILES["upload_struktur_organisasi"]["tmp_name"])) {

						if (move_uploaded_file($_FILES["upload_struktur_organisasi"]["tmp_name"], $inputFileName4)) {
							$surat_struktur_organisasi = $filename4;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('labkes/inputan_data_faskes_labkes');
				}
			}



			if (!empty($_FILES["upload_dokumen_sertifikat_dokumen"]["name"])) {
				if (in_array($type5, array("pdf"))) {




					if (is_uploaded_file($_FILES["upload_dokumen_sertifikat_dokumen"]["tmp_name"])) {

						if (move_uploaded_file($_FILES["upload_dokumen_sertifikat_dokumen"]["tmp_name"], $inputFileName5)) {
							$surat_dokumen_sertifikat_dokumen = $filename5;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('labkes/inputan_data_faskes_labkes');
				}
			}

			$jenis_pelayanan = implode(",", $post['jenis_pelayanan']);
			$pelayanan_lain = implode(",", $post['pelayanan_lain']);
			$bentuk_pelayanan = implode(",", $post['bentuk_pelayanan']);
			/* if(in_array('Bank Jaringan',$post['jenis_pelayanan'])){
			$var_bank_jaringan="Utama";
		}else{
			$var_bank_jaringan=$post['jenis_lab'];
		} */
			$datas = array(
				'nama_lab' => $post['nama_lab'],
				'jenis_pelayanan' => $post['jenis_pelayanan'],
				'jenis_lab' => $post['jenis_lab'],
				'lab_medis_khusus' => $post['lab_medis_khusus'],
				'bentuk_pelayanan' => $bentuk_pelayanan,
				'bentuk_lab' => $post['bentuk_lab'],
				'pelayanan_lain' => $pelayanan_lain,
				'nama_fasyankes_terintegrasi' => $post['nama_fasyankes_terintegrasi'],
				'pemilik' => $post['pemilik'],
				'nama_pemilik' => $post['nama_pemilik'],
				'rumah_sakit_yang_bekerja_sama' => $post['rumah_sakit_yang_bekerja_sama'],
				'alamat_faskes' => $post['alamat_faskes'],
				'id_prov' => $post['id_prov'],
				'id_kota' => $post['id_kota'],
				'id_camat' => $post['id_camat'],
				'no_telp' => $post['no_telp'],
				'email' => $post['email'],
				'id_faskes' => $post['id_faskes'],
				'upload_surat_permohonan_kode_lab_medis' => $surat_permohonan_kode_lab_medis,
				'upload_surat_izin_operasional_lab_medis' => $surat_izin_operasional_lab_medis,
				'tanggal_berakhir_izin_operasional' => date('Y-m-d', strtotime($post['tanggal_berakhir_izin_operasional'])),
				'upload_visi_misi' => $surat_visi_misi,
				'upload_struktur_organisasi' => $surat_struktur_organisasi,
				'status_akreditasi' => $post['status_akreditasi'],
				'tanggal_berakhir_sertifikat_akreditasi' => date('Y-m-d', strtotime($post['tanggal_berakhir_sertifikat_akreditasi'])),
				'upload_dokumen_sertifikat_dokumen' => $surat_dokumen_sertifikat_dokumen,
				'rencana_survey_akreditasi' => date('Y-m-d', strtotime($post['rencana_survey_akreditasi'])),
				'latitude' => $post['latitude'],
				'longitude' => $post['longitude']
			);







			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('data_labkes', $where, $datas);
				$this->registrasiusermodel->edit_data('registrasi_user', array('id' => $post['id_faskes']), array('id_camat' => $post['id_camat']));
				if ($post['jenis_perawatan_old'] != $post['jenis_perawatan']) {
					$where2 = array(
						'id_faskes' => $post["id_faskes"]
					);
					$this->registrasiusermodel->delete_data('trans_labkes_sarpras_alkes', $where2);
				}

				if ($post['jenis_klinik_old'] != $post['jenis_klinik']) {
					$where2 = array(
						'id_faskes' => $post["id_faskes"]
					);
					$this->registrasiusermodel->delete_data('trans_labkes_sdm', $where2);
				}

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data Labkes'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			} else {

				$this->registrasiusermodel->input_data('data_labkes', $datas);
				//echo  $this->db->last_query();
				//exit();
				//exit();
				//$id = $this->db->insert_id();
				$this->registrasiusermodel->edit_data('registrasi_user', array('id' => $post['id_faskes']), array('id_camat' => $post['id_camat']));
				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Labkes'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			}


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('labkes/inputan_data_faskes_labkes_dev');
		}

		$this->template->utama('datalabkes/dev/index', $data);
	}


	public function inputan_data_sarpras_alkes_labkes()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatasarprasalkeslabkes($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
		$data['user_id'] = $this->session->userdata('user_id');
		$post = $this->input->post();

		if (isset($post['submit'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			$this->registrasiusermodel->delete_data('trans_labkes_sarpras_alkes', $where2);

			foreach ($post['id_sarpras_alkes'] as $ids) {

				$datas_detail = array(
					'id_faskes' => $post['id_faskes'],
					'id_sarpras_alkes' => $ids,
					'isian' => $post['isian'][$ids],
					'keterangan' => $post['keterangan'][$ids]
				);


				$this->registrasiusermodel->input_data('trans_labkes_sarpras_alkes', $datas_detail);
				//echo $this->db->last_query();
				//exit();
			}

			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Sarpras Alkes Labkes'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('labkes/inputan_data_sarpras_alkes_labkes/');
		}

		$this->template->utama('datalabkes/index_sarpras_alkes_labkes', $data);
	}

	public function inputan_data_sdm_labkes($id = NULL)
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user'] = $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
		$data['data'] = $this->registrasiusermodel->getdatasdmlabkes($this->session->userdata('user_id'));

		$data['user_id'] = $this->session->userdata('user_id');
		$post = $this->input->post();

		if (isset($post['submit'])) {




			$datas_detail = array(
				'id_faskes' => $post['id_faskes'],
				'nama' => $post['nama'],
				'id_jabatan' => $post['id_jabatan'],
				'id_pendidikan' => $post['id_pendidikan'],
				'keterangan' => $post['keterangan']
			);


			$this->registrasiusermodel->input_data('trans_labkes_sdm', $datas_detail);


			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data SDM'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('labkes/inputan_data_sdm_labkes/');
		}

		if (isset($id)) {
			$where2 = array(
				'id' => $id
			);
			$this->registrasiusermodel->delete_data('trans_labkes_sdm', $where2);
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Berhasil Hapus Data!');
			redirect('labkes/inputan_data_sdm_labkes/');
		}
		$this->template->utama('datalabkes/index_data_sdm_labkes', $data);
	}


	public function inputan_jenis_pemeriksaan_labkes($id = NULL, $status = NULL)
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user'] = $this->registrasiusermodel->select_data('data_labkes', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatajenispemeriksaanlabkes($this->session->userdata('user_id'));
		$data['user_id'] = $this->session->userdata('user_id');
		$post = $this->input->post();

		if (isset($post['submit'])) {

			// $type1 = explode('.', $_FILES["upload_dokumen_sip"]["name"]); // data file
			// $type1 = strtolower($type1[count($type1) - 1]); // data type like .jpg//exit(dump($type));
			// $filename1 = "upload_dokumen_sip" . uniqid(rand()) . '.' . $type1;
			// $inputFileName1 = "./assets/uploads/berkas_operasional/" . $filename1; // hash unik
			// $upload_dokumen_sip = $post['old_upload_dokumen_sip'];

			// if (!empty($_FILES["upload_dokumen_sip"]["name"])) {
			// 	if (in_array($type1, array("pdf"))) {
			// 		// if (is_uploaded_file($_FILES["upload_dokumen_sip"]["tmp_name"])) {

			// 		// 	if (move_uploaded_file($_FILES["upload_dokumen_sip"]["tmp_name"], $inputFileName1)) {
			// 		// 		$upload_dokumen_sip = $filename1;
			// 		// 	}
			// 		// }
			// 	} else {
			// 		$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			// 		$this->session->set_flashdata('icon_name', 'warning');
			// 		$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
			// 		redirect('labkes/inputan_jenis_pemeriksaan_labkes');
			// 	}
			// }

			// $type2 = explode('.', $_FILES["upload_dokumen_str"]["name"]); // data file
			// $type2 = strtolower($type2[count($type2) - 1]); // data type like .jpg//exit(dump($type));
			// $filename2 = "upload_dokumen_str" . uniqid(rand()) . '.' . $type2;
			// $inputFileName2 = "./assets/uploads/berkas_operasional/" . $filename2; // hash unik
			// $upload_dokumen_str = $post['old_upload_dokumen_str'];

			// if (!empty($_FILES["upload_dokumen_str"]["name"])) {
			// 	if (in_array($type2, array("pdf"))) {
			// 		// if (is_uploaded_file($_FILES["upload_dokumen_str"]["tmp_name"])) {

			// 		// 	if (move_uploaded_file($_FILES["upload_dokumen_str"]["tmp_name"], $inputFileName2)) {
			// 		// 		$upload_dokumen_str = $filename2;
			// 		// 	}
			// 		// }
			// 	} else {
			// 		$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			// 		$this->session->set_flashdata('icon_name', 'warning');
			// 		$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
			// 		redirect('labkes/inputan_jenis_pemeriksaan_labkes');
			// 	}
			// }


			// $type3 = explode('.', $_FILES["upload_dokumen_penddikan_dan_pelatihan"]["name"]); // data file
			// $type3 = strtolower($type3[count($type3) - 1]); // data type like .jpg//exit(dump($type));
			// $filename3 = "upload_dokumen_penddikan_dan_pelatihan" . uniqid(rand()) . '.' . $type3;
			// $inputFileName3 = "./assets/uploads/berkas_operasional/" . $filename3; // hash unik
			// $upload_dokumen_penddikan_dan_pelatihan = $post['old_upload_dokumen_penddikan_dan_pelatihan'];

			// if (!empty($_FILES["upload_dokumen_penddikan_dan_pelatihan"]["name"])) {
			// 	if (in_array($type3, array("pdf"))) {
			// 		// if (is_uploaded_file($_FILES["upload_dokumen_penddikan_dan_pelatihan"]["tmp_name"])) {

			// 		// 	if (move_uploaded_file($_FILES["upload_dokumen_penddikan_dan_pelatihan"]["tmp_name"], $inputFileName3)) {
			// 		// 		$upload_dokumen_penddikan_dan_pelatihan = $filename3;
			// 		// 	}
			// 		// }
			// 	} else {
			// 		$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			// 		$this->session->set_flashdata('icon_name', 'warning');
			// 		$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
			// 		redirect('labkes/inputan_jenis_pemeriksaan_labkes');
			// 	}
			// }



			$pemeriksaan_tambahan = implode(",", $post['pemeriksaan_tambahan']);
			$jenis_pemeriksaan = implode(",", $post['jenis_pemeriksaan']);
			$datas_detail = array(
				'id_faskes' => $post['id_faskes'],
				'type' => $post['type'],
				'nik' => $post['nik'],
				'nama' => $post['nama'],
				'fungsional' => $post['fungsional'],
				'fungsional_lainnya' => $post['fungsional_lainnya'],
				'sip' => $post['sip'],
				'sip_ke' => $post['sip_ke'],
				'upload_dokumen_sip' => $post['upload_dokumen_sip'],
				'tanggal_berakhir_sip' => date('Y-m-d', strtotime($post['tanggal_berakhir_sip'])),
				'str' => $post['str'],
				'upload_dokumen_str' => $post['upload_dokumen_str'],
				'tanggal_berakhir_str' => date('Y-m-d', strtotime($post['tanggal_berakhir_str'])),
				'penddikan_dan_pelatihan' => $post['penddikan_dan_pelatihan'],
				'upload_dokumen_penddikan_dan_pelatihan' => $post['upload_dokumen_penddikan_dan_pelatihan'],
				'tanggal_pendidikan_dan_pelatihan' => date('Y-m-d', strtotime($post['tanggal_pendidikan_dan_pelatihan'])),
				'jenis_pemeriksaan' => $jenis_pemeriksaan,
				'pemeriksaan_tambahan' => $pemeriksaan_tambahan,
				'pemeriksaan_tambahan_lainnya' => $post['pemeriksaan_tambahan_lainnya']
			);

			if ($post['action'] == 'edit') {
				$where_edit = array(
					'id' => $post['id_jenis_pemeriksaan']
				);

				$this->registrasiusermodel->edit_data('trans_labkes_jenis_pemeriksaan', $where_edit, $datas_detail);
			} else {
				$this->registrasiusermodel->input_data('trans_labkes_jenis_pemeriksaan', $datas_detail);
			}


			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Jenis Pemeriksaan'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('labkes/inputan_jenis_pemeriksaan_labkes/');
		}


		if (isset($id) && $status == 'edit') {
			$data['status'] = $status;
			$data['id_jenis_pemeriksaan'] = $id;
			$where2 = array('id' => $id);
			$data['data2'] = $this->registrasiusermodel->select_data('trans_labkes_jenis_pemeriksaan', $where2)->result_array();
		}

		if (isset($id) && $status == 'hapus') {
			$where2 = array(
				'id' => $id
			);
			$this->registrasiusermodel->delete_data('trans_labkes_jenis_pemeriksaan', $where2);
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Berhasil Hapus Data!');
			redirect('labkes/inputan_jenis_pemeriksaan_labkes/');
		}

		$this->template->utama('datalabkes/index_jenis_pemeriksaan_labkes', $data);
	}


	public function selesaikan_labkes()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user_id'] = $this->session->userdata('user_id');
		///$data['getdataklinik']= $this->registrasiusermodel->getdataklinik($this->session->userdata('user_id'));
		$data['getdatalabkes'] = $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$post = $this->input->post();

		if (isset($post['submit'])) {

			$validasi['labkes'] = $this->registrasiusermodel->select_count('data_labkes', $post["id_faskes"]);

			if ($validasi['labkes'][0]['jml'] == 0) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Data Dasar Belum DI Isi');
				redirect('labkes/selesaikan_labkes/');
			}

			$validasi['trans_labkes_sarpras_alkes'] = $this->registrasiusermodel->select_count('trans_labkes_sarpras_alkes', $post["id_faskes"]);
			if ($validasi['trans_labkes_sarpras_alkes'][0]['jml'] == 0) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Sarpras Alkes Belum DI Isi');
				redirect('labkes/selesaikan_labkes/');
			}

			$validasi['trans_labkes_sdm'] = $this->registrasiusermodel->select_count('trans_labkes_sdm', $post["id_faskes"]);
			if ($validasi['trans_labkes_sdm'][0]['jml'] == 0) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'SDM Belum DI Isi');
				redirect('labkes/selesaikan_labkes/');
			}

			$validasi['trans_labkes_jenis_pemeriksaan'] = $this->registrasiusermodel->select_count('trans_labkes_jenis_pemeriksaan', $post["id_faskes"]);
			if ($validasi['trans_labkes_jenis_pemeriksaan'][0]['jml'] == 0) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis Pemeriksaan Belum DI Isi');
				redirect('labkes/selesaikan_labkes/');
			}



			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			$this->registrasiusermodel->delete_data('trans_final', $where2);

			$datas_detail = array(
				'id_faskes' => $post["id_faskes"],
				'final' => 1,
				'id_link' => $post["id_kota"],
				'kode_faskes_lama' => $post["kode_faskes_lama"],
				'kode_regional_link' => $post["kode_regional"],
				'jenis_pratama_utama' => $post["jenis_pratama_utama"],
				'status_validasi_kota' => 'Belum Validasi'
			);


			$this->registrasiusermodel->input_data('trans_final', $datas_detail);

			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyelesaikan Data registrasi dan sudah diteruskan ke dinkes kota/provinsi terkait'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!, Data Akan DI Verifikasi, Pemberitahuan Akan Dikirimkan Ke Email!');
			redirect('labkes/selesaikan_labkes/');
		}

		$this->template->utama('datalabkes/selesaikan_labkes', $data);
	}


	function validasi_link_kode_faskes($token, $id_link, $id, $kode_regional_link)
	{

		$where = array(
			'token_kode_faskes' => $token,
			'validate_token' => 0
		);
		$cek = $this->loginmodel->cek_login("trans_final", $where)->num_rows();
		if ($cek > 0) {
			//$show_user = $this->loginmodel->cek_login("registrasi_user",$where)->result_array();

			$where_edit = array(
				'token_kode_faskes' => $token,
				'id_faskes' => $id
			);
			$datas = array(
				'validate_token' => 1,
				'kode_faskes' => $this->registrasiusermodel->findNoFaskesBaru($id_link, '7'),
				'kode_faskes_baru' => $this->registrasiusermodel->findNoFaskesBaru($id_link, '7'),
				'create_kode' => date('Y-m-d H:i:s')
			);
			$this->registrasiusermodel->edit_data('trans_final', $where_edit, $datas);


			$data['data'] = $this->registrasiusermodel->getbylistpendaftaran($id);
			$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
			$data['trans_final'] = $this->registrasiusermodel->select_data('trans_final', $wheregetkodefaskes)->result_array();
			$email  = $data['data'][0]['email'];
			$title   = "Registrasi Fasyankes";
			$message = "Yth,<br><br>
		" . $data['data'][0]['nama_lengkap'] . ",
		<br><br>
		Selamat datang di Aplikasi Registrasi Fasyankes Online.<br>
		Kode Fasyankes Anda : " . $data['trans_final'][0]['kode_faskes_baru'] . "
		<br><br>
		Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
		infoyankes@kemkes.go.id<br>
		<br><br>
		Salam<br>
		Sekretariat Direktorat Jenderal Pelayanan Kesehatan";

			//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
			$mail = $this->send_email("infoyankes@kemkes.go.id", "Sekretariat Direktorat Jenderal Pelayanan Kesehatan", "n3nceY@D", $title, $email, $data['data'][0]['nama_lengkap'], $message);


			$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_lab'], $data['data'][0]['jenis_satker'], $data['data'][0]['id_kota'], $data['trans_final'][0]['kode_faskes_lama'], $data['data'][0]['jenis_lab'], '', '', $data['trans_final'][0]['kode_faskes_baru']);

			if ($mail) {
				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Kode Fasyankes Sudah Aktif');
				redirect(base_url("labkes/verifikasikan_kirim_labkes/" . $id . ""));
			}
		} else {
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Link Aktifasi Tidak Valid Atau Sudah Dipakai!');
			redirect(base_url("admin/index"));
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
			return "201"; // jika pesan tidak terkirim
		} else {
			return "200"; //jika pesan terkirim
		}
		return $status;
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

	}



	public function dropdownLabkesJenispelayanan($jenis = null, $filters = '')
	{

		//if ($this->input->is_ajax_request()) {
		//$this->load->model('helpdesksubprojectmodel');
		$filters .= "1=1 AND parent LIKE '%" . urldecode($jenis) . "%' ";
		$order = " id ASC";

		$rsData = $this->registrasiusermodel->get_labkes_jenis_pelayanan($filters, $order); //exit(show_last_query());
		echo json_encode($rsData);
		//}
		return;
	}
}
