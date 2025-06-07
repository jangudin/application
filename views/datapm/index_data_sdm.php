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
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> </button>
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
            <ul class="nav nav-tabs">
			<?php
				if($this->session->userdata('id_kategori_pm')==4 || $this->session->userdata('id_kategori_pm')==5){
					
				
			?>
				<li><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
				<li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li>
                <li><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>
				<li  ><a href="<?php echo base_url('pm/inputan_data_gambar_pm');?>">Dokumentasi</a></li>
<?php
						if(!empty($data2[0]['kode_faskes'])){
                          ?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <li  ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
			<li ><a href="<?php echo base_url('pm/satu_sehat');?>">Satu Sehat</a></li>
			<li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }
                        ?>
                        <li  ><a href="<?php echo base_url('pm/selesaikan');?>">Print QR</a></li> 
			<?php
				} else {
			?>
				<li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Data Dasar</a></li>
				<li ><a href="<?php echo base_url('pm/inputan_data_sarpras_alkes_pm');?>" >Data Bangunan & Sarpras</a></li>
				<li class="active"><a href="<?php echo base_url('pm/inputan_data_sdm');?>">Data SDM</a></li>
				<li  ><a href="<?php echo base_url('pm/selesaikan');?>">Final</a></li> 
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

		  <?php

			if(!empty($data2[0]['final']) == '1' && (!empty($data2[0]['kode_faskes']) == '' || $data2[0]['kode_faskes'] == NULL ) ){

			echo 'Data Registrasi Praktik Mandiri sedang diverifikasi'; 

		   } else {
		?>
           
		   <?php
		   if(!empty($user[0]['id_kategori'])){
		   ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
                    <table class="table table-bordered">
			 <tbody>
			 <tr>
				  <th>NO</th>
			      <th>SDM</th>
                  <th>JUMLAH /</th>
				  <!-- <th>SUB KETERANGAN</th> -->
				   <th>KETERANGAN</th>
             </tr>
				
		<?php
			$no=0;
			foreach(dropdown_sdm_pm($user[0]['id_kategori']) as $key => $value){
			$no++;
			
	
				foreach(dropdown_sdm_auth_pm($key) as $auth => $valueauth){ 
					if($valueauth=='wajib ada'){
					$authentifikasi	='required';
					}else{
					$authentifikasi	='';	
					}		
				}

				foreach(dropdown_sdm_max_pm($key) as $auth => $valueauth){ 
					if($valueauth){
					$max = $valueauth;
					}else{
					$max = '';	
					}		
				}
			
			


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
			 <input type="number" name="jumlah[<?=$key;?>]" value="<?=$value2['jumlah']?>" <?=$authentifikasi?>  max="<?=$max?>" placeholder="Jumlah" class="form-control" autocomplete="off" id="jumlah" min="0" >
			  </td>
			  <td>
			  <?php foreach(dropdown_data_sdm_sub_keterangan_pm($key) as $sub_keterangan => $valuesub_keterangan){ echo ($valuesub_keterangan=='Ada' ? '<input type="text" class="form-control" name="sub_keterangan['.$key.']" placeholder="Sebutkan"  value="'.$value2['sub_keterangan'].'">' : '<input type="hidden" class="form-control" name="sub_keterangan['.$key.']" placeholder="Sebutkan"  value="">');  }?>
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
			 <input type="number" name="jumlah[<?=$key;?>]" value=""  <?=$authentifikasi?> max="<?=$max?>" class="form-control"  placeholder="Jumlah"  autocomplete="off" id="jumlah" min="0" >
			  </td>
			  <td>
			  <?php foreach(dropdown_data_sdm_sub_keterangan_pm($key) as $sub_keterangan => $valuesub_keterangan){ echo ($valuesub_keterangan=='Ada' ? '<input type="text" class="form-control" name="sub_keterangan['.$key.']" placeholder="Sebutkan"  value="">' : '<input type="hidden" class="form-control" name="sub_keterangan['.$key.']" placeholder="Sebutkan"  value="">');  }?>
			 </td>	 
			<?php
			 }
			 ?>
			  <input type="hidden" name="id_sdm[]" value="<?=$key;?>">
			  <!-- <td><?php foreach(dropdown_sdm_keterangan_pm($key) as $key2 => $value2){ echo $value2;  }?></td> -->
			   </tr>
			 <?php
			}
			 ?>
			 </tbody>
	
               <tr>
			 <td></td>
			 <td></td>
			 <td> 
			 <input type="hidden" name="id_faskes" value="<?=$user_id;?>">
			 <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button></td>
			 </tr>
			
			 </table>
            </form>
			<?php
		   }else{
			 echo 'Harap Selesaikan Data Praktik Mandiri Terlebih Dahulu';  
		   }
			?>
          </div>

		  <?php
		   }
		  ?>
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
