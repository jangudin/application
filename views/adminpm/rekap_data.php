


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
			   <li  class="active"><a href="<?php echo base_url('dashboard/rekap_data/').$user_id;?>">Rekap Data Klinik</a></li>
			    <li ><a href="<?php echo base_url('dashboard/rekap_data_lab/').$user_id;?>">Rekap Data Lab/Bank Jaringan</a></li>
				 <li ><a href="<?php echo base_url('dashboard/monitoring_lab_all/').$user_id;?>">Monitoring Lab/Bank Jaringan</a></li>
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
?>   <div class="form-group">
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
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">PERSALINAN</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('persalinan', dropdown_persalinan_all(), (isset($_POST['persalinan']) ? $_POST['persalinan'] : ''),'id="persalinan" class="form-control select2"');?>
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
    			<h3 class="page-header"><?php echo $title;?></h3>
<div id="DivIdToPrint">
<form method="POST" action="" enctype="multipart/form-data">

	<table class="table-bordered table-condensed" id="tblExport" style="font-size:12px; margin:10 10 10 0px;" width="100%">
		<tr>
			<td  align="left"><b>No</b></td>
			<td  align="left"><b>KODE KLINIK</b></td>
			<td  align="left"><b>TANGGAL REGISTRASI</b></td>
			<td  align="left"><b>NAMA KLINIK</b></td>
			<td  align="left"><b>JENIS KLINIK</b></td>
			<td  align="left"><b>JENIS PELAYANAN</b></td>
			<td  align="left"><b>PERSALINAN</b></td>
			<td  align="left"><b>ALAMAT</b></td>
			<td  align="left"><b>KAB/KOTA</b></td>
			<td  align="left"><b>PROVINSI</b></td>
			<td  align="left"><b>TELEPON</b></td>
			<td  align="left"><b>EMAIL</b></td>
		</tr>
		<?php
		$no=0;
		foreach($data['query'] as $key => $value){
		$no++;
		?>
		<tr>
			<td  align="left"><?=$no?></td>
			<td  align="left"><?=$value['kode_faskes']?></td>
			<td  align="left"><?=date('d/m/Y',strtotime($value['tgl_buat_user']))?></td>
			<td  align="left"><?=$value['nama_klinik']?></td>
			<td  align="left"><?=$value['jenis_klinik_terbaru']?></td>
			<td  align="left"><?=$value['jenis_perawatan_terbaru']?></td>
			<td  align="left"><?=$value['persalinan']?></td>
			<td  align="left"><?=$value['alamat_faskes']?></td>
			<td  align="left"><?=$value['nama_kota']?></td>
			<td  align="left"><?=$value['nama_prop']?></td>
			<td  align="left"><?=str_replace("_","",$value['no_telp'])?></td>
			<td  align="left"><?=$value['email_klinik']?></td>
			
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
<button class="btn btn-mini edit-btn" onclick='printDiv();'  value="Print" id="externalCSS"><span class="glyphicon glyphicon-print"></span> Print</button> | <a  id="eks"><button class="btn btn-mini edit-btn"  ><span class="glyphicon glyphicon-file"></span> Excell</button>	</a>
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
	
	function printDiv() 
{
var divToPrint=document.getElementById('DivIdToPrint');
var newWin=window.open('','Print-Window');
newWin.document.open();
newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
newWin.document.close();
setTimeout(function(){newWin.close();},1);
}
	
	function printElem(options){
      $('#toPrint').printElement(options);
    }
	

		

    $(document).ready(function () {
		  $('.select2').select2();
		  
       $("#btnExport").click(function () {
            $("#toPrint").btechco_excelexport({
                containerid: "toPrint"
               , datatype: $datatype.Table
            });
        });
		$("#externalCSS").click(function() {
             printElem({ printMode: 'popup', overrideElementCSS: ['<?=base_url("assets/css/bootstrap.print.css");?>'] });
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
				