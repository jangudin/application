<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                    <?php
                    if ($this->session->userdata('id_kategori_pm') == 4 || $this->session->userdata('id_kategori_pm') == 5 ) {

                    ?>
                    <li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
                    <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li>
                        <li><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>

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
                        <li class="active" ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        <li ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                        <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }else{?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
                        <li class="active" ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        
                        <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                       <?php }
                        ?>

<?php
                    } elseif ( $this->session->userdata('id_kategori_pm') == 6 || $this->session->userdata('id_kategori_pm') == 7) {

                    ?>
                    <li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
                    <!-- <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li> -->
                        <li><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>

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
                        <li class="active" ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        <li ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                        <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }else{?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
                        <li class="active" ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        
                        <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                       <?php }
                        ?>

                       
                    <!--
                    <li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Data Dasar</a></li>
                    <li ><a href="<?php echo base_url('pm/inputan_data_sarpras_alkes_pm');?>" >Data Bangunan & Sarpras</a></li>
                    <li ><a href="<?php echo base_url('pm/inputan_data_sdm');?>">Data SDM</a></li>
                    <li  ><a href="<?php echo base_url('pm/inputan_data_gambar_pm');?>">Data Gambar</a></li>
			        <li  class="active"><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                    <li  ><a href="<?php echo base_url('pm/selesaikan');?>">Final</a></li> 
-->
                   
                    <?php
                    } ?>
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
                                                    
                                                    <!-- <div class="box-body" id="satset" style="display: <?=$style;?>;"> -->
                                                    <div class="box-body" id="">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Organization ID</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="organization_id" value="<?=(!empty($satu_sehat[0]['organization_id']) ? $satu_sehat[0]['organization_id'] : '')?>"   id="organization_id"  class="form-control" autocomplete="off" disabled>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body" id="">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Client ID</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="client_id" value="<?=(!empty($satu_sehat[0]['client_id']) ? str_replace('"', '', $satu_sehat[0]['client_id']) : '')?>"   id="client_id"  class="form-control" autocomplete="off" disabled>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body" id="">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Client Secret</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="secret_key" value="<?=(!empty($satu_sehat[0]['secret_key']) ? str_replace('"', '', $satu_sehat[0]['secret_key']) : '')?>"   id="secret_key"  class="form-control" autocomplete="off" disabled>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                   
                                                    <!-- /.box-body -->
                                                    <!-- <div class="box-footer">
                                                        <input type="hidden" name="id" value="<?=(!empty($rme[0]['id']) ? $rme[0]['id'] : '')?>"   id="id"  >
						                                <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                                        <button type="submit" name="submit" id="submit"  class="btn btn-primary" >Submit</button>
                                                    </div> -->
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
