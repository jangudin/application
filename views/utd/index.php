<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
#map-layer {
	margin: 20px 0px;
	max-width: 600px;
	min-height: 400;
}
#btnAction {
	background: #3878c7;
    padding: 10px 40px;
    border: #3672bb 1px solid;
    border-radius: 2px;
    color: #FFF;
    font-size: 0.9em;
    cursor:pointer;
    display:block;
}
#btnAction:disabled {
    background: #6c99d2;
}
</style>
    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
		  			<?php
if($this->session->flashdata('message_name') !=null){
?>
<div class="alert alert-<?=$this->session->flashdata('kode_name');?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Peringatan!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
            <ul class="nav nav-tabs">
              <li  class="active"><a href="<?php echo base_url('utd/inputan_data_faskes_utd');?>">Data Dasar</a></li>
				<li ><a href="<?php echo base_url('utd/inputan_data_sdm_utd');?>">Data SDM</a></li>
				 <li ><a href="<?php echo base_url('utd/inputan_data_sarpras_alkes_utd');?>">Data Sarpras</a></li>
				 <li ><a href="<?php echo base_url('utd/inputan_data_alkes_utd');?>">Data Alkes</a></li>
				 <li  ><a href="<?php echo base_url('utd/selesaikan_utd');?>">Kirim Data</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
            <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <!-- left column -->
        <div class="col-md-12" >
          <!-- general form elements -->
          <div class="box box-primary">
           
            <!-- /.box-header -->
            <!-- form start -->
			<?php
			if(empty($data[0]['validasi_field']) && $data[0]['validasi_field']==''){
			$json_validasi='{"field":{"nama_lab_validasi":{"nilai":null,"keterangan":null},"pemilik_validasi":{"nilai":null,"keterangan":null},"alamat_validasi":{"nilai":null,"keterangan":null} } }';
			}else{
			$json_validasi=$data[0]['validasi_field'];
			}
			$validasi = (array)json_decode($json_validasi);
			?>
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
              <div class="box-body">
			 
				
				 <div class="form-group">
				  <label  class="col-sm-2 control-label">NAMA UTD *</label>
				   <div class="col-sm-5">
                  <input type="text" name="nama_utd" value="<?=empty($data[0]['nama_utd']) ? $user[0]['nama_fasyankes'] : $data[0]['nama_utd']?>"  class="form-control" autocomplete="off" id="nama_rs"  required>
				  <input type="hidden" name="id" value="<?=$data[0]['id']?>"   id="id"  >
				  <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				 <div class="form-group">
				 <label  class="col-sm-2 control-label">NAMA INSTANSI YANG MEMILIKI UTD *</label>
				  <div class="col-sm-5">
                 <input type="text" name="nama_instansi" value="<?=empty($data[0]['nama_instansi']) ? '' : $data[0]['nama_instansi']?>"  class="form-control" autocomplete="off" id="nama_instansi" required  >
				  </div>
				  <div style="clear:both;"></div>
                </div>

				<div class="form-group" >
				 <label  class="col-sm-2 control-label">STATUS KEPEMILIKAN DAN BENTUK UTD *</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('status_kepemilikan', dropdown_status_kepemilikan_utd(), $data[0]['status_kepemilikan'],'id="status_kepemilikan" onchange="openshowrs(this.value)" class="form-control select2"  required ');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
			
				<div class="form-group" id="nama_rs_html" style="display: none">
				 <label  class="col-sm-2 control-label">NAMA RS PEMERINTAH/ PEMERINTAH DAERAH *</label>
				  <div class="col-sm-5">
				  <input type="text" name="nama_rs" value="<?=empty($data[0]['nama_rs']) ? '' : $data[0]['nama_rs']?>"  class="form-control" autocomplete="off" id="nama_rs"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>

				<div class="form-group" id="nama_rs_html2" style="display:<?=($data[0]['status_kepemilikan']!='Unit Pelayanan RS' ? 'none' : 'block')?>">
				 <label  class="col-sm-2 control-label">NAMA RS PEMERINTAH/ PEMERINTAH DAERAH *</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('kode_rs', dropdown_daftar_rs(), $data[0]['kode_rs'],'id="kode_rs" class="form-control select2" ');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">JENIS UTD MENURUT KELAS KEMAMPUAN PELAYANAN *</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('jenis_utd', dropdown_jenis_utd(), $data[0]['jenis_utd'],'id="jenis_utd" class="form-control select2"   required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>

				
				
		
				<div class="form-group">
				 <label  class="col-sm-2 control-label">NAMA KEPALA UTD *</label>
				  <div class="col-sm-5">
				
				 <input type="text" name="nama_kepala_utd" value="<?=$data[0]['nama_kepala_utd']?>"  class="form-control"   id="nama_kepala_utd" autocomplete="off" required >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				

			
			
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">PROVINSI </label>
				<div class="col-sm-5">
				<?=form_dropdown('id_provx', dropdown_propinsi(), $user[0]['id_prov'],'id="id_provx" class="form-control select2" disabled');?>
				<input type="hidden" name="id_prov" value="<?=$user[0]['id_prov']?>"   id="id_prov"  >
				</div>  
				<div style="clear:both;"></div>
				</div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">KAB/KOTA</label>
				<div class="col-sm-5">
				<?=form_dropdown('id_kotax', dropdown_kota($user[0]['id_prov']), $user[0]['id_kota'],'id="id_kotax" class="form-control select2" disabled');?>
				<input type="hidden" name="id_kota" value="<?=$user[0]['id_kota']?>"   id="id_kota"  >
				</div>  
				<div style="clear:both;"></div>
				</div>
				
					<div class="form-group">
				<label  class="col-sm-2 control-label">KECAMATAN</label>
				<div class="col-sm-5">
				<?=form_dropdown('id_camat', dropdown_kecamatan($user[0]['id_prov'],$user[0]['id_kota']), $user[0]['id_camat'],'id="id_camat" class="form-control select2" ');?>
				<!--<input type="hidden" name="id_camat" value="<?=$user[0]['id_camat']?>"   id="id_camat"  >-->
				</div>  
				<div style="clear:both;"></div>
				</div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">ALAMAT UTD *</label>
                <div class="col-sm-5">
                  <textarea name="alamat_faskes" id="alamat_faskes" class="form-control" rows="3" required ><?=(empty($data[0]['alamat_faskes']) ? $user[0]['alamat'] : $data[0]['alamat_faskes'])?></textarea>
                </div>
				
				<div style="clear:both;"></div>
				</div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">TITIK LOKASI</label>
                <div class="col-sm-8">
				<?php
	   if(empty($data[0]['latitude']) && empty($data[0]['longitude'])){
	   ?>
				<input type="button" name="lokasi" id="lokasi" value="Get Location" class="btn btn-danger">
		<?php
		}
		?>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG362vpRf1YZbpR-fiUOOeWJ-dHbtBDxg&callback=initialize" async defer></script>
<!--<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiyzxLRNDMCMzlD0WTnX2qyPcU4oOJJTY&callback=initMap"
		async defer></script>-->
		
		
				<script type="text/javascript"> 
		$("#lokasi").click(function(){

 navigator.geolocation.getCurrentPosition(function (position) {
   			 initialize(position);
		}, function (e) {
		    alert('Geolocation Tidak Mendukung Pada Browser Anda');
		}, {
		    enableHighAccuracy: true
		});
	});		
	
    var marker;
    function initialize(position){
        // Variabel untuk menyimpan informasi lokasi
        var infoWindow = new google.maps.InfoWindow;
        //  Variabel berisi properti tipe peta

		  var mapOptions = {
      zoom: 12,
        scaleControl: true,
      center:  new google.maps.LatLng(latitude,longitude),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
		

        // Pembuatan peta
        var peta = new google.maps.Map(document.getElementById('map'), mapOptions);      
		// Variabel untuk menyimpan batas kordinat
        var bounds = new google.maps.LatLngBounds();
        // Pengambilan data dari database MySQL
       <?php
	   if(!empty($data[0]['latitude']) && !empty($data[0]['longitude'])){
	   ?>
       addMarker(<?=(!empty($data[0]['latitude']) ? $data[0]['latitude'] : '-6.2022');?>, <?=(!empty($data[0]['longitude']) ? $data[0]['longitude'] : '106.8831');?>,"Posisi");
	   <?php
	   }else{
	   ?>
	    addMarker(position.coords.latitude, position.coords.longitude,"Posisi");
		document.getElementById('latitude').value = position.coords.latitude;
		document.getElementById('longitude').value = position.coords.longitude;
	   <?php
	   }
	   ?>
        // Proses membuat marker 
        function addMarker(lat, lng, info){
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
				 zoom: 12,
                map: peta,
                position: lokasi,
				 draggable : true
            });       
            peta.fitBounds(bounds);
            bindInfoWindow(marker, peta, infoWindow, info);
			
			
         }
		 
		 
		 peta.addListener(marker, 'drag', function() { 
		  initialize(marker.getPosition());
		  });
		 	 
		  peta.addListener("click", (mapsMouseEvent) => {
     infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
	var get;
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
	
    );
	 var myLatLng = mapsMouseEvent.latLng;
    var lat = myLatLng.lat();
    var lng = myLatLng.lng();

    infoWindow.open(peta);
document.getElementById('latitude').value = lat;
document.getElementById('longitude').value = lng;
  });
  
  
  
  
        // Menampilkan informasi pada masing-masing marker yang diklik
        function bindInfoWindow(marker, peta, infoWindow, html){
            google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(peta, marker);
			
			//alert("");
          });
		  
		  
        }
		
	
    }




   
