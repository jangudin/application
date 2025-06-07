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
                        <?php
                         $dtz = new DateTimeZone("Asia/Jakarta"); //Your timezone
                         $now = new DateTime(date("Y-m-d"), $dtz);
                         $tahun_sekarang = $now->format("Y-m-d");
                         // var_dump($usulan[0]['tanggal_setuju_katim']);
                         $tahun_setuju = $usulan[0]['tanggal_setuju_katim'];
                         date('Y-m-d', strtotime($tahun_setuju));

                            if(empty($usulan) || $usulan[0]['status_setuju_katim'] == "Tidak" || $tahun_setuju <= (strtotime('-5 years', $tahun_sekarang)) ){

                            
                        ?>
                        <a href="<?php echo base_url('pm/inputan_usulan_akreditasi');?>" class="btn btn-lg text-center" ><span><i class="glyphicon glyphicon-plus"></i></span> Tambah Usulan</a>
                        <?php
                            } else {
                               
                            }     
                        ?>
                        
                            
                       
                            
                            
                            
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
                                                    <th style="vertical-align : middle; text-align: center" >Tanggal Usulan</th>
                                                    <th style="vertical-align : middle; text-align: center" >Status Verifikasi</th>
                                                    <th style="vertical-align : middle; text-align: center" >Status Sertifikat</th>
                                                    <th style="vertical-align : middle; text-align: center" >Keterangan</th>
                                                    <th style="vertical-align : middle; text-align: center" >Download Sertifikat</th>
                                                </tr>
                                                
                                                <?php
                                                // echo $api;
                                                    $no=0;
                                                    foreach($usulan as $key => $value){
                                                    $no++;
                                                    // echo $value;
                                                    // var_dump($value);
                                                ?>
                                                
                                                <tr>
                                                    <td style="text-align: center"><?=$no?></td>
                                                    <td style="text-align: center"><?=$value['tanggal_usulan']?></td>
                                                    <td style="text-align: center"><?=form_dropdown('status_verifikasi', array(''=>'Proses','Ya'=>'Lulus','Tidak'=>'Belum Lulus') ,(!empty($value['status_setuju_katim']) ? $value['status_setuju_katim'] : ''),'id="status_verifikasi" class="form-control select2" disabled');?></td>
                                                    <td style="text-align: center"><?=form_dropdown('status_sertifikat', array(''=>'Belum Proses','Ya'=>'Proses TTE') ,(!empty($value['status_setuju_katim']) ? $value['status_setuju_katim'] : ''),'id="status_sertifikat" class="form-control select2" disabled');?></td>
                                                    <td style="text-align: center"><?=$value['keterangan_katim']?></td>
                                                    <td style="text-align: center;">
                                                        <a href="https://sinar.kemkes.go.id/assets/TPMD/<?= htmlspecialchars(str_replace(['"', "'"], '', $file), ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-sm btn-success" download>
                                                            Download
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php
                                                }
                                                ?>

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
