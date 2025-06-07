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
              <li  class="active"><a href="<?php echo base_url('rs/inputan_data_faskes_rs');?>">Data Dasar</a></li>
				<li ><a href="<?php echo base_url('rs/inputan_data_sdm_rs');?>">Data SDM</a></li>
				 <li ><a href="<?php echo base_url('rs/inputan_data_tt_rs');?>">Data TT</a></li>
				  <li ><a href="<?php echo base_url('rs/inputan_data_pelayanan_rs');?>">Data Pelayanan</a></li>
				 <li  ><a href="<?php echo base_url('rs/selesaikan_rs');?>">Kirim Data</a></li>
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
				  <label  class="col-sm-2 control-label">NAMA RUMAH SAKIT *</label>
				   <div class="col-sm-5">
                  <input type="text" name="nama_rs" value="<?=empty($data[0]['nama_rs']) ? $user[0]['nama_fasyankes'] : $data[0]['nama_rs']?>"  class="form-control" autocomplete="off" id="nama_rs"  required>
				  <input type="hidden" name="id" value="<?=$data[0]['id']?>"   id="id"  >
				  <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
                <div class="form-group">
				 <label  class="col-sm-2 control-label">TAHUN BERDIRI</label>
				  <div class="col-sm-5">
				   <input type="number" name="tahun_berdiri" value="<?=empty($data[0]['tahun_berdiri']) ? '' : $data[0]['tahun_berdiri']?>"  class="form-control" autocomplete="off" id="tahun_berdiri"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				 <div class="form-group">
				 <label  class="col-sm-2 control-label">NAMA DIREKTUR UTAMA/ DIREKTUR:</label>
				  <div class="col-sm-5">
                 <input type="text" name="nama_direktur" value="<?=empty($data[0]['nama_direktur']) ? '' : $data[0]['nama_direktur']?>"  class="form-control" autocomplete="off" id="nama_direktur"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>

				<div class="form-group" >
				 <label  class="col-sm-2 control-label">JENIS RS *</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('jenis_rs', dropdown_rs_jenis(), $data[0]['jenis_rs'],'id="jenis_rs" class="form-control select2"  required ');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
			
				<div class="form-group">
				 <label  class="col-sm-2 control-label">KELAS *</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('kelas', dropdown_rs_kelas((empty($data[0]['jenis_rs']) ? '1' : $data[0]['jenis_rs'])), (empty($data[0]['kelas']) ? '3' : $data[0]['kelas']),'id="kelas" class="form-control select2"   required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">PEMILIK MODAL RS *</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('pemilik_modal', dropdown_rs_pemilik_modal(), $data[0]['pemilik_modal'],'id="pemilik_modal" class="form-control select2" onchange="openshowrepemilikmodal(this.value)"   required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
		
				<div class="form-group">
				 <label  class="col-sm-2 control-label">STATUS BLU</label>
				  <div class="col-sm-5">

				    <?=form_dropdown('status_blu', array('BLU'=>'BLU','Non BLU'=>'Non BLU'), $data[0]['status_blu'],'id="status_blu" class="form-control select2"   ');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
		
               <div class="form-group">
				 <label  class="col-sm-2 control-label">KEPEMILIKAN *</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('kepemilikan', dropdown_rs_kepemilikan(), $data[0]['kepemilikan'],'id="kepemilikan" class="form-control select2" required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">NAMA PENYELENGGARA *</label>
				  <div class="col-sm-5">
                  <input type="text" name="nama_penyelenggara" value="<?=$data[0]['nama_penyelenggara']?>"  class="form-control" autocomplete="off" id="nama_penyelenggara" required >
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
				<label  class="col-sm-2 control-label">ALAMAT RS *</label>
                <div class="col-sm-5">
                  <textarea name="alamat_faskes" id="alamat_faskes" class="form-control" rows="3" required ><?=(empty($data[0]['alamat_faskes']) ? $user[0]['alamat'] : $data[0]['alamat_faskes'])?></textarea>
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
				  <?php
	   if(empty($data[0]['latitude']) && empty($data[0]['longitude'])){
	   ?>
				  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(initialize);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
  <?php
	   }
  ?>
    var marker;
    function initialize(position){
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
				<label  class="col-sm-2 control-label">LUAS TANAH *</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <input type="text" name="luas_tanah" value="<?=$data[0]['luas_tanah'];?>"  class="form-control" required autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">LUAS BANGUNAN *</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <input type="text" name="luas_bangunan" value="<?=$data[0]['luas_bangunan'];?>"  class="form-control" required autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
				
					<div class="form-group">
				<label  class="col-sm-2 control-label">NO TELEPON (Call Center)</label>
				<div class="col-sm-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="no_telp" value="<?=(empty($data[0]['no_telp']) ? $user[0]['no_hp'] : $data[0]['no_telp'])?>"  class="form-control"  autocomplete="off"  >
                </div>
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
				
	
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">EMAIL RS *</label>
				  <div class="col-sm-5">
                  <input type="email" name="email" value="<?=(empty($data[0]['email']) ? $user[0]['email'] : $data[0]['email'])?>" required class="form-control"  autocomplete="off"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">WEBSITE</label>
				  <div class="col-sm-5">
                  <input type="website" name="website" value="<?=$data[0]['website'];?>"  class="form-control"  autocomplete="off"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">NO SURAT IZIN USAHA</label>
				  <div class="col-sm-5">
                  <input type="nomor_surat_izin_usaha" name="nomor_surat_izin_usaha" value="<?=$data[0]['nomor_surat_izin_usaha'];?>"  class="form-control"  autocomplete="off"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
					
				<div class="form-group">
				 <label  class="col-sm-2 control-label">TANGGAL SURAT IZIN USAHA</label>
				  <div class="col-sm-5">
				  <input type="text" name="tanggal_surat_izin_usaha" id="datepicker" value="<?=(!empty($data[0]['tanggal_surat_izin_usaha']) ? date('d-m-Y',strtotime($data[0]['tanggal_surat_izin_usaha'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">TANGGAL BERLAKU SURAT IZIN USAHA</label>
				  <div class="col-sm-5">
				  <input type="text" name="tanggal_berlaku_surat_izin_usaha" id="datepicker" value="<?=(!empty($data[0]['tanggal_berlaku_surat_izin_usaha']) ? date('d-m-Y',strtotime($data[0]['tanggal_berlaku_surat_izin_usaha'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<?php
				if(empty($data[0]['dokumen_surat_izin_usaha'])){
					$auth_wajib_dokumen_surat_izin_usaha='';
				}
				?>
				
				<?php
					if($data[0]['pemilik_modal']=='2'){
						$var_style_upload_dokumen_surat_izin_usaha="block";
					}else{
						$var_style_upload_dokumen_surat_izin_usaha="none";
					}
				?>
				
				<div class="form-group"  id="upload_dokumen_surat_izin_usaha_html" style="display:<?=$var_style_upload_dokumen_surat_izin_usaha?>">
				 <label  class="col-sm-2 control-label">Link Google drive DOKUMEN SURAT IZIN USAHA</label>
				  <div class="col-sm-5">
                  <!-- <input type="file"  name="dokumen_surat_izin_usaha"  id="dokumen_surat_izin_usaha" <?=$auth_wajib_dokumen_surat_izin_usaha?>> -->
<input type="text"  name="dokumen_surat_izin_usaha"  id="dokumen_surat_izin_usaha" <?=$auth_wajib_dokumen_surat_izin_usaha?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['dokumen_surat_izin_usaha']);?>"><?php echo $data[0]['dokumen_surat_izin_usaha'];?></a>
				  <input type="hidden"  name="old_dokumen_surat_izin_usaha"  value="<?=$data[0]['dokumen_surat_izin_usaha']?>" id="old_dokumen_surat_izin_usaha">
				  </div> <!-- Hanya File PDF Kurang Dari 2 MB  -->
				  <div style="clear:both;"></div>
                </div>
				
					<?php
				if(empty($data[0]['dokumen_surat_permohonan_registrasi_rs'])){
					$auth_wajib_dokumen_surat_permohonan_registrasi_rs='';
				}
				?>
				
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Link Google drive DOKUMEN SURAT PERMOHONAN REGISTRASI RS</label>
				  <div class="col-sm-5">
                  <!-- <input type="file"  name="dokumen_surat_permohonan_registrasi_rs"  id="dokumen_surat_permohonan_registrasi_rs" <?=$auth_wajib_dokumen_surat_permohonan_registrasi_rs?>> -->
<input type="text" class="form-control" name="dokumen_surat_permohonan_registrasi_rs"  id="dokumen_surat_permohonan_registrasi_rs" <?=$auth_wajib_dokumen_surat_permohonan_registrasi_rs?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['dokumen_surat_permohonan_registrasi_rs']);?>"><?php echo $data[0]['dokumen_surat_permohonan_registrasi_rs'];?></a>
				  <input type="hidden"  name="old_dokumen_surat_permohonan_registrasi_rs"  value="<?=$data[0]['dokumen_surat_permohonan_registrasi_rs']?>" id="old_dokumen_surat_permohonan_registrasi_rs">
				  </div> /* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
					<?php
				if(empty($data[0]['sertifikat_izin'])){
					$auth_wajib_sertifikat_izin='required';
				}
				?>
				
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Link Google drive Surat Izin Operasional / Sertifikat Standar</label>
				  <div class="col-sm-5">
<input type="text" class="form-control"  name="sertifikat_izin"  id="sertifikat_izin" <?=$auth_wajib_sertifikat_izin?>>
                  <!-- <input type="file"  name="sertifikat_izin"  id="sertifikat_izin" <?=$auth_wajib_sertifikat_izin?>> -->
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['sertifikat_izin']);?>"><?php echo $data[0]['sertifikat_izin'];?></a>
				  <input type="hidden"  name="old_sertifikat_izin"  value="<?=$data[0]['sertifikat_izin']?>" id="old_sertifikat_izin">
				  </div> /*Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
	
	<div class="form-group">
				 <label  class="col-sm-2 control-label">SIMRS</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('simrs', array(''=>'Belum DI Isi','Punya'=>'Punya','Belum'=>'Belum'), $data[0]['simrs'],'id="simrs" class="form-control select2"   ');?>
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
   
   
    $('[name="jenis_rs"]').change(function() {
		 $('#kelas').val('0');
		    $.ajax({
         url: "<?php echo site_url('rs/dropdownRSKelas')?>/" + $('#jenis_rs').val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="kelas"]'), data, 'id', 'kelas');
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


   function openshowrepemilikmodal(value){


	 if(value=='2'){
			document.getElementById("upload_dokumen_surat_izin_usaha_html").style.display = "block";		
	 }else{
		    document.getElementById("upload_dokumen_surat_izin_usaha_html").style.display = "none";
	 }
       
}


	


   
      function addOption(ele, data, key, val) { //alert(data.length);
   $('option', ele).remove();
  
   ele.append(new Option('', ''));
   $(data).each(function(index) { //alert(eval('data[index].' + nama));
      ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));
	 
   });
}


   
   </script>
 <script src="<?php echo base_url('assets/js/migrate.js');?>"></script>
