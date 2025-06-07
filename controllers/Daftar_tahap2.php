<?php
require_once "Daftar.php";

class Daftar_tahap2 extends Daftar{
 
	

	

	public function list_peneliti_kepk()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('daftar_proposal.status', 7);
			$crud->set_table('daftar_proposal');
	        $crud->set_relation('kode_org','sdm_master_org','nama_org');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','dokumen','nominal_pembayaran','kode_org','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
			//$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->unset_columns('nominal_pembayaran');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('kode_org','Lahan');
			$crud->unset_clone();
			//$crud->unset_read(); 
		   $crud->unset_edit_fields('judul_proposal','tujuan','jenis_proposal','tujuan','nominal_pembayaran','nominal_pembayaran','bukti_pembayaran','status_text','pembimbing','status','dokumen','user_id','create_date','dokumen_final');
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		 
		   
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_add();
			//$crud->unset_operations();
			$output = $crud->render();

			$this->_example_output($output,'daftar_tahap2/index');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function list_peneliti_di_lahan()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('daftar_proposal.status', 8);
			$crud->where('daftar_proposal.kode_org', $this->session->userdata('kode_org'));
			$crud->set_table('daftar_proposal');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','pembimbing','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->unset_columns('nominal_pembayaran');
			$crud->unset_edit_fields('nominal_pembayaran','status_text','bukti_pembayaran','status','jenis_proposal','tujuan','dokumen','judul_proposal','user_id','kode_org','dokumen_final','tanggal_izin_penelitian');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->unset_clone();
			//$crud->unset_read(); 
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		 
		   
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_add();
			$output = $crud->render();

			$this->_example_output($output,'daftar_tahap2/list_peneliti_di_lahan');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function list_peneliti_diklat()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('status', 9);
			$crud->set_table('daftar_proposal');
	
