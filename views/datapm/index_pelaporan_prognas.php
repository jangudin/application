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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> </button>
                        <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                        <?=$this->session->flashdata('message_name');?>
                    </div>
                    <?php
                    }
                ?>
                
                <ul class="nav nav-tabs">
                    <li ><a href="<?php echo base_url('pm/index_pembiayaan_kesehatan_pasien');?>">Pembiayaan Kesehatan Pasien</a></li>
                    <?php
                    if($this->session->userdata('id_kategori_pm')==4){
                    ?>
                        <li><a href="<?php echo base_url('pm/index_kepatuhan_kunjungan_pasien_hipertensi');?>" >Kunjungan Pasien Hipertensi</a></li>
                    <?php
                    } else if ($this->session->userdata('id_kategori_pm')==5){
                    ?>
                        <li><a href="<?php echo base_url('pm/index_penurunan_skor_ohis_pasien');?>" >Penurunan Skor OHIS Pasien</a></li>
                    <?php
                    }
                    ?>       
                    <li class="active"><a href="<?php echo base_url('pm/index_pelaporan_prognas');?>" >Pelaporan Program Prioritas Nasional</a></li>
                </ul>

                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Main content -->
                        <section class="content">
                        <a href="inputan_pelaporan_prognas" class="btn btn-lg text-center" ><span><i class="glyphicon glyphicon-plus"></i></span> Tambah Data</a>
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-12" >
                                    <!-- general form elements -->
                                    <div class="box box-primary">
                                        
                                                <!-- /.box-header -->
                                                <!-- form start -->
                                                <form role="form" method="POST" action="" enctype='multipart/form-data'>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Tahun</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="tahun" value="<?=$tahun;?>"   id="tahun"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <input type="hidden" name="id" value=""   id="id"  >
						                                <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                                        <button type="submit" name="submit" id="submit"  class="btn btn-primary">Cari</button>
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
                                <div class="col-md-12" >
                                    <!-- general form elements -->
                                    <div class="box box-primary">
                                        <div class="box-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th style="vertical-align : middle; text-align: center" rowspan="2">No</th>
                                                    <th style="vertical-align : middle; text-align: center" rowspan="2">Program Prioritas Nasional (Diagnosis)</th>
                                                    <th style="text-align: center" colspan="2">Jan</th>
                                                    <th style="text-align: center" colspan="2">Feb</th>
                                                    <th style="text-align: center" colspan="2">Mar</th>
                                                    <th style="text-align: center" colspan="2">Apr</th>
                                                    <th style="text-align: center" colspan="2">Mei</th>
                                                    <th style="text-align: center" colspan="2">Jun</th>
                                                    <th style="text-align: center" colspan="2">Jul</th>
                                                    <th style="text-align: center" colspan="2">Aug</th>
                                                    <th style="text-align: center" colspan="2">Sep</th>
                                                    <th style="text-align: center" colspan="2">Okt</th>
                                                    <th style="text-align: center" colspan="2">Nov</th>
                                                    <th style="text-align: center" colspan="2">Des</th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                    <th style="text-align: center">&Sigma;</th>
                                                    <th style="text-align: center">&#37;</th>
                                                </tr>
                                                
                                                <?php
                                                    // var_dump($laporan);
                                                    for($i=1; $i <= 12; $i++) {

                                                        ${'index_' . $i} = array_search($i, array_column($laporan, 'bulan'));
                                                        if(${'index_' . $i} == false) {
                                                            if(gettype(${'index_' . $i}) == boolean){
                                                                ${'stunting_wasting_' . $i} = '';
                                                                ${'tuberculosis_' . $i} = '';
                                                                ${'hipertensi_' . $i} = '';
                                                                ${'diabetes_melitus_' . $i} = '';
                                                                ${'kehamilan_risiko_tinggi_' . $i} = '';
                                                                ${'imunisasi_' . $i} = '';
                                                                ${'lainnya_' . $i} = '';
                                                                ${'jumlah_pasien_satu_bulan_' . $i} = '';
                                                                

                                                                ${'persen_stunting_wasting_' . $i} = '';
                                                                ${'persen_tuberculosis_' . $i} = '';
                                                                ${'persen_hipertensi_' . $i} = '';
                                                                ${'persen_diabetes_melitus_' . $i} = '';
                                                                ${'persen_kehamilan_risiko_tinggi_' . $i} = '';
                                                                ${'persen_imunisasi_' . $i} = '';
                                                                ${'persen_jumlah_pasien_satu_bulan_' . $i} = '';
                                                                
                                                            } else {
                                                                ${'stunting_wasting_' . $i} = $laporan[${'index_' . $i}]['stunting_wasting'];
                                                                ${'tuberculosis_' . $i} = $laporan[${'index_' . $i}]['tuberculosis'];
                                                                ${'hipertensi_' . $i} = $laporan[${'index_' . $i}]['hipertensi'];
                                                                ${'diabetes_melitus_' . $i} = $laporan[${'index_' . $i}]['diabetes_melitus'];
                                                                ${'kehamilan_risiko_tinggi_' . $i} = $laporan[${'index_' . $i}]['kehamilan_risiko_tinggi'];
                                                                ${'imunisasi_' . $i} = $laporan[${'index_' . $i}]['imunisasi'];
                                                                ${'lainnya_' . $i} = $laporan[${'index_' . $i}]['lainnya'];
                                                                ${'jumlah_pasien_satu_bulan_' . $i} = $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'];

                                                                ${'persen_stunting_wasting_' . $i} = round(${'stunting_wasting_' . $i} * 100 / $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_tuberculosis_' . $i} = round(${'tuberculosis_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_hipertensi_' . $i} = round(${'hipertensi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_diabetes_melitus_' . $i} = round(${'diabetes_melitus_' . $i} * 100 / $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_kehamilan_risiko_tinggi_' . $i} = round(${'kehamilan_risiko_tinggi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_imunisasi_' . $i} = round(${'imunisasi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_lainnya_' . $i} = round(${'lainnya_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_jumlah_pasien_satu_bulan_' . $i} = 100;
                                                                // ${'persen_jumlah_pasien_satu_bulan_' . $i} = round(${'stunting_wasting_' . $i} * 100 / $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'tuberculosis_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'hipertensi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'diabetes_melitus_' . $i} * 100 / $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'kehamilan_risiko_tinggi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'imunisasi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                            }
                                                        } else {
                                                            if(!empty(${'index_' . $i})){
                                                                ${'stunting_wasting_' . $i} = $laporan[${'index_' . $i}]['stunting_wasting'];
                                                                ${'tuberculosis_' . $i} = $laporan[${'index_' . $i}]['tuberculosis'];
                                                                ${'hipertensi_' . $i} = $laporan[${'index_' . $i}]['hipertensi'];
                                                                ${'diabetes_melitus_' . $i} = $laporan[${'index_' . $i}]['diabetes_melitus'];
                                                                ${'kehamilan_risiko_tinggi_' . $i} = $laporan[${'index_' . $i}]['kehamilan_risiko_tinggi'];
                                                                ${'imunisasi_' . $i} = $laporan[${'index_' . $i}]['imunisasi'];
                                                                ${'lainnya_' . $i} = $laporan[${'index_' . $i}]['lainnya'];
                                                                ${'jumlah_pasien_satu_bulan_' . $i} = $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'];

                                                                ${'persen_stunting_wasting_' . $i} = round(${'stunting_wasting_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_tuberculosis_' . $i} = round(${'tuberculosis_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_hipertensi_' . $i} = round(${'hipertensi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_diabetes_melitus_' . $i} = round(${'diabetes_melitus_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_kehamilan_risiko_tinggi_' . $i} = round(${'kehamilan_risiko_tinggi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_imunisasi_' . $i} = round(${'imunisasi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_lainnya_' . $i} = round(${'lainnya_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                                ${'persen_jumlah_pasien_satu_bulan_' . $i} = 100;
                                                                // ${'persen_jumlah_pasien_satu_bulan_' . $i} = round(${'stunting_wasting_' . $i} * 100 / $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'tuberculosis_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'hipertensi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'diabetes_melitus_' . $i} * 100 / $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'kehamilan_risiko_tinggi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan'])
                                                                // +round(${'imunisasi_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah_pasien_satu_bulan']);
                                                            }
                                                        }
                                                    }

                                                    // echo $stunting_wasting_1;

                                                    // echo $stunting_wasting_2;
                                                    // echo $laporan[$index_2]['stunting_wasting'];
                                                ?>

                                                <tr>
                                                    <td style="text-align: center">1</th>
                                                    <td style="text-align: center">Stunting Wasting</th>
                                                    <td style="text-align: center"><?= $stunting_wasting_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_1; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_2; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_3; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_4; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_5; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_6; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_7; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_8; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_9; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_10; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_11; ?></th>
                                                    <td style="text-align: center"><?= $stunting_wasting_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_stunting_wasting_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">2</th>
                                                    <td style="text-align: center">Tuberculosis</th>
                                                    <td style="text-align: center"><?= $tuberculosis_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_1; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_2; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_3; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_4; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_5; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_6; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_7; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_8; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_9; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_10; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_11; ?></th>
                                                    <td style="text-align: center"><?= $tuberculosis_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_tuberculosis_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">3</th>
                                                    <td style="text-align: center">Hipertensi</th>
                                                    <td style="text-align: center"><?= $hipertensi_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_1; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_2; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_3; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_4; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_5; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_6; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_7; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_8; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_9; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_10; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_11; ?></th>
                                                    <td style="text-align: center"><?= $hipertensi_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_hipertensi_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">4</th>
                                                    <td style="text-align: center">Diabetes Melitus</th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_1; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_2; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_3; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_4; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_5; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_6; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_7; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_8; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_9; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_10; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_11; ?></th>
                                                    <td style="text-align: center"><?= $diabetes_melitus_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_diabetes_melitus_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">5</th>
                                                    <td style="text-align: center">Kehamilan Risiko Tinggi</th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_1; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_2; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_3; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_4; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_5; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_6; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_7; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_8; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_9; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_10; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_11; ?></th>
                                                    <td style="text-align: center"><?= $kehamilan_risiko_tinggi_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_kehamilan_risiko_tinggi_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">6</th>
                                                    <td style="text-align: center">Imunisasi</th>
                                                    <td style="text-align: center"><?= $imunisasi_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_1; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_2; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_3; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_4; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_5; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_6; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_7; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_8; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_9; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_10; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_11; ?></th>
                                                    <td style="text-align: center"><?= $imunisasi_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_imunisasi_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">7</th>
                                                    <td style="text-align: center">Lainnya</th>
                                                    <td style="text-align: center"><?= $lainnya_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_1; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_2; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_3; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_4; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_5; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_6; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_7; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_8; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_9; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_10; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_11; ?></th>
                                                    <td style="text-align: center"><?= $lainnya_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_lainnya_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center"></th>
                                                    <th style="text-align: center">Jumlah Pasien Satu Bulan</th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_1; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_1; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_2; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_2; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_3; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_3; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_4; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_4; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_5; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_5; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_6; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_6; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_7; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_7; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_8; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_8; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_9; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_9; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_10; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_10; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_11; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_11; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_pasien_satu_bulan_12; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_pasien_satu_bulan_12; ?></th>
                                                </tr>

                                                <?php
                                                    // var_dump($laporan);
                                                    // echo array_search(12, array_column($laporan, 'bulan'));
                                                ?>

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
