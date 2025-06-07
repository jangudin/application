<?php
ini_set("memory_limit", "512M");
?>
<style>
  #scrollToTop,
  #scrollToBottom {
    cursor: pointer;
    background-color: #0090CB;
    display: inline-block;
    height: 40px;
    width: 40px;
    color: #fff;
    font-size: 16pt;
    text-align: center;
    text-decoration: none;
    line-height: 40px;
  }
</style>
<script type="text/javascript">
  $(function() {
    $('#scrollToBottom').bind("click", function() {
      $('html, body').animate({
        scrollTop: $(document).height()
      }, 1200);
      return false;
    });
    $('#scrollToTop').bind("click", function() {
      $('html, body').animate({
        scrollTop: 0
      }, 1200);
      return false;
    });
  });
</script>
<?php
$user_id = '';
?>
<!-- Main content -->
<section class="content">

  <div class="row">

    <!-- /.col -->
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="<?php echo base_url('dashboard/rekap_data/') . $user_id; ?>">Rekap Data Klinik</a></li>
          <li><a href="<?php echo base_url('dashboard/rekap_data_lab/') . $user_id; ?>">Rekap Data Lab/Bank Jaringan</a></li>
          <li><a href="<?php echo base_url('dashboard/monitoring_lab_all/') . $user_id; ?>">Monitoring Lab/Bank Jaringan</a></li>
          <li><a href="<?php echo base_url('dashboard/rekap_data_rs_all/') . $user_id; ?>">Rekap Data RS</a></li>
          <li><a href="<?php echo base_url('dashboard/monitoring_rs_all/') . $user_id; ?>">Monitoring RS</a></li>
          <li><a href="<?php echo base_url('dashboard/rekap_data_utd_all/') . $user_id; ?>">Rekap Data UTD</a></li>
          <li><a href="<?php echo base_url('dashboard/monitoring_utd_all/') . $user_id; ?>">Monitoring UTD</a></li>
          <li><a href="<?php echo base_url('dashboard/rekap_data_pm_all/') . $user_id; ?>">Rekap Data Praktik Mandiri</a></li>
          <li><a href="<?php echo base_url('dashboard/monitoring_pm_all/') . $user_id; ?>">Monitoring Praktik Mandiri</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <section class="content">

              <!-- row -->
              <div class="row">
                <div class="col-md-12">
                  <?php

                  ?>
                  <!-- The time line -->
                  <form class="form-horizontal well" role="form" method="post" action="">
                    <?php

                    if ($this->session->userdata('id_kategori') == 1 || $this->session->userdata('id_kategori') == 8 ||  $this->session->userdata('id_kategori') == 2 ||  $this->session->userdata('id_kategori') == 10) {
                    ?>

                      <div class="form-group">

                        <!--
		
		    <label class="col-sm-3 control-label">Tanggal Registrasi</label>
						<div class="col-sm-2">
                         <input type="text"  name="tgl1" id="tgl1" placeholder="Dari" value="<?php echo (isset($_POST['tgl1']) ? $_POST['tgl1'] : ''); ?>" autocomplete="off" class="form-control datepicker" />
						</div>	
					
				
						<div class="col-sm-2">
                         <input  type="text"   value="<?php echo (isset($_POST['tgl2']) ? $_POST['tgl2'] : ''); ?>" name="tgl2" id="tgl2" class="form-control datepicker" placeholder="Sampai">
						</div>
		-->
                      </div>
                      <?php
                      if ($this->session->userdata('id_kategori') == 1 || $this->session->userdata('id_kategori') == 8 ||  $this->session->userdata('id_kategori') == 10) {
                      ?>

                        <div class="form-group">
                          <label class="col-sm-2 control-label">PROVINSI </label>
                          <div class="col-sm-5">
                            <?= form_dropdown('id_prov', dropdown_propinsi(), (isset($_POST['id_prov']) ? $_POST['id_prov'] : ''), 'id="id_prov" class="form-control select2"'); ?>
                          </div>
                          <div style="clear:both;"></div>
                        </div>
                      <?php
                      }
                      ?>
                      <?php
                      if ($this->session->userdata('id_kategori') == 2) {
                      ?>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">KAB/KOTA</label>
                          <div class="col-sm-5">
                            <?= form_dropdown('id_kota', dropdown_kota($this->session->userdata('id_prov')), (isset($_POST['id_kota']) ? $_POST['id_kota'] : ''), 'id="id_kota" class="form-control select2"'); ?>
                          </div>
                          <div style="clear:both;"></div>
                        </div>
                      <?php
                      } else {
                      ?>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">KAB/KOTA</label>
                          <div class="col-sm-5">
                            <?= form_dropdown('id_kota', dropdown_kota((isset($_POST['id_prov']) ? $_POST['id_prov'] : '')), (isset($_POST['id_kota']) ? $_POST['id_kota'] : ''), 'id="id_kota" class="form-control select2"'); ?>
                          </div>
                          <div style="clear:both;"></div>
                        </div>
                      <?php
                      }
                      ?>


                    <?php
                    }
                    ?>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">JENIS KLINIK</label>
                      <div class="col-sm-5">
                        <?= form_dropdown('jenis_klinik', dropdown_jenis_klinik_all(), (isset($_POST['jenis_klinik']) ? $_POST['jenis_klinik'] : ''), 'id="jenis_klinik"  class="form-control select2"'); ?>

                      </div>
                      <div style="clear:both;"></div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">JENIS PELAYANAN</label>
                      <div class="col-sm-5">
                        <?= form_dropdown('jenis_perawatan', dropdown_jenis_perawatan_all(), (isset($_POST['jenis_perawatan']) ? $_POST['jenis_perawatan'] : ''), 'id="jenis_perawatan"  class="form-control select2"'); ?>

                      </div>
                      <div style="clear:both;"></div>
                    </div>

                    <!-- <div class="form-group">
				 <label  class="col-sm-2 control-label">PERSALINAN</label>
				  <div class="col-sm-5">
                 <?= form_dropdown('persalinan', dropdown_persalinan_all(), (isset($_POST['persalinan']) ? $_POST['persalinan'] : ''), 'id="persalinan" class="form-control select2"'); ?>
				  </div>
				  <div style="clear:both;"></div>
                </div> -->

                    <div class="form-group">
                      <label class="col-sm-2 control-label">PELAYANAN KLINIK</label>
                      <div class="col-sm-5">
                        <select class="form-control" id="layanan_klinik" name="layanan_klinik">
                          <option value="">Semua</option>
                          <option value="Pelayanan medik dasar">Pelayanan medik dasar</option>
                          <option value="Pelayanan medik spesialistik">Pelayanan medik spesialistik</option>
                          <option value="Pelayanan kesehatan gigi dan mulut">Pelayanan kesehatan gigi dan mulut</option>
                          <option value="Pelayanan persalinan">Pelayanan persalinan</option>
                          <option value="Pelayanan rehabilitasi medik dasar">Pelayanan rehabilitasi medik dasar</option>
                          <option value="Pelayanan rehabilitasi medik pecandu narkotika, psikotropika, dan zat adiktif lainnya">Pelayanan rehabilitasi medik pecandu narkotika, psikotropika, dan zat adiktif lainnya</option>
                          <option value="Pelayanan Gizi">Pelayanan Gizi</option>
                          <option value="Pelayanan laboratorium">Pelayanan laboratorium</option>
                          <option value="Pelayanan kefarmasian">Pelayanan kefarmasian</option>
                          <option value="Pelayanan radiologi">Pelayanan radiologi</option>
                          <option value="Pelayanan lainnya">Pelayanan lainnya</option>
                        </select>
                      </div>
                      <div style="clear:both;"></div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">SORTING</label>
                      <div class="col-sm-2">
                        <?= form_dropdown('sorting', array('kode_faskes' => 'Kode Faskes', 'tgl_buat_user' => 'Tanggal Registrasi', 'create_kode' => 'Tanggal Create Kode', 'nama_klinik' => 'Nama Faskes', 'jenis_klinik_terbaru' => 'Jenis Faskes', 'jenis_perawatan_terbaru' => 'Jenis Pelayanan', 'persalinan' => 'Persalinan', 'nama_kota' => 'Kab/Kota', 'nama_prop' => 'Provinsi', 'email_klinik' => 'Email'), (isset($_POST['sorting']) ? $_POST['sorting'] : ''), 'id="sorting" class="form-control select2"'); ?>
                      </div>
                      <div class="col-sm-2">
                        <?= form_dropdown('type_sorting', array('ASC' => 'ASC', 'DESC' => 'DESC'), (isset($_POST['type_sorting']) ? $_POST['type_sorting'] : ''), 'id="type_sorting" class="form-control select2"'); ?>
                      </div>
                      <div style="clear:both;"></div>
                    </div>


                    <div class="form-group">
                      <div class="col-sm-7" align="right">
                        <input class="btn btn-primary" type="submit" name="cari" value="Apply Filter">
                      </div>
                      <div style="clear:both;"></div>
                    </div>
                  </form>

                  <br>
                  <div align="right">
                    <a href="javascript:;" id="scrollToBottom">&#x25BC;</a>
                  </div>
                  <h3 class="page-header"><?php echo $title; ?></h3>
                  <div id="DivIdToPrint">
                    <form method="POST" action="" enctype="multipart/form-data">
                      <div id="dataklaim" style="overflow-x:auto;">
                        <table class="table-bordered table-condensed" id="tblExport" style="font-size:12px; margin:10 10 10 0px;" width="100%">
                          <tr>
                            <th><b>No</b></td>
                            <th><b>EMAIL</b></td>
                            <th><b>TELEPON</b></td>
                            <th><b>KODE KLINIK KMK 223</b></td>
                            <th><b>STATUS</b></td>
                            <th><b>NAMA KLINIK</b></td>
                            <th><b>JENIS KLINIK</b></td>
                            <th><b>JENIS PELAYANAN</b></td>
                            <th><b>TANGGAL REGISTRASI</b></td>
                            <th><b>ALAMAT</b></td>
                            <th><b>CAMAT</b></td>
                            <th><b>KAB/KOTA</b></td>
                            <th><b>PROPINSI</b></td>
                            <th><b>PEMILIK</b></td>
                            <th><b>NAMA PEMILIK</b></td>
                            <th><b>PENYELENGGARA</b></td>
                            <th><b>PELAKU USAHA</b></td>
                            <th><b>KERJASAMA BPJS</b></td>
                            <th><b>BERJEJARING PUSKESMAS</b></td>
                            <th><b>PROGRAM PRIORITAS</b></td>
                            <th><b>NAMA PUSKESMAS</b></td>
                            <th><b>KODE BPJS</b></td>
                            <th><b>AKREDITASI</b></td>
                            <th><b>Latitude</b></td>
                            <th><b>Longitude</b></td>
                            <th><b>Alamat Faskes Versi Akreditasi</b></td>
                            <th><b>Alamat Cleaning</b></td>
                            <th><b>Pelayanan Klinik</b></td>
                          </tr>
                          <?php
                          $no = 0;

                          foreach ($data['query'] as $key => $value) {
                            $no++;
                            if ($this->session->userdata('email') == 'farizal28@gmail.com') {
                              $kodef = ' /' . $value['kode_faskes'];
                            } else {
                              $kodef = '';
                            }
                          ?>
                            <tr>
                              <td align="left"><?= $no ?></td>
                              <td align="left">
                                <?php
                                // Memisahkan username dan domain
                                list($username, $domain) = explode('@', $value['email_klinik']);

                                // Masking username (hanya tampilkan 3 karakter pertama dan 2 karakter terakhir)
                                $username = substr($username, 0, 3) . str_repeat('*', max(0, strlen($username) - 5)) . substr($username, -2);

                                // Masking domain (tampilkan 2 karakter pertama dan 1 karakter terakhir)
                                list($domain_name, $extension) = explode('.', $domain);
                                $domain_name = substr($domain_name, 0, 2) . str_repeat('*', max(0, strlen($domain_name) - 3)) . substr($domain_name, -1);

                                echo $username . '@' . $domain_name . '.' . $extension

                                ?>
                                <? //=$value['email_klinik']
                                ?>
                              </td>
                              <td align="left">
                                <?php
                                $start = substr($value['no_telp'], 0, 3);
                                $end = substr($value['no_telp'], -3);

                                // Menyembunyikan bagian tengah dengan *
                                $masked = $start . str_repeat('*', strlen($value['no_telp']) - 6) . $end;

                                echo $masked
                                ?>
                                <? //= $value['no_telp'] 
                                ?>
                              </td>
                              <td align="left"><?= $value['kode_faskes_baru'] . $kodef; ?></td>
                              <td align="left"><?= $value['status_klinik'] ?></td>
                              <td align="left"><?= $value['nama_klinik'] ?></td>
                              <td align="left"><?= $value['jenis_klinik'] ?></td>
                              <td align="left"><?= $value['jenis_perawatan_terbaru'] ?></td>
                              <td align="left"><?= date('d/m/Y', strtotime($value['tgl_buat_user'])) ?></td>
                              <td align="left"><?= $value['alamat_faskes'] ?></td>
                              <td align="left"><?= $value['nama_camat'] ?></td>
                              <td align="left"><?= $value['nama_kota'] ?></td>
                              <td align="left"><?= $value['nama_prop'] ?></td>

                              <td align="left"><?= $value['pemilik'] ?></td>
                              <td align="left"><?= $value['nama_pemilik'] ?></td>
                              <td align="left"><?= $value['penyelenggara'] ?></td>
                              <td align="left"><?= $value['pelaku_usaha'] ?></td>
                              <td align="left"><?= $value['kerja_sama_bpjs_kesehatan'] ?></td>
                              <td align="left"><?= $value['berjejaring_dengan_puskesmas'] ?></td>
                              <td align="left"><?= $value['program_prioritas_nasional'] ?></td>
                              <td align="left"><?= $value['nama_puskesmas'] ?></td>
                              <td align="left"><?= $value['kode_bpjs'] ?></td>
                              <td align="left"><?= $value['akreditasi'] ?></td>
                              <td align="left">'<?= $value['latitude'] ?></td>
                              <td align="left">'<?= $value['longitude'] ?></td>

                              <td align="left"><?= $value['alamat_faskes_versi_akreditasi'] ?></td>
                              <td align="left"><?= $value['alamat_cleaning'] ?></td>
                              <td align="left"><?= $value['pelayanan_klinik'] ?></td>
                            </tr>
                          <?php
                          }
                          ?>
                        </table>


                        <!-- <input class="btn btn-primary" type="button" value="Laporan List Harian" /> -->
                    </form>
                  </div>
                </div>
                <a id="eks"><button class="btn btn-mini edit-btn"><span class="glyphicon glyphicon-file"></span> Excell</button> </a>
                <div align="right">
                  <a href="javascript:;" id="scrollToTop">&#x25B2;</a>
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
<script type="text/javascript">
  $("#eks").click(function() {

    var m_names = new Array("Januari", "Februari", "Maret",
      "April", "Mei", "Juni", "Juli", "Agustus", "September",
      "Oktober", "November", "Desember");

    var Name = 'Rekap-Data-';
    var d = new Date();
    var curr_date = d.getDate();
    var curr_month = d.getMonth();
    var curr_year = d.getFullYear();
    var blobURL = tableToExcel('tblExport');
    $(this).attr('download', Name + curr_date + "-" + m_names[curr_month] + "-" + curr_year + '.xls')
    $(this).attr('href', blobURL);
  });





  $(document).ready(function() {
    $('.select2').select2();

    $("#btnExport").click(function() {
      $("#toPrint").btechco_excelexport({
        containerid: "toPrint",
        datatype: $datatype.Table
      });
    });
    $("#externalCSS").click(function() {
      printElem({
        printMode: 'popup',
        overrideElementCSS: ['<?= base_url("assets/css/bootstrap.print.css"); ?>']
      });
    });


    $(".datepicker").datepicker({
      autoclose: true,
      dateformat: 'dd-mm-yy'
    });

    $('[name="id_prov"]').change(function() {
      $('#id_kota').val('');
      $('#id_camat').val('');
      $.ajax({
        url: "<?php echo site_url('dashboard/dropdown4') ?>/" + $(this).val(),
        dataType: "json",
        type: "GET",
        success: function(data) { //
          addOption($('[name="id_kota"]'), data, 'id_kota', 'nama_kota');
        }
      });


    });

    function addOption(ele, data, key, val) { //alert(data.length);
      $('option', ele).remove();

      ele.append(new Option('ALL', 9999));
      $(data).each(function(index) { //alert(eval('data[index].' + nama));
        ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));

      });
    }


  });
</script>