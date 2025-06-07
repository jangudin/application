<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
		   <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">List Pendaftaran User Detail</a></li>
              <li><a href="<?php echo base_url('daftar/buat_user/'.$this->uri->segment(3));?>" >List User Account</a></li>
              <li><a href="#settings" data-toggle="tab"></a></li>
            </ul>
         
            <div class="tab-content">
			 <a href="<?php echo base_url('daftar/list_pendaftaran_user');?>">
            <i class="glyphicon glyphicon-arrow-left"></i> <span>Back</span>
          
          </a>

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

    