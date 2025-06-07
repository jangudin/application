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
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
            <ul class="nav nav-tabs">
				
			<?php
				if($this->session->userdata('id_kategori_pm')==4 || $this->session->userdata('id_kategori_pm')==5){
					
				
			?>
				<li  class="active"><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
				<li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li>
                <li><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>
				<li  ><a href="<?php echo base_url('pm/inputan_data_gambar_pm');?>">Dokumentasi</a></li>
<?php
						if(!empty($data2[0]['kode_faskes'])){
                          ?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <li  ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
						<li ><a href="<?php echo base_url('pm/satu_sehat');?>">Satu Sehat</a></li>
			<li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }
                        ?>
                        <li  ><a href="<?php echo base_url('pm/selesaikan');?>">Print QR</a></li> 
			<?php
				} else {
			?>
				<li  class="active"><a href="<?php echo base_url('pm/inputan_data_pm');?>">Data Dasar</a></li>
				<li ><a href="<?php echo base_url('pm/inputan_data_sarpras_alkes_pm');?>" >Data Bangunan & Sarpras</a></li>
				<li ><a href="<?php echo base_url('pm/inputan_data_sdm');?>">Data SDM</a></li>
				<li  ><a href="<?php echo base_url('pm/selesaikan');?>">Final</a></li> 
			<?php
				}
			?>
                        

                        
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

           <?php


		//    if(!empty($data2[0]['final']) == '1' && (!empty($data2[0]['kode_faskes']) == '' || $data2[0]['kode_faskes'] == NULL ) ){

		// 	echo 'Data Registrasi Praktik Mandiri sedang diverifikasi'; 

		//    } else {
			?>

			

			<?php

				if(!empty($data2[0]['final'])){
					$disabled_html='';
					
				} else {
					$disabled_html='';
				}
			?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
              <div class="box-body">

			  <div class="form-group">
				<label  class="col-sm-2 control-label">JENIS PRAKTIK MANDIRI NAKES</label>
				<div class="col-sm-5">
				<?=form_dropdown('id_kategorix', dropdown_kategori_pm(), (!empty($user[0]['id_kategori_pm']) ? $user[0]['id_kategori_pm'] : ''),'id="id_kategorix" disabled required class="form-control select2"');?>
				<input type="hidden" name="id_kategori" value="<?=$user[0]['id_kategori_pm']?>"   id="id_kategori"  >
				</div>  
				<div style="clear:both;"></div>
				</div>

				<div class="form-group">
				<label  class="col-sm-2 control-label">KERJA SAMA DENGAN BPJS KESEHATAN</label>
				<div class="col-sm-5">
                <?=form_dropdown('kerja_sama_bpjs_kesehatan', array('Tidak'=>'Tidak','Ya'=>'Ya') ,(!empty($data[0]['kerja_sama_bpjs_kesehatan']) ? $data[0]['kerja_sama_bpjs_kesehatan'] : ''),'id="kerja_sama_bpjs_kesehatan" class="form-control select2"');?>
				</div>
				<div style="clear:both;"></div>
                </div>

				<?php
					if($user[0]['id_kategori_pm'] == 6){
				?>

					<div class="form-group">
					<label  class="col-sm-2 control-label">BERJEJARING DENGAN FKTP</label>
					<div class="col-sm-5">
							<input type="text" name="berjejaring_fktp" value="<?=(!empty($data[0]['berjejaring_fktp']) ? $data[0]['berjejaring_fktp'] : '-')?>"  class="form-control" autocomplete="off" id="berjejaring_fktp" >
					</div>
					<div style="clear:both;"></div>
					</div>

				<?php } else {

				?>
							<input type="hidden" name="berjejaring_fktp" value="<?=(!empty($data[0]['berjejaring_fktp']) ? $data[0]['berjejaring_fktp'] : '')?>"  class="form-control" autocomplete="off" id="berjejaring_fktp" >

				<?php	
				}
				?>


