<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="content-wrapper" style="min-height: 1126.3px; margin-left:0px;">

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
<a href="<?php echo site_url('daftar/list_evaluasi/'.$data3['id_head_header'])?>"><button  class="btn btn-primary btn btn-success">KEMBALI</button></a><br><br>
              <h3 class="box-title">DETAIL</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
			<form action="" enctype='multipart/form-data' method="post">
			 <input type='hidden' name='type'  value='<?=$data3['type']?>'>
			  <input type='hidden' name='id_header'  value='<?=$data3['id_header']?>'>
			   <input type='hidden' name='jenis'  value='<?=urldecode($data3['jenis'])?>'>
			    <input type='hidden' name='id_head_header'  value='<?=$data3['id_head_header']?>'>
              <table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">NO</th>
                  <th>Pertanyaan</th>
                  <th>YA</th>
                  <th>TIDAK</th>
                </tr>
				<?php
				$no=0;
				$check="";
				$check2="";
				foreach($data as $key => $value){
					$no++;
				foreach($data2 as $key2 => $value2){
					if($value['id']==$value2['id_evaluasi']){
					if($value2['ya']=='1'){
					$check="checked";	
					}else {
					$check="";	
					}
					
					if($value2['tidak']=='1'){
					$check2="checked";	
					}else{
					$check2="";	
					}
					}
					
				}
					
				?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$value['pertanyaan']?></td>
					<td><input type='hidden' name='id[<?=$value['id']?>]'  value='<?=$value['id']?>'>
									  <input type='radio' disabled name='pilihan[<?=$value['id']?>]' <?=$check?> value='ya'></td>
									  <td><input type='radio' disabled  name='pilihan[<?=$value['id']?>]' <?=$check2?> value='tidak'></td>
                </tr>
              <?php
				}
			  ?>
              </tbody></table>
			  </form>
            </div>
            <!-- /.box-body -->
          </div>


      


    </section>
    <!-- /.content -->
  </div>

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

