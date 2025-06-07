<?php
class ApiKomen extends CI_Controller{

	function __construct(){
		parent::__construct();
	date_default_timezone_set("Asia/Jakarta");
		

		$this->load->library('pagination');
		$this->load->model('registrasiusermodel');		
		$this->load->model('labkesmodel');		
		$this->load->model('rsmodel');
		$this->load->model('utdmodel');
		$this->load->model('pmmodel');
		$this->load->model('loginmodel');	
		define('MB', 1048576);		
	}

    function status_klinik($kode_faskes)
	{
		    $dt=new DateTime(null, new DateTimeZone("UTC"));
			$tStamp = $dt->getTimestamp();
			$stamp=time();
			$headers = apache_request_headers() ;		
			$requestContentType = $headers['Content-Type'];
			$requestmethod = $_SERVER['REQUEST_METHOD'];
			$xid= isset($headers['X-Id']) ? $headers['X-Id'] : $headers['idx'];
			$xpass= $headers['X-Pass'];
			$time= $headers['X-Timestamp'];
			$body = file_get_contents("php://input");
			$body=json_decode($body);
			
			if($requestmethod=='GET')
			{
			if(!empty($kode_faskes))
			{
				if($stamp<$time+1000)
				{
				if($xid=='komen' && $xpass=='komen!@#$')
				{  
				    $sql = $this->db->query("SELECT
                                                a.kode_faskes AS KODE_FASKES,
												a.kode_faskes_baru AS KODE_FASKES_KMK,
                                                b.nama_klinik AS NAMA_FASKES,
                                                b.alamat_faskes AS ALAMAT,
                                                b.no_telp AS NO_TLP,
                                                b.email AS EMAIL,
                                                b.latitude AS LAT,
                                                b.longitude AS LNG,
                                                b.id_prov AS PROV,
                                                b.id_kota AS KAB,
                                                b.jenis_klinik AS JENIS
                                                
                                                
                                            FROM
                                                dbfaskes.trans_final a
                                                LEFT JOIN dbfaskes.data_klinik b ON a.id_faskes = b.id_faskes
                                            WHERE
                                                a.kode_faskes = '".$kode_faskes."' 
                                                OR a.kode_faskes_baru = '".$kode_faskes."' 
                                                OR LOWER( b.nama_klinik ) LIKE '%".$kode_faskes."%'
												LIMIT 10
                                                ");
					$data = $sql->result_array();
					//var_dump($data);
					if(empty($data))
					{
						echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					}else{
						echo json_encode($data);
					}
											
						
				 }else{
						//echo $headers['kirim']." ".$headers['X-Signature'];
					     echo '{"Code":"201","pesan":"X ID Salah"}';
					}
	            }else{
					echo '{"Code":"201","pesan":"Expired"}';
				}			
			}else{
			
				echo '{"Code":"201","pesan":"Isikan Kode RS"}';
			}
		}else{
			echo '{"Code":"201","pesan":"Request Method Hanya GET"}';
			
		}
	}

	
    function status_pm($kode_faskes)
	{
		    $dt=new DateTime(null, new DateTimeZone("UTC"));
			$tStamp = $dt->getTimestamp();
			$stamp=time();
			$headers = apache_request_headers() ;		
			$requestContentType = $headers['Content-Type'];
			$requestmethod = $_SERVER['REQUEST_METHOD'];
			$xid= isset($headers['X-Id']) ? $headers['X-Id'] : $headers['idx'];
			$xpass= $headers['X-Pass'];
			$time= $headers['X-Timestamp'];
			$body = file_get_contents("php://input");
			$body=json_decode($body);
			
			if($requestmethod=='GET')
			{
			if(!empty($kode_faskes))
			{
				if($stamp<$time+1000)
				{
                if($xid=='komen' && $xpass=='komen!@#$')
				{  
				    $sql = $this->db->query("SELECT
                                                a.kode_faskes AS KODE_FASKES,
												a.kode_faskes_baru AS KODE_FASKES_KMK,
                                                b.nama_pm AS NAMA_FASKES,
                                                b.alamat_faskes AS ALAMAT,
                                                b.no_telp AS NO_TLP,
                                                b.email AS EMAIL,
                                                b.latitude AS LAT,
                                                b.longitude AS LNG,
                                                b.id_prov_pm AS PROV,
                                                b.id_kota_pm AS KAB,
                                                c.kategori_user AS JENIS
                                                
                                                
                                            FROM
                                                dbfaskes.trans_final a
                                                LEFT JOIN dbfaskes.data_pm b ON a.id_faskes = b.id_faskes
                                                LEFT JOIN dbfaskes.kategori_pm c ON b.id_kategori = c.id
                                            WHERE
                                                a.kode_faskes = '".$kode_faskes."'
                                                OR a.kode_faskes_baru = '".$kode_faskes."' 
                                                OR LOWER( b.nama_pm ) LIKE '%".$kode_faskes."%'
												LIMIT 10 
                                                ");
					$data = $sql->result_array();
					//var_dump($data);
					if(empty($data))
					{
						echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					}else{
						echo json_encode($data);
					}
											
						
				 }else{
						//echo $headers['kirim']." ".$headers['X-Signature'];
					     echo '{"Code":"201","pesan":"X ID Salah"}';
					}
	            }else{
					echo '{"Code":"201","pesan":"Expired"}';
				}			
			}else{
			
				echo '{"Code":"201","pesan":"Isikan Kode RS"}';
			}
		}else{
			echo '{"Code":"201","pesan":"Request Method Hanya GET"}';
			
		}
	}

    function status_puskesmas($kode_faskes)
	{
		    $dt=new DateTime(null, new DateTimeZone("UTC"));
			$tStamp = $dt->getTimestamp();
			$stamp=time();
			$headers = apache_request_headers() ;		
			$requestContentType = $headers['Content-Type'];
			$requestmethod = $_SERVER['REQUEST_METHOD'];
			$xid= isset($headers['X-Id']) ? $headers['X-Id'] : $headers['idx'];
			$xpass= $headers['X-Pass'];
			$time= $headers['X-Timestamp'];
			$body = file_get_contents("php://input");
			$body=json_decode($body);
			
			if($requestmethod=='GET')
			{
			if(!empty($kode_faskes))
			{
				if($stamp<$time+1000)
				{
                if($xid=='komen' && $xpass=='komen!@#$')
				{  
				    $sql = $this->db->query("SELECT
                                                a.kode_sarana AS KODE_FASKES,
												a.kode_baru AS KODE_FASKES_KMK,
                                                a.name AS NAMA_FASKES,
                                                a.alamat AS ALAMAT,
                                                a.telp AS NO_TLP,
                                                a.email AS EMAIL,
                                                a.latitude AS LAT,
                                                a.longitude AS LNG,
                                                a.provinsi_code AS PROV,
                                                a.kabkot_code AS KAB,
                                                a.jenis_pelayanan AS JENIS,
												a.wilayah_karakteristik AS wilayah_karakteristik
                                                
                                            FROM
												dbfaskes.puskesmas_pusdatin a
                                            WHERE
                                                a.kode_sarana = '".$kode_faskes."' 
                                                OR a.kode_baru = '".$kode_faskes."' 
                                                OR LOWER( a.name ) LIKE '%".$kode_faskes."%'
												LIMIT 10
                                                ");
					$data = $sql->result_array();
					//var_dump($data);
					if(empty($data))
					{
						echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					}else{
						echo json_encode($data);
					}
											
						
				 }else{
						//echo $headers['kirim']." ".$headers['X-Signature'];
					     echo '{"Code":"201","pesan":"X ID Salah"}';
					}
	            }else{
					echo '{"Code":"201","pesan":"Expired"}';
				}			
			}else{
			
				echo '{"Code":"201","pesan":"Isikan Kode RS"}';
			}
		}else{
			echo '{"Code":"201","pesan":"Request Method Hanya GET"}';
			
		}
	}
}

?>