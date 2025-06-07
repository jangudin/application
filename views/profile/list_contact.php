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
              <li><a href="<?php echo site_url('dashboard')?>">Profil Saya</a></li>
			  <li class="active"><a href="<?php echo site_url('dashboard/list_contact')?>">Daftar Kontak</a></li>
			  <li><a href="<?php echo site_url('dashboard/inbox')?>">Pesan Masuk</a><?php if($getinbox[0]['dibaca'] !=NULL && $getinbox[0]['dibaca']==0) {?><span class="badge2">!</span><?php } ?></li>
			  <li><a href="<?php echo site_url('dashboard/outbox')?>">Pesan Keluar</a></li>

            </ul>
			<?php
			//if('1'=='3'){
			?>
            <div class="tab-content">
			
			/* DAFTAR KONTAK YANG BISA DI HUBUNGI APABILA ADA PERTANYAAN ATAU PEMBERITAHUAN KONFIRMASI
              <div class="active tab-pane" id="activity">
             <table class="table table-bordered">
			 <thead>
			 <th>NAMA LENGKAP</th> <th>JENIS</th> <th>PROVINSI</th><th>KOTA</th><th>ACTION</th>
			 </thead>
			 <tbody>
			 <?php
			 foreach($list_contact as $key => $value){
			 ?>
			 <tr>
			 <td><?=$value['nama_lengkap']?></td>
			 <td><?=$value['kategori_user']?></td>
			  <td><?=$value['nama_prop']?></td>
			  <td><?=$value['nama_kota']?></td>
			 <td><a href="<?php echo site_url('dashboard/kirim_pesan/'.$value['id'])?>">Kirim Pesan</a></td>
			 </tr>
			 <?php
			 }
			 ?>
			 </tbody>
			 </table>
                
				
              </div>
           
              </div>
			  <?php
			//}
			  ?>
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
 
