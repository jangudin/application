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
        $this->load->model('fomodel');	
		define('MB', 1048576);		
	}

    function get_data_user($id)
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
				    $sql = $this->fomodel->getdatauser($id);
					$data = $sql;
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

	
}

?>