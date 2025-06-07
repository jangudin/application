<?php
ini_set("memory_limit","512M");
?>
<link rel="stylesheet" href="https://registrasifasyankes.kemkes.go.id/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://registrasifasyankes.kemkes.go.id/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://registrasifasyankes.kemkes.go.id/assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="https://registrasifasyankes.kemkes.go.id/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://registrasifasyankes.kemkes.go.id/assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="https://registrasifasyankes.kemkes.go.id/assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://registrasifasyankes.kemkes.go.id/assets/bower_components/select2/dist/css/select2.min.css">

    <link rel="stylesheet" href="https://registrasifasyankes.kemkes.go.id/assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="https://registrasifasyankes.kemkes.go.id/assets/css/datepicker.css">
	<!-- jQuery 3 -->
<script src="https://registrasifasyankes.kemkes.go.id/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://registrasifasyankes.kemkes.go.id/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://registrasifasyankes.kemkes.go.id/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://registrasifasyankes.kemkes.go.id/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="https://registrasifasyankes.kemkes.go.id/assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="https://registrasifasyankes.kemkes.go.id/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://registrasifasyankes.kemkes.go.id/assets/dist/js/demo.js"></script>

<script src="https://registrasifasyankes.kemkes.go.id/assets/js/bootstrap-datepicker.js"></script>
<script src="https://registrasifasyankes.kemkes.go.id/assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="https://registrasifasyankes.kemkes.go.id/assets/js/bootstrap-typeahead.js"></script>
<script src="https://registrasifasyankes.kemkes.go.id/assets/js/eksel.js"></script>

<script src="https://registrasifasyankes.kemkes.go.id/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="https://registrasifasyankes.kemkes.go.id/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="https://registrasifasyankes.kemkes.go.id/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript" src="https://registrasifasyankes.kemkes.go.id/assets/js/js_excel/jquery.battatech.excelexport.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<script>
if (typeof $ == 'undefined') {
   var $ = jQuery;
}
</script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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



		 <br> <div align = "right">
<a href="javascript:;" id="scrollToBottom">&#x25BC;</a>
</div>
    			<h3 class="page-header"><?php echo $title;?></h3>
<div id="DivIdToPrint">

<form method="POST" action="" enctype="multipart/form-data">
<div id="dataklaim" style="overflow-x:auto;">
	<table class="table-bordered table-condensed" id="tblExport" style="font-size:12px; margin:10 10 10 0px;" width="100%">
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
            <th><b>LATITUDE</b></td>
            <th><b>LONGITUDE</b></td>
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
      <td  align="left"><?=$value['latitude']?></td>
      <td  align="left"><?=$value['longitude']?></td>
            
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
				
