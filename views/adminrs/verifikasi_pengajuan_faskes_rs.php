


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
                 <li  class="active"><a href="<?php echo base_url('rs/verifikasi_pengajuan_faskes_rs/').$this->encrypt->encode($user_id);?>">Data Dasar</a></li>
				<li ><a href="<?php echo base_url('rs/verifikasi_pengajuan_faskes_sdm_rs/').$this->encrypt->encode($user_id);?>">Data SDM</a></li>
				 <li ><a href="<?php echo base_url('rs/verifikasi_pengajuan_faskes_tt_rs/').$this->encrypt->encode($user_id);?>">Data TT</a></li>
				  <li ><a href="<?php echo base_url('rs/verifikasi_pengajuan_pelayanan_rs/').$this->encrypt->encode($user_id);?>">Data Pelayanan</a></li>
			 <?php
				if($this->session->userdata('id_kategori') =='1'){
			   ?>
			   <li><a href="<?php echo base_url('rs/verifikasikan_kirim_rs/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
			   <?php
			   }else if($this->session->userdata('id_kategori') =='3'){
			   ?>
			    <li><a href="<?php echo base_url('rs/verifikasikan_kirim_rs/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
			   <?php
			   }else if($this->session->userdata('id_kategori') =='2'){
			   ?>
			    <li><a href="<?php echo base_url('rs/verifikasikan_kirim_rs/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
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
				   
                 <?=form_dropdown('kelas', dropdown_rs_kelas($data[0]['jenis_rs']), $data[0]['kelas'],'id="kelas" class="form-control select2"   required');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">PEMILIK MODAL RS *</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('pemilik_modal', dropdown_rs_pemilik_modal(), $data[0]['pemilik_modal'],'id="pemilik_modal" class="form-control select2"   required');?>
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
				<?=form_dropdown('id_prov', dropdown_propinsi(), $data[0]['id_prov'],'id="id_prov" disabled class="form-control select2" ');?>
			
				</div>  
				<div style="clear:both;"></div>
				</div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">KAB/KOTA</label>
				<div class="col-sm-5">
			<?=form_dropdown('id_kota', dropdown_kota($data[0]['id_prov']), $data[0]['id_kota'],'id="id_kota" disabled class="form-control select2"');?>
				<input type="hidden" name="id_kota" value="<?=$user[0]['id_kota']?>"   id="id_kota"  >
				</div>  
				<div style="clear:both;"></div>
				</div>
				
					<div class="form-group">
				<label  class="col-sm-2 control-label">KECAMATAN</label>
				<div class="col-sm-5">
				<?=form_dropdown('id_camat', dropdown_kecamatan($data[0]['id_prov'],$data[0]['id_kota']), $data[0]['id_camat'],'id="id_camat" disabled class="form-control select2"');?>
				<!--<input type="hidden" name="id_camat" value="<?=$user[0]['id_camat']?>"   id="id_camat"  >-->
				</div>  
				<div style="clear:both;"></div>
				</div>
				
			<div class="form-group">
				<label  class="col-sm-2 control-label">ALAMAT FASYANKES</label>
                <div class="col-sm-5">
                  <textarea disabled name="alamat_faskes" id="alamat_faskes" class="form-control" rows="3"  ><?=(empty($data[0]['alamat_faskes']) ? $user[0]['alamat'] : $data[0]['alamat_faskes'])?></textarea>
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
				
				
				
				<div class="form-group" id="upload_sertifikat_akreditasi_html" style="display:<?=$var_style_upload_dokumen_surat_izin_usaha?>">
				 <label  class="col-sm-2 control-label">Upload DOKUMEN SURAT IZIN USAHA</label>
				  <div class="col-sm-5">
                  <input type="file"  name="dokumen_surat_izin_usaha"  id="dokumen_surat_izin_usaha" <?=$auth_wajib_dokumen_surat_izin_usaha?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['dokumen_surat_izin_usaha']);?>"><?php echo $data[0]['dokumen_surat_izin_usaha'];?></a>			  
				  <input type="hidden"  name="old_dokumen_surat_izin_usaha"  value="<?=$data[0]['dokumen_surat_izin_usaha']?>" id="old_dokumen_surat_izin_usaha">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
					<?php
				if(empty($data[0]['dokumen_surat_permohonan_registrasi_rs'])){
					$auth_wajib_dokumen_surat_permohonan_registrasi_rs='';
				}
				?>
				
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Upload DOKUMEN SURAT PERMOHONAN REGISTRASI RS</label>
				  <div class="col-sm-5">
                  <input type="file"  name="dokumen_surat_permohonan_registrasi_rs"  id="dokumen_surat_permohonan_registrasi_rs" <?=$auth_wajib_dokumen_surat_permohonan_registrasi_rs?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['dokumen_surat_permohonan_registrasi_rs']);?>"><?php echo $data[0]['dokumen_surat_permohonan_registrasi_rs'];?></a>			  
				  <input type="hidden"  name="old_dokumen_surat_permohonan_registrasi_rs"  value="<?=$data[0]['dokumen_surat_permohonan_registrasi_rs']?>" id="old_dokumen_surat_permohonan_registrasi_rs">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
				
					<?php
				if(empty($data[0]['sertifikat_izin'])){
					$auth_wajib_sertifikat_izin='required';
				}
				?>
				
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">Upload Surat Izin Operasional / Sertifikat Standar</label>
				  <div class="col-sm-5">
                  <input type="file"  name="sertifikat_izin"  id="sertifikat_izin" <?=$auth_wajib_sertifikat_izin?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['sertifikat_izin']);?>"><?php echo $data[0]['sertifikat_izin'];?></a>			  
				  <input type="hidden"  name="old_sertifikat_izin"  value="<?=$data[0]['sertifikat_izin']?>" id="old_sertifikat_izin">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
	
	<div class="form-group">
				 <label  class="col-sm-2 control-label">SIMRS</label>
				  <div class="col-sm-5">
				   
                 <?=form_dropdown('simrs', array(''=>'Belum DI Isi','Punya'=>'Punya','Belum'=>'Belum'), $data[0]['simrs'],'id="simrs" class="form-control select2"   ');?>
				  </div>
				  <div style="clear:both;"></div>
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
<script>

