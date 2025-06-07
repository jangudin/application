<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
#map-layer {
	margin: 20px 0px;
	max-width: 600px;
	min-height: 400;
}
#btnAction {
	background: #3878c7;
    padding: 10px 40px;
    border: #3672bb 1px solid;
    border-radius: 2px;
    color: #FFF;
    font-size: 0.9em;
    cursor:pointer;
    display:block;
}
#btnAction:disabled {
    background: #6c99d2;
}
</style>

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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                        <?=$this->session->flashdata('message_name');?>
                    </div>
                <?php
                    }
                ?>
                <ul class="nav nav-tabs">
                    <li  class="active"><a href="<?php echo base_url('simgos');?>">Permohonan Simgos</a></li>
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
                                        <!-- form start -->
                                        <form role="form" method="POST" action="" enctype='multipart/form-data'>
                                            <!-- /.box-body -->
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">UPLOAD SURAT PERMOHONAN SIMGOS</label>
                                                    <div class="col-sm-5">
                                                    <input type="file"  name="dokumen_permohonan" <?=$disabled_html?>  id="dokumen_permohonan" >
                                                    <a target="_blank" href="<?php echo $data[0]['url_dokumen_permohonan'];?>"><?php echo $data[0]['dokumen_permohonan'];?></a>
                                                    <input type="hidden"  name="old_dokumen_permohonan" value="<?=$data[0]['dokumen_permohonan']?>" id="old_dokumen_permohonan">
                                                    </div> *Hanya File PDF Kurang Dari 2 MB
                                                    <br>
                                                    <!-- <a target="_blank" href="<?php echo base_url('assets/Surat Permohonan Registrasi Klinik.docx');?>">Download Contoh Format Surat Permohonan Registrasi</a>	 -->
                                                    <div style="clear:both;"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">NAMA PENGISI</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="nama_pengisi" value="<?=$data[0]['nama_pengisi']?>"  class="form-control" autocomplete="off" id="nama_pengisi"  required>
                                                        <input type="hidden" name="id" value="<?=$data[0]['id']?>"   id="id"  >
                                                        <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                                    </div>
                                                    <div style="clear:both;">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">HP PENGISI</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="hp_pengisi" value="<?=$data[0]['hp_pengisi']?>"  class="form-control" autocomplete="off" id="hp_pengisi"  required>
                                                        
                                                    </div>
                                                    <div style="clear:both;">
                                                    </div>
                                                </div>
				
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah tersedia SDM IT untuk bantu install sistem sekaligus training SIMGOS KLINIK?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('ketersediaan_sdm_it', dropdown_ketersediaan_sdm_it(), $data[0]['ketersediaan_sdm_it'],'id="ketersediaan_sdm_it" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
				
                                                <?php
                                                    $kemampuan_sdm_it=explode(';',$data[0]['kemampuan_sdm_it']);
                                                ?>
                                                

				                                <div class="form-group" id="kemampuan_sdm_it_html" >
                                                    <label  class="col-sm-2 control-label">Apabila tersedia SDM IT maka apa saja jenis kemampuannya?</label>
                                                    <div class="col-sm-10">
                                                        <div id="kemampuan_sdm_it_html" >
                                                            
                                                            <input type="checkbox" <?=(in_array("System Support", $kemampuan_sdm_it) ? 'checked' : '') ?> name="kemampuan_sdm_it[]" value="System Support"   id="system_support"> System Support<br>
                                                            <input type="checkbox" <?=(in_array("Programmer", $kemampuan_sdm_it) ? 'checked' : '') ?> name="kemampuan_sdm_it[]" value="Programmer"   id="programmer"> Programmer<br>
                                                            <input type="checkbox" <?=(in_array("Database Administrator", $kemampuan_sdm_it) ? 'checked' : '') ?> name="kemampuan_sdm_it[]" value="Database Administrator"   id="database_administrator"> Database Administrator<br>
                                                            <input type="checkbox" <?=(in_array("Network", $kemampuan_sdm_it) ? 'checked' : '') ?> name="kemampuan_sdm_it[]" value="Network"   id="network"> Network<br>
                                                            <input type="checkbox" <?=(in_array("Teknik Komputer", $kemampuan_sdm_it) ? 'checked' : '') ?> name="kemampuan_sdm_it[]" value="Teknik Komputer"   id="teknik_komputer"> Teknik Komputer<br>
                                                            <input type="checkbox" <?=(in_array("System Analys", $kemampuan_sdm_it) ? 'checked' : '') ?> name="kemampuan_sdm_it[]" value="System Analys"   id="system_analys"> System Analys<br>
                                                            <!-- <input type="checkbox" onchange="openshowlainnya();" <?=(in_array("Pelayanan lainnya", $pelayanan_klinik) ? 'checked' : '') ?> name="pelayanan_klinik[]" value="Pelayanan lainnya"   id="lainnya"> Pelayanan lainnya(Sebutkan) <div id="lainnya_html" style="display:<?=$var_style5?>"><input type="text" name="sebutkan_pelayanan_klinik_lainnya" value="<?=$data[0]['sebutkan_pelayanan_klinik_lainnya']?>"  class="form-control" autocomplete="off" id="sebutkan_pelayanan_klinik_lainnya"  ></div> -->
                                                        </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apabila tidak punya SDM IT, apakah tersedia SDM yang memiliki kemampuan/ pengalaman terkait install sistem?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('pengalaman_sdm_it', dropdown_pengalaman_sdm_it(), $data[0]['pengalaman_sdm_it'],'id="pengalaman_sdm_it" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Memiliki Internet?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_internet', dropdown_memiliki_internet(), $data[0]['memiliki_internet'],'id="memiliki_internet" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Memiliki Server?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_server', dropdown_memiliki_server(), $data[0]['memiliki_server'],'id="memiliki_server" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah server memenuhi spek minimal: processor Intel Xeon 6C/12T, RAM 8GB, HDD 1 TB, OS Alma Linux dan monitor ?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memenuhi_spek_minimal_server', dropdown_ya_tidak(), $data[0]['memenuhi_spek_minimal_server'],'id="memenuhi_spek_minimal_server" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki Local Server?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_local_server', dropdown_ya_tidak(), $data[0]['memiliki_local_server'],'id="memiliki_local_server" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki UPS?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_ups', dropdown_ya_tidak(), $data[0]['memiliki_ups'],'id="memiliki_ups" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki Rak Server?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_rak_server', dropdown_ya_tidak(), $data[0]['memiliki_rak_server'],'id="memiliki_rak_server" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki HDD Eksternal Untuk Back Up Data?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_hdd_eksternal_untuk_backup', dropdown_ya_tidak(), $data[0]['memiliki_hdd_eksternal_untuk_backup'],'id="memiliki_hdd_eksternal_untuk_backup" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki Mikrotik Router ?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_mikrotik_router', dropdown_ya_tidak(), $data[0]['memiliki_mikrotik_router'],'id="memiliki_mikrotik_router" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki Kabel LAN ?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_kabel_lan', dropdown_ya_tidak(), $data[0]['memiliki_kabel_lan'],'id="memiliki_kabel_lan" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki Core Switch ?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_core_switch', dropdown_ya_tidak(), $data[0]['memiliki_core_switch'],'id="memiliki_core_switch" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki Web Hosting?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_web_hosting', dropdown_ya_tidak(), $data[0]['memiliki_web_hosting'],'id="memiliki_web_hosting" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apa alamat websitenya ?</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" name="alamat_website" value="<?=$data[0]['alamat_website']?>"  class="form-control" autocomplete="off" id="alamat_website" >
                                                    </div>
                                                    <div style="clear:both;">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Alamat di dalam negeri?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('alamat_di_dalam_negeri', dropdown_ya_tidak(), $data[0]['alamat_di_dalam_negeri'],'id="alamat_di_dalam_negeri" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki PC/ Komputer ?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_komputer', dropdown_ya_tidak(), $data[0]['memiliki_komputer'],'id="memiliki_komputer" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apabila Ya, apakah tersedia PC/ Komputer yg memenuhi spek minimal Processor I3, RAM 4 GB, HDD 256 GB, OS Windows 7, Monitor min 12,5 inch?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_komputer_spek_minimal', dropdown_memiliki_komputer_spek_minimal(), $data[0]['memiliki_komputer_spek_minimal'],'id="memiliki_komputer_spek_minimal" class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apabila Ya, berapa jumlah yang memenuhi ?</label>
                                                    <div class="col-sm-5">
                                                        <input type="number" name="berapa_jumlah_komputer_memenuhi" value="<?=$data[0]['berapa_jumlah_komputer_memenuhi']?>"  class="form-control" autocomplete="off" id="berapa_jumlah_komputer_memenuhi" >
                                                    </div>
                                                    <div style="clear:both;">
                                                    </div>
                                                </div>

                                                <?php
                                                    $pelayanan=explode(';',$data[0]['pelayanan']);
                                                ?>

                                                <div class="form-group" id="pelayanan_html" >
                                                    <label  class="col-sm-2 control-label">Pelayanan yang tersedia di Fasyankes ?</label>
                                                    <div class="col-sm-10">
                                                        <div id="pelayanan_html" >
                                                            
                                                            <input type="checkbox" <?=(in_array("Pendaftaran", $pelayanan) ? 'checked' : '') ?> name="pelayanan[]" value="Pendaftaran"   id="pendaftaran"> Pendaftaran<br>
                                                            <input type="checkbox" <?=(in_array("Pelayanan Medik", $pelayanan) ? 'checked' : '') ?> name="pelayanan[]" value="Pelayanan Medik"  id="pelayanan_medik"> Pelayanan Medik<br>
                                                            <input type="checkbox" <?=(in_array("Pelayanan kefarmasian", $pelayanan) ? 'checked' : '') ?> name="pelayanan[]" value="Pelayanan kefarmasian"   id="farmasi"> Pelayanan kefarmasian<br>
                                                            <input type="checkbox" <?=(in_array("Pelayanan laboratorium", $pelayanan) ? 'checked' : '') ?> name="pelayanan[]" value="Pelayanan laboratorium"   id="lab"> Pelayanan laboratorium<br>
                                                            <input type="checkbox" <?=(in_array("Pelayanan radiologi", $pelayanan) ? 'checked' : '') ?> name="pelayanan[]" value="Pelayanan radiologi"   id="farmasi"> Pelayanan radiologi<br>
                                                            <input type="checkbox" <?=(in_array("Pelayanan Rawat Inap", $pelayanan) ? 'checked' : '') ?> name="pelayanan[]" value="Pelayanan Rawat Inap"  id="pelayanan_rawat_inap"> Pelayanan Rawat Inap<br>
                                                            <input type="checkbox" <?=(in_array("Pelayanan Kasir", $pelayanan) ? 'checked' : '') ?> name="pelayanan[]" value="Pelayanan Kasir"  id="pelayanan_kasir"> Pelayanan Kasir<br>
                                                        </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki Printer ?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_printer', dropdown_ya_tidak(), $data[0]['memiliki_printer'],'id="memiliki_printer" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki printer label/ barcode ?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_printer_barcode', dropdown_ya_tidak(), $data[0]['memiliki_printer_barcode'],'id="memiliki_printer_barcode" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="col-sm-2 control-label">Apakah Memiliki Printer Pos ?</label>
                                                    <div class="col-sm-5">
                                                        <?=form_dropdown('memiliki_printer_pos', dropdown_ya_tidak(), $data[0]['memiliki_printer_pos'],'id="memiliki_printer_pos" required class="form-control select2"');?>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>

                                            <!-- /.box-body -->
                                            </div>
                                            <!-- /.box-footer -->
                                            <div class="box-footer">
                                                <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!--/.col (left) -->

                            </div>
                            <!-- /.row -->
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

<script src="<?php echo base_url('assets/js/migrate.js');?>"></script>
