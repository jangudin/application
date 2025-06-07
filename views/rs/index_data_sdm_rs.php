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
              <li  ><a href="<?php echo base_url('rs/inputan_data_faskes_rs');?>">Data Dasar</a></li>
				<li class="active"><a href="<?php echo base_url('rs/inputan_data_sdm_rs');?>">Data SDM</a></li>
				 <li ><a href="<?php echo base_url('rs/inputan_data_tt_rs');?>">Data TT</a></li>
				  <li ><a href="<?php echo base_url('rs/inputan_data_pelayanan_rs');?>">Data Pelayanan</a></li>
				 <li  ><a href="<?php echo base_url('rs/selesaikan_rs');?>">Kirim Data</a></li>
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
           
		   <?php
		   if(!empty($user[0]['jenis_rs'])){
		   ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
                    <table class="table table-bordered">
			 <tbody>
			 <tr>
				  <th>NO</th>
			      <th>SDM</th>
				 
                  <th>JUMLAH</th>
             </tr>
				
		<?php

			$no=0;
			foreach(dropdown_sdm_rs() as $key => $value){
			$no++;
			
	
			
			


			?>
			 <tr>
			 <td><?=$no;?></td>
			 <td><?=$value?></td>
			 
			 <?php
			 if(!empty($data)){
			 	foreach($data as $key2 => $value2){
					
				if($value2['id_sdm'] ==$key){
			 ?>
			 <td>
			 <input type="number" name="jumlah[<?=$key;?>]" value="<?=$value2['jumlah']?>"  placeholder="Jumlah" class="form-control" autocomplete="off" id="jumlah" >
			 </td>	
			 <?php
				}else{
			 ?>
			
			 <?php
				}
			 ?>
			 
			 <?php
			}
			}else{
			?>
			 	 <td>
			 <input type="number" name="jumlah[<?=$key;?>]" value=""    class="form-control"  placeholder="Jumlah"  autocomplete="off" id="jumlah" >
			 </td>	 
			<?php
			 }
			 ?>
			  <input type="hidden" name="id_sdm[]" value="<?=$key;?>">
			   </tr>
			 <?php
			}
			 ?>
			 </tbody>
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
			 <td></td>
			 <td></td>
			 <td> 
			<div class="box-footer">
                <font color="orange">Data Sedang DI Verifikasi</font>
              </div></td>
			 </tr>
			 
			 <?php
			}
			 ?></table>
            </form>
			<?php
		   }else{
			 echo 'Harap Selesaikan Data Dasar RS Terlebih Dahulu';  
		   }
			?>
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
