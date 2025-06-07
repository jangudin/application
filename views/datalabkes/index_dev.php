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
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Peringatan!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
            <ul class="nav nav-tabs">
              <li  class="active"><a href="<?php echo base_url('labkes_dev/inputan_data_faskes_labkes');?>">Data Dasar</a></li>
			  <li><a href="<?php echo base_url('labkes_dev/inputan_standar_pelayanan');?>" >Standar Pelayanan</a></li>
				<li ><a href="<?php echo base_url('labkes_dev/inputan_data_sdm_labkesmas');?>">Struktur Organisasi</a></li>
				 <li ><a href="<?php echo base_url('labkes_dev/inputan_jenis_pemeriksaan_labkes');?>">Data Pelayanan</a></li>
				 <li  ><a href="<?php echo base_url('labkes_dev/selesaikan_labkes');?>">Kirim Data</a></li>
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
				  <label  class="col-sm-2 control-label">NAMA LABORATORIUM/BANK JARINGAN</label>
				   <div class="col-sm-5">
                  <input type="text" name="nama_lab" value="<?=empty($data[0]['nama_lab']) ? $user[0]['nama_fasyankes'] : $data[0]['nama_lab']?>"  class="form-control" autocomplete="off" id="nama_lab"  required>
				  <input type="hidden" name="id" value="<?=$data[0]['id']?>"   id="id"  >
				  <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
				  </div>
				    <?php
					foreach($validasi['field'] as $keyvalidasi => $valvalidasi){
						if($keyvalidasi=='nama_lab_validasi'){
							$validasi2 = (array)$valvalidasi;
							echo ($validasi2['nilai']=='1' ? '<font color="green">&#10004;</font>' : ($validasi2['nilai']=='0' ? '&#x274C;' : ''))." ".(!empty($validasi2['keterangan']) ? '<font color="red">'.$validasi2["keterangan"].'</font>' : '');
						}
					} 
				  ?>
				  <div style="clear:both;"></div>
                </div>
				
                <div class="form-group">
				 <label  class="col-sm-2 control-label">KATEGORI LABORATORIUM</label>
				  <div class="col-sm-5">
				  <?php
				  $jenis_pelayanan=explode(",",$data[0]['jenis_pelayanan']);
				  ?>
                 <?=form_dropdown('jenis_pelayanan', dropdown_jenis_pelayanan(), $data[0]['jenis_pelayanan'],'id="jenis_pelayanan" class="form-control select2"   required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				<?php
				//var_dump($data[0]['jenis_pelayanan']);
				?>
				 <div class="form-group" >
				 <label  class="col-sm-2 control-label">JENIS LABORATORIUM</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('jenis_pelayanan_child', dropdown_jenis_lab_child(empty($data[0]['jenis_pelayanan']) ? str_replace(" ","_",'Laboratorium Kesehatan') : str_replace(" ","_",$data[0]['jenis_pelayanan'])), $data[0]['jenis_pelayanan_child'],'id="jenis_pelayanan_child"  class="form-control select2" required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				
				 <div class="form-group" >
				 <label  class="col-sm-2 control-label">JENIS PELAYANAN</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('jenis_lab', dropdown_jenis_lab($data[0]['jenis_pelayanan_child']), $data[0]['jenis_lab'],'id="jenis_lab" onchange="openshowjenispelayanan(this.value)" class="form-control select2" required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				<?php
					if($data[0]['jenis_lab']=='Laboratorium Medis Khusus Pratama' || $data[0]['jenis_lab']=='Laboratorium Medis Khusus Utama'){
						$var_style="block";
					}else{
						$var_style="none";
					}
				?>
				<div class="form-group" id="lab_medis_khusus_html" style="display:<?=$var_style?>">
				 <label  class="col-sm-2 control-label">LABORATORIUM MEDIS KHUSUS</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('lab_medis_khusus', dropdown_lab_medis_khusus(), $data[0]['lab_medis_khusus'],'id="lab_medis_khusus" class="form-control select2" ');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				<!--
				 <div class="form-group">
				 <label  class="col-sm-2 control-label">PELAYANAN LAIN</label>
				  <div class="col-sm-5">
				   <?php
				  $pelayanan_lain=explode(",",$data[0]['pelayanan_lain']);
				  ?>
                 <?=form_dropdown('pelayanan_lain[]', dropdown_pelayanan_lain(), $pelayanan_lain,'id="pelayanan_lain" class="form-control  select2" multiple');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				-->
			
				<div class="form-group">
				 <label  class="col-sm-2 control-label">BENTUK LAB</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('bentuk_lab', dropdown_bentuk_lab(), $data[0]['bentuk_lab'],'id="bentuk_lab" class="form-control select2" onchange="openshowbentuklab(this.value)"   required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<?php
					if($data[0]['bentuk_lab']=='Terintegrasi (RS, Klinik, Puskesmas, Balai Kesehatan)' ){
						$var_style2="block";
					}else{
						$var_style2="none";
					}
				?>
				<div class="form-group" id="nama_fasyankes_terintegrasi_html" style="display:<?=$var_style2?>">
				 <label  class="col-sm-2 control-label">NAMA FASYANKES TERINTEGRASI</label>
				  <div class="col-sm-5">
				
				 <input type="text" name="nama_fasyankes_terintegrasi" value="<?=$data[0]['nama_fasyankes_terintegrasi']?>"  class="form-control"   id="nama_fasyankes_terintegrasi" autocomplete="off" >
				    <input type="text" name="id_nama_fasyankes_terintegrasi" value="<?=$data[0]['id_nama_fasyankes_terintegrasi']?>"  id="id_nama_fasyankes_terintegrasi" >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
		
               <div class="form-group">
				 <label  class="col-sm-2 control-label">PEMILIK</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('pemilik', dropdown_pemilik_labkes(), $data[0]['pemilik'],'id="pemilik" class="form-control select2" required');?>
				  </div>
				    <?php
					foreach($validasi['field'] as $keyvalidasi => $valvalidasi){
						if($keyvalidasi=='pemilik_validasi'){
							$validasi2 = (array)$valvalidasi;
							echo ($validasi2['nilai']=='1' ? '<font color="green">&#10004;</font>' : ($validasi2['nilai']=='0' ? '&#x274C;' : ''))." ".(!empty($validasi2['keterangan']) ? '<font color="red">'.$validasi2["keterangan"].'</font>'  : '');
						}
					} 
				  ?>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">NAMA PEMILIK</label>
				  <div class="col-sm-5">
                  <input type="text" name="nama_pemilik" value="<?=$data[0]['nama_pemilik']?>"  class="form-control" autocomplete="off" id="nama_pemilik" required >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<?php
					if($data[0]['jenis_lab']=='Bank Jaringan dan / atau Sel Utama'  || $data[0]['jenis_lab']=='Laboratorium Pengolahan Sel Punca Utama' ){
						$var_style3="block";
					}else{
						$var_style3="none";
					}
				?>
				
					<div class="form-group"  id="rumah_sakit_yang_bekerja_sama_html" style="display:<?=$var_style3?>">
				 <label  class="col-sm-2 control-label">RUMAH SAKIT YANG BERKERJA SAMA</label>
				  <div class="col-sm-5">
                  <input type="text" name="rumah_sakit_yang_bekerja_sama" value="<?=$data[0]['rumah_sakit_yang_bekerja_sama']?>"  class="form-control" autocomplete="off" id="rumah_sakit_yang_bekerja_sama"  >
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
				<label  class="col-sm-2 control-label">ALAMAT Labkes/Bank Jaringan</label>
                <div class="col-sm-5">
                  <textarea name="alamat_faskes" id="alamat_faskes" class="form-control" rows="3"  ><?=(empty($data[0]['alamat_faskes']) ? $user[0]['alamat'] : $data[0]['alamat_faskes'])?></textarea>
                </div>
				  <?php
					foreach($validasi['field'] as $keyvalidasi => $valvalidasi){
						if($keyvalidasi=='alamat_validasi'){
							$validasi2 = (array)$valvalidasi;
						echo ($validasi2['nilai']=='1' ? '<font color="green">&#10004;</font>' : ($validasi2['nilai']=='0' ? '&#x274C;' : ''))." ".(!empty($validasi2['keterangan']) ? '<font color="red">'.$validasi2["keterangan"].'</font>'  : '');
						}
					} 
				  ?>
				<div style="clear:both;"></div>
				</div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">TITIK LOKASI</label>
                <div class="col-sm-8">
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAz0z6HkKMun0JLGq8sFTqEeWnfRuIkuY&callback=initialize" async defer></script>	
				
				 <script type="text/javascript">
    var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png", new google.maps.Size(32, 32), new google.maps.Point(0, 0), new google.maps.Point(16, 32));
    var center = null;
    var map = null;
    var currentPopup;
    var bounds = new google.maps.LatLngBounds();

    function addMarker(lat, lng, info) {
      var pt = new google.maps.LatLng(lat, lng);
      map.setCenter(pt);
      map.setZoom(16);
      var marker = new google.maps.Marker({
        position: pt,
        icon: icon,
        map: map
      });
      var popup = new google.maps.InfoWindow({
        content: info,
        maxWidth: 300
      });
      google.maps.event.addListener(marker, "click", function() {
        if (currentPopup != null) {
          currentPopup.close();
          currentPopup = null;
        }
        popup.open(map, marker);
        currentPopup = popup;
      });
      google.maps.event.addListener(popup, "closeclick", function() {
        map.panTo(center);
        currentPopup = null;
      });
    }

    function initialize() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(0, 0),
        zoom: 1,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
        },
        navigationControl: true,
        navigationControlOptions: {
          style: google.maps.NavigationControlStyle.SMALL
        }
      });
      addMarker(<?=(!empty($data[0]['latitude']) ? $data[0]['latitude'] : '-6.2022');?>, <?=(!empty($data[0]['latitude']) ? $data[0]['longitude'] : '106.8831');?>, 'New Road');
      // center = bounds.getCenter();
      // map.fitBounds(bounds);
	 var infoWindow = new google.maps.InfoWindow;  
	   map.addListener("click", (mapsMouseEvent) => {
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

    infoWindow.open(map);
document.getElementById('latitude').value = lat;
document.getElementById('longitude').value = lng;
  });

    }



	
  </script>
