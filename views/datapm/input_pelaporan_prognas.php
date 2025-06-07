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
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-12" >
                                    <!-- general form elements -->
                                    <div class="box box-primary">
                                        
                                                <!-- /.box-header -->
                                                <!-- form start -->
                                                <form role="form" method="POST" action="" enctype='multipart/form-data'>
                                                    <div class="box-body">
                                                    <a href="index_pelaporan_prognas" class="btn btn-lg text-center"><span><i class="fa fa-arrow-left fa-1x"></i></span> Kembali</a>
                                                    <h3>  Tambah Data Pelaporan Program Prioritas Nasional</h3>
                                                        </br>
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Bulan</label>
                                                                <div class="col-sm-5">
                                                                    <?php
                                                                        // var_dump(dropdown_nama_obat());
                                                                    ?>
                                                                    
                                                                <?=form_dropdown('bulan', dropdown_bulan(), '','id="bulan" required class="form-control select2"');?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Tahun</label>
                                                                <div class="col-sm-5">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <input type="number" name="tahun"  id="tahun" min="2023"  class="form-control" autocomplete="off">
                                                                        <!-- <input type="text"  name="tahun" id="tahun" value=""  class="form-control datepicker"  autocomplete="off" > -->
                                                                    </div>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Stunting Wasting</label>
                                                                <div class="col-sm-5">
                                                                    <input type="number" name="stunting_wasting"  id="stunting_wasting" min="0" class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Tuberculosis</label>
                                                                <div class="col-sm-5">
                                                                    <input type="number" name="tuberculosis"  id="tuberculosis" min="0"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Hipertensi</label>
                                                                <div class="col-sm-5">
                                                                    <input type="number" name="hipertensi"  id="hipertensi" min="0"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Diabetes Melitus</label>
                                                                <div class="col-sm-5">
                                                                    <input type="number" name="diabetes_melitus"  id="diabetes_melitus" min="0"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Kehamilan Risiko Tinggi</label>
                                                                <div class="col-sm-5">
                                                                    <input type="number" name="kehamilan_risiko_tinggi"  id="kehamilan_risiko_tinggi" min="0"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Imunisasi</label>
                                                                <div class="col-sm-5">
                                                                    <input type="number" name="imunisasi"  id="imunisasi"  class="form-control" min="0" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Jumlah Pasien Satu Bulan</label>
                                                                <div class="col-sm-5">
                                                                    <input type="number" name="jumlah_pasien_satu_bulan"  id="jumlah_pasien_satu_bulan" min="0"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <input type="hidden" name="id" value=""   id="id"  >
						                                <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                                        <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button>
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
