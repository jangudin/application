<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
.carousel-item {
  height: 50vh;
  min-height: 150px;
  background: no-repeat center center scroll;
   -moz-background-size: 100% 100%;
    -o-background-size: 100% 100%;
    -webkit-background-size: 100% 100%; 
    background-size: 100% 100%;
}

</style>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                      <h2 style="color:blue;">Home Care</h2>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
						<?php  $this->load->view('home/menu_utama',array('menu_utama'=>$menu_utama,'menu_turunan'=>$menu_turunan)); ?>
                        <a class="btn_2 d-none d-lg-block" href="#">HOT LINE- 09856</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <section class="padding_top">
        <div class="container">
            <div class="row justify-content-between ">
                <div class="col-md-6 col-lg-6" >
                    <div class="about_us_img">
                        <img   src="<?php echo base_url('assets/uploads/promosi').'/'.$promosi[0]['img'];?>" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
        
                        <h2><?=$promosi[0]['title_detail']?></h2>
                        <p><?=$promosi[0]['isi_halaman']?></p>
         
                  
                   
                </div>
            </div>
        </div>
    </section>
    <!-- about us part end-->



    <!-- footer part end-->

    <!-- jquery plugins here-->

    <script src="<?php echo base_url('assets/front/js/jquery-1.12.1.min.js');?>"></script>
    <!-- popper js -->
    <script src="<?php echo base_url('assets/front/js/popper.min.js');?>"></script>
    <!-- bootstrap js -->
    <script src="<?php echo base_url('assets/front/js/bootstrap.min.js');?>"></script>
    <!-- owl carousel js -->
    <script src="<?php echo base_url('assets/front/js/owl.carousel.min.js');?>"></script>
    <script src="<?php echo base_url('assets/front/js/jquery.nice-select.min.js');?>"></script>
    <!-- contact js -->
    <script src="<?php echo base_url('assets/front/js/jquery.ajaxchimp.min.js');?>"></script>
    <script src="<?php echo base_url('assets/front/js/jquery.form.js');?>"></script>
    <script src="<?php echo base_url('assets/front/js/jquery.validate.min.js');?>"></script>
    <script src="<?php echo base_url('assets/front/js/mail-script.js');?>"></script>
    <script src="<?php echo base_url('assets/front/js/contact.js');?>"></script>
    <!-- custom js -->
    <script src="<?php echo base_url('assets/front/js/custom.js');?>"></script>
</body>