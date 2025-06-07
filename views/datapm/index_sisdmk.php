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
						if(!empty($data[0]['kode_faskes'])){
                          ?>
                        <li class="active"><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <li  ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
			<li ><a href="<?php echo base_url('pm/satu_sehat');?>">Satu Sehat</a></li>
			<li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }
                        ?>

                    <?php } elseif( $this->session->userdata('id_kategori_pm') == 6 ) { ?>
                        <li><a href="<?php echo base_url('pm/inputan_data_pm'); ?>">Registrasi</a></li>
           
           <li><a href="<?php echo base_url('pm/inputan_data_gambar_pm'); ?>">Dokumentasi</a></li>
           
          <?php if (!empty($data[0]['kode_faskes'])) { ?>
            <li ><a href="<?php echo base_url('pm/index_data_sisdmk'); ?>">List SDM</a></li>
           
          <?php }?>

                        <?php } ?>
                        <li  ><a href="<?php echo base_url('pm/selesaikan');?>">Print QR</a></li> 
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <!-- Main content -->
                            <section class="content">
                                <?php
                                    if(!empty($data2[0]['final']) == '1' && (!empty($data2[0]['kode_faskes']) == '' || $data2[0]['kode_faskes'] == NULL ) ){
                                        echo 'Data Registrasi Praktik Mandiri sedang diverifikasi'; 
                                    } else {
                                ?>
                                <?php
                                    if(!empty($user[0]['id_kategori'])){
                                ?>
                                    <?php
                                    if(empty($sisdmk)){
                                    ?>
                                        <div class="row">
                                            <!-- left column -->
                                            <div class="col-md-12" >
                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    Silahkan update NIK anda di menu data dasar sesuai yang terdaftar di SISDMK, kemudian klik tombol CEK
                                                    <br><a class="btn btn-danger" name="nik" id="nik">Cek NIK</a><input type="hidden" name="no_ktp" id="no_ktp" class="form-control" value="<?=(empty($getdatapm[0]['no_ktp']) ? $user[0]['no_ktp'] : $getdatapm[0]['no_ktp'])?>">
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    <?php
                                    } else {
                                    ?>
                                        <div class="row">
                                            <!-- left column -->
                                            <div class="col-md-12" >
                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <h3>Biodata</h3>
                                                    <table class="table table-bordered">
			                                            <tbody>
                                                            <tr>
                                                                <td><b>NIK :</b></td>
                                                                <td><?=$data_sisdmk[0]['NIK']?></td>
                                                            <tr>
                                                            <tr>
                                                                <td><b>NAMA :</b></td>
                                                                <td><?=$data_sisdmk[0]['NAMA']?></td>
                                                            <tr>
                                                            <tr>
                                                                <td><b>JENIS KELAMIN (L/P):</b></td>
                                                                <td><?=$data_sisdmk[0]['JENIS_KELAMIN']?></td>
                                                            <tr>
                                                            <tr>
                                                                <td><b>TEMPAT LAHIR :</b></td>
                                                                <td><?=$data_sisdmk[0]['TEMPAT_LAHIR']?></td>
                                                            <tr>
                                                            <tr>
                                                                <td><b>TANGGAL LAHIR :</b></td>
                                                                <td><?=$data_sisdmk[0]['TANGGAL_LAHIR']?></td>
                                                            <tr>
                                                            <tr>
                                                                <td><b>PROVINSI :</b></td>
                                                                <td><?=$data_sisdmk[0]['NAMA_PROV']?></td>
                                                            <tr>
                                                            <tr>
                                                                <td><b>KAB/KOTA :</b></td>
                                                                <td><?=$data_sisdmk[0]['NAMA_KAB']?></td>
                                                            <tr>
                                                            <tr>
                                                                <td><b>ALAMAT :</b></td>
                                                                <td><?=$data_sisdmk[0]['ALAMAT']?></td>
                                                            <tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- left column -->
                                            <div class="col-md-12" >
                                                <!-- general form elements -->
                                                <div class="box box-primary">
                                                    <form role="form" method="POST" action="" enctype='multipart/form-data'>
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label  class="col-sm-2 control-label">Email</label>
                                                                    <div class="col-sm-5">
                                                                        <input type="hidden" name="id_sisdmk" value="<?=$data_sisdmk[0]['id']?>"   id="id_faskes"  >
                                                                        <input type="text" name="email" value="<?=$data_sisdmk[0]['email']?>"   id="email"  >
                                                                    </div>  
                                                                <div style="clear:both;"></div>
                                                            </div>
                                                        </div>
                                                        <!-- /.box-body -->
                                                        <div class="box-footer">
                                                            <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button>
                                                            <!-- <a class="btn btn-danger" name="nik" id="nik">Update Email</a> -->
                                                            <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Buka Modal</button> -->
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- left column -->
                                            <div class="col-md-12" >
                                                <!-- general form elements -->
                                                <div class="box box-warning">
                                                    <h3>Pendidikan</h3>
                                                    <table class="table table-bordered">
			                                            <tbody>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Program Studi</th>
                                                                <th>Jenjang</th>	 
                                                                <th>Nama Perguruan Tinggi</th>
                                                                <th>Tahun Lulus</th>
                                                                <th>Nomor Ijazah</th>
                                                            </tr>
                                                            <?php
                                                                $no=0;
                                                                foreach($pendidikan as $value){
                                                                $no++;
                                                            ?>
                                                            <tr>
                                                                <td><?=$no?></td>
                                                                <td><?=$value['PRODI']?></td>
                                                                <td><?=$value['JENJANG']?></td>
                                                                <td><?=$value['PERGURUAN_TINGGI']?></td>
                                                                <td><?=$value['TAHUN_LULUS']?></td>
                                                                <td><?=$value['NO_IJAZAH']?></td>
                                                            </tr>
                                                            <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- left column -->
                                            <div class="col-md-12" >
                                                <!-- general form elements -->
                                                <div class="box box-success">
                                                    <h3>Pekerjaan</h3>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" >
                                                            <tbody>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Unit</th>
                                                                    <th>Provinsi</th>	 
                                                                    <th>Kab/Kota</th>
                                                                    <th>Alamat</th>
                                                                    <th>Jenis SDMK</th>
                                                                    <th>Status</th>
                                                                    <th>NIP</th>	 
                                                                    <th>Tanggal Mulai</th>
                                                                    <!-- <th>Tanggal Akhir</th> -->
                                                                    <th>STR</th>
                                                                    <th>Tanggal STR</th>
                                                                    <th>Tanggal Akhir STR</th>
                                                                    <th>SIP</th>
                                                                    <th>Tanggal SIP</th>
                                                                </tr>
                                                                <?php
                                                                    $no=0;
                                                                    foreach($pekerjaan as $value2){
                                                                    $no++;
                                                                ?>
                                                                <tr>
                                                                    <td><?=$no?></td>
                                                                    <td><?=$value2['UNIT']?></td>
                                                                    <td><?=$value2['PROVINSI']?></td>
                                                                    <td><?=$value2['KABKOT']?></td>
                                                                    <td><?=$value2['ALAMAT']?></td>
                                                                    <td><?=$value2['JENIS_SDMK']?></td>
                                                                    <td><?=$value2['STATUS']?></td>
                                                                    <td><?=$value2['NIP']?></td>
                                                                    <td><?=$value2['TANGGAL_MULAI']?></td>
                                                                    <!-- <td><?=$value2['TANGGAL_AKHIR']?></td> -->
                                                                    <td><?=$value2['STR']?></td>
                                                                    <td><?=$value2['TANGGAL_STR']?></td>
                                                                    <td><?=$value2['TANGGAL_AKHIR_STR']?></td>
                                                                    <td><?=$value2['SIP']?></td>
                                                                    <td><?=$value2['TANGGAL_SIP']?></td>
                                                                </tr>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->

                                        
                                    <?php
                                    }
                                    ?>
                                    
                                <?php
                                    }else{
                                        echo 'Harap Selesaikan Data Praktik Mandiri Terlebih Dahulu';  
                                    }
                                ?>
                                <?php
                                }
                                ?>
                            </section>
                            <!-- /.content -->
                        </div>
                        <!-- </div> -->
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
