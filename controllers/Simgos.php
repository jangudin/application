<?php
class Simgos extends CI_Controller{
 
	function __construct(){
		parent::__construct();
	date_default_timezone_set("Asia/Jakarta");
		if($this->session->userdata('status') != "login"){
			redirect(base_url("admin"));
		}

		$this->load->library('pagination');
		$this->load->model('registrasiusermodel');
		$this->load->model('simgosmodel');
		$this->load->model('loginmodel');	
		define('MB', 1048576);		
	}
		
	
	public function index()
	{
	
			$data['data']= $this->simgosmodel->getdatasimgos($this->session->userdata('user_id'));
			$data['getinbox']= $this->registrasiusermodel->getinbox($this->session->userdata('user_id'));
			

			$post = $this->input->post();
        	if(isset($post['submit'])){
				$type3 = explode('.', $_FILES["dokumen_permohonan"]["name"]); // data file
				$type3 = strtolower($type3[count($type3)-1]); // data type like .jpg
				//exit(dump($type));
				$filename3="dokumen_permohonan".uniqid(rand()).'.'.$type3;
				$inputFileName3 = "./assets/uploads/berkas_registrasi/".$filename3; // hash unik
				$dokumen_permohonan=$post['old_dokumen_permohonan'];

				if(!empty($_FILES["dokumen_permohonan"]["name"])){
					if(in_array($type3, array("pdf"))) {
						if(is_uploaded_file($_FILES["dokumen_permohonan"]["tmp_name"])) {
							if(move_uploaded_file($_FILES["dokumen_permohonan"]["tmp_name"],$inputFileName3)) {
								$dokumen_permohonan=$filename3;		
							}
						}
					}else{
						$this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
						$this->session->set_flashdata('icon_name', 'warning');
						$this->session->set_flashdata('message_name', 'Jenis File Hanya Bisa pdf');
						redirect('simgos');
						
					}
				}

			$kemampuan_sdm_it=implode(";",$post['kemampuan_sdm_it']);
			$pelayanan=implode(";",$post['pelayanan']);
    
            $datas = array(
				'id_faskes' =>$post['id_faskes'],
				'dokumen_permohonan'=>$dokumen_permohonan,
				'kemampuan_sdm_it'=>$kemampuan_sdm_it,
				'pelayanan'=>$pelayanan,

                'nama_pengisi' =>$post['nama_pengisi'],
                'hp_pengisi' =>$post['hp_pengisi'],
                'ketersediaan_sdm_it' =>$post['ketersediaan_sdm_it'],
				'pengalaman_sdm_it' =>$post['pengalaman_sdm_it'],
                'memiliki_internet' =>$post['memiliki_internet'],
                'memiliki_server' =>$post['memiliki_server'],
				'memenuhi_spek_minimal_server' =>$post['memenuhi_spek_minimal_server'],
                'memiliki_local_server' =>$post['memiliki_local_server'],
                'memiliki_ups' =>$post['memiliki_ups'],
				'memiliki_rak_server' =>$post['memiliki_rak_server'],
                'memiliki_hdd_eksternal_untuk_backup' =>$post['memiliki_hdd_eksternal_untuk_backup'],
                'memiliki_mikrotik_router' =>$post['memiliki_mikrotik_router'],
				'memiliki_kabel_lan' =>$post['memiliki_kabel_lan'],
				'memiliki_core_switch' =>$post['memiliki_core_switch'],
				'memiliki_web_hosting' =>$post['memiliki_web_hosting'],
				'alamat_website' =>$post['alamat_website'],
				'alamat_di_dalam_negeri' =>$post['alamat_di_dalam_negeri'],
				'memiliki_komputer' =>$post['memiliki_komputer'],
				'memiliki_komputer_spek_minimal' =>$post['memiliki_komputer_spek_minimal'],
				'berapa_jumlah_komputer_memenuhi' =>$post['berapa_jumlah_komputer_memenuhi'],
				'memiliki_printer' =>$post['memiliki_printer'],
                'memiliki_printer_barcode' =>$post['memiliki_printer_barcode'],
                'memiliki_printer_pos'=>$post['memiliki_printer_pos']
    
                );

					if(!empty($post['id'])){
						$where = array(
							'id' =>$post['id']
							);
						$this->registrasiusermodel->edit_data('simgos',$where,$datas);
						// $this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat_pm' =>$post['id_camat_pm']));
						
						$datas_log = array(
							'id_faskes' =>$this->session->userdata('user_id'),
							'status' =>''.$this->session->userdata('email').' Telah Mengedit Data Permohonan SIMGOS'
							);
						$this->registrasiusermodel->input_data('timeline',$datas_log);
                    }else{
						$this->registrasiusermodel->input_data('simgos',$datas);
						$id = $this->db->insert_id();
						// $this->registrasiusermodel->edit_data('registrasi_user',array('id' =>$post['id_faskes']),array('id_camat_pm' =>$post['id_camat_pm']));
						
						$datas_log = array(
							'id_faskes' =>$this->session->userdata('user_id'),
							'status' =>''.$this->session->userdata('email').' Telah Menyimpan Data SIMGOS'
							);
						$this->registrasiusermodel->input_data('timeline',$datas_log);
                    }
                        
                
                    $this->session->set_flashdata('kode_name', 'success');
                    $this->session->set_flashdata('icon_name', 'check');
                    $this->session->set_flashdata('message_name', 'Sukses Input Data!');
                    redirect('simgos');
			}

			$this->template->utama('simgos',$data);  

	}
	
	

}
