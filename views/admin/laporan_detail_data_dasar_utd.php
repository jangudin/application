<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


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
			<button class="btn btn-mini edit-btn"  value="Print" id="externalCSS"><span class="glyphicon glyphicon-print"></span> Print</button>
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
			<div id="toPrint">
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
				 <label  class="col-sm-2 control-label">NAMA INSTANSI YANG MEMILIKI UTD:</label>
				  <div class="col-sm-5">
                 <input type="text" name="nama_instansi" value="<?=empty($data[0]['nama_instansi']) ? '' : $data[0]['nama_instansi']?>"  class="form-control" autocomplete="off" id="nama_instansi" required  >
				  </div>
				  <div style="clear:both;"></div>
                </div>

				<div class="form-group" >
				 <label  class="col-sm-2 control-label">STATUS KEPEMILIKAN DAN BENTUK UTD *</label>
				  <div class="col-sm-5">
                 <?=form_dropdown('status_kepemilikan', dropdown_status_kepemilikan_utd(), $data[0]['status_kepemilikan'],'id="status_kepemilikan" class="form-control select2"  required ');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
			
					<div class="form-group" id="nama_rs_html" style="display:<?=($data[0]['status_kepemilikan']!='Unit Pelayanan RS' ? 'none' : 'block')?>">
				 <label  class="col-sm-2 control-label">NAMA RS PEMERINTAH/ PEMERINTAH DAERAH *</label>
				  <div class="col-sm-5">
				  <input type="text" name="nama_rs" value="<?=empty($data[0]['nama_rs']) ? '' : $data[0]['nama_rs']?>"  class="form-control" autocomplete="off" id="nama_rs" required >
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
				 <label  class="col-sm-2 control-label">NAMA KEPALA UTD</label>
				  <div class="col-sm-5">
				
				 <input type="text" name="nama_kepala_utd" value="<?=$data[0]['nama_kepala_utd']?>"  class="form-control"   id="nama_kepala_utd" autocomplete="off" required >
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
				<label  class="col-sm-2 control-label">NO TELEPON/ PONSEL</label>
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
				 <label  class="col-sm-2 control-label">Upload SURAT IZIN /SERTIFIKAT STANDAR</label>
				  <div class="col-sm-5">
                  <input type="file"  name="surat_izin_operasional_utd"  id="surat_izin_operasional_utd" <?=$auth_wajib_surat_izin_operasional_utd?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['surat_izin_operasional_utd']);?>"><?php echo $data[0]['surat_izin_operasional_utd'];?></a>			  
				  <input type="hidden"  name="old_surat_izin_operasional_utd"  value="<?=$data[0]['surat_izin_operasional_utd']?>" id="old_surat_izin_operasional_utd">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
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
				 <label  class="col-sm-2 control-label">Upload SURAT PERMOHONAN REGISTRASI</label>
				  <div class="col-sm-5">
                  <input type="file"  name="surat_permohonan_registrasi"  id="surat_permohonan_registrasi" <?=$auth_wajib_surat_permohonan_registrasi?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['surat_permohonan_registrasi']);?>"><?php echo $data[0]['surat_permohonan_registrasi'];?></a>			  
				  <input type="hidden"  name="old_surat_permohonan_registrasi"  value="<?=$data[0]['surat_permohonan_registrasi']?>" id="old_surat_permohonan_registrasi">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
				  <div style="clear:both;"></div>
                </div>
	

				<div class="form-group" id="tanggal_berakhir_surat_izin_html" >
				<label  class="col-sm-2 control-label">TANGGAL BERAKHIR SURAT IZIN/SERTIFIKAT STANDAR</label>
				<div class="col-sm-5">
              
                
                  <input type="text" name="tanggal_berakhir_surat_izin"  id="tanggal_berakhir_surat_izin" value="<?=(!empty($data[0]['tanggal_berakhir_surat_izin']) ? date('d-m-Y',strtotime($data[0]['tanggal_berakhir_surat_izin'])) : '')?>"  class="form-control datepicker"  autocomplete="off"  >
        
				 </div>
				 <div style="clear:both;"></div>
                <!-- /.input group -->
              </div>
			  
			  <div class="form-group">
				 <label  class="col-sm-2 control-label">AKREDITASI UTD *</label>
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
				 <label  class="col-sm-2 control-label">Upload Sertifikat Akreditasi</label>
				  <div class="col-sm-5">
                  <input type="file"  name="upload_sertifikat_akreditasi"  id="upload_sertifikat_akreditasi" <?=$auth_wajib_upload_sertifikat_akreditasi?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_sertifikat_akreditasi']);?>"><?php echo $data[0]['upload_sertifikat_akreditasi'];?></a>			  
				  <input type="hidden"  name="old_upload_sertifikat_akreditasi"  value="<?=$data[0]['upload_sertifikat_akreditasi']?>" id="old_upload_sertifikat_akreditasi">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
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
				 <label  class="col-sm-2 control-label">CPOB *</label>
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
				 <label  class="col-sm-2 control-label">Upload Sertifikat CPOB</label>
				  <div class="col-sm-5">
                  <input type="file"  name="upload_sertifikat_cpob"  id="upload_sertifikat_cpob" <?=$auth_wajib_upload_sertifikat_cpob?>>
				   <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_sertifikat_cpob']);?>"><?php echo $data[0]['upload_sertifikat_cpob'];?></a>			  
				  <input type="hidden"  name="old_upload_sertifikat_cpob"  value="<?=$data[0]['upload_sertifikat_cpob']?>" id="upload_sertifikat_cpob">
				  </div>/* Hanya File PDF Kurang Dari 2 MB
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

			
				

				
       
            </form>
          </div>
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
 
  	   $("#eks").click(function () {

          var m_names = new Array("Januari", "Februari", "Maret",
            "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember");

          var Name = 'Rekap-Data-';
          var d = new Date();
          var curr_date = d.getDate();
          var curr_month = d.getMonth();
          var curr_year = d.getFullYear();
          var blobURL = tableToExcel('toPrint');
          $(this).attr('download',Name+curr_date + "-" + m_names[curr_month]+ "-" + curr_year+'.xls')
          $(this).attr('href',blobURL);
    });
	
   $(function() {
	  $('.select2').select2();
	  $('[data-mask]').inputmask();
     $("#datepicker").datepicker({autoclose: true});
   });
   
      $('[name="id_prov"]').change(function() {
		 $('#id_kota').val('');
		    $.ajax({
         url: "<?php echo site_url('dashboard/dropdown4')?>/" + $(this).val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="id_kota"]'), data, 'id_kota', 'nama_kota');
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
   
	function printElem(options){
      $('#toPrint').printElement(options);
    }
	
	  $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#toPrint").btechco_excelexport({
                containerid: "toPrint"
               , datatype: $datatype.Table
            });
        });
		$("#externalCSS").click(function() {
             printElem({ printMode: 'popup', overrideElementCSS: ['<?=base_url("assets/css/bootstrap.print.css");?>'] });
        });
    });

</script>		
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.printElement.min.js');?>"></script>
 <script src="<?php echo base_url('assets/js/migrate.js');?>"></script>

