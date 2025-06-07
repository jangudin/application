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
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
            <ul class="nav nav-tabs">
              <li  class="active"><a href="<?php echo base_url('dashboard/inputan_data_faskes');?>">Data Dasar</a></li>
			  <li><a href="<?php echo base_url('dashboard/inputan_data_sarpras_alkes_klinik');?>" >Data Sarpras</a></li>
				<li ><a href="<?php echo base_url('dashboard/inputan_data_sdm');?>">Data SDM</a></li>
				 <li  ><a href="<?php echo base_url('dashboard/selesaikan');?>">Selesaikan</a></li>
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
				if(!empty($data2[0]['final'])){
					$disabled_html='readonly';
					
				}
			?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
              <div class="box-body">
			 
				
				 <div class="form-group">
				  <label  class="col-sm-2 control-label">NAMA KLINIK</label>
				   <div class="col-sm-5">
                  <input type="text" <?=$disabled_html;?> name="nama_klinik" value="<?=(!empty($data[0]['nama_klinik']) ? $user[0]['nama_fasyankes'] : $user[0]['nama_fasyankes'])?>"  class="form-control" autocomplete="off" id="nama_klinik"  required>
				  <input type="hidden" name="id" value="<?=$data[0]['id']?>"   id="id"  >
				  <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
                <div class="form-group">
				 <label  class="col-sm-2 control-label">JENIS KLINIK</label>
				  <div class="col-sm-5">
				   <?php
				if(!empty($data2[0]['kode_faskes'])){
					?>
				<input type="text" name="jenis_klinik" <?=$disabled_html;?> class="form-control" value="<?=$data[0]['jenis_klinik']?>"   id="jenis_klinik"  >
					
				     <input type="hidden" name="jenis_klinik_old" value="<?=$data[0]['jenis_klinik']?>"   id="jenis_klinik_old"  >
					<?php
				}else{
			?>
			 <?=form_dropdown('jenis_klinik', dropdown_jenis_klinik(), (!empty($data[0]['jenis_klinik']) ? $data[0]['jenis_klinik'] : 'Pratama'),'id="jenis_klinik" '.$disabled_html.' required class="form-control select2" onchange="openshowjenis_klinik(this.value);"');?>
				     <input type="hidden" name="jenis_klinik_old" value="<?=$data[0]['jenis_klinik']?>"   id="jenis_klinik_old"  >
				
				 
			<?php
				}
			?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">JENIS PELAYANAN</label>
				  <div class="col-sm-5">
				  <?=form_dropdown('jenis_perawatan', dropdown_jenis_perawatan(), $data[0]['jenis_perawatan'],'id="jenis_perawatan" required class="form-control select2"');?>
				    <input type="hidden" name="jenis_perawatan_old" value="<?=$data[0]['jenis_perawatan']?>"   id="jenis_perawatan_old"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<!--<div class="form-group">
				 <label  class="col-sm-2 control-label">PERSALINAN</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('persalinan', dropdown_persalinan(), $data[0]['persalinan'],'id="persalinan" class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div> -->
				  <?php
				 $pelayanan_klinik=explode(';',$data[0]['pelayanan_klinik']);
				  ?>
				<?php
					if(in_array("Pelayanan medik spesialistik", $pelayanan_klinik)){
						$var_style4="block";
					}else{
						$var_style4="none";
					}
				?>
				
				<?php
					if(in_array("Pelayanan lainnya", $pelayanan_klinik)){
						$var_style5="block";
					}else{
						$var_style5="none";
					}
				?>
				
				<?php
					if($data[0]['jenis_klinik']=='Pratama' || empty($data[0]['jenis_klinik'])){
						$var_style6="block";
					}else{
						$var_style6="none";
					}
				?>
				
				<?php
					if($data[0]['jenis_klinik']=='Utama'){
						$var_style7="block";
					}else{
						$var_style7="none";
					}
				?>
				<div class="form-group" id="pelayanan_klinik_html" >
				
				  <label  class="col-sm-2 control-label">PELAYANAN KLINIK</label>
				   <div class="col-sm-10">
				   <div id="pelayanan_pratama_html" style="display:<?=$var_style6?>">
				    <input type="checkbox" <?=(in_array("Pelayanan medik dasar", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan medik dasar"  id="medik_dasar"> Pelayanan medik dasar<br>
					</div>
					 <div id="pelayanan_utama_html" style="display:<?=$var_style7?>">
					<input type="checkbox" onchange="openshowmedik_spesialistik();"  <?=(in_array("Pelayanan medik spesialistik", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]"  value="Pelayanan medik spesialistik"  id="medik_spesialistik"> Pelayanan medik spesialistik  <div id="medik_spesialistik_html" style="display:<?=$var_style4?>"><input type="text" name="sebutkan_pelayanan_klinik_spesialistik" value="<?=$data[0]['sebutkan_pelayanan_klinik_spesialistik']?>"  class="form-control" autocomplete="off" id="sebutkan_pelayanan_klinik_spesialistik"  ></div><br>
					</div>
					<input type="checkbox" <?=(in_array("Pelayanan kesehatan gigi dan mulut", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan kesehatan gigi dan mulut"  id="gigi_dan_mulut"> Pelayanan kesehatan gigi dan mulut<br>
					<input type="checkbox" <?=(in_array("Pelayanan persalinan", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan persalinan"   id="persalinan"> Pelayanan persalinan<br>
					<div id="pelayanan_pratama_html_rehab" style="display:<?=$var_style6?>">
					<input type="checkbox" <?=(in_array("Pelayanan rehabilitasi medik dasar", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan rehabilitasi medik dasar"   id="rehabilitasi"> Pelayanan rehabilitasi medik dasar<br>
					</div>
					<input type="checkbox" <?=(in_array("Pelayanan rehabilitasi medik pecandu narkotika, psikotropika, dan zat adiktif lainnya", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan rehabilitasi medik pecandu narkotika, psikotropika, dan zat adiktif lainnya"   id="narkotika"> Pelayanan rehabilitasi medik pecandu narkotika, psikotropika, dan zat adiktif lainnya<br>
					<input type="checkbox" <?=(in_array("Pelayanan Gizi", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan Gizi"   id="gizi"> Pelayanan Gizi<br>
					<input type="checkbox" <?=(in_array("Pelayanan laboratorium", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan laboratorium"   id="lab"> Pelayanan laboratorium<br>
					<input type="checkbox" <?=(in_array("Pelayanan kefarmasian", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan kefarmasian"   id="farmasi"> Pelayanan kefarmasian<br>
					<input type="checkbox" <?=(in_array("Pelayanan radiologi", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan radiologi"   id="farmasi"> Pelayanan radiologi<br>
					<input type="checkbox" onchange="openshowlainnya();" <?=(in_array("Pelayanan lainnya", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan lainnya"   id="lainnya"> Pelayanan lainnya(Sebutkan) <div id="lainnya_html" style="display:<?=$var_style5?>"><input type="text" name="sebutkan_pelayanan_klinik_lainnya" value="<?=$data[0]['sebutkan_pelayanan_klinik_lainnya']?>"  class="form-control" autocomplete="off" id="sebutkan_pelayanan_klinik_lainnya"  ></div>
				</div>
				  <div style="clear:both;"></div>
                </div>
				 
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Status Penanaman Modal</label>
				  <div class="col-sm-5">
				     <?php
				if(!empty($data2[0]['kode_faskes'])){
					?>
						<input type="text" name="jenis_modal_usaha" <?=$disabled_html;?> class="form-control" value="<?=$data[0]['jenis_modal_usaha']?>"   id="jenis_modal_usaha"  >
					
				    
						<?php
				}else{
			?>
                 <?=form_dropdown('jenis_modal_usaha', dropdown_jenis_modal_usaha(), $data[0]['jenis_modal_usaha'],'id="jenis_modal_usaha" '.$disabled_html.' onchange="opendisableuploadmodalusaha(this.value)" class="form-control select2"');?>
				 
				 	<?php
				}
			?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">KERJA SAMA DENGAN BPJS KESEHATAN</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('kerja_sama_bpjs_kesehatan', array('Tidak'=>'Tidak','Ya'=>'Ya'), $data[0]['kerja_sama_bpjs_kesehatan'],'id="kerja_sama_bpjs_kesehatan" onchange="openshowkerja_sama_bpjs_kesehatan(this.value)" class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				<?php
					if($data[0]['kerja_sama_bpjs_kesehatan']=='Ya'){
						$var_style="block";
					}else{
						$var_style="none";
					}
				?>
				<div class="form-group" id="jumlah_peserta_html" style="display:<?=$var_style?>">
				 <label  class="col-sm-2 control-label">JUMLAH PESERTA</label>
				  <div class="col-sm-5">
                 <input type="text" name="jumlah_peserta" value="<?=$data[0]['jumlah_peserta']?>"  class="form-control" autocomplete="off" id="jumlah_peserta" >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group" id="rasio_dokter_peserta_html" style="display:<?=$var_style?>">
				 <label  class="col-sm-2 control-label">RASIO DOKTER : PESERTA</label>
				  <div class="col-sm-5">
                 <input type="text" name="rasio_dokter_peserta" value="<?=$data[0]['rasio_dokter_peserta']?>"  class="form-control" autocomplete="off" id="rasio_dokter_peserta" placeholder="Contoh 1 : 5.000" >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group" id="menyelenggarakan_prolanis_html" style="display:<?=$var_style?>">
				 <label  class="col-sm-2 control-label">MENYELENGGARAKAN PROLANIS</label>
				  <div class="col-sm-5">
                  <?=form_dropdown('menyelenggarakan_prolanis', array('Tidak'=>'Tidak','Ya'=>'Ya'), $data[0]['menyelenggarakan_prolanis'],'id="menyelenggarakan_prolanis" class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">WAKTU LAYANAN DOKTER PER PASIEN</label>
				  <div class="col-sm-5">
                  <?=form_dropdown('waktu_layanan_dokter_per_pasien', array('<8 menit'=>'<8 menit','8 - 10 menit'=>'8 - 10 menit','>10 menit'=>'>10 menit'), $data[0]['waktu_layanan_dokter_per_pasien'],'id="waktu_layanan_dokter_per_pasien" class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
               <div class="form-group">
				 <label  class="col-sm-2 control-label">Pelaku Usaha</label>
				  <div class="col-sm-5">
				     <?php
				if(!empty($data2[0]['kode_faskes'])){
					?>
				
						<input type="text" name="pemilik" <?=$disabled_html;?> class="form-control" value="<?=$data[0]['pemilik']?>"   id="pemilik"  >
							<?php
				}else{
			?>
                 <?=form_dropdown('pemilik', dropdown_pemilik(), $data[0]['pemilik'],'id="pemilik" '.$disabled_html.' class="form-control select2" required');?>
				 	<?php
				}
			?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Nama Pelaku Usaha</label>
				  <div class="col-sm-5">
                  <input type="text" name="nama_pemilik" value="<?=$data[0]['nama_pemilik']?>"  class="form-control" autocomplete="off" id="nama_pemilik" required >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Nama Penanggung Jawab Klinik</label>
				  <div class="col-sm-5">
                  <input type="text" name="nama_penanggung_jawab_klinik" value="<?=$data[0]['nama_penanggung_jawab_klinik']?>"  class="form-control" autocomplete="off" id="nama_penanggung_jawab_klinik" >
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
				<label  class="col-sm-2 control-label">ALAMAT FASYANKES</label>
                <div class="col-sm-5">
                  <textarea name="alamat_faskes" id="alamat_faskes" class="form-control" rows="3"  ><?=(empty($data[0]['alamat_faskes']) ? $user[0]['alamat'] : $data[0]['alamat_faskes'])?></textarea>
                </div>
				<div style="clear:both;"></div>
				</div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">TITIK LOKASI</label>
                <div class="col-sm-8">
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG362vpRf1YZbpR-fiUOOeWJ-dHbtBDxg&callback=initialize" async defer></script>
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
				<label  class="col-sm-2 control-label">NO TELEPON</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="no_telp" <?=$disabled_html?> value="<?=(empty($data[0]['no_telp']) ? $user[0]['no_hp'] : $data[0]['no_telp'])?>"  class="form-control" required autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
				
	
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Email</label>
				  <div class="col-sm-5">
                  <input type="email" name="email" <?=$disabled_html?> value="<?=(empty($data[0]['email']) ? $user[0]['email'] : $data[0]['email'])?>" required class="form-control"  autocomplete="off"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<?php
				if(empty($data[0]['operasional'])){
					$auth_wajib_surat_izin='required';
				}
				?>
				
				<?php
				if(empty($data[0]['dokumen_registrasi'])){
					$auth_wajib_dokumen_registrasi='required';
				}
				?>
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Upload Dokumen Perizinan Klinik</label>
				  <div class="col-sm-5">
                  <input type="file"  name="operasional"  id="operasional" <?=$auth_wajib_surat_izin?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['operasional']);?>"><?php echo $data[0]['operasional'];?></a>			  
				  <input type="hidden"  name="old_operasional"  value="<?=$data[0]['operasional']?>" id="old_operasional">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">UPLOAD SURAT PERMOHONAN REGISTRASI FASYANKES</label>
				  <div class="col-sm-5">
                  <input type="file"  name="dokumen_registrasi" <?=$disabled_html?>  id="dokumen_registrasi" >
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['dokumen_registrasi']);?>"><?php echo $data[0]['dokumen_registrasi'];?></a>			  
				  <input type="hidden"  name="old_dokumen_registrasi" value="<?=$data[0]['dokumen_registrasi']?>" id="old_dokumen_registrasi">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <br>
				  <a target="_blank" href="<?php echo base_url('assets/Surat Permohonan Registrasi Klinik.docx');?>">Download Contoh Format Surat Permohonan Registrasi</a>	
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Upload Dokumen Akreditasi Fasyankes</label>
				  <div class="col-sm-5">
                  <input type="file"  name="bukti_penanaman_modal_asing"  id="bukti_penanaman_modal_asing">
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['bukti_penanaman_modal_asing']);?>"><?php echo $data[0]['bukti_penanaman_modal_asing'];?></a>			  
				  <input type="hidden"  name="old_bukti_penanaman_modal_asing" value="<?=$data[0]['bukti_penanaman_modal_asing']?>" id="old_bukti_penanaman_modal_asing">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
				
					<div class="form-group">
				 <label  class="col-sm-2 control-label">Status Akreditasi Fasyankes</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('akreditasi', array('Belum'=>'Belum','Sudah'=>'Sudah'), $data[0]['akreditasi'],'id="akreditasi" class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
					<div class="form-group">
				<label  class="col-sm-2 control-label">Tanggal Berakhir Dokumen Perizinan Klinik</label>
				<div class="col-sm-5">
              
                
                  <input type="text"  name="tanggal_berakhir_izin_operasional" id="datepicker" value="<?=(!empty($data[0]['tanggal_berakhir_izin_operasional'] && $data[0]['tanggal_berakhir_izin_operasional'] !='1970-01-01') ? date('d-m-Y',strtotime($data[0]['tanggal_berakhir_izin_operasional'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
        
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
			  
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">PUSKESMAS PEMBINA WILAYAH</label>
                <div class="col-sm-5">
				  <?=form_dropdown('id_wilayah', dropdown_puskesmas($user[0]['id_kota']),  $data[0]['id_wilayah'] ,'id="id_wilayah" class="form-control select2" ');?>
                </div>
				<div style="clear:both;"></div>
				</div>
				
			<div class="form-group">
				 <label  class="col-sm-2 control-label">Berjejaring dengan Puskesmas</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('berjejaring_dengan_puskesmas', array('Tidak'=>'Tidak','Ya'=>'Ya'), $data[0]['berjejaring_dengan_puskesmas'],'id="berjejaring_dengan_puskesmas" onchange="openshowberjejaring_dengan_puskesmas(this.value)" class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				<?php
					if($data[0]['berjejaring_dengan_puskesmas']=='Ya'){
						$var_style2="block";
					}else{
						$var_style2="none";
					}
				?>
				<div class="form-group" id="nama_puskesmas_html" style="display:<?=$var_style2?>">
				<!-- <label  class="col-sm-2 control-label">JUMLAH PESERTA</label>
				  <div class="col-sm-5">
                 <input type="text" name="nama_puskesmas" value="<?=$data[0]['nama_puskesmas']?>"  class="form-control" autocomplete="off" id="nama_puskesmas" placeholder="Jika Lebih Dari 1 Gunakan Koma" >
				
				  </div> -->
				  <?php
				 $program_prioritas_nasional=explode(',',$data[0]['program_prioritas_nasional']);
				  ?>
				  <label  class="col-sm-2 control-label">Melaksanakan Pelayanan Program Prioritas Nasional</label>
				   <div class="col-sm-5">
				    <input type="checkbox" <?=(in_array("TB", $program_prioritas_nasional) ? 'checked' : '') ?> name="program_prioritas_nasional[]" value="TB"  id="tb"> TB&nbsp;&nbsp;&nbsp;<input type="checkbox"  <?=(in_array("Hipertensi", $program_prioritas_nasional) ? 'checked' : '') ?> name="program_prioritas_nasional[]" value="Hipertensi"  id="hipertensi"> Hipertensi&nbsp;&nbsp;&nbsp;<input type="checkbox" <?=(in_array("Diabetes Melitus", $program_prioritas_nasional) ? 'checked' : '') ?> name="program_prioritas_nasional[]" value="Diabetes Melitus"  id="diabetes"> Diabetes Melitus&nbsp;&nbsp;&nbsp;<input type="checkbox" <?=(in_array("Lainnya", $program_prioritas_nasional) ? 'checked' : '') ?> name="program_prioritas_nasional[]" value="Lainnya" onchange="openshowprogram_prioritas_nasional()"  id="prioritas_lainnya"> Lainnya
				</div>
				  <div style="clear:both;"></div>
                </div>
			<?php
					if(in_array("Lainnya", $program_prioritas_nasional)){
						$var_style3="block";
					}else{
						$var_style3="none";
					}
				?>
				<div class="form-group" id="program_prioritas_nasional_html" style="display:<?=$var_style3?>">
				<label  class="col-sm-2 control-label">Melaksanakan Pelayanan Program Prioritas Nasional Lainnya</label>
				  <div class="col-sm-5">
                 <input type="text" name="program_prioritas_nasional_lainnya" value="<?=$data[0]['program_prioritas_nasional_lainnya']?>"  class="form-control" autocomplete="off" id="program_prioritas_nasional_lainnya"  >
				</div>
				 <div style="clear:both;"></div>
				</div>
              <!-- /.box-body -->
			
              <div class="box-footer">
                <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button>
              </div>
		
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
   $(function() {
	  $('.select2').select2();
	  $('[data-mask]').inputmask();
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
   
     function openshowkerja_sama_bpjs_kesehatan(value){


	 if(value=='Ya'){
			document.getElementById("jumlah_peserta_html").style.display = "block";
			document.getElementById("rasio_dokter_peserta_html").style.display = "block";
			document.getElementById("menyelenggarakan_prolanis_html").style.display = "block";
	 }else if(value=='Tidak'){
			document.getElementById("jumlah_peserta_html").style.display = "none";
			document.getElementById("rasio_dokter_peserta_html").style.display = "none";
			document.getElementById("menyelenggarakan_prolanis_html").style.display = "none";
	 }else{
		    document.getElementById("jumlah_peserta_html").style.display = "none";
			document.getElementById("rasio_dokter_peserta_html").style.display = "none";
			document.getElementById("menyelenggarakan_prolanis_html").style.display = "none";
	 }
	 
       
	}
	
	function openshowberjejaring_dengan_puskesmas(value){


	 if(value=='Ya'){
			document.getElementById("nama_puskesmas_html").style.display = "block";
	 }else if(value=='Tidak'){
			document.getElementById("nama_puskesmas_html").style.display = "none";
	 }else{
		    document.getElementById("nama_puskesmas_html").style.display = "none";
	 }
	 
       
	}
	
	function openshowprogram_prioritas_nasional(){


	
	 if(document.getElementById("prioritas_lainnya").checked == true){
			document.getElementById("program_prioritas_nasional_html").style.display = "block";
		}else if(document.getElementById("prioritas_lainnya").checked == false){
			document.getElementById("program_prioritas_nasional_html").style.display = "none";
		}
	 
      
	}
	
	

   function openshowmedik_spesialistik(){
   

		if(document.getElementById("medik_spesialistik").checked == true){
			document.getElementById("medik_spesialistik_html").style.display = "block";
		}else if(document.getElementById("medik_spesialistik").checked == false){
			document.getElementById("medik_spesialistik_html").style.display = "none";
		}
	}
	
	function openshowlainnya(){
   

		if(document.getElementById("lainnya").checked == true){
			document.getElementById("lainnya_html").style.display = "block";
		}else if(document.getElementById("lainnya").checked == false){
			document.getElementById("lainnya_html").style.display = "none";
		}
	}
	
	function openshowjenis_klinik(value){


	 if(value=='Utama'){
			 document.getElementById("pelayanan_pratama_html").style.display = "none";
			  document.getElementById("pelayanan_pratama_html_rehab").style.display = "none";
			  document.getElementById("pelayanan_utama_html").style.display = "block";
	 }else if(value=='Pratama'){
			document.getElementById("pelayanan_pratama_html").style.display = "block";
			document.getElementById("pelayanan_pratama_html_rehab").style.display = "block";
			document.getElementById("pelayanan_utama_html").style.display = "none";
	 }
	 
       
	}
 



   
 
   
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
   
   </script>
 <script src="<?php echo base_url('assets/js/migrate.js');?>"></script>