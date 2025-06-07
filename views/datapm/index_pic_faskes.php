<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- Main content -->
<section class="content">
<?php if(!empty($data4[0]['kode_faskes'])){ ?>
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
                    if ($this->session->userdata('id_kategori_pm') == 4 || $this->session->userdata('id_kategori_pm') == 5) {

                    ?>
                    <li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
                    <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li>
                        <li><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>

                        <li  ><a href="<?php echo base_url('pm/inputan_data_gambar_pm');?>">Dokumentasi</a></li>
                        <?php
                        if(!empty($data2[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323){
                            ?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <?php if(!empty($data4[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
              <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        <li ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                        <li class="active"><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }else{?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <?php if(!empty($data4[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
              <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        
                        <li class="active" ><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                       <?php }
                        ?>

<?php
                    } elseif ($this->session->userdata('id_kategori_pm') == 6|| $this->session->userdata('id_kategori_pm') == 7) {

                    ?>
                    <li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
                    <!-- <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li> -->
                        <li><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>

                        <li  ><a href="<?php echo base_url('pm/inputan_data_gambar_pm');?>">Dokumentasi</a></li>
                        <?php
                        if(!empty($data2[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323){
                            ?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <?php if(!empty($data4[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
              <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        <li ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                        <li class="active"><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }else{?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <?php if(!empty($data4[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
              <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        
                        <li class="active" ><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
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
                                                    
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Nama PJ</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="nama" value="<?=(!empty($data3[0]['nama']) ? $data3[0]['nama'] : '')?>" required id="nama"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">NIK PJ</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="nik" value="<?=(!empty($data3[0]['nik']) ? $data3[0]['nik'] : '')?>"   id="nik"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Email PJ</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="email" value="<?=(!empty($data3[0]['email']) ? $data3[0]['email'] : '')?>" required id="email"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Nomor telfon/WA PJ</label>
                                                                <div class="col-sm-5">
                                                                <input type="text" name="telp"  value="<?=(!empty($data3[0]['telp']) ? $data3[0]['telp'] : '')?>"  class="form-control" required autocomplete="off"  >
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>

                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Nomor STR PJ</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="no_str" value="<?=(!empty($data3[0]['no_str']) ? $data3[0]['no_str'] : '')?>"   id="no_str"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>

                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Role</label>
                                                                <div class="col-sm-5">
                                                                    <?=form_dropdown('jabatan_id', dropdown_role_pj(), (!empty($data3[0]['jabatan_id']) ? $data3[0]['jabatan_id'] : ''),'id="jabatan_id" class="form-control select2"');?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <input type="hidden" name="id" value="<?=(!empty($data3[0]['id']) ? $data3[0]['id'] : '')?>"   id="id"  >
                                                        <input type="hidden" name="kode_faskes" value="<?=(!empty($data2[0]['kode_faskes']) ? $data2[0]['kode_faskes'] : '')?>"   id="kode_faskes"  >
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
