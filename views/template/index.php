<!DOCTYPE html>
<html>
<?php echo $headernya; 
if($this->session->userdata('user_id')!=NULL && $this->session->userdata('id_kategori')!= NULL){
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
<style>
.badge {
  position: absolute;
 top: 0px;
 right: 100px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}

.badge2 {
  position: absolute;
 top: 0px;
 right: 0px;
  padding: 2px 5px;
  border-radius: 30%;
  background-color: red;
  color: white;
}
</style>
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
		<?php if($this->session->userdata('id_kategori') != NULL){ ?>
		  <li >
          <a href="<?php echo base_url('dashboard/index');?>">
            <i class="glyphicon glyphicon-user"></i> <span>Profil Saya</span>
          </a>
        </li>
		<?php }
		?>
		<?php
		if($this->session->userdata('id_kategori')<4){
		?>
		 
		<li >
		<?php
		if($this->session->userdata('id_kategori')==3 || $this->session->userdata('id_kategori')==2){
		?>
		<?php
		if($this->session->userdata('type_user') =='Klinik' || $this->session->userdata('type_user') =='Admin'){
		?>
			<li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mendaftar');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List User Yang Mendaftar(Klinik)</span>
          
          </a>
        </li>
		  <?php
		}
	   ?>
	   <?php
		if($this->session->userdata('type_user') =='Labkes' || $this->session->userdata('type_user') =='Admin'){
		?>
			<li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mendaftar_labkes');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List User Yang Mendaftar(Lab)</span>
          
          </a>
        </li>
		  <?php
		}
	   ?>
	   
	   <?php
		if($this->session->userdata('type_user') =='RS' || $this->session->userdata('type_user') =='Admin'){
		?>
			<li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mendaftar_rs');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List User Yang Mendaftar(RS)</span>
          
          </a>
        </li>
		  <?php
		}
	   ?>
	   
	     <?php
		if($this->session->userdata('type_user') =='UTD' || $this->session->userdata('type_user') =='Admin'){
		?>
			<li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mendaftar_utd');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List User Yang Mendaftar(UTD)</span>
          
          </a>
        </li>
		  <?php
		}
	   ?>

		<?php
		if($this->session->userdata('type_user') =='Praktik Mandiri' || $this->session->userdata('type_user') =='Admin'){
		?>
			<li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mendaftar_pm');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List User Yang Mendaftar(PM)</span>
          
          </a>
        </li>
		  <?php
		}
	   ?>

		<?php
		if($this->session->userdata('type_user') =='Puskesmas' || $this->session->userdata('type_user') =='Admin'){
		?>
			<li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mendaftar_puskesmas');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List User Yang Mendaftar(Puskesmas)</span>
          
          </a>
        </li>
		  <?php
		}
	   ?>

			<?php
		if($this->session->userdata('type_user') =='Klinik' || $this->session->userdata('type_user') =='Admin'){
		?>
		   <li >
	   <a href="<?php echo base_url('dashboard/list_user_yang_mengajukan');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi Klinik</span>
          
          </a>
	   </li>
	   <?php
		}
	   ?>
	  
	   <?php
		if($this->session->userdata('id_kategori')==3 ){
		?>
		<?php
		if($this->session->userdata('type_user') =='Labkes' || $this->session->userdata('type_user') =='Admin'){
		?>
	      <li >
	   <a href="<?php echo base_url('labkes/list_user_yang_mengajukan_labkes');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi Labkes/Bank Jaringan</span>
          
          </a>
	   </li>
	
	    <?php
		}
	   ?>
	       <?php
		if($this->session->userdata('type_user') =='RS' || $this->session->userdata('type_user') =='Admin'){
		?>
	     <li >
	   <a href="<?php echo base_url('rs/list_user_yang_mengajukan_kota');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi RS</span>
          
          </a>
	   </li>
	     <?php
		}
	   ?>
	         <?php
		if($this->session->userdata('type_user') =='UTD' || $this->session->userdata('type_user') =='Admin'){
		?>
	     <li >
	   <a href="<?php echo base_url('utd/list_user_yang_mengajukan_kota');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi UTD</span>
          
          </a>
	   </li>
	     <?php
		}
	   ?>

		<?php
		if($this->session->userdata('type_user') =='Praktik Mandiri' || $this->session->userdata('type_user') =='Admin'){
		?>
	     <li >
	   <a href="<?php echo base_url('pm/list_user_yang_mengajukan');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi PM</span>
          
          </a>
	   </li>
	     <?php
		}
	   ?>

		<?php
		}else{
			?>
			 <?php
		if($this->session->userdata('type_user') =='Labkes' || $this->session->userdata('type_user') =='Admin'){
		?>
		  <li >
	   <a href="<?php echo base_url('labkes/list_user_yang_mengajukan_labkes_pratama');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi Labkes/Bank Jaringan(Pratama)</span>
          
          </a>
	   </li>
  <?php
		}
	   ?>	   
	    <?php
		if($this->session->userdata('type_user') =='RS' || $this->session->userdata('type_user') =='Admin'){
		?>
	     <li >
	   <a href="<?php echo base_url('rs/list_user_yang_mengajukan_prov');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi RS</span>
          
          </a>
	   </li>
	     <?php
		}
	   ?>
	     <?php
		if($this->session->userdata('type_user') =='UTD' || $this->session->userdata('type_user') =='Admin'){
		?>
	     <li >
	   <a href="<?php echo base_url('utd/list_user_yang_mengajukan_prov');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi UTD</span>
          
          </a>
	   </li>
	     <?php
		}
	   ?>

		<?php
		if($this->session->userdata('type_user') =='Praktik Mandiri' || $this->session->userdata('type_user') =='Admin'){
		?>
	     <li >
	   <a href="<?php echo base_url('pm/list_user_yang_mengajukan');?>">
            <i class="glyphicon glyphicon-list"></i> <span>List Registrasi PM</span>
          
          </a>
	   </li>
	     <?php
		}
	   ?>

	   
			<?php
		}
		?>
		
	   <?php
		}
		if($this->session->userdata('id_kategori')==1){
		?>
		<!--<li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mendaftar');?>">
            <i class="glyphicon glyphicon-list"></i> <span>User Fasyankes</span>
          
          </a>
        </li>-->
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
	  <?php
		if($this->session->userdata('type_user') =='Klinik' || $this->session->userdata('type_user') =='Admin'){
		?>
		 <li >
          <a href="<?php echo base_url('dashboard/list_user_yang_mengajukan_pma');?>">
            <i class="glyphicon glyphicon-list"></i> <span>Registrasi Klinik(PMA)</span>
          
          </a>
		  </li>
		     <li >
	   <a href="<?php echo base_url('dashboard/list_user_yang_mengajukan');?>">
            <i class="glyphicon glyphicon-list"></i> <span>Registrasi Klinik</span>
          
          </a>
	   </li>
	   <?php
		}
	   ?>
	   	  <?php
		if($this->session->userdata('type_user') =='Labkes' || $this->session->userdata('type_user') =='Admin'){
		?>
		   <li >
	   <a href="<?php echo base_url('labkes/list_user_yang_mengajukan_labkes_utama');?>">
            <i class="glyphicon glyphicon-list"></i> <span>Registrasi Labkes/Bank Jaringan(Utama)</span>
          
          </a>
	   </li>
	     <?php
		}
	   ?>
	     <?php
		if($this->session->userdata('type_user') =='RS' || $this->session->userdata('type_user') =='Admin'){
		?>
	     <li >
	   <a href="<?php echo base_url('rs/list_user_yang_mengajukan_kemkes');?>">
            <i class="glyphicon glyphicon-list"></i> <span>Registrasi RS</span>
          
          </a>
	   </li>
	     <?php
		}
	   ?>
<?php
		if($this->session->userdata('type_user') =='Klinik' || $this->session->userdata('type_user') =='Admin'){
		?>
		   <li class="active treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Master Data Klinik</span>
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
		<?php
		if($this->session->userdata('type_user') =='Admin'){
		?>
		<li>
          <a href="<?php echo base_url('dashboard/master_user_akses');?>">
            <i class="fa fa-th"></i> <span>Data User Akses</span>
          
          </a>
        </li>	
		<?php
		}
		?>
          </ul>
        </li>
		<?php
		}
	  ?>
		<?php
		if($this->session->userdata('type_user') =='UTD' || $this->session->userdata('type_user') =='Admin'){
		?>
		   <li class="active treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Master Data UTD</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		<li>
          <a href="<?php echo base_url('dashboard/master_data_sdm_utd');?>">
            <i class="fa fa-th"></i> <span>Data SDM</span>
          
          </a>
        </li>	
		<li>
          <a href="<?php echo base_url('dashboard/master_data_sarpras_utd');?>">
            <i class="fa fa-th"></i> <span>Data SARPRAS</span>
          
          </a>
        </li>		
		<li>
          <a href="<?php echo base_url('dashboard/master_data_alkes_utd');?>">
            <i class="fa fa-th"></i> <span>Data ALKES</span>
          
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
		}
		?>
		
		<?php
		if($this->session->userdata('id_kategori')==4){
		?>
		 <li >
          <a href="<?php echo base_url('rs/inputan_data_faskes_rs');?>">
            <i class="glyphicon glyphicon-edit"></i> <span>Registrasi RS</span>
          
          </a>
        </li>
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
          <a href="<?php echo base_url('labkes/inputan_data_faskes_labkes');?>">
            <i class="glyphicon glyphicon-edit"></i> <span>Registrasi Labkes/Bank Jaringan</span>
          
          </a>
        </li>
		<?php
		}
		?>
		
		<?php
		if($this->session->userdata('id_kategori')==6){
		?>
		 <li >
          <a href="<?php echo base_url('utd/inputan_data_faskes_utd');?>">
            <i class="glyphicon glyphicon-edit"></i> <span>Registrasi UTD</span>
          
          </a>
        </li>
		<?php
		}
		?>

		<?php
		if($this->session->userdata('id_kategori')==9){
		?>
		 <li >
          <a href="<?php echo base_url('pm/inputan_data_pm');?>">
            <i class="glyphicon glyphicon-edit"></i> <span>Registrasi Praktik Mandiri</span>
          
          </a>
        </li>
		<?php
		}
		?>

		<?php
		if($this->session->userdata('id_kategori')==9){
			if($this->session->userdata('id_kategori_pm') ==4 || $this->session->userdata('id_kategori_pm') ==5){
		?>
		 <li >
          <a href="<?php echo base_url('pm/index_review');?>">
            <i class="glyphicon glyphicon-edit"></i> <span>Kepuasan Pasien</span>
          
          </a>
        </li>
		<?php
			}
		}
		?>

		<?php
		if($this->session->userdata('id_kategori')==9){
			if($this->session->userdata('id_kategori_pm') ==4 || $this->session->userdata('id_kategori_pm') ==5){
		?>
		 <li >
          <a href="<?php echo base_url('pm/index_pembiayaan_kesehatan_pasien');?>">
            <i class="glyphicon glyphicon-edit"></i> <span>Pelaporan</span>
          
          </a>
        </li>
		<?php
			}
		}
		?>

		<?php
		if($this->session->userdata('id_kategori')==9){
			if($this->session->userdata('id_kategori_pm') ==4 || $this->session->userdata('id_kategori_pm') ==5){
		?>
		 <li >
          <a href="<?php echo base_url('pm/index_daftar_usulan');?>">
            <i class="glyphicon glyphicon-edit"></i> <span>Usulan Akreditasi</span>
          
          </a>
        </li>
		<?php
			}
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
	if($this->session->userdata('id_kategori')!=3 && $this->session->userdata('id_kategori')!=12 && $this->session->userdata('id_kategori')!=NULL ){
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
	if($this->session->userdata('id_kategori')==12 ){
	?>
		<li >
        <a href="<?php echo base_url('dashboard/list_pcare');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap Bridging PCare</span>
        </a>
		</li>
	<?php
	}
	?>
	
	<?php
	if($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==3 || $this->session->userdata('id_kategori')==2 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10){
	?>
	<?php
		if($this->session->userdata('type_user') =='Admin'){
		?>
		<li >
        <a href="<?php echo base_url('dashboard/rekap_data');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap Data</span>
        </a>
		</li>
    <li >
        <a href="<?php echo base_url('pm/satu_sehat_terkoneksi');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap SatuSehat Terkoneksi</span>
        </a>
		</li>
	<?php
		}
	?>

	<?php
		if($this->session->userdata('id_kategori')==1){
		?>
    <li >
        <a href="<?php echo base_url('pm/update_satu_sehat_terkoneksi');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Update SatuSehat Terkoneksi</span>
        </a>
		</li>
	<?php
		}
	?>
	
		<?php
		if($this->session->userdata('type_user') =='Klinik'){
		?>
		<li >
        <a href="<?php echo base_url('dashboard/rekap_data_klinik');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap Data</span>
        </a>
		</li>
	<?php
		}
	?>
	
	<?php
		if($this->session->userdata('type_user') =='Labkes'){
		?>
		<li >
        <a href="<?php echo base_url('dashboard/rekap_data_labkes');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap Data</span>
        </a>
		</li>
	<?php
		}
	?>
	<?php
		if($this->session->userdata('type_user') =='RS'){
		?>
		<li >
        <a href="<?php echo base_url('dashboard/rekap_data_rs');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap Data</span>
        </a>
		</li>
	<?php
		}
	?>
	<?php
		if($this->session->userdata('type_user') =='UTD'){
		?>
		<li >
        <a href="<?php echo base_url('dashboard/rekap_data_utd');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap Data</span>
        </a>
		</li>
	<?php
		}
	?>

	<?php
		if($this->session->userdata('type_user') =='Praktik Mandiri'){
		?>
		<li >
        <a href="<?php echo base_url('pm/rekap_data_pm');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap Data</span>
        </a>
		</li>
    <li >
        <a href="<?php echo base_url('pm/satu_sehat_terkoneksi');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap SatuSehat Terkoneksi</span>
        </a>
		</li>
	<?php
		}
	?>
	
  

	<?php
	}
	?>

	<?php
	if($this->session->userdata('id_kategori')==1 || $this->session->userdata('id_kategori')==3 || $this->session->userdata('id_kategori')==2 || $this->session->userdata('id_kategori')==8 || $this->session->userdata('id_kategori')==10){
	?>
		<li >
        <a href="<?php echo base_url('pm/asri');?>">
        <i class="glyphicon glyphicon-list"></i> <span>Rekap Pengguna ASRI</span>
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
