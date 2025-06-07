<?php
//phpinfo();
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="hold-transition login-page">
<div id="content">

<div class="login-box">
  <div class="login-logo">
  
    <a href="<?php echo site_url('admin')?>"><b>PENDAFTARAN </br> PRAKTIK MANDIRI</b></a>
  </div>
<?php
 $email='';
  if($this->session->flashdata('message_name') !=null){
	  $email=$this->session->flashdata('post');
	
?>
<div class="alert alert-<?=$this->session->flashdata('kode_name');?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login Untuk Memulai</p>

    <form action="<?php echo base_url('admin/cek_login'); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" value="<?=$email;?>" required class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="kata_sandi"  required class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

          <button type="submit" class="btn btn-primary btn-block btn-info">Masuk</button>


     <a href="<?php echo site_url('register/index')?>" class="btn btn-block btn-danger">Daftar User Praktik Mandiri</a>
	 <a href="<?php echo site_url('register/index_dinkes_kota')?>" class="btn btn-block btn-success">Daftar User Dinkes Kota/Kab/Propinsi</a>
	  <a target="_blank" href="" class="btn btn-block btn-default" disabled>Download Juknis</a>
   
   </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- iCheck 
<script src="<?php //echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
-->
</body>