<!--<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiyzxLRNDMCMzlD0WTnX2qyPcU4oOJJTY&callback=initMap"
		async defer></script>-->
		
	<!--	
				<script type="text/javascript"> 
    var marker;
    function initialize(){
        // Variabel untuk menyimpan informasi lokasi
        var infoWindow = new google.maps.InfoWindow;
        //  Variabel berisi properti tipe peta
        var mapOptions = {
            mapTypeId: google.maps.MapTypeId.ROADMAP
        } 
        // Pembuatan peta
        var peta = new google.maps.Map(document.getElementById('map'), mapOptions);      
		// Variabel untuk menyimpan batas kordinat
        var bounds = new google.maps.LatLngBounds();
        // Pengambilan data dari database MySQL

       addMarker(<?=(!empty($data[0]['latitude']) ? $data[0]['latitude'] : '-6.2022');?>, <?=(!empty($data[0]['latitude']) ? $data[0]['longitude'] : '106.8831');?>,"Posisi");
        // Proses membuat marker 
        function addMarker(lat, lng, info){
            var lokasi = new google.maps.LatLng(lat, lng);
		
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: peta,
                position: lokasi
            });       
            peta.fitBounds(bounds);
            bindInfoWindow(marker, peta, infoWindow, info);
         }
		 
		 
		 	 
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