</script>
<style type="text/css">
#map{width:100%; height:340px; border:5px solid #DEEBF2;}
</style>
			<div id="map"></div>
				<!--	<div id="button-layer"><button id="btnAction" onClick="locate()">My Current Location</button></div>
	<div id="map"></div>
	<div id="tampil"></div>
<!--	<script type="text/javascript">
	var map;
	function initMap() {
		var mapLayer = document.getElementById("map-layer");
		var centerCoordinates = new google.maps.LatLng(<?=(!empty($data[0]['latitude']) ? $data[0]['latitude'] : '');?>, <?=(!empty($data[0]['latitude']) ? $data[0]['longitude'] : '106.8831');?>);
		var defaultOptions = { center: centerCoordinates, zoom: 4 }

		map = new google.maps.Map(mapLayer, defaultOptions);
	}
	function locate(){
		document.getElementById("btnAction").disabled = true;
		document.getElementById("btnAction").innerHTML = "Processing...";
		if ("geolocation" in navigator){
			navigator.geolocation.getCurrentPosition(function(position){ 
				var currentLatitude = position.coords.latitude;
				var currentLongitude = position.coords.longitude;

				var infoWindowHTML = "Latitude: " + currentLatitude + "<br>Longitude: " + currentLongitude;
				var infoWindow = new google.maps.InfoWindow({map: map, content: infoWindowHTML});
				var currentLocation = { lat: currentLatitude, lng: currentLongitude };
				infoWindow.setPosition(currentLocation);
				document.getElementById("btnAction").style.display = 'none';
				document.getElementById("tampil").innerHTML = infoWindowHTML; 
			});
			
		}
	}
	</script>		-->
				


                </div>
				<div style="clear:both;"></div>
				</div>
				
				
	<div class="form-group">	
	<label  class="col-sm-2 control-label"></label>
	<div class="col-sm-5">
	<!--<button id="btnAction" onClick="locate()">Get Location</button>-->
	</div>
	<div style="clear:both;"></div>
	</div>
	<div class="form-group">	
	<label  class="col-sm-2 control-label">LATITUDE *</label>
	<div class="col-sm-5">
	<input type="text" id="latitude" name="latitude" value="<?=$data[0]['latitude']?>" required class="form-control"  >
	</div>
	<div style="clear:both;"></div>
	</div>
				
	<div class="form-group">			
	<label  class="col-sm-2 control-label">LONGITUDE *</label>
	<div class="col-sm-5">
	<input type="text" id="longitude" name="longitude" value="<?=$data[0]['longitude']?>" required class="form-control"  >
	</div>		
	<div style="clear:both;"></div>
	</div>		
	

				
				<div class="form-group">
				<label  class="col-sm-2 control-label">NO TELEPON/ PONSEL *</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="no_telp" value="<?=(empty($data[0]['no_telp']) ? $user[0]['no_hp'] : $data[0]['no_telp'])?>"  class="form-control" required  autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
				
	
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">ALAMAT EMAIL *</label>
				  <div class="col-sm-5">
                  <input type="email" name="email" value="<?=(empty($data[0]['email']) ? $user[0]['email'] : $data[0]['email'])?>" required class="form-control"  autocomplete="off"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				
				
				<?php
				if(empty($data[0]['surat_izin_operasional_utd'])){
					$auth_wajib_surat_izin_operasional_utd='required';
				}
				?>
				
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Link Upload SURAT IZIN /SERTIFIKAT STANDAR *</label>
				  <div class="col-sm-5">
                  <!-- <input type="file"  name="surat_izin_operasional_utd"  id="surat_izin_operasional_utd" <?=$auth_wajib_surat_izin_operasional_utd?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['surat_izin_operasional_utd']);?>"><?php echo $data[0]['surat_izin_operasional_utd'];?></a>			  
				  <input type="hidden"  name="old_surat_izin_operasional_utd"  value="<?=$data[0]['surat_izin_operasional_utd']?>" id="old_surat_izin_operasional_utd"> -->
				  <input type="text" name="surat_izin_operasional_utd" value="<?= (empty($data[0]['surat_izin_operasional_utd']) ? $data[0]['surat_izin_operasional_utd'] : $data[0]['surat_izin_operasional_utd']) ?>" class="form-control" required autocomplete="off">
				 
				</div>
				  <div style="clear:both;"></div>
                </div>
				
					<?php
				if(empty($data[0]['sk_pembentukan'])){
					$auth_wajib_sk_pembentukan='required';
				}
				?>
				
				<!--
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Upload SK PEMBENTUKAN</label>
				  <div class="col-sm-5">
                  <input type="file"  name="sk_pembentukan"  id="sk_pembentukan" <?=$auth_wajib_sk_pembentukan?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['sk_pembentukan']);?>"><?php echo $data[0]['sk_pembentukan'];?></a>			  
				  <input type="hidden"  name="old_sk_pembentukan"  value="<?=$data[0]['sk_pembentukan']?>" id="old_sk_pembentukan">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				-->
					<?php
				if(empty($data[0]['surat_permohonan_registrasi'])){
					$auth_wajib_surat_permohonan_registrasi='required';
				}
				?>
				
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Link Upload SURAT PERMOHONAN REGISTRASI *</label>
				  <div class="col-sm-5">
                  <!-- <input type="file"  name="surat_permohonan_registrasi"  id="surat_permohonan_registrasi" <?=$auth_wajib_surat_permohonan_registrasi?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['surat_permohonan_registrasi']);?>"><?php echo $data[0]['surat_permohonan_registrasi'];?></a>			  
				  <input type="hidden"  name="old_surat_permohonan_registrasi"  value="<?=$data[0]['surat_permohonan_registrasi']?>" id="old_surat_permohonan_registrasi"> -->
				  <input type="text" name="surat_permohonan_registrasi" value="<?= (empty($data[0]['surat_permohonan_registrasi']) ? $data[0]['surat_permohonan_registrasi'] : $data[0]['surat_permohonan_registrasi']) ?>" class="form-control" required autocomplete="off">

				</div>
				  <div style="clear:both;"></div>
                </div>
				
		<div class="form-group" id="tanggal_berakhir_surat_izin_html" >
				<label  class="col-sm-2 control-label">TANGGAL BERAKHIR SURAT IZIN/SERTIFIKAT STANDAR *</label>
				<div class="col-sm-5">
              
                
                  <input type="text" name="tanggal_berakhir_surat_izin"  id="tanggal_berakhir_surat_izin" value="<?=(!empty($data[0]['tanggal_berakhir_surat_izin']) ? date('d-m-Y',strtotime($data[0]['tanggal_berakhir_surat_izin'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
        
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
			  
			  <div class="form-group">
				 <label  class="col-sm-2 control-label">AKREDITASI UTD</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('akreditasi_utd', dropdown_akreditasi_utd(), $data[0]['akreditasi_utd'],'id="akreditasi_utd"  onchange="openshowakreditasiutd(this.value)" class="form-control select2"   ');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>

				<?php
				if(empty($data[0]['upload_sertifikat_akreditasi']) && ($data[0]['akreditasi_utd']=='Akreditasi UTD' || $data[0]['akreditasi_utd']=='Akreditasi RS')){
					$auth_wajib_upload_sertifikat_akreditasi='';
				}
				?>
				
				<?php
					if($data[0]['akreditasi_utd']=='Akreditasi UTD'){
						$var_style_akreditasi_utd="block";
					}else if($data[0]['akreditasi_utd']=='Akreditasi RS'){
						$var_style_akreditasi_utd="block";
					}else{
						$var_style_akreditasi_utd="none";
					}
				?>
			  
			  <div class="form-group" id="upload_sertifikat_akreditasi_html" style="display:<?=$var_style_akreditasi_utd?>">
				 <label  class="col-sm-2 control-label">Link Upload Sertifikat Akreditasi</label>
				  <div class="col-sm-5">
                  <!-- <input type="file"  name="upload_sertifikat_akreditasi"  id="upload_sertifikat_akreditasi" <?=$auth_wajib_upload_sertifikat_akreditasi?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_sertifikat_akreditasi']);?>"><?php echo $data[0]['upload_sertifikat_akreditasi'];?></a>			  
				  <input type="hidden"  name="old_upload_sertifikat_akreditasi"  value="<?=$data[0]['upload_sertifikat_akreditasi']?>" id="old_upload_sertifikat_akreditasi"> -->
				  <input type="text" name="upload_sertifikat_akreditasi" value="<?= (empty($data[0]['upload_sertifikat_akreditasi']) ? $data[0]['upload_sertifikat_akreditasi'] : $data[0]['upload_sertifikat_akreditasi']) ?>" class="form-control"  autocomplete="off">
				  
				</div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group" id="tanggal_berakhir_akreditasi_html"  style="display:<?=$var_style_akreditasi_utd?>">
				<label  class="col-sm-2 control-label">Tanggal berakhir Akreditasi</label>
				<div class="col-sm-5">
              
                
                  <input type="text" name="tanggal_berakhir_akreditasi"  id="tanggal_berakhir_akreditasi" value="<?=(!empty($data[0]['tanggal_berakhir_akreditasi']) ? date('d-m-Y',strtotime($data[0]['tanggal_berakhir_akreditasi'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
        
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>

  <div class="form-group">
				 <label  class="col-sm-2 control-label">CPOB</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('cpob', dropdown_cpob_utd(), $data[0]['cpob'],'id="cpob"  onchange="openshowcpobutd(this.value)" class="form-control select2"   ');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<?php
				if(empty($data[0]['upload_sertifikat_cpob']) && $data[0]['cpob']=='Sudah'){
					$auth_wajib_upload_sertifikat_cpob='';
				}
				?>
				
				<?php
					if($data[0]['cpob']=='Sudah'){
						$var_style_cpob_utd="block";
					}else if($data[0]['cpob']=='Belum'){
						$var_style_cpob_utd="none";
					}else{
						$var_style_cpob_utd="none";
					}
				?>
				
				
				 <div class="form-group" id="upload_sertifikat_cpob_html" style="display:<?=$var_style_cpob_utd?>">
				 <label  class="col-sm-2 control-label">Link Upload Sertifikat CPOB</label>
				  <div class="col-sm-5">
                  <!-- <input type="file"  name="upload_sertifikat_cpob"  id="upload_sertifikat_cpob" <?=$auth_wajib_upload_sertifikat_cpob?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_sertifikat_cpob']);?>"><?php echo $data[0]['upload_sertifikat_cpob'];?></a>			  
				  <input type="hidden"  name="old_upload_sertifikat_cpob"  value="<?=$data[0]['upload_sertifikat_cpob']?>" id="upload_sertifikat_cpob"> -->
				  <input type="text" name="upload_sertifikat_cpob" value="<?= (empty($data[0]['upload_sertifikat_cpob']) ? $data[0]['upload_sertifikat_cpob'] : $data[0]['upload_sertifikat_cpob']) ?>" class="form-control"  autocomplete="off">
				  
				</div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group" id="tanggal_berakhir_cpob_html"  style="display:<?=$var_style_cpob_utd?>">
				<label  class="col-sm-2 control-label">Tanggal berakhir CPOB</label>
				<div class="col-sm-5">
              
                
                  <input type="text" name="tanggal_berakhir_cpob"  id="tanggal_berakhir_cpob" value="<?=(!empty($data[0]['tanggal_berakhir_cpob']) ? date('d-m-Y',strtotime($data[0]['tanggal_berakhir_cpob'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
        
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>

			  <?php
                    $jenis_pemeriksaan=explode(',',$data[0]['jenis_pemeriksaan']);
                ?>
				<div class="form-group">
					<label  class="col-sm-2 control-label">Jenis Pemeriksaan</label>
					<div class="col-sm-8">
						<!-- <?=form_dropdown('jenis_pemeriksaan',  array('Rapid Test'=>'Rapid Test','CLIA'=>'CLIA','ELISA'=>'ELISA','NAT'=>'NAT','HLA'=>'HLA'),  (!empty($data[0]['jenis_pemeriksaan']) ? $data[0]['jenis_pemeriksaan'] : '') ,'id="jenis_pemeriksaan" class="form-control select2" onchange="openshowjenis_pemeriksaan_lainnya(this.value)" ');?> -->
						<input class="form-check-input" type="checkbox"<?=(in_array("Rapid Test", $jenis_pemeriksaan) ? 'checked' : '') ?> name="jenis_pemeriksaan[]" value="Rapid Test"  id="Rapid_Test" onchange="openshow_jp_rapid_test()"> Rapid Test&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox"<?=(in_array("CLIA", $jenis_pemeriksaan) ? 'checked' : '') ?> name="jenis_pemeriksaan[]" value="CLIA"  id="CLIA" onchange="openshow_jp_CLIA()"> CLIA&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("ELISA", $jenis_pemeriksaan) ? 'checked' : '') ?> name="jenis_pemeriksaan[]" value="ELISA"  id="ELISA" onchange="openshow_jp_ELISA()"> ELISA&nbsp;&nbsp;&nbsp;
						<input class="form-check-input" type="checkbox"<?=(in_array("NAT", $jenis_pemeriksaan) ? 'checked' : '') ?> name="jenis_pemeriksaan[]" value="NAT"  id="NAT" onchange="openshow_jp_NAT()"> NAT&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("HLA", $jenis_pemeriksaan) ? 'checked' : '') ?> name="jenis_pemeriksaan[]" value="HLA"  id="HLA"> HLA&nbsp;&nbsp;&nbsp;
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    
					if(in_array("Rapid Test", $jenis_pemeriksaan)){
						$var_style_rapid_test="block";
					}else{
						$var_style_rapid_test="none";
					}

					if(in_array("CLIA", $jenis_pemeriksaan)){
						$var_style_CLIA="block";
					}else{
						$var_style_CLIA="none";
					}

					if(in_array("ELISA", $jenis_pemeriksaan)){
						$var_style_ELISA="block";
					}else{
						$var_style_ELISA="none";
					}

					if(in_array("NAT", $jenis_pemeriksaan)){
						$var_style_NAT="block";
					}else{
						$var_style_NAT="none";
					}

					if(in_array("HLA", $jenis_pemeriksaan)){
						$var_style_HLA="block";
					}else{
						$var_style_HLA="none";
					}
                ?>

				<?php
                    $jp_rapid_test=explode(',',$data[0]['jp_rapid_test']);
                ?>
				<div class="form-group" id="rapid_test_html" style="display:<?=$var_style_rapid_test?>">
					<label  class="col-sm-2 control-label">Rapid Test</label>
					<div class="col-sm-8">
						<!-- <?=form_dropdown('jenis_pemeriksaan',  array('HIV'=>'HIV','Sifilis'=>'Sifilis','Malaria'=>'Malaria','Hepatitis B'=>'Hepatitis B','Hepatitis C'=>'Hepatitis C'),  (!empty($data[0]['jenis_pemeriksaan']) ? $data[0]['jenis_pemeriksaan'] : '') ,'id="jenis_pemeriksaan" class="form-control select2" onchange="openshowjenis_pemeriksaan_lainnya(this.value)" ');?> -->
						<input class="form-check-input" type="checkbox"<?=(in_array("HIV", $jp_rapid_test) ? 'checked' : '') ?> name="jp_rapid_test[]" value="HIV"  id="HIV"> HIV&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox"<?=(in_array("Sifilis", $jp_rapid_test) ? 'checked' : '') ?> name="jp_rapid_test[]" value="Sifilis"  id="Sifilis"> Sifilis&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Malaria", $jp_rapid_test) ? 'checked' : '') ?> name="jp_rapid_test[]" value="Malaria"  id="Malaria"> Malaria&nbsp;&nbsp;&nbsp;
						<input class="form-check-input" type="checkbox"<?=(in_array("Hepatitis B", $jp_rapid_test) ? 'checked' : '') ?> name="jp_rapid_test[]" value="Hepatitis B"  id="Hepatitis_B"> Hepatitis B&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Hepatitis C", $jp_rapid_test) ? 'checked' : '') ?> name="jp_rapid_test[]" value="Hepatitis C"  id="Hepatitis_C"> Hepatitis C&nbsp;&nbsp;&nbsp;
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    $jp_clia=explode(',',$data[0]['jp_clia']);
                ?>
				<div class="form-group" id="CLIA_html" style="display:<?=$var_style_CLIA?>">
					<label  class="col-sm-2 control-label">CLIA</label>
					<div class="col-sm-8">
						<input class="form-check-input" type="checkbox"<?=(in_array("HIV", $jp_clia) ? 'checked' : '') ?> name="jp_clia[]" value="HIV"  id="HIV"> HIV&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox"<?=(in_array("Sifilis", $jp_clia) ? 'checked' : '') ?> name="jp_clia[]" value="Sifilis"  id="Sifilis"> Sifilis&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Malaria", $jp_clia) ? 'checked' : '') ?> name="jp_clia[]" value="Malaria"  id="Malaria"> Malaria&nbsp;&nbsp;&nbsp;
						<input class="form-check-input" type="checkbox"<?=(in_array("Hepatitis B", $jp_clia) ? 'checked' : '') ?> name="jp_clia[]" value="Hepatitis B"  id="Hepatitis_B"> Hepatitis B&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Hepatitis C", $jp_clia) ? 'checked' : '') ?> name="jp_clia[]" value="Hepatitis C"  id="Hepatitis_C"> Hepatitis C&nbsp;&nbsp;&nbsp;
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    $jp_elisa=explode(',',$data[0]['jp_elisa']);
                ?>
				<div class="form-group" id="ELISA_html" style="display:<?=$var_style_ELISA?>">
					<label  class="col-sm-2 control-label">ELISA</label>
					<div class="col-sm-8">
						<input class="form-check-input" type="checkbox"<?=(in_array("HIV", $jp_elisa) ? 'checked' : '') ?> name="jp_elisa[]" value="HIV"  id="HIV"> HIV&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox"<?=(in_array("Sifilis", $jp_elisa) ? 'checked' : '') ?> name="jp_elisa[]" value="Sifilis"  id="Sifilis"> Sifilis&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Malaria", $jp_elisa) ? 'checked' : '') ?> name="jp_elisa[]" value="Malaria"  id="Malaria"> Malaria&nbsp;&nbsp;&nbsp;
						<input class="form-check-input" type="checkbox"<?=(in_array("Hepatitis B", $jp_elisa) ? 'checked' : '') ?> name="jp_elisa[]" value="Hepatitis B"  id="Hepatitis_B"> Hepatitis B&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Hepatitis C", $jp_elisa) ? 'checked' : '') ?> name="jp_elisa[]" value="Hepatitis C"  id="Hepatitis_C"> Hepatitis C&nbsp;&nbsp;&nbsp;
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    $jp_nat=explode(',',$data[0]['jp_nat']);
                ?>
				<div class="form-group" id="NAT_html" style="display:<?=$var_style_NAT?>">
					<label  class="col-sm-2 control-label">NAT</label>
					<div class="col-sm-8">
						<input class="form-check-input" type="checkbox"<?=(in_array("HIV", $jp_nat) ? 'checked' : '') ?> name="jp_nat[]" value="HIV"  id="HIV"> HIV&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox"<?=(in_array("Sifilis", $jp_nat) ? 'checked' : '') ?> name="jp_nat[]" value="Sifilis"  id="Sifilis"> Sifilis&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Malaria", $jp_nat) ? 'checked' : '') ?> name="jp_nat[]" value="Malaria"  id="Malaria"> Malaria&nbsp;&nbsp;&nbsp;
						<input class="form-check-input" type="checkbox"<?=(in_array("Hepatitis B", $jp_nat) ? 'checked' : '') ?> name="jp_nat[]" value="Hepatitis B"  id="Hepatitis_B"> Hepatitis B&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Hepatitis C", $jp_nat) ? 'checked' : '') ?> name="jp_nat[]" value="Hepatitis C"  id="Hepatitis_C"> Hepatitis C&nbsp;&nbsp;&nbsp;
					</div>  
					<div style="clear:both;"></div>
				</div>

			
				

				
              <!-- /.box-body -->
			  <button type="submit" name="submit" id="submit"  class="btn btn-primary">Simpan</button>
			<!-- <?php
				if(empty($data2[0]['final'])){
			?>
              <div class="box-footer">
                <button type="submit" name="submit" id="submit"  class="btn btn-primary">Simpan</button>
              </div>
			<?php
			}else{
			 ?>
			 <div class="box-footer">
                <font color="orange">Data Sedang DI Verifikasi</font>
              </div>
			 <?php
			}
			 ?> -->
            </form>
          </div>
          <!-- /.box -->


        </div>
        <!--/.col (left) -->

        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
                
				
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
 <script>
 $( document ).ready(function() {
	$('#nama_fasyankes_terintegrasi').typeahead({
		source: function(typeahead, query) {
			$.ajax({
				url: "<?php echo base_url('dashboard/typeahead_namafasyankes/');?>",
				dataType: "json",
				type: "POST",
				data: {
					max_rows:10,
					q: query
				},
				success: function(data) {
					if (!$.trim(data)){

						$('#id_nama_fasyankes_terintegrasi').val("");
						$('#nama_fasyankes_terintegrasi').val("");
					}else{
						var return_list = [], i = data.length;
						while (i--) {
							value_autosuggest = data[i].nama_fasyankes;

							return_list[i] = {
								id: data[i].id,
								value: value_autosuggest,
								id_faskes: data[i].id_faskes, 
								nama_fasyankes: data[i].nama_fasyankes
							};
						}
						typeahead.process(return_list);
					}

				}
			});
		},
		matcher: function () { return true; },
		onselect: function(obj) {
	
			$('#id_nama_fasyankes_terintegrasi').val(obj.id_faskes);
			$('#nama_fasyankes_terintegrasi').val(obj.nama_fasyankes);
		
		document.getElementById('pemilik').focus();
	
		},
		items: 10
	});
	}); 
	
	
   $(function() {
	  $('.select2').select2();
	  $('[data-mask]').inputmask();
     //$("#datepicker").datepicker({autoclose: true});
   });
    $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
})
   
      $('[name="id_prov"]').change(function() {
		 $('#id_kota').val('');
		  $('#id_camat').val('');
		    $.ajax({
         url: "<?php echo site_url('dashboard/dropdown4')?>/" + $(this).val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="id_kota"]'), data, 'id_kota', 'nama_kota');
         }
      }); 
	  
	 
   });
   
   
   $('[name="id_kota"]').change(function() {
		 $('#id_camat').val('');
		    $.ajax({
         url: "<?php echo site_url('dashboard/dropdown6')?>/" + $('#id_prov').val()+"/"+ $(this).val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="id_camat"]'), data, 'id_camat', 'nama_camat');
         }
      }); 
	  
	 
   });
   
   
    $('[name="jenis_rs"]').change(function() {
		 $('#kelas').val('');
		    $.ajax({
         url: "<?php echo site_url('rs/dropdownRSKelas')?>/" + $('#jenis_rs').val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="kelas"]'), data, 'id', 'kelas');
         }
      }); 
	  
	 
   });

   	$('#status_kepemilikan').on('change', function(e) {
		if ($(this).val() == 'Unit Pelayanan RS') {
			$("#kode_rs").attr('required', ''); //turns required on
            document.getElementById("nama_rs_html2").style.display = "block";
		} else {
			document.getElementById("nama_rs_html2").style.display = "none";
            $("#kode_rs").removeAttr('required'); //turns required off
		}
	});

   function openshowcpobutd(value){


	 if(value=='Sudah'){
			document.getElementById("upload_sertifikat_cpob_html").style.display = "block";
			document.getElementById("tanggal_berakhir_cpob_html").style.display = "block";
	 }else{
		    document.getElementById("upload_sertifikat_cpob_html").style.display = "none";
			document.getElementById("tanggal_berakhir_cpob_html").style.display = "none";
	 }
       
}


   function openshowakreditasiutd(value){


	 if(value=='Akreditasi UTD'){
			document.getElementById("upload_sertifikat_akreditasi_html").style.display = "block";
			document.getElementById("tanggal_berakhir_akreditasi_html").style.display = "block";
			
	 }else if(value=='Akreditasi RS'){
			document.getElementById("upload_sertifikat_akreditasi_html").style.display = "block";
			document.getElementById("tanggal_berakhir_akreditasi_html").style.display = "block";
	 }else{
		    document.getElementById("upload_sertifikat_akreditasi_html").style.display = "none";
			document.getElementById("tanggal_berakhir_akreditasi_html").style.display = "none";
	 }
       
}


 function openshowrencanasurvey(value,sekarang){
	  
    var tgl = value.substring(0, 2);
    var bln = value.substring(5, 3);
    var thn = value.substring(10, 6);
	var gabungtglpilih = thn+bln+tgl;
	
	if(sekarang > gabungtglpilih){
		document.getElementById("tgl_rencana_survey_html").style.display = "block";		
	}else if(sekarang < gabungtglpilih){
		document.getElementById("tgl_rencana_survey_html").style.display = "none";		
	}else{
		document.getElementById("tgl_rencana_survey_html").style.display = "none";		
	}
       
}

