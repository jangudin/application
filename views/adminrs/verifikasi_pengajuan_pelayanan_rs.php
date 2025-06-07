


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
             <li  ><a href="<?php echo base_url('rs/verifikasi_pengajuan_faskes_rs/').$this->encrypt->encode($user_id);?>">Data Dasar</a></li>
				<li ><a href="<?php echo base_url('rs/verifikasi_pengajuan_faskes_sdm_rs/').$this->encrypt->encode($user_id);?>">Data SDM</a></li>
				 <li ><a href="<?php echo base_url('rs/verifikasi_pengajuan_faskes_tt_rs/').$this->encrypt->encode($user_id);?>">Data TT</a></li>
				  <li  class="active"><a href="<?php echo base_url('rs/verifikasi_pengajuan_pelayanan_rs/').$this->encrypt->encode($user_id);?>">Data Pelayanan</a></li>
			  
			   <li><a href="<?php echo base_url('rs/verifikasikan_kirim_rs/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
			  

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
			      <th>SDM</th>
				 
                  <th>JUMLAH</th>
             </tr>
				
		<?php

			$no=0;
			foreach(dropdown_pelayanan_rs() as $key => $value){
			$no++;
			
	
			
			


			?>
			 <tr>
			 <td><?=$no;?></td>
			 <td><?=$value?></td>
			 
			 <?php
			 if(!empty($data)){
			 	foreach($data as $key2 => $value2){
					
				if($value2['id_pelayanan'] ==$key){
			 ?>
			 <td>
			 <input type="checkbox" name="ada[<?=$key;?>]" value="1" <?=$value2['ada']=='1' ? 'checked' : ''?>  id="ada<?=$key;?>" >
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
			 <input type="checkbox" name="ada[<?=$key;?>]" value="1"     id="ada<?=$key;?>" >
			 </td>	 
			<?php
			 }
			 ?>
			  <input type="hidden" name="id_pelayanan[]" value="<?=$key;?>">
			   </tr>
			 <?php
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
 
       
 $( "#type" ).change(function() {
  
	if(this.value=='Pengolahan Parasitologi Klinik'){
	 $('#pemeriksaan_tambahan').prop("disabled", true); 
	}else{
		 $('#pemeriksaan_tambahan').prop("disabled", false); 
	}
});
     
	 
	 
   $(function() {
	  $('.select2').select2();
	  $('[data-mask]').inputmask();
    
   });
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
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


 function detail_jenis_pemeriksaan(id_jenis_pemeriksaan)
   {
	// $.facebox.settings.overlay = 'false';

	 
	 $.facebox(function() {
				$.post('<?php echo site_url('dashboard/detail_jenis_pemeriksaan')?>'+"/"+id_jenis_pemeriksaan,function(data) {
					$.facebox(data);
			});
			});

   }
   
   </script>
<link href="<?php echo base_url('assets/css/facebox.css');?>" rel="stylesheet">
<script type="text/javascript" src="<?= base_url('assets/js/facebox.js');?>"></script>
 <script src="<?php echo base_url('assets/js/migrate.js');?>"></script>
				