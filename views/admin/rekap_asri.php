<?php
ini_set("memory_limit","512M");
?>
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
            
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
             <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
<?php

?>
          <!-- The time line -->
          <form class="form-horizontal well" role="form" method="post" action="">
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

<div class="form-group">					
        <div class="col-sm-7" align="right">
		      <input  class="btn btn-primary" type="submit" name="cari" value="Apply Filter">	
        </div>
		    <div style="clear:both;"></div>
    </div>
</form>

 <?php
}
?> 

  
				
				
	  

		 <br> <div align = "right">
<a href="javascript:;" id="scrollToBottom">&#x25BC;</a>
</div>
    			<h3 class="page-header">LIST FASKES SUDAH VERIFIKASI ASRI</h3>
<div id="DivIdToPrint">

<form method="POST" action="" enctype="multipart/form-data">
<div id="dataklaim" style="overflow-x:auto;">
<div class="table-responsive">
	<table class="table-bordered table-condensed" id="tblExport" style="font-size:12px; margin:10 10 10 0px;" width="100%">
        <tr>
            <th><b>No</b></td>
            <th><b>KODE FASKES</b></td>
            <th><b>NAMA FASKES</b></td>
            <th><b>JENIS</b></td>
            <th><b>PROVINSI</b></td>
            <th><b>KAB/KOTA</b></td>
            <th><b>EMAIL</b></td>
            <th><b>STATUS PUNYA RME</b></td>
            <th><b>NAMA VENDOR</b></td> 
            <th><b>TANGGAL ISI RME</b></td> 
            <th><b>SATUSEHAT ID</b></td>
            <th><b>TANGGAL GET SATUSEHAT ID</b></td>
            <th><b>KIRIM DATA KE SATUSEHAT</b></td>
            <th><b>SDM</b></td>
        </tr>
		<?php
		$no=0;
	
		foreach($data['query'] as $key => $value){
		$no++;
		?>
        <tr>
            <td  align="left"><?=$no?></td>
            <td  align="left"><?=$value['kode_faskes']?></td>
            <td  align="left"><?=$value['nama_pm']?></td>
            <td  align="left"><?=$value['kategori_user']?></td>
            <td  align="left"><?=$value['provinsi']?></td>
            <td  align="left"><?=$value['kabkota']?></td>
            <td  align="left"><?=$value['email']?></td>
            <td  align="left">
                <!-- <?=$value['status']?> -->
                <?php
                    if($value['status'] == 0 && $value['status'] != null){
                        echo "Tidak";
                    } else if ($value['status'] == 1) {
                        echo "Ya"; 
                    } else {

                    }

                ?>
            </td>
            
            <td  align="left"><?=$value['vendor']?></td>
            <td  align="left"><?=$value['tanggal_isi_rme']?></td>
            <td  align="left">
                      <?php
                          if(!empty($value['organization_id'])){
                              echo "Ada";
                          } else {
                          }

                      ?>
                  </td>
            <td  align="left"><?=$value['tanggal_satset']?></td>
            <td  align="left"><?=$value['kirim_satu_sehat']?></td>
            <td  align="left"><?=(!empty($value['cek_sdm']) ? '&#10004;' : '')?></td>
        </tr>
		<?php
		}
		?>
		</table>
  </div>
	
		<!-- <input class="btn btn-primary" type="button" value="Laporan List Harian" /> -->
	</form>
  </div>
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
				
