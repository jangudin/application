<?php
class Daftar extends CI_Controller{
 
	public function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->library('Grocery_CRUD');
		$this->load->model('Registerformatproposalheadermodel');
	}
	
	public function _example_output($output = null,$view=null)
	{
		$data_session = array('judul' => 'Daftar E-Proposal');
		$this->session->set_userdata($data_session);
		$data = (array)$output;
		$this->template->utama($view,$data);

	}
	

	public function index()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('user_id', $this->session->userdata('user_id'));
			$crud->set_table('daftar_proposal');
	        $crud->set_relation('kode_org','sdm_master_org','nama_org');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','dokumen','nominal_pembayaran','bukti_pembayaran','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			$crud->callback_after_insert(array($this, 'insert_log_proposal'));
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
			 $crud->set_field_upload('dokumen_final','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			$crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
			$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
		    $crud->display_as('kode_org','Lahan');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->unset_clone();
			//$crud->unset_read(); 
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		   if(isset($rsData[0]['jml']) && $rsData[0]['jml'] > 0){
			$crud->unset_add();
		   }
		   
		    $select2 = $ci->db->query("SELECT *  FROM `daftar_proposal` WHERE daftar_proposal.user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData2 = $select2->result_array();
		 
		   
		   if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 1 ){
			//$crud->unset_edit();
			$crud->required_fields('judul_proposal','tujuan','jenis_proposal','dokumen');
			$crud->unset_fields('nominal_pembayaran','status_text','status','bukti_pembayaran','pembimbing','kode_org','tanggal_izin_penelitian','dokumen_final');
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 2 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->unset_edit();
			$crud->unset_fields('nominal_pembayaran','status_text','status','bukti_pembayaran');
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 3 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->unset_fields('status','status_text');
			$crud->unset_edit();
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 4 ){
			//$crud->add_column('status_text');
			//$crud->callback_column('status_text',array($this,'showactionlink_evaluasi'));
			$crud->unset_fields('nominal_pembayaran','status','bukti_pembayaran');
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran','status');
			$crud->unset_edit();
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 5 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->unset_fields('status','status_text');
			$crud->unset_edit();
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 6 ){
			//$crud->add_column('status_text');
			//$crud->callback_column('status_text',array($this,'showactionlink_evaluasi'));
			$crud->unset_fields('nominal_pembayaran','status','bukti_pembayaran');
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran','status');
			$crud->unset_edit();
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 7 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->unset_fields('status','status_text','nominal_pembayaran');
			$crud->unset_edit();
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 8 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->unset_fields('status','status_text','nominal_pembayaran');
			$crud->unset_edit();
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 9 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->field_type('dokumen', 'readonly');
			$crud->field_type('pembimbing', 'readonly');
			$crud->field_type('kode_org', 'readonly');
			$crud->unset_fields('status','status_text','nominal_pembayaran','dokumen_final');
			
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 10 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->unset_fields('status','status_text','nominal_pembayaran');
			$crud->unset_edit();
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 11 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->unset_fields('status','status_text','nominal_pembayaran');
			$crud->unset_edit();
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 12 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->field_type('pembimbing', 'readonly');
			$crud->field_type('kode_org', 'readonly');
			$crud->field_type('bukti_pembayaran', 'readonly');
			$crud->field_type('dokumen', 'readonly');
			$crud->field_type('tanggal_izin_penelitian', 'readonly');
			$crud->unset_fields('status','status_text','nominal_pembayaran');
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }else{
			 $crud->unset_edit();
			$crud->field_type('status', 'hidden', 1);
			$crud->unset_columns('nominal_pembayaran');
			$crud->unset_fields('status_text','nominal_pembayaran','bukti_pembayaran','pembimbing','kode_org','tanggal_izin_penelitian','dokumen_final');
		   }
		   
		  /*  if(isset($rsData2[0]['status']) && $rsData2[0]['status'] != 3 && $rsData2[0]['status'] != 4 && $rsData2[0]['status'] != 5){
			$crud->unset_columns('bukti_pembayaran');
			$crud->unset_fields('bukti_pembayaran','status','status_text');
		   }
		   */
		   $crud->callback_column('judul_proposal', array($this, '_full_text'));
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_operations();
			$output = $crud->render();

			$this->_example_output($output,'daftar/index');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function insert_log_proposal($post_array,$primary_key)
	{
		
			   $ci = & get_instance();
			   $select = $ci->db->query("SELECT * FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
			   $rsData = $select->result_array();
			   
			   $ci2 = & get_instance();
			   $select2 = $ci2->db->query("SELECT * FROM `users` WHERE id='".$this->session->userdata('user_id')."'  ");
			   $rsData2= $select2->result_array();

	if($rsData[0]['status']=='1'){
			//start email notif daftar
					$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
					$subject = "".$rsData2[0]['nama_lengkap'].", Proposal Sudah Di Upload!";
					$txt ="Nama : ".$rsData2[0]['nama_lengkap']."<br>Email : ".$rsData2[0]['email']."<br>No Telepon/HP : ".$rsData2[0]['no_hp']."<br><br><br>Telah Meng Upload Proposal!, Untuk Proses Selanjutnya Harap Login Di http://rsuppersahabatan.co.id/eproposal/ Dan Kirim Ke KEPK"; 
					$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n"; //.
					$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
					//$headers .= "CC: susan@example.com\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					mail($to,$subject,$txt,$headers);
			//end email notif daftar			
			$nama_status="Peneliti Telah Mengupload Proposal";
	}
	
	 $data = array(
			'id_daftar_proposal' => $primary_key,
			'status' => $rsData[0]['status'],
			'nama_status' =>$nama_status
		);
		 $this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
	
    return;
 
 
	}
	
	

	
	 function showactionlink_daftarproposal($value,$row)
	{
		if($row->status == '1' ){
   	        $link = "<a onclick='javascript:return confirm(\"Yakin Di Kirim?\");' href='".base_url('daftar/kirim_proposal/kirim_data/'.$row->id)."'> ".$value."</a>";
   	    }else if($row->status == '2' ){
   	        $link ="".$value."";
   	    }else if($row->status == '3' ){
   	        $link = 'Menunggu Di Kaji Kelompok';
   	    }else if($row->status == '4' ){
   	        $link = "<a href='".base_url('daftar/evaluasi_kaji_kelompok/peneliti/'.$row->id.'/Kaji Kelompok')."'> Minta Di Evaluasi</a><br><a onclick='javascript:return confirm(\"Yakin Di Konfirm?\");' href='".base_url('daftar/kirim_proposal/konfirm_evaluasi/'.$row->id)."'>Sudah Di Evaluasi</a>";
   	    }else if($row->status == '5' ){
   	        $link = 'Menunggu Di Kaji Pleno';
   	    }else if($row->status == '6' ){
   	       $link = "<a href='".base_url('daftar/evaluasi_kaji_kelompok/peneliti/'.$row->id.'/Kaji Pleno')."'> Minta Di Evaluasi</a><br><a onclick='javascript:return confirm(\"Yakin Di Konfirm?\");' href='".base_url('daftar/kirim_proposal/konfirm_evaluasi_pleno/'.$row->id)."'>Sudah Di Evaluasi</a>";
   	    }else if($row->status == '7' ){
			/* if(!empty($row->bukti_pembayaran)){
			 $link = 'Harap Menunggu,<br>Bukti Pembayaran Akan Di periksa';	
			}else{
   	        $link = 'Harap Konfirm Bukti Pembayaran,<br>Posisi Proposal Di Ethical Clearance';
			} */
			$link = 'Menunggu Di Diklat';
   	    }else if($row->status == '8' ){
   	        $link = $row->status_text;
   	    }else if($row->status == '9' ){
   	        if(!empty($row->bukti_pembayaran)){
			 $link = 'Harap Menunggu,<br>Bukti Pembayaran Akan Di periksa';	
			}else{
   	        $link = 'Harap Konfirm Bukti Pembayaran,<br>Posisi Proposal Di Ethical Clearance';
			} 
   	    }else if($row->status == '10' ){
   	        $link = $row->status_text;
   	    }else if($row->status == '11' ){
   	        $link = $row->status_text;
   	    }else if($row->status == '12' ){
			 if(!empty($row->dokumen_final)){
			 $link = 'Penelitian telah Selesai, Dokumen Final Sudah Di Upload';	
			}else{
   	        $link = 'Penelitian telah Selesai, Harap Upload Dokumen Final';
			} 
   	    }else{
   	        $link = 'Sudah Dibayar';
		}
   	    return $link;
	}
	
	function kirim_proposal($status,$id)
	{
		if($status=='kirim_data'){
	
			$to = "".$this->session->userdata('email').",diklat_rsp@yahoo.com";
			$subject = "Proposal Sudah Dikirim Oleh Peneliti Dan Akan Di Validasi Oleh Kepk";
			$txt = "Hallo ".$this->session->userdata('nama').", Proposal Sudah Di Kirim Dan Akan Di Validasi Oleh Kepk, Mohon Ditunggu.";
			$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
			$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
			//$headers .= "CC: susan@example.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 2,`status_text` = 'Menunggu Persetujuan' WHERE `id` = '".$id."' ");
				  
				  	$data = array(
					'id_daftar_proposal' => $id,
					'status' => '2',
					'nama_status' =>'Peneliti Telah Mengirimkan Proposalnya Ke Kepk'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
				  //$rsData = $select->result_array();
				redirect(base_url("daftar"));
				}
			}else if($status=='konfirm_pembayaran'){
		
		    $to = "".$this->session->userdata('email')."";
			$subject = "data pembayaran akan di validasi";
			$txt = "Hallo ".$this->session->userdata('nama').", data pembayaran akan di validasi, Mohon Ditunggu.";
			$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 4 WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar"));
				}
			}else if($status=='konfirm_evaluasi'){
		
		    $to = "".$this->session->userdata('email').",diklat_rsp@yahoo.com";
			$subject = "Peneliti Sudah Mengirim Proposal Yang Sudah Di Evaluasinya. ";
			$txt = "Hallo ".$this->session->userdata('nama').", Proposal Akan Di Evaluasi Dan Akan Di Kaji Kelompok, Mohon Ditunggu.";
			$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
			$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
			//$headers .= "CC: susan@example.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 3 WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				  
				  	$data = array(
					'id_daftar_proposal' => $id,
					'status' => '3',
					'nama_status' =>'Peneliti Telah Mengevaluasi Proposalnya Untuk Di Kaji Kelompok Dan Mengirimnya Lagi.'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
				redirect(base_url("daftar"));
				}
		
			}else if($status=='konfirm_evaluasi_pleno'){
		
		    $to = "".$this->session->userdata('email').",diklat_rsp@yahoo.com";
			$subject = "Peneliti Sudah Mengirim Proposal Yang Sudah Di Evaluasinya. ";
			$txt = "Hallo ".$this->session->userdata('nama').", Proposal Akan Di Evaluasi Dan Akan Di Kaji Pleno, Mohon Ditunggu.";
			$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
			$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
			//$headers .= "CC: susan@example.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 5 WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				  
				  $data = array(
					'id_daftar_proposal' => $id,
					'status' => '5',
					'nama_status' =>'Peneliti Telah Mengevaluasi Proposalnya Untuk Di Kaji Pleno Dan Mengirimnya Lagi.'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
					
				redirect(base_url("daftar"));
				}
		
			}
		
		
	}
	
	
	
	
	public function list_daftar()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('daftar_proposal.status',2);
	
			$crud->set_table('daftar_proposal');
			$crud->order_by('daftar_proposal.status','ASC');
	        $crud->set_relation('user_id','users','username');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','user_id','dokumen','status_text');
	
			//$crud->callback_column('status',array($this,'showactionlink_daftarproposal'));
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
			$crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->add_action('Setujui', '', '','glyphicon glyphicon-ok',array($this,'setujui_proposal'));
	    	$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_setujuiproposal'));
			$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->field_type('judul_proposal', 'readonly');
		
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');

			$crud->field_type('user_id', 'readonly');
			//$crud->field_type('status', 'hidden', '2');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('user_id','Username');
			$crud->display_as('nominal_pembayaran','Yang Harus Dibayar');
			$crud->unset_clone();
			$crud->unset_add();
			  $crud->unset_fields('status_text','status','bukti_pembayaran','nominal_pembayaran');
			   $crud->unset_edit();
		/*    $ci = & get_instance();
		   $select2 = $ci->db->query("SELECT *  FROM `daftar_proposal` WHERE  daftar_proposal.status!='5'");
		   $rsData2 = $select2->result_array();
		   
		   if(isset($rsData2[0]['status']) && ($rsData2[0]['status'] == 2 )){
			//$crud->set_edit();
			 $crud->unset_fields('status_text','status','bukti_pembayaran');
			 $crud->unset_columns('bukti_pembayaran','status');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 3 ){
			 $crud->unset_edit();
			 $crud->unset_columns('bukti_pembayaran','status');
			  $crud->unset_fields('bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 4 ){
			 $crud->unset_edit();
			  $crud->unset_columns('status');
			 
		   }else{
			  // $crud->unset_edit(); 
			   $crud->unset_columns('status');
		   } */
		   
		  
		   
			//$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_operations();
			$output = $crud->render();
			

			$this->_example_output($output,'daftar/list_daftar');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
/* 	public function list_daftar_pembayaran()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');

			$crud->or_where('daftar_proposal.status',4);

			$crud->set_table('daftar_proposal');
			$crud->order_by('daftar_proposal.status','ASC');
	        $crud->set_relation('user_id','users','username');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','user_id','dokumen','nominal_pembayaran','bukti_pembayaran','status','status_text');
			//$crud->callback_column('status',array($this,'showactionlink_daftarproposal'));
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
			$crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->add_action('Setujui', '', '','glyphicon glyphicon-ok',array($this,'setujui_proposal'));
	    	$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_setujuiproposal'));
			$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->field_type('judul_proposal', 'readonly');
		
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');

			$crud->field_type('user_id', 'readonly');
			//$crud->field_type('status', 'hidden', '2');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('user_id','Username');
			$crud->display_as('nominal_pembayaran','Yang Harus Dibayar');
			$crud->unset_clone();
			$crud->unset_add();
			
		   $ci = & get_instance();
		   $select2 = $ci->db->query("SELECT *  FROM `daftar_proposal` WHERE  status!='5'");
		   $rsData2 = $select2->result_array();
		   
		   if(isset($rsData2[0]['status']) && ($rsData2[0]['status'] == 2 )){
			//$crud->set_edit();
			 $crud->unset_fields('status_text','status','bukti_pembayaran');
			 $crud->unset_columns('bukti_pembayaran','status');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 3 ){
			 $crud->unset_edit();
			 $crud->unset_columns('bukti_pembayaran','status');
			  $crud->unset_fields('bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 4 ){
			 $crud->unset_edit();
			  $crud->unset_columns('status');
			 
		   }else{
			   $crud->unset_edit(); 
			   $crud->unset_columns('status');
		   }
		   
		  
		   
			//$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_operations();
			$output = $crud->render();
			

			$this->_example_output($output,'daftar/list_daftar');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	 */
	
	public function list_kaji_kelompok()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');

			$crud->or_where('daftar_proposal.status',3);

			$crud->set_table('daftar_proposal');
			$crud->order_by('status','ASC');
	        $crud->set_relation('user_id','users','username');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','user_id','dokumen','dokumen_terbaru','status','status_text');
			//$crud->callback_column('status',array($this,'showactionlink_daftarproposal'));
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
			$crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->add_action('Setujui', '', '','glyphicon glyphicon-ok',array($this,'setujui_proposal'));
	    	$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_setujuiproposal'));
			$crud->set_field_upload('dokumen_terbaru','assets/uploads/daftar_proposal','pdf');
			$crud->callback_column('dokumen_terbaru',array($this,'showactionlinkdokumenterbaru'));
			$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->field_type('judul_proposal', 'readonly');
		
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');

			$crud->field_type('user_id', 'readonly');
			//$crud->field_type('status', 'hidden', '2');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('user_id','Username');
			$crud->display_as('nominal_pembayaran','Yang Harus Dibayar');
			$crud->unset_clone();
			$crud->unset_add();
			
		   $ci = & get_instance();
		   $select2 = $ci->db->query("SELECT *  FROM `daftar_proposal` WHERE  status!='5'");
		   $rsData2 = $select2->result_array();
		   
		   if(isset($rsData2[0]['status']) && ($rsData2[0]['status'] == 2 )){
			//$crud->set_edit();
			 $crud->unset_fields('status_text','status','bukti_pembayaran');
			 $crud->unset_columns('bukti_pembayaran','status');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 3 ){
			 $crud->unset_edit();
			 $crud->unset_columns('bukti_pembayaran','status');
			  $crud->unset_fields('bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 4 ){
			 $crud->unset_edit();
			  $crud->unset_columns('status');
			 
		   }else{
			   $crud->unset_edit(); 
			   $crud->unset_columns('status');
		   }
		   
		  
		   
			//$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_operations();
			$output = $crud->render();
			

			$this->_example_output($output,'daftar/list_daftar');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function showactionlinkdokumenterbaru($value,$row)
	{
		   $ci = & get_instance();
		   $select2 = $ci->db->query("SELECT *  FROM `evaluasi_proposal` WHERE  id_daftar_proposal='".$row->id."' AND dokumen_perbaikan !='' ORDER BY id DESC LIMIT 0,1");
		   $rsData2 = $select2->result_array();
		   if(!empty($rsData2)){
			$link = "<a target='_blank' href='".base_url('assets/uploads/daftar_proposal/'.$rsData2[0]["dokumen_perbaikan"])."'>".$rsData2[0]['dokumen_perbaikan']."</a>";
		   }else{
			  $link =""; 
		   }
            return $link; 
		   
		
	}
	
	
	public function list_kaji_pleno()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');

			$crud->or_where('daftar_proposal.status',5);

			$crud->set_table('daftar_proposal');
			$crud->order_by('status','ASC');
	        $crud->set_relation('user_id','users','username');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','user_id','dokumen','dokumen_terbaru','status','status_text');
			//$crud->callback_column('status',array($this,'showactionlink_daftarproposal'));
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
			$crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->add_action('Setujui', '', '','glyphicon glyphicon-ok',array($this,'setujui_proposal'));
	    	$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_setujuiproposal'));
			
			$crud->callback_column('dokumen_terbaru',array($this,'showactionlinkdokumenterbaru'));
			$crud->set_field_upload('dokumen_terbaru','assets/uploads/daftar_proposal','pdf');
			$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->field_type('judul_proposal', 'readonly');
		
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');

			$crud->field_type('user_id', 'readonly');
			//$crud->field_type('status', 'hidden', '2');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('user_id','Username');
			$crud->display_as('nominal_pembayaran','Yang Harus Dibayar');
			$crud->unset_clone();
			$crud->unset_add();
			
		   $ci = & get_instance();
		   $select2 = $ci->db->query("SELECT *  FROM `daftar_proposal` WHERE  status!='5'");
		   $rsData2 = $select2->result_array();
		   
		   
		   if(isset($rsData2[0]['status']) && ($rsData2[0]['status'] == 2 )){
			//$crud->set_edit();
			 $crud->unset_fields('status_text','status','bukti_pembayaran');
			 $crud->unset_columns('bukti_pembayaran','status');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 3 ){
			 $crud->unset_edit();
			 $crud->unset_columns('bukti_pembayaran','status');
			  $crud->unset_fields('bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 4 ){
			 $crud->unset_edit();
			  $crud->unset_columns('status');
			 
		   }else{
			   $crud->unset_edit(); 
			   $crud->unset_columns('status');
		   }
		   
		  
		   
			//$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_operations();
			$output = $crud->render();
			

			$this->_example_output($output,'daftar/list_daftar');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function list_ethical_clearance()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');

			$crud->or_where('daftar_proposal.status',7);
			$crud->or_where('daftar_proposal.status',8);
			$crud->or_where('daftar_proposal.status',9);
			
			$crud->set_table('daftar_proposal');
			$crud->order_by('status','ASC');
	        $crud->set_relation('user_id','users','username');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','user_id','dokumen','dokumen_terbaru','status','status_text');
			//$crud->callback_column('status',array($this,'showactionlink_daftarproposal'));
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
			$crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->add_action('Setujui', '', '','glyphicon glyphicon-ok',array($this,'setujui_proposal'));
	    	$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_setujuiproposal'));
				$crud->set_field_upload('dokumen_terbaru','assets/uploads/daftar_proposal','pdf');
			$crud->callback_column('dokumen_terbaru',array($this,'showactionlinkdokumenterbaru'));
			$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->field_type('judul_proposal', 'readonly');
		
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');

			$crud->field_type('user_id', 'readonly');
			//$crud->field_type('status', 'hidden', '2');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('user_id','Username');
			$crud->display_as('nominal_pembayaran','Yang Harus Dibayar');
			$crud->unset_clone();
			$crud->unset_add();
			
		   $ci = & get_instance();
		   $select2 = $ci->db->query("SELECT *  FROM `daftar_proposal` WHERE  status!='5'");
		   $rsData2 = $select2->result_array();
		   
		   if(isset($rsData2[0]['status']) && ($rsData2[0]['status'] == 2 )){
			//$crud->set_edit();
			 $crud->unset_fields('status_text','status','bukti_pembayaran');
			 $crud->unset_columns('bukti_pembayaran','status');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 3 ){
			 $crud->unset_edit();
			 $crud->unset_columns('bukti_pembayaran','status');
			  $crud->unset_fields('bukti_pembayaran');
		   }else if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 4 ){
			 $crud->unset_edit();
			  $crud->unset_columns('status');
			 
		   }else{
			   $crud->unset_edit(); 
			   $crud->unset_columns('status');
		   }
		   
		  
		   
			//$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_operations();
			$output = $crud->render();
			

			$this->_example_output($output,'daftar/list_daftar');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	public function monitoring_proposal()
	{
			try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			
			

			
			$crud->set_table('daftar_proposal');
			$crud->order_by('create_date','DESC');
	        $crud->set_relation('user_id','users','username');
			$crud->columns('create_date','judul_proposal','tujuan','user_id','dokumen','dokumen_terbaru','status_text','action');
			//$crud->callback_column('status',array($this,'showactionlink_daftarproposal'));
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
			$crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->add_action('Setujui', '', '','glyphicon glyphicon-ok',array($this,'setujui_proposal'));
	    	$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			//$crud->callback_column('status_text',array($this,'showactionlink_setujuiproposal'));
			$crud->callback_column('action',array($this,'showactionlink_log'));
			$crud->set_field_upload('dokumen_terbaru','assets/uploads/daftar_proposal','pdf');
			$crud->callback_column('dokumen_terbaru',array($this,'showactionlinkdokumenterbaru'));
			$crud->field_type('judul_proposal', 'readonly');
		
			$crud->field_type('tujuan', 'readonly');

			$crud->field_type('user_id', 'readonly');
			//$crud->field_type('status', 'hidden', '2');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('user_id','Username');
			$crud->display_as('nominal_pembayaran','Yang Harus Dibayar');
			$crud->unset_clone();
			$crud->unset_add();
			
		   $ci = & get_instance();
		   $select2 = $ci->db->query("SELECT *  FROM `daftar_proposal` WHERE  status!='5'");
		   $rsData2 = $select2->result_array();

		  
		   
			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_operations();
			$output = $crud->render();
			

			$this->_example_output($output,'daftar/monitoring_proposal_diklat');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function print_catatanhasil($id=NULL){
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT daftar_proposal.*,users.nama_lengkap  FROM `daftar_proposal` LEFT JOIN users ON daftar_proposal.user_id = users.id WHERE  daftar_proposal.id='".$id."'");
		   $data = $select->result_array();
		   $this->load->view('daftar/print_catatanhasil',array('data'=>$data));
	}
	
	
	
	
	function showNominalPembayaran($value, $row){

		$jml =  str_replace(",", ".",str_replace(".", "",(empty($row->nominal_pembayaran) ? 0 : $row->nominal_pembayaran)));
		return number_format($jml,0,',','.');
	}
	
	function showactionlink_setujuiproposal($value,$row)
	{
		if($row->status == '2' ){

   	        $link =  "<a onclick='javascript:return confirm(\"Yakin Ingin Disetujui?\");' href='".base_url('daftar/setujui_proposal/konfirm_proposal/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Setujui</a><br><a onclick='javascript:return confirm(\"Yakin Ingin Di Revisi?\");' href='".base_url('daftar/setujui_proposal/konfirm_tidak_setujui_proposal/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Revisi</a>" ;
   	    }/* else if($row->status == '3' ){
   	        $link = "".$value."";
   	    }else if($row->status == '4' ){
   	        $link = "<a onclick='javascript:return confirm(\"Yakin Ingin Disetujui?\");' href='".base_url('daftar/setujui_proposal/konfirm_pembayaran/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Setujui Pembayaran</a><br><a onclick='javascript:return confirm(\"Yakin Ingin Tidak Disetujui?\");' href='".base_url('daftar/setujui_proposal/konfirm_tidak_setujui_pembayaran/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Tidak Setujui Pembayaran</a>";
   	    }*/else if($row->status == '3' ){
   	         $link = "<a href='".base_url('daftar/evaluasi_kaji_kelompok/kepk/'.$row->id.'/Kaji Kelompok')."'> Lihat Evaluasi</a><br><a onclick='javascript:return confirm(\"Yakin Ingin Tidak Disetujui?\");' href='".base_url('daftar/setujui_proposal/upload_dokumen_perbaikan/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Minta Di Evaluasi</a><br><a onclick='javascript:return confirm(\"Yakin Ingin Tidak Disetujui?\");' href='".base_url('daftar/setujui_proposal/lanjut_ke_pleno/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Lanjut ke Kaji Pleno</a>";
   	    }else if($row->status == '5' ){
   	         $link = "<a href='".base_url('daftar/evaluasi_kaji_kelompok/kepk/'.$row->id.'/Kaji Pleno')."'> Lihat Evaluasi</a><br><a onclick='javascript:return confirm(\"Yakin Ingin Tidak Disetujui?\");' href='".base_url('daftar/setujui_proposal/upload_dokumen_perbaikan_pleno/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Minta Di Evaluasi</a><br><a onclick='javascript:return confirm(\"Yakin Ingin Disetujui?\");' href='".base_url('daftar/setujui_proposal/lanjut_ke_ethical/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Lanjut ke Dokumen Ethical Clearance</a>";
   	    }else if($row->status == '6' ){
   	        $link = "Data Sedang Di Perbaiki";
   	    }else{
   	        $link ="Sudah Selesai --> <a href='".base_url('daftar/print_catatanhasil/'.$row->id)."' target='_blank'>Print Catatan Hasil</a>";
		}
   	    return $link;
	}
	
	function evaluasi_kaji_kelompok($jenis,$id,$type_jenis){
		
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('id_daftar_proposal',$id);
			$crud->set_table('evaluasi_proposal');
			$crud->order_by('id','ASC');
			$crud->set_field_upload('dokumen_perbaikan','assets/uploads/daftar_proposal');
			$crud->field_type('type', 'hidden', urldecode($type_jenis));
			$crud->field_type('id_daftar_proposal', 'hidden', $id);
			if($jenis=='kepk'){
			$crud->columns('type','isi_evaluasi','status_evaluasi','dokumen_perbaikan','status_text');
			$crud->callback_column('status_text',array($this,'showactionlink_evaluasi'));
			$crud->unset_fields('dokumen_perbaikan');
			$view='daftar/list_daftar';
			}else{
			$crud->columns('type','isi_evaluasi','status_evaluasi','dokumen_perbaikan','status_text');
			$crud->callback_column('status_text',array($this,'showactionlink_evaluasi_peneliti'));
			$crud->unset_fields('isi_evaluasi','status_evaluasi');
			$crud->unset_delete();
			//$crud->unset_add();
			$view='daftar/index';
			}
			
			$crud->callback_column('isi_evaluasi', array($this, '_full_text'));

			
			
		   
		   $crud->unset_read();
	
			$crud->unset_clone();		
		    $ci = & get_instance();

			$output = $crud->render();
			

			$this->_example_output($output,$view);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	
	function _full_text($value, $row)
	{
		return $value = $value;
	}
	
	function showactionlink_evaluasi($value,$row){
		 $link = "<a href='".base_url('daftar/evaluasi_proposal_detail/kepk/'.$row->id.'/'.$row->type.'/'.$row->id_daftar_proposal)."'> Lihat Evaluasi Detail</a>";
   	   
   	    return $link;
	}
	
		function showactionlink_evaluasi_peneliti($value,$row){
		 $link = "<a href='".base_url('daftar/evaluasi_proposal_detail/peneliti/'.$row->id.'/'.$row->type.'/'.$row->id_daftar_proposal)."'> Lihat Evaluasi Detail</a>";
   	   
   	    return $link;
	}
	
	function setujui_proposal($status,$id,$user_id,$nominal_pembayaran)
	{
		  $ci = & get_instance();
		  $select2 = $ci->db->query("SELECT * FROM `users`  WHERE `id` = '".$user_id."' ");
		  $rsData2 = $select2->result_array();
		  
		if($status=='konfirm_proposal'){
				
				
				$jml = str_replace(",", ".",str_replace(".", "",$nominal_pembayaran));
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Proposal Anda Sudah Disetujui, Dan Status Proposal Anda Sedang Di Kaji Kelompok, Mohon Untuk Menunggu. Terim kasih";
				$txt = "Hallo ".$rsData2[0]['username'].", Proposal Anda Anda Sudah Disetujui, Dan Status Proposal Anda Sedang Di Kaji Kelompok, Mohon Untuk Menunggu. Terim kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n"; //.
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//	"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 3,`status_text` = 'Data Anda Disetujui, Menunggu Pembayaran' WHERE `id` = '".$id."' ");
				  
				  	$data = array(
					'id_daftar_proposal' => $id,
					'status' => '3',
					'nama_status' =>'Proposal Peniliti Sudah Disetujui, Status Proposal Peneliti Sedang Di Kaji Kelompok.'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_daftar"));
				}
		}else if($status=='konfirm_pembayaran'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Pembayaran Anda Sudah Diterima";
				$txt = "Hallo ".$rsData2[0]['username'].", Pembayaran Anda Sudah Dterima, Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 5,`status_text` = 'Pembayaran Anda Sudah Diterima' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_daftar_pembayaran"));
				}
		}else if($status=='konfirm_tidak_setujui_proposal'){
			
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Proposal Anda Tidak Disetujui/Revisi";
				$txt = "Hallo ".$rsData2[0]['username'].", Proposal Anda Tidak Disetujui, Mohon Diperiksa Ulang Atau Diperbaharui , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 1,`status_text` = 'Data Anda Tidak Disetujui/Revisi' WHERE `id` = '".$id."' ");
				  
				  	$data = array(
					'id_daftar_proposal' => $id,
					'status' => '1',
					'nama_status' =>'Proposal Tidak Disetujui, Kepk Telah Meminta Proposal Peneliti Untuk Di Revisi'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
					
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_daftar"));
				}
		}else if($status=='konfirm_tidak_setujui_pembayaran'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Data Pembayaran Anda Tidak Disetujui";
				$txt = "Hallo ".$rsData2[0]['username'].", Data Pembayaran Anda Tidak Disetujui, Mohon Diperiksa Ulang Atau Diperbaharui , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 3,`status_text` = 'Data Pembayaran Anda Tidak Disetujui' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_daftar_pembayaran"));
				}
		}else if($status=='upload_dokumen_perbaikan'){
			
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Proposal Perlu Di Evaluasi";
				$txt = "Hallo ".$rsData2[0]['username'].", Proposal Peneliti Yang Sedang Di Kaji Kelompok Perlu DI Evaluasi(Perbaikan), Detailnya Harap Dilihat Di http://rsuppersahabatan.co.id/eproposal/ , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 4,`status_text` = 'Data Perlu DI Evaluasi(Perbaikan)' WHERE `id` = '".$id."' ");
				  
				  	$data = array(
					'id_daftar_proposal' => $id,
					'status' => '4',
					'nama_status' =>'Proposal Perlu Di Evaluasi(Perbaikan), Kepk Telah Meminta Proposal Peneliti Yang Sedang Di Kaji Kelompok Untuk Di Evaluasi'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_kaji_kelompok"));
				}
		}else if($status=='lanjut_ke_pleno'){
			
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Hallo ".$rsData2[0]['username'].", Proposal Peneliti Telah Di Setujui Untuk Di Kaji Pleno, Mohon Untuk Menunggu , Terima Kasih.";
				$txt = "Hallo ".$rsData2[0]['username'].", Proposal Peneliti Telah Di Setujui Untuk Di Kaji Pleno, Mohon Untuk Menunggu , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 5,`status_text` = 'Data Sedang Dikaji Pleno' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				  
				  $data = array(
					'id_daftar_proposal' => $id,
					'status' => '5',
					'nama_status' =>'Proposal Peniliti Sudah Disetujui, Status Proposal Peneliti Sedang Di Kaji Pleno.'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
					
				redirect(base_url("daftar/list_kaji_kelompok"));
				}
		}else if($status=='upload_dokumen_perbaikan_pleno'){
			
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Proposal Perlu DI Evaluasi";
				$txt = "Hallo ".$rsData2[0]['username'].", Proposal Peneliti Yang Sedang Di Kaji Pleno Perlu DI Evaluasi(Perbaikan), Detailnya Harap Dilihat Di http://rsuppersahabatan.co.id/eproposal/ , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 6,`status_text` = 'Data Perlu DI Evaluasi(Perbaikan) Dari Pleno' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				  
				   $data = array(
					'id_daftar_proposal' => $id,
					'status' => '6',
					'nama_status' =>'Proposal Perlu Di Evaluasi(Perbaikan), Kepk Telah Meminta Proposal Peneliti Yang Sedang Di Kaji Pleno Untuk Di Evaluasi.'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
					
				redirect(base_url("daftar/list_kaji_pleno"));
				}
		}else if($status=='lanjut_ke_ethical'){
			
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Hallo ".$rsData2[0]['username'].", Proposal Peneliti Telah Di Setujui Untuk Di Ethical Clearance, Mohon Untuk Menunggu , Terima Kasih.";
				$txt = "Hallo ".$rsData2[0]['username'].", Proposal Peneliti Telah Di Setujui Untuk Di Kaji Pleno, Mohon Untuk Menunggu , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 7,`status_text` = 'Data Di Ethical Clearance' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				  
				   $data = array(
					'id_daftar_proposal' => $id,
					'status' => '7',
					'nama_status' =>'Proposal Peniliti Sudah Disetujui, Status Proposal Peneliti Sedang Di Ethical Clearance.'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
					
				redirect(base_url("daftar/list_kaji_pleno"));
				}
		}
		
		
	}
	
	
	public function list_pendaftaran_user()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->set_table('register_format_proposal_header');
			$crud->where('status_ok', 1);
			$crud->order_by('register_format_proposal_header.create_date','DESC');
			$crud->columns('bukti_bayar','nama','no_tlpn','create_date','email','action');
			$crud->callback_column('action',array($this,'showactionlink_pendaftaranuser'));
			$crud->callback_column('create_date',array($this,'showTanggal'));
		    $crud->set_field_upload('bukti_bayar','assets/uploads/bukti_pembayaran');
			
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('create_date','Tanggal Buat');
			$crud->display_as('no_tlpn','Nomor Telepon/Handphone');
			$crud->unset_clone();
			$crud->unset_read(); 
		 

			// $crud->unset_add_fields('status_text','nominal_pembayaran','bukti_pembayaran');
		   
		   
		  /*  if(isset($rsData2[0]['status']) && $rsData2[0]['status'] != 3 && $rsData2[0]['status'] != 4 && $rsData2[0]['status'] != 5){
			$crud->unset_columns('bukti_pembayaran');
			$crud->unset_fields('bukti_pembayaran','status','status_text');
		   }
		   */
		   
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_operations();
			$output = $crud->render();

			$this->_example_output($output,'daftar/list_pendaftaran_user');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function showactionlink_pendaftaranuser($value,$row)
	{
		
			if($row->status=='0'){
   	        $link = "<a  href='".base_url('daftar/list_pendaftaran_user_detail/'.$row->id)."'> Detail</a> | <a  href='".base_url('daftar/buat_user/'.$row->id.'/add')."'> Buat User</a>";
			}else{
			$link = "<a  href='".base_url('daftar/list_pendaftaran_user_detail/'.$row->id)."'> Detail</a> ";	
			}
   	   
   	    return $link;
	}
	
	
	public function list_pendaftaran_user_detail($id=NULL)
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('id_header', $id);
			$crud->set_table('register_format_proposal_detail');
			$crud->set_relation('id_proposal_awal','master_proposal_awal_penelitian','isi_proposal');
			$crud->columns('id_proposal_awal','ya','tidak','keterangan');
			$crud->unset_clone();
			$crud->unset_read(); 
		    $crud->limit('1000');
			$crud->callback_column('ya',array($this,'showStatusPendaftaran'));
			$crud->callback_column('tidak',array($this,'showStatusPendaftaran'));
			// $crud->unset_add_fields('status_text','nominal_pembayaran','bukti_pembayaran');
		   
		   
		  /*  if(isset($rsData2[0]['status']) && $rsData2[0]['status'] != 3 && $rsData2[0]['status'] != 4 && $rsData2[0]['status'] != 5){
			$crud->unset_columns('bukti_pembayaran');
			$crud->unset_fields('bukti_pembayaran','status','status_text');
		   }
		   */
		   
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_operations();
			$output = $crud->render();

			$this->_example_output($output,'daftar/list_pendaftaran_user_detail');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function showStatusPendaftaran($value, $row){

		$text =  ($value =='1' ? 'Ya' : ($value =='0' ? 'Tidak' : 'Tidak Di isi'));
		return $text;
	}
	
	function showTanggal($value, $row){

		$date =  date('d/m/Y H:i',strtotime($value));
		return $date;
	}
	
	public function buat_user($id=NULL,$action=NULL)
	{
		try{
			if($action=='success'){
				redirect(base_url("daftar/list_pendaftaran_user"));
			}
			
			/* 	if(empty($action)){
				redirect(base_url("daftar/list_pendaftaran_user"));
			} */

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			if(!empty($id)){
			$crud->where('id_register_format_header', $id);
			}
			$crud->set_table('users');
			//$crud->set_relation('id_proposal_awal','master_proposal_awal_penelitian','isi_proposal');
			$crud->columns('username','password');
			$crud->unique_fields(array('username'));
			$crud->change_field_type('password', 'password');
			$crud->required_fields('username','password');
			$crud->callback_add_field('password', function ($value, $primary_key) {
				return '<input type="text" placeholder="6 karakter minimal"  required  name="password" style="width:462px">';
			});
			$crud->callback_after_insert(array($this, 'update_register_format_proposal_buat_user'));
			$crud->callback_before_insert(array($this,'encrypt_password_callback'));
			$crud->callback_before_update(array($this,'encrypt_password_callback'));
			
			$crud->unset_clone();
			//$crud->unset_read(); 
		    $crud->limit('1000');
			//$crud->callback_column('ya',array($this,'showStatusPendaftaran'));
			//$crud->callback_column('tidak',array($this,'showStatusPendaftaran'));
			 $crud->unset_fields('email','deleted','nama_lengkap','nik','no_hp','tgl_lahir','create_date','level','bukti_bayar','status','kode_org');
			 
		    $crud->field_type('id_register_format_header', 'hidden', $id);
		   
		  /*  if(isset($rsData2[0]['status']) && $rsData2[0]['status'] != 3 && $rsData2[0]['status'] != 4 && $rsData2[0]['status'] != 5){
			$crud->unset_columns('bukti_pembayaran');
			$crud->unset_fields('bukti_pembayaran','status','status_text');
		   }
		   */
		   
			$crud->unset_delete();
			if(!isset($id) ){
				$crud->unset_add();
			}
			
			if(empty($action) ){
				$crud->unset_add();
			}
			//$crud->unset_edit();
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_operations();
			$output = $crud->render();

			$this->_example_output($output,'daftar/index');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function list_user_lahan()
	{
		try{
     		$crud = new grocery_CRUD();
			$crud->set_theme('flexigrid');
			$crud->where('level', 'lahan');
	
			$crud->set_table('users');
			$crud->columns('username','password');
		    $crud->set_relation('kode_org','sdm_master_org','nama_org');
			$crud->unique_fields(array('username'));
			$crud->change_field_type('password', 'password');
			$crud->required_fields('username','password');
			$crud->callback_add_field('password', function ($value, $primary_key) {
				return '<input type="text" placeholder="6 karakter minimal"  required  name="password" style="width:462px">';
			});
			$crud->callback_edit_field('password',array($this,'set_password_input_to_empty'));
			$crud->callback_add_field('password',array($this,'set_password_input_to_empty'));
			$crud->callback_after_insert(array($this, 'update_register_format_proposal'));
			$crud->callback_before_insert(array($this,'encrypt_password_callback'));
			$crud->callback_before_update(array($this,'encrypt_password_callback'));
			
			$crud->unset_clone();
			$crud->unset_fields('email','deleted','nama_lengkap','nik','no_hp','tgl_lahir','create_date','bukti_bayar','status','id_register_format_header');
			$crud->display_as('kode_org','Lahan');
		    $crud->field_type('level', 'hidden', 'lahan');
		   

		   


			$output = $crud->render();

			$this->_example_output($output,'daftar/index');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	
function set_password_input_to_empty() {
    return "<input type='password' name='password' value='' />";
}
	
	function encrypt_password_callback($post_array) {
   // $this->load->library('encrypt');
 //   $key = 'super-secret-key';
 
	$post_array['password_mentah'] = $post_array['password'];
    $post_array['password'] = md5($post_array['password']);
	
	
    return $post_array;
	}  
	
	function update_register_format_proposal($post_array,$primary_key)
	{

    $where = array('id' => $post_array['id_register_format_header']);
	 $data = array(
		'status' => 1
	);
	
    return $this->Registerformatproposalheadermodel->edit_data('register_format_proposal_header',$where,$data);
 
 
	}
	
	
	function update_register_format_proposal_buat_user($post_array,$primary_key)
	{
		
			   $ci = & get_instance();
			   $select = $ci->db->query("SELECT * FROM `register_format_proposal_header` WHERE id='".$post_array['id_register_format_header']."'  ");
			   $rsData = $select->result_array();

  	//start email notif daftar
				$to = "".$rsData[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "".$rsData[0]['nama']." Eproposal Anda Telah Dibuatkan User Akses!";
				$txt ="Nama : ".$rsData[0]['nama']."<br>Email : ".$rsData[0]['email']."<br>No Telepon/HP : ".$rsData[0]['no_tlpn']."<br><br><br>Telah Dibuatkan User Akses!, Untuk Proses Selanjutnya Harap Login Di http://rsuppersahabatan.co.id/eproposal/ Dengan Login Sebagai Berikut<br><br><br><b>Username :".$post_array['username']."</b><br><b>Password :".$post_array['password_mentah']."</b>"; 
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n"; //.
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				mail($to,$subject,$txt,$headers);
		//end email notif daftar		
		
	$where2 = array('id' => $primary_key);
	 $data2 = array(
		'email' => $rsData[0]['email'],
		'nama_lengkap' => $rsData[0]['nama'],
		'no_hp' => $rsData[0]['no_tlpn']
	);
	
   $this->Registerformatproposalheadermodel->edit_data('users',$where2,$data2);

    $where = array('id' => $post_array['id_register_format_header']);
	 $data = array(
		'status' => 1
	);
	
    return $this->Registerformatproposalheadermodel->edit_data('register_format_proposal_header',$where,$data);
 
 
	}
	

	
	function evaluasi_proposal_detail($type=NULL,$id=NULL,$jenis=NULL,$id_header=NULL){
 
	  //  $data['judul'] = "Register Format Proposal";
	
	    $post = $this->input->post();
		if(isset($post['submit'])){
							
			$where2 = array(
						'id_header' => $post["id_header"],
						'status_ok' => 1
						);
						
			$data2 = array(
					'status_ok' => 0
					);
			$this->Registerformatproposalheadermodel->edit_data('evaluasi_proposal_detail',$where2,$data2);

			foreach($post['id'] as $ids){

				$datas_detail = array(
			    'id_header' =>$post['id_header'],
				'id_evaluasi' => $ids,
				'ya' => (isset($post['pilihan'][$ids]) && $post['pilihan'][$ids]=='ya' ? 1 : (!empty($post['pilihan'][$ids]) ? 0 : NULL)),
				'tidak' => (isset($post['pilihan'][$ids]) && $post['pilihan'][$ids]=='tidak' ? 1 : (!empty($post['pilihan'][$ids]) ? 0 : NULL))
				);
				
		
			$this->Registerformatproposalheadermodel->input_data('evaluasi_proposal_detail',$datas_detail);
			}
		
		    $this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses!');
			redirect('daftar/evaluasi_kaji_kelompok/'.$post["type"].'/'.$post["id_head_header"].'/'.$post["jenis"].'');
		}
		
		$data['data3'] = array('type'=>$type,'id_header'=>$id,'jenis'=>$jenis,'id_head_header'=>$id_header);

		$where = array(
				'id_header' => $id,
				'status_ok' => 1
				);
		 $data['data2']= $this->Registerformatproposalheadermodel->select_data("evaluasi_proposal_detail",$where)->result_array();
		 $where = array(
				'status_ok' => 1,
				'jenis' => urldecode($jenis)
				);
		 $data['data']= $this->Registerformatproposalheadermodel->select_data("master_evaluasi",$where)->result_array();
		// var_dump($this->db->last_query());
	     $this->template->utama('daftar/evaluasi_proposal_detail',$data);
	
	}


	public function monitoring_proposal_diklat()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			
			

			
			$crud->set_table('daftar_proposal');
			$crud->order_by('create_date','DESC');
	        $crud->set_relation('user_id','users','username');
			$crud->columns('create_date','judul_proposal','tujuan','user_id','dokumen','dokumen_terbaru','status_text','action');
			//$crud->callback_column('status',array($this,'showactionlink_daftarproposal'));
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
			$crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->add_action('Setujui', '', '','glyphicon glyphicon-ok',array($this,'setujui_proposal'));
	    	$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			//$crud->callback_column('status_text',array($this,'showactionlink_setujuiproposal'));
			$crud->callback_column('action',array($this,'showactionlink_log'));
			$crud->field_type('judul_proposal', 'readonly');
					$crud->set_field_upload('dokumen_terbaru','assets/uploads/daftar_proposal','pdf');
			$crud->callback_column('dokumen_terbaru',array($this,'showactionlinkdokumenterbaru'));
			$crud->field_type('tujuan', 'readonly');

			$crud->field_type('user_id', 'readonly');
			//$crud->field_type('status', 'hidden', '2');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('user_id','Username');
			$crud->display_as('nominal_pembayaran','Yang Harus Dibayar');
			$crud->unset_clone();
			$crud->unset_add();
			
		   $ci = & get_instance();
		   $select2 = $ci->db->query("SELECT *  FROM `daftar_proposal` WHERE  status!='5'");
		   $rsData2 = $select2->result_array();

		  
		   
			$crud->unset_edit();
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_operations();
			$output = $crud->render();
			

			$this->_example_output($output,'daftar/monitoring_proposal_diklat');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	function showactionlink_log($value,$row)
	{
   	        $link =  "<a href='".base_url('daftar/list_log_proposal/'.$row->id)."'> List Log</a><br><a href='".base_url('daftar/list_evaluasi/'.$row->id)."'> List Evaluasi</a><br><a href='".base_url('daftar/list_kegiatan_peneliti_lahan/'.$row->id)."'> List Kegiatan Peneliti Di Lahan</a>" ;
   	    return $link;
	}
	
	
		function list_log_proposal($id){
		
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('id_daftar_proposal',$id);
			$crud->set_table('log_proposal');
			$crud->order_by('id','ASC');
			
			$crud->columns('nama_status','create_time');

			$view='daftar/list_monitoring';
			
				
			$crud->unset_operations();		
			$output = $crud->render();
			

			$this->_example_output($output,$view);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	
	
	function list_kegiatan_peneliti_lahan($id){
		
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('id_daftar_proposal',$id);
			$crud->set_table('monitoring_evaluasi');
			$crud->order_by('id','ASC');
			
			$crud->columns('keterangan_kegiatan','tanggal');

			$view='daftar/list_monitoring';
			
				
			$crud->unset_operations();		
			$output = $crud->render();
			

			$this->_example_output($output,$view);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	

		function list_evaluasi($id){
		
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('id_daftar_proposal',$id);
			$crud->set_table('evaluasi_proposal');
			$crud->order_by('id','ASC');
		    $crud->set_field_upload('dokumen_perbaikan','assets/uploads/daftar_proposal','pdf');
			$crud->columns('isi_evaluasi','status_evaluasi','dokumen_perbaikan','type','action');
			$crud->callback_column('action',array($this,'showactionlink_evaluasi_monitoring'));
			$view='daftar/list_monitoring';
			
				
			$crud->unset_operations();		
			$output = $crud->render();
			

			$this->_example_output($output,$view);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	
	function showactionlink_evaluasi_monitoring($value,$row){
		 $link = "<a href='".base_url('daftar/list_evaluasi_detail/'.$row->id.'/'.$row->type.'/'.$row->id_daftar_proposal)."'> Lihat Evaluasi Detail</a>";
   	   
   	    return $link;
	}
	

	
	function list_evaluasi_detail($id=NULL,$type=NULL,$id_header=NULL){
 
	  //  $data['judul'] = "Register Format Proposal";
	
		
		$data['data3'] = array('type'=>$type,'id_header'=>$id,'id_head_header'=>$id_header);

		$where = array(
				'id_header' => $id_header,
				'status_ok' => 1
				);
		 $data['data2']= $this->Registerformatproposalheadermodel->select_data("evaluasi_proposal_detail",$where)->result_array();
		 //var_dump($this->db->last_query());
		 $where = array(
				'status_ok' => 1,
				'jenis' => urldecode($type)
				);
		 $data['data']= $this->Registerformatproposalheadermodel->select_data("master_evaluasi",$where)->result_array();
		 
	     $this->template->utama('daftar/evaluasi_proposal_detail_monitoring',$data);
	
	}
	
	
	
}