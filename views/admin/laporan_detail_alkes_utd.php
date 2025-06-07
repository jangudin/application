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
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
       
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
			<a  id="eks"><button class="btn btn-mini edit-btn"  ><span class="glyphicon glyphicon-file"></span> Excell</button>	</a> | <button class="btn btn-mini edit-btn"  value="Print" id="externalCSS"><span class="glyphicon glyphicon-print"></span> Print</button>
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
			<div id="toPrint">
                    <table class="table table-bordered" id="tblExport">
			 <tbody>
			 <tr>
				  <th>NO</th>
				  <th>NAMA RUANG</th>
				  <th>JENIS PERALATAN</th>
                  <th>ADA</th>
				 
             </tr>
				
		<?php
			$no=0;
			foreach(dropdown_alkes_utd($user[0]['jenis_utd']) as $key => $value){
			$no++;
            foreach($data as $key2 => $value2){
				if($value2['id_alkes']==$key){
					$isian=$value2['isian'];
					$keterangan=$value2['keterangan'];
				}
			}
			?>
			
			 <tr>
			 <td><?=$no;?></td>
			 <td><?php 	foreach(dropdown_alkes_nama_ruang($key) as $key3 => $value3){ echo $value3; } ?></td>
			  <td><?=$value?></td>
			<td>
			<?=($isian =='Ada' ? '<span>&#10003;</span>' : '')?>
		
	
			  <input type="hidden" name="id_alkes[]" value="<?=$key;?>">
			   </tr>
			 <?php
			}
			 ?>
			 </tbody>
	
			  
			 </table>
			 </div>
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
   
 
	function printElem(options){
      $('#toPrint').printElement(options);
    }
	
	  $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#toPrint").btechco_excelexport({
                containerid: "toPrint"
               , datatype: $datatype.Table
            });
        });
		$("#externalCSS").click(function() {
             printElem({ printMode: 'popup', overrideElementCSS: ['<?=base_url("assets/css/bootstrap.print.css");?>'] });
        });
    });

</script>		
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.printElement.min.js');?>"></script>
 <script src="<?php echo base_url('assets/js/migrate.js');?>"></script>