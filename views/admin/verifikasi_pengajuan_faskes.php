


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes/').$this->encrypt->encode($user_id);?>">Data Dasar</a></li>	  
			   <li><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_alkes/').$this->encrypt->encode($user_id);?>">Data Sarpras</a></li>
			   <li><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_sdm/').$this->encrypt->encode($user_id);?>">Data SDM</a></li>
			   <?php
				if($this->session->userdata('id_kategori') =='1'){
			   ?>
			   <li><a href="<?php echo base_url('dashboard/verifikasikan_kirim/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
			   <?php
			   }else if($this->session->userdata('id_kategori') =='3'){
			   ?>
			    <li><a href="<?php echo base_url('dashboard/verifikasikan_kirim/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
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
			 <td>NAMA KLINIK</td>
			 <td>:</td>
			 <td><input type="text" value="<?=$data[0]['nama_klinik']?>" name="nama_klinik" id="nama_klinik"></td>
			  <td>JENIS KLINIK</td>
			 <td>:</td>
			 <td>  <?=form_dropdown('jenis_klinik', dropdown_jenis_klinik(), $data[0]['jenis_klinik'],'id="jenis_klinik" required class="form-control select2"');?></td>
			 </tr>
			 
			  <tr>
			 <td>JENIS PELAYANAN</td>
			 <td>:</td>
			 <td> <?=form_dropdown('jenis_perawatan', dropdown_jenis_perawatan(), $data[0]['jenis_perawatan'],'id="jenis_perawatan" required class="form-control select2"');?></td>
			  <td>JENIS MODAL USAHA</td>
			 <td>:</td>
			 <td><?=$data[0]['jenis_modal_usaha']?></td>
			 </tr>
			 
			   <tr>
			 <td>KERJA SAMA DENGAN BPJS KESEHATAN</td>
			 <td>:</td>
			 <td>    <?=form_dropdown('kerja_sama_bpjs_kesehatan', array(''=>'','Tidak'=>'Tidak','Ya'=>'Ya'), $data[0]['kerja_sama_bpjs_kesehatan'],'id="kerja_sama_bpjs_kesehatan" class="form-control select2" disabled');?>
			</td>
			  <td>AKREDITASI</td>
			 <td>:</td>
			 <td>  <?=form_dropdown('akreditasi', array('Belum'=>'Belum','Sudah'=>'Sudah'), $data[0]['akreditasi'],'id="akreditasi" class="form-control select2" disabled');?></td>
			 </tr>
			 <?php
					if($data[0]['kerja_sama_bpjs_kesehatan']=='Ya'){
					
				?>
			  <tr>
			 <td>JUMLAH PESERTA</td>
			 <td>:</td>
			 <td> <input type="text" name="jumlah_peserta" value="<?=$data[0]['jumlah_peserta']?>"  class="form-control" disabled autocomplete="off" id="jumlah_peserta" >
			</td>
			  <td>RASIO DOKTER : PESERTA</td>
			 <td>:</td>
			 <td><input type="text" name="rasio_dokter_peserta" value="<?=$data[0]['rasio_dokter_peserta']?>"  class="form-control" disabled autocomplete="off" id="rasio_dokter_peserta" placeholder="Contoh 1 : 5.000" ></td>
			 </tr>
			  <tr>
			 <td>MENYELENGGARAKAN PROLANIS</td>
			 <td>:</td>
			 <td> <?=form_dropdown('menyelenggarakan_prolanis', array('Tidak'=>'Tidak','Ya'=>'Ya'), $data[0]['menyelenggarakan_prolanis'],'id="menyelenggarakan_prolanis" disabled class="form-control select2"');?>
			</td>
			  <td></td>
			 <td></td>
			 <td></td>
			 </tr>
			 <?php
					}else{
						
					}
			  
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
			 <tr>
			 <td>JENIS PELAYANAN</td>
			 <td>:</td>
			 <td><div id="pelayanan_pratama_html" style="display:<?=$var_style6?>">
				    <input disabled type="checkbox" <?=(in_array("Pelayanan medik dasar", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan medik dasar"  id="medik_dasar"> Pelayanan medik dasar<br>
					</div>
					 <div id="pelayanan_utama_html" style="display:<?=$var_style7?>">
					<input disabled type="checkbox" onchange="openshowmedik_spesialistik();"  <?=(in_array("Pelayanan medik spesialistik", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]"  value="Pelayanan medik spesialistik"  id="medik_spesialistik"> Pelayanan medik spesialistik  <div id="medik_spesialistik_html" style="display:<?=$var_style4?>"><input type="text" name="sebutkan_pelayanan_klinik_spesialistik" value="<?=$data[0]['sebutkan_pelayanan_klinik_spesialistik']?>"  class="form-control" autocomplete="off" id="sebutkan_pelayanan_klinik_spesialistik"  ></div><br>
					</div>
					<input disabled type="checkbox" <?=(in_array("Pelayanan kesehatan gigi dan mulut", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan kesehatan gigi dan mulut"  id="gigi_dan_mulut"> Pelayanan kesehatan gigi dan mulut<br>
					<input disabled type="checkbox" <?=(in_array("Pelayanan persalinan", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan persalinan"   id="persalinan"> Pelayanan persalinan<br>
					<div id="pelayanan_pratama_html_rehab" style="display:<?=$var_style6?>">
					<input disabled type="checkbox" <?=(in_array("Pelayanan rehabilitasi medik dasar", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan rehabilitasi medik dasar"   id="rehabilitasi"> Pelayanan rehabilitasi medik dasar<br>
					</div>
					<input disabled type="checkbox" <?=(in_array("Pelayanan rehabilitasi medik pecandu narkotika, psikotropika, dan zat adiktif lainnya", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan rehabilitasi medik pecandu narkotika, psikotropika, dan zat adiktif lainnya"   id="narkotika"> Pelayanan rehabilitasi medik pecandu narkotika, psikotropika, dan zat adiktif lainnya<br>
					<input disabled type="checkbox" <?=(in_array("Pelayanan Gizi", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan Gizi"   id="gizi"> Pelayanan Gizi<br>
					<input disabled type="checkbox" <?=(in_array("Pelayanan laboratorium", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan laboratorium"   id="lab"> Pelayanan laboratorium<br>
					<input disabled type="checkbox" <?=(in_array("Pelayanan kefarmasian", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan kefarmasian"   id="farmasi"> Pelayanan kefarmasian<br>
					<input disabled type="checkbox" <?=(in_array("Pelayanan radiologi", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan radiologi"   id="farmasi"> Pelayanan radiologi<br>
					<input disabled type="checkbox" onchange="openshowlainnya();" <?=(in_array("Pelayanan lainnya", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan lainnya"   id="lainnya"> Pelayanan lainnya(Sebutkan) <div id="lainnya_html" style="display:<?=$var_style5?>"><input type="text" name="sebutkan_pelayanan_klinik_lainnya" value="<?=$data[0]['sebutkan_pelayanan_klinik_lainnya']?>"  class="form-control" autocomplete="off" id="sebutkan_pelayanan_klinik_lainnya"  ></div></td>
			  <td>NAMA PENANGGUNG JAWAB KLINIK</td>
			 <td>:</td>
			 <td><?=$data[0]['nama_penanggung_jawab_klinik']?></td>
			 </tr>
			 
			  <tr>
			 <td>Pelaku Usaha</td>
			 <td>:</td>
			 <td><?=$data[0]['pemilik']?></td>
			  <td>Nama Pelaku Usaha</td>
			 <td>:</td>
			 <td><?=$data[0]['nama_pemilik']?></td>
			 </tr>
			  <tr>
			 <td>WAKTU LAYANAN DOKTER PER PASIEN</td>
			 <td>:</td>
			 <td><?=form_dropdown('waktu_layanan_dokter_per_pasien', array('<8 menit'=>'<8 menit','8 - 10 menit'=>'8 - 10 menit','>10 menit'=>'>10 menit'), $data[0]['waktu_layanan_dokter_per_pasien'],'id="waktu_layanan_dokter_per_pasien" disabled class="form-control select2"');?>
			</td>
			  <td></td>
			 <td></td>
			 <td></td>
			 </tr>
			  <tr>
			 <td>PROPINSI</td>
			 <td>:</td>
			 <td><?=form_dropdown('id_prov', dropdown_propinsi(), $data[0]['id_prov'],'id="id_prov" disabled class="form-control select2"');?></td>
			  <td>KAB/KOTA</td>
			 <td>:</td>
			 <td><?=form_dropdown('id_kota', dropdown_kota($data[0]['id_prov']), $data[0]['id_kota'],'id="id_kota" disabled class="form-control select2"');?></td>
			 </tr>
	
			  <tr>
			  <td>KECAMATAN</td>
			  <td>:</td>
			  <td><?=form_dropdown('id_camat', dropdown_kecamatan($data[0]['id_prov'],$data[0]['id_kota']), $data[0]['id_camat'],'id="id_camat" disabled class="form-control select2"');?></td>
			 
			 	<td>ALAMAT FASYANKES</td>
			 <td>:</td>
			 <td><?=$data[0]['alamat_faskes']?></td>
			 </tr>
			 
			   <tr>
			 <td>EMAIL</td>
			 <td>:</td>
			 <td><?=$data[0]['email']?></td>
			  <td>Upload Dokumen Perizinan Klinik</td>
			 <td>:</td>
			 <td><?=$data[0]['url_dokumen_operasional']?></td>
	   <!-- <td><a href="<?php // echo base_url('assets/uploads/berkas_operasional/'.$data[0]['operasional']);?>"><?php // echo $data[0]['operasional'];?></a></td> -->
	   </tr>
			 
			   <tr>
			  <td>TANGGAL BERAKHIR IZIN OPERASIONAL</td>
			 <td>:</td>
			 <td><input type="text" name="tanggal_berakhir_izin_operasional" id="datepicker" value="<?=(!empty($data[0]['tanggal_berakhir_izin_operasional']) ? date('d-m-Y',strtotime($data[0]['tanggal_berakhir_izin_operasional'])) : '')?>"  class="form-control datepicker" disabled autocomplete="off"  ></td>
			 <td></td>
			 <td></td>
			 <td></td>
			 </tr>
			 <tr>
			    <td>NO TELEPON</td>
			 <td>:</td>
			 <td><?=$data[0]['no_telp']?></td>
			 <td>PUSKESMAS PEMBINA WILAYAH</td>
			 <td>:</td>
			 <td><?=dropdown_puskesmas($data[0]['id_kota'])[$data[0]['id_wilayah']]?></td>
			  <td></td>
			 <td></td>
			 <td></td>
			 </tr>
			 <tr>
			<td>Berjejaring dengan Puskesmas</td>
			 <td>:</td>
			 <td><?=form_dropdown('berjejaring_dengan_puskesmas', array('Tidak'=>'Tidak','Ya'=>'Ya'), $data[0]['berjejaring_dengan_puskesmas'],'id="berjejaring_dengan_puskesmas" onchange="openshowberjejaring_dengan_puskesmas(this.value)" disabled class="form-control select2"');?></td>
			 <td></td>
			 <td></td>
			 <td></td>
			 </tr>
			 
			  <?php
			  if($data[0]['berjejaring_dengan_puskesmas']=='Ya'){
					
				 $program_prioritas_nasional=explode(',',$data[0]['program_prioritas_nasional']);
				  ?>
			 <tr>
			<td>Melaksanakan Pelayanan Program Prioritas Nasional</td>
			 <td>:</td>
			 <td>  <input disabled type="checkbox" <?=(in_array("TB", $program_prioritas_nasional) ? 'checked' : '') ?> name="program_prioritas_nasional[]" value="TB"  id="tb"> TB&nbsp;&nbsp;&nbsp;<input disabled type="checkbox"  <?=(in_array("Hipertensi", $program_prioritas_nasional) ? 'checked' : '') ?> name="program_prioritas_nasional[]" value="Hipertensi"  id="hipertensi"> Hipertensi&nbsp;&nbsp;&nbsp;<input type="checkbox" <?=(in_array("Diabetes Melitus", $program_prioritas_nasional) ? 'checked' : '') ?> name="program_prioritas_nasional[]" disabled value="Diabetes Melitus"  id="diabetes"> Diabetes Melitus&nbsp;&nbsp;&nbsp;<input disabled type="checkbox" <?=(in_array("Lainnya", $program_prioritas_nasional) ? 'checked' : '') ?> name="program_prioritas_nasional[]" value="Lainnya" onchange="openshowprogram_prioritas_nasional()"  id="prioritas_lainnya"> Lainnya</td>
			 <td></td>
			 <td></td>
			 <td></td>
			 </tr>
			<?php
			  }else{
				  
			  }
			?>
			
			 <?php
			if(in_array("Lainnya", $program_prioritas_nasional)){
					
				 $program_prioritas_nasional=explode(',',$data[0]['program_prioritas_nasional']);
				  ?>
			 <tr>
			<td>Melaksanakan Pelayanan Program Prioritas Nasional Lainnya</td>
			 <td>:</td>
			 <td><input type="text" disabled name="program_prioritas_nasional_lainnya" value="<?=$data[0]['program_prioritas_nasional_lainnya']?>"  class="form-control" autocomplete="off" id="program_prioritas_nasional_lainnya"  >
			 <td></td>
			 <td></td>
			 <td></td>
			 </tr>
			<?php
			  }else{
				  
			  }
			?>
			   <tr>
			    <td>Status Akreditasi Fasyankes</td>
			 <td>:</td>
			 <td><?=form_dropdown('akreditasi', array('Belum'=>'Belum','Sudah'=>'Sudah'), $data[0]['akreditasi'],'id="akreditasi" disabled class="form-control select2"');?></td>
			 <td>Tanggal Berakhir Dokumen Perizinan Klinik</td>
			 <td>:</td>
			 <td><input type="text"  name="tanggal_berakhir_izin_operasional" id="datepicker" value="<?=(!empty($data[0]['tanggal_berakhir_izin_operasional'] && $data[0]['tanggal_berakhir_izin_operasional'] !='1970-01-01') ? date('d-m-Y',strtotime($data[0]['tanggal_berakhir_izin_operasional'])) : '')?>"  class="form-control datepicker" disabled  autocomplete="off"  ></td>
			  <td></td>
			 <td></td>
			 <td></td>
			 </tr>
			 
			  <tr>
			 <td>UPLOAD SURAT PERMOHONAN REGISTRASI FASYANKES</td>
			 <td>:</td>
			 <td><?=$data[0]['url_dokumen_registrasi']?></td> 
			 <!-- <td><a href="<?php // echo base_url('assets/uploads/berkas_operasional/'.$data[0]['dokumen_registrasi']);?>"><?php // echo $data[0]['dokumen_registrasi'];?></a></td> -->
			 
			  <td>Upload Dokumen Akreditasi Fasyankes</td>
			 <td>:</td>
			 <td><?=$data[0]['url_dokumen_penanaman_modal_asing']?></td> 
			<!-- <td><a href="<?php // echo base_url('assets/uploads/berkas_operasional/'.$data[0]['bukti_penanaman_modal_asing']);?>"><?php // echo $data[0]['bukti_penanaman_modal_asing'];?></a></td> -->
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
<style type="text/css">
#map {width:100%; height:340px; border:5px solid #DEEBF2;}
</style>
				<div id="map"></div>
           <div style="clear:both;"></div>  
			</td>	
	
			<tr>
			<td >
			 <div class="box-footer">
			 <input type="hidden" name="id_faskes" id="id_faskes"  value="<?=$user_id;?>">
                <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button>
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
 
				