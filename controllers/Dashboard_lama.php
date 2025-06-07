<?php
class Dashboard extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	date_default_timezone_set("Asia/Jakarta");
		if($this->session->userdata('status') != "login"){
			redirect(base_url("admin"));
		}

		$this->load->library('pagination');
		$this->load->model('registrasiusermodel');		
		$this->load->model('loginmodel');	
		define('MB', 1048576);		
	}
		
	/* function index(){
		$data['judul'] = "User Profile";

		$this->template->utama('profile/index',$data);
	} */
	
	public function _example_output($output = null,$view=null)
	{

		$data_session = array('judul' => 'Dashboard');
		$this->session->set_userdata($data_session);
		$data = (array)$output;
		$this->template->utama($view,$data);

	}
	
	public function index()
	{
	
			$data['data']= $this->registrasiusermodel->getprofile($this->session->userdata('user_id'));
			$data['getinbox']= $this->registrasiusermodel->getinbox($this->session->userdata('user_id'));
			$this->template->utama('profile/index',$data);  
	}
	
	public function list_contact()
	{
	
			$data['list_contact']= $this->registrasiusermodel->getcontact($this->session->userdata('user_id'),$this->session->userdata('id_kategori'));
	
				$data['getinbox']= $this->registrasiusermodel->getinbox($this->session->userdata('user_id'));
			$this->template->utama('profile/list_contact',$data);  
	}
	
	public function inbox()
	{
		
		$where_edit = array(
				'id_tujuan' => $this->session->userdata('user_id')
				);
				$datas = array(  
				  'dibaca' => 1
				  );
	      $this->registrasiusermodel->edit_data('message',$where_edit,$datas);
	
	      //$data['hitunginbox']= $this->registrasiusermodel->hitunginbox($this->session->userdata('user_id'));
			$data['getinbox']= $this->registrasiusermodel->getinbox($this->session->userdata('user_id'));
			$this->template->utama('profile/inbox',$data);  
	}
	
	public function outbox()
	{
	
			$data['getoutbox']= $this->registrasiusermodel->getoutbox($this->session->userdata('user_id'));
				$data['getinbox']= $this->registrasiusermodel->getinbox($this->session->userdata('user_id'));
			$this->template->utama('profile/outbox',$data);  
	}
	
	
	
	public function kirim_pesan($id=NULL,$id_message=NULL)
	{
	      $post = $this->input->post();
		  if($post['submit']){
		  $where = array('id_faskes' => $post["id_faskes"],'id_faskes' => $post["id_faskes"]);
	
			$datas_log = array(
			    'id_faskes' =>$post["id_faskes"],
				'id_tujuan' =>$post["id_tujuan"],
				'subject' =>$post["subject"],
				'keterangan' =>$post["keterangan"],
				'dibaca' =>0
				);
			$this->registrasiusermodel->input_data('message',$datas_log);
			
			$where_edit = array(
				'id' => $post["id_message"]
				);
				$datas = array(  
				  'dibalas' => 1
				  );
	      $this->registrasiusermodel->edit_data('message',$where_edit,$datas);
			redirect('dashboard/outbox/'.$id,'refresh');
		  }
			$data['kirim_pesan']['data']= $this->registrasiusermodel->get_kirim_pesan($id);
			$data['kirim_pesan']['id_tujuan']=$id;
			$data['kirim_pesan']['id_message']=$id_message;
			$data['kirim_pesan']['id_faskes']=$this->session->userdata('user_id');
			
			$this->template->utama('profile/kirim_pesan',$data);  
	}
	
	
	
	
	
	
	function list_user_yang_mendaftar($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpendaftaran($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('pendaftaran/list_daftar',$data);  
	}
	
	function list_user_yang_mendaftar_labkes($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpendaftaranlabkes($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('pendaftaran/list_daftar',$data);  
	}
	
	function list_user_yang_mendaftar_rs($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpendaftaranrs($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('pendaftaran/list_daftar',$data);  
	}
	
	function list_user_yang_mendaftar_utd($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpendaftaranutd($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('pendaftaran/list_daftar',$data);  
	}

	function list_user_yang_mendaftar_pm($id=0){
		$data['data']['query'] = $this->registrasiusermodel->getlistpendaftaranpm($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
		$this->template->utama('pendaftaran/list_daftar',$data);  
}
	
	
	
	function verifikasi_pendaftaran_faskes($id=NULL){

		    $post = $this->input->post();

	
				$data['data']= $this->registrasiusermodel->getbylistpendaftaran($id);  
	
			$this->template->utama('pendaftaran/verifikasi_pendaftaran_faskes',$data);  
	}
	
	function validate_kirim_email($id=NULL){

		$data['data']= $this->registrasiusermodel->getbylistpendaftaran($id);  
		$email  = $data['data'][0]['email']; 
		$title   = "Registrasi Fasyankes"; 
		$message = "Yth,<br><br>
".$data['data'][0]['nama_lengkap'].",
<br><br>
Selamat datang di Aplikasi Registrasi Fasyankes Online.<br>
Terima kasih telah mengajukan permohonan user penggunaan Aplikasi Registrasi Fasyankes Online.<br>
Untuk mengaktifasi akun Anda,silahkan klik link berikut ini.<br>
<a href='https://registrasifasyankes.kemkes.go.id/admin/validasi_link/".$data['data'][0]['token']."'>Verifikasi Email Klik Disini</a>
<br><br>
Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
registrasi.fasyankes2@gmail.com<br>
<br><br>
Salam<br>
Sekretariat Direktorat Jenderal Pelayanan Kesehatan"; 
		
		//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		$mail = $this->send_email("registrasifasyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","uLH0%RYL",$title,$email,$data['data'][0]['nama_lengkap'],$message);

	 if($mail){
	$where_edit = array(
				'id' => $id
				);
				$datas = array(  
				  'validate' => 2
				  );
	$this->registrasiusermodel->edit_data('registrasi_user',$where_edit,$datas);
		redirect('dashboard/verifikasi_pendaftaran_faskes/'.$id,'refresh');
	} 
	}
	
	
	function validate_kirim_email_kode_faskes($token=NULL,$id=null,$id_link=null){

		$data['data']= $this->registrasiusermodel->getbylistpendaftaran($id);  
		$email  = $data['data'][0]['email']; 
		$title   = "Registrasi Faskes"; 
		$message = "Yth,<br><br>
".$data['data'][0]['nama_lengkap'].",
<br><br>
Selamat datang di Aplikasi Registrasi Faskes Online.<br>
Terima kasih telah mengajukan permohonan user penggunaan Aplikasi Registrasi Faskes Online.<br>
Untuk Mengaktifkan Faskes Anda,silahkan klik link berikut ini.<br>

<br><br>
Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
registrasi.fasyankes2@gmail.com<br>
<br><br>
Salam<br>
Sekretariat Direktorat Jenderal Pelayanan Kesehatan"; 
		
		//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		$mail = $this->send_email("registrasifasyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","uLH0%RYL",$title,$email,$data['data'][0]['nama_lengkap'],$message);

	 if($mail){
	//$where_edit = array(
			//	'id' => $id
			//	);
				//$datas = array(  
				//  'validate' => 1
				//  );
	//$this->registrasiusermodel->edit_data('registrasi_user',$where_edit,$datas);
		redirect('dashboard/selesaikan/','refresh');
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
	$mail->Host       = "zmtablast.kemkes.go.id";      // masukkan GMAIL sebagai smtp server
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
 
 public function inputan_data_faskes()
	{
			$where = array('id_faskes' => $this->session->userdata('user_id'));
			$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
			$data['data']= $this->registrasiusermodel->getdataklinik($this->session->userdata('user_id'));
			$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
			
			$post = $this->input->post();
		if(isset($post['submit'])){
			
		$type1 = explode('.', $_FILES["operasional"]["name"]); // data file
		$type1 = strtolower($type1[count($type1)-1]); // data type like .jpg
		 //exit(dump($type));
		$filename1="operasional".uniqid(rand()).'.'.$type1;
			
		$inputFileName1 = "./assets/uploads/berkas_operasional/".$filename1; // hash unik
		$operasional=$post['old_operasional'];
		
		$type2 = explode('.', $_FILES["dokumen_registrasi"]["name"]); // data file
		$type2 = strtolower($type2[count($type2)-1]); // data type like .jpg
		 //exit(dump($type));
		$filename2="dokumen_registrasi".uniqid(rand()).'.'.$type2;
		$inputFileName2 = "./assets/uploads/berkas_operasional/".$filename2; // hash unik
		$dokumen_registrasi=$post['old_dokumen_registrasi'];
		
		$type3 = explode('.', $_FILES["bukti_penanaman_modal_asing"]["name"]); // data file
		$type3 = strtolower($type3[count($type3)-1]); // data type like .jpg
		 //exit(dump($type));
		$filename3="modal_asing".uniqid(rand()).'.'.$type3;
		$inputFileName3 = "./assets/uploads/berkas_operasional/".$filename3; // hash unik
		$bukti_penanaman_modal_asing=$post['old_bukti_penanaman_modal_asing'];
		

		
		if(!empty($_FILES["operasional"]["name"])){
			if(in_array($type1, array("pdf"))) {
				if(is_uploaded_file($_FILES["operasional"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["operasional"]["tmp_name"],$inputFileName1)) {
						$operasional=$filename1;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('dashboard/inputan_data_faskes');
				
			}
		}
		
		if(!empty($_FILES["dokumen_registrasi"]["name"])){
			if(in_array($type2, array("pdf"))) {
				if(is_uploaded_file($_FILES["dokumen_registrasi"]["tmp_name"])) {
					if(move_uploaded_file($_FILES["dokumen_registrasi"]["tmp_name"],$inputFileName2)) {
						$dokumen_registrasi=$filename2;		
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('dashboard/inputan_data_faskes');
				
			}
		}
		
		if(!empty($_FILES["bukti_penanaman_modal_asing"]["name"])){
			if(in_array($type3, array("pdf"))) {
				if(is_uploaded_file($_FILES["bukti_penanaman_modal_asing"]["tmp_name"])) {
					if(move_uploaded_file($_FILES["bukti_penanaman_modal_asing"]["tmp_name"],$inputFileName3)) {
						$bukti_penanaman_modal_asing=$filename3;		
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('dashboard/inputan_data_faskes');
				
			}
		}
		$program_prioritas_nasional=implode(",",$post['program_prioritas_nasional']);
		$pelayanan_klinik=implode(";",$post['pelayanan_klinik']);
		//var_dump($program_prioritas_nasional);
		//exit();
		$datas = array(
			    'nama_klinik' =>$post['nama_klinik'],
				'jenis_klinik' =>$post['jenis_klinik'],
				'jenis_perawatan' =>$post['jenis_perawatan'],
				'kerja_sama_bpjs_kesehatan' =>$post['kerja_sama_bpjs_kesehatan'],
				'akreditasi' =>$post['akreditasi'],
				'tanggal_berakhir_izin_operasional' =>date('Y-m-d',strtotime($post['tanggal_berakhir_izin_operasional'])),
				'pemilik' =>$post['pemilik'],
				'nama_pemilik' =>$post['nama_pemilik'],
				'alamat_faskes' =>$post['alamat_faskes'],
				'id_prov' =>$post['id_prov'],
				'id_kota' =>$post['id_kota'],
				'id_camat' =>$post['id_camat'],
				'no_telp' =>$post['no_telp'],
				'email' =>$post['email'],
				'id_faskes' =>$post['id_faskes'],
				'id_wilayah' =>$post['id_wilayah'],
				'jenis_modal_usaha' => $post['jenis_modal_usaha'],
				//'persalinan'=> $post['persalinan'],
				'operasional'=>$operasional,
				'dokumen_registrasi'=>$dokumen_registrasi,
				'bukti_penanaman_modal_asing'=>$bukti_penanaman_modal_asing,
				'nama_penanggung_jawab_klinik' => $post['nama_penanggung_jawab_klinik'],
				'latitude' => $post['latitude'],
				'longitude' => $post['longitude'],
				'jumlah_peserta' => $post['jumlah_peserta'],
				'rasio_dokter_peserta' => $post['rasio_dokter_peserta'],
				'menyelenggarakan_prolanis' => $post['menyelenggarakan_prolanis'],
				'waktu_layanan_dokter_per_pasien' => $post['waktu_layanan_dokter_per_pasien'],
				'berjejaring_dengan_puskesmas' => $post['berjejaring_dengan_puskesmas'],
				'nama_puskesmas' => $post['nama_puskesmas'],
				'program_prioritas_nasional' => $program_prioritas_nasional,
				'program_prioritas_nasional_lainnya' => $post['program_prioritas_nasional_lainnya'],
				'pelayanan_klinik' => $pelayanan_klinik,
				'sebutkan_pelayanan_klinik_spesialistik' => $post['sebutkan_pelayanan_klinik_spesialistik'],
				'sebutkan_pelayanan_klinik_lainnya' => $post['sebutkan_pelayanan_klinik_lainnya']
				);
				
					
		


		
			
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->registrasiusermodel->edit_data('data_klinik',$where,$datas);
			$this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat' =>$post['id_camat']));
			
			if($post['jenis_perawatan_old'] != $post['jenis_perawatan']){
					$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_sarpras_alkes_klinik',$where2);
				
			}
			
			if($post['jenis_klinik_old'] != $post['jenis_klinik']){
				$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_sdm',$where2);
			}
			
			$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Mengedit Data Klinik'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			}else{
			$this->registrasiusermodel->input_data('data_klinik',$datas);
			$id = $this->db->insert_id();
		     $this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat' =>$post['id_camat']));
			
			$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Klinik'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			}
				
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/inputan_data_faskes');
		}
			
			$this->template->utama('dataklinik/index',$data);  
	}
	
	
	public function inputan_data_faskes_labkes()
	{
			$where = array('id_faskes' => $this->session->userdata('user_id'));
			$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
			$data['data']= $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
			$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
	
			$post = $this->input->post();
		
	
		if(isset($post['submit'])){
			
		$type1 = explode('.', $_FILES["upload_surat_permohonan_kode_lab_medis"]["name"]); // data file
		$type1 = strtolower($type1[count($type1)-1]); // data type like .jpg//exit(dump($type));
		$filename1="upload_surat_permohonan_kode_lab_medis".uniqid(rand()).'.'.$type1;	
		$inputFileName1 = "./assets/uploads/berkas_operasional/".$filename1; // hash unik
		$surat_permohonan_kode_lab_medis=$post['old_surat_permohonan_kode_lab_medis'];
		
		$type2 = explode('.', $_FILES["upload_surat_izin_operasional_lab_medis"]["name"]); // data file
		$type2 = strtolower($type2[count($type2)-1]); // data type like .jpg//exit(dump($type));
		$filename2="upload_surat_izin_operasional_lab_medis".uniqid(rand()).'.'.$type2;			
		$inputFileName2 = "./assets/uploads/berkas_operasional/".$filename2; // hash unik
		$surat_izin_operasional_lab_medis=$post['old_surat_izin_operasional_lab_medis'];
		
		$type3 = explode('.', $_FILES["upload_visi_misi"]["name"]); // data file
		$type3 = strtolower($type3[count($type3)-1]); // data type like .jpg//exit(dump($type));
		$filename3="upload_visi_misi".uniqid(rand()).'.'.$type3;			
		$inputFileName3 = "./assets/uploads/berkas_operasional/".$filename3; // hash unik
		$surat_visi_misi=$post['old_visi_misi'];
		
		$type4 = explode('.', $_FILES["upload_struktur_organisasi"]["name"]); // data file
		$type4 = strtolower($type4[count($type4)-1]); // data type like .jpg//exit(dump($type));
		$filename4="upload_struktur_organisasi".uniqid(rand()).'.'.$type4;			
		$inputFileName4 = "./assets/uploads/berkas_operasional/".$filename4; // hash unik
		$surat_struktur_organisasi=$post['old_struktur_organisasi'];
		
		$type5 = explode('.', $_FILES["upload_dokumen_sertifikat_dokumen"]["name"]); // data file
		$type5 = strtolower($type5[count($type5)-1]); // data type like .jpg//exit(dump($type));
		$filename5="upload_dokumen_sertifikat_dokumen".uniqid(rand()).'.'.$type5;			
		$inputFileName5 = "./assets/uploads/berkas_operasional/".$filename5; // hash unik
		$surat_dokumen_sertifikat_dokumen=$post['old_dokumen_sertifikat_dokumen'];
		
		
		

		
		if(!empty($_FILES["upload_surat_permohonan_kode_lab_medis"]["name"])){
			if(in_array($type1, array("pdf"))) {
				
				
				if(is_uploaded_file($_FILES["upload_surat_permohonan_kode_lab_medis"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["upload_surat_permohonan_kode_lab_medis"]["tmp_name"],$inputFileName1)) {
						$surat_permohonan_kode_lab_medis=$filename1;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('dashboard/inputan_data_faskes_labkes');
				
			}
		}
		
		if(!empty($_FILES["upload_surat_izin_operasional_lab_medis"]["name"])){
			if(in_array($type2, array("pdf"))) {
				
		
				  
				if(is_uploaded_file($_FILES["upload_surat_izin_operasional_lab_medis"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["upload_surat_izin_operasional_lab_medis"]["tmp_name"],$inputFileName2)) {
						$surat_izin_operasional_lab_medis=$filename2;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('dashboard/inputan_data_faskes_labkes');
				
			}
		}
		
		if(!empty($_FILES["upload_visi_misi"]["name"])){
			if(in_array($type3, array("pdf"))) {
				
		
				  
				if(is_uploaded_file($_FILES["upload_visi_misi"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["upload_visi_misi"]["tmp_name"],$inputFileName3)) {
						$surat_visi_misi=$filename3;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('dashboard/inputan_data_faskes_labkes');
				
			}
		}
		
		if(!empty($_FILES["upload_struktur_organisasi"]["name"])){
			if(in_array($type4, array("pdf"))) {

				  
				if(is_uploaded_file($_FILES["upload_struktur_organisasi"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["upload_struktur_organisasi"]["tmp_name"],$inputFileName4)) {
						$surat_struktur_organisasi=$filename4;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('dashboard/inputan_data_faskes_labkes');
				
			}
		}
		
		
				  
		if(!empty($_FILES["upload_dokumen_sertifikat_dokumen"]["name"])){
			if(in_array($type5, array("pdf"))) {
				

				
				  
				if(is_uploaded_file($_FILES["upload_dokumen_sertifikat_dokumen"]["tmp_name"])) {
			
					if(move_uploaded_file($_FILES["upload_dokumen_sertifikat_dokumen"]["tmp_name"],$inputFileName5)) {
						$surat_dokumen_sertifikat_dokumen=$filename5;	
				
					}
				}
			}else{
				$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
				$this->session->set_flashdata('icon_name', 'warning');
				$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
				redirect('dashboard/inputan_data_faskes_labkes');
				
			}
		}

		$jenis_pelayanan=implode(",",$post['jenis_pelayanan']);
		$bentuk_pelayanan=implode(",",$post['bentuk_pelayanan']);
			
		
		$datas = array(
			    'nama_lab' =>$post['nama_lab'],
				'jenis_pelayanan' =>$jenis_pelayanan,
				'jenis_lab' =>$post['jenis_lab'],
				'lab_medis_khusus' =>$post['lab_medis_khusus'],
				'bentuk_pelayanan' =>$bentuk_pelayanan,
				'bentuk_lab' =>$post['bentuk_lab'],		
				'id_nama_fasyankes_terintegrasi' =>$post['id_nama_fasyankes_terintegrasi'],
				'nama_fasyankes_terintegrasi' =>$post['nama_fasyankes_terintegrasi'],
				'pemilik' =>$post['pemilik'],
				'nama_pemilik' =>$post['nama_pemilik'],
				'alamat_faskes' =>$post['alamat_faskes'],
				'id_prov' =>$post['id_prov'],
				'id_kota' =>$post['id_kota'],
				'id_camat' =>$post['id_camat'],
				'no_telp' =>$post['no_telp'],
				'email' =>$post['email'],
				'id_faskes' =>$post['id_faskes'],
				'upload_surat_permohonan_kode_lab_medis'=>$surat_permohonan_kode_lab_medis,
				'upload_surat_izin_operasional_lab_medis'=>$surat_izin_operasional_lab_medis,
				'tanggal_berakhir_izin_operasional'=>date('Y-m-d',strtotime($post['tanggal_berakhir_izin_operasional'])),
				'upload_visi_misi'=>$surat_visi_misi,
				'upload_struktur_organisasi'=>$surat_struktur_organisasi,
				'status_akreditasi' =>$post['status_akreditasi'],
				'tanggal_berakhir_sertifikat_akreditasi' =>date('Y-m-d',strtotime($post['tanggal_berakhir_sertifikat_akreditasi'])),
				'upload_dokumen_sertifikat_dokumen'=>$surat_dokumen_sertifikat_dokumen,
				'rencana_survey_akreditasi' =>date('Y-m-d',strtotime($post['rencana_survey_akreditasi'])),
				'latitude' => $post['latitude'],
				'longitude' => $post['longitude']
				);
				
					
		


		
			
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->registrasiusermodel->edit_data('data_labkes',$where,$datas);
			$this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat' =>$post['id_camat']));
			if($post['jenis_perawatan_old'] != $post['jenis_perawatan']){
					$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_labkes_sarpras_alkes',$where2);
				
			}
			
			if($post['jenis_klinik_old'] != $post['jenis_klinik']){
				$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_labkes_sdm',$where2);
			}
			
			$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Mengedit Data Labkes'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			}else{
				
			$this->registrasiusermodel->input_data('data_labkes',$datas);
			$id = $this->db->insert_id();
			$this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat' =>$post['id_camat']));
			$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Labkes'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			}
				
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/inputan_data_faskes_labkes');
		}
			
			$this->template->utama('datalabkes/index',$data);  
	}
	
	public function dropdown4($id=null,$filters='') {
		//if ($this->input->is_ajax_request()) {
			//$this->load->model('helpdesksubprojectmodel');
			$filters .= "id_prop = '".urldecode($id)."' AND status='Aktif'";
			$order = " nama_kota ASC";
			
			$rsData = $this->registrasiusermodel->get_kota_by_prop($filters, $order);//exit(show_last_query());
			echo json_encode($rsData);
		//}
		return;
	}
	
	public function dropdown5($id=null,$filters='') {
		//if ($this->input->is_ajax_request()) {
			//$this->load->model('helpdesksubprojectmodel');
			$filters .= "prop_id = '".urldecode($id)."' ";
			$order = " kab_kota ASC";
			
			$rsData = $this->registrasiusermodel->get_kota_by_prop_new($filters, $order);//exit(show_last_query());
			echo json_encode($rsData);
		//}
		return;
	}
	
		public function dropdown6($id_prop=null,$id_kota=null,$filters='') {

		//if ($this->input->is_ajax_request()) {
			//$this->load->model('helpdesksubprojectmodel');
			$filters .= "id_prop = '".urldecode($id_prop)."' AND id_kota = '".urldecode($id_kota)."' ";
			$order = " nama_camat ASC";
			
			$rsData = $this->registrasiusermodel->get_kec_by_kota_prop($filters, $order);//exit(show_last_query());
			echo json_encode($rsData);
		//}
		return;
	}
	
	public function dropdown7($jenis_klinik=null,$filters='') {	
			$filters .= "jenis_klinik = '".urldecode($jenis_klinik)."' ";
			$order = " id ASC";
			
			$rsData = $this->registrasiusermodel->get_pelayanan_klniik($filters, $order);//exit(show_last_query());
			echo json_encode($rsData);
		//}
		return;
	}
	
	public function inputan_data_sarpras_alkes_klinik()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdatasarprasalkesklinik($this->session->userdata('user_id'));	
		$data['user']= $this->registrasiusermodel->getdataklinik($this->session->userdata('user_id'));
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_sarpras_alkes_klinik',$where2);

			foreach($post['id_sarpras_alkes'] as $ids){

				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'id_sarpras_alkes' => $ids,
				'is_checked' => ($post['is_checked'][$ids] =='1' ? $post['is_checked'][$ids]  : 0),
				'sub_keterangan' => (!empty($post['sub_keterangan'][$ids]) ? $post['sub_keterangan'][$ids]  : '')
				);
				
		
			$this->registrasiusermodel->input_data('trans_sarpras_alkes_klinik',$datas_detail);
//echo $this->db->last_query();
//exit();
			}
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data Sarpras Alkes Klinik'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/inputan_data_sarpras_alkes_klinik/');
		}
			
			$this->template->utama('dataklinik/index_sarpras_alkes_klinik',$data);  
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
				'isian' => $post['isian'][$ids]
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
			redirect('dashboard/inputan_data_sarpras_alkes_labkes/');
		}
			
			$this->template->utama('datalabkes/index_sarpras_alkes_labkes',$data);  
	}
	
	public function inputan_data_sdm()
	{
	
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['user']= $this->registrasiusermodel->getdataklinik($this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->getdatasdm($this->session->userdata('user_id'));	
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_sdm',$where2);

			foreach($post['id_sdm'] as $ids){

				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'id_sdm' => $ids,
				'jumlah' => $post['jumlah'][$ids],
				'sub_keterangan' => (!empty($post['sub_keterangan'][$ids]) ? $post['sub_keterangan'][$ids]  : '')
				);
				
		
			$this->registrasiusermodel->input_data('trans_sdm',$datas_detail);
			}
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data SDM'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/inputan_data_sdm/');
		}
			
			$this->template->utama('dataklinik/index_data_sdm',$data);  
	}
	
	
	public function inputan_data_sdm_labkes($id=NULL)
	{

		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['user']= $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->getdatasdmlabkes($this->session->userdata('user_id'));	
	
		$data['user_id']= $this->session->userdata('user_id');
		$post = $this->input->post();
		
			if(isset($post['submit'])){
				
			


				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'nama' => $post['nama'],
				'id_jabatan' => $post['id_jabatan'],
				'id_pendidikan' => $post['id_pendidikan'],
				'keterangan' => $post['keterangan']
				);
				
		
			$this->registrasiusermodel->input_data('trans_labkes_sdm',$datas_detail);
			
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data SDM'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/inputan_data_sdm_labkes/');
		}
			
		if(isset($id)){
			$where2 = array(
						'id' => $id
						);
			$this->registrasiusermodel->delete_data('trans_labkes_sdm',$where2);
			 $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Berhasil Hapus Data!');
			redirect('dashboard/inputan_data_sdm_labkes/');
		}
			$this->template->utama('datalabkes/index_data_sdm_labkes',$data);  
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
				redirect('dashboard/inputan_jenis_pemeriksaan_labkes');
				
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
				redirect('dashboard/inputan_jenis_pemeriksaan_labkes');
				
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
				redirect('dashboard/inputan_jenis_pemeriksaan_labkes');
				
			}
			}
				
			


				$datas_detail = array(
			    'id_faskes' =>$post['id_faskes'],
				'type' => $post['type'],
				'nik' => $post['nik'],
				'nama' => $post['nama'],
				'fungsional' => $post['fungsional'],
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
				'jenis_pemeriksaan' => $post['jenis_pemeriksaan'],
				'pemeriksaan_tambahan' => $post['pemeriksaan_tambahan']
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
			redirect('dashboard/inputan_jenis_pemeriksaan_labkes/');
		}
			
		if(isset($id)){
			$where2 = array(
						'id' => $id
						);
			$this->registrasiusermodel->delete_data('trans_labkes_jenis_pemeriksaan',$where2);
			 $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Berhasil Hapus Data!');
			redirect('dashboard/inputan_jenis_pemeriksaan_labkes/');
		}
			$this->template->utama('datalabkes/index_jenis_pemeriksaan_labkes',$data);  
	}
	
	public function detail_jenis_pemeriksaan($id_jenis_pemeriksaan=null)
	{
		
	    $data['data'] = $this->registrasiusermodel->getdetaildatajenispemeriksaanlabkes(urldecode($id_jenis_pemeriksaan));
		$this->template->kosong('datalabkes/detail_jenis_pemeriksaan',$data);  
	}
	
	public function selesaikan()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();	
		$data['user_id']= $this->session->userdata('user_id');
		$data['getdataklinik']= $this->registrasiusermodel->getdataklinik($this->session->userdata('user_id'));
		$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
		$post = $this->input->post();
		
			if(isset($post['submit'])){
			
				$validasi['klinik']= $this->registrasiusermodel->select_count('data_klinik',$post["id_faskes"]);
	
				if($validasi['klinik'][0]['jml']==0){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Klinik Belum DI Isi');
			      redirect('dashboard/selesaikan/');
				}
				
				$validasi['trans_sarpras_alkes_klinik']= $this->registrasiusermodel->select_count('trans_sarpras_alkes_klinik',$post["id_faskes"]);		
				if($validasi['trans_sarpras_alkes_klinik'][0]['jml']==0){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Sarpras Alkes Belum DI Isi');
			      redirect('dashboard/selesaikan/');
				}
				
				$validasi['trans_sdm']= $this->registrasiusermodel->select_count('trans_sdm',$post["id_faskes"]);		
				if($validasi['trans_sdm'][0]['jml']==0){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'SDM Belum DI Isi');
			      redirect('dashboard/selesaikan/');
				}
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_final',$where2);

				$datas_detail = array(
				'id_faskes'=>$post["id_faskes"],
				'pma' =>$post["pma"],
			    'final' =>1,
				'id_link'=>$post["id_kota"],
				'kode_faskes_lama'=>$post["kode_faskes_lama"],
				'kode_regional_link'=>$post["kode_regional"]
				);
				
		
			$this->registrasiusermodel->input_data('trans_final',$datas_detail);
			
				$datas_log = array(
			    'id_faskes' =>$this->session->userdata('user_id'),
				'status' =>''.$this->session->userdata('email').' Telah Menyelesaikan Data registrasi dan sudah diteruskan ke dinkes kota terkait'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);

		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!, Data Akan DI Verifikasi, Pemberitahuan Akan Dikirimkan Ke Email!');
			redirect('dashboard/selesaikan/');
		}
			
			$this->template->utama('dataklinik/selesaikan',$data);  
	}
	
	
	public function selesaikan_labkes()
	{
		$where = array('id_faskes' => $this->session->userdata('user_id'));
		$data['data']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();	
		$data['user_id']= $this->session->userdata('user_id');
		///$data['getdataklinik']= $this->registrasiusermodel->getdataklinik($this->session->userdata('user_id'));
		$data['getdatalabkes']= $this->registrasiusermodel->getdatalabkes($this->session->userdata('user_id'));
		$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
		$post = $this->input->post();
		
			if(isset($post['submit'])){
			
				$validasi['labkes']= $this->registrasiusermodel->select_count('data_labkes',$post["id_faskes"]);
	
				if($validasi['labkes'][0]['jml']==0){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Data Dasar Belum DI Isi');
			      redirect('dashboard/selesaikan_labkes/');
				}
				
				$validasi['trans_labkes_sarpras_alkes']= $this->registrasiusermodel->select_count('trans_labkes_sarpras_alkes',$post["id_faskes"]);		
				if($validasi['trans_labkes_sarpras_alkes'][0]['jml']==0){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Sarpras Alkes Belum DI Isi');
			      redirect('dashboard/selesaikan_labkes/');
				}
				
				$validasi['trans_labkes_sdm']= $this->registrasiusermodel->select_count('trans_labkes_sdm',$post["id_faskes"]);		
				if($validasi['trans_labkes_sdm'][0]['jml']==0){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'SDM Belum DI Isi');
			      redirect('dashboard/selesaikan_labkes/');
				}
				
				$validasi['trans_labkes_jenis_pemeriksaan']= $this->registrasiusermodel->select_count('trans_labkes_jenis_pemeriksaan',$post["id_faskes"]);		
				if($validasi['trans_labkes_jenis_pemeriksaan'][0]['jml']==0){
					$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
					$this->session->set_flashdata('icon_name', 'warning');
					$this->session->set_flashdata('message_name', 'Jenis Pemeriksaan Belum DI Isi');
			      redirect('dashboard/selesaikan_labkes/');
				}
				
				
				
			$where2 = array(
						'id_faskes' => $post["id_faskes"]
						);
			$this->registrasiusermodel->delete_data('trans_final',$where2);

				$datas_detail = array(
				'id_faskes'=>$post["id_faskes"],
			    'final' =>1,
				'id_link'=>$post["id_kota"],
				'kode_faskes_lama'=>$post["kode_faskes_lama"],
				'kode_regional_link'=>$post["kode_regional"],
				'jenis_pratama_utama'=>$post["jenis_pratama_utama"]
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
			redirect('dashboard/selesaikan_labkes/');
		}
			
			$this->template->utama('datalabkes/selesaikan_labkes',$data);  
	}
	
	function list_user_yang_mengajukan($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpengajuan($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('admin/list_user_yang_mengajukan',$data);  
	}
	
	function ubah_status_klinik($id=0){
			//$data['data']['query'] = $this->registrasiusermodel->getlistpengajuan($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			
		    $data['data']= $this->registrasiusermodel->getdataklinik($id);
			$post = $this->input->post();
		
			if(isset($post['submit'])){
				
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);

						$datas_detail = array(
						'status_klinik' =>$post["status_klinik"],
						'alasan_status_klinik' =>$post["alasan_status_klinik"]
						);
						
					$this->registrasiusermodel->edit_data('data_klinik',$where2,$datas_detail);
				redirect('dashboard/list_user_yang_mengajukan');
				
			}
			$data['id'] =$id;
			$this->template->utama('admin/ubah_status_klinik',$data);  
	}
	
	function list_user_yang_mengajukan_labkes($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpengajuanlabkes($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('admin/list_user_yang_mengajukan_labkes',$data);  
	}
	
	function list_user_yang_mengajukan_belum_validasi($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpengajuanbelumvalidasi($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('admin/list_user_yang_mengajukan_belum_validasi',$data);  
	}
	
	function list_user_yang_mengajukan_belum_validasi_labkes($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpengajuanbelumvalidasilabkes($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('admin/list_user_yang_mengajukan_belum_validasi_labkes',$data);  
	}
	
	function list_user_yang_mengajukan_belum_validasi_perbaikan($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpengajuanbelumvalidasiperbaikan($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('admin/list_user_yang_mengajukan_belum_validasi_perbaikan',$data);  
	}
	
	function list_user_yang_mengajukan_belum_validasi_perbaikan_labkes($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpengajuanbelumvalidasiperbaikanlabkes($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('admin/list_user_yang_mengajukan_belum_validasi_perbaikan_labkes',$data);  
	}
	
	function list_user_yang_mengajukan_pma($id=0){
	
			$data['data']['query'] = $this->registrasiusermodel->getlistpengajuanpma($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('admin/list_user_yang_mengajukan_pma',$data);  
	}
	
	function list_user_yang_mengajukan_pma_belum_validasi($id=0){
	
			$data['data']['query'] = $this->registrasiusermodel->getlistpengajuanpmabelumvalidasi($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('admin/list_user_yang_mengajukan_pma_belum_validasi',$data);  
	}
	
	function list_user_yang_mengajukan_pma_belum_validasi_perbaikan($id=0){
			$data['data']['query'] = $this->registrasiusermodel->getlistpengajuanpmabelumvalidasiperbaikan($this->session->userdata('id_kategori'),$this->session->userdata('id_kota'));
			$this->template->utama('admin/list_user_yang_mengajukan_pma_belum_validasi_perbaikan',$data);  
	}
	
	function verifikasi_pengajuan_faskes($id=NULL){

				$post = $this->input->post();
				if(isset($post['submit'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);

						$datas_detail = array(
						'nama_klinik' =>$post["nama_klinik"],
						'jenis_perawatan' =>$post["jenis_perawatan"],
						'persalinan' =>$post["persalinan"],
						'jenis_klinik' =>$post["jenis_klinik"]
						);
						
					$this->registrasiusermodel->edit_data('data_klinik',$where2,$datas_detail);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Di Rubah');
					redirect('dashboard/verifikasi_pengajuan_faskes/'.$id);
				}

			$data['data']= $this->registrasiusermodel->getdataklinik($id);

			$data['user_id']=$id;
	
			$this->template->utama('admin/verifikasi_pengajuan_faskes',$data);  
	}
	
	
	function verifikasi_pengajuan_faskes_labkes($id=NULL){

				$post = $this->input->post();

				if(isset($post['submit'])){
					$json_validasi='{"field":{"nama_lab_validasi":{"nilai":"'.(!empty($post["nama_lab_validasi"]) ? $post["nama_lab_validasi"] : 0).'","keterangan":"'.(!empty($post["keterangan_nama_lab_validasi"]) ? $post["keterangan_nama_lab_validasi"] : 0).'"},"pemilik_validasi":{"nilai":"'.(!empty($post["pemilik_validasi"]) ? $post["pemilik_validasi"] : 0).'","keterangan":"'.(!empty($post["keterangan_pemilik_validasi"]) ? $post["alamat_validasi"] : 0).'"},"alamat_validasi":{"nilai":"'.(!empty($post["alamat_validasi"]) ? $post["pemilik_validasi"] : 0).'","keterangan":"'.(!empty($post["keterangan_alamat_validasi"]) ? $post["keterangan_alamat_validasi"] : 0).'"} }}';

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
					redirect('dashboard/verifikasi_pengajuan_faskes_labkes/'.$id);
				}

			$data['data']= $this->registrasiusermodel->getdatalabkes($id);

			$data['user_id']=$id;
	
			$this->template->utama('admin/verifikasi_pengajuan_faskes_labkes',$data);  
	}
	
	function verifikasi_pengajuan_faskes_alkes($id=NULL){

	

		$where = array('id_faskes' => $id);
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdatasarprasalkesklinik($id);	
		$data['user']= $this->registrasiusermodel->getdataklinik($id);
		$data['user_id']= $id;
		$post = $this->input->post();
			

	
			$this->template->utama('admin/verifikasi_pengajuan_faskes_alkes',$data);  
	}
	
	function verifikasi_pengajuan_faskes_alkes_labkes($id=NULL){

	

		$where = array('id_faskes' => $id);
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdatasarprasalkeslabkes($id);	
		$data['user']= $this->registrasiusermodel->getdatalabkes($id);
		$data['user_id']= $id;
		$post = $this->input->post();
			

	
			$this->template->utama('admin/verifikasi_pengajuan_faskes_alkes_labkes',$data);  
	}
	
	function verifikasi_pengajuan_faskes_sdm($id=NULL){

		    $post = $this->input->post();

			//$data['user']= $this->registrasiusermodel->getdatauser($id);	
			$data['user']= $this->registrasiusermodel->getdataklinik($id);
			$data['data']= $this->registrasiusermodel->getdatasdm($id);	
		    $data['user_id']= $id;
	
			$this->template->utama('admin/verifikasi_pengajuan_faskes_sdm',$data);  
	}
	
	function verifikasi_pengajuan_faskes_sdm_labkes($id=NULL){

		    $post = $this->input->post();

			//$data['user']= $this->registrasiusermodel->getdatauser($id);	
			$data['user']= $this->registrasiusermodel->getdatalabkes($id);
			$data['data']= $this->registrasiusermodel->getdatasdmlabkes($id);	
		    $data['user_id']= $id;
	
			$this->template->utama('admin/verifikasi_pengajuan_faskes_sdm_labkes',$data);  
	}
	
	
	function verifikasi_pengajuan_faskes_jenis_pemeriksaan_labkes($id=NULL){

		    $post = $this->input->post();

			//$data['user']= $this->registrasiusermodel->getdatauser($id);	
			$data['user']= $this->registrasiusermodel->getdatalabkes($id);
			$data['data']= $this->registrasiusermodel->getdatajenispemeriksaanlabkes($id);	
		    $data['user_id']= $id;
	
			$this->template->utama('admin/verifikasi_pengajuan_faskes_jenis_pemeriksaan_labkes',$data);  
	}
	
	
	
	function verifikasikan($id=NULL){

		    $post = $this->input->post();
				if(isset($post['submit'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);

						$datas_detail = array(
						'validate' =>1
						);
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Di Verifikasi, Data Di Kirimkan Ke Kemkes!');
					redirect('dashboard/verifikasikan/'.$id);
				}
	
			$where = array('id_faskes' => $id);
			$data['data']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		    $data['user_id']= $id;
	
			$this->template->utama('admin/verifikasikan',$data);  
	}
	
	function verifikasikan_kirim($id=NULL){

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
					redirect('dashboard/verifikasikan_kirim/'.$id);
				}


				if(isset($post['submit_setujui'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


						$datas_detail = array('token_kode_faskes' =>$token);
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Di Setujui Oleh Dinkes/Kemkes'
				);
					$where = array('id_faskes' => $post["id_faskes"]);
					$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
				    $this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"]);
				
				
					$this->registrasiusermodel->input_data('timeline',$datas_log);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Pemberitahuan Akan Di Kirimkan Melalui Aplikasi Registrasi Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi');
					redirect('dashboard/verifikasikan_kirim/'.$id);
				}
				
				if(isset($post['submit_perbaikan'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


						$datas_detail = array('final' =>0,'catatan'=>$post["catatan"],'token_kode_faskes'=>'');
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Minta Diperbaiki Oleh Dinkes/Kemkes'
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
		 $mail = $this->send_email("registrasifasyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","uLH0%RYL",$title,$email,$data['data'][0]['nama_lengkap'],$message);

					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
					redirect('dashboard/verifikasikan_kirim/'.$id);
				}
				
			$where = array('id_faskes' => $id);
			$data['data']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
			$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
			$data['data2']= $this->registrasiusermodel->getdataklinik($id);
		    $data['user_id']= $id;
	
			$this->template->utama('admin/verifikasikan_kirim',$data);  
	}
	
	
	function verifikasikan_kirim_labkes($id=NULL){

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
					redirect('dashboard/verifikasikan_kirim_labkes/'.$id);
				}
				
				
				if(isset($post['submit_validasi'])){
						
	
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
			

					$datas_detail = array('id_validate_kota' =>$this->session->userdata('user_id'));
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Di Setujui Oleh Dinkes Kota'
				);
					$where = array('id_faskes' => $post["id_faskes"]);
					$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
				   // $this->validasi_link_kode_faskes($token,$data['data2'][0]["id_link"],$id,$data['data2'][0]["kode_regional_link"]);
				
				
					$this->registrasiusermodel->input_data('timeline',$datas_log);


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Setujui!, Data Akan Di Teruskan Ke Dinkes Provinsi Terkait');
					redirect('dashboard/verifikasikan_kirim_labkes/'.$id);
				}


				if(isset($post['submit_setujui'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
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
					redirect('dashboard/verifikasikan_kirim_labkes/'.$id);
				}
				
				
				if(isset($post['submit_setujui_kemkes'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


						$datas_detail = array('token_kode_faskes' =>$token,'id_validate_kemkes' =>$this->session->userdata('user_id'));
						
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
					redirect('dashboard/verifikasikan_kirim_labkes/'.$id);
				}
				
				if(isset($post['submit_perbaikan'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


						$datas_detail = array('final' =>0,'catatan'=>$post["catatan"],'token_kode_faskes'=>'');
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Minta Diperbaiki Oleh Dinkes/Kemkes'
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
		$mail = $this->send_email("registrasifasyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","uLH0%RYL",$title,$email,$data['data'][0]['nama_lengkap'],$message);

					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
					redirect('dashboard/verifikasikan_kirim_labkes/'.$id);
				}
				
				
				if(isset($post['submit_perbaikan_prov'])){
						
					$where2 = array(
								'id_faskes' => $post["id_faskes"]
								);
				/* 	$token = random_bytes(24);
					$token = bin2hex($token); */
				//$token = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 50);


						$datas_detail = array('id_validate_kota' =>'','catatan'=>$post["catatan"]);
						
					$this->registrasiusermodel->edit_data('trans_final',$where2,$datas_detail);
					
						$datas_log = array(
						'id_faskes' =>$post["id_faskes"],
						'id_dinkes' =>$this->session->userdata('user_id'),
						'status' =>''.$this->session->userdata('email').' Telah Minta Diperbaiki Oleh Dinkes/Kemkes'
				);
			$this->registrasiusermodel->input_data('timeline',$datas_log);
			
			
					


					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Data Sudah Di Minta Perbaiki!');
					redirect('dashboard/verifikasikan_kirim_labkes/'.$id);
				}
				
			$where = array('id_faskes' => $id);
			$data['data']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
			$data['user']= $this->registrasiusermodel->getdatauser($this->session->userdata('user_id'));	
			
			
		    $data['user_id']= $id;
	
			$this->template->utama('admin/verifikasikan_kirim_labkes',$data);  
	}
	
	public function master_data_sdm(){	
	   $this->load->model('master/Sdmmodel');		
	   $data['data']['query'] = $this->Sdmmodel->get_list();
	   $this->template->utama('master_data/data_sdm',$data);  
	}
	
	public function tambah_master_data_sdm($id=null){	
		$this->load->model('master/Sdmmodel');
		$data['data'] = $this->Sdmmodel->get_list_by_id($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
		$datas = array(
			    'jenis_klinik' =>$post['jenis_klinik'],
				'sdm' =>$post['sdm'],
				'auth' =>$post['auth'],	
				'keterangan' =>$post['keterangan'],
				'sub_keterangan' =>$post['sub_keterangan']
				);
				
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->Sdmmodel->edit_data('data_sdm',$where,$datas);
			}else{
				
			$this->Sdmmodel->input_data('data_sdm',$datas);
			$id = $this->db->insert_id();
			}
				
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/master_data_sdm');
		}
			
		$this->template->utama('master_data/tambah_master_data_sdm',$data);  
		
	}
	
	public function hapus_master_data_sdm($id=null){	
		$this->load->model('master/Sdmmodel');
		
		if(!empty($id)){
			$datas = array('deleted' =>1);
			$where = array('id' =>$id);
			$this->Sdmmodel->edit_data('data_sdm',$where,$datas);
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Hapus Data!');
			redirect('dashboard/master_data_sdm');
		}
			
		$this->template->utama('master_data/data_sdm',$data);  
		
	}
	
	public function master_data_sdm_utd(){	
	   $this->load->model('master/Sdmutdmodel');		
	   $data['data']['query'] = $this->Sdmutdmodel->get_list();
	   $this->template->utama('master_data/data_sdm_utd',$data);  
	}
	
	public function tambah_master_data_sdm_utd($id=null){	
		$this->load->model('master/Sdmutdmodel');
		$data['data'] = $this->Sdmutdmodel->get_list_by_id($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
		$datas = array(
				'sdm' =>$post['sdm'],
				'sub_keterangan' =>$post['sub_keterangan'],
				'urut' =>$post['urut']
				);
				
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->Sdmutdmodel->edit_data('data_sdm_utd',$where,$datas);
			}else{
				
			$this->Sdmutdmodel->input_data('data_sdm_utd',$datas);
			$id = $this->db->insert_id();
			}
				
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/master_data_sdm_utd');
		}
			
		$this->template->utama('master_data/tambah_master_data_sdm_utd',$data);  
		
	}
	
	public function hapus_master_data_sdm_utd($id=null){	
		$this->load->model('master/Sdmutdmodel');
		
		if(!empty($id)){
			$datas = array('deleted' =>1);
			$where = array('id' =>$id);
			$this->Sdmutdmodel->edit_data('data_sdm_utd',$where,$datas);
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Hapus Data!');
			redirect('dashboard/master_data_sdm_utd');
		}
			
		$this->template->utama('master_data/data_sdm_utd',$data);  
		
	}
	
	public function master_data_sarpras(){	
	   $this->load->model('master/Sarprasmodel');		
	   $data['data']['query'] = $this->Sarprasmodel->get_list();
	   $this->template->utama('master_data/data_sarpras',$data);  
	}
	
	public function tambah_master_data_sarpras($id=null){	
		$this->load->model('master/Sarprasmodel');
		$data['data'] = $this->Sarprasmodel->get_list_by_id($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
		$datas = array(
			    'jenis_perawatan' =>$post['jenis_perawatan'],
				'type' =>$post['type'],
				'type_bangunan' =>$post['type_bangunan'],	
				'auth' =>$post['auth'],	
				'sub_keterangan' =>$post['sub_keterangan'],	
				'sarpras_alkes' =>$post['sarpras_alkes'],
				'keterangan' =>$post['keterangan']
				);
				
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->Sarprasmodel->edit_data('sarpras_alkes_klinik',$where,$datas);
			}else{
				
			$this->Sarprasmodel->input_data('sarpras_alkes_klinik',$datas);
			$id = $this->db->insert_id();
			}
				
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/master_data_sarpras');
		}
			
		$this->template->utama('master_data/tambah_master_data_sarpras',$data);  
		
	}
	
	public function hapus_master_data_sarpras($id=null){	
		$this->load->model('master/Sarprasmodel');
		
		if(!empty($id)){
			$datas = array('deleted' =>1);
			$where = array('id' =>$id);
			$this->Sarprasmodel->edit_data('sarpras_alkes_klinik',$where,$datas);
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Hapus Data!');
			redirect('dashboard/master_data_sarpras');
		}
			
		$this->template->utama('master_data/data_sarpras',$data);  
		
	}
	
	
	public function master_data_sarpras_utd(){	
	   $this->load->model('master/Sarprasutdmodel');		
	   $data['data']['query'] = $this->Sarprasutdmodel->get_list();
	   $this->template->utama('master_data/data_sarpras_utd',$data);  
	}
	
	public function tambah_master_data_sarpras_utd($id=null){	
		$this->load->model('master/Sarprasutdmodel');
		$data['data'] = $this->Sarprasutdmodel->get_list_by_id($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
		$datas = array(
				'type' =>$post['type'],
				'sub_type' =>$post['sub_type'],	
				'nama_sarpras' =>$post['nama_sarpras'],
				'sub_keterangan' =>$post['sub_keterangan'],
				'utama' =>$post['utama'],
				'madya' =>$post['madya'],
				'pratama' =>$post['pratama']
				);
				
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->Sarprasutdmodel->edit_data('sarpras_alkes_utd',$where,$datas);
			}else{
				
			$this->Sarprasutdmodel->input_data('sarpras_alkes_utd',$datas);
			$id = $this->db->insert_id();
			}
				
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/master_data_sarpras_utd');
		}
			
		$this->template->utama('master_data/tambah_master_data_sarpras_utd',$data);  
		
	}
	
	public function hapus_master_data_sarpras_utd($id=null){	
		$this->load->model('master/Sarprasutdmodel');
		
		if(!empty($id)){
			$datas = array('deleted' =>1);
			$where = array('id' =>$id);
			$this->Sarprasutdmodel->edit_data('sarpras_alkes_utd',$where,$datas);
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Hapus Data!');
			redirect('dashboard/master_data_sarpras_utd');
		}
			
		$this->template->utama('master_data/data_sarpras_utd',$data);  
		
	}
	
	
	public function master_data_alkes_utd(){	
	   $this->load->model('master/Alkesutdmodel');		
	   $data['data']['query'] = $this->Alkesutdmodel->get_list();
	   $this->template->utama('master_data/data_alkes_utd',$data);  
	}
	
	public function tambah_master_data_alkes_utd($id=null){	
		$this->load->model('master/Alkesutdmodel');
		$data['data'] = $this->Alkesutdmodel->get_list_by_id($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
		$datas = array(
				'nama_ruang' =>$post['nama_ruang'],
				'nama_alkes' =>$post['nama_alkes'],	
				'sub_keterangan' =>$post['sub_keterangan'],
				'utama' =>$post['utama'],
				'madya' =>$post['madya'],
				'pratama' =>$post['pratama']
				);
				
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->Alkesutdmodel->edit_data('alkes_utd',$where,$datas);
			}else{
				
			$this->Alkesutdmodel->input_data('alkes_utd',$datas);
			$id = $this->db->insert_id();
			}
				
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/master_data_alkes_utd');
		}
			
		$this->template->utama('master_data/tambah_master_data_alkes_utd',$data);  
		
	}
	
	public function hapus_master_data_alkes_utd($id=null){	
		$this->load->model('master/Alkesutdmodel');
		
		if(!empty($id)){
			$datas = array('deleted' =>1);
			$where = array('id' =>$id);
			$this->Alkesutdmodel->edit_data('alkes_utd',$where,$datas);
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Hapus Data!');
			redirect('dashboard/master_data_alkes_utd');
		}
			
		$this->template->utama('master_data/data_alkes_utd',$data);  
		
	}
	
	function list_timeline($id=0){
	
			$data['data']['query'] = $this->registrasiusermodel->getlisttimeline($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'),$this->session->userdata('type_user'));
			$this->template->utama('admin/list_timeline',$data);  
	}
	
	function timeline($id=NULL){
	
			$data['data']['query'] = $this->registrasiusermodel->getbytimeline($id);
			$this->template->utama('admin/timeline',$data);  
	}
	
	function rekap_data($id=NULL){

			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->getrekap_data(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota'],'',$_POST['jenis_klinik'],$_POST['jenis_perawatan'],$_POST['sorting'],$_POST['type_sorting']);
			 //var_dump($data['data']['query']);
				//	exit();
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data('','','',$this->session->userdata('id_kota'),'',$_POST['jenis_klinik'],$_POST['jenis_perawatan'],$_POST['sorting'],$_POST['type_sorting']); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data('','',$this->session->userdata('id_prov'),$_POST['id_kota'],'',$_POST['jenis_klinik'],$_POST['jenis_perawatan'],$_POST['sorting'],$_POST['type_sorting']); 
					
			 }
 
			$this->template->utama('admin/rekap_data',$data);  
	}
	
	function rekap_data_klinik($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->getrekap_data(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota'],'',$_POST['jenis_klinik'],$_POST['jenis_perawatan']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data('','','',$this->session->userdata('id_kota'),'',$_POST['jenis_klinik'],$_POST['jenis_perawatan']); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data('','',$this->session->userdata('id_prov'),$_POST['id_kota'],'',$_POST['jenis_klinik'],$_POST['jenis_perawatan']); 
			 }
 
			$this->template->utama('admin/rekap_data_klinik',$data);  
	}
	
	function rekap_data_labkes($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->getrekap_data_lab(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_lab('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_lab('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/rekap_data_labkes',$data);  
	}
	
	function rekap_data_rs($id=NULL){
		
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->getrekap_data_rs(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_rs('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_rs('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/rekap_data_rs',$data);  
	}
	
	function rekap_data_utd($id=NULL){
		
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->getrekap_data_utd(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_utd('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_utd('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/rekap_data_utd',$data);  
	}
	
	
	function rekap_data_rs_all($id=NULL){
		
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->getrekap_data_rs(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_rs('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_rs('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/rekap_data_rs_all',$data);  
	}
	
	function rekap_data_pm_all($id=NULL){
		
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->getrekap_data_pm(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_pm('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_pm('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/rekap_data_pm_all',$data);  
	}
	
	function rekap_data_utd_all($id=NULL){

			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->getrekap_data_utd(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_utd('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_utd('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/rekap_data_utd_all',$data);  
	}
	
	function rekap_data_lab($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->getrekap_data_lab(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_lab('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->getrekap_data_lab('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/rekap_data_lab',$data);  
	}
	
	function monitoring_lab_all($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->monitoring_lab(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_lab('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_lab('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/monitoring_lab_all',$data);  
	}
	
	function monitoring_rs_all($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->monitoring_rs(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_rs('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_rs('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/monitoring_rs_all',$data);  
	}
	
	function monitoring_pm_all($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->monitoring_pm(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_pm('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_pm('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/monitoring_pm_all',$data);  
	}
	
	function monitoring_utd_all($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->monitoring_utd(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_utd('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_utd('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/monitoring_utd_all',$data);  
	}
	
	function monitoring_lab($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->monitoring_lab(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_lab('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_lab('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/monitoring_lab',$data);  
	}
	
	
	function monitoring_rs($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->monitoring_rs(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_rs('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_rs('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/monitoring_rs',$data);  
	}
	
	function monitoring_utd($id=NULL){
			
			$post = $this->input->post();
		    if(isset($_POST['cari']) && ($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10)){

			$data['data']['query'] = $this->registrasiusermodel->monitoring_utd(str_replace('/','-',$_POST['tgl1']),str_replace('/','-',$_POST['tgl2']),$_POST['id_prov'],$_POST['id_kota']);
			}
			
			if($this->session->userdata('id_kategori')==3  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_utd('','','',$this->session->userdata('id_kota')); 
			 }
			 
			 if($this->session->userdata('id_kategori')==2  ){
				 	$data['data']['query'] = $this->registrasiusermodel->monitoring_utd('','',$this->session->userdata('id_prov'),$_POST['id_kota']); 
			 }
 
			$this->template->utama('admin/monitoring_utd',$data);  
	}
	
	function laporan_detail_data_dasar_utd($id=NULL){

			$data['user']= $this->registrasiusermodel->getdatautd($id);
			$data['data']= $this->registrasiusermodel->getdatautd($id);	
 
			$this->template->utama('admin/laporan_detail_data_dasar_utd',$data);  
	}
	
	function laporan_detail_sdm_utd($id=NULL){

			$data['user']= $this->registrasiusermodel->getdatautd($id);
			$data['data']= $this->registrasiusermodel->getdatasdmutd($id);	
 
			$this->template->utama('admin/laporan_detail_sdm_utd',$data);  
	}
	
	function laporan_detail_sarpras_utd($id=NULL){

		$where = array('id_faskes' => $id);
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdatasarprasalkesutd($id);	
		$data['user']= $this->registrasiusermodel->getdatautd($id);
		$data['user_id']= $id;
 
			$this->template->utama('admin/laporan_detail_sarpras_utd',$data);  
	}
	
	function laporan_detail_alkes_utd($id=NULL){

	$where = array('id_faskes' => $id);
		$data['data2']= $this->registrasiusermodel->select_data('trans_final',$where)->result_array();
		$data['data']= $this->registrasiusermodel->getdataalkesutd($id);	
		$data['user']= $this->registrasiusermodel->getdatautd($id);
		$data['user_id']= $id;
 
			$this->template->utama('admin/laporan_detail_alkes_utd',$data);  
	}
	
		public function edit_profile($id=null){	
		$this->load->model('master/Sdmmodel');
		$data['id'] = $id;	
		$data['data'] = $this->registrasiusermodel->getprofile($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
			if($post['password_baru'] ==$post['confirm_password_baru']){
		$datas = array(
			    'kata_sandi' =>md5($post['password_baru'])
				);
				
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->registrasiusermodel->edit_data('registrasi_user',$where,$datas);
			}
				
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/index');
		}else{
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Password Tidak Sama!');
			redirect('dashboard/index');
		}
		
		}
			
		$this->template->utama('profile/edit_profile',$data);  
		
	}
	
	
	public function edit_profile_new($id=null){	
		$this->load->model('master/Sdmmodel');
		$data['id'] = $id;	
		$data['data'] = $this->registrasiusermodel->getprofile($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){

		$datas = array(
			    'nama_lengkap' =>$post['nama_lengkap'],
				'no_ktp' =>$post['no_ktp'],
				'tempat_lahir' =>$post['tempat_lahir'],
				'tgl_lahir' =>date('Y-m-d',strtotime($post['tgl_lahir'])),
				'no_hp' =>$post['no_hp'],
				'jabatan' =>$post['jabatan'],
				'alamat' =>$post['alamat'],
				'jenis_kelamin' =>$post['jenis_kelamin']		
				);
				
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->registrasiusermodel->edit_data('registrasi_user',$where,$datas);
			}
				
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/index');
		
		
		}
			
		$this->template->utama('profile/edit_profile_new',$data);  
		
	}
	
	function list_user_dinkes_kota($id=0){
	
			$data['data']['query'] = $this->registrasiusermodel->getlistdinkeskota($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'),$this->session->userdata('type_user'));
			$this->template->utama('admin/list_user_dinkes_kota',$data);  
	}
	
	function list_user_dinkes_kota_belum_validate($id=0){
	
			$data['data']['query'] = $this->registrasiusermodel->getlistdinkeskotabelumvaldate($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'),$this->session->userdata('type_user'));
			$this->template->utama('admin/list_user_dinkes_kota_belum_validate',$data);  
	}
	
	function list_user_dinkes_propinsi($id=0){
	
			$data['data']['query'] = $this->registrasiusermodel->getlistdinkespropinsi($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('admin/list_user_dinkes_propinsi',$data);  
	}
	
	function list_user_dinkes_propinsi_belum_validate($id=0){
	
			$data['data']['query'] = $this->registrasiusermodel->getlistdinkespropinsibelumvaldate($this->session->userdata('id_kategori'),$this->session->userdata('user_id'),$this->session->userdata('id_kota'),$this->session->userdata('id_prov'));
			$this->template->utama('admin/list_user_dinkes_propinsi_belum_validate',$data);  
	}
	
	
	
	
	
	public function tambah_user_dinkes_kota($id=null){	
		$data['id'] = $id;	
		$data['id_prov'] = $this->session->userdata('id_prov');
		$data['data'] = $this->registrasiusermodel->getprofile($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
			if($post['password_baru'] ==$post['confirm_password_baru']){
		$datas = array(
				'email' =>$post['email'],
			    'kata_sandi' =>md5($post['password_baru']),
			    'id_prov' => $this->session->userdata('id_prov'),
			    'id_kota' => $post['id_kota'],
			    'id_kategori' =>'3',
			    'validate' =>'2'
				);
				
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->registrasiusermodel->edit_data('registrasi_user',$where,$datas);
			}else{
			$this->registrasiusermodel->input_data('registrasi_user',$datas);	
			}
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/list_user_dinkes_kota');
		}else{
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Password Tidak Sama!');
			redirect('dashboard/list_user_dinkes_kota');
		}
		
		}
			
		$this->template->utama('admin/tambah_user_dinkes_kota',$data);  
		
	}
	
	public function tambah_user_dinkes_propinsi($id=null){	
		$data['id'] = $id;	
		$data['id_prov'] = $this->session->userdata('id_prov');
		$data['data'] = $this->registrasiusermodel->getprofile($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
			if($post['password_baru'] ==$post['confirm_password_baru']){
		$datas = array(
				'email' =>$post['email'],
			    'kata_sandi' =>md5($post['password_baru']),
			    'id_prov' => $post['propinsi'],
			    'id_kategori' =>'2',
			    'validate' =>'2'
				);
				
			if(!empty($post['id'])){
			$where = array(
			    'id' =>$post['id']
				);
			$this->registrasiusermodel->edit_data('registrasi_user',$where,$datas);
			}else{
			$this->registrasiusermodel->input_data('registrasi_user',$datas);	
			}
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/list_user_dinkes_propinsi');
		}else{
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Password Tidak Sama!');
			redirect('dashboard/list_user_dinkes_propinsi');
		}
		
		}
			
		$this->template->utama('admin/tambah_user_dinkes_propinsi',$data);  
		
	}
	
	
	public function tambah_user_dinkes_kota_belum_validasi($id=null){	

		if(!empty($id)){
			
		$datas = array(
			    'validate' =>'2'
				);
				
			$where = array(
			    'id' =>$id
				);
			$this->registrasiusermodel->edit_data('registrasi_user',$where,$datas);
		
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/list_user_dinkes_kota_belum_validate');
		
		
		}
			
		redirect('dashboard/list_user_dinkes_kota_belum_validate');
		
	}
	
	public function tambah_user_dinkes_propinsi_belum_validasi($id=null){	

		if(!empty($id)){
			
		$datas = array(
			    'validate' =>'2'
				);
				
			$where = array(
			    'id' =>$id
				);
			$this->registrasiusermodel->edit_data('registrasi_user',$where,$datas);
		
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/list_user_dinkes_propinsi_belum_validate');
		
		
		}
			
		redirect('dashboard/list_user_dinkes_propinsi_belum_validate');
		
	}
	
	function service_kirim_kode($kode,$nama,$jenis,$kota,$kode_lama,$jenis_klinik){
					$xid='mutukemenkes';
					$time=time();
					date_default_timezone_set('UTC');
				    $data_send='{"kodesatker":"'.$kode.'","namasatker":"'.$nama.'","jenis_satker":"'.$jenis.'","kodekota":"'.$kota.'","kodelama":"'.$kode_lama.'","jenis":"'.strtolower($jenis_klinik).'"}';
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
				  'kode_faskes' =>$this->registrasiusermodel->findNoFaskes($kode_regional_link,'5'),
				  'create_kode'=>date('Y-m-d H:i:s')
				  );
			$this->registrasiusermodel->edit_data('trans_final',$where_edit,$datas);
				
			
		$data['data']= $this->registrasiusermodel->getbylistpendaftaran($id);  
		$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
		$data['trans_final']= $this->registrasiusermodel->select_data('trans_final',$wheregetkodefaskes)->result_array();
		$email  = $data['data'][0]['email']; 
		$title   = "Registrasi Faskes"; 
		$message = "Yth,<br><br>
		".$data['data'][0]['nama_lengkap'].",
		<br><br>
		Selamat datang di Aplikasi Registrasi Faskes Online.<br>
		Kode Faskes Anda : ".$data['trans_final'][0]['kode_faskes']."
		<br><br>
		Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
		registrasi.fasyankes2@gmail.com<br>
		<br><br>
		Salam<br>
		Sekretariat Direktorat Jenderal Pelayanan Kesehatan"; 

		//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		$mail = $this->send_email("registrasifasyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","uLH0%RYL",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		
		$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'],$data['data'][0]['nama_klinik'],$data['data'][0]['jenis_satker'],$data['data'][0]['id_kota'],$data['trans_final'][0]['kode_faskes_lama'],$data['data'][0]['jenis_klinik_data_klinik']);

		if($mail){
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Kode Faskes Sudah Aktif');
			redirect(base_url("dashboard/verifikasikan_kirim/".$id.""));
		} 
	
			
 
		}else{
			$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Link Aktifasi Tidak Valid Atau Sudah Dipakai!');
			redirect(base_url("admin/index"));
		}
	}
	
	 public function tes_kirim($id=null){
		 $data['data']= $this->registrasiusermodel->getbylistpendaftaran($id);  
		$wheregetkodefaskes = array('id_faskes' => $data['data'][0]['id']);
		$data['trans_final']= $this->registrasiusermodel->select_data('trans_final',$wheregetkodefaskes)->result_array();
		$this->service_kirim_kode($data['trans_final'][0]['kode_faskes'],$data['data'][0]['nama_klinik'],$data['data'][0]['jenis_satker'],$data['data'][0]['id_kota'],$data['trans_final'][0]['kode_faskes_lama'],$data['data'][0]['jenis_klinik_data_klinik']);
		$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Kirim Data!');
			redirect('dashboard/list_user_yang_mengajukan');
	}
	 
	
	public function master_data_propinsi(){		
	   $this->load->model('master/Propinsimodel');	
	   
	   $data['data']['query'] = $this->Propinsimodel->get_list();
	
	   $this->template->utama('master_data/data_propinsi',$data);  
	}
	
	public function master_user_akses(){		
	   $this->load->model('master/Useraksesmodel');	
	   
	   $data['data']['query'] = $this->Useraksesmodel->get_list();
	
	   $this->template->utama('master_data/user_akses',$data);  
	}
	
	public function edit_user_akses($id=null){	
	
		$this->load->model('master/Useraksesmodel');
		$data['data'] = $this->Useraksesmodel->get_list_by_id($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
		
		$datas = array(
			    'type_user' =>$post['type_user']
				);
			$where = array(
			    'id' =>$post['id']
				);	
	
			$this->Useraksesmodel->edit_data('registrasi_user',$where,$datas);
		
				
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Edit Data!');
			redirect('dashboard/master_user_akses');
		}
			
		$this->template->utama('master_data/edit_user_akses',$data);  
		
	}
	
	public function tambah_master_data_propinsi($id=null){	
		$this->load->model('master/Propinsimodel');
		$data['data'] = $this->Propinsimodel->get_list_by_id($id);	
		$post = $this->input->post();
		if(isset($post['simpan'])){
		$datas = array(
			    'nama_prop' =>$post['nama_prop'],
				'status' => 'Aktif',
				'kode_regional' =>$post['kode_regional']
				);
				
			if(!empty($post['id_prop'])){
			$where = array(
			    'id_prop' =>$post['id_prop']
				);
			$this->Propinsimodel->edit_data('propinsi',$where,$datas);
			}else{
				
			$this->Propinsimodel->input_data('propinsi',$datas);
			$id = $this->db->insert_id();
			}
				
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('dashboard/master_data_propinsi');
		}
			
		$this->template->utama('master_data/tambah_master_data_propinsi',$data);  
		
	}
	
	
	
	public function hapus_master_data_propinsi($id=null){	
		$this->load->model('master/Propinsimodel');
		
		if(!empty($id)){
			$datas = array('status' =>'Non Aktif');
			$where = array('id_prop' =>$id);
			$this->Propinsimodel->edit_data('propinsi',$where,$datas);
			
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Hapus Data!');
			redirect('dashboard/master_data_propinsi');
		}
			
		$this->template->utama('master_data/data_propinsi',$data);  
		
	}
	
	public function hapus_user_dinkes_propinsi($id,$url){
		if(!empty($id)){
					$where = array(
						'id' => $id
						);
			$this->registrasiusermodel->delete_data('registrasi_user',$where);
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Di Hapus!');
		}
		redirect('dashboard/'.$url);
	}
	
	public function hapus_user_dinkes_kota($id,$url){
		if(!empty($id)){
					$where = array(
						'id' => $id
						);
			$this->registrasiusermodel->delete_data('registrasi_user',$where);
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Di Hapus!');
		}
		redirect('dashboard/'.$url);
	}
	
	public function hapus_pendaftaran_faskes($id,$url){
		if(!empty($id)){
		$data['data']= $this->registrasiusermodel->getbylistpendaftaran($id);  

		
					$where = array(
						'id' => $id
						);
			$this->registrasiusermodel->delete_data('registrasi_user',$where);
		
		
		
		$email  = $data['data'][0]['email']; 
		$title   = "Registrasi Faskes"; 
		$message = "Yth,<br><br>
		".$data['data'][0]['nama_lengkap'].",
		<br><br>
		Selamat datang di Aplikasi Registrasi Faskes Online.<br>
		Akun Anda Sudah Dihapus Oleh Dinkes Kota/Kabupaten.
		<br><br>
		Jika ada pertanyaan lebih lanjut, silahkan menghubungi:<br>
		registrasi.fasyankes2@gmail.com<br>
		<br><br>
		Salam<br>
		Sekretariat Direktorat Jenderal Pelayanan Kesehatan"; 		
		//$mail = $this->send_email("registrasi.fasyankes2@gmail.com","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","regfasyankes2022",$title,$email,$data['data'][0]['nama_lengkap'],$message);
		$mail = $this->send_email("registrasifasyankes@kemkes.go.id","Sekretariat Direktorat Jenderal Pelayanan Kesehatan","uLH0%RYL",$title,$email,$data['data'][0]['nama_lengkap'],$message);

				
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Di Hapus!, Pemberitahuan Akan Di Kirim Ke Email Yang Di Hapus.');
		}
		redirect('dashboard/'.$url);
	}
	
	
	function typeahead_namafasyankes(){
		//echo 'aa';
		 $q = $this->input->post('q');
		$max = $this->input->post('max_rows');
		if ($this->input->is_ajax_request()){
			$rsData = $this->registrasiusermodel->get_typeahead($q,$max);	
			echo json_encode($rsData);
		}
		return; 
	}
	
	
	
	
	
	
	
	
	

}