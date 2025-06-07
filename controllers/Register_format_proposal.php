<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_format_proposal extends CI_Controller {

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
	 
	function __construct() {
		parent::__construct();
		
		if($this->session->userdata('status') == "login"){
			redirect(base_url("profile"));
		}
		
		$this->load->model('registerformatproposalheadermodel');		
	}
	
	public function index()
	{   
	    $data['judul'] = "Register Format Proposal";
	
	    $post = $this->input->post();
		if(isset($post['submit'])){
			
					
		$type = explode('.', $_FILES["bukti_bayar"]["name"]); // data file
		$type = strtolower($type[count($type)-1]); // data type like .jpg
		 //exit(dump($type));
		$filename="bukti_bayar".uniqid(rand()).'.'.$type;
		$inputFileName = "./assets/uploads/bukti_pembayaran/".$filename; // hash unik
				

		if(in_array($type, array("jpg", "jpeg","png","pdf"))) {
			if(is_uploaded_file($_FILES["bukti_bayar"]["tmp_name"])) {
				if(move_uploaded_file($_FILES["bukti_bayar"]["tmp_name"],$inputFileName)) {
			
			$datas = array(
			    'email' =>$post['email'],
				'bukti_bayar' => $filename,
				'nama' =>$post['nama'],
				'no_tlpn' =>$post['no_tlpn'],
				'upload_ke_jurnal' =>$post['upload_ke_jurnal']
				);
				
	
			$this->registerformatproposalheadermodel->input_data('register_format_proposal_header',$datas);
			$id = $this->db->insert_id();
			
			foreach($post['id'] as $ids){

				$datas_detail = array(
			    'id_header' =>$id,
				'id_proposal_awal' => $ids,
				'ya' => (isset($post['pilihan'][$ids]) && $post['pilihan'][$ids]=='ya' ? 1 : (!empty($post['pilihan'][$ids]) ? 0 : NULL)),
				'tidak' => (isset($post['pilihan'][$ids]) && $post['pilihan'][$ids]=='tidak' ? 1 : (!empty($post['pilihan'][$ids]) ? 0 : NULL)),
				'keterangan' => (isset($post['keterangan'][$ids]) ? $post['keterangan'][$ids] : NULL)
				);
			$this->registerformatproposalheadermodel->input_data('register_format_proposal_detail',$datas_detail);
			}

		}
		}else{
			$this->session->set_flashdata('kode_name', 'warning');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Upload Gagal!');
			redirect('register_format_proposal/index');
		}
		}else{
			$this->session->set_flashdata('kode_name', 'warning');
			$this->session->set_flashdata('icon_name', 'warning');
			$this->session->set_flashdata('message_name', 'Format Upload Bukti Pembayaran Salah!');
			redirect('register_format_proposal/index');
		}
		//start email notif daftar
				$to = "".$post['email'].",diklat_rsp@yahoo.com";
				$subject = "".$post['nama']." Telah Mendaftar Eproposal!";
				$txt ="Nama : ".$post['nama']."<br>Email : ".$post['email']."<br>No Telepon/HP : ".$post['no_tlpn']."<br>Telah Mendaftar!, Harap Diklat Buatkan Akun Untuk Proses Selanjutnya"; 
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n"; //.
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				mail($to,$subject,$txt,$headers);
		//end email notif daftar		
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Mendaftar!, Harap Menunggu Untuk Di Konfirmasi, Terima Kasih.');
			redirect('register_format_proposal/index');
		}
		
		$where = array(
				'status_ok' => 1
				);
		 $data= $this->registerformatproposalheadermodel->select_data("master_proposal_awal_penelitian",$where)->result_array();
	     $this->template->kedua('register_format_proposal/index',$data);
	}
	
	
	
}
