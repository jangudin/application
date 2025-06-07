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
                    
                    <li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
                    <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li>
                        <li><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>

                        <li  ><a href="<?php echo base_url('pm/inputan_data_gambar_pm');?>">Dokumentasi</a></li>
                        <?php
                       
                        if(!empty($data2[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323){
                          ?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
                        <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        <li class="active" ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                        <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }
                        ?>
                        <li ><a href="<?php echo base_url('pm/selesaikan');?>">Print QR</a></li> 
                   
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
                                                        <label>Permohonan Integrasi PCare BPJS Kesehatan</label>
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Upload File</label>
                                                                <div class="col-sm-5">
                                                                    <input type="file"  name="dokumen_integrasi_pcare"  id="dokumen_integrasi_pcare" >
                                                                    <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_pcare/'.(!empty($pcare[0]['dokumen_integrasi_pcare']) ? $pcare[0]['dokumen_integrasi_pcare'] : ''));?>">
                                                                        <?php echo (!empty($pcare[0]['dokumen_integrasi_pcare']) ? $pcare[0]['dokumen_integrasi_pcare'] : '')?>
                                                                    </a>			  
                                                                    <input type="hidden"  name="old_dokumen_integrasi_pcare"  value="<?=(!empty($pcare[0]['dokumen_integrasi_pcare']) ? $pcare[0]['dokumen_integrasi_pcare'] : '')?>" id="old_dokumen_integrasi_pcare">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Kedeputian BPJS Kesehatan</label>
                                                                <div class="col-sm-5">
                                                                    <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                                                    <?=form_dropdown('kedeputian', dropdown_kedeputian($pcare[0]['kedeputian_id']), (!empty($pcare[0]['kedeputian_id']) ? $pcare[0]['kedeputian_id'] : '1'),'id="kedeputian"  required class="form-control select2"');?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <a target="_blank" href="https://bpjs-kesehatan.go.id/#/layanan-alamat-bpjs-kesehatan?tab=kedeputian-wilayah-i">Sebaran Kedeputian</a>
                            
                                                   
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                       
                                                        <input type="hidden" name="id" value="<?=(!empty($pcare[0]['id']) ? $pcare[0]['id'] : '')?>"   id="id"  >
                                                        <input type="hidden" name="kode_faskes" value="<?=(!empty($data2[0]['kode_faskes']) ? $data2[0]['kode_faskes'] : '')?>"   id="kode_faskes"  >
						                                <input type="hidden" name="nama_faskes" value="<?=(!empty($data[0]['nama_pm']) ? $data[0]['nama_pm'] : '')?>"   id="nama_faskes"  >
						                                <input type="hidden" name="email" value="<?=(!empty($data[0]['email']) ? $data[0]['email'] : '')?>"   id="email"  >
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
    $(function() {
        $('.select2').select2();
        $('[data-mask]').inputmask();
        $("#datepicker").datepicker({autoclose: true});
    });
    
        $('[name="id_prov"]').change(function() {
            $('#id_kota').val('');
                $.ajax({
            url: "<?php echo site_url('dashboard/dropdown4')?>/" + $(this).val(),
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
