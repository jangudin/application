<?php
class Api extends CI_Controller{

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

	function kode_psc($kode_faskes)
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
					$dbyankes = $this->load->database('psc',true);
//				    $sql = $dbyankes->query("SELECT
//												d.kode_psc AS kode,
//												d.nama AS nama 
//											FROM
//												psc.data_psc d 
//											WHERE
//												d.kode_psc = '".$kode_faskes."'
//												OR LOWER( d.nama ) LIKE '%".$kode_faskes."%'
//												LIMIT 10
//												");
                    /*update 5 desember 2024 data baru psc*/
                    $sql = $dbyankes->query("SELECT
                        d.kode_psc_119 AS kode,
                        d.nama_psc_119 AS nama
                    FROM
                        db_fasyankes.data_psc d
                    WHERE
                        d.status = 1 and (d.kode_psc_119 = '".$kode_faskes."'
                        OR LOWER( d.nama_psc_119 ) LIKE '%".$kode_faskes."%')
                        LIMIT 10
                    ");
					$data = $sql->result_array();
					//var_dump($data);
					// if(empty($data))
					// {
					// 	echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					// }else{
						echo json_encode($data);
					// }
											
						
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

    function status_psc($kode_faskes)
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
				    $dbyankes = $this->load->database('psc',true);
				    $sql = $dbyankes->query("SELECT
                                                a.kode_psc AS KODE_FASKES,
                                                a.nama AS NAMA_FASKES,
                                                a.alamat AS ALAMAT,
                                                a.cp AS NO_TLP,
                                                a.email AS EMAIL,
                                                a.prop AS PROV,
                                                a.kab AS KAB
                                                
                                            FROM
                                                psc.data_psc a 
                                            WHERE
                                                a.kode_psc ='".$kode_faskes."' ");
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

	function kode_klinik($kode_faskes)
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
				    $sql = $this->db->query("SELECT
												a.kode_faskes_baru AS kode,
												b.nama_klinik AS nama
											FROM
												dbfaskes.trans_final a
												LEFT JOIN dbfaskes.data_klinik b ON a.id_faskes = b.id_faskes
											WHERE
												a.kode_faskes_baru = '".$kode_faskes."'
												OR LOWER( b.nama_klinik ) LIKE '%".$kode_faskes."%'
												LIMIT 10
												");
					$data = $sql->result_array();
					//var_dump($data);
					// if(empty($data))
					// {
					// 	echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					// }else{
						echo json_encode($data);
					// }
											
						
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
				    $sql = $this->db->query("SELECT
                                                a.kode_faskes_baru AS KODE_FASKES,
												a.kode_faskes_baru AS KODE_FASKES_BARU,
                                                b.nama_klinik AS NAMA_FASKES,
                                                b.alamat_faskes AS ALAMAT,
                                                b.no_telp AS NO_TLP,
                                                b.email AS EMAIL,
                                                b.latitude AS LAT,
                                                b.longitude AS LNG,
                                                b.id_prov AS PROV,
                                                b.id_kota AS KAB,
                                                if(b.jenis_klinik = 'Pratama', 21,22) AS JENIS
                                                
                                                
                                            FROM
                                                dbfaskes.trans_final a
                                                LEFT JOIN dbfaskes.data_klinik b ON a.id_faskes = b.id_faskes
                                            WHERE
                                                a.kode_faskes_baru = '".$kode_faskes."' ");
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

	function kode_pm($kode_faskes)
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
				    $sql = $this->db->query("SELECT
												a.kode_faskes AS kode,
												b.nama_pm AS nama
												
											FROM
												dbfaskes.trans_final a
												LEFT JOIN dbfaskes.data_pm b ON a.id_faskes = b.id_faskes
												LEFT JOIN dbfaskes.kategori_pm c ON b.id_kategori = c.id
											WHERE
												a.kode_faskes = '".$kode_faskes."'	
												OR LOWER( b.nama_pm ) LIKE '%".$kode_faskes."%'
												LIMIT 10
												");
					$data = $sql->result_array();
					//var_dump($data);
					// if(empty($data))
					// {
					// 	echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					// }else{
						echo json_encode($data);
					// }
											
						
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
				    $sql = $this->db->query("SELECT
                                                a.kode_faskes AS KODE_FASKES,
												a.kode_faskes_baru AS KODE_FASKES_BARU,
                                                b.nama_pm AS NAMA_FASKES,
                                                b.alamat_faskes AS ALAMAT,
                                                b.no_telp AS NO_TLP,
                                                b.email AS EMAIL,
                                                b.latitude AS LAT,
                                                b.longitude AS LNG,
                                                b.id_prov_pm AS PROV,
                                                b.id_kota_pm AS KAB,
                                                c.kode_sisrute AS JENIS
                                                
                                                
                                            FROM
                                                dbfaskes.trans_final a
                                                LEFT JOIN dbfaskes.data_pm b ON a.id_faskes = b.id_faskes
                                                LEFT JOIN dbfaskes.kategori_pm c ON b.id_kategori = c.id
                                            WHERE
                                                a.kode_faskes = '".$kode_faskes."' ");
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

	function alkes($kode_rs)
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
			if(!empty($kode_rs))
			{
				//if($stamp<$time+1000)
				//{
				//if($xid=='webyankes' && $xpass=='web0nline')
				//{  
				    $sql = $this->db->query("SELECT
                                            a.id AS ID,
                                            a.id_faskes AS ID_fask,
                                            a.id_sarpras_alkes AS ID_Sarpras_Alkes,
                                            a.is_checked AS IS_Checked,
                                            b.id AS ID_ALkes,
                                            b.type AS Type,
                                            b.jenis_perawatan AS Jenis_Perawatan,
                                            b.auth AS Keterangan,
                                            b.sarpras_alkes AS SARPRAS_KLINIK,
                                            c.id AS id_Faskes,
                                            d.id_faskes AS ID_Faske,
                                            d.kode_faskes AS Kode_faskes                                        

                                        FROM
                                            dbfaskes.trans_sarpras_alkes_klinik a
                                            LEFT JOIN dbfaskes.sarpras_alkes_klinik b ON a.id_sarpras_alkes = b.id
                                            LEFT JOIN dbfaskes.registrasi_user c ON a.id_faskes = c.id
                                            LEFT JOIN dbfaskes.trans_final d ON c.id = d.id_faskes
                                        WHERE
                                                d.kode_faskes = (SELECT kode_faskes FROM dbfaskes.`trans_final` WHERE
                                                 `id_faskes`='".$kode_rs."') ");
					$data = $sql->result_array();
					//var_dump($data);
					$response=Array(
						'status' => 1,
						'message' =>'Success',
						'data' => $data
					 );
					if(empty($response))
					{
						echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					}else{
						echo json_encode($response);
					}
											
						
				//  }else{
				// 		//echo $headers['kirim']." ".$headers['X-Signature'];
				// 	     echo '{"Code":"201","pesan":"X ID Salah"}';
				// 	}
	            // }else{
				// 	echo '{"Code":"201","pesan":"Expired"}';
				// }			
			}else{
			
				echo '{"Code":"201","pesan":"Isikan Kode RS"}';
			}
		}else{
			echo '{"Code":"201","pesan":"Request Method Hanya GET"}';
			
		}
	}

	function nakes($kode_faskes)
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
				// if($stamp<$time+1000)
				// {
				// if($xid=='webyankes' && $xpass=='web0nline')
				// {  
				    $sql = $this->db->query("SELECT
					a.id AS ID,
											a.id_faskes AS ID_fask,
					a.id_sdm AS ID_id_SDM,
					a.jumlah AS Jumlah,
					b.id AS ID_Sdm,
											b.jenis_klinik AS Jenis_Klinik,
											b.sdm AS SDM,
											b.keterangan AS Keterangan,
											b.sub_keterangan AS Sub_Keterangan,
											d.id_faskes AS ID_Faske,
											d.kode_faskes AS Kode_faskes                                                

										FROM
											dbfaskes.trans_sdm a
											LEFT JOIN dbfaskes.data_sdm b ON a.id_sdm = b.id
											LEFT JOIN dbfaskes.trans_final d ON a.id_faskes = d.id_faskes
										WHERE
											d.kode_faskes = (SELECT kode_faskes FROM dbfaskes.`trans_final` WHERE
											 `id_faskes`='".$kode_faskes."') ");
					$data = $sql->result_array();
					$response=Array(
						'status' => 1,
						'message' =>'Success',
						'data' => $data
					 );
					//var_dump($data);
					if(empty($response))
					{
						echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					}else{
						echo json_encode($response);
					}
											
						
				//  }else{
				// 		//echo $headers['kirim']." ".$headers['X-Signature'];
				// 	     echo '{"Code":"201","pesan":"X ID Salah"}';
				// 	}
	            // }else{
				// 	echo '{"Code":"201","pesan":"Expired"}';
				// }			
			}else{
			
				echo '{"Code":"201","pesan":"Isikan Kode RS"}';
			}
		}else{
			echo '{"Code":"201","pesan":"Request Method Hanya GET"}';
			
		}
	}

	function kode_puskesmas($kode_faskes)
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
				    $sql = $this->db->query("SELECT
												a.kode_sarana AS kode,
												a.name AS nama,
												a.kabkot_nama as kabkota, 
												a.provinsi_nama as provinsi
												
											FROM
												dbfaskes.puskesmas_pusdatin a
											WHERE
												a.kode_sarana = '".$kode_faskes."'	
												OR LOWER( a.name ) LIKE '%".$kode_faskes."%'
												LIMIT 10
												");
					$data = $sql->result_array();
					//var_dump($data);
					// if(empty($data))
					// {
					// 	echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					// }else{
						echo json_encode($data);
					// }
											
						
				 }else{
						//echo $headers['kirim']." ".$headers['X-Signature'];
					     echo '{"Code":"201","pesan":"X ID Salah"}';
					}
	            }else{
					echo '{"Code":"201","pesan":"Expired"}';
				}			
			}else{
			
				echo '{"Code":"201","pesan":"Isikan Kode Faskes"}';
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
				    $sql = $this->db->query("SELECT
                                                a.kode_sarana AS KODE_FASKES,
												a.kode_baru AS KODE_FASKES_BARU,
                                                a.name AS NAMA_FASKES,
                                                a.alamat AS ALAMAT,
                                                a.telp AS NO_TLP,
                                                a.email AS EMAIL,
                                                a.latitude AS LAT,
                                                a.longitude AS LNG,
                                                a.provinsi_code AS PROV,
                                                a.kabkot_code AS KAB,
                                                a.jenis_pelayanan AS JENIS_TEXT,
                                                p.kode_sisrute AS JENIS,
												a.wilayah_karakteristik AS wilayah_karakteristik
                                                
                                            FROM
												dbfaskes.puskesmas_pusdatin a
                                                left join m_jenislayanan_puskesmas p ON p.nama_jenis=a.jenis_pelayanan
                                            WHERE
                                                a.kode_sarana = '".$kode_faskes."' ");
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

    function kode_bkk($kode_faskes)
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
				    $sql = $this->db->query("SELECT
                                                a.kode_registrasi AS kode,
                                                b.nama_institusi AS nama
                                            FROM
                                                db_faskes_lain.faskes_lain a
                                                LEFT OUTER JOIN db_faskes_lain.pengajuan b ON a.pengajuan_id = b.id
											WHERE
												LOWER( b.nama_institusi ) LIKE '%".$kode_faskes."%'
                                                AND b.id > 122 
												LIMIT 10
												");
					$data = $sql->result_array();
					//var_dump($data);
					// if(empty($data))
					// {
					// 	echo '{"Code":"201","pesan":"Data tidak ditemukan"}';
					// }else{
						echo json_encode($data);
					// }
											
						
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

    function status_bkk($kode_faskes)
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
				if($xid=='regfaskes' && $xpass=='rsonline!@#$')
				{  
				    $sql = $this->db->query("SELECT
                                                a.kode_registrasi AS KODE_FASKES,
                                                b.nama_institusi AS NAMA_FASKES,
                                                b.alamat AS ALAMAT,
                                                b.no_telp AS NO_TLP,
                                                b.email AS EMAIL,
                                                b.propinsi_id AS PROV,
                                                b.kota_id AS KAB
                                            FROM
                                                db_faskes_lain.faskes_lain a
                                                LEFT OUTER JOIN db_faskes_lain.pengajuan b ON a.pengajuan_id = b.id
                                            WHERE
                                                a.kode_registrasi = '".$kode_faskes."' ");
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
