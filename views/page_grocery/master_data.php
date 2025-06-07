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
              <li class="active"><a href="#activity" data-toggle="tab">Master Data</a></li>

            </ul>
            <div class="tab-content">
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
 
