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
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">Ã—</button>
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
            <ul class="nav nav-tabs">
            <li ><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes/').$user_id;?>">Data Dasar</a></li>	  
            <?php
                // var_dump($user[0]['id_kategori']);
					if ($user[0]['id_kategori']==4 || $user[0]['id_kategori']==5){
				?>
					<li ><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_alkes_new/').$user_id;?>">Data Alkes</a></li>
					<li class="active"><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_obat/').$user_id;?>">Data Obat</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_gambar/').$user_id;?>">Data Dokumen</a></li>
				
        <?php }elseif($user[0]['id_kategori']==6 || $user[0]['id_kategori']==7 ){ ?>
					<li class="active"><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_obat/').$user_id;?>">Data Obat</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_gambar/').$user_id;?>">Data Dokumen</a></li>

        <?php
					} else {
				?>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_alkes/').$user_id;?>">Data Sarpras & Alkes</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_sdm/').$user_id;?>">Data SDM</a></li>
				<?php
					}
				?>
			    <?php
				if($this->session->userdata('id_kategori') =='1'){
			   ?>
			   <li><a href="<?php echo base_url('pm/verifikasikan_kirim/').$user_id;?>">Verifikasikan</a></li>
			   <?php
			   }else if($this->session->userdata('id_kategori') =='3'){
			   ?>
			    <li><a href="<?php echo base_url('pm/verifikasikan_kirim/').$user_id;?>">Verifikasikan</a></li>
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
                    <th>Nama Obat</th>
                    <th>Jenis Sediaan</th>
                    <th>No Batch</th>
                    <th>Nama Perusahaan</th>
                    <th>Sumber Pembelian</th>
                </tr>

                <?php 
                $no=0;
                foreach ($data as $key => $value) { 
                    $no++;
                ?>
                
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$value['obat_id']?></td>
                        <td><?=$value['jenis_sediaan_id']?></td>
                        <td><?=$value['no_batch']?></td>
                        <td><?=$value['nama_perusahaan']?></td>
                        <td><?=$value['sumber_pembelian']?></td>
                    </tr>
                <?php } ?> 
				

			 </tbody>
		
			 <tr>
			 <td colspan="3" align="center"></td>
			 </tr>
		
			  
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
