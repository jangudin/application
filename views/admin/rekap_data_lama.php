<style>
 #scrollToTop, #scrollToBottom
        {
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
        }
</style>
 <script type = "text/javascript">
        $(function () {
            $('#scrollToBottom').bind("click", function () {
                $('html, body').animate({ scrollTop: $(document).height() }, 1200);
                return false;
            });
            $('#scrollToTop').bind("click", function () {
                $('html, body').animate({ scrollTop: 0 }, 1200);
                return false;
            });
        });
    </script>
	<?php
	$user_id='';
	?>
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
				   <li  ><a href="<?php echo base_url('dashboard/rekap_data_rs_all/').$user_id;?>">Rekap Data RS</a></li>
				 <li ><a href="<?php echo base_url('dashboard/monitoring_rs_all/').$user_id;?>">Monitoring RS</a></li>
				  <li  ><a href="<?php echo base_url('dashboard/rekap_data_utd_all/').$user_id;?>">Rekap Data UTD</a></li>
				 <li ><a href="<?php echo base_url('dashboard/monitoring_utd_all/').$user_id;?>">Monitoring UTD</a></li>
				  <li  ><a href="<?php echo base_url('dashboard/rekap_data_pm_all/').$user_id;?>">Rekap Data Praktik Mandiri</a></li>
				 <li ><a href="<?php echo base_url('dashboard/monitoring_pm_all/').$user_id;?>">Monitoring Praktik Mandiri</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
             <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
<?php

?>
          <!-- The time line -->
		   <form class="form-horizontal well" role="form" method="post" action="<?php echo base_url('dashboard/rekap_data_target_blank');?>" target="_blank">
 <?php
 
if($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 ||  $this->session->userdata('id_kategori')==2 ||  $this->session->userdata('id_kategori')==10){
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
if($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==8 ||  $this->session->userdata('id_kategori')==10){
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
				<?=form_dropdown('id_kota', dropdown_kota((isset($_POST['id_prov']) ? $_POST['id_prov'] : '')), (isset($_POST['id_kota']) ? $_POST['id_kota'] : ''),'id="id_kota" class="form-control select2"');?>
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
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">PERSALINAN</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('persalinan', dropdown_persalinan_all(), (isset($_POST['persalinan']) ? $_POST['persalinan'] : ''),'id="persalinan" class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">SORTING</label>
				  <div class="col-sm-2">
                 <?=form_dropdown('sorting', array('kode_faskes'=>'Kode Faskes','tgl_buat_user'=>'Tanggal Registrasi','create_kode'=>'Tanggal Create Kode','nama_klinik'=>'Nama Faskes','jenis_klinik_terbaru'=>'Jenis Faskes','jenis_perawatan_terbaru'=>'Jenis Pelayanan','persalinan'=>'Persalinan','nama_kota'=>'Kab/Kota','nama_prop'=>'Provinsi','email_klinik'=>'Email'), (isset($_POST['sorting']) ? $_POST['sorting'] : ''),'id="sorting" class="form-control select2"');?>
				  </div>
				   <div class="col-sm-2">
                 <?=form_dropdown('type_sorting', array('ASC'=>'ASC','DESC'=>'DESC'), (isset($_POST['type_sorting']) ? $_POST['type_sorting'] : ''),'id="type_sorting" class="form-control select2"');?>
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

		 <br> <div align = "right">
<a href="javascript:;" id="scrollToBottom">&#x25BC;</a>
</div>
    			<h3 class="page-header"><?php echo $title;?></h3>
<div id="DivIdToPrint">

<form method="POST" action="" enctype="multipart/form-data">

	<table class="table-bordered table-condensed" id="tblExport" style="font-size:12px; margin:10 10 10 0px;" width="100%">
		<tr>
			<td  align="left"><b>No</b></td>
			<td  align="left"><b>TANGGAL REGISTRASI</b></td>
			<td  align="left"><b>TANGGAL CREATE</b></td>
			<td  align="left"><b>NAMA KLINIK/ KODE</b></td>
			<td  align="left"><b>JENIS KLINIK</b></td>
			<td  align="left"><b>JENIS PELAYANAN</b></td>
			<td  align="left"><b>ALAMAT</b></td>
			<td  align="left"><b>KAB/KOTA</b></td>
			<td  align="left"><b>PROVINSI</b></td>
		</tr>
		<?php
		$no=0;
	
		foreach($data['query'] as $key => $value){
		$no++;
		?>
		<tr>
			<td  align="left"><?=$no?></td>
			<td  align="left"><?=date('d/m/Y',strtotime($value['tgl_buat_user']))?></td>
			<td  align="left"><?=date('d/m/Y',strtotime($value['create_kode']))?></td>
			<td  align="left"><?=$value['nama_klinik']?>/ <?=$value['kode_faskes_baru']?></td>
			<td  align="left"><?=$value['jenis_klinik_terbaru']?></td>
			<td  align="left"><?=$value['jenis_perawatan_terbaru']?></td>
			<td  align="left"><?=$value['alamat_faskes']?></td>
			<td  align="left"><?=$value['nama_kota']?></td>
			<td  align="left"><?=$value['nama_prop']?></td>

		</tr>
		<?php
		}
		?>
		</table>

	
		<!-- <input class="btn btn-primary" type="button" value="Laporan List Harian" /> -->
	</form>
	</div>
<a  id="eks"><button class="btn btn-mini edit-btn"  ><span class="glyphicon glyphicon-file"></span> Excell</button>	</a>
 <div align = "right">
<a href="javascript:;" id="scrollToTop">&#x25B2;</a>
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
				