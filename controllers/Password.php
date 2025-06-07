<?php
class Password extends CI_Controller{
 
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
		
	public function index()
	{
        // $this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
		// 	        $this->session->set_flashdata('icon_name', 'warning');
        //             $this->session->set_flashdata('message_name','Password minimal 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan karakter khusus(!,@,#,$,^,*,(,)).');
			$this->template->utama('admin/update_password',$data);  
            
	}

    public function changepassword()
    {
        $this->load->helper('security');
        $email = $this->input->post('email');
        
        $salt      = 'hello_1m_@_SaLT_0f_F45ke5';
        //$hashed    = hash('sha256', $password1 . $salt);
        
//        $password= md5($this->input->post('lastpasswordfirst'));
//        $pass = $this->input->post('newpasswordfirst');
        $password= $this->input->post('lastpasswordfirst');
        $hashed_lama = hash('sha256', $password . $salt);
        $pass = $this->input->post('newpasswordfirst');
        $hashed_baru = hash('sha256', $pass . $salt);
        
        // var_dump($email);
        // var_dump($password);
        // var_dump($pass);
        $idpengguna = $this->input->post('id');
       
        $uppercase = preg_match('@[A-Z]@', $pass);
		$lowercase = preg_match('@[a-z]@', $pass);
		$number    = preg_match('@[0-9]@', $pass);
		$specialChars = preg_match('@[^\w]@', $pass);

        // $validate_ps = $this->Mlogin->query_validasi_password($email, $password);

        $where = array(
			'email' => $email,
			'pass_baru' => $hashed_lama,
			);
		// $cek = $this->loginmodel->cek_login("registrasi_user",$where)->num_rows();
		$validate_ps = $this->loginmodel->cek_login("registrasi_user",$where);
        // var_dump($validate_ps);


        if ($validate_ps->num_rows() > 0) {
            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
                    $url=base_url('password');
                    $this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			        $this->session->set_flashdata('icon_name', 'warning');
                    $this->session->set_flashdata('message_name','Password minimal 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan karakter khusus(!,@,#,$,^,*,(,)).');
                    redirect($url);
        
                }else{
                    //$password1 = md5($pass);
                    //$password2 = md5($this->input->post('newpasswordsecond'));
                    
                    $salt      = 'hello_1m_@_SaLT_0f_F45ke5';
                    $hashed    = hash('sha256', $password1 . $salt);
                    //$password1 = md5($pass);
                    $password1 = hash('sha256', $pass . $salt);
                    //$password2 = md5($this->input->post('newpasswordsecond'));
                    $password2 = hash('sha256', $this->input->post('newpasswordsecond') . $salt);
                    
                    if ($password1 == $password2) {
                        // echo 'sama';
                        // $this->load->model('Model_fasyankes');
                        date_default_timezone_set("Asia/Jakarta");
                        $date = date('Y-m-d');
                        $data = array(
                            //'kata_sandi' => $password1,
                            'pass_baru' => $password1,
                            'tanggal_update_password' => $date
                        );
                        // $this->Model_fasyankes->updatepassword($idpengguna, $data);

                        $where = array('id' => $this->session->userdata('id'));
                        $this->registrasiusermodel->edit_data('registrasi_user',$where,$data);
                        echo "
                        <script> 
                            alert('Password Berhasil diganti.');  
                            window.location = '../../Admin/logout';
                        </script>
                        ";
                        // redirect(base_url('Login'));
                    } else {
                        // $URL = $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5);
                        // echo $URL;
                        $this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			            $this->session->set_flashdata('icon_name', 'warning');
                        $this->session->set_flashdata('message_name','Password Tidak Sama. </br> Password minimal 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan karakter khusus(!,@,#,$,^,*,(,)).');
                        redirect(base_url('password/'));
                    }
                }
            // echo 'benar';
            
        } else {
            $url = base_url('password');
            $this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
			$this->session->set_flashdata('icon_name', 'warning');
            $this->session->set_flashdata('message_name','Password Lama Yang Anda Masukkan Salah. </br> Password minimal 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan karakter khusus(!,@,#,$,^,*,(,)).');
            //redirect($url);
            redirect('password');
            // print_r('testing');
        }
    }

}
