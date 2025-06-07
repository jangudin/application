


  <!-- Main content -->
  <section class="content">

<div class="row">
 
  <!-- /.col -->
  <div class="col-md-12">
	<div class="nav-tabs-custom">
	  <ul class="nav nav-tabs">
		 <li  class="active"><a href="<?php echo base_url('dashboard/rekap_data_pm/');?>">Rekap Data Praktik Mandiri</a></li>
	   <li ><a href="<?php echo base_url('pm/monitoring_pm/').$user_id;?>">Monitoring Praktik Mandiri</a></li>
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
	   
<div class="form-group">

  <!--
  
	  <label class="col-sm-3 control-label">Tanggal Registrasi</label>
				  <div class="col-sm-2">
				   <input type="text"  name="tgl1" id="tgl1" placeholder="Dari" value="<?php echo (isset($_POST['tgl1']) ? $_POST['tgl1'] : '');?>" autocomplete="off" class="form-control datepicker" />
				  </div>	
			  
		  
				  <div class="col-sm-2">
				   <input  type="text"   value="<?php echo (isset($_POST['tgl2']) ? $_POST['tgl2'] : '');?>" name="tgl2" id="tgl2" class="form-control datepicker" placeholder="Sampai">
				  </div>
  -->
		  </div>
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
		   <label  class="col-sm-2 control-label">KATEGORI PRAKTIK MANDIRI</label>
			<div class="col-sm-5">
			<?=form_dropdown('id_kategori', array('9999' => 'ALL', '4' => 'Dokter', '5' => 'Dokter Gigi', '6' => 'Bidan', '7' => 'Perawat'), '','id="id_kategori" required class="form-control select2"');?>
			  
			</div>
			<div style="clear:both;"></div>
		  </div>

<div class="form-group">					
  <div class="col-sm-7" align="right">
  <input  class="btn btn-primary" type="submit" name="cari" value="Apply Filter">	
  </div>
  <div style="clear:both;"></div>
</div>
</form>
   <br>
		  <h3 class="page-header"></h3>
<div id="toPrint">
<form method="POST" action="" enctype="multipart/form-data">

<table class="table-bordered table-condensed" id="tblExport" style="font-size:12px; margin:10 10 10 0px;" width="100%">
  <tr>
	  <td  align="left"><b>No</b></td>
	  <td  align="left"><b>KODE PRAKTIK MANDIRI</b></td>
	  <td  align="left"><b>STATUS AKTIF</b></td>
	  <td  align="left"><b>TANGGAL REGISTRASI</b></td>
	  <td  align="left"><b>NAMA PRAKTIK MANDIRI</b></td>
	  <td  align="left"><b>KATEGORI PRAKTIK MANDIRI</b></td>
	  <td  align="left"><b>ALAMAT</b></td>
	  <td  align="left"><b>KAB/KOTA</b></td>
	  <td  align="left"><b>PROVINSI</b></td>
	  <td  align="left"><b>LATITUDE</b></td>
	  <td  align="left"><b>LONGITUDE</b></td>
	  <td  align="left"><b>TELEPON</b></td>
	  <td  align="left"><b>NO HP</b></td>
	  <td  align="left"><b>EMAIL</b></td>
	  <td  align="left"><b>DOKUMEN KOMITMEN</b></td>
      <td  align="left"><b>URL DOKUMEN KOMITMEN</b></td>
  </tr>
  <?php
  $no=0;
  foreach($data['query'] as $key => $value){
  $no++;

  if($value['status_aktif'] == 1){
	$status = 'Aktif';
  }else{
	$status = 'Tidak Aktif';
  }
  ?>
  <tr>
	  <td  align="left"><?=$no?></td>
	  <td  align="left"><?=$value['kode_faskes']?></td>
	  <td  align="left"><?=$status?></td>
	  <td  align="left"><?=date('d/m/Y',strtotime($value['tgl_buat_user']))?></td>
	  <td  align="left"><?=$value['nama_pm']?></td>
	  <td  align="left"><?=$value['kategori_user']?></td>
	  <td  align="left"><?=$value['alamat_faskes']?></td>
	  <td  align="left"><?=$value['nama_kota']?></td>
	  <td  align="left"><?=$value['nama_prop']?></td>
      <td  align="left"><?=$value['latitude']?></td>
      <td  align="left"><?=$value['longitude']?></td>
	  <td  align="left"><?=str_replace("_","",$value['no_telp'])?></td>
	  <td  align="left"><?=str_replace("_","",$value['no_hp'])?></td>
	  <td  align="left"><?=$value['email_pm']?></td>
	  <td  align="left"><?=$value['dokumen_komitmen']?></td>
      <td  align="left"><?=$value['url_dokumen_komitmen']?></td>
	  
  </tr>
  <?php
  }
  ?>

  </table>

  <div style=" margin-left:10px;">
  
  </div>
  <br><br>

  <!-- <input class="btn btn-primary" type="button" value="Laporan List Harian" /> -->
</form>
</div>


<a  id="eks"><button class="btn btn-mini edit-btn"  ><span class="glyphicon glyphicon-file"></span> Excell</button>	</a>
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
<script type="text/javascript">

   $("#eks").click(function () {

	var m_names = new Array("Januari", "Februari", "Maret",
	  "April", "Mei", "Juni", "Juli", "Agustus", "September",
	  "Oktober", "November", "Desember");

	var Name = 'Rekap-Data-';
	var d = new Date();
	var curr_date = d.getDate();
	var curr_month = d.getMonth();
	var curr_year = d.getFullYear();
	var blobURL = tableToExcel('tblExport');
	$(this).attr('download',Name+curr_date + "-" + m_names[curr_month]+ "-" + curr_year+'.xls')
	$(this).attr('href',blobURL);
});
  

$(document).ready(function () {
	$('.select2').select2();
	
  $("#btnExport").click(function () {
	  $("#tblExport").btechco_excelexport({
		  containerid: "tblExport"
		 , datatype: $datatype.Table
	  });
  });


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

function addOption(ele, data, key, val) { //alert(data.length);
$('option', ele).remove();

ele.append(new Option('ALL', 9999));
$(data).each(function(index) { //alert(eval('data[index].' + nama));
ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));

});
}


});
</script>
		  