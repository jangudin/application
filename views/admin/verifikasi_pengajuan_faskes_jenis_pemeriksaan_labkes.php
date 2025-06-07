


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
           <li  ><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_labkes/').$user_id;?>">Data Dasar</a></li>
			  <li ><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_alkes_labkes/').$user_id;?>" >Data Sarpras & Alkes</a></li>
			  <li ><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_sdm_labkes/').$user_id;?>">Data SDM</a></li>
			   <li class="active" ><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_jenis_pemeriksaan_labkes/').$user_id;?>">Data Jenis Pemeriksaan</a></li>
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
           
		
        
<hr>
<h3>LIST DATA</h3>
	   <table class="table table-bordered">
			 <tbody>
			 <tr>
			  <th>NO</th>
			  <th>TYPE</th>
			     <th>NIK</th>
				 <th>NAMA</th>
                 <th>FUNGSIONAL</th>
				  <th>ACTION</th>
             </tr>
			 
			 	
			<?php
			$no=0;
			foreach($data as $key => $value){
				$no++;
			?>
			 <tr>
			 <td><?=$no?></td>
			  <td><?=$value['type']?></td>
			 <td><?=$value['nik']?></td>
			 <td><?=$value['nama']?></td>
			 <td><?=$value['fungsional']?></td>
			 <td><a  onclick="detail_jenis_pemeriksaan('<?=$value['id'];?>')" class="btn btn-mini edit-btn"  ><button  class="btn btn-primary"><i class="glyphicon glyphicon-zoom-in"></i> View</button></a></td>
			</tr>
			<?php
			}
			?>
			 </tbody>
			
         
			 </table>
	
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
				