<div class="form-group">
					<label  class="col-sm-2 control-label">No KTP *</label>
					<div class="col-sm-5">
					<input type="text" name="no_ktp" class="form-control" value="<?=(empty($data[0]['no_ktp']) ? $user[0]['no_ktp'] : $data[0]['no_ktp'])?>" required autocomplete="off"  id="no_ktp" placeholder="No KTP" data-inputmask="'mask': ['9999999999999999']" data-mask="">
					</div>
					<div class="col-sm-1">
					<input type="button" name="nik" id="nik" class="btn btn-danger" value="Cek NIK" style="display:none;">
					<input type="hidden" name="cek_nik" value="<?=(!empty($data[0]['cek_nik']) ? $data[0]['cek_nik'] : '')?>"  id="cek_nik" >
					</div>
					<label  class="col-sm-2 control-label" id="lbl_nik"><?=(!empty($data[0]['cek_nik']) ? $data[0]['cek_nik'] : '')?></label>
					<div style="clear:both;"></div>
				</div>

				 <div class="form-group">
				  <label  class="col-sm-2 control-label">NAMA PRAKTIK MANDIRI</label>
				   <div class="col-sm-5">
                  <input type="text" <?=$disabled_html;?>  name="nama_pm" value="<?=(!empty($data[0]['nama_pm']) ? $data[0]['nama_pm'] : '')?>" placeholder="Contoh : Praktik Mandiri Dokter Ray"  class="form-control" autocomplete="off" id="nama_pm"  required>
						<input type="hidden" name="id" value="<?=(!empty($data[0]['id']) ? $data[0]['id'] : '')?>"   id="id"  >
						<input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
						<input type="hidden" name="cek_nama_pm" value="<?=(!empty($data[0]['cek_nama_pm']) ? $data[0]['cek_nama_pm'] : '')?>"  id="cek_nama_pm" >
				  </div>
				  <label  class="col-sm-2 control-label" id="lbl_nama_pm"><?=(!empty($data[0]['cek_nama_pm']) ? $data[0]['cek_nama_pm'] : '')?></label>
				  <div style="clear:both;"></div>
                </div>

				

				<div class="form-group">
				 <label  class="col-sm-2 control-label">NOMOR SURAT IZIN PRAKTIK (SIP)</label>
				  <div class="col-sm-5">
                  <input type="text" <?=$disabled_html;?>  name="no_sip" value="<?=(!empty($data[0]['no_sip']) ? $data[0]['no_sip'] : '')?>"  class="form-control" autocomplete="off" id="no_sip" >
				  <input type="hidden" name="cek_no_sip" value="<?=(!empty($data[0]['cek_no_sip']) ? $data[0]['cek_no_sip'] : '')?>"  id="cek_no_sip" >  
				</div>
				  <label  class="col-sm-2 control-label" id="lbl_no_sip"><?=(!empty($data[0]['cek_no_sip']) ? $data[0]['cek_no_sip'] : '')?></label>
				  <div style="clear:both;"></div>
                </div>

				<?php
				if(empty($data[0]['dokumen_sip'])){
					$auth_wajib_surat_izin='';
				} else {
					$auth_wajib_surat_izin='';
				}
				?>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">UPLOAD SURAT IZIN PRAKTIK (SIP)</label>
				  <div class="col-sm-5">
                  <input type="file"  name="dokumen_sip"  id="dokumen_sip" <?=$auth_wajib_surat_izin?>>

				   	<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_sip/'.(!empty($data[0]['dokumen_sip']) ? $data[0]['dokumen_sip'] : ''));?>">
				   		<?php echo (!empty($data[0]['dokumen_sip']) ? $data[0]['dokumen_sip'] : '')?>
					</a>			  
				  <input type="hidden"  name="old_dokumen_sip"  value="<?=(!empty($data[0]['dokumen_sip']) ? $data[0]['dokumen_sip'] : '')?>" id="old_dokumen_sip">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
				

                <div class="form-group">
				 <label  class="col-sm-2 control-label">SIP KE BERAPA</label>
				  <div class="col-sm-5">
				  <?=form_dropdown('sip_ke_berapa', dropdown_sip_ke_brp(), (!empty($data[0]['sip_ke_berapa']) ? $data[0]['sip_ke_berapa'] : '1'),'id="sip_ke_berapa"  class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">TANGGAL BERAKHIR SIP</label>
					
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
						<input type="text"  name="tgl_berakhir_sip" id="datepicker" value="<?=(!empty($data[0]['tgl_berakhir_sip']) ? date('d-m-Y',strtotime($data[0]['tgl_berakhir_sip'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
						<input type="hidden" name="cek_tgl_berakhir_sip" value="<?=(!empty($data[0]['cek_tgl_berakhir_sip']) ? $data[0]['cek_tgl_berakhir_sip'] : '')?>"  id="cek_tgl_berakhir_sip" >
						</div>
					</div>
					<label  class="col-sm-2 control-label" id="lbl_tgl_berakhir_sip"><?=(!empty($data[0]['cek_tgl_berakhir_sip']) ? $data[0]['cek_tgl_berakhir_sip'] : '')?></label>
					<!-- /.input group -->
					<div style="clear:both;"></div>
                </div>

				<div class="form-group">
				 <label  class="col-sm-2 control-label">NOMOR SURAT TANDA REGISTRASI (STR)</label>
				  <div class="col-sm-5">
				  <input type="text" <?=$disabled_html;?>  name="no_str" value="<?=(!empty($data[0]['no_str']) ? $data[0]['no_str'] : '')?>"  class="form-control" autocomplete="off" id="no_str" required >
				  <input type="hidden" name="cek_no_str" value="<?=(!empty($data[0]['cek_no_str']) ? $data[0]['cek_no_str'] : '')?>"  id="cek_no_str" >
					</div>
				  <label  class="col-sm-2 control-label" id="lbl_str"><?=(!empty($data[0]['cek_no_str']) ? $data[0]['cek_no_str'] : '')?></label>
				  <div class="col-sm-1">
				  <!--<input type="button" name="str" id="str" class="btn btn-danger" value="Cek STR" required> -->
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<?php
				if(empty($data[0]['dokumen_str'])){
					$auth_wajib_surat_tanda_registrasi='required';
				} else {
					$auth_wajib_surat_tanda_registrasi='';
				}
				?>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">UPLOAD SURAT TANDA REGISTRASI (STR)</label>
				  <div class="col-sm-5">
                  <input type="file"  name="dokumen_str"  id="dokumen_str" <?=$auth_wajib_surat_tanda_registrasi?>>

				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_str/'.(!empty($data[0]['dokumen_str']) ? $data[0]['dokumen_str'] : ''));?>">
				   		<?php echo (!empty($data[0]['dokumen_str']) ? $data[0]['dokumen_str'] : '');?>
					</a>	  
					<input type="hidden"  name="old_dokumen_str"  value="<?=(!empty($data[0]['dokumen_str']) ? $data[0]['dokumen_str'] : '')?>" id="old_dokumen_str">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">STR Seumur Hidup</label>
					
					<div class="col-sm-5">
					<input class="form-check-input" type="checkbox" <?=(!empty($data[0]['str_seumur_hidup'])  ? 'checked' : '') ?> name="str_seumur_hidup" value="1"  id="str_seumur_hidup"> Ya&nbsp;&nbsp;&nbsp;
					</div>

					<!-- /.input group -->
					<div style="clear:both;"></div>
                </div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">TANGGAL BERAKHIR STR</label>
					
					<div class="col-sm-5">
						<div class="input-group">
						<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text"  name="tgl_berakhir_str" id="datepicker" value="<?=(!empty($data[0]['tgl_berakhir_str']) ? date('d-m-Y',strtotime($data[0]['tgl_berakhir_str'])) : '')?>"  class="form-control datepicker"  autocomplete="off" >
					<input type="hidden" name="cek_tgl_berakhir_str" value="<?=(!empty($data[0]['cek_tgl_berakhir_str']) ? $data[0]['cek_tgl_berakhir_str'] : '')?>"  id="cek_tgl_berakhir_str" >		
				</div>
					</div>

					<label  class="col-sm-2 control-label" id="lbl_tgl_berakhir_str"><?=(!empty($data[0]['cek_tgl_berakhir_str']) ? $data[0]['cek_tgl_berakhir_str'] : '')?></label>
					<!-- /.input group -->
					<div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">PROVINSI </label>
				<div class="col-sm-5">
				<?=form_dropdown('id_provx', dropdown_propinsi(), $user[0]['id_prov'],'id="id_provx" class="form-control select2" disabled');?>
				<input type="hidden" name="id_prov_pm" value="<?=$user[0]['id_prov']?>"   id="id_prov_pm"  >
				</div>  
				<div style="clear:both;"></div>
				</div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">KAB/KOTA</label>
				<div class="col-sm-5">
				<?=form_dropdown('id_kotax', dropdown_kota($user[0]['id_prov']), $user[0]['id_kota'],'id="id_kotax" class="form-control select2" disabled');?>
				<input type="hidden" name="id_kota_pm" value="<?=$user[0]['id_kota']?>"   id="id_kota_pm"  >
				</div>  
				<div style="clear:both;"></div>
				</div>
				
					<div class="form-group">
				<label  class="col-sm-2 control-label">KECAMATAN</label>
				<div class="col-sm-5">
				<?=form_dropdown('id_camat_pm', dropdown_kecamatan($user[0]['id_prov'],$user[0]['id_kota']), (empty($data[0]['id_camat_pm']) ? $user[0]['id_camat_pm'] : $data[0]['id_camat_pm']),'id="id_camat_pm" class="form-control select2" ');?>
				</div>  
				<div style="clear:both;"></div>
				</div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">ALAMAT FASYANKES</label>
                <div class="col-sm-5">
                  <textarea name="alamat_faskes" id="alamat_faskes" class="form-control" rows="3"  ><?=(empty($data[0]['alamat_faskes']) ? $user[0]['alamat'] : $data[0]['alamat_faskes'])?></textarea>
                </div>
				<div style="clear:both;"></div>
				</div>

				<div class="form-group">
				<label  class="col-sm-2 control-label">ALAMAT FASYANKES YANG AKAN TERTULIS DI SERTIFIKAT AKREDITASI</label>
                <div class="col-sm-5">
                  <textarea name="alamat_cetak_sertifikat" id="alamat_cetak_sertifikat" class="form-control" rows="3" maxlength="70" ><?=(!empty($data[0]['alamat_cetak_sertifikat']) ? $data[0]['alamat_cetak_sertifikat'] : '');?></textarea>
                </div>/* hanya dituliskan nama jalan nomor, tidak menuliskan nama kecamatan, kabkota dan provinsi 
				<div style="clear:both;"></div>
				</div>


				<div class="form-group">
				 <label  class="col-sm-2 control-label">Kepemilikan Tempat Praktik</label>
				  <div class="col-sm-5">
				  <?=form_dropdown('kepemilikan_tempat', dropdown_kepemilikan_tempat(), (!empty($data[0]['kepemilikan_tempat']) ? $data[0]['kepemilikan_tempat'] : 'Sewa'),'id="kepemilikan_tempat"  required class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				  

				<div class="form-group">
				<label  class="col-sm-2 control-label">TITIK LOKASI</label>
                <div class="col-sm-8">
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAz0z6HkKMun0JLGq8sFTqEeWnfRuIkuY&callback=initialize" async defer></script>
<!--<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiyzxLRNDMCMzlD0WTnX2qyPcU4oOJJTY&callback=initMap"
		async defer></script>-->
		
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

       addMarker(<?=(!empty($data[0]['latitude']) ? $data[0]['latitude'] : '-6.2022');?>, <?=(!empty($data[0]['longitude']) ? $data[0]['longitude'] : '106.8831');?>,"Posisi");
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
	<label  class="col-sm-2 control-label">LATITUDE</label>
	<div class="col-sm-5">
	<input type="text" id="latitude" name="latitude" value="<?=(!empty($data[0]['latitude']) ? $data[0]['latitude'] : '')?>"  class="form-control" required >
	</div>
	<div style="clear:both;"></div>
	</div>
				
	<div class="form-group">			
	<label  class="col-sm-2 control-label">LONGITUDE</label>
	<div class="col-sm-5">
	<input type="text" id="longitude" name="longitude" value="<?=(!empty($data[0]['longitude']) ? $data[0]['longitude'] : '')?>"  class="form-control" required >
	</div>		
	<div style="clear:both;"></div>
	</div>		

			  <div class="form-group">
				<label  class="col-sm-2 control-label">NO TELEPON</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="no_telp"  value="<?=(!empty($data[0]['no_telp']) ? $data[0]['no_telp'] : '')?>"  class="form-control" required autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">NO PONSEL</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="no_hp"  value="<?=(empty($data[0]['no_hp']) ? $user[0]['no_hp'] : $data[0]['no_hp'])?>"  class="form-control" required autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>

			  <div class="form-group">
				<label  class="col-sm-2 control-label">HOTLINE</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="hotline"  value="<?=(empty($data[0]['hotline']) ? $user[0]['hotline'] : $data[0]['hotline'])?>"  class="form-control" required autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
				
			  <div class="form-group">
				<label  class="col-sm-2 control-label">Telpon Kepala Faskes</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="telp_kepala_faskes"  value="<?=(empty($data[0]['telp_kepala_faskes']) ? $user[0]['telp_kepala_faskes'] : $data[0]['telp_kepala_faskes'])?>"  class="form-control" required autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
	
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">EMAIL</label>
				  <div class="col-sm-5">
                  <input type="emailx" name="emailx" disabled  value="<?=(empty($data[0]['email']) ? $user[0]['email'] : $data[0]['email'])?>" required class="form-control"  autocomplete="off"  >
				  <input type="hidden" name="email" value="<?=$user[0]['email']?>"   id="email"  >  
				</div>
				  <div style="clear:both;"></div>
                </div>


				<div class="form-group">
					<label  class="col-sm-2 control-label">JAM PRAKTIK SENIN</label>

					<div class="col-sm-1">
					<label >PAGI</label>
					</div>
					
					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_senin_pagi" value="<?=(!empty($data[0]['jam_praktik_senin_pagi']) ? $data[0]['jam_praktik_senin_pagi'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="08:00 - 12:00" >
						</div>
					</div>
					
					<div class="col-sm-1">
					<label >SORE</label>
					</div>

					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_senin_sore" value="<?=(!empty($data[0]['jam_praktik_senin_sore']) ? $data[0]['jam_praktik_senin_sore'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="14:00 - 20:00" >
						</div>
					</div>

					<div style="clear:both;"></div>
                </div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">JAM PRAKTIK SELASA</label>

					<div class="col-sm-1">
					<label >PAGI</label>
					</div>
					
					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_selasa_pagi" value="<?=(!empty($data[0]['jam_praktik_selasa_pagi']) ? $data[0]['jam_praktik_selasa_pagi'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="08:00 - 12:00" >
						</div>
					</div>
					
					<div class="col-sm-1">
					<label >SORE</label>
					</div>

					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_selasa_sore" value="<?=(!empty($data[0]['jam_praktik_selasa_sore']) ? $data[0]['jam_praktik_selasa_sore'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="14:00 - 20:00" >
						</div>
					</div>

					<div style="clear:both;"></div>
                </div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">JAM PRAKTIK RABU</label>

					<div class="col-sm-1">
					<label >PAGI</label>
					</div>
					
					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_rabu_pagi" value="<?=(!empty($data[0]['jam_praktik_rabu_pagi']) ? $data[0]['jam_praktik_rabu_pagi'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="08:00 - 12:00" >
						</div>
					</div>
					
					<div class="col-sm-1">
					<label >SORE</label>
					</div>

					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_rabu_sore" value="<?=(!empty($data[0]['jam_praktik_rabu_sore']) ? $data[0]['jam_praktik_rabu_sore'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="14:00 - 20:00" >
						</div>
					</div>

					<div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
					<label  class="col-sm-2 control-label">JAM PRAKTIK KAMIS</label>

					<div class="col-sm-1">
					<label >PAGI</label>
					</div>
					
					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_kamis_pagi" value="<?=(!empty($data[0]['jam_praktik_kamis_pagi']) ? $data[0]['jam_praktik_kamis_pagi'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="08:00 - 12:00" >
						</div>
					</div>
					
					<div class="col-sm-1">
					<label >SORE</label>
					</div>

					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_kamis_sore" value="<?=(!empty($data[0]['jam_praktik_kamis_sore']) ? $data[0]['jam_praktik_kamis_sore'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="14:00 - 20:00" >
						</div>
					</div>

					<div style="clear:both;"></div>
                </div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">JAM PRAKTIK JUMAT</label>

					<div class="col-sm-1">
					<label >PAGI</label>
					</div>
					
					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_jumat_pagi" value="<?=(!empty($data[0]['jam_praktik_jumat_pagi']) ? $data[0]['jam_praktik_jumat_pagi'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="08:00 - 12:00" >
						</div>
					</div>
					
					<div class="col-sm-1">
					<label >SORE</label>
					</div>

					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_jumat_sore" value="<?=(!empty($data[0]['jam_praktik_jumat_sore']) ? $data[0]['jam_praktik_jumat_sore'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="14:00 - 20:00" >
						</div>
					</div>

					<div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
					<label  class="col-sm-2 control-label">JAM PRAKTIK SABTU</label>

					<div class="col-sm-1">
					<label >PAGI</label>
					</div>
					
					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_sabtu_pagi" value="<?=(!empty($data[0]['jam_praktik_sabtu_pagi']) ? $data[0]['jam_praktik_sabtu_pagi'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="08:00 - 12:00" >
						</div>
					</div>
					
					<div class="col-sm-1">
					<label >SORE</label>
					</div>

					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_sabtu_sore" value="<?=(!empty($data[0]['jam_praktik_sabtu_sore']) ? $data[0]['jam_praktik_sabtu_sore'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="14:00 - 20:00" >
						</div>
					</div>

					<div style="clear:both;"></div>
                </div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">JAM PRAKTIK MINGGU</label>

					<div class="col-sm-1">
					<label >PAGI</label>
					</div>
					
					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_minggu_pagi" value="<?=(!empty($data[0]['jam_praktik_minggu_pagi']) ? $data[0]['jam_praktik_minggu_pagi'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="08:00 - 12:00" >
						</div>
					</div>
					
					<div class="col-sm-1">
					<label >SORE</label>
					</div>

					<div class="col-sm-3">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
							<input type="text" name="jam_praktik_minggu_sore" value="<?=(!empty($data[0]['jam_praktik_minggu_sore']) ? $data[0]['jam_praktik_minggu_sore'] : '')?>"  class="form-control pull-right" id="jam_praktik" placeholder="14:00 - 20:00" >
						</div>
					</div>

					<div style="clear:both;"></div>
                </div>

				<?php
				if(empty($data[0]['dokumen_registrasi'])){
					$auth_wajib_dokumen_registrasi='required';
				} else {
					$auth_wajib_dokumen_registrasi='';
				}
				?>

				<div class="form-group">
				 <label  class="col-sm-2 control-label">UPLOAD SURAT PERMOHONAN REGISTRASI FASYANKES</label>
				 <div class="col-sm-5">
                  <input type="file"  name="dokumen_registrasi"  id="dokumen_registrasi" >
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_registrasi/'.(!empty($data[0]['dokumen_registrasi']) ? $data[0]['dokumen_registrasi'] : ''));?>">
				   <?php echo (!empty($data[0]['dokumen_registrasi']) ? $data[0]['dokumen_registrasi'] : '') ?>
					   </a>			  
				  <input type="hidden"  name="old_dokumen_registrasi"  value="<?=(!empty($data[0]['dokumen_registrasi']) ? $data[0]['dokumen_registrasi'] : '') ?>" id="old_dokumen_registrasi">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
					<label  class="col-sm-2 control-label">PUSKESMAS PEMBINA WILAYAH</label>
					<div class="col-sm-5">
					<?=form_dropdown('puskesmas_pembina', dropdown_puskesmas($user[0]['id_kota']),  $data[0]['puskesmas_pembina'] ,'id="puskesmas_pembina" class="form-control select2" ');?>
					</div>  
					<div style="clear:both;"></div>
				</div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">Berjejaring dengan PUSKESMAS</label>
					<div class="col-sm-5">
						<?=form_dropdown('berjejaring_puskesmas',  array('Tidak'=>'Tidak','Ya'=>'Ya'),  (!empty($data[0]['berjejaring_puskesmas']) ? $data[0]['berjejaring_puskesmas'] : '') ,'id="berjejaring_puskesmas" class="form-control select2" ');?>
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    $kewenangan_tambahan=explode(',',$data[0]['kewenangan_tambahan']);
                ?>
				<div class="form-group">
					<label  class="col-sm-2 control-label">Kewenangan Tambahan</label>
					<div class="col-sm-8">
						<!-- <?=form_dropdown('kewenangan_tambahan',  array('Akupuntur'=>'Akupuntur','Estetika'=>'Estetika','Komplementer'=>'Komplementer','Akupresur'=>'Akupresur','Herbal'=>'Herbal','Lainnya'=>'Lainnya'),  (!empty($data[0]['kewenangan_tambahan']) ? $data[0]['kewenangan_tambahan'] : '') ,'id="kewenangan_tambahan" class="form-control select2" onchange="openshowkewenangan_tambahan_lainnya(this.value)" ');?> -->
						<input class="form-check-input" type="checkbox"<?=(in_array("Akupuntur", $kewenangan_tambahan) ? 'checked' : '') ?> name="kewenangan_tambahan[]" value="Akupuntur"  id="Akupuntur"> Akupuntur&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox"<?=(in_array("Estetika", $kewenangan_tambahan) ? 'checked' : '') ?> name="kewenangan_tambahan[]" value="Estetika"  id="Estetika"> Estetika&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Komplementer", $kewenangan_tambahan) ? 'checked' : '') ?> name="kewenangan_tambahan[]" value="Komplementer"  id="Komplementer"> Komplementer&nbsp;&nbsp;&nbsp;
						<input class="form-check-input" type="checkbox"<?=(in_array("Akupresur", $kewenangan_tambahan) ? 'checked' : '') ?> name="kewenangan_tambahan[]" value="Akupresur"  id="Akupresur"> Akupresur&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Herbal", $kewenangan_tambahan) ? 'checked' : '') ?> name="kewenangan_tambahan[]" value="Herbal"  id="Herbal"> Herbal&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Lainnya", $kewenangan_tambahan) ? 'checked' : '') ?> name="kewenangan_tambahan[]" value="Lainnya" onchange="openshowkewenangan_tambahan()"  id="kewenangan_lainnya"> Lainnya
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    // if($data[0]['kewenangan_tambahan']=='Lainnya'){
                    //     $var_style_wenang="block";
                    // }else{
                    //     $var_style_wenang="none";
                    // }

					if(in_array("Lainnya", $kewenangan_tambahan)){
						$var_style_wenang="block";
					}else{
						$var_style_wenang="none";
					}
                ?>

				<div class="form-group" id="kewenangan_tambahan_lainnya_html" style="display:<?=$var_style_wenang?>">
					<label  class="col-sm-2 control-label">Kewenangan Tambahan Lainnya</label>
					<div class="col-sm-5">
						<input type="text" name="kewenangan_tambahan_lainnya" class="form-control" value="<?=(empty($data[0]['kewenangan_tambahan_lainnya']) ? $data[0]['kewenangan_tambahan_lainnya'] : $data[0]['kewenangan_tambahan_lainnya'])?>"  autocomplete="off"  id="kewenangan_tambahan_lainnya" placeholder="">
						
					</div>  
					<div style="clear:both;"></div>
				</div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">Upload dokumen kewenangan tambahan</label>
					<div class="col-sm-5">
					<input type="file"  name="dokumen_kewenangan"  id="dokumen_kewenangan" >
					<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_kewenangan/'.(!empty($data[0]['dokumen_kewenangan']) ? $data[0]['dokumen_kewenangan'] : ''));?>">
					<?php echo (!empty($data[0]['dokumen_kewenangan']) ? $data[0]['dokumen_kewenangan'] : '') ?>
						</a>			  
					<input type="hidden"  name="old_dokumen_kewenangan"  value="<?=(!empty($data[0]['dokumen_kewenangan']) ? $data[0]['dokumen_kewenangan'] : '') ?>" id="old_dokumen_kewenangan">
					</div>/* Hanya File PDF Kurang Dari 2 MB
					<div style="clear:both;"></div>
                </div>
				
				<?php
                    $pelatihan_program_prioritas=explode(',',$data[0]['pelatihan_program_prioritas']);
                ?>
				<div class="form-group">
					<label  class="col-sm-2 control-label">Pelatihan yang mendukung program prioritas nasional yang diikuti dokter</label>
					<div class="col-sm-5">
						
						<input class="form-check-input" type="checkbox"<?=(in_array("TB", $pelatihan_program_prioritas) ? 'checked' : '') ?> name="pelatihan_program_prioritas[]" value="TB"  id="TB"> TB&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox"<?=(in_array("Hipertensi", $pelatihan_program_prioritas) ? 'checked' : '') ?> name="pelatihan_program_prioritas[]" value="Hipertensi"  id="hipertensi"> Hipertensi&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Diabetes Melitus", $pelatihan_program_prioritas) ? 'checked' : '') ?> name="pelatihan_program_prioritas[]" value="Diabetes Melitus"  id="diabetes"> Diabetes Melitus&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Lainnya", $pelatihan_program_prioritas) ? 'checked' : '') ?> name="pelatihan_program_prioritas[]" value="Lainnya" onchange="openshowprogram_pelatihan_prioritas_nasional()"  id="pelatihan_prioritas_lainnya"> Lainnya
						
						
						<!-- <input type="text" name="pelatihan_program_prioritas_lainnya" value="<?=$data[0]['pelatihan_program_prioritas_lainnya']?>"  class="form-control" autocomplete="off" id="pelatihan_program_prioritas_lainnya"  placeholder="Sebutkan" style="display:<?=$var_style3?>"> -->
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                                                                if(in_array("Lainnya", $pelatihan_program_prioritas)){
                                                                    $var_style3="block";
                                                                }else{
                                                                    $var_style3="none";
                                                                }
                                                            ?>

				<div class="form-group" id="pelatihan_program_prioritas_lainnya_html" style="display:<?=$var_style3?>">
					<label  class="col-sm-2 control-label">Pelatihan Program Prioritas Lainnya</label>
					<div class="col-sm-5">
					<input type="text" name="pelatihan_program_prioritas_lainnya" value="<?=$data[0]['pelatihan_program_prioritas_lainnya']?>"  class="form-control" autocomplete="off" id="pelatihan_program_prioritas_lainnya"  placeholder="Sebutkan" >
						
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    $program_prioritas=explode(',',$data[0]['program_prioritas']);
                ?>
				<div class="form-group">
					<label  class="col-sm-2 control-label">Mendukung program prioritas nasional</label>
					<div class="col-sm-5">
						
						<input class="form-check-input" type="checkbox"<?=(in_array("TB", $program_prioritas) ? 'checked' : '') ?> name="program_prioritas[]" value="TB"  id="TB"> TB&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox"<?=(in_array("Hipertensi", $program_prioritas) ? 'checked' : '') ?> name="program_prioritas[]" value="Hipertensi"  id="hipertensi"> Hipertensi&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Diabetes Melitus", $program_prioritas) ? 'checked' : '') ?> name="program_prioritas[]" value="Diabetes Melitus"  id="diabetes"> Diabetes Melitus&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Lainnya", $program_prioritas) ? 'checked' : '') ?> name="program_prioritas[]" value="Lainnya" onchange="openshowprogram_prioritas_nasional()"  id="prioritas_lainnya"> Lainnya
						
						
						<!-- <input type="text" name="program_prioritas_lainnya" value="<?=$data[0]['program_prioritas_lainnya']?>"  class="form-control" autocomplete="off" id="program_prioritas_lainnya"  placeholder="Sebutkan" style="display:<?=$var_style4?>"> -->
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    if(in_array("Lainnya", $program_prioritas)){
                        $var_style4="block";
                    }else{
                        $var_style4="none";
                    }
                ?>
				<div class="form-group" id="program_prioritas_lainnya_html" style="display:<?=$var_style4?>">
					<label  class="col-sm-2 control-label">Mendukung program prioritas nasional lainnya</label>
					<div class="col-sm-5">
					<input type="text" name="program_prioritas_lainnya" value="<?=$data[0]['program_prioritas_lainnya']?>"  class="form-control" autocomplete="off" id="program_prioritas_lainnya"  placeholder="Sebutkan" >
						
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    $pelayanan_yang_diberikan=explode(',',$data[0]['pelayanan_yang_diberikan']);
                ?>
				<div class="form-group">
					<label  class="col-sm-2 control-label">Pelayanan yang diberikan</label>
					<div class="col-sm-5">
						<!-- <input class="form-check-input" type="checkbox" name="pelayanan_yang_diberikan[]" value="Medik Dasar"  id="Medik Dasar"> Medik Dasar&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" name="pelayanan_yang_diberikan[]" value="Gigi Dasar"  id="Gigi Dasar"> Gigi Dasar&nbsp;&nbsp;&nbsp;
						<input class="form-check-input" type="checkbox" name="pelayanan_yang_diberikan[]" value="Medik Spesialistik"  id="Medik Spesialistik"> Medik Spesialistik&nbsp;&nbsp;&nbsp;
						<input type="text" name="pelayanan_yang_diberikan" value="" placeholder="Nama Spesialistik" class="form-control" autocomplete="off" id="pelayanan_yang_diberikan"  >
						-->
						<input class="form-check-input" type="checkbox"<?=(in_array("Medik Dasar", $pelayanan_yang_diberikan) ? 'checked' : '') ?> name="pelayanan_yang_diberikan[]" value="Medik Dasar"  id="medik_dasar"> Medik Dasar&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox"<?=(in_array("Gigi Dasar", $pelayanan_yang_diberikan) ? 'checked' : '') ?> name="pelayanan_yang_diberikan[]" value="Gigi Dasar"  id="gigi_dasar"> Gigi Dasar&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input" type="checkbox" <?=(in_array("Medik Spesialistik", $pelayanan_yang_diberikan) ? 'checked' : '') ?> name="pelayanan_yang_diberikan[]" value="Medik Spesialistik"  id="medik_spesialistik" onchange="openshowmedik_spesialistik()"> Medik Spesialistik
						
						<!-- <input type="text" name="pelayanan_yang_diberikan_lainnya" value="<?=$data[0]['pelayanan_yang_diberikan_lainnya']?>"  class="form-control" autocomplete="off" id="pelayanan_yang_diberikan_lainnya"  placeholder="Nama Spesialistik" style="display:<?=$var_style5?>"> -->
					</div>  
					<div style="clear:both;"></div>
				</div>

				<?php
                    if(in_array("Medik Spesialistik", $pelayanan_yang_diberikan)){
                        $var_style5="block";
                    }else{
                        $var_style5="none";
                    }
                ?>

				<div class="form-group" id="pelayanan_yang_diberikan_lainnya_html" style="display:<?=$var_style5?>">
					<label  class="col-sm-2 control-label">Nama Spesialistik</label>
					<div class="col-sm-5">
					<!-- <input type="text" name="pelayanan_yang_diberikan_lainnya" value="<?=$data[0]['pelayanan_yang_diberikan_lainnya']?>"  class="form-control" autocomplete="off" id="pelayanan_yang_diberikan_lainnya"  placeholder="Sebutkan" > -->
					<?=form_dropdown('pelayanan_spesialistik_id', dropdown_spesialistik_pm($user[0]['id_kategori_pm']), (!empty($data[0]['pelayanan_spesialistik_id']) ? $data[0]['pelayanan_spesialistik_id'] : ''),'id="pelayanan_spesialistik_id" class="form-control select2"');?>
					</div>  
					<div style="clear:both;"></div>
				</div>

				<div class="form-group">
					<label  class="col-sm-2 control-label">Upload Pernyataan Komitmen Mutu</label>
					<div class="col-sm-5">
					<input type="file"  name="dokumen_komitmen"  id="dokumen_komitmen" >
					<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_registrasi/'.(!empty($data[0]['dokumen_komitmen']) ? $data[0]['dokumen_komitmen'] : ''));?>">
					<?php echo (!empty($data[0]['dokumen_komitmen']) ? $data[0]['dokumen_komitmen'] : '') ?>
						</a>			  
					<input type="hidden"  name="old_dokumen_komitmen"  value="<?=(!empty($data[0]['dokumen_komitmen']) ? $data[0]['dokumen_komitmen'] : '') ?>" id="old_dokumen_komitmen">
					</div>/* Hanya File PDF Kurang Dari 2 MB
					</br> <a target="_blank" href="https://docs.google.com/document/d/1Hj5nncuOUbPynosZCUhQHusXprLfeWJF/edit?usp=sharing&ouid=113474940871011844970&rtpof=true&sd=true"> Contoh Dokumen Komitmen</a>
					<div style="clear:both;"></div>
                </div>

				
              <!-- /.box-body -->
			
              <div class="box-footer">
                <button type="submit" name="submit" id="submit"  class="btn btn-primary" <?=$disabled_html;?>>Submit</button>
              </div>
		
            </form>
          </div>

		  <?php
		//    }
		  ?>
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
   $(function() {
	  $('.select2').select2();
	  $('[data-mask]').inputmask();
   });
   
       $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight:'TRUE',
    autoclose: true,
})

$('#jam_praktik').datetimepicker({
    dateFormat: '',
    timeFormat: 'hh:mm'
});
   
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
   
      function addOption(ele, data, key, val) { //alert(data.length);
   $('option', ele).remove();
  
   ele.append(new Option('', 9999));
   $(data).each(function(index) { //alert(eval('data[index].' + nama));
      ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));
	 
   });
}

function opendisableuploadmodalusaha(value){
	 var jenis_modal_usaha = document.getElementById('jenis_modal_usaha');
	 //alert(jenis_modal_usaha.value);
	 if(jenis_modal_usaha.value=='Penanaman Modal Asing'){
	$('#bukti_penanaman_modal_asing').prop('disabled', false);	 
	 }
	 
	 if(jenis_modal_usaha.value!='Penanaman Modal Asing'){
	$('#bukti_penanaman_modal_asing').prop('disabled', true);	 
	 }
       
}
   
function openshowkewenangan_tambahan_lainnya(value){
	//alert('tes');
	if(value=='Lainnya'){
		// alert('tes');
		document.getElementById("kewenangan_tambahan_lainnya_html").style.display = "block";
	}else{
		document.getElementById("kewenangan_tambahan_lainnya_html").style.display = "none";
	}
}

function openshowkewenangan_tambahan(){
	if(document.getElementById("kewenangan_lainnya").checked == true){
		document.getElementById("kewenangan_tambahan_lainnya_html").style.display = "block";
	}else if(document.getElementById("kewenangan_lainnya").checked == false){
		document.getElementById("kewenangan_tambahan_lainnya_html").style.display = "none";
	}
}

function openshowprogram_pelatihan_prioritas_nasional(){
	if(document.getElementById("pelatihan_prioritas_lainnya").checked == true){
		document.getElementById("pelatihan_program_prioritas_lainnya_html").style.display = "block";
	}else if(document.getElementById("pelatihan_prioritas_lainnya").checked == false){
		document.getElementById("pelatihan_program_prioritas_lainnya_html").style.display = "none";
	}
}

function openshowprogram_prioritas_nasional(){
	if(document.getElementById("prioritas_lainnya").checked == true){
		document.getElementById("program_prioritas_lainnya_html").style.display = "block";
	}else if(document.getElementById("prioritas_lainnya").checked == false){
		document.getElementById("program_prioritas_lainnya_html").style.display = "none";
	}
}

function openshowmedik_spesialistik(){
	if(document.getElementById("medik_spesialistik").checked == true){
		document.getElementById("pelayanan_yang_diberikan_lainnya_html").style.display = "block";
	}else if(document.getElementById("medik_spesialistik").checked == false){
		document.getElementById("pelayanan_yang_diberikan_lainnya_html").style.display = "none";
	}
}

</script>

<script type="text/javascript"> 

$(document).ready(function(){

	//Cek NIK
	$("#nik").click(function(){

	if($('#no_ktp').val() == null || $('#no_ktp').val() == ""){
		alert('Silahkan isi No KTP / NIK terlebih dahulu'
		 );		

	} else {
		console.log('sedang di cek');
	//alert('NIK tidak ditemukan, lanjutkan pengisian manual');
	//$('#nama_pm').val("halo"); 
      var nik=$('#no_ktp').val();
	  var kategori = "<?php echo $user[0]['id_kategori_pm'] ?>";

	  if(kategori == 4){
		  kategori = "DOKTER";
	  } else if (kategori == 5){
		kategori = "DOKTER GIGI";
	  } else if (kategori == 6){
		kategori = "BIDAN";
	  } else if (kategori == 7){
		kategori = "PERAWAT";
	  }

      //alert (nik);
      $.ajax({
      type  : 'GET', 
      url : "<?php echo site_url('pm/alamatnik')?>" ,
      data  : "id="+nik,
      dataType : 'json',
      cache : false,
      success : function(response){
      if(response.status == 200){
		 $('#nama_pm').val('PRAKTIK MANDIRI '+ kategori+ ' ' +response.data.nama); 
		 $('#lbl_nama_pm').text('Data Ditemukan');
		 $('#cek_nama_pm').val('Data Ditemukan');
		 $('#cek_nik').val("NIK terdaftar di SISDMK");
		 $('#lbl_nik').text("NIK terdaftar di SISDMK");
		 //console.log(response.data.pekerjaan.at(-1).TANGGAL_AKHIR_SIP);
		 //console.log(response.data.pekerjaan.at(-1).TANGGAL_STR);

		 var tgl_sip = (response.data.pekerjaan.at(-1).TANGGAL_AKHIR_SIP);
		 var tgl_str = (response.data.pekerjaan.at(-1).TANGGAL_STR);

		 if(tgl_sip == null || tgl_sip == "0000-00-00"){
			var tanggal_berakhir_sip = "";
			var lbl_no_sip = "Data Tidak Ditemukan"
			var lbl_tanggal_berakhir_sip = "Data Tidak Ditemukan"
		 } else {
			var date = new Date(response.data.pekerjaan.at(-1).TANGGAL_AKHIR_SIP);
		 	var tanggal_berakhir_sip = ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '-' + ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + date.getFullYear();
		 	var lbl_no_sip = "Data Ditemukan"
			var lbl_tanggal_berakhir_sip = "Data Ditemukan"
		 }

		 if(tgl_str == null || tgl_str == "0000-00-00"){
			var tanggal_berakhir_str = "";
			var lbl_no_str = "Data Tidak Ditemukan"
			var lbl_tanggal_berakhir_str = "Data Tidak Ditemukan"
		 } else {
			var datee = new Date(response.data.pekerjaan.at(-1).TANGGAL_STR);
		 	var tanggal_berakhir_str = ((datee.getDate() > 9) ? datee.getDate() : ('0' + datee.getDate())) + '-' + ((datee.getMonth() > 8) ? (datee.getMonth() + 1) : ('0' + (datee.getMonth() + 1))) + '-' + datee.getFullYear();
			var lbl_no_str = "Data Ditemukan"
			var lbl_tanggal_berakhir_str = "Data Ditemukan"
		 }

		//console.log(tanggal_berakhir_sip);
		//console.log(tanggal_berakhir_str);

		 $('#no_sip').val(response.data.pekerjaan[0].SIP);
		 $('input[name=tgl_berakhir_sip]').val(tanggal_berakhir_sip);
		 $('#no_str').val(response.data.pekerjaan[0].STR);
		 $('input[name=tgl_berakhir_str]').val(tanggal_berakhir_str);

		 $('#lbl_no_sip').text(lbl_no_sip); 
		 $('#lbl_tgl_berakhir_sip').text(lbl_tanggal_berakhir_sip); 
		 $('#lbl_str').text(lbl_no_str); 
		 $('#lbl_tgl_berakhir_str').text(lbl_tanggal_berakhir_str); 

		 $('#cek_no_sip').val(lbl_no_sip);
		 $('#cek_tgl_berakhir_sip').val(lbl_tanggal_berakhir_sip);
		 $('#cek_no_str').val(lbl_no_str);
		 $('#cek_tgl_berakhir_str').val(lbl_tanggal_berakhir_str);

		 alert('NIK telah terdaftar di SISDMK \natas nama ' 
		 		+ response.data.nama
		 );
		 console.log(response);
      } else {
		alert('NIK tidak terdaftar di SISDMK');
		$('#cek_nik').val("NIK tidak terdaftar di SISDMK");
		$('#lbl_nik').text("NIK tidak terdaftar di SISDMK");
		$('#cek_nama_pm').val('');
		$('#lbl_nama_pm').text('');

		$('#lbl_no_sip').text(''); 
		 $('#lbl_tgl_berakhir_sip').text(''); 
		 $('#lbl_str').text(''); 
		 $('#lbl_tgl_berakhir_str').text(''); 

		$('#cek_no_sip').val('');
		 $('#cek_tgl_berakhir_sip').val('');
		 $('#cek_no_str').val('');
		 $('#cek_tgl_berakhir_str').val('');
		console.log(response);
	  }

      }
    });

	}

    });


	//Cek STR
	$("#str").click(function(){
	//alert('NIK tidak ditemukan, lanjutkan pengisian manual');
	//$('#nama_pm').val("halo"); 
      var str=$('#no_str').val();
      //alert (nik);
      $.ajax({
      type  : 'GET', 
      url : "<?php echo site_url('pm/cekStr')?>" ,
      data  : "id="+str,
      dataType : 'json',
      cache : false,
      success : function(data){
      if(data.status == 200 && typeof data.data !== 'undefined' ){
         alert('STR telah terdaftar di SISDMK \natas nama ' 
		 		+ data.data.nama
		 );
		 $('#lbl_str').text("STR terdaftar di SISDMK");
		 console.log(data);
      } else {
		alert('STR tidak terdaftar di SISDMK');
		$('#lbl_str').text("STR tidak terdaftar di SISDMK");
		console.log(data);
	  }

      }
    });
    });


})

</script>


 <script src="<?php echo base_url('assets/js/migrate.js');?>"></script>