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
                    <li class="active"><a href="<?php echo base_url('pm/index_pembiayaan_kesehatan_pasien');?>">Pembiayaan Kesehatan Pasien</a></li>
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
                    <li ><a href="<?php echo base_url('pm/index_pelaporan_prognas');?>" >Pelaporan Program Prioritas Nasional</a></li>
                </ul>

                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Main content -->
                        <section class="content">
                        <a href="inputan_pembiayaan_kesehatan_pasien" class="btn btn-lg text-center" ><span><i class="glyphicon glyphicon-plus"></i></span> Tambah Data</a>
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
                                                    <th style="vertical-align : middle; text-align: center" rowspan="2">Jenis Pembiayaan Kesehatan Pasien</th>
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
                                                    

                                                    for($i=1; $i <= 12; $i++) {

                                                        ${'index_' . $i} = array_search($i, array_column($laporan, 'bulan'));
                                                        if(${'index_' . $i} == false) {
                                                            if(gettype(${'index_' . $i}) == boolean){
                                                                ${'umum_' . $i} = '';
                                                                ${'jkn_' . $i} = '';
                                                                ${'asuransi_lainnya_' . $i} = '';
                                                                ${'jumlah_' . $i} = '';

                                                                ${'persen_umum_' . $i} = '';
                                                                ${'persen_jkn_' . $i} = '';
                                                                ${'persen_asuransi_lainnya_' . $i} = '';
                                                                ${'persen_jumlah_' . $i} = '';
                                                            } else {
                                                                ${'umum_' . $i} = $laporan[${'index_' . $i}]['umum'];
                                                                ${'jkn_' . $i} = $laporan[${'index_' . $i}]['jkn'];
                                                                ${'asuransi_lainnya_' . $i} = $laporan[${'index_' . $i}]['asuransi_lainnya'];
                                                                ${'jumlah_' . $i} = $laporan[${'index_' . $i}]['jumlah'];

                                                                ${'persen_umum_' . $i} = round(${'umum_' . $i} * 100 / $laporan[${'index_' . $i}]['jumlah']);
                                                                ${'persen_jkn_' . $i} = round(${'jkn_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah']);
                                                                ${'persen_asuransi_lainnya_' . $i} = round(${'asuransi_lainnya_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah']);
                                                                ${'persen_jumlah_' . $i} = 100;
                                                            }
                                                        } else {
                                                            if(!empty(${'index_' . $i})){
                                                                ${'umum_' . $i} = $laporan[${'index_' . $i}]['umum'];
                                                                ${'jkn_' . $i} = $laporan[${'index_' . $i}]['jkn'];
                                                                ${'asuransi_lainnya_' . $i} = $laporan[${'index_' . $i}]['asuransi_lainnya'];
                                                                ${'jumlah_' . $i} = $laporan[${'index_' . $i}]['jumlah'];

                                                                ${'persen_umum_' . $i} = round(${'umum_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah']);
                                                                ${'persen_jkn_' . $i} = round(${'jkn_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah']);
                                                                ${'persen_asuransi_lainnya_' . $i} = round(${'asuransi_lainnya_' . $i} * 100 /  $laporan[${'index_' . $i}]['jumlah']);
                                                                ${'persen_jumlah_' . $i} = 100;
                                                            }
                                                        }
                                                    }

                                                    // echo $umum_1;

                                                    // echo $umum_2;
                                                    // echo $laporan[$index_2]['umum'];
                                                ?>

                                                <tr>
                                                    <td style="text-align: center">1</th>
                                                    <td style="text-align: center">Umum</th>
                                                    <td style="text-align: center"><?= $umum_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_1; ?></th>
                                                    <td style="text-align: center"><?= $umum_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_2; ?></th>
                                                    <td style="text-align: center"><?= $umum_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_3; ?></th>
                                                    <td style="text-align: center"><?= $umum_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_4; ?></th>
                                                    <td style="text-align: center"><?= $umum_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_5; ?></th>
                                                    <td style="text-align: center"><?= $umum_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_6; ?></th>
                                                    <td style="text-align: center"><?= $umum_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_7; ?></th>
                                                    <td style="text-align: center"><?= $umum_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_8; ?></th>
                                                    <td style="text-align: center"><?= $umum_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_9; ?></th>
                                                    <td style="text-align: center"><?= $umum_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_10; ?></th>
                                                    <td style="text-align: center"><?= $umum_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_11; ?></th>
                                                    <td style="text-align: center"><?= $umum_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_umum_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">2</th>
                                                    <td style="text-align: center">JKN</th>
                                                    <td style="text-align: center"><?= $jkn_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_1; ?></th>
                                                    <td style="text-align: center"><?= $jkn_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_2; ?></th>
                                                    <td style="text-align: center"><?= $jkn_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_3; ?></th>
                                                    <td style="text-align: center"><?= $jkn_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_4; ?></th>
                                                    <td style="text-align: center"><?= $jkn_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_5; ?></th>
                                                    <td style="text-align: center"><?= $jkn_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_6; ?></th>
                                                    <td style="text-align: center"><?= $jkn_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_7; ?></th>
                                                    <td style="text-align: center"><?= $jkn_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_8; ?></th>
                                                    <td style="text-align: center"><?= $jkn_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_9; ?></th>
                                                    <td style="text-align: center"><?= $jkn_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_10; ?></th>
                                                    <td style="text-align: center"><?= $jkn_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_11; ?></th>
                                                    <td style="text-align: center"><?= $jkn_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_jkn_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">3</th>
                                                    <td style="text-align: center">Asuransi Lainnya</th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_1; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_1; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_2; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_2; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_3; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_3; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_4; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_4; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_5; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_5; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_6; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_6; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_7; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_7; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_8; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_8; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_9; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_9; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_10; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_10; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_11; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_11; ?></th>
                                                    <td style="text-align: center"><?= $asuransi_lainnya_12; ?></th>
                                                    <td style="text-align: center"><?= $persen_asuransi_lainnya_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center"></th>
                                                    <th style="text-align: center">Jumlah</th>
                                                    <th style="text-align: center"><?= $jumlah_1; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_1; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_2; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_2; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_3; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_3; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_4; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_4; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_5; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_5; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_6; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_6; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_7; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_7; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_8; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_8; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_9; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_9; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_10; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_10; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_11; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_11; ?></th>
                                                    <th style="text-align: center"><?= $jumlah_12; ?></th>
                                                    <th style="text-align: center"><?= $persen_jumlah_12; ?></th>
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
