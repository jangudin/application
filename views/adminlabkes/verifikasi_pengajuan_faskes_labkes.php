<!-- Main content -->
<section class="content">

	<div class="row">

		<!-- /.col -->
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<?php
				if ($this->session->flashdata('message_name') != null) {
				?>
					<div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-<?= $this->session->flashdata('icon_name'); ?>"></i> Alert!</h4>
						<?= $this->session->flashdata('message_name'); ?>
					</div>
				<?php
				}
				?>
				<ul class="nav nav-tabs">
					<li class="active"><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_labkes/') . $this->encrypt->encode($user_id); ?>">Data Dasar</a></li>
					<li><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_alkes_labkes/') . $this->encrypt->encode($user_id); ?>">Data Sarpras & Alkes</a></li>
					<li><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_sdm_labkes/') . $this->encrypt->encode($user_id); ?>">Data SDM</a></li>
					<li><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_jenis_pemeriksaan_labkes/') . $this->encrypt->encode($user_id); ?>">Data Pelayanan</a></li>
					<?php
					if ($this->session->userdata('id_kategori') == '1') {
					?>
						<li><a href="<?php echo base_url('labkes/verifikasikan_kirim_labkes/') . $this->encrypt->encode($user_id); ?>">Verifikasikan</a></li>
					<?php
					} else if ($this->session->userdata('id_kategori') == '3') {
					?>
						<li><a href="<?php echo base_url('labkes/verifikasikan_kirim_labkes/') . $this->encrypt->encode($user_id); ?>">Verifikasikan</a></li>
					<?php
					} else if ($this->session->userdata('id_kategori') == '2') {
					?>
						<li><a href="<?php echo base_url('labkes/verifikasikan_kirim_labkes/') . $this->encrypt->encode($user_id); ?>">Verifikasikan</a></li>
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
								<div class="col-md-12">
									<!-- general form elements -->
									<div class="box box-primary">

										<!-- /.box-header -->
										<!-- form start -->
										<?php
										if (empty($data[0]['validasi_field']) && $data[0]['validasi_field'] == '') {
											$json_validasi = '{"field":{"nama_lab_validasi":{"nilai":null,"keterangan":null},"pemilik_validasi":{"nilai":null,"keterangan":null},"alamat_validasi":{"nilai":null,"keterangan":null} } }';
										} else {
											$json_validasi = $data[0]['validasi_field'];
										}
										$validasi = (array)json_decode($json_validasi);
										?>
										<form role="form" method="POST" action="" enctype='multipart/form-data'>
											<div class="box-body">
												<div class="form-group">
													<label class="col-sm-2 control-label">NAMA INSTITUSI/LABORATORIUM</label>
													<div class="col-sm-5">
														<input type="text" name="nama_lab" value="<?= empty($data[0]['nama_lab']) ? $user[0]['nama_fasyankes'] : $data[0]['nama_lab'] ?>" class="form-control" autocomplete="off" id="nama_lab" disabled>
														<input type="hidden" name="id" value="<?= $data[0]['id'] ?>" id="id">
														<input type="hidden" name="id_faskes" value="<?= $data[0]['id_faskes'] ?>" id="id_faskes">
													</div>
													<?php
													foreach ($validasi['field'] as $keyvalidasi => $valvalidasi) {
														if ($keyvalidasi == 'nama_lab_validasi') {
															$validasi2 = (array)$valvalidasi;

															echo '<input type="radio"   id="nama_lab_validasi_acc" name="nama_lab_validasi" ' . ($validasi2['nilai'] == '1' ? 'checked' : '') . ' value="1">Valid&nbsp;&nbsp;<input type="radio"  id="nama_lab_tidak_validasi" name="nama_lab_validasi" ' . ($validasi2['nilai'] == '0' ? 'checked' : '') . ' value="0">Tidak Valid&nbsp;&nbsp;<input type="text" ' . ($validasi2['nilai'] != '1' ? '' : 'disabled') . ' value="' . (!empty($validasi2['keterangan']) ? $validasi2['keterangan'] : '') . '" id="keterangan_nama_lab_validasi" name="keterangan_nama_lab_validasi"  placeholder="Keterangan Valid">';
														}
													}
													?>

													<div style="clear:both;"></div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">JENIS LABORATORIUM</label>
													<div class="col-sm-5">
														<?php
														$jenis_pelayanan = explode(",", $data[0]['jenis_pelayanan']);
														?>
														<?= form_dropdown('jenis_pelayanan', dropdown_jenis_pelayanan(), $data[0]['jenis_pelayanan'], 'id="jenis_pelayanan" class="form-control select2"   disabled'); ?>
													</div>
													<div style="clear:both;"></div>
												</div>


												<div class="form-group">
													<label class="col-sm-2 control-label">JENIS PELAYANAN</label>
													<div class="col-sm-5">
														<?= form_dropdown('jenis_lab', dropdown_jenis_lab($data[0]['jenis_pelayanan']), $data[0]['jenis_lab'], 'id="jenis_lab" onchange="openshowjenispelayanan(this.value)" class="form-control select2" disabled'); ?>
													</div>
													<div style="clear:both;"></div>
												</div>
												<?php
												if ($data[0]['jenis_lab'] == 'Laboratorium  Medis Khusus Pratama' || $data[0]['jenis_lab'] == 'Laboratorium  Medis Khusus Utama') {
													$var_style = "block";
												} else {
													$var_style = "none";
												}
												?>
												<div class="form-group" id="lab_medis_khusus_html" style="display:<?= $var_style ?>">
													<label class="col-sm-2 control-label">LABORATORIUM MEDIS KHUSUS</label>
													<div class="col-sm-5">
														<?= form_dropdown('lab_medis_khusus', dropdown_lab_medis_khusus(), $data[0]['lab_medis_khusus'], 'id="lab_medis_khusus" class="form-control select2" disabled'); ?>
													</div>
													<div style="clear:both;"></div>
												</div>
												<!--
				 <div class="form-group">
				 <label  class="col-sm-2 control-label">PELAYANAN LAIN</label>
				  <div class="col-sm-5">
				   <?php
					$pelayanan_lain = explode(",", $data[0]['pelayanan_lain']);
					?>
                 <?= form_dropdown('pelayanan_lain[]', dropdown_pelayanan_lain(), $pelayanan_lain, 'id="pelayanan_lain" class="form-control  select2" multiple disabled'); ?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				-->

												<div class="form-group">
													<label class="col-sm-2 control-label">BENTUK LAB</label>
													<div class="col-sm-5">

														<?= form_dropdown('bentuk_lab', dropdown_bentuk_lab(), $data[0]['bentuk_lab'], 'id="bentuk_lab" class="form-control select2" onchange="openshowbentuklab(this.value)"   disabled'); ?>
													</div>
													<div style="clear:both;"></div>
												</div>

												<?php
												if ($data[0]['bentuk_lab'] == 'Terintegrasi (RS, Klinik, Puskesmas, Balai Kesehatan)') {
													$var_style2 = "block";
												} else {
													$var_style2 = "none";
												}
												?>
												<div class="form-group" id="nama_fasyankes_terintegrasi_html" style="display:<?= $var_style2 ?>">
													<label class="col-sm-2 control-label">NAMA FASYANKES TERINTEGRASI</label>
													<div class="col-sm-5">

														<input type="text" name="nama_fasyankes_terintegrasi" value="<?= $data[0]['nama_fasyankes_terintegrasi'] ?>" class="form-control" disabled id="nama_fasyankes_terintegrasi" autocomplete="off">
														<input type="hidden" name="id_nama_fasyankes_terintegrasi" value="<?= $data[0]['id_nama_fasyankes_terintegrasi'] ?>" id="id_nama_fasyankes_terintegrasi">
													</div>
													<div style="clear:both;"></div>
												</div>


												<div class="form-group">
													<label class="col-sm-2 control-label">PEMILIK</label>
													<div class="col-sm-5">
														<?= form_dropdown('pemilik', dropdown_pemilik_labkes(), $data[0]['pemilik'], 'id="pemilik" class="form-control select2" disabled'); ?>
													</div>
													<?php
													foreach ($validasi['field'] as $keyvalidasi => $valvalidasi) {
														if ($keyvalidasi == 'pemilik_validasi') {
															$validasi2 = (array)$valvalidasi;
															echo '<input type="radio"  id="pemilik_validasi_acc" name="pemilik_validasi" ' . ($validasi2['nilai'] == '1' ? 'checked' : '') . ' value="1">Valid&nbsp;&nbsp;<input type="radio"  id="pemilik_validasi_tidak_acc" name="pemilik_validasi" ' . ($validasi2['nilai'] == '0' ? 'checked' : '') . ' value="0">Tidak Valid&nbsp;&nbsp; <input type="text" ' . ($validasi2['nilai'] != '1' ? '' : 'disabled') . ' value="' . (!empty($validasi2['keterangan']) ? $validasi2['keterangan'] : '') . '" id="keterangan_pemilik_validasi" name="keterangan_pemilik_validasi"  placeholder="Keterangan Valid">';
														}
													}
													?>
													<div style="clear:both;"></div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">NAMA PEMILIK</label>
													<div class="col-sm-5">
														<input type="text" name="nama_pemilik" value="<?= $data[0]['nama_pemilik'] ?>" class="form-control" autocomplete="off" id="nama_pemilik" disabled>
													</div>
													<div style="clear:both;"></div>
												</div>



												<div class="form-group">
													<label class="col-sm-2 control-label">PROVINSI </label>
													<div class="col-sm-5">
														<?= form_dropdown('id_prov', dropdown_propinsi(), $data[0]['id_prov'], 'id="id_prov" disabled class="form-control select2" '); ?>

													</div>
													<div style="clear:both;"></div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">KAB/KOTA</label>
													<div class="col-sm-5">
														<?= form_dropdown('id_kota', dropdown_kota($data[0]['id_prov']), $data[0]['id_kota'], 'id="id_kota" disabled class="form-control select2"'); ?>
													</div>
													<div style="clear:both;"></div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">KECAMATAN</label>
													<div class="col-sm-5">
														<?= form_dropdown('id_camat', dropdown_kecamatan($data[0]['id_prov'], $data[0]['id_kota']), $data[0]['id_camat'], 'id="id_camat" disabled class="form-control select2"'); ?>

													</div>
													<div style="clear:both;"></div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">ALAMAT FASYANKES</label>
													<div class="col-sm-5">
														<textarea disabled name="alamat_faskes" id="alamat_faskes" class="form-control" rows="3"><?= (empty($data[0]['alamat_faskes']) ? $user[0]['alamat'] : $data[0]['alamat_faskes']) ?></textarea>
													</div>
													<?php
													foreach ($validasi['field'] as $keyvalidasi => $valvalidasi) {
														if ($keyvalidasi == 'alamat_validasi') {
															$validasi2 = (array)$valvalidasi;
															echo '<input type="radio"  id="alamat_validasi_tidak_acc" name="alamat_validasi" ' . ($validasi2['nilai'] == '1' ? 'checked' : '') . ' value="1">Valid&nbsp;&nbsp;<input type="radio"  id="alamat_validasi_tidak_acc" name="alamat_validasi" ' . ($validasi2['nilai'] == '0' ? 'checked' : '') . ' value="0">Tidak Valid&nbsp;&nbsp;<input type="text" ' . ($validasi2['nilai'] != '1' ? '' : 'disabled') . ' value="' . (!empty($validasi2['keterangan']) ? $validasi2['keterangan'] : '') . '" id="keterangan_alamat_validasi" name="keterangan_alamat_validasi"  placeholder="Keterangan Valid">';
														}
													}
													?>
													<div style="clear:both;"></div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">TITIK LOKASI</label>
													<div class="col-sm-8">
														<!--<script  src="https://maps.google.com/maps?file=api&v=2&key=AIzaSyAiyzxLRNDMCMzlD0WTnX2qyPcU4oOJJTY" type="text/javascript"></script>-->
														<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAz0z6HkKMun0JLGq8sFTqEeWnfRuIkuY&callback=initialize" async defer></script>
														<!--<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiyzxLRNDMCMzlD0WTnX2qyPcU4oOJJTY&callback=initMap"
		async defer></script>-->

														<script type="text/javascript">
															var marker;

															function initialize() {
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

																addMarker(<?= (!empty($data[0]['latitude']) ? $data[0]['latitude'] : '-6.2022'); ?>, <?= (!empty($data[0]['latitude']) ? $data[0]['longitude'] : '106.8831'); ?>, "Posisi");
																// Proses membuat marker 
																function addMarker(lat, lng, info) {
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
																function bindInfoWindow(marker, peta, infoWindow, html) {
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
															#map {
																width: 100%;
																height: 340px;
																border: 5px solid #DEEBF2;
															}
														</style>
														<div id="map"></div>
														<!--	<div id="button-layer"><button id="btnAction" onClick="locate()">My Current Location</button></div>
	<div id="map"></div>
	<div id="tampil"></div>
<!--	<script type="text/javascript">
	var map;
	function initMap() {
		var mapLayer = document.getElementById("map-layer");
		var centerCoordinates = new google.maps.LatLng(<?= (!empty($data[0]['latitude']) ? $data[0]['latitude'] : ''); ?>, <?= (!empty($data[0]['latitude']) ? $data[0]['longitude'] : '106.8831'); ?>);
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

														<script type="text/javascript">


														</script>

													</div>
													<div style="clear:both;"></div>
												</div>


												<div class="form-group">
													<label class="col-sm-2 control-label"></label>
													<div class="col-sm-5">
														<!--<button id="btnAction" onClick="locate()">Get Location</button>-->
													</div>
													<div style="clear:both;"></div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">LATITUDE</label>
													<div class="col-sm-5">
														<input type="text" id="latitude" name="latitude" value="<?= $data[0]['latitude'] ?>" disabled class="form-control">
													</div>
													<div style="clear:both;"></div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">LONGITUDE</label>
													<div class="col-sm-5">
														<input type="text" id="longitude" name="longitude" value="<?= $data[0]['longitude'] ?>" disabled class="form-control">
													</div>
													<div style="clear:both;"></div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">NO TELEPON LABORATORIUM MEDIS</label>
													<div class="col-sm-5">
														<div class="input-group">
															<div class="input-group-addon">
																<i class="fa fa-phone"></i>
															</div>
															<input type="text" name="no_telp" value="<?= (empty($data[0]['no_telp']) ? $user[0]['no_hp'] : $data[0]['no_telp']) ?>" class="form-control" disabled autocomplete="off">
														</div>
													</div>
													<div style="clear:both;"></div>
													<!-- /.input group -->
												</div>



												<div class="form-group">
													<label class="col-sm-2 control-label">EMAIL LABORATORIUM MEDIS</label>
													<div class="col-sm-5">
														<input type="email" name="email" value="<?= (empty($data[0]['email']) ? $user[0]['email'] : $data[0]['email']) ?>" disabled class="form-control" autocomplete="off">
													</div>
													<div style="clear:both;"></div>
												</div>

												<?php
												if (empty($data[0]['upload_surat_permohonan_kode_lab_medis'])) {
													$auth_wajib_surat_izin = 'required';
												}
												?>


												<div class="form-group">
													<label class="col-sm-2 control-label">Link Drive Surat Permohonan Kode Laboratorium Medis</label>
													<div class="col-sm-5">
														<input type="upload_surat_permohonan_kode_lab_medis" name="upload_surat_permohonan_kode_lab_medis" value="<?= (empty($data[0]['upload_surat_permohonan_kode_lab_medis']) ? '' : $data[0]['upload_surat_permohonan_kode_lab_medis']) ?>" <?= $auth_wajib_surat_izin ?> class="form-control" autocomplete="off" disabled>
														<?php
														if (!empty($data[0]['upload_surat_permohonan_kode_lab_medis'])) {
															$url_upload_surat_permohonan_kode_lab_medis = $data[0]['upload_surat_permohonan_kode_lab_medis'];
															if (filter_var($url_upload_surat_permohonan_kode_lab_medis, FILTER_VALIDATE_URL) !== false) {
														?>
																<a href="<?= $url_upload_surat_permohonan_kode_lab_medis ?>" target="_blank"><?= $url_upload_surat_permohonan_kode_lab_medis ?></a>
															<?php
															} else {
															?>
																<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/' . $data[0]['upload_surat_permohonan_kode_lab_medis']);
																							?>"><?php echo $data[0]['upload_surat_permohonan_kode_lab_medis'];
																								?>
																</a>
														<?php
															}
														}
														?>

													</div>
													<div style="clear:both;"></div>
												</div>




												<!-- <div class="form-group"> -->
												<!-- <input type="file"  name="upload_surat_permohonan_kode_lab_medis"  id="upload_surat_permohonan_kode_lab_medis" <? //=$auth_wajib_surat_izin
																																									?> disabled> -->
												<!-- <a target="_blank" href="<?php //echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_surat_permohonan_kode_lab_medis']);
																				?>"><?php //echo $data[0]['upload_surat_permohonan_kode_lab_medis'];
																					?></a>			   -->
												<!-- <input type="hidden"  name="old_surat_permohonan_kode_lab_medis"  value="<? //=$data[0]['upload_surat_permohonan_kode_lab_medis']
																																?>" id="old_surat_permohonan_kode_lab_medis"> -->
												<!-- </div>/* Hanya File PDF Kurang Dari 2 MB -->
												<!-- <div style="clear:both;"></div> -->
												<!-- </div> -->

												<?php
												if (empty($data[0]['upload_surat_izin_operasional_lab_medis'])) {
													$auth_wajib_surat_izin_operasional = 'required';
												}
												?>

												<div class="form-group">
													<label class="col-sm-2 control-label">Link Drive Surat Izin Operasional Lab Medis</label>
													<div class="col-sm-5">
														<input type="upload_surat_izin_operasional_lab_medis" name="upload_surat_izin_operasional_lab_medis" value="<?= (empty($data[0]['upload_surat_izin_operasional_lab_medis']) ? '' : $data[0]['upload_surat_izin_operasional_lab_medis']) ?>" <?= $auth_wajib_surat_izin_operasional ?> class="form-control" autocomplete="off" disabled>
														<?php
														if (!empty($data[0]['upload_surat_izin_operasional_lab_medis'])) {
															$url_upload_surat_izin_operasional_lab_medis = $data[0]['upload_surat_izin_operasional_lab_medis'];
															if (filter_var($url_upload_surat_izin_operasional_lab_medis, FILTER_VALIDATE_URL) !== false) {
														?>
																<a href="<?= $url_upload_surat_izin_operasional_lab_medis ?>" target="_blank"><?= $url_upload_surat_izin_operasional_lab_medis ?></a>
															<?php
															} else {
															?>
																<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/' . $data[0]['upload_surat_izin_operasional_lab_medis']);
																							?>"><?php echo $data[0]['upload_surat_izin_operasional_lab_medis'];
																								?>
																</a>
														<?php
															}
														}
														?>
													</div>
													<div style="clear:both;"></div>
												</div>


												<!-- <div class="form-group">
													<label class="col-sm-2 control-label">Upload Surat Izin Operasional Lab Medis</label>
													<div class="col-sm-5"> -->
												<!-- <input type="file" name="upload_surat_izin_operasional_lab_medis" id="upload_surat_izin_operasional_lab_medis" <? //= $auth_wajib_surat_izin_operasional 
																																									?> disabled>
														<a target="_blank" href="<?php //echo base_url('assets/uploads/berkas_operasional/' . $data[0]['upload_surat_izin_operasional_lab_medis']); 
																					?>"><?php //echo $data[0]['upload_surat_izin_operasional_lab_medis']; 
																						?></a>
														<input type="hidden" name="old_surat_izin_operasional_lab_medis" value="<? //= $data[0]['upload_surat_izin_operasional_lab_medis'] 
																																?>" id="old_surat_izin_operasional_lab_medis">
													</div>/* Hanya File PDF Kurang Dari 2 MB
													<div style="clear:both;"></div> -->
												<!-- </div> -->

												<div class="form-group">
													<label class="col-sm-2 control-label">TANGGAL BERAKHIR IZIN OPERASIONAL</label>
													<div class="col-sm-5">


														<input type="text" name="tanggal_berakhir_izin_operasional" id="datepicker" value="<?= (!empty($data[0]['tanggal_berakhir_izin_operasional']) ? date('d-m-Y', strtotime($data[0]['tanggal_berakhir_izin_operasional'])) : '') ?>" class="form-control datepicker" disabled autocomplete="off">

													</div>
													<div style="clear:both;"></div>
													<!-- /.input group -->
												</div>


												<?php
												if (empty($data[0]['upload_visi_misi'])) {
													$auth_wajib_visi_misi = 'required';
												}
												?>


												<div class="form-group">
													<label class="col-sm-2 control-label">Link Drive Surat Visi & Misi</label>
													<div class="col-sm-5">
														<input type="upload_visi_misi" name="upload_visi_misi" value="<?= (empty($data[0]['upload_visi_misi']) ? '' : $data[0]['upload_visi_misi']) ?>" <?= $auth_wajib_visi_misi ?> class="form-control" autocomplete="off" disabled>
														<?php
														if (!empty($data[0]['upload_visi_misi'])) {
															$url_upload_visi_misi = $data[0]['upload_visi_misi'];
															if (filter_var($url_upload_visi_misi, FILTER_VALIDATE_URL) !== false) {
														?>
																<a href="<?= $url_upload_visi_misi ?>" target="_blank"><?= $url_upload_visi_misi ?></a>
															<?php
															} else {
															?>
																<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/' . $data[0]['upload_visi_misi']);
																							?>"><?php echo $data[0]['upload_visi_misi'];
																								?>
																</a>
														<?php
															}
														}
														?>
													</div>
													<div style="clear:both;"></div>
												</div>

												<!-- <div class="form-group">
													<label class="col-sm-2 control-label">Upload Visi Misi</label>
													<div class="col-sm-5">
														<input type="file" name="upload_visi_misi" id="upload_visi_misi" <? //= $auth_wajib_visi_misi 
																															?> disabled>
														<a target="_blank" href="<?php //echo base_url('assets/uploads/berkas_operasional/' . $data[0]['upload_visi_misi']); 
																					?>"><?php //echo $data[0]['upload_visi_misi']; 
																						?></a>
														<input type="hidden" name="old_visi_misi" value="<? //= $data[0]['upload_visi_misi'] 
																											?>" id="old_visi_misi">
													</div>/* Hanya File PDF Kurang Dari 2 MB
													<div style="clear:both;"></div>
												</div> -->


												<?php
												if (empty($data[0]['upload_struktur_organisasi'])) {
													$auth_wajib_struktur_organisasi = 'required';
												}
												?>

												<div class="form-group">
													<label class="col-sm-2 control-label">Link Drive Struktur Organisasi</label>
													<div class="col-sm-5">
														<input type="upload_struktur_organisasi" name="upload_struktur_organisasi" value="<?= (empty($data[0]['upload_struktur_organisasi']) ? '' : $data[0]['upload_struktur_organisasi']) ?>" <?= $auth_wajib_struktur_organisasi ?> class="form-control" autocomplete="off" disabled>
														<?php
														if (!empty($data[0]['upload_struktur_organisasi'])) {
															$url_upload_struktur_organisasi = $data[0]['upload_struktur_organisasi'];
															if (filter_var($url_upload_struktur_organisasi, FILTER_VALIDATE_URL) !== false) {
														?>
																<a href="<?= $url_upload_struktur_organisasi ?>" target="_blank"><?= $url_upload_struktur_organisasi ?></a>
															<?php
															} else {
															?>
																<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/' . $data[0]['upload_struktur_organisasi']);
																							?>"><?php echo $data[0]['upload_struktur_organisasi'];
																								?>
																</a>
														<?php
															}
														}
														?>
													</div>
													<div style="clear:both;"></div>
												</div>

												<!-- <div class="form-group">
													<label class="col-sm-2 control-label">Upload Struktur Organisasi</label>
													<div class="col-sm-5">
														<input type="file" name="upload_struktur_organisasi" id="upload_struktur_organisasi" <? //= $auth_wajib_visi_misi 
																																				?> disabled>
														<a target="_blank" href="<?php //echo base_url('assets/uploads/berkas_operasional/' . $data[0]['upload_struktur_organisasi']); 
																					?>"><?php //echo $data[0]['upload_struktur_organisasi']; 
																																															?></a>
														<input type="hidden" name="old_struktur_organisasi" value="<? //= $data[0]['upload_struktur_organisasi'] 
																													?>" id="old_struktur_organisasi">
													</div>/* Hanya File PDF Kurang Dari 2 MB
													<div style="clear:both;"></div>
												</div> -->



												<div class="form-group">
													<label class="col-sm-2 control-label">STATUS AKREDITASI</label>
													<div class="col-sm-5">
														<?= form_dropdown('status_akreditasi', dropdown_status_akreditasi(), $data[0]['status_akreditasi'], 'id="status_akreditasi" onchange="openshowstatusakreditasi(this.value)" class="form-control select2" disabled'); ?>
													</div>
													<div style="clear:both;"></div>
												</div>
												<?php
												if ($data[0]['status_akreditasi'] == 'Sudah') {
													$var_style_status_akreditasi = "block";
												} else {
													$var_style_status_akreditasi = "none";
												}
												?>

												<div class="form-group" id="tgl_sertifikat_akreditasi_html" style="display:<?= $var_style_status_akreditasi ?>">
													<label class="col-sm-2 control-label">TANGGAL BERAKHIR SERTIFIKAT AKREDITASI</label>
													<div class="col-sm-5">


														<input type="text" name="tanggal_berakhir_sertifikat_akreditasi" onchange="openshowrencanasurvey(this.value,<?= date('Ymd') ?>)" id="tanggal_berakhir_sertifikat_akreditasi" value="<?= (!empty($data[0]['tanggal_berakhir_sertifikat_akreditasi']) ? date('d-m-Y', strtotime($data[0]['tanggal_berakhir_sertifikat_akreditasi'])) : '') ?>" class="form-control datepicker" disabled autocomplete="off">

													</div>
													<div style="clear:both;"></div>
													<!-- /.input group -->
												</div>


												<?php
												if (empty($data[0]['upload_dokumen_sertifikat_dokumen']) && $data[0]['status_akreditasi'] == 'Sudah') {
													$auth_wajib_dokumen_sertifikat_dokumen = 'required';
												}
												?>

												<div class="form-group" id="dokumen_sertifikat_akreditasi_html" style="display:<?= $var_style_status_akreditasi ?>">
													<label class="col-sm-2 control-label">Upload Dokumen Sertifikat Dokumen</label>
													<div class="col-sm-5">
														<input type="file" name="upload_dokumen_sertifikat_dokumen" id="upload_dokumen_sertifikat_dokumen" <?= $auth_wajib_dokumen_sertifikat_dokumen ?> disabled>
														<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/' . $data[0]['upload_dokumen_sertifikat_dokumen']); ?>"><?php echo $data[0]['upload_dokumen_sertifikat_dokumen']; ?></a>
														<input type="hidden" name="old_dokumen_sertifikat_dokumen" value="<?= $data[0]['upload_dokumen_sertifikat_dokumen'] ?>" id="old_dokumen_sertifikat_dokumen">
													</div>/* Hanya File PDF Kurang Dari 2 MB
													<div style="clear:both;"></div>
												</div>


												<?php
												if ($data[0]['status_akreditasi'] == 'Belum') {
													$var_style_status_akreditasi = "block";
												} else if ($data[0]['status_akreditasi'] == 'Sudah' && date('Ymd', strtotime($data[0]['tanggal_berakhir_sertifikat_akreditasi'])) < date('Ymd')) {
													$var_style_status_akreditasi = "block";
												} else {
													$var_style_status_akreditasi = "none";
												}
												?>


												<div class="form-group" id="tgl_rencana_survey_html" style="display:<?= $var_style_status_akreditasi ?>">
													<label class="col-sm-2 control-label">Rencana Survey Akreditasi</label>
													<div class="col-sm-5">


														<input type="text" name="rencana_survey_akreditasi" id="rencana_survey_akreditasi" value="<?= (!empty($data[0]['rencana_survey_akreditasi']) ? date('d-m-Y', strtotime($data[0]['rencana_survey_akreditasi'])) : '') ?>" class="form-control datepicker" disabled autocomplete="off">

													</div>
													<div style="clear:both;"></div>
													<!-- /.input group -->
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">PELAYANAN TAMBAHAN</label>
													<div class="col-sm-5">
														<?php

														$bentuk_pelayanan = explode(",", $data[0]['bentuk_pelayanan']);

														foreach ($bentuk_pelayanan as $bentuk_pelayanan_val) {
															echo  $bentuk_pelayanan_val . '<br>';
														}
														?>
													</div>
													<div style="clear:both;"></div>
												</div>
												<div class="box-footer">
													<button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
												</div>

												</tbody>
												</table>
										</form>

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

	function myFunction(id, value) {
		alert(id);
		// Get the checkbox
		var checkBox = document.getElementById(value);
		// Get the output text

		// If the checkbox is checked, display the output text
		if (checkBox.checked == true) {
			document.getElementById("keterangan_" + value).disabled = false;

			// alert(checkBox.value);
		} else {
			document.getElementById("keterangan_" + value).disabled = true;

			// alert(0);
		}
	}


	$("#submit_nama_lab_validasi").click(function(e) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('dashboard/simpan_validasi/'); ?>",
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