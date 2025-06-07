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
                            <li class="active"><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                            <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
                            <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                            <li ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                            <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }else{?>
                            <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                            <li class="active" ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                            <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
                            <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                            <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                       <?php }
                        ?>

<?php
                   } elseif ($this->session->userdata('id_kategori_pm') == 6 || $this->session->userdata('id_kategori_pm') == 7) {

                    ?>
                    <li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
                    <!-- <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li> -->
                        <li><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>

                        <li  ><a href="<?php echo base_url('pm/inputan_data_gambar_pm');?>">Dokumentasi</a></li>
                        <?php
                        if(!empty($data2[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323){
                            ?>
                            <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                            <li class="active"><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                            <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
                            <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                            <li ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                            <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }else{?>
                            <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                            <li class="active" ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                            <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
                            <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
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
                                                    <input type="hidden" name="data_rme_id" value="<?= $rme[0]['id']; ?>" id="data_rme_id">
                                                    <?php
                                                        if($rme[0]['status'] == 0){
                                                            $rme_status = 0;
                                                            $label_vendor_1 = "Rencana Pengembang/Penyedia RME";
                                                            $label_vendor_2 = "Sebutkan nama rencana pengembang/penyedia";
                                                        } else if ($rme[0]['status'] == 1) {
                                                            $rme_status = 1;
                                                            $label_vendor_1 = "Pengembang/Penyedia RME";
                                                            $label_vendor_2 = "Sebutkan nama pengembang/penyedia";
                                                        } else {
                                                            $rme_status = '';
                                                            $label_vendor_1 = "Rencana Pengembang/Penyedia RME";
                                                            $label_vendor_2 = "Sebutkan nama rencana pengembang/penyedia";
                                                        }
                                                    ?>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Apakah sudah memiliki RME?</label>
                                                                <div class="col-sm-5">
                                                                    <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                                                    <?=form_dropdown('rme', dropdown_rme(), $rme_status,'id="rme" required class="form-control select2"');?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label" id="label1"><?php echo $label_vendor_1; ?></label>
                                                                <div class="col-sm-5">
                                                                    <?=form_dropdown('jenis_vendor', dropdown_jenis_vendor_rme(), (!empty($rme[0]['jenis_vendor_id']) ? $rme[0]['jenis_vendor_id'] : ''),'id="jenis_vendor" required class="form-control select2"');?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label" id="label2"><?php echo $label_vendor_2; ?></label>
                                                                <div class="col-sm-5">
                                                                    <!-- <input type="text" name="nama_vendor" value="<?=(!empty($rme[0]['vendor']) ? $rme[0]['vendor'] : '')?>"   id="nama_vendor"  class="form-control" autocomplete="off"> -->
                                                                    <?=form_dropdown('sim_pengembang_id', dropdown_sim_pengembang(), (!empty($rme[0]['sim_pengembang_id']) ? $rme[0]['sim_pengembang_id'] : ''),'id="sim_pengembang_id" class="form-control select2"');?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        if((!empty($rme[0]['sim_pengembang_id'])? $rme[0]['sim_pengembang_id'] : '') == 1){
                                                            $style2 = "block";
                                                        } else {
                                                            $style2 = "none";
                                                        }
                                                    ?>
                                                    <div class="box-body" id="lain_lain" style="display: <?=$style2;?>;">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Nama pengembang/penyedia Lainnya</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="nama_vendor" value="<?=(!empty($rme[0]['vendor']) ? $rme[0]['vendor'] : '')?>"   id="nama_vendor"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        if((!empty($rme[0]['status'])? $rme[0]['status'] : '') == 1){
                                                            $style = "block";
                                                            $style2 = "none";
                                                            $required_style2= "none";
                                                        } else {
                                                            $style = "none";
                                                            $style2 = "block";
                                                            $required_style2= "block";
                                                        }
                                                    ?>
                                                    <!-- <div class="box-body" id="satset" style="display: <?=$style;?>;"> -->
                                                    <div class="box-body" id="satset" style="display: none;">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">ID Satu Sehat</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="id_satu_sehat" value="<?=(!empty($rme[0]['id_satu_sehat']) ? $rme[0]['id_satu_sehat'] : '')?>"   id="id_satu_sehat"  class="form-control" autocomplete="off">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>

                                                    <div class="box-body" id="style_status_internet_id" style="display: <?=$style2;?>;">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label" id="label1">Status Internet</label>
                                                                <div class="col-sm-5">
                                                                    <?=form_dropdown('status_internet_id', dropdown_status_internet(), (!empty($rme[0]['status_internet_id']) ? $rme[0]['status_internet_id'] : ''),'id="status_internet_id" class="form-control select2" style="width:100%"');?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>

                                                    <div class="box-body" id="style_status_sdm_it_id" style="display: <?=$style2;?>;">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label" id="label1">Status SDM IT</label>
                                                                <div class="col-sm-5">
                                                                    <?=form_dropdown('status_sdm_it_id', dropdown_status_sdm_it(), (!empty($rme[0]['status_sdm_it_id']) ? $rme[0]['status_sdm_it_id'] : ''),'id="status_sdm_it_id" class="form-control select2" style="width:100%"');?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    


                                                    <?php
                                                        if($rme_status == 1){
                                                            if((!empty($rme[0]['sim_pengembang_id'])? $rme[0]['sim_pengembang_id'] : '') == 1){
                                                                $style_permohonan_satset = "none";
                                                                $required_satset = '';
                                                            } else {
                                                                $style_permohonan_satset = "block";
                                                                $required_satset = 'required';
                                                            }
                                                        } else {
                                                            $style_permohonan_satset = "none";
                                                            $required_satset = '';
                                                        }

                                                        if($rme_status == 1){
                                                            
                                                            $style_link_asri = "none";
                                                        } else {
                                                            if((!empty($rme[0]['sim_pengembang_id'])? $rme[0]['sim_pengembang_id'] : '') == 323){
                                                                $style_link_asri = "block";
                                                            } else {
                                                                $style_link_asri = "none";
                                                            }
                                                        }
                                                    ?>
                                                    <div class="box-body" id="permohonan_satset" style="display: <?=$style_permohonan_satset;?>;">
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 control-label">
                                                                <b><h3>Permohonan Kode API Partner Interoperabilitas SATUSEHAT</h3></b>
                                                                <b><h2>Silahkan membaca ketentuan dibawah ini sebelum Submit </h2></b>
                                                            </label>
                                                                <div class="col-sm-12">
                                                                    <textarea name="narasi" id="narasi" class="form-control" rows="15" readonly style="background-color : #fff">

                                                                        Permohonan ini dimaksudkan untuk Fasilitas Pelayanan Kesehatan mendapatkan Akses Kode Application Programming Interface (API) 
                                                                        untuk kebutuhan integrasi sistem Rekam Medis Elektronik dengan SATUSEHAT Platform.

                                                                                        1.	Telah membaca, memahami, serta menyetujui Ketentuan Umum dan Kebijakan Privasi SATUSEHAT.
                                                                                        2.	Mematuhi ketentuan hukum mengenai perlindungan data pribadi dan kesehatan sesuai ketentuan 
                                                                                                peraturan perundang-undangan.
                                                                                        3.	Menyetujui untuk melakukan upaya terbaik dalam rangka memastikan kerahasiaan, integritas, 
                                                                                                dan ketersediaan data.
                                                                                        4.	Bersedia untuk mematuhi dan melaksanakan panduan, pemberitahuan, standar dan setiap instruksi 
                                                                                                sehubungan dengan penggunaan SATUSEHAT.
                                                                                        5.	Menyatakan dan mengajukan permohonan Akses Kode API SATUSEHAT untuk integrasi SATUSEHAT.
                                                                                        6.	Memiliki dokumen Bukti Kerjasama/MOU/Surat Perjanjian Kerjasama/Kontrak Kerjasama dengan 
                                                                                                Pengembang RME (vendor).
                                                                                        7.	Saya mengizinkan Pengembang RME (vendor) mengakses Kode API SATUSEHAT.
                                                                                        8.	Bahwa seluruh informasi yang saya sampaikan adalah benar dan saya memiliki wewenang melakukan 
                                                                                                permohonan ini.

                                                                    </textarea>
                                                                </div>  
                                                                <div class="col-sm-7">
                                                                    <input class="form-check-input" type="checkbox" name="persetujuan_ketentuan_satset_id" <?=$required_satset;?> value="1"  id="persetujuan_ketentuan_satset_id" <?=(!empty($rme[0]['persetujuan_ketentuan_satset_id']) ? 'checked' : '')?>> <h5 style="display: inline;"> Ya, Saya telah memahami daftar ketentuan permohohan diatas</h5>
                                                                </div>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>

                                                    <div class="box-body" id="link_asri" style="display: <?=$style_link_asri;?>;">
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 control-label">
                                                                <b><h3>Silahkan mendaftar sebagai pengguna ASRI di link berikut ini</h3></b>
                                                                <!-- <b><a href="https://link.kemkes.go.id/PengajuanASRI" target="_blank"><h2>Link Pendaftaran ASRI</h2></a></b> -->
                                                                <b><a href="<?='https://asri.kemkes.go.id/tnc?kode_faskes='.$this->secure2->encrypt($data2[0]['kode_faskes'])?>" ><h2>Link Pendaftaran ASRI</h2></a></b>
                                                                
                                                            </label>
                                                                
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <input type="hidden" name="id" value="<?=(!empty($rme[0]['id']) ? $rme[0]['id'] : '')?>"   id="id"  >
						                                <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                                        <button type="submit" name="submit" id="submit"  class="btn btn-primary" >Submit</button>

                                                        <?php 
                                                        // var_dump($odelia[0]['kode_faskes']);
                                                        if(!empty($odelia[0]['kode_faskes'])){ ?>
                                                        <button  class="btn btn-secondary" ><a  href="<?php echo base_url('pm/api_odelia');?>" class="text-ligh">Kirim Ulang Odelia</a></button>
                                                        <?php }?>
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

    $('#rme').on('change', function(e) {
        if ($(this).val() == 1) {
            // document.getElementById("keterangan").style.display = "block";
            $("#sim_pengembang_id").attr('required', ''); //turns required on
            // document.getElementById("satset").style.display = "block";
            
            $('#label1').text("Pengembang/Penyedia RME");
            $('#label2').text("Sebutkan nama pengembang/penyedia");

            // alert($('#sim_pengembang_id').val());
            if($('#sim_pengembang_id').val() != 1){
                document.getElementById("permohonan_satset").style.display = "block";
                $("#persetujuan_ketentuan_satset_id").attr('required', ''); //turns required on
            } else {
                document.getElementById("permohonan_satset").style.display = "none";
                $("#persetujuan_ketentuan_satset_id").removeAttr('required'); //turns required off
            }

            document.getElementById("link_asri").style.display = "none";

            document.getElementById("style_status_internet_id").style.display = "none";
            $("#status_internet_id").removeAttr('required'); //turns required off

            document.getElementById("style_status_sdm_it_id").style.display = "none";
            $("#status_sdm_it_id").removeAttr('required'); //turns required off

        } else if ($(this).val() == 0) {
            $("#keterangan").val("")
            document.getElementById("satset").style.display = "none";
            $("#sim_pengembang_id").removeAttr('required'); //turns required off
            $('#label1').text("Rencana Pengembang/Penyedia RME");
            $('#label2').text("Sebutkan nama rencana pengembang/penyedia");
            document.getElementById("satset").style.display = "none";

            document.getElementById("permohonan_satset").style.display = "none";
            $("#persetujuan_ketentuan_satset_id").removeAttr('required'); //turns required off

            if($('#sim_pengembang_id').val() == 323){
                document.getElementById("link_asri").style.display = "block";
            } else {
                document.getElementById("link_asri").style.display = "none";
            }

            document.getElementById("style_status_internet_id").style.display = "block";
            $("#status_internet_id").attr('required', ''); //turns required on

            document.getElementById("style_status_sdm_it_id").style.display = "block";
            $("#style_status_sdm_it_id").attr('required', ''); //turns required on
        }
    });

    $('#sim_pengembang_id').on('change', function(e) {
        if ($(this).val() == 1) {
            $("#nama_vendor").attr('required', ''); //turns required on
            document.getElementById("lain_lain").style.display = "block";

            document.getElementById("permohonan_satset").style.display = "none";
            $("#persetujuan_ketentuan_satset_id").removeAttr('required'); //turns required off
        } else {
            document.getElementById("lain_lain").style.display = "none";
            $("#nama_vendor").removeAttr('required'); //turns required off
            $('#nama_vendor').val("");

            // alert($('#rme').val());
            if($('#rme').val() == 1){
                document.getElementById("permohonan_satset").style.display = "block";
                $("#persetujuan_ketentuan_satset_id").attr('required', ''); //turns required on
            } else {
                document.getElementById("permohonan_satset").style.display = "none";
                $("#persetujuan_ketentuan_satset_id").removeAttr('required'); //turns required off

                if($(this).val() == 323){
                    document.getElementById("link_asri").style.display = "block";
                } else {
                    document.getElementById("link_asri").style.display = "none";
                }
            }

            
        }
    });

    $(document).ready(function(){
        //Cek NIK
        $("#nik").click(function(){

            if($('#no_ktp').val() == null || $('#no_ktp').val() == ""){
            alert('Silahkan isi No KTP / NIK terlebih dahulu'
            );		
            } else {
            console.log('sedang di cek');
            var nik=$('#no_ktp').val();
                //alert (nik);
                $.ajax({
                type  : 'GET', 
                url : "<?php echo site_url('pm/alamatnik')?>" ,
                data  : "id="+nik,
                dataType : 'json',
                cache : false,
                success : function(response){
                    if(response.status == 200){
                        alert('NIK telah terdaftar di SISDMK \natas nama ' 
                            + response.data.nama
                        );
                        console.log(response);
                        window.location.href = 'http://perizinan.yankes.kemkes.go.id/regismix/pm/generateSisdmkByUser/' + nik;
                    } else {
                    alert('NIK tidak terdaftar di SISDMK, silahkan input data di SISDMK atau cek kembali NIK');
                    console.log(response);
                    }
                    }
                });
            }

        });
    })

</script>