			$crud->columns('judul_proposal','tujuan','jenis_proposal','pembimbing','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
			//$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->unset_columns('nominal_pembayaran');
			$crud->unset_edit_fields('nominal_pembayaran','status_text','bukti_pembayaran','status','jenis_proposal','tujuan','dokumen','judul_proposal','user_id','create_date');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->unset_clone();
			//$crud->unset_read(); 
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		 
		   
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_add();
			$crud->unset_edit();
			$output = $crud->render();

			$this->_example_output($output,'daftar_tahap2/list_peneliti_diklat');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function list_peneliti_diklat_konfirm_bayar()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('status', 10);
			$crud->set_table('daftar_proposal');
	
			$crud->columns('judul_proposal','tujuan','jenis_proposal','pembimbing','tanggal_izin_penelitian','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
			//$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->unset_columns('nominal_pembayaran');
			$crud->unset_edit_fields('nominal_pembayaran','status_text','bukti_pembayaran','status','user_id','create_date','dokumen_final');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('dokumen', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('pembimbing', 'readonly');
			$crud->field_type('kode_org', 'readonly');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('tanggal_izin_penelitian','Tanggal Kirim');
			
			$crud->unset_clone();
			//$crud->unset_read(); 
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		 
		   
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_add();
			$output = $crud->render();

			$this->_example_output($output,'daftar_tahap2/list_peneliti_diklat');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function list_peneliti_yang_praktek()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('status', 11);
			$crud->set_table('daftar_proposal');
	
			$crud->columns('judul_proposal','tujuan','jenis_proposal','pembimbing','tanggal_izin_penelitian','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
			//$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->unset_columns('nominal_pembayaran');
			$crud->unset_edit_fields('nominal_pembayaran','status_text','bukti_pembayaran','status','user_id','create_date');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('dokumen', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('pembimbing', 'readonly');
			$crud->field_type('kode_org', 'readonly');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('tanggal_izin_penelitian','Tanggal Kirim');
			$crud->unset_clone();
			//$crud->unset_read(); 
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		 
		   $crud->unset_edit(); 
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_add();
			$output = $crud->render();

			$this->_example_output($output,'daftar_tahap2/list_peneliti_yang_praktek');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	public function list_peneliti_yang_praktek_lahan()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('status', 11);
			$crud->set_table('daftar_proposal');
	
			$crud->columns('judul_proposal','tujuan','jenis_proposal','pembimbing','tanggal_izin_penelitian','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
			//$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->unset_columns('nominal_pembayaran');
			$crud->unset_edit_fields('nominal_pembayaran','status_text','bukti_pembayaran','status','user_id','create_date');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('dokumen', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('pembimbing', 'readonly');
			$crud->field_type('kode_org', 'readonly');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('tanggal_izin_penelitian','Tanggal Kirim');
			$crud->unset_clone();
			//$crud->unset_read(); 
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		 
		   $crud->unset_edit(); 
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_add();
			$output = $crud->render();

			$this->_example_output($output,'daftar_tahap2/list_peneliti_di_lahan');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function list_monitor_evaluasi($id){
		
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('id_daftar_proposal',$id);
			$crud->set_table('monitoring_evaluasi');
			$crud->order_by('id','ASC');
			$crud->field_type('id_daftar_proposal', 'hidden', $id);

			$crud->columns('keterangan_kegiatan','tanggal');
			$crud->unset_fields('dokumen_perbaikan');
			$view='daftar_tahap2/list_monitor_evaluasi';
	
			
		   
		 //  $crud->unset_read();
	
			$crud->unset_clone();		
		    $ci = & get_instance();

			$output = $crud->render();
			

			$this->_example_output($output,$view);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	
	
	public function list_peneliti_yang_selesai()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('status', 12);
			$crud->set_table('daftar_proposal');
	
			$crud->columns('judul_proposal','tujuan','jenis_proposal','pembimbing','tanggal_izin_penelitian','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			 $crud->set_field_upload('dokumen_final','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
			//$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->unset_columns('nominal_pembayaran');
			$crud->unset_edit_fields('nominal_pembayaran','status_text','bukti_pembayaran','status','user_id','create_date');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('dokumen', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('pembimbing', 'readonly');
			$crud->field_type('kode_org', 'readonly');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('tanggal_izin_penelitian','Tanggal Kirim');
			$crud->unset_clone();
			//$crud->unset_read(); 
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		 
		   $crud->unset_edit(); 
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_add();
			$output = $crud->render();

			$this->_example_output($output,'daftar_tahap2/list_peneliti_yang_praktek');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function list_peneliti_yang_selesai_lahan()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->where('status', 12);
			$crud->set_table('daftar_proposal');
	
			$crud->columns('judul_proposal','tujuan','jenis_proposal','pembimbing','tanggal_izin_penelitian','status_text');
			
			//$crud->add_action('Kirim', '', '','glyphicon glyphicon-ok',array($this,'kirim_proposal'));
			$crud->callback_column('nominal_pembayaran',array($this,'showNominalPembayaran'));
			$crud->callback_column('status_text',array($this,'showactionlink_daftarproposal'));
			 $crud->set_field_upload('dokumen_final','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('dokumen','assets/uploads/daftar_proposal','pdf');
		    $crud->set_field_upload('bukti_pembayaran','assets/uploads/bukti_pembayaran');
			//$crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
			//$crud->field_type('create_date', 'hidden', date('Y-m-d H:i:s'));
			$crud->unset_columns('nominal_pembayaran');
			$crud->unset_edit_fields('nominal_pembayaran','status_text','bukti_pembayaran','status','user_id','create_date');
			$crud->field_type('jenis_proposal', 'readonly');
			$crud->field_type('tujuan', 'readonly');
			$crud->field_type('dokumen', 'readonly');
			$crud->field_type('judul_proposal', 'readonly');
			$crud->field_type('pembimbing', 'readonly');
			$crud->field_type('kode_org', 'readonly');
			$crud->display_as('dokumen','Dokument *PDF');
			$crud->display_as('tanggal_izin_penelitian','Tanggal Kirim');
			$crud->unset_clone();
			//$crud->unset_read(); 
		   $ci = & get_instance();
		   $select = $ci->db->query("SELECT COUNT(*) AS jml FROM `daftar_proposal` WHERE user_id='".$this->session->userdata('user_id')."'  ");
		   $rsData = $select->result_array();
		 
		   $crud->unset_edit(); 
			$crud->unset_delete();
			$crud->unset_export();
			$crud->unset_print();
			$crud->unset_add();
			$output = $crud->render();

			$this->_example_output($output,'daftar_tahap2/list_peneliti_di_lahan');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	
	
	
	

	
	 function showactionlink_daftarproposal($value,$row)
	{
		if($row->status == '1' ){
   	        $link = "<a onclick='javascript:return confirm(\"Yakin Di Kirim?\");' href='".base_url('daftar/kirim_proposal2/kirim_data/'.$row->id)."'> ".$value."</a>";
   	    }else if($row->status == '2' ){
   	        $link ="".$value."";
   	    }else if($row->status == '3' ){
   	        $link = 'Menunggu Di Kaji Kelompok';
   	    }else if($row->status == '4' ){
   	        $link = "<a href='".base_url('daftar/evaluasi_kaji_kelompok/peneliti/'.$row->id.'/Kaji Kelompok')."'> Minta Di Evaluasi</a><br><a onclick='javascript:return confirm(\"Yakin Di Konfirm?\");' href='".base_url('daftar/kirim_proposal2/konfirm_evaluasi/'.$row->id)."'>Sudah Di Evaluasi</a>";
   	    }else if($row->status == '5' ){
   	        $link = 'Menunggu Di Kaji Pleno';
   	    }else if($row->status == '6' ){
   	       $link = "<a href='".base_url('daftar/evaluasi_kaji_kelompok/peneliti/'.$row->id.'/Kaji Pleno')."'> Minta Di Evaluasi</a><br><a onclick='javascript:return confirm(\"Yakin Di Konfirm?\");' href='".base_url('daftar/kirim_proposal2/konfirm_evaluasi_pleno/'.$row->id)."'>Sudah Di Evaluasi</a>";
   	    }else if($row->status == '7' ){
			/* if(!empty($row->bukti_pembayaran)){
			 $link = "<a href='".base_url('daftar_tahap2/konfirm_bukti_pembayaran/'.$row->id)."' onclick='javascript:return confirm(\"Yakin Di Konfirm?\");'> Konfirm Bukti Pembayaran<br>Dan Kirim Ke Lahan</a>";	
			}else{
   	        $link = 'Menunggu Bukti Pembayaran';
			} */
			 if(!empty($row->kode_org)){
			 $link = "<a href='".base_url('daftar_tahap2/konfirm_lahan/'.$row->id.'/'.$row->user_id.'/')."' onclick='javascript:return confirm(\"Yakin Di Kirim?\");'> Kirim Ke Lahan</a>";	
			}else{
   	        $link = 'Menunggu Lahan';
			}
   	    }else if($row->status == '8' ){
			if(!empty($row->pembimbing)){
			 $link = "<a href='".base_url('daftar_tahap2/kirim_proposal2/kirim_diklat_dari_lahan/'.$row->id.'/'.$row->user_id.'/')."' onclick='javascript:return confirm(\"Yakin Di Konfirm?\");'> Kirim Ke Diklat</a>";	
			 }else{
   	        $link = 'Harap Input Pembimbing';
			}
   	    }else if($row->status == '9' ){
			 if(!empty($row->bukti_pembayaran)){
			 $link = "<a href='".base_url('daftar_tahap2/konfirm_bukti_pembayaran/'.$row->id.'/'.$row->user_id.'/')."' onclick='javascript:return confirm(\"Yakin Di Konfirm?\");'> Konfirm Bukti Pembayaran</a>";	
			}else{
   	        $link = 'Menunggu Bukti Pembayaran';
			} 
   	    }else if($row->status == '10' ){
			 if(!empty($row->tanggal_izin_penelitian)){
			 $link = "<a href='".base_url('daftar_tahap2/konfirm_mou/'.$row->id.'/'.$row->user_id.'/')."' onclick='javascript:return confirm(\"Yakin Di Konfirm?\");'> Konfirm MOU Sudah Selesai</a>";	
			}else{
   	        $link = 'Menunggu Izin Penelitian';
			} 
   	    }else if($row->status == '11' ){
			 $link = "<a href='".base_url('daftar_tahap2/list_monitor_evaluasi/'.$row->id)."' > Monitoring Evaluasi Harian</a><br><a href='".base_url('daftar_tahap2/selesaikan/'.$row->id.'/'.$row->user_id.'/')."' onclick='javascript:return confirm(\"Yakin Di Selesaikan?\");'> Selesaikan</a>";	
			
   	    }else if($row->status == '12' ){
		
			 if(!empty($row->dokumen_final)){
			 $link = 'Penelitian telah Selesai, Dokumen Final Sudah Di Upload';	
			}else{
   	        $link = 'Penelitian telah Selesai, Dokumen Final Belum Di Upload';
			} 
			
   	    }else{
   	        $link = 'Sudah Dibayar';
		}
   	    return $link;
	}
	
	function konfirm_bukti_pembayaran($id=null,$user_id=null){
		
				  $ci = & get_instance();
				  $select2 = $ci->db->query("SELECT * FROM `users`  WHERE `id` = '".$user_id."' ");
				  $rsData2 = $select2->result_array();
				  
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Hallo ".$rsData2[0]['username'].", Pembayaran Sudah Di Konfirmasi!";
				$txt = "Hallo ".$rsData2[0]['username'].", Pembayaran Sudah Di Konfirmasi Dan Selanjutnya Proses MOU, Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
			if(mail($to,$subject,$txt,$headers)){
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 10,`status_text` = 'Pembayaran Di Konfirmasi Oleh Diklat Dan Selanjutnya Proses MOU' WHERE `id` = '".$id."' ");
				  
				   
				   	$data = array(
					'id_daftar_proposal' => $id,
					'status' => '10',
					'nama_status' =>'Pembayaran Sudah Di Konfirmasi Oleh Diklat Dan Selanjutnya Proses MOU.'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
					
				  redirect(base_url("daftar_tahap2/list_peneliti_diklat"));
		    }
	}
	
	function konfirm_lahan($id=null,$user_id=null){
				  $ci = & get_instance();
				  $select2 = $ci->db->query("SELECT * FROM `users`  WHERE `id` = '".$user_id."' ");
				  $rsData2 = $select2->result_array();
				  
				  $ci2 = & get_instance();
				  $select3 = $ci2->db->query("SELECT sdm_master_org.nama_org FROM `daftar_proposal` INNER JOIN sdm_master_org ON daftar_proposal.kode_org = sdm_master_org.kode_org   WHERE daftar_proposal.`id` = '".$id."' ");
				  $rsData3 = $select3->result_array();
		  
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Hallo ".$rsData2[0]['username'].", Lahan Telah Ditentukan Oleh Diklat , Terima Kasih.";
				$txt = "Hallo ".$rsData2[0]['username'].", Lahan Telah Ditentukan Oleh Diklat, Lahan Anda Adalah ".$rsData3[0]['nama_org']." , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 8,`status_text` = 'Dikirim Ke Lahan, Lahan Anda Adalah ".$rsData3[0]['nama_org']."' WHERE `id` = '".$id."' ");
				  
				   	$data = array(
					'id_daftar_proposal' => $id,
					'status' => '8',
					'nama_status' =>'Lahan Telah Ditentukan Oleh Diklat, Lahannya Adalah '.$rsData3[0]["nama_org"].''
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
					
				  redirect(base_url("daftar_tahap2/list_peneliti_kepk"));
				 }
	}
	
	function konfirm_mou($id=null,$user_id=null){
				  $ci = & get_instance();
				  $select2 = $ci->db->query("SELECT * FROM `users`  WHERE `id` = '".$user_id."' ");
				  $rsData2 = $select2->result_array();
				  
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Hallo ".$rsData2[0]['username'].", Tgl Izin Penelitian Sudah Ditentukan Oleh Diklat Dan MOU Sudah Selesai, Terima Kasih.";
				$txt = "Hallo ".$rsData2[0]['username'].", Tgl Izin Penelitian Sudah Ditentukan Oleh Diklat Dan MOU Sudah Selesai, Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 11,`status_text` = 'Tgl Izin Penelitian Sudah Ditentukan Oleh Diklat Dan MOU Sudah Selesai' WHERE `id` = '".$id."' ");
				  
				    $data = array(
					'id_daftar_proposal' => $id,
					'status' => '11',
					'nama_status' =>'Tgl Izin Penelitian Sudah Ditentukan Oleh Diklat Dan MOU Sudah Selesai'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
					
				  redirect(base_url("daftar_tahap2/list_peneliti_diklat_konfirm_bayar"));
				 }
	}
	
	function selesaikan($id=null,$user_id=null){
				$ci = & get_instance();
			    $select2 = $ci->db->query("SELECT * FROM `users`  WHERE `id` = '".$user_id."' ");
			    $rsData2 = $select2->result_array();
				  
				$to = "".$rsData2[0]['email'].",diklat_rsp@yahoo.com";
				$subject = "Hallo ".$rsData2[0]['username'].",Penelitian Anda Sudah Selesai, Harap Upload File Dokumen Final Anda Terima Kasih.";
				$txt = "Hallo ".$rsData2[0]['username'].", Penelitian Anda Sudah Selesai, Harap Upload File Dokumen Final Anda Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
				$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 12,`status_text` = 'Penelitian Telah Selesai, Harap Upload File Dokumen Final Anda.' WHERE `id` = '".$id."' ");
				  
				   $data = array(
					'id_daftar_proposal' => $id,
					'status' => '12',
					'nama_status' =>'Penelitian Telah Selesai, Harap Upload File Dokumen Final Anda.'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
					
					
				  if($this->session->userdata('level')=='lahan'){
					  redirect(base_url("daftar_tahap2/list_peneliti_yang_praktek_lahan"));  
				  }else{
					  redirect(base_url("daftar_tahap2/list_peneliti_yang_praktek"));
				  }
				}
	}
	
	
	
	function kirim_proposal2($status,$id,$user_id)
	{
		if($status=='kirim_diklat_dari_lahan'){
			
			$ci2 = & get_instance();
		    $select3 = $ci2->db->query("SELECT * FROM `daftar_proposal`   WHERE daftar_proposal.`id` = '".$id."' ");
		    $rsData3 = $select3->result_array();
	
			$to = "".$this->session->userdata('email').",diklat_rsp@yahoo.com";
			$subject = "Pembimbing Sudah Di Pilih, Dan Data Sudah Dikirim Ke Diklat Untuk Proses Pembayaran";
			$txt = "Hallo ".$this->session->userdata('nama').", Pembimbing Sudah Ditentukan, Pembimbing Anda Adalah ".$rsData3[0]['pembimbing']."  Dan Proposal Sudah Dikirim Ke Diklat Untuk Proses Pembayaran.";
			$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n";
			$headers .= "Reply-To: diklat_rsp@yahoo.com" . "\r\n";
			//$headers .= "CC: susan@example.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 9,`status_text` = 'Pembimbing Sudah Ditentukan, Pembimbing Anda Adalah ".$rsData3[0]['pembimbing']." Dan Proposal Sudah Dikirim Ke Diklat' WHERE `id` = '".$id."' ");
				  
				  	$data = array(
					'id_daftar_proposal' => $id,
					'status' => '9',
					'nama_status' =>'Pembimbing Sudah Ditentukan, Pembimbing Peneliti Adalah '.$rsData3[0]["pembimbing"].' Dan Proposal Sudah Dikirim Ke Diklat Untuk Proses Pembayaran'
					);
					
					$this->Registerformatproposalheadermodel->input_data('log_proposal',$data);
				  //$rsData = $select->result_array();
				redirect(base_url("daftar_tahap2/list_peneliti_di_lahan"));
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
			$crud->columns('judul_proposal','tujuan','jenis_proposal','user_id','dokumen','status','status_text');
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
	
	
	public function list_kaji_pleno()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');

			$crud->or_where('daftar_proposal.status',5);

			$crud->set_table('daftar_proposal');
			$crud->order_by('status','ASC');
	        $crud->set_relation('user_id','users','username');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','user_id','dokumen','status','status_text');
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
	
	public function list_ethical_clearance()
	{
		try{

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');

			$crud->or_where('daftar_proposal.status',7);
			
			$crud->set_table('daftar_proposal');
			$crud->order_by('status','ASC');
	        $crud->set_relation('user_id','users','username');
			$crud->columns('judul_proposal','tujuan','jenis_proposal','user_id','dokumen','status','status_text');
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
   	    }else if($row->status == '7' ){
   	        $link = "";
   	    }else{
   	        $link = 'Sudah Di Bayar';
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
			$crud->unset_add();
			$view='daftar/index';
			}
			
		   
		   $crud->unset_read();
	
			$crud->unset_clone();		
		    $ci = & get_instance();

			$output = $crud->render();
			

			$this->_example_output($output,$view);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
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
				redirect(base_url("daftar/list_daftar_pembayaran"));
				}
		}else if($status=='konfirm_tidak_setujui_proposal'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Data Anda Tidak Disetujui/Revisi";
				$txt = "Hallo ".$rsData2[0]['username'].", Data Anda Tidak Disetujui, Mohon Diperiksa Ulang Atau Diperbaharui , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
				"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 1,`status_text` = 'Data Anda Tidak Disetujui/Revisi' WHERE `id` = '".$id."' ");
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
				redirect(base_url("daftar/list_daftar_pembayaran"));
				}
		}else if($status=='upload_dokumen_perbaikan'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Data Perlu DI Evaluasi";
				$txt = "Hallo ".$rsData2[0]['username'].", Data Perlu DI Evaluasi(Perbaikan) , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
				"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 4,`status_text` = 'Data Perlu DI Evaluasi(Perbaikan)' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_kaji_kelompok"));
				}
		}else if($status=='lanjut_ke_pleno'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Data Di Kaji Pleno";
				$txt = "Hallo ".$rsData2[0]['username'].", Data Sedang Dikaji Pleno , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
				"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 5,`status_text` = 'Data Sedang Dikaji Pleno' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_kaji_kelompok"));
				}
		}else if($status=='upload_dokumen_perbaikan_pleno'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Data Perlu DI Evaluasi";
				$txt = "Hallo ".$rsData2[0]['username'].", Data Perlu DI Evaluasi(Perbaikan) , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
				"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 6,`status_text` = 'Data Perlu DI Evaluasi(Perbaikan) Dari Pleno' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
				redirect(base_url("daftar/list_kaji_pleno"));
				}
		}else if($status=='lanjut_ke_ethical'){
			
				$to = "".$rsData2[0]['email']."";
				$subject = "Data Di Ethical Clearance";
				$txt = "Hallo ".$rsData2[0]['username'].", Data Di Ethical Clearance , Terima Kasih.";
				$headers = "From: eproposal@rsuppersahabatan.co.id" . "\r\n" .
				"CC: farizal28@gmail.com";

				if(mail($to,$subject,$txt,$headers)){
				
				  $ci = & get_instance();
				  $select = $ci->db->query("UPDATE `daftar_proposal` SET `status` = 7,`status_text` = 'Data Di Ethical Clearance' WHERE `id` = '".$id."' ");
				  //$rsData = $select->result_array();
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
			$crud->order_by('register_format_proposal_header.id','DESC');
			$crud->order_by('register_format_proposal_header.status','ASC');
			$crud->columns('bukti_bayar','create_date','email','action');
			$crud->callback_column('action',array($this,'showactionlink_pendaftaranuser'));
			$crud->callback_column('create_date',array($this,'showTanggal'));
		    $crud->set_field_upload('bukti_bayar','assets/uploads/bukti_pembayaran');
			
			$crud->display_as('dokumen','Dokument *PDF');
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
			$crud->callback_after_insert(array($this, 'update_register_format_proposal'));
			$crud->callback_before_insert(array($this,'encrypt_password_callback'));
			$crud->callback_before_update(array($this,'encrypt_password_callback'));
			
			$crud->unset_clone();
			//$crud->unset_read(); 
		    $crud->limit('1000');
			//$crud->callback_column('ya',array($this,'showStatusPendaftaran'));
			//$crud->callback_column('tidak',array($this,'showStatusPendaftaran'));
			 $crud->unset_fields('email','deleted','nama_lengkap','nik','no_hp','tgl_lahir','create_date','level','bukti_bayar','status');
			 
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
	

	
	function encrypt_password_callback($post_array) {
   // $this->load->library('encrypt');
 //   $key = 'super-secret-key';
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
	
	
	


	
	
	
	
	
}