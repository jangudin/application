  <!-- banner part start-->
    <section class="banner_part" style="margin-top:100px;">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
   
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
	  <?php
		foreach($promosi as $key_promosi => $value_promosi){
			if($key_promosi==0){
				$active='active';
			}else{
				$active='';
			}
		?>
					 
      <div class="carousel-item <?=$active?>" style="background-image:url('<?php echo base_url('assets/uploads/promosi').'/'.$value_promosi['img'];?>')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4"><a href="<?php echo base_url('home/pages_promosi').'/'.$value_promosi['id']; ?>"> <?=$value_promosi['title_header'];?></a></h2>
          <p class="lead"><a href="<?php echo base_url('home/pages_promosi').'/'.$value_promosi['id']; ?>"><?=$value_promosi['title_detail'];?></a></p>
        </div>
      </div>
	  <?php
		}
	  ?>

  
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>


    </section>
    <!-- banner part start-->
							