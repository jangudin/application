


<!-- Main content -->
<section class="content">

	<div class="row">
	
	<!-- /.col -->
	<div class="col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes/').$user_id;?>">Data Dasar</a></li>	  
				<?php
					if ($data[0]['id_kategori']==4 || $data[0]['id_kategori']==5){
				?>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_alkes_new/').$user_id;?>">Data Alkes</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_obat/').$user_id;?>">Data Obat</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_gambar/').$user_id;?>">Data Dokumen</a></li>
				<?php }elseif($data[0]['id_kategori']==6 || $data[0]['id_kategori']==7 ){ ?>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_obat/').$user_id;?>">Data Obat</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_gambar/').$user_id;?>">Data Dokumen</a></li>
				<?php
					} else {
				?>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_alkes/').$user_id;?>">Data Sarpras & Alkes</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_sdm/').$user_id;?>">Data SDM</a></li>
				<?php
					}
				?>
				<?php
				if($this->session->userdata('id_kategori') =='1'){
				?>
				<li><a href="<?php echo base_url('pm/verifikasikan_kirim/').$user_id;?>">Verifikasikan</a></li>
				<?php
				}else if($this->session->userdata('id_kategori') =='3'){
				?>
				<li><a href="<?php echo base_url('pm/verifikasikan_kirim/').$user_id;?>">Verifikasikan</a></li>
				<?php
				}
				?>

			</ul>
		<div class="tab-content">
			<div class="active tab-pane" id="activity">
			<div class="box-body">
								<div class="box-body table-responsive no-padding">

			<form role="form" method="POST" action="" enctype='multipart/form-data'>
		<table class="table table-bordered">
		<tbody> 
			
		<tr>
		<td>NAMA PRAKTIK MANDIRI</td>
		<td>:</td>
		<!-- <td><input class="form-control" type="text" value="<?=$data[0]['nama_pm']?>" name="nama_pm" id="nama_pm"></td> -->
		<td><?=$data[0]['nama_pm']?> </td>
			<td>JENIS PRAKTIK MANDIRI</td>
		<td>:</td>
		<td>  <?=form_dropdown('id_kategori', dropdown_kategori_pm(), $data[0]['id_kategori'],'id="id_kategori" required class="form-control select2" disabled');?></td>
		</tr>
		
			<tr>
		<td>KERJA SAMA DENGAN BPJS KESEHATAN</td>
		<td>:</td>
		<td>    <?=form_dropdown('kerja_sama_bpjs_kesehatan', array('Tidak'=>'Tidak','Ya'=>'Ya','Berjejaring dengan FKTP'=>'Berjejaring dengan FKTP'),(!empty($data[0]['kerja_sama_bpjs_kesehatan']) ? $data[0]['kerja_sama_bpjs_kesehatan'] : ''),'id="kerja_sama_bpjs_kesehatan" class="form-control select2" disabled');?>
		</td>
			<td>BERJEJARING DENGAN FKTP</td>
		<td>:</td>
		<td><?=$data[0]['berjejaring_fktp']?> </td>
		</tr>
		
		<tr>
		<td>NOMOR SURAT IZIN PRAKTIK</td>
		<td>:</td>
		<td><?=$data[0]['no_sip']?> </td>
		<td>UPLOAD SURAT IZIN PRAKTIK</td>
		<td>:</td>
		<td>
		<!-- <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_sip/'.(!empty($data[0]['dokumen_sip']) ? $data[0]['dokumen_sip'] : ''));?>">
						<?php echo (!empty($data[0]['dokumen_sip']) ? $data[0]['dokumen_sip'] : '')?>
				</a>		 -->
				<?php $url = filter_var($data[0]['dokumen_sip'], FILTER_SANITIZE_URL);

                  // Validate url
                    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                    ?>
                    	<a href="<?= $data[0]['dokumen_sip'] ?>" target="_blank"><?= $data[0]['dokumen_sip'] ?></a>
                    <?php
                    } else {
                    ?>
                    	<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_sip/'.(!empty($data[0]['dokumen_sip']) ? $data[0]['dokumen_sip'] : ''));?>">
							<?php echo (!empty($data[0]['dokumen_sip']) ? $data[0]['dokumen_sip'] : '')?>
						</a>
                    <?php
                    }
                    ?>
		</td>
		</tr>

		<tr>
		<td>SIP KE BERAPA</td>
		<td>:</td>
		<td>   
		<?=form_dropdown('sip_ke_berapa', dropdown_sip_ke_brp(), (!empty($data[0]['sip_ke_berapa']) ? $data[0]['sip_ke_berapa'] : '1'),'id="sip_ke_berapa"  required class="form-control select2" disabled');?> 
		</td>
			<td>TANGGAL BERAKHIR SIP</td>
		<td>:</td>
		<td><?=$data[0]['tgl_berakhir_sip']?> </td>
		</tr>
		

		<tr>
		<td>NOMOR SURAT TANDA REGISTRASI (STR)</td>
		<td>:</td>
		<td><?=$data[0]['no_str']?> </td>
		<td>UPLOAD SURAT TANDA REGISTRASI (STR)</td>
		<td>:</td>
		<td>
		<!-- <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_str/'.(!empty($data[0]['dokumen_str']) ? $data[0]['dokumen_str'] : ''));?>">
						<?php echo (!empty($data[0]['dokumen_str']) ? $data[0]['dokumen_str'] : '')?>
				</a>	 -->
				
				<?php $url = filter_var($data[0]['dokumen_str'], FILTER_SANITIZE_URL);

                  // Validate url
                    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                    ?>
                    	<a href="<?= $data[0]['dokumen_str'] ?>" target="_blank"><?= $data[0]['dokumen_str'] ?></a>
                    <?php
                    } else {
                    ?>
                    	<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_str/'.(!empty($data[0]['dokumen_str']) ? $data[0]['dokumen_str'] : ''));?>">
							<?php echo (!empty($data[0]['dokumen_str']) ? $data[0]['dokumen_str'] : '')?>
						</a>
                    <?php
                    }
                    ?>
		</td>
		</tr>

		<tr>
			<td>TANGGAL BERAKHIR STR</td>
		<td>:</td>
		<td><?=$data[0]['tgl_berakhir_str']?> </td>
		<td>UPLOAD SURAT PERMOHONAN REGISTRASI FASYANKES</td>
		<td>:</td>
		<td>
			<!-- <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_registrasi/'.(!empty($data[0]['dokumen_registrasi']) ? $data[0]['dokumen_registrasi'] : ''));?>">
				<?php echo (!empty($data[0]['dokumen_registrasi']) ? $data[0]['dokumen_registrasi'] : '') ?>
					</a>		 -->
		

					<?php $url = filter_var($data[0]['dokumen_registrasi'], FILTER_SANITIZE_URL);

                  // Validate url
                    if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
                    ?>
                    	<a href="<?= $data[0]['dokumen_registrasi'] ?>" target="_blank"><?= $data[0]['dokumen_registrasi'] ?></a>
                    <?php
                    } else {
                    ?>
                    	<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_registrasi/'.(!empty($data[0]['dokumen_registrasi']) ? $data[0]['dokumen_registrasi'] : ''));?>">
							<?php echo (!empty($data[0]['dokumen_registrasi']) ? $data[0]['dokumen_registrasi'] : '')?>
						</a>
                    <?php
                    }
                    ?>
		</td>
		</tr>
		
			<tr>
		<td>PROPINSI</td>
		<td>:</td>
		<td><?=form_dropdown('id_prov_pm', dropdown_propinsi(), $data[0]['id_prov_pm'],'id="id_prov_pm" disabled class="form-control select2"');?></td>
			<td>KAB/KOTA</td>
		<td>:</td>
		<td><?=form_dropdown('id_kota_pm', dropdown_kota($data[0]['id_prov_pm']), $data[0]['id_kota_pm'],'id="id_kota_pm" disabled class="form-control select2"');?></td>
		</tr>

			<tr>
			<td>KECAMATAN</td>
			<td>:</td>
			<td><?=form_dropdown('id_camat_pm', dropdown_kecamatan($data[0]['id_prov_pm'],$data[0]['id_kota_pm']), $data[0]['id_camat_pm'],'id="id_camat_pm" disabled class="form-control select2"');?></td>
		
			<td>ALAMAT FASYANKES</td>
		<td>:</td>
		<td><?=$data[0]['alamat_faskes']?></td>
		</tr>

		<tr>
			<td>NO TELEPON</td>
		<td>:</td>
		<td><?=$data[0]['no_telp']?></td>
		<td>NO PONSEL</td>
		<td>:</td>
		<td><?=$data[0]['no_hp']?></td>
		</tr>
		
			<tr>
		<td>EMAIL</td>
		<td>:</td>
		<td><?=$data[0]['email']?></td>
		<td>KEPEMILIKAN TEMPAT PRAKTIK</td>
		<td>:</td>
		<td>
		<?=form_dropdown('kepemilikan_tempat', dropdown_kepemilikan_tempat(), (!empty($data[0]['kepemilikan_tempat']) ? $data[0]['kepemilikan_tempat'] : '1'),'id="kepemilikan_tempat"  required class="form-control select2" disabled');?> 
		</td>
		</tr>

		<!-- <tr>
		<td>Cek NIK</td>
		<td>:</td>
		<td><?=$data[0]['cek_nik']?>  </td>
		<td>Cek Nama di SISDMK</td>
		<td>:</td>
		<td><?=$data[0]['cek_nama_pm']?> </td>
		</tr>

		<tr>
		<td>Cek No SIP di SISDMK</td>
		<td>:</td>
		<td><?=$data[0]['cek_no_sip']?> </td>
		<td>Cek Tanggal Berakhir SIP di SISDMK</td>
		<td>:</td>
		<td><?=$data[0]['cek_tgl_berakhir_sip']?> </td>
		</tr>

		<tr>
		<td>Cek No STR di SISDMK</td>
		<td>:</td>
		<td><?=$data[0]['cek_no_str']?> </td>
		<td>Cek Tanggal Berakhir STR di SISDMK</td>
		<td>:</td>
		<td><?=$data[0]['cek_tgl_berakhir_str']?> </td>
		</tr> -->

		<tr>
		<td>NOMOR KTP</td>
		<td>:</td>
		<td><?=$data[0]['no_ktp']?> </td>
		<td>JAM PRAKTIK SENIN</td>
		<td>:</td>
		<td>Pagi (<?=$data[0]['jam_praktik_senin_pagi']?>) dan Sore (<?=$data[0]['jam_praktik_senin_sore']?>)  </td>
		</tr>

		<tr>
		<td>JAM PRAKTIK SELASA</td>
		<td>:</td>
		<td>Pagi (<?=$data[0]['jam_praktik_selasa_pagi']?>) dan Sore (<?=$data[0]['jam_praktik_selasa_sore']?>)  </td>
		<td>JAM PRAKTIK RABU</td>
		<td>:</td>
		<td>Pagi (<?=$data[0]['jam_praktik_rabu_pagi']?>) dan Sore (<?=$data[0]['jam_praktik_rabu_sore']?>)  </td>
		</tr>

		<tr>
		<td>JAM PRAKTIK KAMIS</td>
		<td>:</td>
		<td>Pagi (<?=$data[0]['jam_praktik_kamis_pagi']?>) dan Sore (<?=$data[0]['jam_praktik_kamis_sore']?>)  </td>
		<td>JAM PRAKTIK JUMAT</td>
		<td>:</td>
		<td>Pagi (<?=$data[0]['jam_praktik_jumat_pagi']?>) dan Sore (<?=$data[0]['jam_praktik_jumat_sore']?>)  </td>
		</tr>

		<tr>
		<td>JAM PRAKTIK SABTU</td>
		<td>:</td>
		<td>Pagi (<?=$data[0]['jam_praktik_sabtu_pagi']?>) dan Sore (<?=$data[0]['jam_praktik_sabtu_sore']?>)  </td>
		<td>JAM PRAKTIK MINGGU</td>
		<td>:</td>
		<td>Pagi (<?=$data[0]['jam_praktik_minggu_pagi']?>) dan Sore (<?=$data[0]['jam_praktik_minggu_sore']?>)  </td>
		</tr>

		
			<tr>
			<td>PUSKESMAS PEMBINA WILAYAH</td>
		<td>:</td>
		<td><?=form_dropdown('puskesmas_pembina', dropdown_puskesmas($data[0]['id_kota_pm']),  $data[0]['puskesmas_pembina'] ,'id="puskesmas_pembina" class="form-control select2" disabled');?></td>
		<td>Berjejaring dengan PUSKESMAS</td>
		<td>:</td>
		<td><?=form_dropdown('berjejaring_puskesmas',  array('Tidak'=>'Tidak','Ya'=>'Ya'),  (!empty($data[0]['berjejaring_puskesmas']) ? $data[0]['berjejaring_puskesmas'] : '') ,'id="berjejaring_puskesmas" class="form-control select2" disabled');?></td>
		</tr>
		
			<tr>
		<td>LATITUDE</td>
		<td>:</td>
		<td><?=$data[0]['latitude']?></td>
		
			<td>LONGITUDE</td>
		<td>:</td>
		<td><?=$data[0]['longitude']?></td>
		</tr>
		
			<tr> 
			<td>LETAK GEOGRAFIS</td>
			<td>:</td>
			<td colspan="4">
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG362vpRf1YZbpR-fiUOOeWJ-dHbtBDxg&callback=initialize" async defer></script>					
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
	#map {width:100%; height:340px; border:5px solid #DEEBF2;}
	</style>
			<div id="map"></div>
		<div style="clear:both;"></div>  
		</td>
		
		<tr>
		<td>Kewenangan Tambahan</td>
		<td>:</td>
		<td>
			<?php
				if(!empty($data[0]['kewenangan_tambahan'])){
			?>
			<?=form_dropdown('kewenangan_tambahan',  array('Akupuntur'=>'Akupuntur','Estetika'=>'Estetika','Komplementer'=>'Komplementer','Akupresur'=>'Akupresur','Herbal'=>'Herbal','Lainnya'=>'Lainnya'),  (!empty($data[0]['kewenangan_tambahan']) ? $data[0]['kewenangan_tambahan'] : '') ,'id="kewenangan_tambahan" class="form-control select2" disabled ');?>
			<?php
				}
			?>
		</td>
		<td>Kewenangan Tambahan Lainnya</td>
		<td>:</td>
		<td><?=$data[0]['kewenangan_tambahan_lainnya'];?>  </td>
		</tr>

		<tr>
		<td>Dokumen Kewenangan Tambahan</td>
		<td>:</td>
		<td>
		<a target="_blank" href="<?php echo base_url('assets/uploads/berkas_kewenangan/'.(!empty($data[0]['dokumen_kewenangan']) ? $data[0]['dokumen_kewenangan'] : ''));?>">
		</td>
		<td></td>
		<td></td>
		<td> </td>
		</tr>

		<tr>
		<td>Pelatihan yang mendukung program prioritas nasional yang diikuti dokter</td>
		<td>:</td>
		<td><?=$data[0]['pelatihan_program_prioritas']?></td>
		
			<td>Pelatihan Program Prioritas Lainnya</td>
		<td>:</td>
		<td><?=$data[0]['pelatihan_program_prioritas_lainnya']?></td>
		</tr>

		<tr>
		<td>Mendukung program prioritas nasional</td>
		<td>:</td>
		<td><?=$data[0]['program_prioritas']?></td>
		
			<td>Mendukung program prioritas nasional lainnya</td>
		<td>:</td>
		<td><?=$data[0]['program_prioritas_lainnya']?></td>
		</tr>

		<tr>
		<td>Pelayanan yang diberikan</td>
		<td>:</td>
		<td><?=$data[0]['pelayanan_yang_diberikan']?></td>
		
			<td>Nama Spesialistik</td>
		<td>:</td>
		<td><?=$data[0]['pelayanan_yang_diberikan_lainnya']?></td>
		</tr>

		<tr>
		<td >
		<div class="box-footer">
		<input type="hidden" name="id_faskes" id="id_faskes"  value="<?=$user_id;?>">
			<!-- <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button> -->
			</div>
			</td>	
		</tr>
		</tbody>
		</table>
									</form>   
								</div>
							</div>
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