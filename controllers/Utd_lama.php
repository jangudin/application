<?php
class Utd extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	date_default_timezone_set("Asia/Jakarta");
		if($this->session->userdata('status') != "login"){
			redirect(base_url("admin"));
		}

		$this->load->library('pagination');
		$this->load->model('registrasiusermodel');		
		$this->load->model('labkesmodel');		
		$this->load->model('rsmodel');
		$this->load->model('utdmodel');
		$this->load->model('loginmodel');	
		define('MB', 1048576);		
	}
		
	function list_user_yang_mengajukan_prov($id=0){
	
			$data['data']['query'] = $this->utdmodel->getlistpengajuanutd($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
		
			$this->template->utama('adminutd/list_user_yang_mengajukan_prov',$data);  
	}
	
	function list_user_yang_mengajukan_prov_belum_validasi($id=0){

			$data['data']['query'] = $this->utdmodel->getlistpengajuanbelumvalidasiutd($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('adminutd/list_user_yang_mengajukan_prov_belum_validasi',$data);  
	}
	
	function list_user_yang_mengajukan_prov_perbaikan($id=0){
			$data['data']['query'] = $this->utdmodel->getlistpengajuanbelumvalidasiperbaikanutd($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('adminutd/list_user_yang_mengajukan_prov_perbaikan',$data);  
	}
	
	function list_user_yang_mengajukan_kota($id=0){
		$data['data']['query'] = $this->utdmodel->getlistpengajuanutd($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
		
			$this->template->utama('adminutd/list_user_yang_mengajukan_kota',$data);  
	}
	
	function list_user_yang_mengajukan_kota_belum_validasi($id=0){
			$data['data']['query'] = $this->utdmodel->getlistpengajuanbelumvalidasiutd($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('adminutd/list_user_yang_mengajukan_kota_belum_validasi',$data);  
	}
	
	function list_user_yang_mengajukan_kota_perbaikan($id=0){
			$data['data']['query'] = $this->utdmodel->getlistpengajuanbelumvalidasiperbaikanutd($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('adminutd/list_user_yang_mengajukan_kota_perbaikan',$data);  
	}
	
	
	function list_user_yang_mengajukan_labkes($id=0){
			$data['data']['query'] = $this->labkesmodel->getlistpengajuanlabkes($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes',$data);  
	}
	
	function list_user_yang_mengajukan_belum_validasi_labkes($id=0){
			$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasilabkes($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('adminlabkes/list_user_yang_mengajukan_belum_validasi_labkes',$data);  
	}
	
	function list_user_yang_mengajukan_belum_validasi_perbaikan_labkes($id=0){
			$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasiperbaikanlabkes($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('adminlabkes/list_user_yang_mengajukan_belum_validasi_perbaikan_labkes',$data);  
	}
	
	
	function verifikasi_pengajuan_faskes_utd($id=NULL){

				$post = $this->input->post();

			/* 	if(isset($post['submit'])){
					$json_validasi='{"field":{"nama_lab_validasi":{"nilai":"'.(isset($post["nama_lab_validasi"]) ? $post["nama_lab_validasi"] : null).'","keterangan":"'.(isset($post["keterangan_nama_lab_validasi"]) ? $post["keterangan_nama_lab_validasi"] : null).'"},"pemilik_validasi":{"nilai":"'.(isset($post["pemilik_validasi"]) ? $post["pemilik_validasi"] : null).'","keterangan":"'.(isset($post["keterangan_pemilik_validasi"]) ? $post["keterangan_pemilik_validasi"] : null).'"},"alamat_validasi":{"nilai":"'.(isset($post["alamat_validasi"]) ? $post["alamat_validasi"] : null).'","keterangan":"'.(isset($post["keterangan_alamat_validasi"]) ? $post["keterangan_alamat_validasi"] : null).'"} }}';

					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);

						$datas_detail = array(
						'validasi_field' =>$json_validasi
						);
					
					$this->registrasiusermodel->edit_data('data_labkes',$where2,$datas_detail);
	//echo $this->db->last_query();
		

					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Di Validasi');
					redirect('labkes/verifikasi_pengajuan_faskes_labkes/'.$id);
				}
 */
			$data['data']= $this->registrasiusermodel->getdatautd($id);

			$data['user_id']=$id;
	
			$this->template->utama('adminutd/verifikasi_pengajuan_faskes_utd',$data);  
	}
	function verifikasi_pengajuan_faskes_sarpras_alkes_utd($id=NULL){

	

		$where = array('id_faskes' => $id);
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdatasarprasalkesutd($id);	
		$data['user']= $this->registrasiusermodel->getdatautd($id);
		$data['user_id']= $id;
		$post = $this->input->post();
			

	
			$this->template->utama('adminutd/verifikasi_pengajuan_faskes_sarpras_alkes_utd',$data);  
	}
	
	function verifikasi_pengajuan_faskes_alkes_utd($id=NULL){

	

		$where = array('id_faskes' => $id);
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdataalkesutd($id);	
		$data['user']= $this->registrasiusermodel->getdatautd($id);
		$data['user_id']= $id;
		$post = $this->input->post();
			

	
			$this->template->utama('adminutd/verifikasi_pengajuan_faskes_alkes_utd',$data);  
	}
	
	function verifikasi_pengajuan_faskes_sdm_utd($id=NULL){

		    $post = $this->input->post();

			//$data['user']= $this->registrasiusermodel->getdatauser($id);	
			$data['user']= $this->registrasiusermodel->getdatautd($id);
			$data['data']= $this->registrasiusermodel->getdatasdmutd($id);	
		    $data['user_id']= $id;
	
			$this->template->utama('adminutd/verifikasi_pengajuan_faskes_sdm_utd',$data);  
	}
	
	
	function verifikasi_pengajuan_pelayanan_rs($id=NULL){

		    $post = $this->input->post();

			//$data['user']= $this->registrasiusermodel->getdatauser($id);	
			$data['user']= $this->registrasiusermodel->getdatars($id);
			$data['data']= $this->registrasiusermodel->getdatapelayananrs($id);	
		    $data['user_id']= $id;
	
			$this->template->utama('adminrs/verifikasi_pengajuan_pelayanan_rs',$data);  
	}
	
	
	function verifikasikan_kirim_utd($id=NULL){

		    $post = $this->input->post();
				if(isset($post['submit'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);

						$datas_detail = array(
						'id_link' =>$post["kota"]
						);
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Kirim Ke Dinkes Terkait!');
					redirect('rs/verifikasikan_kirim_rs/'.$id);
				}
				
				
				if(isset($post['submit_validasi'])){
						
	
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
			
				$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);
				
                  $datas_detail = array('token_kode_faskes' =>$token,'id_validate_kota' =>$this->session->userdata('user_id'),'status_validasi_kota'=>'Sudah Validasi');
					
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Di Setujui Oleh Dinkes Kota'
				);
					$where = array('id_faskes' => $post["id_faskes"]);
					$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
					
				   $this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"]);
				
				
					$this->registrasiusermodel->input_data('timeline',$datas_log);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Pemberitahuan Akan Di Kirimkan Melalui Aplikasi Registrasi Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi');
					redirect('utd/verifikasikan_kirim_utd/'.$id);
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
				
				if(isset($post['submit_setujui_prov'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


						
							$datas_detail = array('token_kode_faskes' =>$token,'id_validate_prov' =>$this->session->userdata('user_id'),'status_validasi_prov'=>'Sudah Validasi');
						
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
					redirect('utd/verifikasikan_kirim_utd/'.$id);
				}
				
				
				if(isset($post['submit_setujui_kemkes'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


						$datas_detail = array('token_kode_faskes' =>$token,'id_validate_kemkes' =>$this->session->userdata('user_id'),'status_validasi_kemkes'=>'Sudah Validasi');
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Di Setujui Oleh Kemkes'
				);
					$where = array('id_faskes' => $post["id_faskes"]);
					$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
				    $this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"]);
				
				
					$this->registrasiusermodel->input_data('timeline',$datas_log);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Pemberitahuan Akan Di Kirimkan Melalui Aplikasi Registrasi Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi');
					redirect('rs/verifikasikan_kirim_rs/'.$id);
				}
				
				if(isset($post['submit_perbaikan'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);
				
				if(empty($post["catatan"])){
					 	$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Catatan Kosong!');
					redirect('utd/verifikasikan_kirim_utd/'.$id);
					 
				 }

					$datas_detail = array('final' =>0,'catatan'=>$post["catatan"],'token_kode_faskes'=>'','id_validate_kota' =>'','status_validasi_kota'=>'Perbaikan');

						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Minta Diperbaiki Oleh Dinkes Kab/Kota Ke User UTD('.$post["catatan"].')'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			
			
					
		$data['data']= $this->registrasiusermodel->getbylistpendaftaran($post["id_faskes"]);  
		$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
		$data['trans_final']= $this->registrasiusermodel->select_data('trans_final',$wheregetkodefaskes)->result_array();
		$email  = $data['data'][0]['email']; 
		$title   = "Registrasi Faskes"; 
		$message = "Yth,<br><br>
		".$data['data'][0]['nama_lengkap'].",
		<br><br>
		Selamat datang di Aplikasi Registrasi Faskes Online.<br>
		Data Fasyankes Anda Di minta Untuk Diperbaiki, Harap Buka Aplikasi https://registrasifasyankes.kemkes.go.id
		<br><br>
		Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
		registrasi.fasyankes2@gmail.com<br>
		<br><br>
		Salam<br>
		Sekretariat Direktorat Jenderal Pelayanan Kesehatan"; 

		//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		$mail = $this->send_email("infoyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","n3nceY@D",$title,$email,$data['data'][0]['nama_lengkap'],$message);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
					redirect('utd/verifikasikan_kirim_utd/'.$id);
				}
				
				
				if(isset($post['submit_perbaikan_prov'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);

			if(empty($post["catatan"])){
					 	$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Catatan Kosong!');
					redirect('utd/verifikasikan_kirim_utd/'.$id);
					 
				 }
				 
						$datas_detail = array('final' =>0,'catatan'=>$post["catatan"],'token_kode_faskes'=>'','id_validate_kota' =>'','status_validasi_prov'=>'Perbaikan');
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Minta Diperbaiki Oleh Dinkes Provinsi Ke User UTD('.$post["catatan"].')'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			
			
					


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
					redirect('utd/verifikasikan_kirim_utd/'.$id);
				}
				
				if(isset($post['submit_perbaikan_kemkes'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


						
						$datas_detail = array('final' =>0,'catatan'=>$post["catatan"],'token_kode_faskes'=>'','id_validate_kota' =>'','status_validasi_kemkes'=>'Perbaikan');
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Minta Diperbaiki Oleh Kemkes Ke User RS('.$post["catatan"].')'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			
			
					


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
					redirect('rs/verifikasikan_kirim_rs/'.$id);
				}
				
			$where = array('id_faskes' => $id);
			$data['data']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
			$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
			$data['data2']= $this->registrasiusermodel->getdatautd($id);
			
			
		    $data['user_id']= $id;
	
			$this->template->utama('adminutd/verifikasikan_kirim_utd',$data);  
	}
	
	
	public function inputan_data_faskes_utd()
	{
			$where = array('id_faskes' => $this->session->userdata('user_id'));
			$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
			$data['data']= $this->registrasiusermodel->getdatautd($this->session->userdata('user_id'));
			$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
	
			$post = $this->input->post();
		
	
		if(isset($post['submit'])){
			
		$type1 = explode('.', $_FILES["surat_izin_operasional_utd"]["name"]); // data file
		$type1 = strtolower($type1[count($type1)-1]); // data type like .jpg//exit(dump($type));
		$filename1="surat_izin_operasional_utd".uniqid(rand()).'.'.$type1;	
		$inputFileName1 = "./assets/uploads/berkas_operasional/".$filename1; // hash unik
		$surat_izin_operasional_utd=$post['old_surat_izin_operasional_utd'];
		
		$type2 = explode('.', $_FILES["sk_pembentukan"]["name"]); // data file
		$type2 = strtolower($type2[count($type2)-1]); // data type like .jpg//exit(dump($type));
		$filename2="sk_pembentukan".uniqid(rand()).'.'.$type2;	
		$inputFileName2 = "./assets/uploads/berkas_operasional/".$filename2; // hash unik
		$surat_sk_pembentukan=$post['old_sk_pembentukan'];
		
		$type3 = explode('.', $_FILES["surat_permohonan_registrasi"]["name"]); // data file
		$type3 = strtolower($type3[count($type3)-1]); // data type like .jpg//exit(dump($type));
		$filename3="surat_permohonan_registrasi".uniqid(rand()).'.'.$type3;	
		$inputFileName3 = "./assets/uploads/berkas_operasional/".$filename3; // hash unik
		$surat_permohonan_registrasi=$post['old_surat_permohonan_registrasi'];
		
		$type4 = explode('.', $_FILES["upload_sertifikat_akreditasi"]["name"]); // data file
		$type4 = strtolower($type4[count($type4)-1]); // data type like .jpg//exit(dump($type));
		$filename4="upload_sertifikat_akreditasi".uniqid(rand()).'.'.$type4;	
		$inputFileName4 = "./assets/uploads/berkas_operasional/".$filename4; // hash unik
		$upload_sertifikat_akreditasi=$post['old_upload_sertifikat_akreditasi'];
		
		$type5 = explode('.', $_FILES["upload_sertifikat_cpob"]["name"]); // data file
		$type5 = strtolower($type5[count($type5)-1]); // data type like .jpg//exit(dump($type));
		$filename5="upload_sertifikat_cpob".uniqid(rand()).'.'.$type4;	
		$inputFileName5 = "./assets/uploads/berkas_operasional/".$filename5; // hash unik
		$upload_sertifikat_cpob=$post['old_upload_sertifikat_cpob'];
		
	
		
		
		

		
		if(!empty($_FILES["surat_izin_operasional_utd"]["name"])){
			if(in_array($type1, array("pdf"))) {
				
				
				if(is_uploaded_file($_FILES["surat_izin_operasional_utd"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["surat_izin_operasional_utd"]["tmp_name"],$inputFileName1)) {
						$surat_izin_operasional_utd=$filename1;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('utd/inputan_data_faskes_utd');
				
			}
		}
		
	/* 	if(!empty($_FILES["sk_pembentukan"]["name"])){
			if(in_array($type2, array("pdf"))) {
				
				
				if(is_uploaded_file($_FILES["sk_pembentukan"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["sk_pembentukan"]["tmp_name"],$inputFileName2)) {
						$surat_sk_pembentukan=$filename2;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('utd/inputan_data_faskes_utd');
				
			}
		} */
		
		if(!empty($_FILES["surat_permohonan_registrasi"]["name"])){
			if(in_array($type3, array("pdf"))) {
				
				
				if(is_uploaded_file($_FILES["surat_permohonan_registrasi"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["surat_permohonan_registrasi"]["tmp_name"],$inputFileName3)) {
						$surat_permohonan_registrasi=$filename3;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('utd/inputan_data_faskes_utd');
				
			}
		}
		
		if(!empty($_FILES["upload_sertifikat_akreditasi"]["name"])){
			if(in_array($type4, array("pdf"))) {
				
				
				if(is_uploaded_file($_FILES["upload_sertifikat_akreditasi"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["upload_sertifikat_akreditasi"]["tmp_name"],$inputFileName4)) {
						$upload_sertifikat_akreditasi=$filename4;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('utd/inputan_data_faskes_utd');
				
			}
		}
		
		if(!empty($_FILES["upload_sertifikat_cpob"]["name"])){
			if(in_array($type5, array("pdf"))) {
				
				
				if(is_uploaded_file($_FILES["upload_sertifikat_cpob"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["upload_sertifikat_cpob"]["tmp_name"],$inputFileName5)) {
						$upload_sertifikat_cpob=$filename5;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('utd/inputan_data_faskes_utd');
				
			}
		}
		
		$jenis_pemeriksaan=implode(",",$post['jenis_pemeriksaan']);
		$jp_rapid_test=implode(",",$post['jp_rapid_test']);
		$jp_clia=implode(",",$post['jp_clia']);
		$jp_elisa=implode(",",$post['jp_elisa']);
		$jp_nat=implode(",",$post['jp_nat']);
	
		$datas = array(
			    'nama_utd' =>$post['nama_utd'],
				'nama_instansi' =>$post['nama_instansi'],
				'status_kepemilikan' =>$post['status_kepemilikan'],
				'surat_izin_operasional_utd' =>$surat_izin_operasional_utd,
				/* 'sk_pembentukan' =>$surat_sk_pembentukan, */
				'surat_permohonan_registrasi' =>$surat_permohonan_registrasi,
				'nama_rs' =>$post['nama_rs'],		
				'jenis_utd' =>$post['jenis_utd'],
				'kode_rs' =>$post['kode_rs'],
				'nama_kepala_utd' =>$post['nama_kepala_utd'],
				'alamat_faskes' =>$post['alamat_faskes'],
				'id_prov' =>$post['id_prov'],
				'id_kota' =>$post['id_kota'],
				'id_camat' =>$post['id_camat'],
				'no_telp' =>$post['no_telp'],
				'email' =>$post['email'],
				'id_faskes' =>$post['id_faskes'],
				'latitude' => $post['latitude'],
				'longitude' => $post['longitude'],
				'tanggal_berakhir_surat_izin' => date('Y-m-d',strtotime($post['tanggal_berakhir_surat_izin'])),
				'akreditasi_utd' => $post['akreditasi_utd'],
				'upload_sertifikat_akreditasi'=>$upload_sertifikat_akreditasi,
				'tanggal_berakhir_akreditasi' => date('Y-m-d',strtotime($post['tanggal_berakhir_akreditasi'])),
				'cpob' => $post['cpob'],
				'upload_sertifikat_cpob'=>$upload_sertifikat_cpob,

				//baru
				 'jenis_pemeriksaan'=>$jenis_pemeriksaan,
				 'jp_rapid_test'=>$jp_rapid_test,
				 'jp_clia'=>$jp_clia,
				 'jp_elisa'=>$jp_elisa,
				 'jp_nat'=>$jp_nat,

				'tanggal_berakhir_cpob' => date('Y-m-d',strtotime($post['tanggal_berakhir_cpob']))
				);
				
					
		


		
			
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->registrasiusermodel->edit_data('data_utd',$where,$datas);
			$this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat' =>$post['id_camat']));

			$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Mengedit Data UTD'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			}else{
				
			$this->registrasiusermodel->input_data('data_utd',$datas);
			$id = $this->db->insert_id();
			$this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat' =>$post['id_camat']));
			$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data UTD'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			}
				
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('utd/inputan_data_faskes_utd');
		}
			
			$this->template->utama('utd/index',$data);  
	}
	
	public function dropdownRSKelas($jenis=null,$filters='') {

		//if ($this->input->is_ajax_request()) {
			//$this->load->model('helpdesksubprojectmodel');
			if($jenis=='1'){
			$filters .= "1=1 ";
			$order = " id ASC";
			}else{
			$filters .= "id NOT IN('4','5') ";
			$order = " id ASC";
			}
			$rsData = $this->registrasiusermodel->get_jenis_rs_kelas($filters, $order);//exit(show_last_query());
			echo json_encode($rsData);
		//}
		return;
	}
	
	
	public function inputan_data_sarpras_alkes_utd()
	{
	
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdatasarprasalkesutd($this->session->userdata('user_id'));	
		$data['user']= $this->registrasiusermodel->getdatautd($this->session->userdata('user_id'));
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_utd_sarpras_alkes',$where2);

			foreach($post['id_sarpras_alkes'] as $ids){

				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'id_sarpras_alkes' => $ids,
				'isian' => ($post['isian'][$ids]=='on' ? 'Ada' : 'Tidak Ada')
				);
				
		
			$this->registrasiusermodel->input_data('trans_utd_sarpras_alkes',$datas_detail);
//echo $this->db->last_query();
//exit();
			}
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Sarpras Alkes UTD'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('utd/inputan_data_sarpras_alkes_utd/');
		}
			
			$this->template->utama('utd/index_sarpras_alkes_utd',$data);  
	}
	
	
	public function inputan_data_alkes_utd()
	{
	
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdataalkesutd($this->session->userdata('user_id'));	
		$data['user']= $this->registrasiusermodel->getdatautd($this->session->userdata('user_id'));
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_utd_alkes',$where2);

			foreach($post['id_alkes'] as $ids){

				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'id_alkes' => $ids,
				'isian' => ($post['isian'][$ids]=='on' ? 'Ada' : 'Tidak Ada')
				);
				
		
			$this->registrasiusermodel->input_data('trans_utd_alkes',$datas_detail);
//echo $this->db->last_query();
//exit();
			}
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Alkes UTD'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('utd/inputan_data_alkes_utd/');
		}
			
			$this->template->utama('utd/index_alkes_utd',$data);  
	}
	
	public function inputan_data_sdm_utd()
	{
	
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['user']= $this->registrasiusermodel->getdatautd($this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->getdatasdmutd($this->session->userdata('user_id'));	
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_sdm_utd',$where2);

			foreach($post['id_sdm'] as $ids){

				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'id_sdm' => $ids,
				'jumlah' => $post['jumlah'][$ids]
				);
				
		
			$this->registrasiusermodel->input_data('trans_sdm_utd',$datas_detail);
			}
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data SDM'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('utd/inputan_data_sdm_utd/');
		}
			
			$this->template->utama('utd/index_data_sdm_utd',$data);  
	}
	
	
	public function inputan_data_tt_rs()
	{
	
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['user']= $this->registrasiusermodel->getdatars($this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->getdatattrs($this->session->userdata('user_id'));	
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_tt_rs',$where2);

			foreach($post['id_tt'] as $ids){

				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'id_tt' => $ids,
				'jumlah' => $post['jumlah'][$ids]
				);
				
		
			$this->registrasiusermodel->input_data('trans_tt_rs',$datas_detail);
			}
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Tempat Tidur'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('rs/inputan_data_tt_rs/');
		}
			
			$this->template->utama('rs/index_data_tt_rs',$data);  
	}
	
	
	public function inputan_data_pelayanan_rs()
	{
	
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['user']= $this->registrasiusermodel->getdatars($this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->getdatapelayananrs($this->session->userdata('user_id'));	
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_pelayanan_rs',$where2);

			foreach($post['id_pelayanan'] as $ids){

				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'id_pelayanan' => $ids,
				'ada' => (isset($post['ada'][$ids]) ? 1 : 0)
				);
				
		
			$this->registrasiusermodel->input_data('trans_pelayanan_rs',$datas_detail);
			}
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Pelayanan'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('rs/inputan_data_pelayanan_rs/');
		}
			
			$this->template->utama('rs/index_data_pelayanan_rs',$data);  
	}
	
	
	public function inputan_jenis_pemeriksaan_labkes($id=NULL)
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['user']= $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->getdatajenispemeriksaanlabkes($this->session->userdata('user_id'));	
	
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$type1 = explode('.', $_FILES["upload_dokumen_sip"]["name"]); // data file
			$type1 = strtolower($type1[count($type1)-1]); // data type like .jpg//exit(dump($type));
			$filename1="upload_dokumen_sip".uniqid(rand()).'.'.$type1;	
			$inputFileName1 = "./assets/uploads/berkas_operasional/".$filename1; // hash unik
			//$surat_permohonan_kode_lab_medis=$post['old_surat_permohonan_kode_lab_medis'];

			if(!empty($_FILES["upload_dokumen_sip"]["name"])){
			if(in_array($type1, array("pdf"))) {
				if(is_uploaded_file($_FILES["upload_dokumen_sip"]["tmp_name"])) {

					if(move_uploaded_file($_FILES["upload_dokumen_sip"]["tmp_name"],$inputFileName1)) {
						$upload_dokumen_sip=$filename1;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('labkes/inputan_jenis_pemeriksaan_labkes');
				
			}
			}
			
			$type2 = explode('.', $_FILES["upload_dokumen_str"]["name"]); // data file
			$type2 = strtolower($type2[count($type2)-1]); // data type like .jpg//exit(dump($type));
			$filename2="upload_dokumen_str".uniqid(rand()).'.'.$type2;	
			$inputFileName2 = "./assets/uploads/berkas_operasional/".$filename2; // hash unik
			//$surat_permohonan_kode_lab_medis=$post['old_surat_permohonan_kode_lab_medis'];

			if(!empty($_FILES["upload_dokumen_str"]["name"])){
			if(in_array($type2, array("pdf"))) {
				if(is_uploaded_file($_FILES["upload_dokumen_str"]["tmp_name"])) {

					if(move_uploaded_file($_FILES["upload_dokumen_str"]["tmp_name"],$inputFileName2)) {
						$upload_dokumen_str=$filename2;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('labkes/inputan_jenis_pemeriksaan_labkes');
				
			}
			}
			
			
			$type3 = explode('.', $_FILES["upload_dokumen_penddikan_dan_pelatihan"]["name"]); // data file
			$type3 = strtolower($type3[count($type3)-1]); // data type like .jpg//exit(dump($type));
			$filename3="upload_dokumen_penddikan_dan_pelatihan".uniqid(rand()).'.'.$type3;	
			$inputFileName3 = "./assets/uploads/berkas_operasional/".$filename3; // hash unik
			//$surat_permohonan_kode_lab_medis=$post['old_surat_permohonan_kode_lab_medis'];

			if(!empty($_FILES["upload_dokumen_penddikan_dan_pelatihan"]["name"])){
			if(in_array($type3, array("pdf"))) {
				if(is_uploaded_file($_FILES["upload_dokumen_penddikan_dan_pelatihan"]["tmp_name"])) {

					if(move_uploaded_file($_FILES["upload_dokumen_penddikan_dan_pelatihan"]["tmp_name"],$inputFileName3)) {
						$upload_dokumen_penddikan_dan_pelatihan=$filename3;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('labkes/inputan_jenis_pemeriksaan_labkes');
				
			}
			}
				
			

         $pemeriksaan_tambahan=implode(",",$post['pemeriksaan_tambahan']);
		 $jenis_pemeriksaan=implode(",",$post['jenis_pemeriksaan']);
				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'type' => $post['type'],
				'nik' => $post['nik'],
				'nama' => $post['nama'],
				'fungsional' => $post['fungsional'],
				'fungsional_lainnya' => $post['fungsional_lainnya'],
				'sip' => $post['sip'],
				'sip_ke' => $post['sip_ke'],
				'upload_dokumen_sip' => $upload_dokumen_sip,
				'tanggal_berakhir_sip' => date('Y-m-d',strtotime($post['tanggal_berakhir_sip'])),
				'str' => $post['str'],
				'upload_dokumen_str' => $upload_dokumen_str,
				'tanggal_berakhir_str' => date('Y-m-d',strtotime($post['tanggal_berakhir_str'])),
				'penddikan_dan_pelatihan' => $post['penddikan_dan_pelatihan'],
				'upload_dokumen_penddikan_dan_pelatihan' => $upload_dokumen_penddikan_dan_pelatihan,
				'tanggal_pendidikan_dan_pelatihan' => date('Y-m-d',strtotime($post['tanggal_pendidikan_dan_pelatihan'])),
				'jenis_pemeriksaan' => $jenis_pemeriksaan,
				'pemeriksaan_tambahan' => $pemeriksaan_tambahan,
				'pemeriksaan_tambahan_lainnya' => $post['pemeriksaan_tambahan_lainnya']
				);
				
		
			$this->registrasiusermodel->input_data('trans_labkes_jenis_pemeriksaan',$datas_detail);
			
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Jenis Pemeriksaan'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('labkes/inputan_jenis_pemeriksaan_labkes/');
		}
			
		if(isset($id)){
			$where2 = array(
						'id' => $id
						);
			$this->registrasiusermodel->delete_data('trans_labkes_jenis_pemeriksaan',$where2);
			 $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Berhasil Hapus Data!');
			redirect('labkes/inputan_jenis_pemeriksaan_labkes/');
		}
			$this->template->utama('datalabkes/index_jenis_pemeriksaan_labkes',$data);  
	}
	
	
		public function selesaikan_utd()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();	
		$data['user_id']= $this->session->userdata('user_id');
		///$data['getdataklinik']= $this->registrasiusermodel->getdataklinik($this->session->userdata('user_id'));
		$data['getdatautd']= $this->registrasiusermodel->getdatautd($this->session->userdata('user_id'));
		$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
		$post = $this->input->post();
		
			if(isset($post['submit'])){
			
				$validasi['utd']= $this->registrasiusermodel->select_count('data_utd',$post["id_faskes"]);
	
				if($validasi['utd'][0]['jml']==0){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Data Dasar Belum DI Isi');
			      redirect('utd/selesaikan_utd/');
				}
	
		
				
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_final',$where2);
			
			if($post["jenis_utd"]=='UTD Kelas Utama'){
				$nama_field='status_validasi_prov';
			}else if($post["jenis_utd"]=='UTD Kelas Madya'){
				$nama_field='status_validasi_kota';
			}else if($post["jenis_utd"]=='UTD Kelas Pratama'){
				$nama_field='status_validasi_kota';
			}

				$datas_detail = array(
				'id_faskes'=>$post["id_faskes"],
			    'final' =>1,
				'id_link'=>$post["id_kota"],
				'kode_faskes_lama'=>$post["kode_faskes_lama"],
				'kode_regional_link'=>$post["kode_regional"],
				''.$nama_field.''=>'Belum Validasi'
				);
				
		
			$this->registrasiusermodel->input_data('trans_final',$datas_detail);
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyelesaikan Data registrasi dan sudah diteruskan ke dinkes kota/provinsi terkait'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);

		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!, Data Akan DI Verifikasi, Pemberitahuan Akan Dikirimkan Ke Email!');
			redirect('utd/selesaikan_utd/');
		}
			
			$this->template->utama('utd/selesaikan_utd',$data);  
	}
	
	
	function validasi_link_kode_faskes($token,$id_link,$id,$kode_regional_link){



	$where = array(
			'token_kode_faskes' => $token,
			'validate_token' =>0 
			);
		$cek = $this->loginmodel->cek_login("trans_final",$where)->num_rows();

		if($cek > 0){
		//$show_user = $this->loginmodel->cek_login("registrasi_user",$where)->result_array();
		
			$where_edit = array(
				'token_kode_faskes' => $token,
				'id_faskes' => $id
				);
				$datas = array(  
				  'validate_token' => 1,
				  'kode_faskes' =>$this->registrasiusermodel->findNoFaskesBaru($id_link,'6'),
				  'kode_faskes_baru' =>$this->registrasiusermodel->findNoFaskesBaru($id_link,'6'),
				  'create_kode'=>date('Y-m-d H:i:s')
				  );
			$this->registrasiusermodel->edit_data('trans_final',$where_edit,$datas);
				
			
		$data['data']= $this->registrasiusermodel->getbylistpendaftaran($id);  
		$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
		$data['trans_final']= $this->registrasiusermodel->select_data('trans_final',$wheregetkodefaskes)->result_array();
		$email  = $data['data'][0]['email']; 
		$title   = "Registrasi Fasyankes"; 
		$message = "Yth,<br><br>
		".$data['data'][0]['nama_lengkap'].",
		<br><br>
		Selamat datang di Aplikasi Registrasi Fasyankes Online.<br>
		Kode Fasyankes Anda : ".$data['trans_final'][0]['kode_faskes_baru']."
		<br><br>
		Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
		registrasi.fasyankes2@gmail.com<br>
		<br><br>
		Salam<br>
		Sekretariat Direktorat Jenderal Pelayanan Kesehatan"; 

		//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		$mail = $this->send_email("infoyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","n3nceY@D",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		
		$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'],$data['data'][0]['nama_utd'],'utd',$data['data'][0]['id_kota'],$data['trans_final'][0]['kode_faskes_lama'],$data['data'][0]['jenis_klinik_data_klinik'],'','',$data['trans_final'][0]['kode_faskes_baru']);

		if($mail){
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Kode Fasyankes Sudah Aktif');
			redirect(base_url("utd/verifikasikan_kirim_utd/".$id.""));
		} 
	
			
 
		}else{
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Link Aktifasi Tidak Valid Atau Sudah Dipakai!');
			redirect(base_url("adminutd/index"));
		}
	}
	
	
		function send_email($emaildari,$namadari,$password,$subjek,$emailtujuan,$namatujuan,$pesan)
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
	$mail->Port       = "465";                    // masukkan port yang digunakan oleh SMTP Gmail
	$mail->Username   = $emaildari;  // GMAIL username
	$mail->Password   = $password;            // GMAIL password
	$mail->SetFrom($emaildari, $namadari); // masukkan alamat pengririm dan nama pengirim jika alamat email tidak sama, maka yang digunakan alamat email untuk username
	$mail->Subject    =$subjek;//masukkan subject
	$mail->MsgHTML($pesan);//masukkan isi dari email
	$mail->IsHTML(true); 

	//$mail->AddAttachment('../folder_file/'.$attach, $name = $attach,  $encoding = 'base64', $type = 'application/pdf');
	$mail->AddAddress($emailtujuan,$namatujuan); //masukkan penerima

	if(!$mail->Send()) {
	  return "201"; // jika pesan tidak terkirim
	} else {
	  return "200"; //jika pesan terkirim
	}
	 return $status;
 }
 
 
 	function service_kirim_kode($kode,$nama,$jenis,$kota,$kode_lama,$jenis_klinik,$jenis_tpmd,$jenis_perawatan,$kodesatkerbaru){
					$xid='mutukemenkes';
					$time=time();
					date_default_timezone_set('UTC');
				    $data_send='{"kodesatker":"'.$kode.'","namasatker":"'.$nama.'","jenis_satker":"'.$jenis.'","kodekota":"'.$kota.'","kodelama":"'.$kode_lama.'","jenis":"'.strtolower($jenis_klinik).'","jenis_tpmd":"'.$jenis_tpmd.'","jenisklinik":"'.$jenis_perawatan.'","kodesatkerbaru":"'.$kodesatkerbaru.'"}';
					$url = "https://mutufasyankes.kemkes.go.id/api/insert_satker";
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
		
	}

	function tes(){
		$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://sirs.kemkes.go.id/fo/apiregfaskes/kode_rs/',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Cookie: TS011d1ba9=0172bf5c62cf8d6f127c6426b2001a63ee15745104aac9236ea509646c2c1d7c5de749bf198f76c3df00b49aca2a9ebe1b76980932; TS011d1ba9028=015463a1a85ffc5036d47b7e1e879d33e0b963929d6e0b4f354b90d4129c28bbc9fe51c650faa29e8b4a46e563beb0ab291885af90; ci_session=441ce32f1e6f283771a995bc7dc8115e0dac2e1d'
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			$select = json_decode($response, true);
			var_dump($select);
	}
	
	
	
	
	
	
	
	

}