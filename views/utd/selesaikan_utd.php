<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
		  			<?php
if($this->session->flashdata('message_name') !=null){
?>
<div class="alert alert-<?=$this->session->flashdata('kode_name');?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Peringatan!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
            <ul class="nav nav-tabs">
             <li  ><a href="<?php echo base_url('utd/inputan_data_faskes_utd');?>">Data Dasar</a></li>
				<li ><a href="<?php echo base_url('utd/inputan_data_sdm_utd');?>">Data SDM</a></li>
				 <li><a href="<?php echo base_url('utd/inputan_data_sarpras_alkes_utd');?>">Data Sarpras</a></li>
				  <li ><a href="<?php echo base_url('utd/inputan_data_alkes_utd');?>">Data Alkes</a></li>
				 <li   class="active" ><a href="<?php echo base_url('utd/selesaikan_utd');?>">Kirim Data</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
            <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <!-- left column -->
        <div class="col-md-12" >
          <!-- general form elements -->
          <div class="box box-primary">
           
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype='multipart/form-data' onsubmit="return confirm('Apakah Anda Yakin?');">
                    <table class="table table-bordered">
			 <tbody>
			 <?php
			if(empty($data[0]['final'])){
			 ?>
			 <tr>
			 <td><b>Apakah Data Yang Anda Masukan Sudah Benar Dan Ingin Mengirim Untuk Di Verifikasi?<br>Hasil Verifikasi Akan Di Kirimkan Ke Email.</b></td>
			 <td>
			 <input type="hidden" name="id_faskes" value="<?=$user_id?>">
			  <input type="hidden" name="id_prov" value="<?=$user[0]['id_prov']?>">
			  <input type="hidden" name="id_kota" value="<?=$user[0]['id_kota']?>">
			   <input type="hidden" name="kode_regional" value="<?=$getdatautd[0]['kode_regional']?>">
			   
	
				 <input type="hidden" name="jenis_utd" value="<?=$getdatautd[0]['jenis_utd']?>">
			  
			 <button type="submit" name="submit" id="submit"  class="btn btn-primary">Kirim</button></td>
			 </tr>
	 <tr>
			 <td colspan="2"><b>Kode Fasyankes Lama, Bila Ada (contoh UTD1111011) :</b> <input type="text" name="kode_faskes_lama" value="<?=$data[0]['kode_faskes_lama']?>">
			 </td>
			 </tr>
			<?php if(!empty($data[0]['catatan'])){ ?> 
			  <tr>
			 <td colspan="2"><b>Catatan :</b>   <?=$data[0]['catatan']?></td>
			 </tr>
			<?php } ?>
			 <?php
			}else{
			if(!empty($data[0]['token_kode_faskes']) && empty($data[0]['kode_faskes'])){
			?>
			 <tr>
			 <td>Link Aktifasi : <b><a onclick="return confirm('Apakah Anda Yakin?');" href="<?php echo base_url('dashboard/validate_kirim_email_kode_faskes/').$data[0]['token_kode_faskes'].'/'.$this->session->userdata('user_id').'/'.$data[0]['id_link'];?>">Kirim Email</a></b></td>
			 <td></td>
			 </tr>
			<?php
			}else if(!empty($data[0]['kode_faskes'])){
			?>
			 <tr>
			 <td><b>Kode Faskes : <?=$data[0]['kode_faskes']?></b></td>
			 <td></td>
			 </tr>
			<?php
			}else{
			?>
			 <tr>
			 <td><b>Data Sedang Di Verifikasi</b></td>
			 <td></td>
			 </tr>
			 <?php
			 }
			}
			 ?>
			 </tbody>
			 </table>
            </form>
          </div>
          <!-- /.box -->


        </div>
        <!--/.col (left) -->

        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
                
				
              </div>
           
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
 <script>
   $(function() {
	  $('.select2').select2();
	  $('[data-mask]').inputmask();
     $("#datepicker").datepicker({autoclose: true});
   });
   
      $('[name="id_prov"]').change(function() {
		 $('#id_kota').val('');
		    $.ajax({
         url: "<?php echo site_url('dashboard/dropdown4')?>/" + $(this).val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="id_kota"]'), data, 'id_kota', 'nama_kota');
         }
      }); 
	  
	 
   });
   
      function addOption(ele, data, key, val) { //alert(data.length);
   $('option', ele).remove();
  
   ele.append(new Option('', 9999));
   $(data).each(function(index) { //alert(eval('data[index].' + nama));
      ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));
	 
   });
}
   
   </script>
