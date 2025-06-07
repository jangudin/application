


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
			   <li  class="active"><a href="<?php echo base_url('dashboard/timeline/').$user_id;?>">Timeline</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
             <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
    
      
	  <?php
	 foreach ($data['query'] as $key => $value) {
		 if(!empty($value['id_dinkes'])){
			 $warna='bg-red';
		 }else{
			  $warna='bg-aqua';
		 }
	  ?>
	  <!-- timeline item -->
            <li>
              <i class="fa fa-user <?=$warna?>"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?=date('d-m-Y H:i:s',strtotime($value['create_time']))?></span>

                <h3 class="timeline-header no-border"><a href="#"><?=$value['status']?></a> </h3>
              </div>
            </li>
            <!-- END timeline item -->
	  <?php
	 }
	  ?>
       



    </section>
                
				
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
 
				