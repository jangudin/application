<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<!-- Main content -->
<section class="content">
  
<?php if(!empty($data3[0]['kode_faskes'])){ ?>
<?php }else{ ?>
<div class="alert alert-warning">Untuk menampilakan menu RME silahkan diisi terlebih dahulu Kontak SatuSehat</div>
<?php } ?>

  <div class="row">

    <!-- /.col -->
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <?php
        if ($this->session->flashdata('message_name') != null) {
        ?>
          <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> </button>
            <h4><i class="icon fa fa-<?= $this->session->flashdata('icon_name'); ?>"></i> Alert!</h4>
            <?= $this->session->flashdata('message_name'); ?>
          </div>
        <?php
        }
        ?>
        <ul class="nav nav-tabs">
          <?php
          if ($this->session->userdata('id_kategori_pm') == 4 || $this->session->userdata('id_kategori_pm') == 5) {


          ?>
            <li><a href="<?php echo base_url('pm/inputan_data_pm'); ?>">Registrasi</a></li>
            <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm'); ?>">Alkes</a></li>
            <li><a href="<?php echo base_url('pm/inputan_data_obat_pm'); ?>">Obat</a></li>
            <li><a href="<?php echo base_url('pm/inputan_data_gambar_pm'); ?>">Dokumentasi</a></li>
            <?php
            if (!empty($data[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323) {
            ?>
              <li ><a href="<?php echo base_url('pm/index_data_sisdmk'); ?>">List SDM</a></li>
              <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
              <li><a href="<?php echo base_url('pm/kontak_satu_sehat'); ?>">Kontak SATUSEHAT</a></li>
              <li><a href="<?php echo base_url('pm/satu_sehat'); ?>">Kode Akses API</a></li>
              <li><a href="<?php echo base_url('pm/pcare'); ?>">PCare</a></li>
              <li><a href="<?php echo base_url('pm/pic_faskes'); ?>">Penanggung Jawab Faskes</a></li>
            <?php
            } elseif(!empty($data[0]['kode_faskes'])) { ?>
              <li ><a href="<?php echo base_url('pm/index_data_sisdmk'); ?>">List SDM</a></li>
              <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
              <li ><a href="<?php echo base_url('pm/kontak_satu_sehat'); ?>">Kontak SATUSEHAT</a></li>
              <li ><a href="<?php echo base_url('pm/satu_sehat'); ?>">Kode Akses API</a></li>
              
              <li><a href="<?php echo base_url('pm/pic_faskes'); ?>">Penanggung Jawab Faskes</a></li>
            <?php }
            ?>
            <li class="active"><a href="<?php echo base_url('pm/selesaikan'); ?>">Print QR</a></li>
 <?php
          } elseif ($this->session->userdata('id_kategori_pm') == 6 || $this->session->userdata('id_kategori_pm') == 7) {


          ?>
            <li><a href="<?php echo base_url('pm/inputan_data_pm'); ?>">Registrasi</a></li>
            <!-- <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm'); ?>">Alkes</a></li> -->
            <li><a href="<?php echo base_url('pm/inputan_data_obat_pm'); ?>">Obat</a></li>
            <li><a href="<?php echo base_url('pm/inputan_data_gambar_pm'); ?>">Dokumentasi</a></li>
            <?php
            if (!empty($data[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323) {
            ?>
              <li ><a href="<?php echo base_url('pm/index_data_sisdmk'); ?>">List SDM</a></li>
              <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
              <li><a href="<?php echo base_url('pm/kontak_satu_sehat'); ?>">Kontak SATUSEHAT</a></li>
              <li><a href="<?php echo base_url('pm/satu_sehat'); ?>">Kode Akses API</a></li>
              <li><a href="<?php echo base_url('pm/pcare'); ?>">PCare</a></li>
              <li><a href="<?php echo base_url('pm/pic_faskes'); ?>">Penanggung Jawab Faskes</a></li>
            <?php
            } elseif(!empty($data[0]['kode_faskes'])) { ?>
              <li ><a href="<?php echo base_url('pm/index_data_sisdmk'); ?>">List SDM</a></li>
              <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
              <li ><a href="<?php echo base_url('pm/kontak_satu_sehat'); ?>">Kontak SATUSEHAT</a></li>
              <li ><a href="<?php echo base_url('pm/satu_sehat'); ?>">Kode Akses API</a></li>
              
              <li><a href="<?php echo base_url('pm/pic_faskes'); ?>">Penanggung Jawab Faskes</a></li>
            <?php }
            ?>

            <li class="active"><a href="<?php echo base_url('pm/selesaikan'); ?>">Print QR</a></li>
            
          <?php
          } else {
          ?>
            <li><a href="<?php echo base_url('pm/inputan_data_pm'); ?>">Data Dasar</a></li>
            <li><a href="<?php echo base_url('pm/inputan_data_sarpras_alkes_pm'); ?>">Data Bangunan & Sarpras</a></li>
            <li><a href="<?php echo base_url('pm/inputan_data_sdm'); ?>">Data SDM</a></li>
            <li class="active"><a href="<?php echo base_url('pm/selesaikan'); ?>">Final</a></li>
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
                    <form role="form" method="POST" action="" enctype='multipart/form-data' onsubmit="return confirm('Apakah Anda Yakin?');">
                      <table class="table table-bordered">
                        <tbody>
                          <?php
                          if (empty($data[0]['final'])) {
                          ?>
                            <tr>
                              <td><b>Apakah Data Yang Anda Masukan Sudah Benar Dan Ingin Mengirim Untuk Di Verifikasi?<br>Hasil Verifikasi Akan Di Kirimkan Ke Email.</b></td>
                              <td>
                                <input type="hidden" name="id_faskes" value="<?= $user_id ?>">
                                <input type="hidden" name="id_prov" value="<?= $user[0]['id_prov'] ?>">
                                <input type="hidden" name="id_kota" value="<?= $user[0]['id_kota'] ?>">
                                <input type="hidden" name="kode_regional" value="<?= !empty($getdatapm[0]['kode_regional']) ?>">

                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Kirim</button>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2"><!--<b>Kode Fasyankes Lama, Bila Ada :</b> --> <input type="hidden" name="kode_faskes_lama" value="<?= (!empty($data[0]['kode_faskes_lama']) ? $data[0]['kode_faskes_lama'] : '') ?>">
                              </td>
                            </tr>
                            <?php if (!empty($data[0]['catatan'])) { ?>
                              <tr>
                                <td colspan="2"><b>Catatan :</b> <?= $data[0]['catatan'] ?></td>
                              </tr>
                            <?php } ?>
                            <?php
                          } else {
                            if (!empty($data[0]['token_kode_faskes']) && empty($data[0]['kode_faskes'])) {
                            ?>
                              <tr>
                                <td>Link Aktifasi : <b><a onclick="return confirm('Apakah Anda Yakin?');" href="<?php echo base_url('dashboard/validate_kirim_email_kode_faskes/') . $data[0]['token_kode_faskes'] . '/' . $this->session->userdata('user_id') . '/' . $data[0]['id_link']; ?>">Kirim Email</a></b></td>
                                <td></td>
                              </tr>
                            <?php
                            } else if (!empty($data[0]['kode_faskes'])) {
                            ?>
                              <tr>
                                <td><b>Kode Faskes : </b></td>
                                <td><?= $data[0]['kode_faskes'] ?></td>
                              </tr>
                              <?php if($this->session->userdata('id_kategori_pm') == 6 || $this->session->userdata('id_kategori_pm') == 7){ ?>



                              <?php }else{ ?>
                                <tr>
                                <td><b>Print QR Code :</b></td>
                                <?php
                                if (empty($img) || empty($sisdmk) || empty($rme)) {
                                ?>
                                  <td>Silahkan upload gambar tampak depan dan cuci tangan, data SDM dan data RME terlebih dahulu</td>
                                <?php
                                } else {
                                ?>

                                  <?php
                                  if (empty($qr)) {
                                  ?>
                                    <td><a href="<?php echo base_url('pm/generateQR'); ?>" class="btn btn-success">Generate</a></td>
                                  <?php
                                  } else {
                                  ?>
                                    <td><a href="<?= base_url('/assets/uploads/QRAPI/'.$qr[0]['nama_dokumen'] ) ?>" class="btn btn-success" target=�_blank�>Lihat</a></td>
                                  <?php
                                  }
                                  ?>
                                <?php
                                }
                                ?>
                              </tr>

                              <tr>
                                <td><b>Laporan INM :</b></td>
                                <td>
                                  Silahkan melakukan update pelaporan INM
                                  </br>
                                  <a href="https://mutufasyankes.kemkes.go.id/" class="btn btn-primary" target=�_blank�>Link Aplikasi Mutu Fasyankes</a>
                                </td>
                              </tr>

                              <?php } ?>
                              
                              <!-- <?php
                                    if (!empty($qr)) {
                                    ?>
                                  <tr>
                                    <td><b>Tambah Usulan Akreditasi :</b></td>
                                    <td>
                                      <a href="https://registrasifasyankes.kemkes.go.id/pm/index_daftar_usulan" class="btn btn-primary" target=�_blank�>Tambah Usulan Akreditasi</a>
                                    </td>
                                  </tr>
                                <?php
                                                              }
                                ?> -->
                              
                            <?php
                            } else {
                            ?>
                              <tr>
                                <td><b>Data Sedang Di Verifikasi</b></td>
                                <td></td>
                              </tr>
                          <?php
                            }
                          }
                          ?>
                        </tbody>
                      </table>
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
    $("#datepicker").datepicker({
      autoclose: true
    });
  });

  $('[name="id_prov"]').change(function() {
    $('#id_kota').val('');
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

    ele.append(new Option('', 9999));
    $(data).each(function(index) { //alert(eval('data[index].' + nama));
      ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));

    });
  }

  $(document).ready(function() {
    //Cek NIK
    $("#nik").click(function() {

      if ($('#no_ktp').val() == null || $('#no_ktp').val() == "") {
        alert('Silahkan isi No KTP / NIK terlebih dahulu');

      } else {
        console.log('sedang di cek');
        var nik = $('#no_ktp').val();

        //alert (nik);
        $.ajax({
          type: 'GET',
          url: "<?php echo site_url('pm/alamatnik') ?>",
          data: "id=" + nik,
          dataType: 'json',
          cache: false,
          success: function(response) {
            if (response.status == 200) {
              alert('NIK telah terdaftar di SISDMK \natas nama ' +
                response.data.nama
              );
              console.log(response);
              window.location.href = 'https://registrasifasyankes.kemkes.go.id/pm/generateSisdmkByUser';
            } else {
              alert('NIK tidak terdaftar di SISDMK, silahkan update NIK di menu data dasar atau input data di SISDMK');
              console.log(response);
            }

          }
        });
      }

    });
  })
</script>