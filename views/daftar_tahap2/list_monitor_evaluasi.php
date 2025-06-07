<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
		  <?php  $this->load->view('daftar_tahap2/sub_menu'); ?>
         
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
    

					<div style='height:20px;'></div>  
					<div style="padding: 10px">
					<?php echo $output; ?>
					</div>
					<?php foreach($js_files as $file): ?>
					<script src="<?php echo $file; ?>"></script>
					<?php endforeach; ?>
     
				 </div>
     
              <div class="tab-pane" id="timeline">
              
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
			  
              </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

      <!-- /.row -->

    