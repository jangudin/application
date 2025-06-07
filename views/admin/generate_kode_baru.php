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
		   <form class="form-horizontal well" role="form" method="post" action="" >

     	<div class="form-group">
				<label  class="col-sm-2 control-label">JENIS</label>
				<div class="col-sm-5">
				<?=form_dropdown('jenis', array('5'=>'Klinik','6'=>'UTD','7'=>'Labkes'), (isset($_POST['jenis']) ? $_POST['jenis'] : ''),'id="jenis" class="form-control select2"');?>
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
<div id="dataklaim" style="overflow-x:auto;">
	<table class="table-bordered table-condensed" id="tblExport" style="font-size:12px; margin:10 10 10 0px;" width="100%">
        <tr>
            <th><b>ID FASKES</b></td>
			<th><b>PROPINSI</b></td>
			 <th><b>KAB KOTA</b></td>
			 <th><b>NAMA FASYANKES</b></td>
			 <th><b>ID PROP</b></td>
            <th><b>ID PROP/KAB KOTA</b></td>
            <th><b>JENIS FASYANKES</b></td>
            <th><b>NO URUT</b></td>
			<th><b>KODE LAMA</b></td>
			<th><b>PERKIRAAN KODE BARU</b></td>
			<th><b>KODE BARU</b></td>
			<th><b>CEK KESESUAIAAN</b></td>
        </tr>
		<?php
		$no=0;
	$x='temp';
		foreach($data['query'] as $key => $value){
		$no++;
			if($value['id_kota'] != $x ){
					$x=$value['id_kota'];
					$no=1;
			}
		?>
        <tr>
            <td  align="left"><?=$value['id']?></td>
			<td  align="left"><?=$value['nama_prop']?></td>
			<td  align="left"><?=$value['nama_kota']?></td>
			<td  align="left"><?=$value['nama_fasyankes']?></td>
			<td  align="left"><?=$value['id_prov']?></td>
            <td  align="left"><?=$value['id_kota']?></td>
            <td  align="left"><?=$value['jenis_klinik']?></td>
             <td  align="left"><?=str_pad($no, 5, "0", STR_PAD_LEFT)?></td>
			  <td  align="left"><?=$value['kode_faskes']?></td>
			 <td  align="left"><?=$value['id_kota']?><?=$value['jenis_klinik']?><?=str_pad($no, 5, "0", STR_PAD_LEFT)?></td>
			  <td  align="left"><?=$value['kode_faskes_baru']?></td>
			   <td  align="left"><?php if($value['id_kota'].$value['jenis_klinik'].str_pad($no, 5, "0", STR_PAD_LEFT)==$value['kode_faskes_baru']){
				   echo '<font color="green">Sesuai!</font>';
			   }else{
				   echo '<font color="red">Tidak Sesuai!</font>';
			   }
			   ?></td>
        </tr>
		<?php
		}
		?>
		</table>

	
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
             printElem({ printMode: 'popup', overrideElementCSS: ['https://registrasifasyankes.kemkes.go.id/assets/css/bootstrap.print.css'] });
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
				
