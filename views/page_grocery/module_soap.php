<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($data);

?>


    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">SOAP</a></li>

            </ul>
            <div class="tab-content">
			<?php
			$ci = & get_instance();
		  $select = $ci->db->query("
		  SELECT pendaftaran.*,data_pasien.nama_lengkap,data_pasien.alamat,data_pasien.telepon FROM `pendaftaran` LEFT JOIN data_pasien ON pendaftaran.email =data_pasien.email   WHERE pendaftaran.`id` = '".$this->uri->segment(3)." ' 
		  ");
		    $rsData = $select->result_array();
			?>
			<table class="table-bordered table-condensed" width="100%" border="1">
			<tr>
			<td colspan="6"><b>DETAIL PASIEN :</b></td>
			</tr>
			<tr>
			<td><b>Nama Pasien</b></td>
			<td>:</td>
			<td><?=$rsData[0]['nama_lengkap']?></td>
			<td><b>Email</b></td>
			<td>:</td>
			<td><?=$rsData[0]['email']?></td>
			</tr>
			<tr>
			<td><b>Alamat</b></td>
			<td>:</td>
			<td><?=$rsData[0]['alamat']?></td>
			<td><b>Telepon</b></td>
			<td>:</td>
			<td><?=$rsData[0]['telepon']?></td>
			</tr>
			</table>
              <div class="active tab-pane" id="activity">
             
                 
					<div style='height:20px;'></div>  
					<div style="padding: 10px">
					<?php echo $output; ?>
					</div>
					<?php foreach($js_files as $file): ?>
					<script src="<?php echo $file; ?>"></script>
					<?php endforeach; ?>
				
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
 
