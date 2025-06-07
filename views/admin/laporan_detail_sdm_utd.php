


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
         
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
            <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <!-- left column -->
        <div class="col-md-12" >
          <!-- general form elements -->
          <div class="box box-primary">
           
		   <?php
		   if(!empty($user[0]['jenis_utd'])){
		   ?>
            <!-- /.box-header -->
            <!-- form start -->
			<a  id="eks"><button class="btn btn-mini edit-btn"  ><span class="glyphicon glyphicon-file"></span> Excell</button>	</a> | <button class="btn btn-mini edit-btn"  value="Print" id="externalCSS"><span class="glyphicon glyphicon-print"></span> Print</button>

            <form role="form" method="POST" action="" enctype='multipart/form-data'>
			<div id="toPrint">
                    <table class="table table-bordered" id="tblExport" >
			 <tbody>
			 <tr>
				  <th>NO</th>
			      <th>SDM</th> 
                  <th>JUMLAH</th>
				  <th>KETERANGAN</th>
             </tr>
				
		<?php

			$no=0;
			foreach(dropdown_sdm_utd() as $key => $value){
			$no++;
			
	
			
			


			?>
			 <tr>
			 <td><?=$no;?></td>
			 <td><?=$value?></td>
			 
			 <?php
			 if(!empty($data)){
			 	foreach($data as $key2 => $value2){
					
				if($value2['id_sdm'] ==$key){
			 ?>
			 <td>
			<?=$value2['jumlah']?>
			 </td>	
			 <?php
				}else{
			 ?>

			 <?php
				}
			 ?>
			
			 <?php
			}?>
			
			<?php
			}else{
			?>
			 	 <td>
			 
			 </td>	 
			<?php
			 }
			 ?>
			 <td width="30%"><?php 	foreach(dropdown_data_sdm_utd_sub_keterangan($key) as $key3 => $value3){ echo $value3; } ?></td>
			  <input type="hidden" name="id_sdm[]" value="<?=$key;?>">
			   </tr>
			 <?php
			}
			 ?>
			 </tbody>
	</table>
	</div>
            </form>
			<?php
		   }else{
			 echo 'Harap Selesaikan Data Dasar UTD Terlebih Dahulu';  
		   }
			?>
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