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
                  <li  ><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_labkes/').$this->encrypt->encode($user_id);?>">Data Dasar</a></li>
			  <li ><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_alkes_labkes/').$this->encrypt->encode($user_id);?>" >Data Sarpras & Alkes</a></li>
			  <li ><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_sdm_labkes/').$this->encrypt->encode($user_id);?>">Data SDM</a></li>
			   <li  ><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_jenis_pemeriksaan_labkes/').$this->encrypt->encode($user_id);?>">Data Pelayanan</a></li>
			  
			   <li class="active"><a href="<?php echo base_url('labkes/verifikasikan_kirim/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
			  
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
			<!--  <tr>
			 <td><b>Dinkes Propinsi</b></td>
			 <td>
			<!-- <?=form_dropdown('propinsi', dropdown_propinsi(), '','id="propinsi" class="form-control select2" required');?>
			 <input type="text" name="propinsi" value="<?=$user[0]['id_prov']?>">
			 </td>
			 </tr>
			  <tr>
			 <td><b>Dinkes Kota</b></td>
			 <td>
			<!--<?=form_dropdown('kota', dropdown_kab_kota(), '','id="kota" class="form-control select2"');?>
			 <input type="text" name="propinsi" value="<?=$user[0]['id_kota']?>">
			 </td>
			 </tr>
			 <tr>
			 <td><b>Apakah Data Faskes Sudah Di Verifikasi Dan Ingin Di Setujui?</b></td>
			 <td>
			 <input type="hidden" name="id_faskes" value="<?=$user_id?>">
			  <input type="hidden" name="propinsi" value="<?=$user[0]['id_prov']?>">
			  <input type="hidden" name="propinsi" value="<?=$user[0]['id_kota']?>">
			 <button type="submit" name="submit" id="submit"  class="btn btn-primary">KIRIM</button></td>
			 </tr>-->
			 <?php
			if(!empty($data[0]['status_validasi_prov']) && $data[0]['status_validasi_prov']=='Belum Validasi' && $user[0]['id_kategori']=='2'){
			 ?>
			 <tr>
			 <td><b>Apakah Data Fasyankes Sudah Di Verifikasi Dan Ingin Di Setujui? Jika Ya, Pemberitahuan AKan Di Kirimkan Ke Email Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi.</b></td>
			 <td>
			 <input type="hidden" name="id_faskes" value="<?=$user_id?>">
			  <input type="hidden" name="id_link" value="<?=$data[0]['id_link'];?>">
			  <input type="hidden" name="kode_regional_link" value="<?=$data[0]['kode_regional_link'];?>">
			 
			 <button type="submit" name="submit_setujui_prov" id="submit"  class="btn btn-primary">SETUJU</button></td>
			 </tr>
			  <tr>
			 <td><b>Apakah Data Ingin Minta Di Perbaiki?Data Akan Di Teruskan Ke Dinkes Kota</b><textarea style="float:right" placeholder="catatan..." name="catatan" size="40"></textarea></td>
			 <td>		
			 <button type="submit" name="submit_perbaikan_prov" id="submit"  class="btn btn-block btn-warning" >PERBAIKAN</button></td>
			 </tr>
			 <?php 
			 if(!empty($data[0]['kode_faskes_lama'])){
			?>
			 <tr>
			 <td colspan="2"><b>Kode Fasyankes Lama : <u><?=$data[0]['kode_faskes_lama']?></u></b></td>
			 </tr>
			<?php
			 }
		     ?>
			<?php
			}else if(!empty($data[0]['status_validasi_prov']) && $data[0]['status_validasi_prov']=='Perbaikan' && $user[0]['id_kategori']=='2'){
			 ?>
			 <tr>
			 <td><b>Sedang Diperbaiki Dinkes Kota.</b></td>		
			 </tr>
			 
			 <?php 
			 if(!empty($data[0]['kode_faskes_lama'])){
			?>
			 <tr>
			 <td colspan="2"><b>Kode Fasyankes Lama : <u><?=$data[0]['kode_faskes_lama']?></u></b></td>
			 </tr>
			<?php
			 }
		     ?>
			<?php
			}else if(!empty($data[0]['status_validasi_kemkes']) && $data[0]['status_validasi_kemkes']=='Belum Validasi'  && $user[0]['id_kategori']=='1'){
			 ?>
			 <tr>
			 <td><b>Apakah Data Fasyankes Sudah Di Verifikasi Dan Ingin Di Setujui? Jika Ya, Pemberitahuan AKan Di Kirimkan Ke Email Faskes Tekait Dan Faskes Terkait Akan Mendapatkan Kode Faskes Untuk Di Aktifasi.</b></td>
			 <td>
			 <input type="hidden" name="id_faskes" value="<?=$user_id?>">
			  <input type="hidden" name="id_link" value="<?=$data[0]['id_link'];?>">
			  <input type="hidden" name="kode_regional_link" value="<?=$data[0]['kode_regional_link'];?>">
			 
			 <button type="submit" name="submit_setujui_kemkes" id="submit"  class="btn btn-primary">SETUJU</button></td>
			 </tr>
			  <tr>
			 <td><b>Apakah Data Ingin Minta Di Perbaiki?Data Akan Di Teruskan Ke Dinkes Kota</b><textarea style="float:right" placeholder="catatan..." name="catatan" size="40"></textarea></td>
			 <td>		
			 <button type="submit" name="submit_perbaikan_kemkes" id="submit"  class="btn btn-block btn-warning" >PERBAIKAN</button></td>
			 </tr>
			 <?php 
			 if(!empty($data[0]['kode_faskes_lama'])){
			?>
			 <tr>
			 <td colspan="2"><b>Kode Fasyankes Lama : <u><?=$data[0]['kode_faskes_lama']?></u></b></td>
			 </tr>
			<?php
			 }
		     ?>
			<?php
			}else if(!empty($data[0]['status_validasi_kota']) && $data[0]['status_validasi_kota']=='Belum Validasi'){
			 ?>
			 <tr>
			 <td><b>Apakah Data Fasyankes Sudah Di Verifikasi Dan Ingin Di Setujui? Jika Ya, Data Akan Di Teruskan Ke <?=$data[0]['jenis_pratama_utama']=='Utama' ? 'Kemkes' : 'Dinkes Provinsi'?>.</b></td>
			 <td>
			 <input type="hidden" name="id_faskes" value="<?=$user_id?>">
			  <input type="hidden" name="id_link" value="<?=$data[0]['id_link'];?>">
			  <input type="hidden" name="kode_regional_link" value="<?=$data[0]['kode_regional_link'];?>">
			   <input type="hidden" name="jenis_pratama_utama" value="<?=$data[0]['jenis_pratama_utama'];?>">
			
			 
			 <button type="submit" name="submit_validasi" id="submit"  class="btn btn-primary">SETUJU</button></td>
			 </tr>
			  <tr>
			 <td><b>Apakah Data Ingin Minta Di Perbaiki?</b><textarea style="float:right" placeholder="catatan..." name="catatan" size="40"></textarea><br><?=(!empty($data[0]['catatan']) ? 'Catatan Perbaikan : '.$data[0]['catatan'] :'') ?></td>
			 <td>		
			 <button type="submit" name="submit_perbaikan" id="submit"  class="btn btn-block btn-warning" >PERBAIKAN</button></td>
			 </tr>
			 <?php 
			 if(!empty($data[0]['kode_faskes_lama'])){
			?>
			 <tr>
			 <td colspan="2"><b>Kode Fasyankes Lama : <u><?=$data[0]['kode_faskes_lama']?></u></b></td>
			 </tr>
			<?php
			 }
		     ?>
			<?php
			}else if(!empty($data[0]['token_kode_faskes'])){
				
			?>
			 <tr>
			 <td><b>Kode Fasyankes : </b> </td>
			 <td><?=$data[0]['kode_faskes_baru']?></td>
			 </tr>
			 <tr>
			 <td><b>Nama Fasyankes : </b> </td>
			 <td><?=$data2[0]['nama_lab']?></td>
			 </tr>
			 <tr>
			 <td><b>Provinsi : </b></td>
			 <td> <?=form_dropdown('id_prov', dropdown_propinsi(), $data2[0]['id_prov'],'id="id_prov" disabled class="form-control select2" ');?></td>
			 </tr>
			 <tr>
			 <td><b>Kab/Kota : </b></td>
			 <td> <?=form_dropdown('id_kota', dropdown_kota($data2[0]['id_prov']), $data2[0]['id_kota'],'id="id_kota" disabled class="form-control select2"');?></td>
			 </tr>
			 <tr>
			 <td><b>Kecamatan : </b></td>
			 <td> <?=form_dropdown('id_camat', dropdown_kecamatan($data2[0]['id_prov'],$data2[0]['id_kota']), $data2[0]['id_camat'],'id="id_camat" disabled class="form-control select2"');?></td>
			 </tr>
			  <tr>
			 <td><b>Alamat Fasyankes : </b></td>
			 <td> <textarea disabled name="alamat_faskes" id="alamat_faskes" class="form-control" rows="3"  ><?=(empty($data2[0]['alamat_faskes']) ? $user[0]['alamat'] : $data2[0]['alamat_faskes'])?></textarea></td>
			 </tr>
			 
			 
			<?php
			}else if(!empty($data[0]['id_validate_kota']) && $user[0]['id_kategori']=='3' ){
				if($data[0]['jenis_pratama_utama']=='Pratama'){
					$var_dinkes='Dinkes Propinsi';
				}else{
					$var_dinkes='Kemkes';
				}
			?>
			 <tr>
			 <td><b>Data Sudah Dikirim Ke <?=$var_dinkes?></b></td>
			 <td></td>
			 </tr>
			<?php
			}else{
			echo "Belum Di Validasi User";	
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
   
      $('[name="propinsi"]').change(function() {
		 $('#kota').val('');
		    $.ajax({
         url: "<?php echo site_url('dashboard/dropdown5')?>/" + $(this).val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="kota"]'), data, 'link', 'kab_kota');
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

           

         
				