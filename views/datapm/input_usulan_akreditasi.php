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
                    <li class="active"><a href="<?php echo base_url('pm/index_daftar_usulan');?>">Daftar Usulan Akreditasi</a></li>
                </ul>

                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Main content -->
                        <section class="content">
                        <a href="<?php echo base_url('pm/index_daftar_usulan');?>" class="btn btn-lg text-center"><span><i class="fa fa-arrow-left fa-1x"></i></span> Kembali</a>
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
                                                            <label  class="col-sm-2 control-label">Tanggal Usulan Akreditasi</label>
                                                                <div class="col-sm-5">
                                                                    <input type="date" name="tanggal" value="<?=$tanggal;?>"   id="tanggal"  class="form-control" autocomplete="off">
                                                                    <?php
                                                                        // echo $bulan;
                                                                    ?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <input type="hidden" name="id" value=""   id="id"  >
						                                <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                                        <button type="submit" name="cek" id="cek"  class="btn btn-danger">Cek Kebutuhan Akreditasi</button>
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
                                        <form role="form" method="POST" action="" enctype='multipart/form-data'>
                                        <?php if ($this->session->flashdata('error')): ?>
        <script type="text/javascript">
            alert("<?php echo $this->session->flashdata('error'); ?>");
        </script>
    <?php endif; ?>
                                            <table class="table table-bordered" style="width:100%">
                                                <tbody>
                                                <tr>
                                                    <th style="vertical-align : middle; text-align: center" style="width:15%" >No</th>
                                                    <th style="vertical-align : middle; text-align: center" style="width:15%" >Indikator Nasional Mutu (Permenkes 30/2022)</th>
                                                    <th style="text-align: center" style="width:15%">Point Indikator</th>
                                                    <th style="text-align: center" style="width:15%">Nama Elemen</th>
                                                    <th style="text-align: center" >Nilai</th>
                                                    <th style="text-align: center" style="width:15%">Halaman Aplikasi</th>
                                                </tr>

                                                <?php
                                                    $cek = 0;
                                                    $nilai[1]=null;
                                                    $nilai[2]=null;
                                                    $nilai[3]=null;
                                                    $nilai[4]=null;
                                                    $nilai[5]=null;
                                                    $nilai[6]=null;
                                                    $nilai[7]=null;
                                                    $nilai[8]=null;
                                                    $nilai[9]=null;
                                                    $nilai[10]=null;
                                                    $nilai[11]=null;
                                                    $nilai[12]=null;
                                                    $nilai[13]=null;
                                                    $nilai[14]=null;
                                                    $nilai[15]=null;
                                                    $nilai[16]=null;
                                                    $nilai[17]=null;
                                                    $nilai[18]=null;
                                                    $nilai[19]=null;
                                                    $nilai[20]=null;
                                                    $nilai[21]=null;

                                                    if(!empty($data_dasar)){
                                                        if(!empty($data_dasar[0]['jam_praktik_senin_pagi'])
                                                                || !empty($data_dasar[0]['jam_praktik_senin_sore'])
                                                                || !empty($data_dasar[0]['jam_praktik_selasa_pagi'])
                                                                || !empty($data_dasar[0]['jam_praktik_selasa_sore'])
                                                                || !empty($data_dasar[0]['jam_praktik_rabu_pagi'])
                                                                || !empty($data_dasar[0]['jam_praktik_rabu_sore'])
                                                                || !empty($data_dasar[0]['jam_praktik_kamis_pagi'])
                                                                || !empty($data_dasar[0]['jam_praktik_kamis_sore'])
                                                                || !empty($data_dasar[0]['jam_praktik_jumat_pagi'])
                                                                || !empty($data_dasar[0]['jam_praktik_jumat_sore'])
                                                                || !empty($data_dasar[0]['jam_praktik_sabtu_pagi'])
                                                                || !empty($data_dasar[0]['jam_praktik_sabtu_sore'])
                                                                || !empty($data_dasar[0]['jam_praktik_minggu_pagi'])
                                                                || !empty($data_dasar[0]['jam_praktik_minggu_sore'])
                                                                
                                                            ){
                                                                $cek++;
                                                                $nilai[4]=1;
                                                        }

                                                        if(!empty($data_dasar[0]['pelayanan_yang_diberikan'])){
                                                            $cek = $cek +2;
                                                            $nilai[5]=1;
                                                            $nilai[8]=1;
                                                        }

                                                        if(!empty($data_dasar[0]['no_sip']) && !empty($data_dasar[0]['url_dokumen_sip'])){
                                                            $cek++;
                                                            $nilai[7]=1;
                                                        }

                                                        if(!empty($data_dasar[0]['pelatihan_program_prioritas'])){
                                                            $cek++;
                                                            $nilai[9]=1;
                                                        }

                                                    }

                                                    if(!empty($data_alkes)){
                                                        $nilai[3]=1;
                                                        $nilai[11]=1;
                                                        $cek = $cek +2;
                                                    }

                                                    if(!empty($data_dokumen)){
                                                        $found_key = array_search('SPO Pendaftaran', array_column($data_dokumen, 'jenis_dokumen'));
                                                        if ( $data_dokumen[$found_key]['jenis_dokumen'] == 'SPO Pendaftaran'){
                                                            $cek++;
                                                            $nilai[1]=1;
                                                        }

                                                        $found_key2 = array_search('SPO terkait pelayanan', array_column($data_dokumen, 'jenis_dokumen'));
                                                        if ( $data_dokumen[$found_key2]['jenis_dokumen'] == 'SPO terkait pelayanan'){
                                                            $cek++;
                                                            $nilai[2]=1;
                                                        }

                                                        $found_key3 = array_search('Sarana Pengaduan di Perlengkapan', array_column($data_dokumen, 'jenis_dokumen'));
                                                        if ( $data_dokumen[$found_key3]['jenis_dokumen'] == 'Sarana Pengaduan di Perlengkapan'){
                                                            $cek++;
                                                            $nilai[10]=1;
                                                        }

                                                        $found_key4 = array_search('Foto Sarana Kebersihan Tangan', array_column($data_dokumen, 'jenis_dokumen'));
                                                        if ( $data_dokumen[$found_key4]['jenis_dokumen'] == 'Foto Sarana Kebersihan Tangan'){
                                                            if(!empty($data_alkes)){
                                                                $cek++;
                                                                $nilai[12]=1;
                                                            }
                                                        }
                                                    }

                                                    if(!empty($data_pembiayaan_1) && !empty($data_pembiayaan_2) && !empty($data_pembiayaan_3)){
                                                        $cek++;
                                                        $nilai[6]=1;
                                                    }

                                                    if(!empty($data_prognas_1) && !empty($data_prognas_2) && !empty($data_prognas_3)){
                                                        $cek++;
                                                        $nilai[15]=1;
                                                    }

                                                    // echo $data_hipertensi_1[0]['pasien_patuh'];

                                                    if(!empty($data_hipertensi_1) && !empty($data_hipertensi_2) && !empty($data_hipertensi_3)){
                                                        $cek++;
                                                        $nilai[13]=1;
                                                    }

                                                    if(!empty($data_ohis_1) && !empty($data_ohis_2) && !empty($data_ohis_3)){
                                                        $cek++;
                                                        $nilai[14]=1;
                                                    }

                                                    if(!empty($data_review)){
                                                        $sum_ya = array_sum(array_column($data_review, 'ya'));
                                                        $sum_tidak = array_sum(array_column($data_review, 'tidak'));
                                                        $sum = $sum_ya + $sum_tidak;

                                                        if($sum > 0) {
                                                            $nilai[16]=1;
                                                            $nilai[17]=1;
                                                            $nilai[18]=1;
                                                            $nilai[19]=1;
                                                            $cek = $cek +4;
                                                        }
                                                    }

                                                    if(!empty($data_review_star)){
                                                        if(array_sum(array_column($data_review_star, 'jumlah')) > 0){
                                                            // echo array_sum(array_column($data_review_star, 'jumlah'));
                                                            $cek++;
                                                            $nilai[20]=1;
                                                        }
                                                    }

                                                    if(!empty($data_satu_sehat)){
                                                        $nilai[21]=1;
                                                        $cek++;
                                                    }

                                                    // echo $cek;
                                                ?>
                                                
                                                <?php
                                                    $no=0;
                                                    foreach(dropdown_akreditasi_pm() as $key => $value){
                                                    $no++;
                                                ?>
                                                <tr>
                                                    <td><?=$no;?></td>
                                                    <td><?php foreach(dropdown_akreditasi_pm_indikator($key) as $key2 => $value2){ echo $value2;  }?></td>
                                                    <td><?php foreach(dropdown_akreditasi_pm_indikator_detail($key) as $key3 => $value3){ echo $value3;  }?></td>
                                                    <td><?=$value?></td>
                                                    <!-- <td><?=form_dropdown('nilai['.$key.']', dropdown_ada_tidak() ,$nilai[$key],'id="nilai" class="form-control select2" readonly');?></td> -->
                                                    <td><?php foreach(dropdown_ada_tidak_2($nilai[$key]) as $key5 => $value5){ echo $value5;  }?></td>
                                                    <td><?php foreach(dropdown_akreditasi_pm_halaman($key) as $key4 => $value4){ echo $value4;  }?></td>
                                                    <!-- <input type="hidden" name="nilai" value="<?=$key;?>"> -->
                                                    <input type="hidden" name="id_m_akreditasi_pm[]" value="<?=$key;?>">
                                                </tr>
                                                <?php
                                                    }
                                                ?>

                                                </tbody>
                                            </table>

                                            <input type="hidden" name="tanggal_usulan" value="<?=$tanggal;?>"   id="tanggal_usulan"  class="form-control" autocomplete="off">
                                            <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                            <input type="hidden" name="id_kategori_pm" value="<?=$user[0]['id_kategori'];?>"   id="id_kategori_pm"  >
                                            <?php
                                                if($cek == 20){
                                            ?>
                                            <button type="submit" name="submit" id="submit"  class="btn btn-primary" style="float:right;">Tambah Usulan Akreditasi</button>
                                            <?php
                                                }
                                            ?>
                                            </form>
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
    $(document).ready(function(){
        document.getElementById("tanggal").min = new Date().toISOString().split("T")[0];
    })

</script>
