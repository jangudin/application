<?php
class Rs extends CI_Controller{
 
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
		$this->load->model('loginmodel');	
		$this->load->library('encrypt.php'); 
		define('MB', 1048576);		
	}
		
	function list_user_yang_mengajukan_kemkes($id=0){
	
			$data['data']['query'] = $this->rsmodel->getlistpengajuanrs($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
		
			$this->template->utama('adminrs/list_user_yang_mengajukan_kemkes',$data);  
	}
	
	function list_user_yang_mengajukan_kemkes_belum_validasi($id=0){
			$data['data']['query'] = $this->rsmodel->getlistpengajuanbelumvalidasirs($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('adminrs/list_user_yang_mengajukan_kemkes_belum_validasi',$data);  
	}
	
	function list_user_yang_mengajukan_kemkes_perbaikan($id=0){
			$data['data']['query'] = $this->rsmodel->getlistpengajuanbelumvalidasiperbaikanrs($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('adminrs/list_user_yang_mengajukan_kemkes_perbaikan',$data);  
	}
	
	function list_user_yang_mengajukan_prov($id=0){
			$data['data']['query'] = $this->rsmodel->getlistpengajuanrs($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));	
			$this->template->utama('adminrs/list_user_yang_mengajukan_prov',$data);  
	}
	
	function list_user_yang_mengajukan_prov_belum_validasi($id=0){
			$data['data']['query'] = $this->rsmodel->getlistpengajuanbelumvalidasirs($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('adminrs/list_user_yang_mengajukan_prov_belum_validasi',$data);  
	}
	
	function list_user_yang_mengajukan_prov_perbaikan($id=0){
			$data['data']['query'] = $this->rsmodel->getlistpengajuanbelumvalidasiperbaikanrs($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('adminrs/list_user_yang_mengajukan_prov_perbaikan',$data);  
	}
	
	function list_user_yang_mengajukan_kota($id=0){
			$data['data']['query'] = $this->rsmodel->getlistpengajuanrs($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));	
			$this->template->utama('adminrs/list_user_yang_mengajukan_kota',$data);  
	}
	
	function list_user_yang_mengajukan_kota_belum_validasi($id=0){
			$data['data']['query'] = $this->rsmodel->getlistpengajuanbelumvalidasirs($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('adminrs/list_user_yang_mengajukan_kota_belum_validasi',$data);  
	}
	
	function list_user_yang_mengajukan_kota_perbaikan($id=0){
			$data['data']['query'] = $this->rsmodel->getlistpengajuanbelumvalidasiperbaikanrs($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('adminrs/list_user_yang_mengajukan_kota_perbaikan',$data);  
	}
	
	function list_user_yang_mengajukan_labkes_pratama_belum_validasi($id=0){
			$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasilabkes($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'),'Pratama');
			$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes_pratama_belum_validasi',$data);  
	}
	
	function list_user_yang_mengajukan_labkes_pratama_perbaikan($id=0){
			$data['data']['query'] = $this->labkesmodel->getlistpengajuanbelumvalidasiperbaikanlabkes($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'),'Pratama');
			$this->template->utama('adminlabkes/list_user_yang_mengajukan_labkes_pratama_perbaikan',$data);  
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
	
	
	function verifikasi_pengajuan_faskes_rs($idx=NULL){
	$id=$this->encrypt->decode($idx);
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
			$data['data']= $this->registrasiusermodel->getdatars($id);

			$data['user_id']=$id;
	
			$this->template->utama('adminrs/verifikasi_pengajuan_faskes_rs',$data);  
	}
	function verifikasi_pengajuan_faskes_tt_rs($idx=NULL){

	$id=$this->encrypt->decode($idx);

		$where = array('id_faskes' => $id);
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdatattrs($id);	
		$data['user']= $this->registrasiusermodel->getdatars($id);
		$data['user_id']= $id;
		$post = $this->input->post();
			

	
			$this->template->utama('adminrs/verifikasi_pengajuan_faskes_tt_rs',$data);  
	}
	
	function verifikasi_pengajuan_faskes_sdm_rs($idx=NULL){
	$id=$this->encrypt->decode($idx);
		    $post = $this->input->post();

			//$data['user']= $this->registrasiusermodel->getdatauser($id);	
			$data['user']= $this->registrasiusermodel->getdatars($id);
			$data['data']= $this->registrasiusermodel->getdatasdmrs($id);	
		    $data['user_id']= $id;
	
			$this->template->utama('adminrs/verifikasi_pengajuan_faskes_sdm_rs',$data);  
	}
	
	
	function verifikasi_pengajuan_pelayanan_rs($idx=NULL){
	$id=$this->encrypt->decode($idx);
		    $post = $this->input->post();

			//$data['user']= $this->registrasiusermodel->getdatauser($id);	
			$data['user']= $this->registrasiusermodel->getdatars($id);
			$data['data']= $this->registrasiusermodel->getdatapelayananrs($id);	
		    $data['user_id']= $id;
	
			$this->template->utama('adminrs/verifikasi_pengajuan_pelayanan_rs',$data);  
	}
	
	
	function verifikasikan_kirim_rs($idx=NULL){
$id=$this->encrypt->decode($idx);
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
					
					$where3 = array('id_faskes' => $post["id_faskes"]);
					$data['data3']= $this->registrasiusermodel->select_data('data_rs',$where)->result_array();
				    $this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"],$data['data3'][0]["kelas"]);
				
				
					$this->registrasiusermodel->input_data('timeline',$datas_log);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Pemberitahuan Akan Di Kirimkan Melalui Aplikasi Registrasi Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi');
					redirect('rs/verifikasikan_kirim_rs/'.$id);
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
					
					$where3 = array('id_faskes' => $post["id_faskes"]);
					$data['data3']= $this->registrasiusermodel->select_data('data_rs',$where)->result_array();
					
					$this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"],$data['data3'][0]["kelas"]);
				
					$this->registrasiusermodel->input_data('timeline',$datas_log);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Pemberitahuan Akan Di Kirimkan Melalui Aplikasi Registrasi Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi');
					redirect('labkes/verifikasikan_kirim_labkes/'.$id);
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
				   // $this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"]);
				
				$where3 = array('id_faskes' => $post["id_faskes"]);
					$data['data3']= $this->registrasiusermodel->select_data('data_rs',$where)->result_array();
				 $this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"],$data['data3'][0]["kelas"]);
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
					redirect('rs/verifikasikan_kirim_rs/'.$id);
					 
				 }

					$datas_detail = array('final' =>0,'catatan'=>$post["catatan"],'token_kode_faskes'=>'','id_validate_kota' =>'','status_validasi_kota'=>'Perbaikan');

						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Minta Diperbaiki Oleh Dinkes Kab/Kota Ke User RS ('.$post["catatan"].')'
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
		infoyankes@kemkes.go.id<br>
		<br><br>
		Salam<br>
		Sekretariat Direktorat Jenderal Pelayanan Kesehatan"; 

		//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		$mail = $this->send_email("infoyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","n3nceY@D",$title,$email,$data['data'][0]['nama_lengkap'],$message);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
					redirect('labkes/verifikasikan_kirim_labkes/'.$id);
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
					redirect('rs/verifikasikan_kirim_rs/'.$id);
					 
				 }

			
							$datas_detail = array('final' =>0,'catatan'=>$post["catatan"],'token_kode_faskes'=>'','id_validate_kota' =>'','status_validasi_prov'=>'Perbaikan');
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Minta Diperbaiki Oleh Dinkes Provinsi Ke Dinkes Kota('.$post["catatan"].')'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			
			
					


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
					redirect('rs/verifikasikan_kirim_rs/'.$id);
				}
				
				if(isset($post['submit_perbaikan_kemkes'])){
						
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
					redirect('rs/verifikasikan_kirim_rs/'.$id);
					 
				 }


						
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
			
			
		    $data['user_id']= $id;
	
			$this->template->utama('adminrs/verifikasikan_kirim_rs',$data);  
	}
	
	
	public function inputan_data_faskes_rs()
	{
			$where = array('id_faskes' => $this->session->userdata('user_id'));
			$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
			$data['data']= $this->registrasiusermodel->getdatars($this->session->userdata('user_id'));
			$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
	
			$post = $this->input->post();
		
	
		if(isset($post['submit'])){
			
		$type1 = explode('.', $_FILES["dokumen_surat_izin_usaha"]["name"]); // data file
		$type1 = strtolower($type1[count($type1)-1]); // data type like .jpg//exit(dump($type));
		$filename1="dokumen_surat_izin_usaha".uniqid(rand()).'.'.$type1;	
		$inputFileName1 = "./assets/uploads/berkas_operasional/".$filename1; // hash unik
		$surat_dokumen_surat_izin_usaha=$post['old_dokumen_surat_izin_usaha'];
		
		$type2 = explode('.', $_FILES["dokumen_surat_permohonan_registrasi_rs"]["name"]); // data file
		$type2 = strtolower($type2[count($type2)-1]); // data type like .jpg//exit(dump($type));
		$filename2="dokumen_surat_permohonan_registrasi_rs".uniqid(rand()).'.'.$type2;	
		$inputFileName2 = "./assets/uploads/berkas_operasional/".$filename2; // hash unik
		$surat_dokumen_surat_permohonan_registrasi_rs=$post['old_dokumen_surat_permohonan_registrasi_rs'];
		
		$type3 = explode('.', $_FILES["sertifikat_izin"]["name"]); // data file
		$type3 = strtolower($type3[count($type3)-1]); // data type like .jpg//exit(dump($type));
		$filename3="sertifikat_izin".uniqid(rand()).'.'.$type3;	
		$inputFileName3 = "./assets/uploads/berkas_operasional/".$filename3; // hash unik
		$sertifikat_izin=$post['old_sertifikat_izin'];
		
	   /*if(!empty($_FILES["dokumen_surat_izin_usaha"]["name"])){
			if(in_array($type1, array("pdf"))) {
				
				
				if(is_uploaded_file($_FILES["dokumen_surat_izin_usaha"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["dokumen_surat_izin_usaha"]["tmp_name"],$inputFileName1)) {
						$surat_dokumen_surat_izin_usaha=$filename1;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('rs/inputan_data_faskes_rs');
				
			}
		}
		
		if(!empty($_FILES["dokumen_surat_permohonan_registrasi_rs"]["name"])){
			if(in_array($type2, array("pdf"))) {
				
				
				if(is_uploaded_file($_FILES["dokumen_surat_permohonan_registrasi_rs"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["dokumen_surat_permohonan_registrasi_rs"]["tmp_name"],$inputFileName2)) {
						$surat_dokumen_surat_permohonan_registrasi_rs=$filename2;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('rs/inputan_data_faskes_rs');
				
			}
		}
		
		if(!empty($_FILES["sertifikat_izin"]["name"])){
			if(in_array($type3, array("pdf"))) {
				
				
				if(is_uploaded_file($_FILES["sertifikat_izin"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["sertifikat_izin"]["tmp_name"],$inputFileName3)) {
						$sertifikat_izin=$filename3;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('rs/inputan_data_faskes_rs');
				
			}
		} */
		
	
		$datas = array(
			    'nama_rs' =>$post['nama_rs'],
				'tahun_berdiri' =>$post['tahun_berdiri'],
				'nama_direktur' =>$post['nama_direktur'],
				'jenis_rs' =>$post['jenis_rs'],
				'kelas' =>$post['kelas'],
				'pemilik_modal' =>$post['pemilik_modal'],
				'status_blu' =>$post['status_blu'],		
				'kepemilikan' =>$post['kepemilikan'],
				'nama_penyelenggara' =>$post['nama_penyelenggara'],
				'alamat_faskes' =>$post['alamat_faskes'],
				'alamat_faskes' =>$post['alamat_faskes'],
				'id_prov' =>$post['id_prov'],
				'id_kota' =>$post['id_kota'],
				'id_camat' =>$post['id_camat'],
				'luas_tanah' =>$post['luas_tanah'],
				'luas_bangunan' =>$post['luas_bangunan'],
				'no_telp' =>$post['no_telp'],
				'email' =>$post['email'],
				'website' =>$post['website'],
				'nomor_surat_izin_usaha' =>$post['nomor_surat_izin_usaha'],
				'tanggal_surat_izin_usaha' =>date('Y-m-d',strtotime($post['tanggal_surat_izin_usaha'])),
				'tanggal_berlaku_surat_izin_usaha' =>date('Y-m-d',strtotime($post['tanggal_berlaku_surat_izin_usaha'])),
				'id_faskes' =>$post['id_faskes'],
				//'dokumen_surat_izin_usaha'=>$surat_dokumen_surat_izin_usaha,
				//'dokumen_surat_permohonan_registrasi_rs'=>$surat_dokumen_surat_permohonan_registrasi_rs,
                //'sertifikat_izin'=>$sertifikat_izin,
                'dokumen_surat_izin_usaha'=>$post['dokumen_surat_izin_usaha'],
                'dokumen_surat_permohonan_registrasi_rs'=>$post['dokumen_surat_permohonan_registrasi_rs'],
				'sertifikat_izin'=>$post['sertifikat_izin'],
				'simrs' =>$post['simrs'],
				'latitude' => $post['latitude'],
				'longitude' => $post['longitude']
				);
				
					
		


		
			
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->registrasiusermodel->edit_data('data_rs',$where,$datas);
			$this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat' =>$post['id_camat']));
			/* if($post['jenis_perawatan_old'] != $post['jenis_perawatan']){
					$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_labkes_sarpras_alkes',$where2);
				
			} */
			
			/* if($post['jenis_klinik_old'] != $post['jenis_klinik']){
				$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_labkes_sdm',$where2);
			} */
			
			$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Mengedit Data Rs'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			}else{
				
			$this->registrasiusermodel->input_data('data_rs',$datas);
			$id = $this->db->insert_id();
			$this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat' =>$post['id_camat']));
			$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Rs'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			}
				
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('rs/inputan_data_faskes_rs');
		}
			
			$this->template->utama('rs/index',$data);  
	}
	
	public function dropdownRSKelas($jenis=null,$filters='') {

		//if ($this->input->is_ajax_request()) {
			//$this->load->model('helpdesksubprojectmodel');
			if($jenis=='1'){
			$filters .= "1=1 AND id NOT IN('6') ";
			$order = " id ASC";
			}else if($jenis=='20'){
			$filters .= "1=1 AND id IN('6') ";
			$order = " id ASC";
			}else{
			$filters .= "id NOT IN('4','5','6') ";
			$order = " id ASC";
			}
			$rsData = $this->registrasiusermodel->get_jenis_rs_kelas($filters, $order);//exit(show_last_query());
			echo json_encode($rsData);
		//}
		return;
	}
	
	
	public function inputan_data_sarpras_alkes_labkes()
	{
	
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdatasarprasalkeslabkes($this->session->userdata('user_id'));	
		$data['user']= $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_labkes_sarpras_alkes',$where2);

			foreach($post['id_sarpras_alkes'] as $ids){

				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'id_sarpras_alkes' => $ids,
				'isian' => $post['isian'][$ids],
				'keterangan' => $post['keterangan'][$ids]
				);
				
		
			$this->registrasiusermodel->input_data('trans_labkes_sarpras_alkes',$datas_detail);
//echo $this->db->last_query();
//exit();
			}
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Sarpras Alkes Labkes'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('labkes/inputan_data_sarpras_alkes_labkes/');
		}
			
			$this->template->utama('datalabkes/index_sarpras_alkes_labkes',$data);  
	}
	
	public function inputan_data_sdm_rs()
	{
	
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['user']= $this->registrasiusermodel->getdatars($this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->getdatasdmrs($this->session->userdata('user_id'));	
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_sdm_rs',$where2);

			foreach($post['id_sdm'] as $ids){

				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'id_sdm' => $ids,
				'jumlah' => $post['jumlah'][$ids]
				);
				
		
			$this->registrasiusermodel->input_data('trans_sdm_rs',$datas_detail);
			}
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data SDM'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('rs/inputan_data_sdm_rs/');
		}
			
			$this->template->utama('rs/index_data_sdm_rs',$data);  
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
	
	
		public function selesaikan_rs()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();	
		$data['user_id']= $this->session->userdata('user_id');
		///$data['getdataklinik']= $this->registrasiusermodel->getdataklinik($this->session->userdata('user_id'));
		$data['getdatars']= $this->registrasiusermodel->getdatars($this->session->userdata('user_id'));
		$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
		$post = $this->input->post();
		
			if(isset($post['submit'])){
			
				$validasi['rs']= $this->registrasiusermodel->select_count('data_rs',$post["id_faskes"]);
	
				if($validasi['rs'][0]['jml']==0){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Data Dasar Belum DI Isi');
			      redirect('rs/selesaikan_rs/');
				}
				
				if(empty($data['getdatars'][0]['sertifikat_izin'])){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Sertifikat Izin RS Belum Di Upload!');
			      redirect('rs/selesaikan_rs/');
				}
				
				if(empty($data['getdatars'][0]['dokumen_surat_permohonan_registrasi_rs'])){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Surat Permohonan Registrasi RS Belum Di Upload!');
			      redirect('rs/selesaikan_rs/');
				}
				
		
				
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_final',$where2);
			
			if($post["pemilik_modal"]=='2'){
				$nama_field='status_validasi_kemkes';
			}else if($post["pemilik_modal"]=='1' && $post["kelas"]=='1'){
				$nama_field='status_validasi_kemkes';
			}else if($post["pemilik_modal"]=='1' && $post["kelas"]=='2'){
				$nama_field='status_validasi_prov';
			}else if($post["pemilik_modal"]=='1' && $post["kelas"]=='3'){
				$nama_field='status_validasi_kota';
			}else if($post["pemilik_modal"]=='1' && $post["kelas"]=='4'){
				$nama_field='status_validasi_kota';
			}else if($post["pemilik_modal"]=='1' && $post["kelas"]=='5'){
				$nama_field='status_validasi_kota';
			}else if($post["pemilik_modal"]=='1' && $post["kelas"]=='6'){
				$nama_field='status_validasi_kota';
			}

				$datas_detail = array(
				'id_faskes'=>$post["id_faskes"],
			    'final' =>1,
				'id_link'=>$post["id_kota"],
				'kode_faskes_lama'=>$post["kode_faskes_lama"],
				'kode_regional_link'=>'',
				''.$nama_field.''=>'Belum Validasi'
				);
				
		
			$this->registrasiusermodel->input_data('trans_final',$datas_detail);
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyelesaikan Data registrasi dan sudah diteruskan ke dinkes kota/provinsi/kemkes terkait'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);

		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!, Data Akan DI Verifikasi, Pemberitahuan Akan Dikirimkan Ke Email!');
			redirect('rs/selesaikan_rs/');
		}
			
			$this->template->utama('rs/selesaikan_rs',$data);  
	}
	
	
	function validasi_link_kode_faskes($token,$id_link,$id,$kode_regional_link,$kelas){

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
				  'kode_faskes' =>$this->registrasiusermodel->findNoFaskesRS($id_link,'4',$kelas),
				  'create_kode'=>date('Y-m-d H:i:s')
				  );
			$this->registrasiusermodel->edit_data('trans_final',$where_edit,$datas);
				
			
		$data['data']= $this->registrasiusermodel->getbylistpendaftaran($id);  
		$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
		$data['trans_final']= $this->registrasiusermodel->select_data('trans_final',$wheregetkodefaskes)->result_array();
		$wheregetkodelink = array('link_pusdatin' => $data['trans_final'][0]['id_link']);
		$data['kab_kota_new']= $this->registrasiusermodel->select_data('kab_kota_new',$wheregetkodelink)->result_array();
		$email  = $data['data'][0]['email']; 
		$title   = "Registrasi Fasyankes"; 
		$message = "Yth,<br><br>
		".$data['data'][0]['nama_lengkap'].",
		<br><br>
		Selamat datang di Aplikasi Registrasi Fasyankes Online.<br>
		Kode Fasyankes Anda : ".$data['trans_final'][0]['kode_faskes']."
		<br><br>
		Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
		infoyankes@kemkes.go.id<br>
		<br><br>
		Salam<br>
		Sekretariat Direktorat Jenderal Pelayanan Kesehatan"; 

		//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		$mail = $this->send_email("infoyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","n3nceY@D",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		
		$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'],$data['data'][0]['nama_rs'],'rs',$data['data'][0]['id_kota'],$data['trans_final'][0]['kode_faskes_lama'],$data['data'][0]['jenis_rs'],'','','');
		
		$this->service_kirim_kode_rs($data['trans_final'][0]['kode_faskes'],$data['data'][0]['nama_rs'],$data['data'][0]['kelas'],$data['data'][0]['nama_kota'],$data['trans_final'][0]['kode_faskes_lama'],$data['data'][0]['jenis_rs'],$data['data'][0]['nama_prop'],$data['trans_final'][0]['create_trans'],$data['data'][0]['nama_direktur'],$data['data'][0]['alamat_rs'],$data['data'][0]['no_telp_rs'],$data['data'][0]['email_rs'],$data['data'][0]['website_rs'],$data['data'][0]['luas_tanah_rs'],$data['data'][0]['luas_bangunan_rs'],$data['data'][0]['nomor_surat_izin_usaha_rs'],$data['data'][0]['tanggal_surat_izin_usaha_rs'],$data['data'][0]['tanggal_berlaku_surat_izin_usaha'],$data['data'][0]['tahun_berdiri_rs'],$data['data'][0]['status_blu_rs'],$data['data'][0]['simrs'],$data['trans_final'][0]['link'],$data['data'][0]['nama_penyelenggara'],$data['data'][0]['nama_kepemilikan'],$data['kab_kota_new'][0]['propinsi_kode'],$data['kab_kota_new'][0]['link'],$data['data'][0]['kepemilikan']);

		if($mail){
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Kode Fasyankes Sudah Aktif');
			redirect(base_url("rs/verifikasikan_kirim_rs/".$id.""));
		} 
	
			
 
		}else{
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Link Aktifasi Tidak Valid Atau Sudah Dipakai!');
			redirect(base_url("adminrs/index"));
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
	$mail->Port       = "465";                   // masukkan port yang digunakan oleh SMTP Gmail
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
 
 
 function service_kirim_kode($kode,$nama,$jenis,$kota,$kode_lama,$jenis_klinik,$jenis_tpmd,$jenis_perawatan){
					$xid='mutukemenkes';
					$time=time();
					date_default_timezone_set('UTC');
				    $data_send='{"kodesatker":"'.$kode.'","namasatker":"'.$nama.'","jenis_satker":"'.$jenis.'","kodekota":"'.$kota.'","kodelama":"'.$kode_lama.'","jenis":"'.strtolower($jenis_klinik).'","jenis_tpmd":"'.$jenis_tpmd.'","jenisklinik":"'.$jenis_perawatan.'"}';
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
	
 
 
 	function service_kirim_kode_rs($kode,$nama,$kelas,$kota,$kode_lama,$jenis_rs,$prov,$create_trans,$nama_direktur,$alamat_faskes,$no_telp_rs,$email_rs,$website_rs,$luas_tanah_rs,$luas_bangunan_rs,$nomor_surat_izin_usaha_rs,$tanggal_surat_izin_usaha_rs,$tanggal_berlaku_surat_izin_usaha,$tahun_berdiri_rs,$status_blu_rs,$simrs,$link,$nama_penyelenggara,$nama_kepemilikan,$id_prov,$id_kota,$kepemilikan){
					$xid='regfasyankes';
					$time=time();
					$xpass='@R3gf45yanK3s!';
					$xappauth='cfe6fd00816330ad7f18d8e6a12d879693c3ee2321631b7fb17dd914b0625853';
					
					date_default_timezone_set('UTC');
				    $data_send='{
   "Propinsi" : "'.$kode.'",
   "TglReg" : "'.date('Y-m-d',strtotime($create_trans)).'",
   "RUMAH_SAKIT" : "'.$nama.'",
   "JENIS" : "'.$jenis_rs.'",
   "KLS_RS" : "'.$kelas.'",
   "DIREKTUR_RS" : "'.$nama_direktur.'",
   "ALAMAT" : "'.$alamat_faskes.'",
   "STATUS_PENYELENGGARA" : "'.$nama_kepemilikan.'",
   "KAB/KOTA" : "'.$kota.'",
   "KODE" : "-",
   "TELEPON" : "'.$no_telp_rs.'",
   "FAX" : "-",
   "EMAIL" : "'.$email_rs.'",
   "TELEPON_HUMAS" : "'.$no_telp_rs.'",
   "WEBSITE" : "'.$website_rs.'",
   "LUAS_TANAH" : "'.$luas_tanah_rs.'",
   "LUAS_BANGUNAN" : "'.$luas_bangunan_rs.'",
   "NO_SURAT_IJIN" : "'.$nomor_surat_izin_usaha_rs.'",
   "TANGGAL_SURAT_IJIN" : "'.$tanggal_surat_izin_usaha_rs.'",
   "OLEH_SURAT_IJIN" : "-",
   "SIFAT_SURAT_IJIN" : "-",
   "MASA_BERLAKU_SURAT_IJIN" : "'.$tanggal_berlaku_surat_izin_usaha.'",
   "NAMA_PENYELENGGARA" : "'.$nama_penyelenggara.'",
   "PENYELENGGARA" : "'.$kepemilikan.'",
   "SWASTA" : "-",
   "PENTAHAPAN_AKREDITASI" : "-",
   "STATUS_AKREDITASI" : "-",
   "Tglakreditas" : "-",
   "keterangan_akreditasi" : "-",
   "target_akreditasi" : "-",
   "aktive" : "1",
   "profile" : "-",
   "usrpwd2" : "'.$id_prov.'",
   "TANGGAL_UPDATE" : "'.date('Y-m-d').'",
   "today" : "'.date('Y-m-d H:i:s').'",
   "link" : "'.$id_kota.'",
   "ambulan" : "-",
   "simrs" : "'.($simrs=='Punya' ? '1' : '0').'",
   "bank_darah" : "-",
   "layanan_unggulan" : "-",
   "blu" : "'.$status_blu_rs.'",
   "masa_berlaku_surat" : "-",
   "masa_berlaku_akreditasi" : "-",
   "status_kirim_sisrute" : "-",
   "tahun_berdiri" : "'.$tahun_berdiri_rs.'",
   "valid_agustus" : "-",
   "rujukan_pie" : "1"
}';
					$url = "https://sirs.kemkes.go.id/fo/index.php/Fasyankes/reg_rs";
					$process = curl_init($url); 					
					curl_setopt($process, CURLOPT_HTTPHEADER,
					array("Content-Type: application/json\r\n" . "x-rs-id:$xid\r\n" . "x-timestamp:$time\r\n" . "x-pass:$xpass\r\n" . "x-app-auth:$xappauth"));
					curl_setopt($process, CURLOPT_HEADER, false); 
					curl_setopt($process, CURLOPT_TIMEOUT, 30); 
					curl_setopt($process, CURLOPT_POST, true); 
					curl_setopt($process, CURLOPT_POSTFIELDS, $data_send); 
					curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
					$return = curl_exec($process); 
					curl_close($process);	
					$response2 = (object) json_decode($return);		
					$sml = $response2;
	
	}
	
	
	
	
	
	
	
	

}