function openshow_jp_rapid_test(){
	if(document.getElementById("Rapid_Test").checked == true){
		document.getElementById("rapid_test_html").style.display = "block";
	}else if(document.getElementById("Rapid_Test").checked == false){
		document.getElementById("rapid_test_html").style.display = "none";
	}
}

function openshow_jp_ELISA(){
	if(document.getElementById("ELISA").checked == true){
		document.getElementById("ELISA_html").style.display = "block";
	}else if(document.getElementById("ELISA").checked == false){
		document.getElementById("ELISA_html").style.display = "none";
	}
}

function openshow_jp_CLIA(){
	if(document.getElementById("CLIA").checked == true){
		document.getElementById("CLIA_html").style.display = "block";
	}else if(document.getElementById("CLIA").checked == false){
		document.getElementById("CLIA_html").style.display = "none";
	}
}

function openshow_jp_NAT(){
	if(document.getElementById("NAT").checked == true){
		document.getElementById("NAT_html").style.display = "block";
	}else if(document.getElementById("NAT").checked == false){
		document.getElementById("NAT_html").style.display = "none";
	}
}


	


   
      function addOption(ele, data, key, val) { //alert(data.length);
   $('option', ele).remove();
  
   ele.append(new Option('', 9999));
   $(data).each(function(index) { //alert(eval('data[index].' + nama));
      ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));
	 
   });
}


   
   </script>
 <script src="<?php echo base_url('assets/js/migrate.js');?>"></script>
