<?php
class Pm extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("admin"));
		}

		$this->load->library('pagination');
		$this->load->library('secure');
		$this->load->library('secure2');
		$this->load->model('registrasiusermodel');
		$this->load->model('labkesmodel');
		$this->load->model('rsmodel');
		$this->load->model('utdmodel');
		$this->load->model('pmmodel');
		$this->load->model('loginmodel');
		$this->load->model('reviewmodel');
		$this->load->model('pelaporanpmmodel');
		$this->load->model('akreditasipmmodel');
		define('MB', 1048576);
	}

	public function hapus_gambar()
	{
		// $this->registrasiusermodel->deletedatagambarpm($this->uri->segment(3));

		// $datas_log = array(
		// 	'id_faskes' =>$this->session->userdata('user_id'),
		// 	'status' =>''.$this->session->userdata('email').' Telah Menghapus Data Gambar Praktik Mandiri'
		// );
		// $this->registrasiusermodel->input_data('timeline',$datas_log);

		$where = array('id_faskes' => $this->session->userdata('user_id'), 'id' => $this->uri->segment(3));
		$this->registrasiusermodel->delete_data('t_img_faskes', $where);
		redirect('pm/inputan_data_gambar_pm');
	}

	public function hapus_data_sisdmk()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'), 'id' => $this->uri->segment(3));
		$where2 = array('id_faskes' => $this->session->userdata('user_id'), 'data_sisdmk_id' => $this->uri->segment(3));
		$datas = array(

			'is_active' => 0,
		);

		// $this->registrasiusermodel->delete_data('data_sisdmk_pekerjaan',$where2);
		// $this->registrasiusermodel->delete_data('data_sisdmk_pendidikan',$where2);
		$this->registrasiusermodel->edit_data('data_sisdmk', $where, $datas);

		redirect('pm/index_data_sisdmk');
	}

	public function selfAssessment()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$this->template->utama('datapm/index_assessment', $data);
	}


	public function inputan_data_gambar_pm()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['img'] = $this->registrasiusermodel->getdatagambarpm($this->session->userdata('user_id'));
		$data['obat'] = $this->registrasiusermodel->getdataobatnewpm($this->session->userdata('user_id'));
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));


		$post = $this->input->post();
		if (isset($post['submit'])) {

			$config['upload_path']          = 'assets/uploads/berkas_sip/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
			$config['max_size']             = 10000;
			$config['overwrite']            = true;
			$config['encrypt_name'] = TRUE;

			//$config['encrypt_name']      = TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('dokumen_gambar')) {
				print_r($this->upload->display_errors());
				exit;
				//echo $SURAT_PENGANTAR; exit;
			}
			$attachment = $this->upload->data();
			$fileName = $attachment['file_name'];

			$GAMBAR =  base_url('assets/uploads/berkas_sip/' . $fileName);

			///

			$datas = array(
				// 'id_faskes' =>$post['id_faskes'],
				// 'dokumen_sip'=>$dokumen_sip
				'gambar' => $post['gambar_kategori'],
				'keterangan' => "image",
				'id_faskes' => $this->session->userdata('user_id'),
				'url' => $fileName,
				'tgl_upload' => date('Y-m-d H:i:s'),
				'url_full' => $GAMBAR,
				'server_penyimpanan' => "registrasifasyankes"
			);

			$this->registrasiusermodel->input_data('t_img_faskes', $datas);
			// $id = $this->db->insert_id();
			// $this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat_pm' =>$post['id_camat_pm']));

			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Gambar Praktik Mandiri'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_data_gambar_pm');
		}
		$this->template->utama('datapm/index_gambar', $data);
	}

	public function inputan_data_pm()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));

		$post = $this->input->post();
		if (isset($post['submit'])) {
			$type1 = explode('.', $_FILES["dokumen_sip"]["name"]); // data file
			$type1 = strtolower($type1[count($type1) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename1 = "dokumen_sip" . uniqid(rand()) . '.' . $type1;
			$inputFileName1 = "./assets/uploads/berkas_sip/" . $filename1; // hash unik
			$dokumen_sip = $post['old_dokumen_sip'];


			$type2 = explode('.', $_FILES["dokumen_str"]["name"]); // data file
			$type2 = strtolower($type2[count($type2) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename2 = "dokumen_str" . uniqid(rand()) . '.' . $type2;
			$inputFileName2 = "./assets/uploads/berkas_str/" . $filename2; // hash unik
			$dokumen_str = $post['old_dokumen_str'];


			$type3 = explode('.', $_FILES["dokumen_registrasi"]["name"]); // data file
			$type3 = strtolower($type3[count($type3) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename3 = "dokumen_registrasi" . uniqid(rand()) . '.' . $type3;
			$inputFileName3 = "./assets/uploads/berkas_registrasi/" . $filename3; // hash unik
			$dokumen_registrasi = $post['old_dokumen_registrasi'];

			$type4 = explode('.', $_FILES["dokumen_kewenangan"]["name"]); // data file
			$type4 = strtolower($type4[count($type4) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename4 = "dokumen_kewenangan" . uniqid(rand()) . '.' . $type4;
			$inputFileName4 = "./assets/uploads/berkas_kewenangan/" . $filename4; // hash unik
			$dokumen_kewenangan = $post['old_dokumen_kewenangan'];

			$type5 = explode('.', $_FILES["dokumen_komitmen"]["name"]); // data file
			$type5 = strtolower($type5[count($type5) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename5 = "dokumen_komitmen" . uniqid(rand()) . '.' . $type5;
			$inputFileName5 = "./assets/uploads/berkas_registrasi/" . $filename5; // hash unik
			$dokumen_komitmen = $post['old_dokumen_komitmen'];

			if (!empty($_FILES["dokumen_sip"]["name"])) {
				if (in_array($type1, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_sip"]["tmp_name"])) {

						if (move_uploaded_file($_FILES["dokumen_sip"]["tmp_name"], $inputFileName1)) {
							$dokumen_sip = $filename1;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			if (!empty($_FILES["dokumen_str"]["name"])) {
				if (in_array($type2, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_str"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["dokumen_str"]["tmp_name"], $inputFileName2)) {
							$dokumen_str = $filename2;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			if (!empty($_FILES["dokumen_registrasi"]["name"])) {
				if (in_array($type3, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_registrasi"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["dokumen_registrasi"]["tmp_name"], $inputFileName3)) {
							$dokumen_registrasi = $filename3;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			if (!empty($_FILES["dokumen_kewenangan"]["name"])) {
				if (in_array($type4, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_kewenangan"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["dokumen_kewenangan"]["tmp_name"], $inputFileName4)) {
							$dokumen_kewenangan = $filename4;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			if (!empty($_FILES["dokumen_komitmen"]["name"])) {
				if (in_array($type5, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_komitmen"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["dokumen_komitmen"]["tmp_name"], $inputFileName5)) {
							$dokumen_komitmen = $filename5;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			$kewenangan_tambahan = implode(",", $post['kewenangan_tambahan']);
			$program_prioritas = implode(",", $post['program_prioritas']);
			$pelatihan_program_prioritas = implode(",", $post['pelatihan_program_prioritas']);
			$pelayanan_yang_diberikan = implode(",", $post['pelayanan_yang_diberikan']);

			$datas = array(
				'id_kategori' => $post['id_kategori'],
				'kerja_sama_bpjs_kesehatan' => $post['kerja_sama_bpjs_kesehatan'],
				'berjejaring_fktp' => $post['berjejaring_fktp'],
				'nama_pm' => $post['nama_pm'],
				'id_faskes' => $post['id_faskes'],
				'no_sip' => $post['no_sip'],
				'dokumen_sip' => $dokumen_sip,
				'sip_ke_berapa' => $post['sip_ke_berapa'],
				'tgl_berakhir_sip' => date('Y-m-d', strtotime($post['tgl_berakhir_sip'])),
				'no_str' => $post['no_str'],
				'dokumen_str' => $dokumen_str,
				'tgl_berakhir_str' => date('Y-m-d', strtotime($post['tgl_berakhir_str'])),
				'id_prov_pm' => $post['id_prov_pm'],
				'id_kota_pm' => $post['id_kota_pm'],
				'id_camat_pm' => $post['id_camat_pm'],
				'alamat_faskes' => $post['alamat_faskes'],
				'alamat_cetak_sertifikat' => $post['alamat_cetak_sertifikat'],
				'kepemilikan_tempat' => $post['kepemilikan_tempat'],
				'latitude' => $post['latitude'],
				'longitude' => $post['longitude'],
				'no_telp' => $post['no_telp'],
				'no_hp' => $post['no_hp'],
				'email' => $post['email'],
				'no_ktp' => $post['no_ktp'],

				'hotline' => $post['hotline'],
				'telp_kepala_faskes' => $post['telp_kepala_faskes'],

				'jam_praktik_senin_pagi' => $post['jam_praktik_senin_pagi'],
				'jam_praktik_senin_sore' => $post['jam_praktik_senin_sore'],
				'jam_praktik_selasa_pagi' => $post['jam_praktik_selasa_pagi'],
				'jam_praktik_selasa_sore' => $post['jam_praktik_selasa_sore'],

				'jam_praktik_rabu_pagi' => $post['jam_praktik_rabu_pagi'],
				'jam_praktik_rabu_sore' => $post['jam_praktik_rabu_sore'],
				'jam_praktik_kamis_pagi' => $post['jam_praktik_kamis_pagi'],
				'jam_praktik_kamis_sore' => $post['jam_praktik_kamis_sore'],

				'jam_praktik_jumat_pagi' => $post['jam_praktik_jumat_pagi'],
				'jam_praktik_jumat_sore' => $post['jam_praktik_jumat_sore'],
				'jam_praktik_sabtu_pagi' => $post['jam_praktik_sabtu_pagi'],
				'jam_praktik_sabtu_sore' => $post['jam_praktik_sabtu_sore'],

				'jam_praktik_minggu_pagi' => $post['jam_praktik_minggu_pagi'],
				'jam_praktik_minggu_sore' => $post['jam_praktik_minggu_sore'],

				'dokumen_registrasi' => $dokumen_registrasi,
				'puskesmas_pembina' => $post['puskesmas_pembina'],

				'cek_nik' => $post['cek_nik'],
				'cek_nama_pm' => $post['cek_nama_pm'],
				'cek_no_sip' => $post['cek_no_sip'],
				'cek_tgl_berakhir_sip' => $post['cek_tgl_berakhir_sip'],
				'cek_no_str' => $post['cek_no_str'],
				'cek_tgl_berakhir_str' => $post['cek_tgl_berakhir_str'],

				'status_pm' => 1,
				'str_seumur_hidup' => $post['str_seumur_hidup'],


				'dokumen_komitmen' => $dokumen_komitmen,
				//baru
				'berjejaring_puskesmas' => $post['berjejaring_puskesmas'],
				'dokumen_kewenangan' => $dokumen_kewenangan,
				'kewenangan_tambahan' => $kewenangan_tambahan,
				'kewenangan_tambahan_lainnya' => $post['kewenangan_tambahan_lainnya'],
				'pelatihan_program_prioritas' => $pelatihan_program_prioritas,
				'pelatihan_program_prioritas_lainnya' => $post['pelatihan_program_prioritas_lainnya'],
				'program_prioritas' => $program_prioritas,
				'program_prioritas_lainnya' => $post['program_prioritas_lainnya'],
				'pelayanan_yang_diberikan' => $pelayanan_yang_diberikan,
				// 'pelayanan_yang_diberikan_lainnya'=>$post['pelayanan_yang_diberikan_lainnya']
				'pelayanan_spesialistik_id' => $post['pelayanan_spesialistik_id']

			);

			// echo $datas;


			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('data_pm', $where, $datas);
				$this->registrasiusermodel->edit_data('registrasi_user', array('id' => $post['id_faskes']), array('id_camat_pm' => $post['id_camat_pm']));

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data Praktik Mandiri'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			} else {
				$this->registrasiusermodel->input_data('data_pm', $datas);
				$id = $this->db->insert_id();
				$this->registrasiusermodel->edit_data('registrasi_user', array('id' => $post['id_faskes']), array('id_camat_pm' => $post['id_camat_pm']));

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Praktik Mandiri'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			}


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_data_pm');
		}

		$this->template->utama('datapm/index', $data);
	}

	public function inputan_data_sarpras_alkes_pm()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['data'] = $this->registrasiusermodel->getdatasarprasalkespm($this->session->userdata('user_id'));
		$data['user_id'] = $this->session->userdata('user_id');

		$post = $this->input->post();

		if (isset($post['submit'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			$this->registrasiusermodel->delete_data('trans_sarpras_alkes_pm', $where2);

			foreach ($post['id_sarpras_alkes'] as $ids) {
				// var_dump($ids);
				$datas_detail = array(
					'id_faskes' => $post['id_faskes'],
					'id_sarpras_alkes' => $ids,
					'is_checked' => (isset($post['is_checked'][$ids]) == '1' ? $post['is_checked'][$ids]  : 0),
					'sub_keterangan' => (!empty($post['sub_keterangan'][$ids]) ? $post['sub_keterangan'][$ids]  : '')
				);


				// $this->pmmodel->input_data('trans_sarpras_alkes_pm',$datas_detail);
				$this->registrasiusermodel->input_data('trans_sarpras_alkes_pm', $datas_detail);
				// var_dump($datas_detail);
				// echo '</br>';
				//echo $this->db->last_query();
				//exit();
			}

			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Sarpras Alkes Praktik Mandiri'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_data_sarpras_alkes_pm/');
		} else {
			$this->template->utama('datapm/index_sarpras_alkes_pm', $data);
		}
	}

	public function inputan_data_alkes_obat_pm()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['data'] = $this->registrasiusermodel->getdataalkespm($this->session->userdata('user_id'));
		$data['user_id'] = $this->session->userdata('user_id');
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));


		$post = $this->input->post();

		if (isset($post['submit'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			$this->registrasiusermodel->delete_data('trans_alkes_pm', $where2);

			foreach ($post['id_alkes_obat'] as $ids) {

				$datas_detail = array(
					'id_faskes' => $post['id_faskes'],
					'id_alkes_obat' => $ids,
					'is_checked' => (isset($post['is_checked'][$ids]) == '1' ? $post['is_checked'][$ids]  : 0),
					'nilai_dua' => (!empty($post['nilai_dua'][$ids]) ? $post['nilai_dua'][$ids]  : ''),
					'nilai_tiga' => (!empty($post['nilai_tiga'][$ids]) ? $post['nilai_tiga'][$ids]  : '')
				);


				$this->registrasiusermodel->input_data('trans_alkes_pm', $datas_detail);
				//echo $this->db->last_query();
				//exit();
			}

			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Sarpras Alkes Praktik Mandiri'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_data_alkes_obat_pm/');
		}


		$this->template->utama('datapm/index_alkes_pm', $data);
	}

	public function inputan_data_obat_pm_lama()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['data'] = $this->registrasiusermodel->getdataobatpm($this->session->userdata('user_id'));
		$data['user_id'] = $this->session->userdata('user_id');

		$post = $this->input->post();

		if (isset($post['submit'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			$this->registrasiusermodel->delete_data('trans_obat_pm', $where2);

			foreach ($post['id_obat'] as $ids) {

				$datas_detail = array(
					'id_faskes' => $post['id_faskes'],
					'id_obat' => $ids,
					'is_checked' => (isset($post['is_checked'][$ids]) == '1' ? $post['is_checked'][$ids]  : 0),
					'nilai_dua' => (!empty($post['nilai_dua'][$ids]) ? $post['nilai_dua'][$ids]  : ''),
					'nilai_tiga' => (!empty($post['nilai_tiga'][$ids]) ? $post['nilai_tiga'][$ids]  : ''),
					'nilai_empat' => (!empty($post['nilai_empat'][$ids]) ? $post['nilai_empat'][$ids]  : '')
				);


				$this->registrasiusermodel->input_data('trans_obat_pm', $datas_detail);
				//echo $this->db->last_query();
				//exit();
			}

			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Sarpras Alkes Praktik Mandiri'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_data_obat_pm/');
		}


		$this->template->utama('datapm/index_obat_pm.php', $data);
	}

	public function inputan_data_sdm()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['data'] = $this->registrasiusermodel->getdatasdmpm($this->session->userdata('user_id'));
		$data['user_id'] = $this->session->userdata('user_id');

		$post = $this->input->post();

		if (isset($post['submit'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			$this->registrasiusermodel->delete_data('trans_sdm_pm', $where2);

			foreach ($post['id_sdm'] as $ids) {

				$datas_detail = array(
					'id_faskes' => $post['id_faskes'],
					'id_sdm' => $ids,
					'jumlah' => $post['jumlah'][$ids],
					'sub_keterangan' => (!empty($post['sub_keterangan'][$ids]) ? $post['sub_keterangan'][$ids]  : '')
				);

				$this->registrasiusermodel->input_data('trans_sdm_pm', $datas_detail);
			}


			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data SDM'
			);

			$this->registrasiusermodel->input_data('timeline', $datas_log);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_data_sdm/');
		}

		$this->template->utama('datapm/index_data_sdm', $data);
	}

	public function index_data_sisdmk()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$where2 = array('id_faskes' => $this->session->userdata('user_id'), 'is_active' => 1);
		$data['data'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user_id'] = $this->session->userdata('user_id');
		$data['getdatapm'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['img'] = $this->registrasiusermodel->getdatagambarpm($this->session->userdata('user_id'));
		$data['sisdmk'] = $this->registrasiusermodel->select_data('data_sisdmk_pm', $where)->result_array();
		$data['qr'] = $this->registrasiusermodel->select_data('qrapi', $where)->result_array();
		$data['data_sisdmk'] = $this->registrasiusermodel->select_data('data_sisdmk', $where2)->result_array();
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));
		// $data['pendidikan']= $this->registrasiusermodel->select_data('data_sisdmk_pendidikan',$where)->result_array();	
		// $data['pekerjaan']= $this->registrasiusermodel->select_data('data_sisdmk_pekerjaan',$where)->result_array();	

		$this->template->utama('datapm/index_sisdmk_all', $data);
	}

	public function index_data_sisdmk_detail()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user_id'] = $this->session->userdata('user_id');
		$data['getdatapm'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['img'] = $this->registrasiusermodel->getdatagambarpm($this->session->userdata('user_id'));
		$data['sisdmk'] = $this->registrasiusermodel->select_data('data_sisdmk', $where)->result_array();
		$data['qr'] = $this->registrasiusermodel->select_data('qrapi', $where)->result_array();

		$where2 = array('id' => $this->uri->segment(3));
		$where3 = array('data_sisdmk_id' => $this->uri->segment(3));
		$data['data_sisdmk'] = $this->registrasiusermodel->select_data('data_sisdmk', $where2)->result_array();
		$data['pendidikan'] = $this->registrasiusermodel->select_data('data_sisdmk_pendidikan', $where3)->result_array();
		$data['pekerjaan'] = $this->registrasiusermodel->select_data('data_sisdmk_pekerjaan', $where3)->result_array();

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$datas = array(
				'email' => $post["email"]
			);

			$where = array(
				'id' => $post['id_sisdmk']
			);
			$this->registrasiusermodel->edit_data('data_sisdmk', $where, $datas);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/index_data_sisdmk_detail/' . $post['id_sisdmk']);
		}

		$this->template->utama('datapm/index_sisdmk', $data);
	}

	public function selesaikan()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user_id'] = $this->session->userdata('user_id');
		$data['getdatapm'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['img'] = $this->registrasiusermodel->getdatagambarpm($this->session->userdata('user_id'));
		$data['sisdmk'] = $this->registrasiusermodel->select_data('data_sisdmk', $where)->result_array();
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));
		$data['qr'] = $this->registrasiusermodel->select_data('qrapi', $where)->result_array();
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$post = $this->input->post();

		if (isset($post['submit'])) {

			$validasi['pm'] = $this->registrasiusermodel->select_count('data_pm', $post["id_faskes"]);
			if ($validasi['pm'][0]['jml'] == 0) {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Praktik Mandiri Belum DI Isi');
				redirect('pm/selesaikan/');
			}

			// var_dump($this->session->userdata('id_kategori'));
			if ($this->session->userdata('id_kategori_pm') == 4 || $this->session->userdata('id_kategori_pm') == 5) {
				$validasi['trans_alkes_pm'] = $this->registrasiusermodel->select_count('trans_alkes_pm', $post["id_faskes"]);
				if ($validasi['trans_alkes_pm'][0]['jml'] == 0) {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Data Alkes Belum DI Isi');
					redirect('pm/selesaikan/');
				}

				$validasi['trans_obat_new_pm'] = $this->registrasiusermodel->select_count('trans_obat_new_pm', $post["id_faskes"]);
				if ($validasi['trans_obat_new_pm'][0]['jml'] == 0) {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Data Obat Belum DI Isi');
					redirect('pm/selesaikan/');
				}

				$validasi['t_img_faskes'] = $this->registrasiusermodel->select_count('t_img_faskes', $post["id_faskes"]);
				if ($validasi['t_img_faskes'][0]['jml'] == 0) {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Data Gambar Belum DI Isi');
					redirect('pm/selesaikan/');
				}
			} else {

				$validasi['trans_sarpras_alkes_pm'] = $this->registrasiusermodel->select_count('trans_sarpras_alkes_pm', $post["id_faskes"]);
				if ($validasi['trans_sarpras_alkes_pm'][0]['jml'] == 0) {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Sarpras Alkes Belum DI Isi');
					redirect('pm/selesaikan/');
				}

				$validasi['trans_sdm_pm'] = $this->registrasiusermodel->select_count('trans_sdm_pm', $post["id_faskes"]);
				if ($validasi['trans_sdm_pm'][0]['jml'] == 0) {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'SDM Belum DI Isi');
					redirect('pm/selesaikan/');
				}
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
				'kode_regional_link' => $post["kode_regional"]
			);


			$this->registrasiusermodel->input_data('trans_final', $datas_detail);

			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyelesaikan Data registrasi dan sudah diteruskan ke dinkes kota terkait'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!, Data Akan DI Verifikasi, Pemberitahuan Akan Dikirimkan Ke Email!');
			redirect('pm/selesaikan/');
		}

		$this->template->utama('datapm/selesaikan', $data);
	}

	function generateQR()
	{ {
			$where = array('id_faskes' => $this->session->userdata('user_id'));
			$data = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
			$user_id = $this->session->userdata('user_id');
			$getdatapm = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
			$user = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
			$img = $this->registrasiusermodel->getdatagambarpm($this->session->userdata('user_id'));
			$sisdmk = $this->registrasiusermodel->select_data('data_sisdmk', $where)->result_array();
			$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
			$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));

			$ch = curl_init();
			// $fc = $this->input->post('kode_faskes');
			// $strc = $this->input->post('no_str');
			// $nmd = $this->input->post('nama_pm');
			// $spcs = $this->input->post('specialization');
			$fc = $data[0]['kode_faskes'];
			$fl = $getdatapm[0]['nama_kota'];
			$id_faskes = $this->session->userdata('user_id');
			// $strc = $sisdmk[0]['str_code'];
			// if (empty($strc)){
			// 	$strc = $getdatapm[0]['no_str'];
			// }
			// $strc = '3111100118181382';
			// $nmd = $sisdmk[0]['health_worker_name'];
			// $spcs = $sisdmk[0]['specialization'];
			// if (strpos($spcs, 'Dokter') !== false) {

			// } else {
			if ($getdatapm[0]['id_kategori'] == 4) {
				$labeltpmd = "TPMD ";
				// $spcs = "Dokter";
			} else if ($getdatapm[0]['id_kategori'] == 5) {
				$labeltpmd = "TPMDG ";
				// $spcs = "Dokter Gigi";
			}
			// }

			// $nama_faskes = $labeltpmd.$sisdmk[0]['NAMA'];
			$nama_faskes = $getdatapm[0]['nama_pm'];

			$link = 'https://registrasifasyankes.kemkes.go.id/assets/uploads/berkas_str/' . $fc . '.png';

			$datapm = array(
				'faskes_code' => $fc,
				// 'str_code' => $strc,
				// 'health_worker_name' => $nmd,
				// 'specialization' => $spcs,
				'faskes_name' => $nama_faskes,
				'faskes_location' => $fl,
				'server_penyimpanan' => 'regfaskes',
				'nama_dokumen' => $fc . '.png',
				'id_faskes' => $id_faskes,
				'link' => $link
			);
			$dataqr = $this->registrasiusermodel->select_data('qrapi', $fc);
			$this->registrasiusermodel->input_data('qrapi', $datapm);
			// var_dump($datapm);
			$mydata = json_encode($datapm);
			$options = array(
				CURLOPT_URL => 'https://faskes-qr.kemkes.go.id/api/v2/generate/qr',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $mydata,
				CURLOPT_USERPWD => "283c532f-9ff8-4896-8ea9-bcd195342807:9A5liUVneG4tk5kbqd4X",
				CURLOPT_HTTPHEADER => array(
					//'Authorization: Basic ZmFza2VzLXFyLXN0ZzoxMjM0NTY3ODkw',
					'Content-Type: application/json'
				),
			); // cURL options

			curl_setopt_array($ch, $options);

			$result =  curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			//var_dump($result);
			//echo $result;
			file_put_contents("assets/uploads/berkas_str/" . $fc . ".png", $result);

			//file_put_contents("assets/uploads/berkas.txt","halo bibo");

			redirect('pm/selesaikan/');
		}
	}

	function generateSISDMK()
	{
		$data = $this->pmmodel->getDaftarNIK($this->session->userdata('user_id'));
		// var_dump($data);
		$NO = 0;
		// $this->insertSISDMK($data[0]['no_ktp'],$data[0]['id_faskes']);
		// echo $data[0]['no_ktp'];

		foreach ($data as $value) {
			// echo $value['id_faskes'];
			$this->insertSISDMK($value['no_ktp'], $value['id_faskes']);
			$NO++;
		}
		echo $NO;
	}

	function generateSisdmkByUser()
	{
		$data = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$params = explode("-", $this->uri->segment(3));

		// $this->insertSISDMK($this->uri->segment(3),$data[0]['id_faskes']);
		$this->insertSISDMK($params[0], $data[0]['id_faskes'], $params[1]);
		redirect('pm/index_data_sisdmk/');
	}

	function insertSISDMK($nik, $id_faskes, $unit)
	{
		$token = $this->get_token_sisdmk();
		// var_dump($token);
		$result = $this->get_nik($nik, $token);
		// var_dump($result);
		if ($result['status'] == 200) {

			/*
			$datas_log = array(
				'id_faskes' =>$id_faskes,
				'health_worker_name' => $result['data']['NAMA'],
				'specialization' => $result['data']['PEKERJAAN'][0]['JENIS_SDMK'],
				'str_code' => $result['data']['PEKERJAAN'][0]['STR']
				);
			
			echo '<br>';
			*/
			// $this->registrasiusermodel->input_data('data_sisdmk_pm',$datas_log);	

			// $cek= $this->registrasiusermodel->getsisdmkid($id_faskes, $result['data']['NIK'])->row_array();

			foreach ($result['data']['PEKERJAAN'] as $key => $value) {
				//remove white space
				$value_unit = preg_replace('/\s+/', '', $value['KODE_UNIT']);
				if ($unit == $value_unit) {
					// $this->registrasiusermodel->input_data('data_sisdmk_pekerjaan',$datas_log4[$key]);
					if (!empty($value['STR'])) {
						$cek2 = $this->registrasiusermodel->getsisdmkid($id_faskes, $result['data']['NIK']);
						$cek_id = $cek2[0]['id'];

						$datas_log2 = array(
							'id_faskes' => $id_faskes,
							'NIK' => $result['data']['NIK'],
							'NAMA' => $result['data']['NAMA'],
							'JENIS_KELAMIN' => $result['data']['JENIS_KELAMIN'],
							'TEMPAT_LAHIR' => $result['data']['TEMPAT_LAHIR'],
							'TANGGAL_LAHIR' => $result['data']['TANGGAL_LAHIR'],
							'KODE_PROV' => $result['data']['KODE_PROV'],
							'NAMA_PROV' => $result['data']['NAMA_PROV'],
							'KODE_KAB' => $result['data']['KODE_KAB'],
							'NAMA_KAB' => $result['data']['NAMA_KAB'],
							'ALAMAT' => $result['data']['ALAMAT'],
							'is_active' => 1
						);

						if ($cek_id == null) {
							$this->registrasiusermodel->input_data('data_sisdmk', $datas_log2);
						} else {
							$where2 = array(
								'id_faskes' => $id_faskes,
								'id' => $cek_id
							);

							$this->registrasiusermodel->edit_data('data_sisdmk', $where2, $datas_log2);

							$where3 = array('id_faskes' => $id_faskes, 'data_sisdmk_id' => $cek_id);

							$this->registrasiusermodel->delete_data('data_sisdmk_pekerjaan', $where3);
							$this->registrasiusermodel->delete_data('data_sisdmk_pendidikan', $where3);
						}



						$getId = $this->registrasiusermodel->getsisdmkid($id_faskes, $result['data']['NIK']);
						$sisdmkId = $getId[0]['id'];

						// var_dump($result['data']['PENDIDIKAN']);
						foreach ($result['data']['PENDIDIKAN'] as $key => $value) {
							$datas_log3[$key] = array(
								'id_faskes' => $id_faskes,
								'data_sisdmk_id' => $sisdmkId,
								'KODE_PRODI' => $value['KODE_PRODI'],
								'PRODI' => $value['PRODI'],
								'JENJANG' => $value['JENJANG'],
								'KODE_PERTI' => $value['KODE_PERTI'],
								'PERGURUAN_TINGGI' => $value['PERGURUAN_TINGGI'],
								'TAHUN_LULUS' => $value['TAHUN_LULUS'],
								'NO_IJAZAH' => $value['NO_IJAZAH']
							);

							// var_dump($datas_log[$key]);
							$this->registrasiusermodel->input_data('data_sisdmk_pendidikan', $datas_log3[$key]);
						}

						foreach ($result['data']['PEKERJAAN'] as $key => $value) {
							$datas_log4[$key] = array(
								'id_faskes' => $id_faskes,
								'data_sisdmk_id' => $sisdmkId,
								'KODE_UNIT' => $value['KODE_UNIT'],
								'UNIT' => $value['UNIT'],
								'ALAMAT' => $value['ALAMAT'],
								'KODE_KAB' => $value['KODE_KAB'],
								'KABKOT' => $value['KABKOT'],
								'KODE_PROV' => $value['KODE_PROV'],
								'PROVINSI' => $value['PROVINSI'],
								'ID_JENIS_SDMK' => $value['ID_JENIS_SDMK'],
								'JENIS_SDMK' => $value['JENIS_SDMK'],
								'STATUS' => $value['STATUS'],
								'NIP' => $value['NIP'],
								'TANGGAL_MULAI' => $value['TANGGAL_MULAI'],
								'TANGGAL_AKHIR' => $value['TANGGAL_AKHIR'],
								'STR' => $value['STR'],
								'TANGGAL_STR' => $value['TANGGAL_STR'],
								'TANGGAL_AKHIR_STR' => $value['TANGGAL_AKHIR_STR'],
								'SIP' => $value['SIP'],
								'TANGGAL_SIP' => $value['TANGGAL_SIP']
							);

							if ($unit == $value_unit) {
								$this->registrasiusermodel->input_data('data_sisdmk_pekerjaan', $datas_log4[$key]);
							}
						}

						$this->session->set_flashdata('kode_name', 'success');
						$this->session->set_flashdata('icon_name', 'check');
						$this->session->set_flashdata('message_name', 'Sukses Input Data!');
					} else {
						$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
						$this->session->set_flashdata('icon_name', 'warning');
						$this->session->set_flashdata('message_name', 'Data STR di unit TPMD tidak boleh kosong, silahkan update data di SISDMK');
					}
				}
			}
		} else if ($result['status'] == 404) {
			// echo '<br> Gagal'
		}
	}

	function alamatnik()
	{
		$nik = $_GET['id'];
		//$nik='3573035405740004';
		$token = $this->get_token_sisdmk();

		//var_dump($token);
		//$result= $this->data_nik($nik, $token);
		$result = $this->get_nik($nik, $token);
		//$getdata=$this->model_ncov->getnik($nik);
		// var_dump($result);die();
		if ($result['status'] == 200) {

			//var_dump($nama);

			$tgllahir = date('d-m-Y', strtotime($result['data']['TANGGAL_LAHIR']));
			if ($result['data']['JENIS_KELAMIN'] == "L") {
				$gender = "L";
				$jk = "Laki-laki";
			} else {
				$gender = "P";
				$jk = "Perempuan";
			}

			$data = array(
				"status"		=>	200,
				"message"		=>	$result['message'],
				"data"			=> array(
					"nik"			=>	$result['data']['NIK'],
					"nama"			=>	$result['data']['NAMA'],
					"tgllahir"		=>	$tgllahir,
					"tempat_lahir"	=>	$result['data']['TEMPAT_LAHIR'],
					"jk"			=>	$jk,
					"pendidikan"	=> $result['data']['PENDIDIKAN'],
					"pekerjaan"	=> $result['data']['PEKERJAAN'],
					"pelatihan"	=> $result['data']['PELATIHAN']
				)

			);
			$data = json_encode($data);
			echo $data;
		} else if ($result['status'] == 404) {
			$data = array(
				"status"		=>	404,
				"message"		=>	$result['message'],
			);
			$data = json_encode($data);
			echo $data;
			// //var_dump($nama);
		}
	}

	function cekStr()
	{
		$str = $_GET['id'];
		//$nik='3573035405740004';
		$token = $this->get_token_sisdmk();

		$result = $this->get_str($str, $token);

		if ($result['status'] == 200 && (!empty($result['data']['nama']))) {

			$tanggal_lahir = date('d-m-Y', strtotime($result['data']['tanggal_lahir']));

			$data = array(
				"status"		=>	200,
				"message"		=>	$result['message'],
				"data"			=> array(
					"tanggal_lahir"			=>	$tanggal_lahir,
					"tempat_lahir"			=>	$result['data']['tempat_lahir'],
					"nama"					=>	$result['data']['nama'],
					"tanggal_berlaku"		=>	$result['data']['tanggal_berlaku'],
					"id_registrasi"			=> $result['data']['id_registrasi'],
					"provinsi"				=> $result['data']['provinsi'],
					"nama_profesi"			=> $result['data']['nama_profesi'],
					"nama_profesi_en"		=>	$result['data']['nama_profesi_en'],
					"nomor_str"				=>	$result['data']['nomor_str'],
					"ttd"					=> $result['data']['ttd'],
					"kode_jenis_kelamin"	=> $result['data']['kode_jenis_kelamin'],
					"kode_kompetensi"		=> $result['data']['kode_kompetensi'],

					"nama_kompetensi"			=> $result['data']['nama_kompetensi'],
					"nama_kompetensi_en"		=>	$result['data']['nama_kompetensi_en'],
					"level_kompetensi"				=>	$result['data']['level_kompetensi'],
					"tanggal_berlaku_sampai"					=> $result['data']['tanggal_berlaku_sampai'],
					"perguruan_tinggi"	=> $result['data']['perguruan_tinggi'],
					"kode_perguruan_tinggi"		=> $result['data']['kode_perguruan_tinggi'],

					"jenis_kelamin"			=> $result['data']['jenis_kelamin'],
					"jenis_kelamin_en"		=>	$result['data']['jenis_kelamin_en'],
					"validitas"				=>	$result['data']['validitas'],
					"kelamin"					=> $result['data']['kelamin'],
					"status_data"	=> $result['data']['status_data'],
					"nik"		=> $result['data']['nik'],

					"nip"			=> $result['data']['nip'],
					"nama_ayah"		=>	$result['data']['nama_ayah'],
					"nama_ibu"				=>	$result['data']['nama_ibu'],
					"kewarganegaraan"					=> $result['data']['kewarganegaraan'],
					"negara"	=> $result['data']['negara'],
					"kode_prov"		=> $result['data']['kode_prov'],

					"kode_kab"			=> $result['data']['kode_kab'],
					"tanggal_str"		=>	$result['data']['tanggal_str'],
					"tanggal_berakhir_str"				=>	$result['data']['tanggal_berakhir_str'],
					"tanggal_sekarang"					=> $result['data']['tanggal_sekarang'],
					"id_biodata"	=> $result['data']['id_biodata']

				)

			);
			$data = json_encode($data);
			echo $data;
		} else if ($result['status'] == 404) {
			$data = array(
				"status"		=>	404,
				"message"		=>	$result['message'],
			);
			$data = json_encode($data);
			echo $data;
			// //var_dump($nama);
		} else {
			$data = array(
				"status"		=>	$result['status'],
				"message"		=>	$result['message'],
			);
			$data = json_encode($data);
			echo $data;
			// //var_dump($nama);
		}
	}

	function sisdmk($kdfasyankes = '')
	{
		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$token = "gTbJckIpNpYTo1OntzOjU6ImFyYW5kIjtzOjQwOiI3Njl5TmthTEtzVW52RVFVSms3amZ0dG5tajlxdGU2bVhwY1FtRXZSIjtzOjg6InVzZXJuYW1lIjtzOjY6InlhbmtlcyI7czo4OiJwYXNzd29yZCI7czozOToiOVVRVE0wT0RjeFIwcExWRUpKTXpZNFNFWkVPRGs0TlV0T1FqTTNkIjtzOjc6ImV4cGlyZWQiO3M6MTk6IjIwMjAtMDktMDIgMDE6MzA6NDgiO3M6NToienJhbmQiO3M6NDA6IjV2OHlzT1c1bXNxeE9Rc1pMRW40SXNaYzJ4STJLbUhaOEhpYjdQR0UiO30d";
		$kdfasyankes = "3573253";

		$json2 = file_get_contents("https://sisdmk.kemkes.go.id/rest/biodata?kdfasyankes=$kdfasyankes&token=$token", false, stream_context_create($arrContextOptions));
		var_dump(json_decode($json2, true));
	}

	function get_token_sisdmk()
	{
		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$username = "praktekmandiri";
		$password = "5XKyKWS6cT12EcpWEnYpCBjHhakMvzn9";

		$json2 = file_get_contents("https://sisdmk.kemkes.go.id/rest/login_ws?username=$username&password=$password", false, stream_context_create($arrContextOptions));
		//var_dump(json_decode($json2,true));
		$jsonn = json_decode($json2, true);
		return $datajson = $jsonn['token'];
	}

	function get_nik($nik, $token)
	{
		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$json2 = file_get_contents("https://sisdmk.kemkes.go.id/rest/getBiodata?nik=$nik&token=$token", false, stream_context_create($arrContextOptions));
		//var_dump(json_decode($json2,true));
		$jsonn = json_decode($json2, true);
		return $jsonn;
		// if ($jsonn.status == 200) {
		// 	return $datajson = $jsonn['data'];
		// } else if ($jsonn.status == 400) {
		// 	return $datajson = $jsonn;	
		// }
	}

	function get_str($str = 0, $token = 0)
	{
		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);

		$data = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));

		//$id_profesi = $data[0]['id_kategori'];
		//var_dump($data[0]['id_kategori']);
		//$id_profesi = 3;

		if ($data[0]['id_kategori'] == 4) {
			$id_profesi = 1;
		} else if ($data[0]['id_kategori'] == 5) {
			$id_profesi = 2;
		} else if ($data[0]['id_kategori'] == 6) {
			$id_profesi = 6;
		} else if ($data[0]['id_kategori'] == 7) {
			$id_profesi = 3;
		}

		$json2 = file_get_contents("https://sisdmk.kemkes.go.id/rest/cekStr?str=$str&id_profesi=$id_profesi$&token=$token", false, stream_context_create($arrContextOptions));
		//var_dump(json_decode($json2,true));
		$jsonn = json_decode($json2, true);
		return $jsonn;
		// if ($jsonn.status == 200) {
		// 	return $datajson = $jsonn['data'];
		// } else if ($jsonn.status == 400) {
		// 	return $datajson = $jsonn;	
		// }
	}

	function list_user_yang_mengajukan($id = 0)
	{
		$data['data']['query'] = $this->pmmodel->getlistpengajuanpm($this->session->userdata('id_kategori'), $this->session->userdata('id_prov'), $this->session->userdata('id_kota'));
		$this->template->utama('adminpm/list_user_yang_mengajukan', $data);
	}

	function list_user_yang_mengajukan_belum_validasi($id = 0)
	{
		$data['data']['query'] = $this->pmmodel->getlistpengajuanbelumvalidasipm($this->session->userdata('id_kategori'), $this->session->userdata('id_prov'), $this->session->userdata('id_kota'));
		$this->template->utama('adminpm/list_user_yang_mengajukan_belum_validasi', $data);
	}

	function list_user_yang_mengajukan_belum_validasi_perbaikan($id = 0)
	{
		$data['data']['query'] = $this->pmmodel->getlistpengajuanbelumvalidasiperbaikanpm($this->session->userdata('id_kategori'), $this->session->userdata('id_prov'), $this->session->userdata('id_kota'));
		$this->template->utama('adminpm/list_user_yang_mengajukan_belum_validasi_perbaikan', $data);
	}

	function verifikasi_pengajuan_faskes($id = NULL)
	{

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);

			$datas_detail = array(
				'nama_pm' => $post["nama_pm"],
			);

			$this->registrasiusermodel->edit_data('data_pm', $where2, $datas_detail);


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Di Rubah');
			redirect('pm/verifikasi_pengajuan_faskes/' . $id);
		}

		$data['data'] = $this->registrasiusermodel->getdatapm($id);

		$data['user_id'] = $id;

		$this->template->utama('adminpm/verifikasi_pengajuan_faskes', $data);
	}

	function verifikasi_pengajuan_faskes_alkes($id = NULL)
	{



		$where = array('id_faskes' => $id);
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatasarprasalkespm($id);
		$data['user'] = $this->registrasiusermodel->getdatapm($id);
		$data['user_id'] = $id;
		$post = $this->input->post();



		$this->template->utama('adminpm/verifikasi_pengajuan_faskes_alkes', $data);
	}


	function verifikasi_pengajuan_faskes_sdm($id = NULL)
	{

		$post = $this->input->post();

		//$data['user']= $this->registrasiusermodel->getdatauser($id);	
		$data['user'] = $this->registrasiusermodel->getdatapm($id);
		$data['data'] = $this->registrasiusermodel->getdatasdmpm($id);
		$data['user_id'] = $id;

		$this->template->utama('adminpm/verifikasi_pengajuan_faskes_sdm', $data);
	}

	function verifikasikan_kirim($id = NULL)
	{

		$post = $this->input->post();

		if (isset($post['submit_setujui'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			/* 	$token = random_bytes(24);
				$token = bin2hex($token); */
			$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


			$datas_detail = array('token_kode_faskes' => $token);

			$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);

			$datas_log = array(
				'id_faskes' => $post["id_faskes"],
				'id_dinkes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Di Setujui Oleh Dinkes/Kemkes'
			);
			$where = array('id_faskes' => $post["id_faskes"]);
			$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
			$this->validasi_link_kode_faskes($token, $data['data2'][0]["id_link"], $id, $data['data2'][0]["kode_regional_link"]);


			$this->registrasiusermodel->input_data('timeline', $datas_log);


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Pemberitahuan Akan Di Kirimkan Melalui Aplikasi Registrasi Praktik Mandiri Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi');
			redirect('pm/verifikasikan_kirim' . $id);
		}

		if (isset($post['submit_perbaikan'])) {

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);
			/* 	$token = random_bytes(24);
						$token = bin2hex($token); */
			//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


			$datas_detail = array('final' => 0, 'catatan' => $post["catatan"], 'token_kode_faskes' => '');

			$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);

			$datas_log = array(
				'id_faskes' => $post["id_faskes"],
				'id_dinkes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Minta Diperbaiki Oleh Dinkes/Kemkes'
			);

			$this->registrasiusermodel->input_data('timeline', $datas_log);



			$data['data'] = $this->pmmodel->getbylistpendaftaran($post["id_faskes"]);
			$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
			$data['trans_final'] = $this->registrasiusermodel->select_data('trans_final', $wheregetkodefaskes)->result_array();
			$email  = $data['data'][0]['email'];
			$title   = "Registrasi Faskes";
			$message = "Yth,<br><br>
			" . $data['data'][0]['nama_lengkap'] . ",
			<br><br>
			Selamat datang di Aplikasi Registrasi Fasyankes Online.<br>
			Data Fasyankes Anda Di minta Untuk Diperbaiki, Harap Buka Aplikasi https://registrasifasyankes.kemkes.go.id/
			<br><br>
			Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
			registrasifasyankes@kemkes.go.id<br>
			<br><br>
			Salam<br>
			Sekretariat Direktorat Jenderal Pelayanan Kesehatan";



			//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
			$mail = $this->send_email("registrasifasyankes@kemkes.go.id", "Sekretariat Direktorat Jenderal Pelayanan Kesehatan", "uLH0%RYL", $title, $email, $data['data'][0]['nama_lengkap'], $message);


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
			redirect('pm/verifikasikan_kirim/' . $id);
		}

		$where = array('id_faskes' => $id);
		$data['data'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->getdatapm($id);

		$data['user_id'] = $id;

		$this->template->utama('adminpm/verifikasikan_kirim', $data);
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
		//$mail->Host       = "zmtablast.kemkes.go.id";      // masukkan GMAIL sebagai smtp server
		$mail->Host       = "ssl://proxy.kemkes.go.id";
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
	function validasi_link_kode_faskes($token, $id_link, $id, $kode_regional_link)
	{

		$where = array(
			'token_kode_faskes' => $token,
			'validate_token' => 0
		);
		$cek = $this->loginmodel->cek_login("trans_final", $where)->num_rows();
		if ($cek > 0) {
			//$show_user = $this->loginmodel->cek_login("registrasi_user",$where)->result_array();
			$kode_faskes = $this->pmmodel->findNoFaskes($id_link);

			$where_edit = array(
				'token_kode_faskes' => $token
			);
			$datas = array(
				'validate_token' => 1,
				//   'kode_faskes' =>$this->pmmodel->findNoFaskes($id_link),
				'kode_faskes' => $kode_faskes,
				'kode_faskes_baru' => $kode_faskes,
				//   'kode_faskes_baru' =>$this->registrasiusermodel->findNoFaskesBaru($id_link,'9'),
				'create_kode' => date('Y-m-d H:i:s')
			);
			$this->registrasiusermodel->edit_data('trans_final', $where_edit, $datas);


			$data['data'] = $this->registrasiusermodel->getbylistpendaftaran($id);
			$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
			$data['trans_final'] = $this->registrasiusermodel->select_data('trans_final', $wheregetkodefaskes)->result_array();
			$email  = $data['data'][0]['email'];
			$title   = "Registrasi Faskes";
			$message = "Yth,<br><br>
			" . $data['data'][0]['nama_lengkap'] . ",
			<br><br>
			Selamat datang di Aplikasi Registrasi Fasyankes Online.<br>
			Kode Faskes Anda : " . $data['trans_final'][0]['kode_faskes'] . "
			<br><br>
			Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
			registrasi.fasyankes2@gmail.com<br>
			<br><br>
			Salam<br>
			Sekretariat Direktorat Jenderal Pelayanan Kesehatan";

			//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
			$mail = $this->send_email("registrasifasyankes@kemkes.go.id", "Sekretariat Direktorat Jenderal Pelayanan Kesehatan", "uLH0%RYL", $title, $email, $data['data'][0]['nama_lengkap'], $message);

			//$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'],$data['data'][0]['nama_pm'],'tpmd',$data['data'][0]['id_kota'],null,$data['data'][0]['jenis_tpmd']);
			$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_pm'], 'tpmd', $data['data'][0]['id_kota'], '', 'tpmd', $data['data'][0]['jenis_tpmd'], '', $data['trans_final'][0]['kode_faskes_baru']);

			if ($mail) {
				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Kode Faskes Sudah Aktif');
				redirect(base_url("pm/verifikasikan_kirim/" . $id . ""));
			}
		} else {
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Link Aktifasi Tidak Valid Atau Sudah Dipakai!');
			redirect(base_url("admin/index"));
		}
	}

	function rekap_data_pm($id = NULL)
	{

		$post = $this->input->post();
		$id_kategori = isset($post['id_kategori']) ? $post['id_kategori'] : null;
		$kota = isset($post['id_kota']) ? $post['id_kota'] : null;
		$propinsi = isset($post['id_prov']) ? $post['id_prov'] : null;

		if ($this->session->userdata('id_kategori') == 1 || $this->session->userdata('id_kategori') == 8) {

			$data['data']['query'] = $this->pmmodel->getrekap_data('', '', $propinsi, $kota, $id_kategori);
		}
		/**  else if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==2 || $this->session->userdata('id_kategori')==3)){ */

		if ($this->session->userdata('id_kategori') == 3) {
			$data['data']['query'] = $this->pmmodel->getrekap_data('', '', '', $this->session->userdata('id_kota'), $id_kategori);
		}

		if ($this->session->userdata('id_kategori') == 2) {
			$data['data']['query'] = $this->pmmodel->getrekap_data('', '', $this->session->userdata('id_prov'), $kota, $id_kategori);
		}

		$this->template->utama('adminpm/rekap_data_pm', $data);
	}

	function monitoring_pm($id = NULL)
	{

		$post = $this->input->post();
		if (isset($_POST['cari']) && ($this->session->userdata('id_kategori') == 1 || $this->session->userdata('id_kategori') == 8)) {

			$data['data']['query'] = $this->registrasiusermodel->monitoring_pm(str_replace('/', '-', $_POST['tgl1']), str_replace('/', '-', $_POST['tgl2']), $_POST['id_prov'], $_POST['id_kota']);
		}

		if ($this->session->userdata('id_kategori') == 3) {
			$data['data']['query'] = $this->registrasiusermodel->monitoring_pm('', '', '', $this->session->userdata('id_kota'));
		}

		if ($this->session->userdata('id_kategori') == 2) {
			$data['data']['query'] = $this->registrasiusermodel->monitoring_pm('', '', $this->session->userdata('id_prov'), $_POST['id_kota']);
		}

		$this->template->utama('adminpm/monitoring_pm', $data);
	}



	/* function service_kirim_kode($kode,$nama,$jenis,$kota,$kode_lama,$jenis_tpmd){
					$xid='mutukemenkes';
					$time=time();
					date_default_timezone_set('UTC');
				    $data_send='{"kodesatker":"'.$kode.'","namasatker":"'.$nama.'","jenis_satker":"tpmd","kodekota":"'.$kota.'","kodelama":"'.$kode_lama.'","jenis":"'.$jenis_tpmd.'"}';
					$url = "http://mutufasyankes.kemkes.go.id/api/insert_satker";
					$process = curl_init($url); 					
					curl_setopt($process, CURLOPT_HTTPHEADER,
					array("Content-Type: application/json\r\n" . "X-Id:$xid\r\n" . "X-Timestamp:$time"));
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
		
	} */

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
		var_dump($return);
	}

	function teskirim()
	{
		$this->service_kirim_kode(73710112345, "tes bibo", 'tpmd', 7371, null, 5);
	}

	public function index_data_rme()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$where2 = array('kode_faskes' => $data['data2'][0]['kode_faskes']);

		$get = $this->input->get();
		if (isset($get['status'])) {
			// $where3 = array('kode_faskes' => $get['kode_faskes']);
			// $cek_data= $this->registrasiusermodel->select_data('trans_final',$where3)->result_array();

			// $where4 = array('id_faskes' => $cek_data[0]['id_faskes']);
			$cek_data2 = $this->registrasiusermodel->select_data('data_rme', $where)->result_array();

			$data_rme = array(
				'status' => $get['status'],
				'jenis_vendor_id' => $get['vendor'],
				'sim_pengembang_id' => $get['sim_pengembang_id'],
				'id_faskes' => $this->session->userdata('user_id')
			);

			if (!empty($cek_data2[0]['id'])) {
				$where5 = array(
					'id' => $cek_data2[0]['id']
				);
				$this->registrasiusermodel->edit_data('data_rme', $where, $data_rme);
			} else {
				$this->registrasiusermodel->input_data('data_rme', $data_rme);
			}

			$cek_data3 = $this->registrasiusermodel->select_data('asri_verifikasi', $where2)->result_array();
			if (empty($cek_data3[0]['id'])) {

				$this->registrasiusermodel->input_data('asri_verifikasi', $where2);
			}

			redirect('pm/index_data_rme');
		}

		$post = $this->input->post();
		if (isset($post['submit'])) {
			$authStatus = $this->authSatuSehat();

			if ($authStatus == "unauthorized"){
				$this->session->set_flashdata('kode_name', 'danger');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Terjadi Kesalahan Sistem Mohon untuk Menghubungi Admin');
				redirect(base_url('pm/index_data_rme'));
			}

			// Cek SDM
			$whereSdm = array('id_faskes' => $this->session->userdata('user_id'), 'is_active' => 1);
			$dataSdm = $this->registrasiusermodel->select_data('data_sisdmk', $whereSdm)->result();
			
			if (empty($post['id'])) {
				if (!empty($dataSdm)) {
					// Cek Detail SDM
					if (count($dataSdm) == !count(array_filter(array_column($dataSdm, 'email')))) {
						$this->session->set_flashdata('kode_name', 'danger');
						$this->session->set_flashdata('icon_name', 'check');
						$this->session->set_flashdata('message_name', 'Harap lengkapi kolom email pada semua Data SDM terlebih dahulu.');
						redirect(base_url('pm/index_data_rme'));
					}
					// End Cek Detail SDM
				} else {
					$this->session->set_flashdata('kode_name', 'danger');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Harap tambahkan Data SDM terlebih dahulu.');
					redirect(base_url('pm/index_data_rme'));
				}
			}
			// End Cek Data SDM

			// Cek Kontak SatSet
			$kontakSatSet = $this->reviewmodel->get_satu_sehat_pic($this->session->userdata('user_id'));
			
			if (empty($kontakSatSet)) {
				$this->session->set_flashdata('kode_name', 'danger');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Harap tambahkan Data Kontak Satu Sehat terlebih dahulu.');
				redirect(base_url('pm/index_data_rme'));
			}
			// End Cek Kontak SatSet

			$authResponse = json_decode($authStatus, true);
			$token = $authResponse['accessToken'];
			$validasidata = 0;

			if (isset($post['persetujuan_ketentuan_satset_id'])) {   
                if ($post['persetujuan_ketentuan_satset_id'] == "on" || $post['persetujuan_ketentuan_satset_id'] == "1") {
                    $validasidata = 1;
                } else {
                    $validasidata = 0;
                }
            }

			$jenis_vendor_lama = $data['rme'][0]['jenis_vendor_id'];
			$jenis_vendor_baru = $post['jenis_vendor'];

			$vendor_lama = $data['rme'][0]['sim_pengembang_id'];
			$vendor_baru = $post['sim_pengembang_id'];

			// Revoke Cred
			if ($jenis_vendor_lama != $jenis_vendor_baru || $vendor_lama != $vendor_baru) {
				if (!empty($dataSdm)) {
					// Cek Detail SDM
					if (count($dataSdm) == !count(array_filter(array_column($dataSdm, 'email')))) {
						$this->session->set_flashdata('kode_name', 'danger');
						$this->session->set_flashdata('icon_name', 'check');
						$this->session->set_flashdata('message_name', 'Harap lengkapi kolom email pada semua Data SDM terlebih dahulu.');
						redirect(base_url('pm/index_data_rme'));
					}
					// End Cek Detail SDM
				} else {
					$this->session->set_flashdata('kode_name', 'danger');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Harap tambahkan Data SDM terlebih dahulu.');
					redirect(base_url('pm/index_data_rme'));
				}

				$postData = json_encode(array(
					"email" => $data['user'][0]['email'],
					"facilityCode" => $data['satu_sehat'][0]['kode_baru_faskes'],
					"orgId" => $data['satu_sehat'][0]['organization_id'],
					"vendorId" => (int)$vendor_baru,
				));

				$curl2 = curl_init();
				curl_setopt_array($curl2, array(
					CURLOPT_URL => 'https://developer-portal-api.kemkes.go.id/external/apps/revoke-credential',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => $postData,
					CURLOPT_HTTPHEADER => array(
						'Authorization: Bearer '. $token,
						'Content-Type: application/json'
					),
				));

				$response2 = curl_exec($curl2);
				$status_code = curl_getinfo($curl2, CURLINFO_HTTP_CODE);
				curl_close($curl2);

				$jsonDecodeResponse = json_decode($response2, true);
				$clientKey = json_encode($jsonDecodeResponse['clientKey']);
				$clientSecret = json_encode($jsonDecodeResponse['clientSecret']);
				
				if (json_decode(http_response_code()) === 200) {
					if ($jsonDecodeResponse['issue'][0]['severity'] == 'error') {
						$this->session->set_flashdata('kode_name', 'warning');
						$this->session->set_flashdata('icon_name', 'check');
						$this->session->set_flashdata('message_name', $jsonDecodeResponse['issue'][0]['details']['text']);
						redirect(base_url('pm/index_data_rme'));
					}

					$datasatusehat = array(
						'secret_key' => str_replace('"', '', $clientSecret),
						'client_id' => str_replace('"', '', $clientKey),
						'organization_id' => $data['satu_sehat'][0]['organization_id'],
						'sim_pengembang_id' => $post['sim_pengembang_id'],
						'sim_pengembang_nama' => $post['nama_vendor']
					);

					$where = array('kode_baru_faskes' => $data['satu_sehat'][0]['kode_baru_faskes']);

					$this->reviewmodel->edit_data('satu_sehat_id', $where, $datasatusehat);

					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Berhasil Update RME.');
				}elseif (json_decode(http_response_code()) === 400) {
					$this->session->set_flashdata('kode_name', 'danger');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Gagal Simpan, karena baru saja melakukan pergantian RME dalam 24 jam terakhir.');
					redirect(base_url('pm/index_data_rme'));
				}elseif(json_decode(http_response_code()) === 403){
					$this->session->set_flashdata('kode_name', 'danger');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Gagal Simpan, karena Kode Faskes Tidak Sesuai');
					redirect(base_url('pm/index_data_rme'));
				}elseif (json_decode(http_response_code()) === 404) {
					$this->session->set_flashdata('kode_name', 'danger');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Gagal Simpan, karena Organisasi id tidak sesuai');
					redirect(base_url('pm/index_data_rme'));
				}
			}
			// End of Revoke Cred
				
			$datas = array(
				'status' => $post['rme'],
				'vendor' => $post['nama_vendor'],
				'sim_pengembang_id' => $post['sim_pengembang_id'],
				'jenis_vendor_id' => $post['jenis_vendor'],
				'id_satu_sehat' => $post['id_satu_sehat'],
				'status_internet_id' => $post['status_internet_id'],
				'status_sdm_it_id' => $post['status_sdm_it_id'],
				'persetujuan_ketentuan_satset_id' => $validasidata,
				'id_faskes' => $post['id_faskes']
			);

			if ($post['rme'] == 1 && $post['sim_pengembang_id'] == 323) {
				$where2 = array('kode_faskes' => $data['data2'][0]['kode_faskes']);
				$cek_kode = $this->registrasiusermodel->select_data('asri_verifikasi', $where2)->result_array();

				if (!empty($cek_kode)) {
					if (!empty($post['id'])) {
						$where = array('id' => $post['id']);
						$this->registrasiusermodel->edit_data('data_rme', $where, $datas);

						$datas_log = array(
							'id_faskes' => $this->session->userdata('user_id'),
							'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data Praktik Mandiri RME'
						);
						$this->registrasiusermodel->input_data('timeline', $datas_log);
					} else {
						$this->registrasiusermodel->input_data('data_rme', $datas);
						$id = $this->db->insert_id();

						$datas_log = array(
							'id_faskes' => $this->session->userdata('user_id'),
							'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Praktik Mandiri RME'
						);
						$this->registrasiusermodel->input_data('timeline', $datas_log);
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Silahkan mendaftar sebagai pengguna ASRI di link berikut! <a href="https://asri.kemkes.go.id/tnc?kode_faskes=' . $this->secure2->encrypt($data['data2'][0]['kode_faskes']) . '" target="_blank">Link Pendaftaran ASRI</a>');
					redirect('pm/index_data_rme');
				}
			} else {
				if (!empty($post['id'])) {
					$where = array('id' => $post['id']);

					$this->registrasiusermodel->edit_data('data_rme', $where, $datas);

					$datas_log = array(
						'id_faskes' => $this->session->userdata('user_id'),
						'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data Praktik Mandiri RME'
					);
					$this->registrasiusermodel->input_data('timeline', $datas_log);
				} else {
					$this->registrasiusermodel->input_data('data_rme', $datas);
					$id = $this->db->insert_id();


					$datas_log = array(
						'id_faskes' => $this->session->userdata('user_id'),
						'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Praktik Mandiri RME'
					);
					$this->registrasiusermodel->input_data('timeline', $datas_log);
				}
			}

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Ganti Vendor');
			redirect('pm/index_data_rme');
		}
		$this->template->utama('datapm/index_rme', $data);
	}

	public function inputan_data_obat_pm()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['obat'] = $this->registrasiusermodel->getdataobatnewpm($this->session->userdata('user_id'));
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));


		$post = $this->input->post();
		if (isset($post['submit'])) {
			$datas = array(
				'obat_id' => $post['obat_id'],
				'jenis_sediaan_id' => $post['jenis_sediaan_id'],
				'no_batch' => $post['no_batch'],
				'nama_perusahaan' => $post['nama_perusahaan'],
				'sumber_pembelian' => $post['sumber_pembelian'],
				'id_faskes' => $post['id_faskes']
			);


			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('trans_obat_new_pm', $where, $datas);

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data Obat Praktik Mandiri '
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			} else {
				$this->registrasiusermodel->input_data('trans_obat_new_pm', $datas);
				$id = $this->db->insert_id();


				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Data Obat Praktik Mandiri'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			}


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_data_obat_pm');
		}
		$this->template->utama('datapm/index_obat_new_pm', $data);
	}

	public function hapus_data_obat()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'), 'id' => $this->uri->segment(3));
		$this->registrasiusermodel->delete_data('trans_obat_new_pm', $where);

		redirect('pm/inputan_data_obat_pm');
	}

	function verifikasi_pengajuan_faskes_alkes_new($id = NULL)
	{



		$where = array('id_faskes' => $id);
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdataalkespm($id);
		$data['user'] = $this->registrasiusermodel->getdatapm($id);
		$data['user_id'] = $id;
		$post = $this->input->post();



		$this->template->utama('adminpm/verifikasi_pengajuan_faskes_alkes_new', $data);
	}

	function verifikasi_pengajuan_faskes_obat($id = NULL)
	{

		$where = array('id_faskes' => $id);
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdataobatnewpm($id);
		$data['user'] = $this->registrasiusermodel->getdatapm($id);
		$data['user_id'] = $id;
		$post = $this->input->post();

		$this->template->utama('adminpm/verifikasi_pengajuan_faskes_obat', $data);
	}

	function verifikasi_pengajuan_faskes_gambar($id = NULL)
	{

		$where = array('id_faskes' => $id);
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatagambarpm($id);
		$data['user'] = $this->registrasiusermodel->getdatapm($id);
		$data['user_id'] = $id;
		$post = $this->input->post();

		$this->template->utama('adminpm/verifikasi_pengajuan_faskes_dokumen', $data);
	}

	public function index_review()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['review'] = $this->reviewmodel->get_review($this->session->userdata('user_id'), "", date("Y"));
		$data['bulan'] = "";
		$data['tahun'] = date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$data['review'] = $this->reviewmodel->get_review($this->session->userdata('user_id'), $post['bulan'], $post['tahun']);
			$data['bulan'] = $post['bulan'];
			$data['tahun'] = $post['tahun'];
		}
		$this->template->utama('datapm/index_review', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	public function index_review_star()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['review'] = $this->reviewmodel->get_review_star($this->session->userdata('user_id'), "", date("Y"));
		$data['bulan'] = "";
		$data['tahun'] = date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$data['review'] = $this->reviewmodel->get_review_star($this->session->userdata('user_id'), $post['bulan'], $post['tahun']);
			$data['bulan'] = $post['bulan'];
			$data['tahun'] = $post['tahun'];
		}
		$this->template->utama('datapm/index_review_star', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	public function inputan_pembiayaan_kesehatan_pasien()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		// $data['review']= $this->reviewmodel->get_review_star($this->session->userdata('user_id'),"",date("Y"));	
		// $data['bulan']="";
		// $data['tahun']=date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$datas = array(
				'bulan' => $post['bulan'],
				'tahun' => $post['tahun'],
				'umum' => $post['umum'],
				'jkn' => $post['jkn'],
				'asuransi_lainnya' => $post['asuransi_lainnya'],
				'jumlah' => $post['umum'] + $post['jkn'] + $post['asuransi_lainnya'],
				'id_faskes' => $post['id_faskes']
			);

			$where = array('id_faskes' => $this->session->userdata('user_id'), 'bulan' => $post['bulan'], 'tahun' => $post['tahun']);
			$this->registrasiusermodel->delete_data('pembiayaan_kesehatan_pasien', $where);

			$this->registrasiusermodel->input_data('pembiayaan_kesehatan_pasien', $datas);
			$id = $this->db->insert_id();


			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Pembiayaan Kesehatan Pasien'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);



			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_pembiayaan_kesehatan_pasien');
		}
		$this->template->utama('datapm/input_pembiayaan_kesehatan_pasien', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	public function index_pembiayaan_kesehatan_pasien()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['laporan'] = $this->pelaporanpmmodel->get_pembiayaan_kesehatan_pasien($this->session->userdata('user_id'), date("Y"));
		$data['bulan'] = "";
		$data['tahun'] = date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$data['laporan'] = $this->pelaporanpmmodel->get_pembiayaan_kesehatan_pasien($this->session->userdata('user_id'), $post['tahun']);
			$data['bulan'] = $post['bulan'];
			$data['tahun'] = $post['tahun'];
		}
		$this->template->utama('datapm/index_pembiayaan_kesehatan_pasien', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	public function inputan_kepatuhan_kunjungan_pasien_hipertensi()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		// $data['review']= $this->reviewmodel->get_review_star($this->session->userdata('user_id'),"",date("Y"));	
		// $data['bulan']="";
		// $data['tahun']=date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$datas = array(
				'bulan' => $post['bulan'],
				'tahun' => $post['tahun'],
				'jumlah_pasien_hipertensi' => $post['jumlah_pasien_hipertensi'],
				'pasien_patuh' => $post['pasien_patuh'],
				'persentase' => $post['pasien_patuh'] * 100 / $post['jumlah_pasien_hipertensi'],
				'id_faskes' => $post['id_faskes']
			);

			$where = array('id_faskes' => $this->session->userdata('user_id'), 'bulan' => $post['bulan'], 'tahun' => $post['tahun']);
			$this->registrasiusermodel->delete_data('kepatuhan_kunjungan_pasien_hipertensi', $where);

			$this->registrasiusermodel->input_data('kepatuhan_kunjungan_pasien_hipertensi', $datas);
			$id = $this->db->insert_id();


			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data kepatuhan_kunjungan_pasien_hipertensi'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);



			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_kepatuhan_kunjungan_pasien_hipertensi');
		}
		$this->template->utama('datapm/input_kepatuhan_kunjungan_pasien_hipertensi', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	public function index_kepatuhan_kunjungan_pasien_hipertensi()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['laporan'] = $this->pelaporanpmmodel->get_kepatuhan_kunjungan_pasien_hipertensi($this->session->userdata('user_id'), date("Y"));
		$data['bulan'] = "";
		$data['tahun'] = date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$data['laporan'] = $this->pelaporanpmmodel->get_kepatuhan_kunjungan_pasien_hipertensi($this->session->userdata('user_id'), $post['tahun']);
			$data['bulan'] = $post['bulan'];
			$data['tahun'] = $post['tahun'];
		}
		$this->template->utama('datapm/index_kepatuhan_kunjungan_pasien_hipertensi', $data);
	}

	public function inputan_penurunan_skor_ohis_pasien()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		// $data['review']= $this->reviewmodel->get_review_star($this->session->userdata('user_id'),"",date("Y"));	
		// $data['bulan']="";
		// $data['tahun']=date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$datas = array(
				'bulan' => $post['bulan'],
				'tahun' => $post['tahun'],
				'pasien_gigi_dengan_penurunan_skor_ohis' => $post['pasien_gigi_dengan_penurunan_skor_ohis'],
				'jumlah_pasien_gigi' => $post['jumlah_pasien_gigi'],
				'persentase' => $post['pasien_gigi_dengan_penurunan_skor_ohis'] * 100 / $post['jumlah_pasien_gigi'],
				'id_faskes' => $post['id_faskes']
			);

			$where = array('id_faskes' => $this->session->userdata('user_id'), 'bulan' => $post['bulan'], 'tahun' => $post['tahun']);
			$this->registrasiusermodel->delete_data('penurunan_skor_ohis_pasien', $where);

			$this->registrasiusermodel->input_data('penurunan_skor_ohis_pasien', $datas);
			$id = $this->db->insert_id();


			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data penurunan_skor_ohis_pasien'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);



			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_penurunan_skor_ohis_pasien');
		}
		$this->template->utama('datapm/input_penurunan_skor_ohis_pasien', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	public function index_penurunan_skor_ohis_pasien()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['laporan'] = $this->pelaporanpmmodel->get_penurunan_skor_ohis_pasien($this->session->userdata('user_id'), date("Y"));
		$data['bulan'] = "";
		$data['tahun'] = date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$data['laporan'] = $this->pelaporanpmmodel->get_penurunan_skor_ohis_pasien($this->session->userdata('user_id'), $post['tahun']);
			$data['bulan'] = $post['bulan'];
			$data['tahun'] = $post['tahun'];
		}
		$this->template->utama('datapm/index_penurunan_skor_ohis_pasien', $data);
	}

	public function inputan_pelaporan_prognas()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		// $data['review']= $this->reviewmodel->get_review_star($this->session->userdata('user_id'),"",date("Y"));	
		// $data['bulan']="";
		// $data['tahun']=date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {
			$check = $post['stunting_wasting']
				+ $post['tuberculosis']
				+ $post['hipertensi']
				+ $post['diabetes_melitus']
				+ $post['kehamilan_risiko_tinggi']
				+ $post['imunisasi'];

			$datas = array(
				'bulan' => $post['bulan'],
				'tahun' => $post['tahun'],
				'stunting_wasting' => $post['stunting_wasting'],
				'tuberculosis' => $post['tuberculosis'],
				'hipertensi' => $post['hipertensi'],
				'diabetes_melitus' => $post['diabetes_melitus'],
				'kehamilan_risiko_tinggi' => $post['kehamilan_risiko_tinggi'],
				'imunisasi' => $post['imunisasi'],
				'lainnya' => $post['jumlah_pasien_satu_bulan']
					- $post['stunting_wasting']
					- $post['tuberculosis']
					- $post['hipertensi']
					- $post['diabetes_melitus']
					- $post['kehamilan_risiko_tinggi']
					- $post['imunisasi'],
				'jumlah_pasien_satu_bulan' => $post['jumlah_pasien_satu_bulan'],
				'id_faskes' => $post['id_faskes']
			);

			if ($check <= $post['jumlah_pasien_satu_bulan']) {
				$where = array('id_faskes' => $this->session->userdata('user_id'), 'bulan' => $post['bulan'], 'tahun' => $post['tahun']);
				$this->registrasiusermodel->delete_data('pelaporan_prognas', $where);

				$this->registrasiusermodel->input_data('pelaporan_prognas', $datas);
				$id = $this->db->insert_id();


				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data pelaporan_prognas'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);



				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			} else {
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jumlah Pasien Satu Bulan tidak boleh lebih kecil dari total jumlah pasien prognas');
			}
			redirect('pm/inputan_pelaporan_prognas');
		}
		$this->template->utama('datapm/input_pelaporan_prognas', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	public function index_pelaporan_prognas()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['laporan'] = $this->pelaporanpmmodel->get_pelaporan_prognas($this->session->userdata('user_id'), date("Y"));
		$data['bulan'] = "";
		$data['tahun'] = date("Y");

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$data['laporan'] = $this->pelaporanpmmodel->get_pelaporan_prognas($this->session->userdata('user_id'), $post['tahun']);
			$data['bulan'] = $post['bulan'];
			$data['tahun'] = $post['tahun'];
		}
		$this->template->utama('datapm/index_pelaporan_prognas', $data);
	}

	public function satu_sehat()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));

		$data['data3'] = $this->reviewmodel->get_satu_sehat_pic($this->session->userdata('user_id'));
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));

		// echo '<pre>';
		// print_r($data['satu_sehat']);
		// echo '</pre>';
		// exit;

		$post = $this->input->post();
		if (isset($post['submit'])) {
			$datas = array(
				'nama_pic' => $post['nama_pic'],
				'email_integrasi' => $post['email_integrasi'],
				'telp_pic' => $post['telp_pic'],
				'kode_faskes' => $post['kode_faskes'],
				'id_faskes' => $post['id_faskes']
			);


			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('satu_sehat', $where, $datas);

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data SatuSehat'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			} else {
				$this->registrasiusermodel->input_data('satu_sehat', $datas);
				$id = $this->db->insert_id();


				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data SatuSehat'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			}


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/satu_sehat');
		}

		$this->template->utama('datapm/index_satu_sehat', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}
	public function kontak_satu_sehat()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));

		$data['data3'] = $this->reviewmodel->get_satu_sehat_pic($this->session->userdata('user_id'));
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));


		$post = $this->input->post();
		if (isset($post['submit'])) {
			$datas = array(
				'nama_pic' => $post['nama_pic'],
				'email_integrasi' => $post['email_integrasi'],
				'telp_pic' => $post['telp_pic'],
				'kode_faskes' => $post['kode_faskes'],
				'id_faskes' => $post['id_faskes']
			);


			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('satu_sehat', $where, $datas);

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data SatuSehat'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			} else {
				$this->registrasiusermodel->input_data('satu_sehat', $datas);
				$id = $this->db->insert_id();


				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data SatuSehat'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			}


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/kontak_satu_sehat');
		}

		$this->template->utama('datapm/index_kontak_satu_sehat', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	public function pcare()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$data['data3'] = $this->reviewmodel->get_satu_sehat_pic($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));
		$data['pcare'] = $this->registrasiusermodel->getdatapcarepm($this->session->userdata('user_id'));

		$post = $this->input->post();
		if (isset($post['submit'])) {

			$type1 = explode('.', $_FILES["dokumen_integrasi_pcare"]["name"]); // data file
			$type1 = strtolower($type1[count($type1) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename1 = "dokumen_integrasi_pcare" . uniqid(rand()) . '.' . $type1;
			$inputFileName1 = "./assets/uploads/berkas_pcare/" . $filename1; // hash unik
			$dokumen_integrasi_pcare = $post['old_dokumen_integrasi_pcare'];

			if (!empty($_FILES["dokumen_integrasi_pcare"]["name"])) {
				if (in_array($type1, array("pdf"))) {
					$file_content = file_get_contents($_FILES["dokumen_integrasi_pcare"]["tmp_name"]);
					if (strpos($file_content, '<?php') !== false) {
						// die("File contains PHP code.");
						$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
						$this->session->set_flashdata('icon_name', 'warning');
						$this->session->set_flashdata('message_name', 'File contains PHP code.');
						redirect('pm/pcare');
					} else {
						if (is_uploaded_file($_FILES["dokumen_integrasi_pcare"]["tmp_name"])) {

							if (move_uploaded_file($_FILES["dokumen_integrasi_pcare"]["tmp_name"], $inputFileName1)) {
								$dokumen_integrasi_pcare = $filename1;
							}
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/pcare');
				}
			}

			$datas = array(
				'kode_fasyankes' => $post['kode_faskes'],
				'nama_fasyankes' => $post['nama_faskes'],
				'email' => $post['email'],
				'kedeputian_id' => $post['kedeputian'],
				'id_faskes' => $post['id_faskes'],
				'dokumen_integrasi_pcare' => $dokumen_integrasi_pcare
			);


			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('bridging_pcare', $where, $datas);

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data Pcare'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);

				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Edit Data!');
				redirect('pm/pcare');
			} else {
				$this->registrasiusermodel->input_data('bridging_pcare', $datas);
				$id = $this->db->insert_id();


				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Pcare'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);

				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Input Data!');
				redirect('pm/pcare');
			}
		}

		$this->template->utama('datapm/index_pcare', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	public function index_daftar_usulan()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['usulan'] = $this->akreditasipmmodel->get_pengajuan_usulan($this->session->userdata('user_id'));
		$cek = json_encode($data['usulan'][0]['kode_faskes']);
		$data['sertifikat'] = $this->akreditasipmmodel->get_sertifikat($cek);
		$data['file'] = json_encode($data['sertifikat'][0]['url_sertifikat']);
		$data['bulan'] = "";
		$data['tahun'] = date("Y");




		 $this->template->utama('datapm/index_daftar_usulan', $data);
	}

	public function download_usulan_cert($filename = NULL) {
		// $this->load->helper('download');
		// $filename = "SURAT EDARAN REGISTRASI UTD.pdf";
		// $data = file_get_contents(base_url("/assets/".$filename));
		// force_download($filename, $data);
	}

	public function inputan_usulan_akreditasi()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['user'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		// $data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['bulan'] = "";
		$data['tanggal'] = null;
		$data['data_dasar'] = null;
		$data['data_dokumen'] = null;
		$data['data_alkes'] = null;
		$data['data_pembiayaan_1'] = null;
		$data['data_prognas_1'] = null;
		$data['data_hipertensi_1'] = null;
		$data['data_ohis_1'] = null;
		$data['data_pembiayaan_2'] = null;
		$data['data_prognas_2'] = null;
		$data['data_hipertensi_2'] = null;
		$data['data_ohis_2'] = null;
		$data['data_pembiayaan_3'] = null;
		$data['data_prognas_3'] = null;
		$data['data_hipertensi_3'] = null;
		$data['data_ohis_3'] = null;
		$data['data_review'] = null;
		$data['data_review_star'] = null;

		$post = $this->input->post();
		if (isset($post['cek'])) {
			$data['tanggal'] = $post['tanggal'];
			$data['bulan'] = date('m', strtotime($post['tanggal']));
			$bulan = date('m', strtotime($post['tanggal'] . ' -1 month'));
			$tahun = date('Y', strtotime($post['tanggal'] . ' -1 month'));
			$bulan2 = date('m', strtotime($post['tanggal'] . ' -2 months'));
			$tahun2 = date('Y', strtotime($post['tanggal'] . ' -2 months'));
			$bulan3 = date('m', strtotime($post['tanggal'] . ' -3 months'));
			$tahun3 = date('Y', strtotime($post['tanggal'] . ' -3 months'));
			// $tahun1=date('Y', strtotime($post['tanggal'].' -1 year'));
			// echo $tahun1;

			$data['data_dasar'] = $this->akreditasipmmodel->get_data_dasar($this->session->userdata('user_id'));
			$data['data_dokumen'] = $this->akreditasipmmodel->get_data_dokumen($this->session->userdata('user_id'));
			$data['data_alkes'] = $this->akreditasipmmodel->get_data_alkes($this->session->userdata('user_id'));
			$data['data_pembiayaan_1'] = $this->akreditasipmmodel->get_pembiayaan($this->session->userdata('user_id'), $bulan, $tahun);
			$data['data_prognas_1'] = $this->akreditasipmmodel->get_prognas($this->session->userdata('user_id'), $bulan, $tahun);
			$data['data_hipertensi_1'] = $this->akreditasipmmodel->get_hipertensi($this->session->userdata('user_id'), $bulan, $tahun);
			$data['data_ohis_1'] = $this->akreditasipmmodel->get_ohis($this->session->userdata('user_id'), $bulan, $tahun);

			$data['data_pembiayaan_2'] = $this->akreditasipmmodel->get_pembiayaan($this->session->userdata('user_id'), $bulan2, $tahun2);
			$data['data_prognas_2'] = $this->akreditasipmmodel->get_prognas($this->session->userdata('user_id'), $bulan2, $tahun2);
			$data['data_hipertensi_2'] = $this->akreditasipmmodel->get_hipertensi($this->session->userdata('user_id'), $bulan2, $tahun2);
			$data['data_ohis_2'] = $this->akreditasipmmodel->get_ohis($this->session->userdata('user_id'), $bulan2, $tahun2);

			$data['data_pembiayaan_3'] = $this->akreditasipmmodel->get_pembiayaan($this->session->userdata('user_id'), $bulan3, $tahun3);
			$data['data_prognas_3'] = $this->akreditasipmmodel->get_prognas($this->session->userdata('user_id'), $bulan3, $tahun3);
			$data['data_hipertensi_3'] = $this->akreditasipmmodel->get_hipertensi($this->session->userdata('user_id'), $bulan3, $tahun3);
			$data['data_ohis_3'] = $this->akreditasipmmodel->get_ohis($this->session->userdata('user_id'), $bulan3, $tahun3);

			$data['data_review'] = $this->akreditasipmmodel->get_review($this->session->userdata('user_id'), $bulan, $tahun);
			$data['data_review_star'] = $this->akreditasipmmodel->get_review_star($this->session->userdata('user_id'), $bulan, $tahun);
			$data['data_satu_sehat'] = $this->akreditasipmmodel->get_satu_sehat($this->session->userdata('user_id'));
		}

		if (isset($post['submit'])) {
			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);

			$datas = array(
				'id_faskes' => $post['id_faskes'],
				'tanggal_usulan' => $post['tanggal_usulan'],
				'kode_faskes' => $data['data2'][0]['kode_faskes'],
				'status_verifikasi' => 0,
				'status_sertifikat' => 0,
				'id_kategori_pm' => $post['id_kategori_pm']
			);

			$this->akreditasipmmodel->input_data('usulan_akreditasi_pm', $datas);

			$id = $this->akreditasipmmodel->get_id($this->session->userdata('user_id'));

			foreach ($post['id_m_akreditasi_pm'] as $ids) {

				var_dump($post['nilai'][$ids]);
				$datas_detail = array(
					'id_faskes' => $post['id_faskes'],
					'id_m_akreditasi_pm' => $ids,
					'id_usulan_akreditasi_pm' => $id[0]['id'],
					'status' => (!empty($post['nilai'][$ids]) ? $post['nilai'][$ids]  : 0)

				);


				$this->akreditasipmmodel->input_data('trans_akreditasi_pm', $datas_detail);
			}

			$datas_log = array(
				'id_faskes' => $this->session->userdata('user_id'),
				'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Usulan Akreditasi'
			);
			$this->registrasiusermodel->input_data('timeline', $datas_log);

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/index_daftar_usulan/');
		} else {
			$this->template->utama('datapm/input_usulan_akreditasi', $data);
		}
	}

	public function asri()
	{
		$post = $this->input->post();
		// if(isset($_POST['cari'])){
		// 	$data['data']['query'] = $this->akreditasipmmodel->get_asri($_POST['id_prov'],$_POST['id_kota']); 
		// }

		if (isset($_POST['cari']) && ($this->session->userdata('id_kategori') == 1 || $this->session->userdata('id_kategori') == 8 || $this->session->userdata('id_kategori') == 10)) {
			$data['data']['query'] = $this->akreditasipmmodel->get_asri($_POST['id_prov'], $_POST['id_kota']);
		}

		if ($this->session->userdata('id_kategori') == 3) {
			// $data['data']['query'] = $this->registrasiusermodel->monitoring_pm('','','',$this->session->userdata('id_kota')); 
			$data['data']['query'] = $this->akreditasipmmodel->get_asri('', $this->session->userdata('id_kota'));
		}

		if ($this->session->userdata('id_kategori') == 2) {
			// $data['data']['query'] = $this->registrasiusermodel->monitoring_pm('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			$data['data']['query'] = $this->akreditasipmmodel->get_asri($this->session->userdata('id_prov'), $_POST['id_kota']);
		}

		$this->template->utama('admin/rekap_asri', $data);
	}

	public function pic_faskes()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['data3'] = $this->reviewmodel->get_pic_faskes($this->session->userdata('user_id'));
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat($this->session->userdata('user_id'));
		$data['rme'] = $this->registrasiusermodel->getdatarmepm($this->session->userdata('user_id'));


		$post = $this->input->post();
		if (isset($post['submit'])) {
			$datas = array(
				'nama' => $post['nama'],
				'nik' => $post['nik'],
				'email' => $post['email'],
				'telp' => $post['telp'],
				'no_str' => $post['no_str'],
				'jabatan_id' => $post['jabatan_id'],
				'kode_faskes' => $post['kode_faskes'],
				'id_faskes' => $post['id_faskes']
			);


			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('penanggung_jawab_faskes', $where, $datas);

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data Penanggung Jawab Faskes'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			} else {
				$this->registrasiusermodel->input_data('penanggung_jawab_faskes', $datas);
				$id = $this->db->insert_id();


				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Penanggung Jawab Faskes'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			}


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/pic_faskes');
		}

		$this->template->utama('datapm/index_pic_faskes', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	//UPDATE ALUR TERBARU
	public function inputan_data_pm_baru()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));

		$post = $this->input->post();
		if (isset($post['submit'])) {
			$type1 = explode('.', $_FILES["dokumen_sip"]["name"]); // data file
			$type1 = strtolower($type1[count($type1) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename1 = "dokumen_sip" . uniqid(rand()) . '.' . $type1;
			$inputFileName1 = "./assets/uploads/berkas_sip/" . $filename1; // hash unik
			$dokumen_sip = $post['old_dokumen_sip'];


			$type2 = explode('.', $_FILES["dokumen_str"]["name"]); // data file
			$type2 = strtolower($type2[count($type2) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename2 = "dokumen_str" . uniqid(rand()) . '.' . $type2;
			$inputFileName2 = "./assets/uploads/berkas_str/" . $filename2; // hash unik
			$dokumen_str = $post['old_dokumen_str'];


			$type3 = explode('.', $_FILES["dokumen_registrasi"]["name"]); // data file
			$type3 = strtolower($type3[count($type3) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename3 = "dokumen_registrasi" . uniqid(rand()) . '.' . $type3;
			$inputFileName3 = "./assets/uploads/berkas_registrasi/" . $filename3; // hash unik
			$dokumen_registrasi = $post['old_dokumen_registrasi'];

			$type4 = explode('.', $_FILES["dokumen_kewenangan"]["name"]); // data file
			$type4 = strtolower($type4[count($type4) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename4 = "dokumen_kewenangan" . uniqid(rand()) . '.' . $type4;
			$inputFileName4 = "./assets/uploads/berkas_kewenangan/" . $filename4; // hash unik
			$dokumen_kewenangan = $post['old_dokumen_kewenangan'];

			$type5 = explode('.', $_FILES["dokumen_komitmen"]["name"]); // data file
			$type5 = strtolower($type5[count($type5) - 1]); // data type like .jpg
			//exit(dump($type));
			$filename5 = "dokumen_komitmen" . uniqid(rand()) . '.' . $type5;
			$inputFileName5 = "./assets/uploads/berkas_registrasi/" . $filename5; // hash unik
			$dokumen_komitmen = $post['old_dokumen_komitmen'];

			if (!empty($_FILES["dokumen_sip"]["name"])) {
				if (in_array($type1, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_sip"]["tmp_name"])) {

						if (move_uploaded_file($_FILES["dokumen_sip"]["tmp_name"], $inputFileName1)) {
							$dokumen_sip = $filename1;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			if (!empty($_FILES["dokumen_str"]["name"])) {
				if (in_array($type2, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_str"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["dokumen_str"]["tmp_name"], $inputFileName2)) {
							$dokumen_str = $filename2;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			if (!empty($_FILES["dokumen_registrasi"]["name"])) {
				if (in_array($type3, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_registrasi"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["dokumen_registrasi"]["tmp_name"], $inputFileName3)) {
							$dokumen_registrasi = $filename3;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			if (!empty($_FILES["dokumen_kewenangan"]["name"])) {
				if (in_array($type4, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_kewenangan"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["dokumen_kewenangan"]["tmp_name"], $inputFileName4)) {
							$dokumen_kewenangan = $filename4;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			if (!empty($_FILES["dokumen_komitmen"]["name"])) {
				if (in_array($type5, array("pdf"))) {
					if (is_uploaded_file($_FILES["dokumen_komitmen"]["tmp_name"])) {
						if (move_uploaded_file($_FILES["dokumen_komitmen"]["tmp_name"], $inputFileName5)) {
							$dokumen_komitmen = $filename5;
						}
					}
				} else {
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
					redirect('pm/inputan_data_pm');
				}
			}

			$kewenangan_tambahan = implode(",", $post['kewenangan_tambahan']);
			$program_prioritas = implode(",", $post['program_prioritas']);
			$pelatihan_program_prioritas = implode(",", $post['pelatihan_program_prioritas']);
			$pelayanan_yang_diberikan = implode(",", $post['pelayanan_yang_diberikan']);

			$datas = array(
				'id_kategori' => $post['id_kategori'],
				'kerja_sama_bpjs_kesehatan' => $post['kerja_sama_bpjs_kesehatan'],
				'berjejaring_fktp' => $post['berjejaring_fktp'],
				'nama_pm' => $post['nama_pm'],
				'id_faskes' => $post['id_faskes'],
				'no_sip' => $post['no_sip'],
				'dokumen_sip' => $dokumen_sip,
				'sip_ke_berapa' => $post['sip_ke_berapa'],
				'tgl_berakhir_sip' => date('Y-m-d', strtotime($post['tgl_berakhir_sip'])),
				'no_str' => $post['no_str'],
				'dokumen_str' => $dokumen_str,
				'tgl_berakhir_str' => date('Y-m-d', strtotime($post['tgl_berakhir_str'])),
				'id_prov_pm' => $post['id_prov_pm'],
				'id_kota_pm' => $post['id_kota_pm'],
				'id_camat_pm' => $post['id_camat_pm'],
				'alamat_faskes' => $post['alamat_faskes'],
				'alamat_cetak_sertifikat' => $post['alamat_cetak_sertifikat'],
				'kepemilikan_tempat' => $post['kepemilikan_tempat'],
				'latitude' => $post['latitude'],
				'longitude' => $post['longitude'],
				'no_telp' => $post['no_telp'],
				'no_hp' => $post['no_hp'],
				'email' => $post['email'],
				'no_ktp' => $post['no_ktp'],

				'hotline' => $post['hotline'],
				'telp_kepala_faskes' => $post['telp_kepala_faskes'],

				'jam_praktik_senin_pagi' => $post['jam_praktik_senin_pagi'],
				'jam_praktik_senin_sore' => $post['jam_praktik_senin_sore'],
				'jam_praktik_selasa_pagi' => $post['jam_praktik_selasa_pagi'],
				'jam_praktik_selasa_sore' => $post['jam_praktik_selasa_sore'],

				'jam_praktik_rabu_pagi' => $post['jam_praktik_rabu_pagi'],
				'jam_praktik_rabu_sore' => $post['jam_praktik_rabu_sore'],
				'jam_praktik_kamis_pagi' => $post['jam_praktik_kamis_pagi'],
				'jam_praktik_kamis_sore' => $post['jam_praktik_kamis_sore'],

				'jam_praktik_jumat_pagi' => $post['jam_praktik_jumat_pagi'],
				'jam_praktik_jumat_sore' => $post['jam_praktik_jumat_sore'],
				'jam_praktik_sabtu_pagi' => $post['jam_praktik_sabtu_pagi'],
				'jam_praktik_sabtu_sore' => $post['jam_praktik_sabtu_sore'],

				'jam_praktik_minggu_pagi' => $post['jam_praktik_minggu_pagi'],
				'jam_praktik_minggu_sore' => $post['jam_praktik_minggu_sore'],

				'dokumen_registrasi' => $dokumen_registrasi,
				'puskesmas_pembina' => $post['puskesmas_pembina'],

				'cek_nik' => $post['cek_nik'],
				'cek_nama_pm' => $post['cek_nama_pm'],
				'cek_no_sip' => $post['cek_no_sip'],
				'cek_tgl_berakhir_sip' => $post['cek_tgl_berakhir_sip'],
				'cek_no_str' => $post['cek_no_str'],
				'cek_tgl_berakhir_str' => $post['cek_tgl_berakhir_str'],

				'status_pm' => 1,
				'str_seumur_hidup' => $post['str_seumur_hidup'],


				'dokumen_komitmen' => $dokumen_komitmen,
				//baru
				'berjejaring_puskesmas' => $post['berjejaring_puskesmas'],
				'dokumen_kewenangan' => $dokumen_kewenangan,
				'kewenangan_tambahan' => $kewenangan_tambahan,
				'kewenangan_tambahan_lainnya' => $post['kewenangan_tambahan_lainnya'],
				'pelatihan_program_prioritas' => $pelatihan_program_prioritas,
				'pelatihan_program_prioritas_lainnya' => $post['pelatihan_program_prioritas_lainnya'],
				'program_prioritas' => $program_prioritas,
				'program_prioritas_lainnya' => $post['program_prioritas_lainnya'],
				'pelayanan_yang_diberikan' => $pelayanan_yang_diberikan,
				// 'pelayanan_yang_diberikan_lainnya'=>$post['pelayanan_yang_diberikan_lainnya']
				'pelayanan_spesialistik_id' => $post['pelayanan_spesialistik_id']

			);

			// echo $datas;


			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('data_pm', $where, $datas);
				$this->registrasiusermodel->edit_data('registrasi_user', array('id' => $post['id_faskes']), array('id_camat_pm' => $post['id_camat_pm']));

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data Praktik Mandiri'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			} else {
				$this->registrasiusermodel->input_data('data_pm', $datas);
				$id = $this->db->insert_id();
				$this->registrasiusermodel->edit_data('registrasi_user', array('id' => $post['id_faskes']), array('id_camat_pm' => $post['id_camat_pm']));

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data Praktik Mandiri'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			}

			$where2 = array(
				'id_faskes' => $post["id_faskes"]
			);

			$cek = $this->registrasiusermodel->select_data('trans_final', $where2)->num_rows();
			if ($cek > 0) {
			} else {
				$this->registrasiusermodel->delete_data('trans_final', $where2);

				$datas_detail = array(
					'id_faskes' => $post["id_faskes"],
					'final' => 1,
					'id_link' => $post["id_kota_pm"],
					'kode_faskes_lama' => $post["kode_faskes_lama"],
					'kode_regional_link' => $post["kode_regional"]
				);


				$this->registrasiusermodel->input_data('trans_final', $datas_detail);

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyelesaikan Data registrasi dan sudah diteruskan ke dinkes kota terkait'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);


				$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


				$datas_detail = array('token_kode_faskes' => $token);

				$this->registrasiusermodel->edit_data('trans_final', $where2, $datas_detail);

				// 		$datas_log = array(
				// 		'id_faskes' =>$post["id_faskes"],
				// 		'id_dinkes' =>$this->session->userdata('user_id'),
				// 		'status' =>''.$this->session->userdata('email').' Telah Di Setujui Oleh Dinkes/Kemkes'
				// );
				// $where3 = array('id_faskes' => $post["id_faskes"]);
				$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where2)->result_array();
				$this->validasi_link_kode_faskes_baru($token, $data['data2'][0]["id_link"], $post["id_faskes"], $data['data2'][0]["kode_regional_link"]);


				// $this->registrasiusermodel->input_data('timeline',$datas_log);

			}



			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pm/inputan_data_pm_baru');
		}

		$this->template->utama('datapm/index_baru', $data);
	}

	function validasi_link_kode_faskes_baru($token, $id_link, $id, $kode_regional_link)
	{

		$where = array(
			'token_kode_faskes' => $token,
			'validate_token' => 0
		);
		$cek = $this->loginmodel->cek_login("trans_final", $where)->num_rows();
		if ($cek > 0) {
			//$show_user = $this->loginmodel->cek_login("registrasi_user",$where)->result_array();
			$kode_faskes = $this->pmmodel->findNoFaskes($id_link);

			$where_edit = array(
				'token_kode_faskes' => $token
			);
			$datas = array(
				'validate_token' => 1,
				//   'kode_faskes' =>$this->pmmodel->findNoFaskes($id_link),
				'kode_faskes' => $kode_faskes,
				'kode_faskes_baru' => $kode_faskes,
				//   'kode_faskes_baru' =>$this->registrasiusermodel->findNoFaskesBaru($id_link,'9'),
				'status_pendaftaran' => 1,
				'create_kode' => date('Y-m-d H:i:s')
			);
			$this->registrasiusermodel->edit_data('trans_final', $where_edit, $datas);


			$data['data'] = $this->registrasiusermodel->getbylistpendaftaran($id);
			$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
			$data['trans_final'] = $this->registrasiusermodel->select_data('trans_final', $wheregetkodefaskes)->result_array();
			$email  = $data['data'][0]['email'];
			$title   = "Registrasi Faskes";
			$message = "Yth,<br><br>
			" . $data['data'][0]['nama_lengkap'] . ",
			<br><br>
			Selamat datang di Aplikasi Registrasi Fasyankes Online.<br>
			Kode Faskes Anda : " . $data['trans_final'][0]['kode_faskes'] . "
			<br><br>
			Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
			registrasi.fasyankes2@gmail.com<br>
			<br><br>
			Salam<br>
			Sekretariat Direktorat Jenderal Pelayanan Kesehatan";

			//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
			$mail = $this->send_email("registrasifasyankes@kemkes.go.id", "Sekretariat Direktorat Jenderal Pelayanan Kesehatan", "uLH0%RYL", $title, $email, $data['data'][0]['nama_lengkap'], $message);

			//$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'],$data['data'][0]['nama_pm'],'tpmd',$data['data'][0]['id_kota'],null,$data['data'][0]['jenis_tpmd']);
			$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'], $data['data'][0]['nama_pm'], 'tpmd', $data['data'][0]['id_kota'], '', 'tpmd', $data['data'][0]['jenis_tpmd'], '', $data['trans_final'][0]['kode_faskes_baru']);

			// if($mail){
			// 	$this->session->set_flashdata('kode_name', 'success');
			// 	$this->session->set_flashdata('icon_name', 'check');
			// 	$this->session->set_flashdata('message_name', 'Kode Faskes Sudah Aktif');
			// 	redirect(base_url("pm/verifikasikan_kirim/".$id.""));
			// } 



		} else {
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Link Aktifasi Tidak Valid Atau Sudah Dipakai!');
			redirect(base_url("admin/index"));
		}
	}

	public function satu_sehat_terkoneksi()
	{
		$post = $this->input->post();
		$propinsi = isset($post['id_prov']) ? $post['id_prov'] : null;
		$kota = isset($post['id_kota']) ? $post['id_kota'] : null;
		$kode_faskes = isset($post['kode_faskes']) ? $post['kode_faskes'] : null;
		$quartal = isset($post['quartal']) ? $post['quartal'] : null;
		$tahun = isset($post['tahun']) ? $post['tahun'] : null;
		$terkoneksi = isset($post['terkoneksi']) ? $post['terkoneksi'] : null;
		if (!empty($propinsi) && $propinsi != 9999) {
			$propinsi = $propinsi;
		} else {
			$propinsi = null;
		}
		if (!empty($kota) && $kota != 9999) {
			$kota = $kota;
		} else {
			$kota = null;
		}
		$token = $this->generateTokenApiSatuSehat();

		if (isset($_POST['cari']) && ($this->session->userdata('id_kategori') == 1 || $this->session->userdata('id_kategori') == 8 || $this->session->userdata('id_kategori') == 10)) {

			// $data['data']['query'] = $this->generateDataSatuSehatTerkoneksi($token,$propinsi,$kota,$kode_faskes,array(),null,$quartal);
			$data['data']['query'] = $this->pmmodel->get_satu_sehat_terkoneksi($propinsi, $kota, $kode_faskes, $quartal, $tahun, $terkoneksi);
		}

		if ($this->session->userdata('id_kategori') == 3) {
			// $data['data']['query'] = $this->generateDataSatuSehatTerkoneksi($token,$propinsi,$this->session->userdata('id_kota'),$kode_faskes,array(),null,$quartal);
			$data['data']['query'] = $this->pmmodel->get_satu_sehat_terkoneksi($propinsi, $this->session->userdata('id_kota'), $kode_faskes, $quartal, $tahun, $terkoneksi);
		}

		if ($this->session->userdata('id_kategori') == 2) {

			// $data['data']['query'] = $this->generateDataSatuSehatTerkoneksi($token,$this->session->userdata('id_prov'),$kota,$kode_faskes,array(),null,$quartal);
			$data['data']['query'] = $this->pmmodel->get_satu_sehat_terkoneksi($this->session->userdata('id_prov'), $kota, $kode_faskes, $quartal, $tahun, $terkoneksi);
		}

		$this->template->utama('datapm/rekap_satusehat_terkoneksi', $data);
	}

	public function update_satu_sehat_terkoneksi()
	{
		$post = $this->input->post();
		$propinsi = isset($post['id_prov']) ? $post['id_prov'] : null;
		$kota = isset($post['id_kota']) ? $post['id_kota'] : null;
		$kode_faskes = isset($post['kode_faskes']) ? $post['kode_faskes'] : null;
		$page_token = isset($post['page_token']) ? $post['page_token'] : null;
		$quartal = isset($post['quartal']) ? $post['quartal'] : null;
		$tahun = isset($post['tahun']) ? $post['tahun'] : null;
		if (!empty($propinsi) && $propinsi != 9999) {
			$propinsi = $propinsi;
		} else {
			$propinsi = null;
		}
		if (!empty($kota) && $kota != 9999) {
			$kota = $kota;
		} else {
			$kota = null;
		}

		if (!empty($quartal) && !empty($tahun)) {
			$quartal = $quartal . "%20" . $tahun;
		} else {
			$quartal = "";
		}

		$token = $this->generateTokenApiSatuSehat();

		if (isset($_POST['cari'])) {

			// $data['data']['query'] = $this->generateDataSatuSehatTerkoneksi($token,$propinsi,$kota,$kode_faskes,array(),null,$quartal);
			// $data['data']['query'] = $this->pmmodel->get_satu_sehat_terkoneksi($propinsi,$kota,$kode_faskes,$quartal,$tahun,$terkoneksi);
			$token = $this->generateTokenApiSatuSehat();
			$data['data']['query'] = $this->generateDataSatuSehatTerkoneksi($token, $propinsi, $kota, $kode_faskes, array(), $page_token, $quartal);
		}

		$this->template->utama('datapm/update_rekap_satusehat_terkoneksi', $data);
	}

	public function updateSatuSehatTerkoneksi()
	{
		// $where = array(1 => 1);
		// $data_terkoneksi = $this->registrasiusermodel->select_data('tpmd_sudah_satusehat',$where)->result();

		// $data = array(); 
		// foreach ($data_terkoneksi as $row)
		// {
		// 	array_push($data, $row->kode_faskes);
		// }

		$token = $this->generateTokenApiSatuSehat();
		// var_dump($token);
		$data_api = $this->generateDataSatuSehatTerkoneksi($token, null, null, null, array(), null, null);

		// echo ' batas 0 </br>';
		// echo ' batas 0 </br>';
		// var_dump($data_api);

		// $data2 = array(); 
		// if(!empty($data_api)){
		// 	foreach($data_api as $row){
		// 		// echo $row['kode_kmk'];
		// 		// if($row['is_terkoneksi']=="Yes"){
		// 			if (!in_array($row, $data2)) {
		// 				array_push($data2, $row);
		// 			}
		// 		// }
		// 	}
		// }

		// echo ' batas 1 </br>';
		// echo ' batas 1 </br>';
		// var_dump($data2);

		// echo ' batas 2 </br>';


		// foreach($data2 as $row){
		// 	if (!in_array($row, $data)) {
		// 		echo $row.' </br>';
		// 		$datas_log = array(
		// 			'kode_faskes' =>$row
		// 		);
		// 		$this->registrasiusermodel->input_data('tpmd_sudah_satusehat',$datas_log);
		// 	}
		// }
		// echo ' batas </br>';

		// var_dump($data);

	}

	public function generateTokenApiSatuSehat()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.kemkes.go.id/oauth2/v1/accesstoken?grant_type=client_credentials',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => 'client_id=nVoHYbwXgyCqlpIdAym2PgOFBCpdcKGNpcSnbAcsAmohcYZ8&client_secret=BUfaxwbv4x3ZAn3tgpgYC7bIN6MzGvmqLtVB82zQfybxsZhgtRO5MqD3bfA1RPTD',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded'
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$response2 = json_decode($response, true);
		return $response2['access_token'];
	}

	public function generateDataSatuSehatTerkoneksi($token, $provinsi, $kabkota, $kode_faskes, $data, $page_token, $quartal)
	{
		$no = 0;

		if (!empty($quartal)) {
			$quartal1 = '&quartal=' . $quartal;
		} else {
			$quartal1 = '';
		}

		if (!empty($provinsi)) {
			$provinsi1 = '&kode_provinsi=' . $provinsi;
		} else {
			$provinsi1 = '';
		}

		if (!empty($kabkota)) {
			$kabkota1 = '&kode_kabkota=' . $kabkota;
		} else {
			$kabkota1 = '';
		}

		if (!empty($kode_faskes)) {
			$kode_faskes1 = '&kode_kmk=' . $kode_faskes;
		} else {
			$kode_faskes1 = '';
		}

		if (!empty($page_token)) {
			$page_token1 = '&page_token=' . $page_token;
			$kode_faskes1 = '';
			$kabkota1 = '';
			$provinsi1 = '';
			$quartal1 = '';
		} else {
			$page_token1 = '';
		}

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.kemkes.go.id/data/v1/tpmd/monev_yankes_tpmd?limit=2000' . $provinsi1 . $kabkota1 . $kode_faskes1 . $quartal1 . $page_token1,
			// CURLOPT_URL => 'https://api.kemkes.go.id/data/v1/tpmd/monev_yankes_tpmd?limit=2000&kode_provinsi=96',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer ' . $token
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$response2 = json_decode($response, true);

		// foreach($response2['data']['data'] as $row){
		// 	// echo $row['kode_kmk'];
		// 	if($row['is_terkoneksi']=="Yes"){
		// 		// if (!in_array($row['kode_kmk'], $data2)) {
		// 			array_push($data, $row['kode_kmk']);
		// 		// }
		// 	}
		// }

		$data = array_merge($data, $response2['data']['data']);

		// var_dump($data);



		// if(!empty($response2['data']['next_page_token'])){
		// 	return $this->generateDataSatuSehatTerkoneksi($token,$provinsi,$kabkota,$kode_faskes,$data,$response2['data']['next_page_token'],$quartal);
		// } else {
		// var_dump(count($data));
		var_dump($response2['data']['next_page_token']);

		//update di aktifkan

		$data3 = array(); 
		foreach($data as $row){
			// echo $row['kode_kmk'];
			if($row['is_terkoneksi']=="Yes"){
				// if (!in_array($row['kode_kmk'], $data2)) {
					array_push($data3, $row['kode_kmk']);
				// }
			}
		}

		$where = array(1 => 1);
		$data_terkoneksi_db = $this->registrasiusermodel->select_data('tpmd_sudah_satusehat',$where)->result();

		$data_terkoneksi = array(); 
		foreach ($data_terkoneksi_db as $row)
		{
			array_push($data_terkoneksi, $row->kode_faskes);
		}


		$data2 = array(); 
		if(!empty($data3)){
			foreach($data3 as $row){
					if (!in_array($row, $data2)) {
						array_push($data2, $row);
					}
			}
		}

		// var_dump($data3);

		foreach($data2 as $row){
			if (!in_array($row, $data_terkoneksi)) {
				echo $row.' </br>';
				$datas_log = array(
					'kode_faskes' =>$row
				);
				$this->registrasiusermodel->input_data('tpmd_sudah_satusehat',$datas_log);
			}
		}

		// batas update diaktifkan


		foreach ($data as $row) {
			// echo $row['kode_kmk'];
			// if($row['is_terkoneksi']=="No"){
			// if (!in_array($row['kode_kmk'], $data2)) {
			// array_push($data, $row['kode_kmk']);
			// }
			$datas_log = array(
				'ihs_organization' => $row['ihs_organization'],
				'month_date' => $row['month_date'],
				'first_data_sent' => $row['first_data_sent'],
				'is_terkoneksi' => $row['is_terkoneksi'],
				'jenis_sarana_name' => $row['jenis_sarana_name'],
				'jumlah_kiriman' => $row['jumlah_kiriman'],
				'kabkota' => $row['kabkota'],
				'kabkota_name' => $row['kabkota_name'],
				'kode_kmk' => $row['kode_kmk'],
				'organization_name' => $row['organization_name'],
				'provinsi' => $row['provinsi'],
				'provinsi_name' => $row['provinsi_name'],
				'quartal' => $row['quartal'],
				'subjenis_01_name' => $row['subjenis_01_name']
			);
			$this->registrasiusermodel->input_data('terkoneksi_satusehat_by_quartal', $datas_log);
			// }
		}

		return $data;

		// }

		// return $data;
		// return $response2['data']['data'];
	}

	public function generateTokenApiSatuSehatRevokeRefresh()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api-dev.dto.kemkes.go.id/dev-portal-api/external/auth',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
			"email": "dfoyankes@yopmail.com",
			"password": "soulAdmin@27128"
		}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$response2 = json_decode($response, true);
		return $response2['accessToken'];
		// echo $response2['accessToken'];
	}

	// public function revokeSatuSehatAPI($email, $facilityCode, $orgId, $vendorId)
	public function revokeSatuSehatAPI()
	{
		$token = $this->generateTokenApiSatuSehatRevokeRefresh();
		// echo $token;
		$email = 'attisemiati@yahoo.com'; 
		$facilityCode = "32730173572";
		$orgId = "100056878";
		$vendorId = "44";
		// $vendorId = (int)$vendorId;

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api-dev.dto.kemkes.go.id/dev-portal-api/external/apps/revoke-credential',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"email": "'.$email.'",
			"facilityCode": "'.$facilityCode.'",
			"orgId": "'.$orgId.'",
			"vendorId": '.$vendorId.'
		}',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$token,
			'Content-Type: application/json'
		),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$response2 = json_decode($response, true);
		var_dump($response2);
		// return $response2;
	}

	public function refreshSatuSehatAPI($email, $facilityCode, $orgId)
	{
		$token = $this->generateTokenApiSatuSehatRevokeRefresh();
		// echo $token;
		// $email = 'attisemiati@yahoo.com'; 
		// $facilityCode = "32730173572";
		// $orgId = "100056878";

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api-dev.dto.kemkes.go.id/dev-portal-api/external/apps/refresh-credential',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"email": "'.$email.'",
			"facilityCode": "'.$facilityCode.'",
			"orgId": "'.$orgId.'"
		}',
		CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$token,
			'Content-Type: application/json'
		),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$response2 = json_decode($response, true);
		// var_dump($response2);
		return $response2;
	}

	public function satu_sehat_dev()
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2'] = $this->registrasiusermodel->select_data('trans_final', $where)->result_array();
		$data['data'] = $this->registrasiusermodel->getdatapm($this->session->userdata('user_id'));
		$data['user'] = $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));
		$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat_dev($this->session->userdata('user_id'));
		$data['data3'] = $this->reviewmodel->get_satu_sehat_pic($this->session->userdata('user_id'));

		// var_dump($data['user'][0]['email']);
		// var_dump($data['data2'][0]['kode_faskes']);
		// var_dump($data['satu_sehat'][0]['organization_id']);

		// $this->refreshSatuSehatAPI($data['user'][0]['email'], $data['data2'][0]['kode_faskes'], $data['satu_sehat'][0]['organization_id']);
		$datas = $this->refreshSatuSehatAPI($data['user'][0]['email'],$data['data2'][0]['kode_faskes'],$data['satu_sehat'][0]['organization_id']);
		var_dump($datas);
		if( $datas['resourceType'] == "IHS/App"){
			$datas2 = array(
				'client_id' => $datas['clientKey'],
				'secret_key' => $datas['clientSecret']
			);
			var_dump($datas2);
	
	
			$where = array(
				'organization_id' => $data['satu_sehat'][0]['organization_id']
			);
			$this->registrasiusermodel->edit_data('satu_sehat_id_dev', $where, $datas2);
	
			$data['satu_sehat'] = $this->reviewmodel->get_satu_sehat_dev($this->session->userdata('user_id'));
		}

		$post = $this->input->post();
		if (isset($post['submit'])) {
			$datas = array(
				'nama_pic' => $post['nama_pic'],
				'email_integrasi' => $post['email_integrasi'],
				'telp_pic' => $post['telp_pic'],
				'kode_faskes' => $post['kode_faskes'],
				'id_faskes' => $post['id_faskes']
			);


			if (!empty($post['id'])) {
				$where = array(
					'id' => $post['id']
				);
				$this->registrasiusermodel->edit_data('satu_sehat', $where, $datas);

				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Mengedit Data SatuSehat'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			} else {
				$this->registrasiusermodel->input_data('satu_sehat', $datas);
				$id = $this->db->insert_id();


				$datas_log = array(
					'id_faskes' => $this->session->userdata('user_id'),
					'status' => '' . $this->session->userdata('email') . ' Telah Menyimpan Data SatuSehat'
				);
				$this->registrasiusermodel->input_data('timeline', $datas_log);
			}


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');

			var_dump($data['user'][0]['email']);
			var_dump($data['data2'][0]['kode_faskes']);
			var_dump($data['satu_sehat'][0]['organization_id']);

			// $datas = $this->refreshSatuSehatAPI($data['user'][0]['email'],$data['data2'][0]['kode_faskes'],$data['satu_sehat'][0]['organization_id']);
			// var_dump($datas);

			// redirect('pm/satu_sehat_dev');


		}

		$this->template->utama('datapm/index_satu_sehat', $data);
		// var_dump($this->reviewmodel->get_review($this->session->userdata('user_id'),"",date("Y")));  	
	}

	private function authSatuSehat() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://developer-portal-api.kemkes.go.id/external/auth',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
				"email": "Infomonev.yankes@gmail.com",
				"password": "8H4eBy3prF"
			}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));
		$response = curl_exec($curl);
		$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);

		if ($status_code == 200) {
			return $response;
		} else {
			return 'unauthorized';
		}
	}

	private function generateNewApiToken($postData, $accessToken) {
		$curl2 = curl_init();

		curl_setopt_array($curl2, array(
			CURLOPT_URL => 'https://developer-portal-api.kemkes.go.id/external/apps/revoke-credential',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer '. $accessToken,
				'Content-Type: application/json'
			),
		));                        

		$response2 = curl_exec($curl2);
		$status_code = curl_getinfo($curl2, CURLINFO_HTTP_CODE);
		curl_close($curl2);

		if ($status_code == 200) {
			return $response2;
		} else {
			return 'error';
		}
	}
}
