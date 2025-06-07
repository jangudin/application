<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <!-- Main content -->
    <section class="content">

      <div class="row">
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
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="<?php echo site_url('dashboard')?>">Profil Saya</a></li>
			 <!-- <li><a href="<?php echo site_url('dashboard/list_contact')?>">Daftar Kontak</a></li>
			  <li><a href="<?php echo site_url('dashboard/inbox')?>">Pesan Masuk</a><?php if($getinbox[0]['dibaca'] !=NULL && $getinbox[0]['dibaca']==0) {?><span class="badge2">!</span><?php } ?></li>
			  <li ><a href="<?php echo site_url('dashboard/outbox')?>">Pesan Keluar</a></li>-->

            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
             <table class="table table-bordered">
			 <tbody>
			 <tr>
			 <td><b>EMAIL</b></td><td>:</td><td><?=$data[0]['email']?></td> <td><b>NAMA LENGKAP</b></td><td>:</td><td><?=$data[0]['nama_lengkap']?></td>
			 </tr>
			  <tr>
			 <td><b>JENIS USER</b></td><td>:</td><td><?=$data[0]['kategori_user']?> (<?=$data[0]['keterangan']?>)</td> <td><b>NO KTP</b></td><td>:</td><td><?=$data[0]['no_ktp']?></td>
			 </tr>
			 
			  <tr>
			 <td><b>TEMPAT/TGL LAHIR</b></td><td>:</td><td><?=$data[0]['tempat_lahir']?>/ <?=date('d-m-Y',strtotime($data[0]['tgl_lahir']))?></td> <td><b>JENIS KELAMIN</b></td><td>:</td><td><?=form_dropdown('jenis_kelamin', dropdown_jenis_kelamin(), $data[0]['jenis_kelamin'],'id="jenis_kelamin" disabled class="form-control select2"');?></td>
			 </tr>
			 
			 <tr>
			 <td><b>NO HP</b></td><td>:</td><td><?=$data[0]['no_hp']?></td> <td><b>TANGGAL REGISTRASI</b></td><td>:</td><td><?=date('d-m-Y H:i:s',strtotime($data[0]['tgl_buat_user']))?></td>
			 </tr>
			 
			  <tr>
			 <td><b>PROPINSI</b></td><td>:</td><td><?=form_dropdown('propinsi', dropdown_propinsi(), $data[0]['id_prov'],'id="propinsi" class="form-control select2" disabled');?></td> <td><b>KOTA/KAB</b></td><td>:</td><td><?=form_dropdown('kota', dropdown_kota($data[0]['id_prov']), $data[0]['id_kota'],'id="kota" class="form-control select2" disabled');?></td>
			 </tr>
			 
			   <tr>
			 <td><b>KECAMATAN</b></td><td>:</td><td><?=form_dropdown('kecamatan', dropdown_kecamatan( $data[0]['id_prov'],$data[0]['id_kota']), $data[0]['id_camat'],'id="kecamatan" class="form-control select2" disabled');?>
			</td> <td><b>ALAMAT</b></td><td>:</td><td><?=$data[0]['alamat'];?></td>
			 </tr>
			 
			 <tr>
			 <td><b>JABATAN</b></td><td>:</td><td><?=$data[0]['jabatan'];?></td>
			<td><b>NAMA FASYANKES</b></td><td>:</td><td><?=$data[0]['nama_fasyankes'];?> </td>
			 </tr>
			  <tr>
			 <td colspan='6'> <a href="<?php echo base_url('dashboard/edit_profile_new/'.$this->encrypt->encode($data[0]['id']));?>">
        <button class="btn btn-primary edit-btn" type="submit"  id="btnExport"><span class="glyphicon glyphicon-pencil"></span> EDIT PROFILE</button></a> | <a href="<?php echo base_url('dashboard/edit_profile/'.$this->encrypt->encode($data[0]['id']));?>">
        <button class="btn btn-primary edit-btn" type="submit"  id="btnExport"><span class="glyphicon glyphicon-pencil"></span> GANTI PASSWORD</button></a>		</td>
			 </tr>
			 </tbody>
			 </table>
                
				
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
 
