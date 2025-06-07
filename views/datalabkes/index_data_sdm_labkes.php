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
			  <li  class="active"><a href="<?php echo base_url('labkes/inputan_data_sdm_labkes');?>">Struktur Organisasi</a></li>
			   <li ><a href="<?php echo base_url('labkes/inputan_jenis_pemeriksaan_labkes');?>">Data Pelayanan</a></li>
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
			     <th>NAMA</th>
				 <th>JABATAN</th>
                 <th>PENDIDIKAN</th>
				  <th>ACTION</th>
             </tr>
			
			 <tr>
			 <td><input type="text" name="nama" value=""    class="form-control"  placeholder="Nama" required  autocomplete="off" id="nama" ></td>
			 <td><?=form_dropdown('id_jabatan',dropdown_sdm_labkes_jabatan(), '','id="jabatan" class="form-control select2" width="100%" required');?></td>
			<td><?=form_dropdown('id_pendidikan',dropdown_sdm_labkes_pendidikan(), '','id="pendidikan" class="form-control select2" width="100%" required');?></td>	 
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
	   <table class="table table-bordered">
			 <tbody>
			 <tr>
			  <th>NO</th>
			     <th>NAMA</th>
				 <th>JABATAN</th>
                 <th>PENDIDIKAN</th>
				  <th>ACTION</th>
             </tr>
			<?php
			$no=0;
			foreach($data as $key => $value){
				$no++;
			?>
			 <tr>
			 <td><?=$no?></td>
			 <td><?=$value['nama']?></td>
			 <td><?=$value['jabatan']?></td>
			 <td><?=$value['pendidikan']?></td>
			 <td><a onclick="return confirm('Apakah Anda Yakin?')" href="<?php echo base_url('dashboard/inputan_data_sdm_labkes')."/".$value['id'];?>"><button type="submit" name="submit" id="submit"  class="btn btn-primary">Hapus</button></a></td>
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
