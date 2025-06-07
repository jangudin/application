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
              <li  ><a href="<?php echo base_url('labkes/inputan_data_faskes_labkes');?>">Data Dasar</a></li>
			  <li ><a href="<?php echo base_url('labkes/inputan_data_sarpras_alkes_labkes');?>" >Data Sarpras & Alkes</a></li>
			  <li  ><a href="<?php echo base_url('labkes/inputan_data_sdm_labkes');?>">Struktur Organisasi</a></li>
			  <li class="active" ><a href="<?php echo base_url('labkes/inputan_jenis_pemeriksaan_labkes');?>">Data Jenis Pemeriksaan</a></li>
			   <li  ><a href="<?php echo base_url('labkes/selesaikan_labkes');?>">Kirim Data</a></li>
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
			 <td colspan="6"><b>DATA DASAR</b></td>
			 </tr>
			 <tr>
			     <td width="10%">NIK</td><td width="1%">:</td><td width="20%"><input type="text" name="nik" value=""    class="form-control"  placeholder="NIK" required  autocomplete="off" id="nik" ></td>
			     <td width="15%">NAMA</td><td width="1%">:</td><td width="30%"><input type="text" name="nama" value=""    class="form-control"  placeholder="NAMA" required  autocomplete="off" id="nama" ></td>
             </tr>
			  <tr>
			    <td>FUNGSIONAL</td><td>:</td><td><?=form_dropdown('fungsional',dropdown_fungsional_labkes(), '','id="fungsional" class="form-control select2" required');?></td>
				<td>TYPE PEMERIKSAAN</td><td>:</td><td><?=form_dropdown('type',dropdown_jenis_pemeriksaan_type(), '','id="type" class="form-control select2" required');?></td>
             </tr>
			   <tr>
			    <td>FUNGSIONAL LAINNYA</td><td>:</td><td colspan="4"><textarea disabled name="fungsional_lainnya" id="fungsional_lainnya"></textarea></td>
				
             </tr>
			 <tr>
			 <td colspan="6"><b>DOKUMEN SIP</b></td>
			 </tr>
			  <tr>
			     <td>UPLOAD DOKUMEN</td><td>:</td><td><input type="file"  name="upload_dokumen_sip"  id="upload_dokumen_sip" ></td>
				   <td>SIP</td><td>:</td><td><input type="text" name="sip" value=""    class="form-control"  placeholder="SIP" required  autocomplete="off" id="sip" ></td>
             </tr>
			 
			  <tr> 
			     <td>SIP KE</td><td>:</td><td><input type="text" name="sip_ke" value=""    class="form-control"  placeholder="SIP KE" required  autocomplete="off" id="sip_ke" ></td>

			     <td>TANGGAL BERAKHIR</td><td>:</td><td><input type="text" name="tanggal_berakhir_sip" value=""    class="form-control datepicker"  placeholder="TANGGAL BERAKHIR SIP" required  autocomplete="off" id="datepicker" ></td>
             </tr>
			  <tr>
			 <td colspan="6"><b>DOKUMEN STR</b></td>
			 </tr>
			 
			   <tr> 
			     <td>UPLOAD DOKUMEN</td><td>:</td><td><input type="file"  name="upload_dokumen_str"  id="upload_dokumen_str" ></td>

			     <td>STR</td><td>:</td><td><input type="text" name="str" value=""    class="form-control"  placeholder="STR"   autocomplete="off" id="str" ></td>
             </tr>
			 
			  <tr> 
			     <td>TANGGAL BERAKHIR </td><td>:</td><td><input type="text" name="tanggal_berakhir_str" value=""    class="form-control datepicker"  placeholder="TANGGAL BERAKHIR STR" required  autocomplete="off" id="datepicker" ></td>
				 <td></td><td></td><td></td>
             </tr>
			   <tr>
			 <td colspan="6"><b>DOKUMEN PENDIDIKAN DAN PELATIHAN</b></td>
			 </tr>
			 <tr> 
			     <td>UPLOAD DOKUMEN </td><td>:</td><td><input type="file"  name="upload_dokumen_penddikan_dan_pelatihan"  id="upload_dokumen_penddikan_dan_pelatihan" ></td>

			     <td>PENDIDIKAN DAN PELATIHAN</td><td>:</td><td><input type="text" name="penddikan_dan_pelatihan" value=""    class="form-control"  placeholder="PENDIDIKAN DAN PELATIHAN"   autocomplete="off" id="penddikan_dan_pelatihan" ></td>
             </tr>
			 
			  <tr> 
			     <td>TANGGAL MULAI </td><td>:</td><td><input type="text" name="tanggal_pendidikan_dan_pelatihan" value=""    class="form-control datepicker"  placeholder="TANGGAL MULAI" required  autocomplete="off" id="datepicker" ></td>

			 <td></td><td></td><td></td>
             </tr>
			  <tr>
			 <td colspan="6"><b>DATA PEMERIKSAAN</b></td>
			 </tr>
			 
			  <tr> 
			     <td>JENIS PEMERIKSAAN</td><td>:</td><td><?=form_dropdown('jenis_pemeriksaan[]',dropdown_jenis_pemeriksaan(), '','id="jenis_pemeriksaan" class="form-control select2" multiple');?></td>

			     <td>PEMERIKSAAN TAMBAHAN</td><td>:</td><td><?=form_dropdown('pemeriksaan_tambahan[]',dropdown_pemeriksaan_tambahan(), '','id="pemeriksaan_tambahan" disabled class="form-control select2" multiple ');?></td>
             </tr>
			 
			  <tr> 
			     <td>PEMERIKSAAN TAMBAHAN LAINNYA</td><td>:</td><td><textarea disabled name="pemeriksaan_tambahan_lainnya" id="pemeriksaan_tambahan_lainnya"></textarea></td>

			   
             </tr>
			 

			
				
				
			  <tr>	
			  <td></td>	 
			    <td></td>	
				 <td  colspan="3"></td>	 
			  <td><?php
				if(empty($data2[0]['final'])){
			?><input type="hidden" name="id_faskes" value="<?=$user_id;?>">
			 <button type="submit" name="submit" id="submit"  class="btn btn-primary">Simpan</button>
			 <?php
			}else{
			 ?>
			 <font color="orange">Data Sedang Di Verifikasi</font>
			  <?php
			}
			 ?>
			 </td>	 
	 </tr>
			 </tbody>
			
         
			 </table>
            </form>
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
			 <td><a  onclick="detail_jenis_pemeriksaan('<?=$value['id'];?>')" class="btn btn-mini edit-btn"  ><button  class="btn btn-primary"><i class="glyphicon glyphicon-zoom-in"></i> View</button></a> | <a onclick="return confirm('Apakah Anda Yakin?')" href="<?php echo base_url('dashboard/inputan_jenis_pemeriksaan_labkes')."/".$value['id'];?>"><button type="submit" name="submit" id="submit"  class="btn btn-primary">Hapus</button></a></td>
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
  
	if(this.value=='Pemeriksaan Parasitologi Klinik'){
	 $('#pemeriksaan_tambahan').prop("disabled", true); 
	 $('#pemeriksaan_tambahan_lainnya').prop("disabled", true); 
	 
	}else{
		 $('#pemeriksaan_tambahan').prop("disabled", false); 
		 $('#pemeriksaan_tambahan_lainnya').prop("disabled", false); 
	}
});


 $( "#fungsional" ).change(function() {
  
	if(this.value=='Dokter Spesialis Lainnya'){
	 $('#fungsional_lainnya').prop("disabled", false); 
	 
	}else{
		 $('#fungsional_lainnya').prop("disabled", true); 
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