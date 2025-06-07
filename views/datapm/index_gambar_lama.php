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
               <?php if ($this->session->userdata('id_kategori_pm') == 4 || $this->session->userdata('id_kategori_pm') == 5 ) {

?>
                
                    <li><a href="<?php echo base_url('pm/inputan_data_pm'); ?>">Registrasi</a></li>
                    <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm'); ?>">Alkes</a></li>
                    <li><a href="<?php echo base_url('pm/inputan_data_obat_pm'); ?>">Obat</a></li>


                    <li class="active"><a href="<?php echo base_url('pm/inputan_data_gambar_pm'); ?>">Dokumentasi</a></li>
                    <?php
                    if (!empty($data2[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323) {
                    ?>
                        <li><a href="<?php echo base_url('pm/index_data_sisdmk'); ?>">List SDM</a></li>
                        <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li><a href="<?php echo base_url('pm/kontak_satu_sehat'); ?>">Kontak SATUSEHAT</a></li>
                        <li><a href="<?php echo base_url('pm/satu_sehat'); ?>">Kode Akses API</a></li>
                        <li><a href="<?php echo base_url('pm/pcare'); ?>">PCare</a></li>
                        <li><a href="<?php echo base_url('pm/pic_faskes'); ?>">Penanggung Jawab Faskes</a></li>
                    <?php
                    } elseif(!empty($data2[0]['kode_faskes']))  { ?>
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
<li><a href="<?php echo base_url('pm/selesaikan'); ?>">Print QR</a></li>
<?php } elseif ($this->session->userdata('id_kategori_pm') == 6 || $this->session->userdata('id_kategori_pm') == 7) {

?>
                
                    <li><a href="<?php echo base_url('pm/inputan_data_pm'); ?>">Registrasi</a></li>
                    <!-- <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm'); ?>">Alkes</a></li> -->
                    <li><a href="<?php echo base_url('pm/inputan_data_obat_pm'); ?>">Obat</a></li>


                    <li class="active"><a href="<?php echo base_url('pm/inputan_data_gambar_pm'); ?>">Dokumentasi</a></li>
                    <?php
                    if (!empty($data2[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323) {
                    ?>
                        <li><a href="<?php echo base_url('pm/index_data_sisdmk'); ?>">List SDM</a></li>
                        <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li><a href="<?php echo base_url('pm/kontak_satu_sehat'); ?>">Kontak SATUSEHAT</a></li>
                        <li><a href="<?php echo base_url('pm/satu_sehat'); ?>">Kode Akses API</a></li>
                        <li><a href="<?php echo base_url('pm/pcare'); ?>">PCare</a></li>
                        <li><a href="<?php echo base_url('pm/pic_faskes'); ?>">Penanggung Jawab Faskes</a></li>
                    <?php
                    } elseif(!empty($data2[0]['kode_faskes']))  { ?>
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

<li><a href="<?php echo base_url('pm/selesaikan'); ?>">Print QR</a></li>

<?php } ?>

                  
                </ul>
                <?php
                $count_obat = 0;
                $obat1 = 0;
                $obat2 = 0;
                $obat3 = 0;
                $obat4 = 0;
                $obat5 = 0;
                $obat6 = 0;
                $obat7 = 0;
                $obat8 = 0;
                $obat9 = 0;
                $obat10 = 0;
                $obat11 = 0;
                $obat12 = 0;
                $obat13 = 0;
                $obat14 = 0;
                $obat15 = 0;
                $obat16 = 0;
                $obat17 = 0;
                $obat18 = 0;

                foreach ($obat as $key => $value) {
                    // var_dump($value);
                    if ($value['id_obat'] == 1) {
                        if ($obat1 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 2) {
                        if ($obat2 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 3) {
                        if ($obat3 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 4) {
                        if ($obat4 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 5) {
                        if ($obat5 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 6) {
                        if ($obat6 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 7) {
                        if ($obat7 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 8) {
                        if ($obat8 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 9) {
                        if ($obat9 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 10) {
                        if ($obat10 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 11) {
                        if ($obat11 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 12) {
                        if ($obat12 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 13) {
                        if ($obat13 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 14) {
                        if ($obat14 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 15) {
                        if ($obat15 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 16) {
                        if ($obat16 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 17) {
                        if ($obat17 != 1) {
                            $count_obat++;
                        }
                    } else if ($value['id_obat'] == 18) {
                        if ($obat18 != 1) {
                            $count_obat++;
                        }
                    }
                }
                // var_dump($count_obat);
                ?>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Main content -->
                        <section class="content">
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-12">
                                    <!-- general form elements -->
                                    <div class="box box-primary">
                                        <?php
                                        if (!empty($data2[0]['final']) == '1' && (!empty($data2[0]['kode_faskes']) == '' || $data2[0]['kode_faskes'] == NULL)) {
                                            echo 'Data Registrasi Praktik Mandiri sedang diverifikasi';
                                        } else {
                                        ?>
                                            <?php
                                            if (!empty($user[0]['id_kategori'])) {
                                            ?>
                                                <!-- /.box-header -->
                                                <!-- form start -->
                                                <form role="form" method="POST" action="" enctype='multipart/form-data'>

                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Kategori Dokumen</label>
                                                            <div class="col-sm-5">
                                                                <input type="hidden" name="id_faskes" value="<?= $this->session->userdata('user_id') ?>" id="id_faskes">
                                                                <select class="form-select" id="basicSelect" name="gambar_kategori">
                                                                    <option value=""> --- Pilih ---</option>
                                                                    <option value="Foto Ruang Praktik (dengan dokter)">Foto Ruang Praktik (dengan dokter)</option>
                                                                    <option value="Foto Ruang Praktik (edukasi pasien/promkes)">Foto Ruang Praktik (edukasi pasien/promkes)</option>
                                                                    <option value="Foto Sarana Kebersihan Tangan">Sarana Kebersihan Tangan</option>
                                                                    <option value="SPO terkait pelayanan">SPO terkait pelayanan</option>
                                                                    <option value="SPO feedback QR Code">SPO feedback QR Code</option>
                                                                    <option value="SPO Pendaftaran">SPO Pendaftaran</option>
                                                                    <option value="Sarana Pengaduan di Perlengkapan">Sarana Pengaduan di Perlengkapan</option>
                                                                    <!-- <option value="Risk Register">Risk Register</option>
                                                                         <option value="Tampilan gedung layanan">Tampilan gedung layanan</option>
                                                                        <option value="Sarana-prasarana">Sarana-prasarana</option>
                                                                        <option value="SDM">SDM</option>
                                                                        <option value="Alat kesehatan">Alat kesehatan canggih (*bila ada)</option> -->
                                                                </select>
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Upload File</label>
                                                            <div class="col-sm-5">
                                                                <input type="file" name="dokumen_gambar" id="dokumen_gambar">
                                                            </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <a target="_blank" href="https://docs.google.com/document/d/1NJ6wXlebB5I-vxtclZJab35ZhAAVOm47/edit?usp=sharing&ouid=116953184596977243649&rtpof=true&sd=true">Contoh Dokumen SPO Pendaftaran Pasien</a>

                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <button type="submit" name="submit" id="submit" class="btn btn-primary" <?= $disabled_html; ?>>Submit</button>
                                                    </div>
                                                </form>
                                            <?php
                                            } else {
                                                echo 'Harap Selesaikan Data Registrasi / Obat Terlebih Dahulu';
                                            }
                                            ?>
                                    </div>
                                <?php
                                        }
                                ?>
                                <!-- /.box -->
                                </div>
                                <!--/.col (left) -->
                                <!--/.col (right) -->
                            </div>
                            <!-- /.row -->
                    </div>
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-body">
                                    <!-- <div class="row gallery">
                                            <?php foreach ($img as $key => $valueuu) { ?>
                                                    <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">

                                                        <h6 style="text-align: center;"><?= $valueuu['gambar'] ?></h6>
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#galleryModal<?= $valueuu['id'] ?>">
                                                            <img class="w-100 active" src="<?= $valueuu['url_full'] ?>">
                                                        </a>
                                                        <br><br>
                                                            <a href="" data-bs-toggle="modal" data-bs-target="#galleryModal2<?= $valueuu['id'] ?>" class="btn btn-success">Edit</a>
                                                            <a href="" data-bs-toggle="modal" data-bs-target="#galleryModal3<?= $valueuu['id'] ?>" class="btn btn-danger">Hapus</a>
                                            </div>
                                            <?php } ?>  -->
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Dokumen</th>
                                                <th>File</th>
                                            </tr>
                                            <?php
                                            $no = 0;
                                            foreach ($img as $key => $value) {
                                                $no++;
                                            ?>

                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $value['gambar'] ?></td>
                                                    <td>
                                                        <a href="<?= $value['url_full'] ?>" class="btn btn-success" target=�_blank�>Lihat</a>
                                                        <a href="<?php echo base_url('pm/hapus_gambar/' . $value['id']); ?>" class="btn btn-danger">Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</section>
<!-- /.content -->
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
</script>