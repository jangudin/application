<style>
 #scrollToTop, #scrollToBottom
  /*      {
             cursor:pointer;
             background-color:#0090CB;
             display:inline-block;
             height:40px;
             width:40px;
             color:#fff;
             font-size:16pt;
             text-align:center;
             text-decoration:none;
             line-height:40px;
        } */
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
			   <li  class="active"><a href="<?php echo base_url('dashboard/rekap_data_klinik/').$user_id;?>">Rekap Data Klinik</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
             <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
		   <form class="form-horizontal well" role="form" method="post">
 <?php
if($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 ||  $this->session->userdata('id_kategori')==2 ){
?>
   
<?php
if($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8){
?>	

  	<div class="form-group">
				<label  class="col-sm-2 control-label">PROVINSI </label>
				<div class="col-sm-5">
				<?=form_dropdown('id_prov', dropdown_propinsi(), (isset($_POST['id_prov']) ? $_POST['id_prov'] : ''),'id="id_prov" class="form-control select2"');?>
				</div>  
				<div style="clear:both;"></div>
				</div>
 <?php
}
?> 
<?php
if($this->session->userdata('id_kategori')==2 ){
?>					
				<div class="form-group">
				<label  class="col-sm-2 control-label">KAB/KOTA</label>
				<div class="col-sm-5">
				<?=form_dropdown('id_kota', dropdown_kota($this->session->userdata('id_prov')), (isset($_POST['id_kota']) ? $_POST['id_kota'] : ''),'id="id_kota" class="form-control select2"');?>
				</div>  
				<div style="clear:both;"></div>
				</div>
 <?php
}else{
?> 	
<div class="form-group">
				<label  class="col-sm-2 control-label">KAB/KOTA</label>
				<div class="col-sm-5">
				<?=form_dropdown('id_kota', dropdown_kota((isset($_POST['id_prov']) ? $_POST['id_prov'] : $data[0]['id_prov'])), (isset($_POST['id_kota']) ? $_POST['id_kota'] : ''),'id="id_kota" class="form-control select2"');?>
				</div>  
				<div style="clear:both;"></div>
				</div>
 <?php
}
?> 



 <?php
}
?> 
   <div class="form-group">
				 <label  class="col-sm-2 control-label">JENIS KLINIK</label>
				  <div class="col-sm-5">
				  <?=form_dropdown('jenis_klinik', dropdown_jenis_klinik_all(),(isset($_POST['jenis_klinik']) ? $_POST['jenis_klinik'] : '') ,'id="jenis_klinik"  class="form-control select2"');?>
				    
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">JENIS PELAYANAN</label>
				  <div class="col-sm-5">
				  <?=form_dropdown('jenis_perawatan', dropdown_jenis_perawatan_all(), (isset($_POST['jenis_perawatan']) ? $_POST['jenis_perawatan'] : ''),'id="jenis_perawatan"  class="form-control select2"');?>
				  
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<!-- <div class="form-group">
				 <label  class="col-sm-2 control-label">PERSALINAN</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('persalinan', dropdown_persalinan_all(), (isset($_POST['persalinan']) ? $_POST['persalinan'] : ''),'id="persalinan" class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div> -->
	<div class="form-group">					
        <div class="col-sm-7" align="right">
		<input  class="btn btn-primary" type="submit" name="cari" value="Apply Filter">	
        </div>
		<div style="clear:both;"></div>
    </div>
</form>
		 
    			<h3 class="page-header"><?php echo $title;?></h3>
<div>
<form method="POST" action="" enctype="multipart/form-data">
<div id="dataklaim" style="overflow-x:auto;">
	<table class="table table-bordered table-hover table-responsive" id="example"><thead>
		<tr>
			<th><b>No</b></td>
			<th><b>EMAIL</b></td>
            <th><b>TELEPON</b></td>
            <th><b>KODE KLINIK</b></td>
            
            <th><b>NAMA KLINIK</b></td>
            <th><b>JENIS KLINIK</b></td>
            <th><b>JENIS PELAYANAN</b></td>
<th><b>TANGGAL REGISTRASI</b></td>
            <th><b>ALAMAT</b></td>
            <th><b>CAMAT</b></td>
            <th><b>KAB/KOTA</b></td>
            <th><b>PROPINSI</b></td>
            <th><b>PEMILIK</b></td>
<th><b>NAMA PEMILIK</b></td>
<th><b>PENYELENGGARA</b></td>
<th><b>PELAKU USAHA</b></td>
<th><b>KERJASAMA BPJS</b></td>
<th><b>BERJEJARING PUSKESMAS</b></td>
<th><b>PROGRAM PRIORITAS</b></td>
<th><b>NAMA PUSKESMAS</b></td>
<th><b>KODE BPJS</b></td>
<th><b>AKREDITASI</b></td>
		</tr>
        </thead>
        <tbody>
		<?php
		$no=0;
		foreach($data['query'] as $key => $value){
		$no++;
		?>
		<tr>
			<td  align="left"><?=$no?></td>
			<td  align="left"><?=$value['email_klinik']?></td>
            <td  align="left"><?=$value['no_telp']?></td>
            <td  align="left"><?=$value['kode_faskes_baru']?></td>
			<td  align="left"><?=$value['nama_klinik']?></td>
			<td  align="left"><?=$value['jenis_klinik']?></td>
			<td  align="left"><?=$value['jenis_perawatan_terbaru']?></td>
            <td  align="left"><?=date('d/m/Y',strtotime($value['tgl_buat_user']))?></td>
			<td  align="left"><?=$value['alamat_faskes']?></td>
			<td  align="left"><?=$value['nama_camat']?></td>
			<td  align="left"><?=$value['nama_kota']?></td>
            <td  align="left"><?=$value['nama_prop']?></td>
            
            <td  align="left"><?=$value['pemilik']?></td>
            <td  align="left"><?=$value['nama_pemilik']?></td>
            <td  align="left"><?=$value['penyelenggara']?></td>
            <td  align="left"><?=$value['pelaku_usaha']?></td>
            <td  align="left"><?=$value['kerja_sama_bpjs_kesehatan']?></td>
            <td  align="left"><?=$value['berjejaring_dengan_puskesmas']?></td>
            <td  align="left"><?=$value['program_prioritas_nasional']?></td>
            <td  align="left"><?=$value['nama_puskesmas']?></td>
            <td  align="left"><?=$value['kode_bpjs']?></td>
            <td  align="left"><?=$value['akreditasi']?></td>
			
		</tr>
		<?php
		}
		?>
       </tbody>
		</table>

		<div style=" margin-left:10px;">
		
		</div>
		<br><br>
</div>
		<!-- <input class="btn btn-primary" type="button" value="Laporan List Harian" /> -->
	</form>
	</div>
</div>
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

 <script type = "text/javascript">
       /* $(function () {
            $('#scrollToBottom').bind("click", function () {
                $('html, body').animate({ scrollTop: $(document).height() }, 1200);
                return false;
            });
            $('#scrollToTop').bind("click", function () {
                $('html, body').animate({ scrollTop: 0 }, 1200);
                return false;
            });
        }); */

$(document).ready(function(){
                  
          $('#example').DataTable({
         "paging": true,
           "lengthChange": false,
           "searching": true,
           "ordering": true,
           "info": true,
           "autoWidth": false,
           "bDestroy": true,
           dom: 'Bfrtip',
         buttons: [
             'excel', 'csv'
         ]
         });
})
                  
    </script>
  <script type="text/javascript">
  
  	  
		

    $(document).ready(function () {
		 
		  
        /*$("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport"
               , datatype: $datatype.Table
            });
        });*/
   

 $(".datepicker").datepicker({autoclose: true, dateformat: 'dd-mm-yy' });
 
 $('[name="id_prov"]').change(function() {
		 $('#id_kota').val('');
		  $('#id_camat').val('');
		    $.ajax({
         url: "<?php echo site_url('dashboard/dropdown4')?>/" + $(this).val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="id_kota"]'), data, 'id_kota', 'nama_kota');
         }
      }); 
	  
	 
   });
   
   /*function addOption(ele, data, key, val) { //alert(data.length);
   $('option', ele).remove();
  
   ele.append(new Option('ALL', 9999));
   $(data).each(function(index) { //alert(eval('data[index].' + nama));
      ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));
	 
   });
}*/
   
 
  });
   </script>
				
