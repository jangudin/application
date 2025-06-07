<?php
class Kajikelompok extends CI_Controller{
 
	public function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		$this->load->library('Grocery_CRUD');
	}
	
	public function _example_output($output = null)
	{
		$data_session = array('judul' => 'Kaji Kelompok');
		$this->session->set_userdata($data_session);
		$data = (array)$output;
		$this->template->utama('kajikelompok/index',$data);

	}
	

	public function index()
	{
		
			
		try{

			$crud = new grocery_CRUD();
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."' AND status='5' ");
		   $rsData = $select->result_array();
		   if(isset($rsData[0]['jml']) && $rsData[0]['jml'] > 0){

			$crud->set_theme('flexigrid');
			$crud->where('user_id', $this->session->userdata('user_id'));
			$crud->set_table('daftar_proposal');
	
			$crud->columns('judul_proposal','tujuan','jenis_proposal','dokumen','nominal_pembayaran','bukti_pembayaran','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			$crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
			$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->unset_clone();
			$crud->unset_read(); 
		  
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		   if(isset($rsData[0]['jml']) && $rsData[0]['jml'] > 0){
			$crud->unset_add();
		   }
		   
		    $select2 = $ci->db->query("SELECT *  FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData2 = $select2->result_array();
		   if(isset($rsData2[0]['status']) && ( $rsData2[0]['status'] == 4 || $rsData2[0]['status'] == 5)){
			$crud->unset_edit();
		   }
		   
		   if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 1 ){
			//$crud->unset_edit();
			$crud->required_fields('judul_proposal','tujuan','jenis_proposal','dokumen');
			$crud->unset_fields('nominal_pembayaran','status_text','status','bukti_pembayaran');
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }
		   
		   if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 2 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->unset_edit();
			$crud->unset_fields('nominal_pembayaran','status_text','status','bukti_pembayaran');
			$crud->unset_columns('nominal_pembayaran','bukti_pembayaran');
		   }
		   
		   if(isset($rsData2[0]['status']) && $rsData2[0]['status'] == 3 ){
			$crud->field_type('nominal_pembayaran', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->unset_fields('status','status_text');
		   }
		   
		  /*  if(isset($rsData2[0]['status']) && $rsData2[0]['status'] != 3 && $rsData2[0]['status'] != 4 && $rsData2[0]['status'] != 5){
			$crud->unset_columns('bukti_pembayaran');
			$crud->unset_fields('bukti_pembayaran','status','status_text');
		   }
		   */
		   
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			//$crud->unset_operations();
		  
			$output = $crud->render();
			}else{
				$output="";
		    }
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	

	
	 function showactionlink_daftarproposal($value,$row)
	{
		if($row->status == '1' ){
   	        $link = "<a onclick='javascript:return confirm(\"Yakin Di Kirim?\");' href='".base_url('daftar/kirim_proposal/kirim_data/'.$row->id)."'> ".$value."</a>";
   	    }else if($row->status == '2' ){
   	        $link ="".$value."";
   	    }else if($row->status == '3' ){
   	        $link = "<a onclick='javascript:return confirm(\"Yakin Di Konfirm?\");' href='".base_url('daftar/kirim_proposal/konfirm_pembayaran/'.$row->id)."'>".$value."</a>";
   	    }else if($row->status == '4' ){
   	        $link = 'Menunggu Persetujuan Pembayaran';
   	    }else{
   	        $link = 'Sudah Dibayar';
		}
   	    return $link;
	}
	
	function kirim_proposal($status,$id)
	{
		if($status=='kirim_data'){
	
			$to = "".$this->session->userdata('email')."";
			$subject = "data sudah  di terima dan akan di validasi";
			$txt = "Hallo ".$this->session->userdata('nama').", data sudah  di terima dan akan di validasi, Mohon Ditunggu.";
			$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
			"CC: farizal28@gmail.com";

			if(mail($to,$subject,$txt,$headers)){
			
			  $ci = & get_instance();
			  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 2,`status_text` = 'Menunggu Persetujuan' WHERE `id` = '".$id."' ");
			  //$rsData = $select->result_array();
			redirect(base_url("daftar"));
			}
	}else if($status=='konfirm_pembayaran'){
		
		    $to = "".$this->session->userdata('email')."";
			$subject = "data pembayaran akan di validasi";
			$txt = "Hallo ".$this->session->userdata('nama').", data pembayaran akan di validasi, Mohon Ditunggu.";
			$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
			"CC: farizal28@gmail.com";

			if(mail($to,$subject,$txt,$headers)){
			
			  $ci = & get_instance();
			  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 4 WHERE `id` = '".$id."' ");
			  //$rsData = $select->result_array();
			redirect(base_url("daftar"));
			}
		
	}
		
		
	}
	
	
	
	
	public function list_daftar()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('status',2);
			$crud->or_where('status',3);
			$crud->or_where('status',4);
			$crud->or_where('status',5);
			$crud->set_table('daftar_proposal');
			$crud->order_by('status','desc');
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
			$crud->field_type('dokumen', 'readonly');
			$crud->field_type('bukti_pembayaran', 'readonly');
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
			

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function showNominalPembayaran($value, $row){

		$jml =  str_replace(",", ".",str_replace(".", "",(empty($row->nominal_pembayaran) ? 0 : $row->nominal_pembayaran)));
		return number_format($jml,0,',','.');
	}
	
	function showactionlink_setujuiproposal($value,$row)
	{
		if($row->status == '2' ){
   	        $link = "<a onclick='javascript:return confirm(\"Yakin Ingin Disetujui?\");' href='".base_url('daftar/setujui_proposal/konfirm_proposal/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Data Setujui</a><br><a onclick='javascript:return confirm(\"Yakin Ingin Disetujui?\");' href='".base_url('daftar/setujui_proposal/konfirm_tidak_setujui_proposal/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Data Tidak Setujui</a>";
   	    }else if($row->status == '3' ){
   	        $link = "".$value."";
   	    }else if($row->status == '4' ){
   	        $link = "<a onclick='javascript:return confirm(\"Yakin Ingin Disetujui?\");' href='".base_url('daftar/setujui_proposal/konfirm_pembayaran/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Setujui Pembayaran</a><br><a onclick='javascript:return confirm(\"Yakin Ingin Tidak Disetujui?\");' href='".base_url('daftar/setujui_proposal/konfirm_tidak_setujui_pembayaran/'.$row->id.'/'.$row->user_id.'/'.$row->nominal_pembayaran)."'> Tidak Setujui Pembayaran</a>";
   	    }else{
   	        $link = 'Sudah Di Bayar';
		}
   	    return $link;
	}
	
	function setujui_proposal($status,$id,$user_id,$nominal_pembayaran)
	{
		  $ci = & get_instance();
		  $select2 = $ci->db->query("SELECT * FROM `users`  WHERE `id` = '".$user_id."' ");
		  $rsData2 = $select2->result_array();
		  
		if($status=='konfirm_proposal'){
				
				
				  $jml = str_replace(",", ".",str_replace(".", "",$nominal_pembayaran));
				$to = "".$rsData2[0]['email']."";
				$subject = "data anda sudah di validasi dan sudah melakukan pembayaran";
				$txt = "Hallo ".$rsData2[0]['username'].", data anda sudah di validasi dan Silahkan Melakukan Pembayaran Sejumlah RP. ".number_format($jml,0,',','.')." Ke Nomer Rekening 292739438438 Bank Mandiri Atas nama rizal, Harap Bukti Pembayaran Di Upload Di Menu Daftar Proposal Di http://eproposal.rsuppersahabatan.co.id, Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
				"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 3,`status_text` = 'Data Anda Disetujui, Menunggu Pembayaran' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_daftar"));
				}
		}else if($status=='konfirm_pembayaran'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Pembayaran Anda Sudah Diterima";
				$txt = "Hallo ".$rsData2[0]['username'].", Pembayaran Anda Sudah Dterima, Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
				"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 5,`status_text` = 'Pembayaran Anda Sudah Diterima' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_daftar"));
				}
		}else if($status=='konfirm_tidak_setujui_proposal'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Data Anda Tidak Disetujui";
				$txt = "Hallo ".$rsData2[0]['username'].", Data Anda Tidak Disetujui, Mohon Diperiksa Ulang Atau Diperbaharui , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
				"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 1,`status_text` = 'Data Anda Tidak Disetujui' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_daftar"));
				}
		}else if($status=='konfirm_tidak_setujui_pembayaran'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Data Pembayaran Anda Tidak Disetujui";
				$txt = "Hallo ".$rsData2[0]['username'].", Data Pembayaran Anda Tidak Disetujui, Mohon Diperiksa Ulang Atau Diperbaharui , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
				"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 3,`status_text` = 'Data Pembayaran Anda Tidak Disetujui' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_daftar"));
				}
		}
		
		
	}
	
	
	
	
	
	
}