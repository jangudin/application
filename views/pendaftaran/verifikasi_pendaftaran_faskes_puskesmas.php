<div class="col-xs-12 col-sm-12">
  <div class="box">
    <div class="box-content">

<section class="content">
    <?php
	$jenis_kelamin=array("L"=>"Laki-laki","P"=>"Perempuan");
	$status_validasi=array("0"=>"Belum Di Validasi","1"=>"Sudah Di Kirim Email","2"=>"Sudah Di Validasi");
    $status_validasi_dfo=array("0"=>"Belum Di Validasi","1"=>"Aktif","2"=>"Tidak Aktif");
	?>
 <div class="box">
            <div class="box-header">
              <h2 class="box-title">VERIFIKASI PENDAFTARAN FASYANKES</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tbody>
                <tr>
                  <td>EMAIL</td>
                  <td>:</td>
                  <td><?=$data[0]['email']?></td>
                  <td>NAMA LENGKAP</td>
				  <td>:</td>
                  <td><?=$data[0]['nama_lengkap']?></td>
                </tr>
				<tr>
                  <td>NO KTP</td>
                  <td>:</td>
                  <td><?=$data[0]['no_ktp']?></td>
                  <td>NO HANDPHONE</td>
				  <td>:</td>
                  <td><?=$data[0]['no_hp']?></td>
                </tr>
				<tr>
                  <td>TEMPAT LAHIR</td>
                  <td>:</td>
                  <td><?=$data[0]['tempat_lahir']?></td>
                  <td>TANGGAL LAHIR</td>
				  <td>:</td>
                  <td><?=date('d/m/Y',strtotime($data[0]['tgl_lahir']))?></td>
                </tr>
				<tr>
                  <td>PROVINSI</td>
                  <td>:</td>
                  <td><?=$data[0]['nama_prop']?></td>
                  <td>KABUPATEN/KOTA</td>
				  <td>:</td>
                  <td><?=$data[0]['nama_kota']?></td>
                </tr>
               <tr>
                  <td>ALAMAT</td>
                  <td>:</td>
                  <td><?=$data[0]['alamat']?></td>
                  <td>JENIS KELAMIN</td>
				  <td>:</td>
                  <td><?=$jenis_kelamin[$data[0]['jenis_kelamin']]?></td>
                </tr>
				  <tr>
                  <td>KATEGORI</td>
                  <td>:</td>
                  <td><?=$data[0]['kategori_user']?></td>
                  <td>KETERANGAN KATEGORI</td>
				  <td>:</td>
                  <td><?=$data[0]['keterangan']?></td>
                </tr>
				  <tr>
                  <td>JABATAN</td>
                  <td>:</td>
                  <td><?=$data[0]['jabatan']?></td>
                  <td>WAKTU DAFTAR</td>
				  <td>:</td>
                  <td><?=date('d-m-Y H:i:s',strtotime($data[0]['tgl_buat_user']))?></td>
                </tr>
				  <tr>
                  <td>STATUS VALIDASI</td>
                  <td>:</td>
                  <td><?=$status_validasi[$data[0]['validate']]?></td>
                  <td>TOKEN</td>
				  <td>:</td>
                  <td><?=$data[0]['token']?></td>
                </tr>
				  <tr>
                  <td>NAMA FASYANKES</td>
                  <td>:</td>
                  <td>Puskesmas <?=$data[0]['nama_fasyankes']?></td>
                  <td>STATUS DFO</td>
				  <td>:</td>
                  <td><?=$status_validasi_dfo[$data[0]['user_status']]?></td>
                </tr>
              </tbody></table>
			  <?php
			  if($data[0]['validate']==0){
			  ?>
			  <a onclick="return confirm('Yakin Di Kirim Email?')" href="<?=site_url('dashboard/validate_kirim_email/'.$data[0]['id']);?>"><button type="button" class="btn btn-block btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Aktivasi User, Tanpa Kirim Email Aktivasi</button></a>
			  <?php
			  }else if($data[0]['validate']==1){
			  ?>
			  <a onclick="return confirm('Yakin Di Kirim Email?')" href="<?=site_url('dashboard/validate_kirim_email/'.$data[0]['id']);?>"><button type="button" class="btn btn-block btn-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Aktivasi User, Tanpa Kirim Email Aktivasi</button></a>
			  <?php
			  }
			  ?>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#tanggal').datepicker({"format": "dd-mm-yyyy",  "autohide": true});
  
</script>


