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
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
            <ul class="nav nav-tabs">
         <li  ><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_labkes/').$user_id;?>">Data Dasar</a></li>
			  <li class="active"><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_alkes_labkes/').$user_id;?>" >Data Sarpras & Alkes</a></li>
			  <li  ><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_sdm_labkes/').$user_id;?>">Data SDM</a></li>
			   <li ><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_jenis_pemeriksaan_labkes/').$user_id;?>">Data Jenis Pemeriksaan</a></li>
			    <?php
				if($this->session->userdata('id_kategori') =='1'){
			   ?>
			   <li><a href="<?php echo base_url('dashboard/verifikasikan_kirim_labkes/').$user_id;?>">Verifikasikan</a></li>
			   <?php
			   }else if($this->session->userdata('id_kategori') =='3'){
			   ?>
			    <li><a href="<?php echo base_url('dashboard/verifikasikan_kirim_labkes/').$user_id;?>">Verifikasikan</a></li>
			   <?php
			   }
			   ?>
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
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
                    <table class="table table-bordered">
			 <tbody>
			 <tr>
				  <th>NO</th>
			      <th>SARPRAS ALKES LABKES</th>	 
                  <th>ISIAN</th>
             </tr>
				
		<?php
			$no=0;
			foreach(dropdown_sarpras_alkes_labkes() as $key => $value){
			$no++;
            foreach($data as $key2 => $value2){
				if($value2['id_sarpras_alkes']==$key){
					$isian=$value2['isian'];
				}
			}
			?>
			 <tr>
			 <td><?=$no;?></td>
			 <td><?=$value?></td>
			<td><?=form_dropdown('isian['.$key.']',array(''=>'Belum Di Isi','Ada'=>'Ada','Tidak Ada'=>'Tidak Ada'), $isian,'id="isian"  disabled');?></td>	 
	
			  <input type="hidden" name="id_sarpras_alkes[]" value="<?=$key;?>">
			   </tr>
			 <?php
			}
			 ?>
			 </tbody>
			 <!--
			 	<?php
				if(empty($data2[0]['final'])){
			?>
               <tr>
			 <td></td>
			 <td></td>
			 <td> 
			 <input type="hidden" name="id_faskes" value="<?=$user_id;?>">
			 <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button></td>
			 </tr>
			<?php
			}else{
			 ?>
			 <tr>
			 <td colspan="3" align="center"><font color="orange">Data Sedang Di Verifikasi</font></td>
			 </tr>
			 <?php
			}
			 ?>
			  -->
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
