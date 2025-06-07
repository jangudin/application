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
                        <li class="active"><a href="<?php echo base_url('pm/index_kepatuhan_kunjungan_pasien_hipertensi');?>" >Kunjungan Pasien Hipertensi</a></li>
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
                        <a href="inputan_kepatuhan_kunjungan_pasien_hipertensi" class="btn btn-lg text-center" ><span><i class="glyphicon glyphicon-plus"></i></span> Tambah Data</a>
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
                                                    <th style="vertical-align : middle; text-align: center" >No</th>
                                                    <th style="vertical-align : middle; text-align: center" >Uraian</th>
                                                    <th style="text-align: center">Jan</th>
                                                    <th style="text-align: center">Feb</th>
                                                    <th style="text-align: center">Mar</th>
                                                    <th style="text-align: center">Apr</th>
                                                    <th style="text-align: center">Mei</th>
                                                    <th style="text-align: center">Jun</th>
                                                    <th style="text-align: center">Jul</th>
                                                    <th style="text-align: center">Aug</th>
                                                    <th style="text-align: center">Sep</th>
                                                    <th style="text-align: center">Okt</th>
                                                    <th style="text-align: center">Nov</th>
                                                    <th style="text-align: center">Des</th>
                                                </tr>
                                                
                                                <?php
                                                    // var_dump($laporan);

                                                    for($i=1; $i <= 12; $i++) {

                                                        ${'index_' . $i} = array_search($i, array_column($laporan, 'bulan'));
                                                        if(${'index_' . $i} == false) {
                                                            if(gettype(${'index_' . $i}) == boolean){
                                                                ${'pasien_patuh_' . $i} = '';
                                                                ${'jumlah_pasien_hipertensi_' . $i} = '';
                                                                ${'persentase_' . $i} = '';
                                                            } else {
                                                                ${'pasien_patuh_' . $i} = $laporan[${'index_' . $i}]['pasien_patuh'];
                                                                ${'jumlah_pasien_hipertensi_' . $i} = $laporan[${'index_' . $i}]['jumlah_pasien_hipertensi'];
                                                                ${'persentase_' . $i} = round($laporan[${'index_' . $i}]['persentase']).'&#37;';
                                                            }
                                                        } else {
                                                            if(!empty(${'index_' . $i})){
                                                                ${'pasien_patuh_' . $i} = $laporan[${'index_' . $i}]['pasien_patuh'];
                                                                ${'jumlah_pasien_hipertensi_' . $i} = $laporan[${'index_' . $i}]['jumlah_pasien_hipertensi'];
                                                                ${'persentase_' . $i} = round($laporan[${'index_' . $i}]['persentase']).'&#37;';
                                                            }
                                                        }
                                                    }

                                                    // echo $pasien_patuh_1;

                                                    // echo $pasien_patuh_2;
                                                    // echo $laporan[$index_2]['pasien_patuh'];
                                                ?>

                                                <tr>
                                                    <td style="text-align: center">1</th>
                                                    <td style="text-align: center">Pasien Patuh</th>
                                                    <td style="text-align: center"><?= $pasien_patuh_1; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_2; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_3; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_4; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_5; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_6; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_7; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_8; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_9; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_10; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_11; ?></th>
                                                    <td style="text-align: center"><?= $pasien_patuh_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center">2</th>
                                                    <td style="text-align: center">Jumlah Pasien Hipertensi</th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_1; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_2; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_3; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_4; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_5; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_6; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_7; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_8; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_9; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_10; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_11; ?></th>
                                                    <td style="text-align: center"><?= $jumlah_pasien_hipertensi_12; ?></th>
                                                </tr>
                                                <tr>
                                                    <th style="text-align: center"></th>
                                                    <th style="text-align: center">Persentase (N/D)</th>
                                                    <th style="text-align: center"><?= $persentase_1; ?></th>
                                                    <th style="text-align: center"><?= $persentase_2; ?></th>
                                                    <th style="text-align: center"><?= $persentase_3; ?></th>
                                                    <th style="text-align: center"><?= $persentase_4; ?></th>
                                                    <th style="text-align: center"><?= $persentase_5; ?></th>
                                                    <th style="text-align: center"><?= $persentase_6; ?></th>
                                                    <th style="text-align: center"><?= $persentase_7; ?></th>
                                                    <th style="text-align: center"><?= $persentase_8; ?></th>
                                                    <th style="text-align: center"><?= $persentase_9; ?></th>
                                                    <th style="text-align: center"><?= $persentase_10; ?></th>
                                                    <th style="text-align: center"><?= $persentase_11; ?></th>
                                                    <th style="text-align: center"><?= $persentase_12; ?></th>
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
