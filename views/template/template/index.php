<!DOCTYPE html>
<html>
<?php echo $headernya; 
if($this->session->userdata('user_id')!=null){
$class='';	
$tooglehtml='<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>';
$profilehtml=' <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="glyphicon glyphicon-user"></i>
              <span class="hidden-xs">'.$this->session->userdata("nama_lengkap").'</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                  <i class="glyphicon glyphicon-user"></i>

                <p>
                 '.$this->session->userdata("nama").'
                  <small>Member since '.(date("M Y",strtotime($this->session->userdata("tgl_buat_user")))).'</small>
                </p>
              </li>
            
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="'.base_url("dashboard/index").'" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="'.base_url("admin/logout").'" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>';
}else{
$class='sidebar-collapse';	
$tooglehtml='';
$profilehtml='';
}
?>
<body class="hold-transition skin-red <?=$class?> ">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R-F</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>REG FASYANKES</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
  <?=$tooglehtml;?>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
<?php
		/* $ci = & get_instance();
		  $select = $ci->db->query("
		  SELECT pendaftaran.* FROM pendaftaran WHERE pendaftaran.kode_rs='".$this->session->userdata('kode_rs')."' AND pendaftaran.status_baca='0'
		  ");
		    $rsData = $select->result_array();
		if(count($rsData) >=1){ */
		?>
		<!--<audio controls loop autoplay="autoplay" hidden="hidden">
		<source src="<?php echo base_url('assets/sound/inflicted.mp3');?>" type="audio/mpeg">
		</audio>-->
		<?php		
	//}
		?>
 <!--
         <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?php //echo count($rsData);?></span>
            </a> <!--
            <ul class="dropdown-menu">
             <li class="header">Anda Punya <?php echo count($rsData);?> Pemberitahuan</li>
              <li>
 
                <ul class="menu">
				<?php
				foreach($rsData as $keys => $value){
				?>
                  <li>
                    <a href="<?php echo base_url('dashboard/module_soap2').'/'.$value['id']; ?>">
                      <i class="fa fa-users text-aqua"></i><?php echo $value['email'].' Telah Mendaftar'; ?>
                    </a>
                  </li>
				  <?php
				}
				  ?>
                </ul>
              </li>
              <li class="footer"><a href="<?php echo base_url('dashboard/module_pendaftaran2'); ?>"">View all</a></li>
            </ul>
          </li>-->
          <!-- User Account: style can be found in dropdown.less -->
         <?=$profilehtml;?>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
   
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
		  <li >
          <a href="<?php echo base_url('dashboard/index');?>">
            <i class="glyphicon glyphicon-user"></i> <span>My Profile</span>
          </a>
        </li>
		
		<?php
		if($this->session->userdata('id_kategori')<4){
		?>
		 
		<li >
		<?php
		if($this->session->userdata('id_kategori')==3 || $this->session->userdata('id_kategori')==2){
		?>
			<li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mendaftar');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List User Yang Mendaftar</span>
          
          </a>
        </li>
		   <li >
	   <a href="<?php echo base_url('dashboard/list_user_yang_mengajukan');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi Klinik</span>
          
          </a>
	   </li>
	   
	      <li >
	   <a href="<?php echo base_url('dashboard/list_user_yang_mengajukan_labkes');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi Labkes</span>
          
          </a>
	   </li>
		<?php
		}
		if($this->session->userdata('id_kategori')==1){
		?>
		<li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mendaftar');?>">
            <i class="glyphicon glyphicon-list"></i> <span>User Klinik</span>
          
          </a>
        </li>
		 <li >
          <a href="<?php echo base_url('dashboard/list_user_dinkes_kota');?>">
            <i class="glyphicon glyphicon-list"></i> <span>User Dinkes Kab/Kota</span>
          
          </a>
        </li>
	 <li >
          <a href="<?php echo base_url('dashboard/list_user_dinkes_propinsi');?>">
            <i class="glyphicon glyphicon-list"></i> <span>User Dinkes Propinsi</span>
          
          </a>
        </li>
		 <li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mengajukan_pma');?>">
            <i class="glyphicon glyphicon-list"></i> <span>Registrasi Klinik(PMA)</span>
          
          </a>
		  </li>
		   <li class="active treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		<li>
          <a href="<?php echo base_url('dashboard/master_data_sdm');?>">
            <i class="fa fa-th"></i> <span>Data SDM</span>
          
          </a>
        </li>	
<li>
          <a href="<?php echo base_url('dashboard/master_data_sarpras');?>">
            <i class="fa fa-th"></i> <span>Data SARPRAS</span>
          
          </a>
        </li>		
		
		<li>
          <a href="<?php echo base_url('dashboard/master_data_propinsi');?>">
            <i class="fa fa-th"></i> <span>Data PROPINSI</span>
          
          </a>
        </li>	
          </ul>
        </li>
		
      <?php
		}
	  ?>
	
		<?php
		}
		?>
		<?php
		if($this->session->userdata('id_kategori')==5){
		?>
		 <li >
          <a href="<?php echo base_url('dashboard/inputan_data_faskes');?>">
            <i class="glyphicon glyphicon-edit"></i> <span>Registrasi Klinik</span>
          
          </a>
        </li>
		<?php
		}
		?>
		
			<?php
		if($this->session->userdata('id_kategori')==7){
		?>
		 <li >
          <a href="<?php echo base_url('dashboard/inputan_data_faskes_labkes');?>">
            <i class="glyphicon glyphicon-edit"></i> <span>Registrasi Labkes</span>
          
          </a>
        </li>
		<?php
		}
		?>
		
		<?php
		if($this->session->userdata('id_kategori')==2){
		?>
		 <li >
          <a href="<?php echo base_url('dashboard/list_user_dinkes_kota');?>">
            <i class="glyphicon glyphicon-list"></i> <span>User Dinkes Kab/Kota</span>
          
          </a>
        </li>
		<?php
		}
		
	
		?>
	<?php
	if($this->session->userdata('id_kategori')!=3){
	?>
		<li >
        <a href="<?php echo base_url('dashboard/list_timeline');?>">
        <i class="glyphicon glyphicon-list"></i> <span>History</span>
        </a>
		</li>
	<?php
	}
	?>
	
	<?php
	if($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==3 || $this->session->userdata('id_kategori')==2){
	?>
		<li >
        <a href="<?php echo base_url('dashboard/rekap_data');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap Data</span>
        </a>
		</li>
	<?php
	}
	?>
		 </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <!--  <section class="content-header">
      <h1> <i class="glyphicon glyphicon-user"></i>
       <?=$this->session->userdata('judul')?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(''.$this->router->fetch_class().'/index');?>"><i class="fa fa-dashboard"></i> <?php echo $this->router->fetch_class(); ?></a></li>
      </ol>
    </section> -->
<?php echo $contentnya; ?>
   <!-- /.content -->
  </div>



  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!--
<script type="text/javascript">

    function play_sound() {
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', '<?php echo base_url('assets/sound/inflicted.mp3');?>');
        audioElement.setAttribute('autoplay', 'autoplay');
        audioElement.load();
        audioElement.play();
    }
</script>
<?php
echo '<script type="text/javascript">play_sound();</script>';
?>-->
<script  type="text/javascript">
/* 
var time = new Date().getTime();
$(document.body).bind("mousemove keypress", function () {
    time = new Date().getTime();
});

setInterval(function() {
    if (new Date().getTime() - time >= 60000) {
        window.location.reload(true);
    }
}, 10000); */
</script>

</body>
<?php echo $footernya; ?>
</html>
