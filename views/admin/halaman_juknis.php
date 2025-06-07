   <div class="nav-tabs-custom">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
  
    <!-- Main content -->
    <section class="content">
	 <a href="<?php echo site_url('admin/index')?>" ><button class="btn btn-success"><i class="fa fa-fw fa-arrow-left"></i> Back</button></a>
	<br><br>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12" >
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DOWNLOAD JUKNIS & SURAT EDARAN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
         
              <div class="box-body">
			  <div class="tab">
  <button class="tablinks" onclick="openTab(event, 'klinik')">KLINIK</button>
  <button class="tablinks" onclick="openTab(event, 'labkes')">LABKES</button>
  <button class="tablinks" onclick="openTab(event, 'rs')">RS</button>
  <button class="tablinks" onclick="openTab(event, 'utd')">UTD</button>
  <button class="tablinks" onclick="openTab(event, 'praktik_mandiri')">PRAKTIK MANDIRI</button>
</div>

<div id="klinik" class="tabcontent">
  <h3>Download Juknis Klinik</h3>
   <a target="_blank" href="<?php echo site_url('assets/JuknisaplikasiregistrasiKlinik1.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/SE TENTANG REGISTRASI KLINIK.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
</div>

<div id="labkes" class="tabcontent">
  <h3>Download Juknis Labkes</h3>
    <a target="_blank" href="<?php echo site_url('assets/Juknis aplikasi registrasi LABKES.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/SE Registrasi LAb.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
</div>

<div id="rs" class="tabcontent">
   <h3>Download Juknis RS</h3>
   <a target="_blank" href="<?php echo site_url('assets/Juknis_SE REGISTRASI RS.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/SE Reg RS.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
</div>

<div id="utd" class="tabcontent">
 <h3>Download Juknis UTD</h3>
    <a target="_blank" href="<?php echo site_url('assets/Juknis aplikasi registrasi UTD.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/SURAT EDARAN REGISTRASI UTD.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
  
</div>

<div id="praktik_mandiri" class="tabcontent">
 <h3>Download Juknis PRAKTIK MANDIRI</h3>
    <a target="_blank" href="<?php echo site_url('assets/Juknis Registrasi Tempat Praktik Mandiri Nakes.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/Surat Edaran Dirjen Yankes tentang Registrasi Tempat Praktik Mandiri Tenaga Kesehatan.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
  
</div>


          </div>
          <!-- /.box -->


        </div>
        <!--/.col (left) -->

        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

            <!-- /.tab-content -->
          </div> 

<script>
function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>