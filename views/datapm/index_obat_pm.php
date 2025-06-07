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
                        <li  ><a href="<?php echo base_url('pm/inputan_data_pm');?>">Registrasi</a></li>
                        <li><a href="<?php echo base_url('pm/inputan_data_alkes_obat_pm');?>" >Alkes</a></li>
                        <li class="active"><a href="<?php echo base_url('pm/inputan_data_obat_pm');?>" >Obat</a></li>
                        <li  ><a href="<?php echo base_url('pm/inputan_data_gambar_pm');?>">Dokumentasi</a></li>
<?php
						if(!empty($data2[0]['kode_faskes'])){
                          ?>
                        <li ><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                         <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <?php
                        }
                        ?>
                        <li  ><a href="<?php echo base_url('pm/selesaikan');?>">Print QR</a></li> 
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
                                            <?php
                                                if(!empty($data2[0]['final']) == '1' && (!empty($data2[0]['kode_faskes']) == '' || $data2[0]['kode_faskes'] == NULL ) ){
                                                echo 'Data Registrasi Praktik Mandiri sedang diverifikasi'; 
                                            } else {
                                            ?>

                                            <?php
                                                if(!empty($user[0]['id_kategori'])){
                                            ?>
                                            <!-- /.box-header -->
                                            <!-- form start -->
                                            <form role="form" method="POST" action="" enctype='multipart/form-data'>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th>No</th>
                                                            <!-- <th>Tipe</th> -->
                                                            <th>Nama Obat</th>	 
                                                            <th>Ada</th>
                                                            <th>No Batch </th>
                                                            <th>Nama Perusahaan</th>
                                                            <th>Sumber Pembelian (apotek/toko obat)</th>
                                                            <th>Keterangan Tambahan</th>
                                                        </tr>
                                                        <?php
                                                            $no=0;
                                                            foreach(dropdown_obat_pm($user[0]['id_kategori']) as $key => $value){
                                                            $no++;

                                                        ?>
                                                        <tr>
                                                            <td><?=$no;?></td>
                                                            <td><?=$value?></td>

                                                            <?php
                                                            if(!empty($data)){
                                                                foreach($data as $key2 => $value2){
                                                                    if($value2['id_obat'] ==$key){
                                                            ?>
                                                                        <td>
                                                                            <input type="checkbox" name="is_checked[<?=$key;?>]"  <?php foreach(dropdown_obat_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? 'required' : '');  }?> <?=($value2['is_checked']=='1' ? 'checked' : '')?>   value="1">
                                                                            </br>
                                                                            <?php foreach(dropdown_obat_pm_label_nilai_satu($key) as $key3 => $label_nilai_satu){ echo $label_nilai_satu;  }?>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" name="nilai_dua[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="<?=$value2['nilai_dua']?>">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" name="nilai_tiga[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="<?=$value2['nilai_tiga']?>">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" name="nilai_empat[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="<?=$value2['nilai_empat']?>">
                                                                        </td>
                                                                        <td>
                                                                            <?php foreach(dropdown_obat_pm_keterangan($key) as $key5 => $keterangan){ 
                                                                                echo $keterangan;  
                                                                                }
                                                                                ?>
                                                                        </td>
                                                            <?php
                                                                    } else {

                                                                    }
                                                                }	
                                                            }else{
                                                            ?>
                                                                        <td>
                                                                            <input type="checkbox" name="is_checked[<?=$key;?>]"  <?php foreach(dropdown_obat_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? 'required' : '');  }?> value="1">
                                                                            </br>
                                                                            <?php foreach(dropdown_obat_pm_label_nilai_satu($key) as $key3 => $label_nilai_satu){ echo $label_nilai_satu;  }?>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" name="nilai_dua[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" name="nilai_tiga[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" name="nilai_empat[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="">
                                                                        </td>
                                                                        <td>
                                                                            <?php foreach(dropdown_obat_pm_keterangan($key) as $key5 => $keterangan){ 
                                                                                echo $keterangan;  
                                                                                }
                                                                                ?>
                                                                        </td>
                                                            

                                                            <?php
                                                            }
                                                            ?>
                                                            <input type="hidden" name="id_obat[]" value="<?=$key;?>">
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                        
                                                        
                                                    </tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td> 
                                                        <input type="hidden" name="id_faskes" value="<?=$user_id;?>">
                                                        <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button></td>
                                                    </tr>
                                                </table>
                                            </form>
                                            <?php
                                            }else{
                                                echo 'Harap Selesaikan Data Praktik Mandiri Terlebih Dahulu';  
                                            }
                                            ?>
                                        </div>
                                        <!-- /.box -->
                                        <?php
                                        }
                                        ?>
                                    
                                    </div>
                                    <!--/.col (left) -->

                                    <!--/.col (right) -->
                                </div>
                                <!-- /.row -->
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
