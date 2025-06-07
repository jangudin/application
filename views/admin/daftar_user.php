<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body class="hold-transition register-page">
  <div class="register-logo">
    <a href="<?php echo site_url('register')?>"><b>HOMECARE</b></a>
  </div>


    <!-- Main content -->
    <section class="content">



<div class="box">

            <div class="box-header">
			<?php
if($this->session->flashdata('message_name') !=null){
?>
<div class="alert alert-<?=$this->session->flashdata('kode_name');?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
              <h3 class="box-title">DAFTAR USER BARU</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
			<form action="" enctype='multipart/form-data' method="post">
              <table class="table table-striped">
                <tbody>
			  <tr>
			  <td colspan="5"><div class="form-group">
                  <label for="exampleInputEmail1">Nama Lengkap *</label>
				  <input type="text" class="btn-block btn-flat" placeholder="Enter Nama Lengkap" required name="nama_lengkap" id="nama_lengkap">
				  </div>
				  </td>
			  </tr>
			  <!--
			   <tr>
			  <td colspan="5"><div class="form-group">
			  <?php
			   $tampungspesialis=array();
			  foreach($master_spesialisasi AS $keys => $values){
				 $tampungspesialis[$values['id_spesialisasi']]=$values['nama_spesialisasi'];
			  }
			  ?>
                  <label for="exampleInputEmail1">Spesialisasi RS *</label>
				 <?php echo myform_dropdown('master_spesialisasi', $tampungspesialis,'','  class="master_spesialisasi btn-block btn-flat" id="master_spesialisasi" ');?>
				  </div>
				  </td>
			  </tr>
			  -->
			  <tr>
			  <td colspan="5"><div class="form-group">
                  <label for="exampleInputEmail1">No Telepon/Handphone *</label>
				  <input type="text" class="btn-block btn-flat" placeholder="Enter Telepone" required name="no_tlpn" id="no_tlpn">
				  </div>
				  </td>
			  </tr>
			    <tr>
			  <td colspan="5"><div class="form-group">
                  <label for="exampleInputEmail1">Email *</label>
				  <input type="email" class="btn-block btn-flat" placeholder="Enter email" required name="email" id="email">
				  </div>
				  </td>
			  </tr>
			  

			 
			  <tr>
			  <td colspan="5"><button type="submit" name='submit'   class="btn btn-primary btn-block btn-flat">Daftar Homecare</button></td>
			  </tr>
			 
			    </tbody></table>
				 </form>
<a href="<?php echo site_url('admin')?>"><button  class="btn btn-primary btn btn-block btn-success">Kembali Ke Halaman Login</button></a>
			  </tr>
            </div>
            <!-- /.box-body -->
          </div>


      


    </section>
    <!-- /.content -->

  <!-- /.form-box -->

<!-- /.register-box -->
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
