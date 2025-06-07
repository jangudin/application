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
                    <li class="active"><a href="<?php echo base_url('pm/inputan_data_obat_pm'); ?>">Obat</a></li>

                    <li><a href="<?php echo base_url('pm/inputan_data_gambar_pm'); ?>">Dokumentasi</a></li>
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

<?php
                    } elseif ($this->session->userdata('id_kategori_pm') == 6 || $this->session->userdata('id_kategori_pm') == 7) {

                    ?>
                    <li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
                    <!-- <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li> -->
                        <li class="active"><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>

                        <li  ><a href="<?php echo base_url('pm/inputan_data_gambar_pm');?>">Dokumentasi</a></li>
                        <?php
                        // var_dump($data2);
                        if(!empty($data2[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323){
                            ?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
                        <li  ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        <li ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                        <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                   <?php } elseif(!empty($data2[0]['kode_faskes']))  { ?>
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

                    
                    <?php } ?>
                    <li><a href="<?php echo base_url('pm/selesaikan'); ?>">Print QR</a></li>
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
                                        <div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> </button>
                                            <h4><i class="icon fa fa-warning"></i> Catatan!</h4>
                                            Tidak wajib mengisi semua data jenis obat emergensi, silahkan mengisi sesuai obat yang ada di fasyankes.
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <form role="form" method="POST" action="" enctype='multipart/form-data'>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Nama Obat</label>
                                                    <div class="col-sm-5">
                                                        <?= form_dropdown('obat_id', dropdown_nama_obat(), '', 'id="obat_id" required class="form-control select2"'); ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Jenis Sediaan</label>
                                                    <div class="col-sm-5">
                                                        <?php
                                                        // var_dump(dropdown_nama_obat());
                                                        ?>

                                                        <?= form_dropdown('jenis_sediaan_id', dropdown_jenis_sediaan(), '', 'id="jenis_sediaan_id" required class="form-control select2"'); ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">No Batch</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="no_batch" value="" id="no_batch" class="form-control" autocomplete="off">
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Nama Perusahaan</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="nama_perusahaan" value="" id="nama_perusahaan" class="form-control" autocomplete="off">
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Sumber Pembelian</label>
                                                    <div class="col-sm-5">

                                                        <?= form_dropdown('sumber_pembelian', dropdown_sumber_pembelian(), '', 'id="sumber_pembelian" required class="form-control select2"'); ?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer">
                                                <input type="hidden" name="id" value="" id="id">
                                                <input type="hidden" name="id_faskes" value="<?= $this->session->userdata('user_id') ?>" id="id_faskes">
                                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                                                <!-- <a class="btn btn-danger" name="nik" id="nik">Cek NIK</a> -->
                                            </div>
                                        </form>
                                    </div>
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
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Jenis Sediaan</th>
                                                <th>No Batch</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Sumber Pembelian</th>
                                                <th>Aksi</th>
                                            </tr>
                                            <?php
                                            $no = 0;
                                            foreach ($obat as $key => $value) {
                                                $no++;
                                            ?>

                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $value['obat_id'] ?></td>
                                                    <td><?= $value['jenis_sediaan_id'] ?></td>
                                                    <td><?= $value['no_batch'] ?></td>
                                                    <td><?= $value['nama_perusahaan'] ?></td>
                                                    <td><?= $value['sumber_pembelian'] ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('pm/hapus_data_obat/' . $value['id']); ?>" class="btn btn-danger">Hapus</a>
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


</script>