$(function() {
    $('input:radio[name="nama_lab_validasi"]').change(function() {
        if ($(this).val() == '1') {
            document.getElementById("keterangan_nama_lab_validasi").disabled = true;
        } else {
          document.getElementById("keterangan_nama_lab_validasi").disabled = false;
        }
    });
});

$(function() {
    $('input:radio[name="pemilik_validasi"]').change(function() {
        if ($(this).val() == '1') {
            document.getElementById("keterangan_pemilik_validasi").disabled = true;
        } else {
          document.getElementById("keterangan_pemilik_validasi").disabled = false;
        }
    });
});

$(function() {
    $('input:radio[name="alamat_validasi"]').change(function() {
        if ($(this).val() == '1') {
            document.getElementById("keterangan_alamat_validasi").disabled = true;
        } else {
          document.getElementById("keterangan_alamat_validasi").disabled = false;
        }
    });
});

function myFunction(id,value) {
	alert(id);
  // Get the checkbox
  var checkBox = document.getElementById(value);
  // Get the output text

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
	  document.getElementById("keterangan_"+value).disabled = false;
	
  // alert(checkBox.value);
  } else {
	   document.getElementById("keterangan_"+value).disabled = true;
	
   // alert(0);
  }
} 


$("#submit_nama_lab_validasi").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('dashboard/simpan_validasi/');?>",
        data: { 
            id: $(this).val(), // < note use of 'this' here
            nama_lab: $("#nama_lab_validasi").val() 
        },
        success: function(result) {
            alert('ok');
        },
        error: function(result) {
            alert('error');
        }
    });
});
</script>	