function bindInfoWindow(marker, map, infoWindow, keterangan) {

       // markerBaru.push(marker);
      //  google.maps.event.addListener(marker, 'click', function() {
          infoWindow.setContent(keterangan);
          infoWindow.open(map, marker);

        //});
      }

      function setMapOnAll(map) {
            for (var i = 0; i < markerBaru.length; i++) {
              markerBaru[i].setMap(map);
            }
          }

   
</script>-->
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
	<label  class="col-sm-2 control-label">LATITUDE</label>
	<div class="col-sm-5">
	<input type="text" id="latitude" name="latitude" value="<?=$data[0]['latitude']?>" class="form-control"  >
	</div>
	<div style="clear:both;"></div>
	</div>
				
	<div class="form-group">			
	<label  class="col-sm-2 control-label">LONGITUDE</label>
	<div class="col-sm-5">
	<input type="text" id="longitude" name="longitude" value="<?=$data[0]['longitude']?>" class="form-control"  >
	</div>		
	<div style="clear:both;"></div>
	</div>		
				
					<div class="form-group">
				<label  class="col-sm-2 control-label">NO TELEPON LABORATORIUM MEDIS</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="no_telp" value="<?=(empty($data[0]['no_telp']) ? $user[0]['no_hp'] : $data[0]['no_telp'])?>"  class="form-control" required autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
				
	
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">EMAIL LABORATORIUM MEDIS</label>
				  <div class="col-sm-5">
                  <input type="email" name="email" value="<?=(empty($data[0]['email']) ? $user[0]['email'] : $data[0]['email'])?>" required class="form-control"  autocomplete="off"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<?php
				if(empty($data[0]['upload_surat_permohonan_kode_lab_medis'])){
					$auth_wajib_surat_izin='';
				}
				?>
				
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Upload Surat Permohonan Kode Laboratorium Medis</label>
				  <div class="col-sm-5">
                  <input type="file"  name="upload_surat_permohonan_kode_lab_medis"  id="upload_surat_permohonan_kode_lab_medis" <?=$auth_wajib_surat_izin?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_surat_permohonan_kode_lab_medis']);?>"><?php echo $data[0]['upload_surat_permohonan_kode_lab_medis'];?></a>			  
				  <input type="hidden"  name="old_surat_permohonan_kode_lab_medis"  value="<?=$data[0]['upload_surat_permohonan_kode_lab_medis']?>" id="old_surat_permohonan_kode_lab_medis">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
					<?php
				if(empty($data[0]['upload_surat_izin_operasional_lab_medis'])){
					$auth_wajib_surat_izin_operasional='';
				}
				?>
				
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Upload Surat Izin Operasional Lab Medis</label>
				  <div class="col-sm-5">
                  <input type="file"  name="upload_surat_izin_operasional_lab_medis"  id="upload_surat_izin_operasional_lab_medis" <?=$auth_wajib_surat_izin_operasional?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_surat_izin_operasional_lab_medis']);?>"><?php echo $data[0]['upload_surat_izin_operasional_lab_medis'];?></a>			  
				  <input type="hidden"  name="old_surat_izin_operasional_lab_medis"  value="<?=$data[0]['upload_surat_izin_operasional_lab_medis']?>" id="old_surat_izin_operasional_lab_medis">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">TANGGAL BERAKHIR IZIN OPERASIONAL</label>
				<div class="col-sm-5">
              
                
                  <input type="text" name="tanggal_berakhir_izin_operasional" id="datepicker" value="<?=(!empty($data[0]['tanggal_berakhir_izin_operasional']) ? date('d-m-Y',strtotime($data[0]['tanggal_berakhir_izin_operasional'])) : '')?>"  class="form-control datepicker" required autocomplete="off"  >
        
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
			  
			  
					<?php
				if(empty($data[0]['upload_visi_misi'])){
					$auth_wajib_visi_misi='';
				}
				?>
			  
			  <div class="form-group">
				 <label  class="col-sm-2 control-label">Upload Visi Misi</label>
				  <div class="col-sm-5">
                  <input type="file"  name="upload_visi_misi"  id="upload_visi_misi" <?=$auth_wajib_visi_misi?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_visi_misi']);?>"><?php echo $data[0]['upload_visi_misi'];?></a>			  
				  <input type="hidden"  name="old_visi_misi"  value="<?=$data[0]['upload_visi_misi']?>" id="old_visi_misi">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
				
					<?php
				if(empty($data[0]['upload_struktur_organisasi'])){
					$auth_wajib_struktur_organisasi='';
				}
				?>
			  
			  <div class="form-group">
				 <label  class="col-sm-2 control-label">Upload Struktur Organisasi</label>
				  <div class="col-sm-5">
                  <input type="file"  name="upload_struktur_organisasi"  id="upload_struktur_organisasi" <?=$auth_wajib_struktur_organisasi?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_struktur_organisasi']);?>"><?php echo $data[0]['upload_struktur_organisasi'];?></a>			  
				  <input type="hidden"  name="old_struktur_organisasi"  value="<?=$data[0]['upload_struktur_organisasi']?>" id="old_struktur_organisasi">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
				
				
				 <div class="form-group">
				 <label  class="col-sm-2 control-label">STATUS AKREDITASI</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('status_akreditasi', dropdown_status_akreditasi(), $data[0]['status_akreditasi'],'id="status_akreditasi" onchange="openshowstatusakreditasi(this.value)" class="form-control select2" required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				<?php
					if($data[0]['status_akreditasi']=='Sudah'){
						$var_style_status_akreditasi="block";
					}else{
						$var_style_status_akreditasi="none";
					}
				?>
				
				<div class="form-group" id="tgl_sertifikat_akreditasi_html" style="display:<?=$var_style_status_akreditasi?>">
				<label  class="col-sm-2 control-label">TANGGAL BERAKHIR SERTIFIKAT AKREDITASI</label>
				<div class="col-sm-5">
              
                
                  <input type="text" name="tanggal_berakhir_sertifikat_akreditasi" onchange="openshowrencanasurvey(this.value,<?=date('Ymd')?>)" id="tanggal_berakhir_sertifikat_akreditasi" value="<?=(!empty($data[0]['tanggal_berakhir_sertifikat_akreditasi']) ? date('d-m-Y',strtotime($data[0]['tanggal_berakhir_sertifikat_akreditasi'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
        
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
				
				
					<?php
				if(empty($data[0]['upload_dokumen_sertifikat_dokumen']) && $data[0]['status_akreditasi']=='Sudah'){
					$auth_wajib_dokumen_sertifikat_dokumen='';
				}
				?>
			  
			  <div class="form-group" id="dokumen_sertifikat_akreditasi_html" style="display:<?=$var_style_status_akreditasi?>">
				 <label  class="col-sm-2 control-label">Upload Dokumen Sertifikat Dokumen</label>
				  <div class="col-sm-5">
                  <input type="file"  name="upload_dokumen_sertifikat_dokumen"  id="upload_dokumen_sertifikat_dokumen" <?=$auth_wajib_dokumen_sertifikat_dokumen?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_dokumen_sertifikat_dokumen']);?>"><?php echo $data[0]['upload_dokumen_sertifikat_dokumen'];?></a>			  
				  <input type="hidden"  name="old_dokumen_sertifikat_dokumen"  value="<?=$data[0]['upload_dokumen_sertifikat_dokumen']?>" id="old_dokumen_sertifikat_dokumen">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
				
				<?php
					if($data[0]['status_akreditasi']=='Belum'){
						$var_style_status_akreditasi="block";
					}else if($data[0]['status_akreditasi']=='Sudah' && date('Ymd',strtotime($data[0]['tanggal_berakhir_sertifikat_akreditasi'])) < date('Ymd')){
						$var_style_status_akreditasi="block";
					}else{
						$var_style_status_akreditasi="none";
					}
				?>
				
			
	<div class="form-group" id="tgl_rencana_survey_html" style="display:<?=$var_style_status_akreditasi?>">
				<label  class="col-sm-2 control-label">Rencana Survey Akreditasi</label>
				<div class="col-sm-5">
              
                
                  <input type="text" name="rencana_survey_akreditasi" id="rencana_survey_akreditasi" value="<?=(!empty($data[0]['rencana_survey_akreditasi']) ? date('d-m-Y',strtotime($data[0]['rencana_survey_akreditasi'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
        
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
			  
			<div class="form-group">
				 <label  class="col-sm-2 control-label">PELAYANAN TAMBAHAN</label>
				  <div class="col-sm-5">
				    <?php
				  $bentuk_pelayanan=explode(",",$data[0]['bentuk_pelayanan']);
				  ?>
                 <?=form_dropdown('bentuk_pelayanan[]', dropdown_bentuk_pelayanan(), $bentuk_pelayanan,'id="bentuk_pelayanan" class="form-control select2" multiple ');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				

				
              <!-- /.box-body -->
			<?php
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
			 ?>
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
   
   
   
   function openshowjenispelayanan(value){


	 if(value=='Laboratorium Medis Khusus Pratama'){
			document.getElementById("lab_medis_khusus_html").style.display = "block";
	 }else if(value=='Laboratorium Medis Khusus Utama'){
			document.getElementById("lab_medis_khusus_html").style.display = "block";
	 }else{
		    document.getElementById("lab_medis_khusus_html").style.display = "none";
	 }
	 
	  if(value=='Laboratorium Pengolahan Sel Punca Utama'){
		 document.getElementById("rumah_sakit_yang_bekerja_sama_html").style.display = "block";
	 }else if(value=='Bank Jaringan dan / atau Sel Utama'){
		 document.getElementById("rumah_sakit_yang_bekerja_sama_html").style.display = "block";
	 }else{
		 document.getElementById("rumah_sakit_yang_bekerja_sama_html").style.display = "none";
	 }
       
}

    $('[name="jenis_pelayanan"]').change(function() {
		$('#jenis_pelayanan_child').val('');
		 $('#jenis_lab').val('');
		  
		 
		    $.ajax({
         url: "<?php echo site_url('labkes_dev/dropdownLabkesJenispelayananChild')?>/" + $('#jenis_pelayanan').val().replace(/ /g,"_"),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="jenis_pelayanan_child"]'), data, 'kode_jenis_pelayanan', 'nama_jenis_pelayanan');
         }
      }); 
	  
	 
   });
   
    $('[name="jenis_pelayanan_child"]').change(function() {
		 $('#jenis_lab').val('');
		 
		 
		    $.ajax({
         url: "<?php echo site_url('labkes_dev/dropdownLabkesJenispelayanan')?>/" + $('#jenis_pelayanan_child').val().replace(/ /g,"_"),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="jenis_lab"]'), data, 'kode_jenis_pelayanan', 'nama_jenis_pelayanan');
         }
      }); 
	  
	 
   });
   
   
   
   
   



   function openshowbentuklab(value){


	 if(value=='Terintegrasi (RS, Klinik, Puskesmas, Balai Kesehatan)'){
			document.getElementById("nama_fasyankes_terintegrasi_html").style.display = "block";
	 }else{
		    document.getElementById("nama_fasyankes_terintegrasi_html").style.display = "none";
	 }
       
}


   function openshowstatusakreditasi(value){


	 if(value=='Sudah'){
			document.getElementById("tgl_sertifikat_akreditasi_html").style.display = "block";
			document.getElementById("dokumen_sertifikat_akreditasi_html").style.display = "block";
			document.getElementById("tgl_rencana_survey_html").style.display = "none";		
			//document.getElementById("upload_dokumen_sertifikat_dokumen").required = true;
			
	 }else if(value=='Belum'){
			document.getElementById("tgl_sertifikat_akreditasi_html").style.display = "none";
			document.getElementById("dokumen_sertifikat_akreditasi_html").style.display = "none";
			document.getElementById("tgl_rencana_survey_html").style.display = "block";		
			//document.getElementById("upload_dokumen_sertifikat_dokumen").required = false;
	 }else{
		    document.getElementById("tgl_sertifikat_akreditasi_html").style.display = "none";
			document.getElementById("dokumen_sertifikat_akreditasi_html").style.display = "none";
			document.getElementById("tgl_rencana_survey_html").style.display = "none";		
			//document.getElementById("upload_dokumen_sertifikat_dokumen").required = false;
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


	


   
      function addOption(ele, data, key, val) { //alert(data.length);
   $('option', ele).remove();
  
   ele.append(new Option('', 9999));
   $(data).each(function(index) { //alert(eval('data[index].' + nama));
      ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));
	 
   });
}


   
   </script>
 <script src="<?php echo base_url('assets/js/migrate.js');?>"></script>
