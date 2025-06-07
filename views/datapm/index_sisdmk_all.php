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
						if(!empty($data[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323){
                            ?>
                        <li class="active"><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
              <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        <li ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                        <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }else{?>
                        <li class="active"><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                        <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
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
						if(!empty($data[0]['kode_faskes']) && !empty($satu_sehat[0]['organization_id']) && $rme[0]['sim_pengembang_id'] == 323){
                            ?>
                        <li class="active"><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                         <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
              <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        <li ><a href="<?php echo base_url('pm/pcare');?>">PCare</a></li>
                        <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                        <?php
                        }else{?>
                        <li class="active"><a href="<?php echo base_url('pm/index_data_sisdmk');?>">List SDM</a></li>
                         <?php if(!empty($data3[0]['kode_faskes'])){ ?>
                              <li ><a href="<?php echo base_url('pm/index_data_rme');?>">RME</a></li>
                        <?php }else{

                        } ?>
                        <li ><a href="<?php echo base_url('pm/kontak_satu_sehat');?>">Kontak SATUSEHAT</a></li>
              <li ><a href="<?php echo base_url('pm/satu_sehat');?>">Kode Akses API</a></li>
                        <li><a href="<?php echo base_url('pm/pic_faskes');?>">Penanggung Jawab Faskes</a></li>
                       <?php }
                        ?>

                        <?php } ?>
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
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">NIK</label>
                                                                <div class="col-sm-5">
                                                                    <input type="hidden" name="id_faskes" value="<?=$this->session->userdata('user_id')?>"   id="id_faskes"  >
                                                                    <input type="text" name="no_ktp" value=""   id="no_ktp"  >
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <!-- <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button> -->
                                                        <a class="btn btn-danger" name="nik" id="nik">Cek NIK</a>
                                                        <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Buka Modal</button> -->
                                                    </div>
                                                </form>
                                                <?php
                                            }else{
                                                echo 'Harap Selesaikan Data Praktik Mandiri Terlebih Dahulu';  
                                            }
                                                ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
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
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Tenaga Kesehatan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                                <?php 
                                                $no=0;
                                                foreach ($data_sisdmk as $key => $value) { 
                                                    $no++;
                                                ?>
                                                
                                                    <tr>
                                                        <td><?=$no?></td>
                                                        <td><?=$value['NAMA']?></td>
                                                        <td>
                                                            
                                                            <a href="<?php echo base_url('pm/hapus_data_sisdmk/'.$value['id']);?>" class="btn btn-danger">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?> 

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

    <!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Pilih Unit Praktik Mandiri</h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
					<!-- <p>bagian body modal.</p> -->
                    <select name="unit" class="form-control"   id="unit">
                    </select>
				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" id="kirim">Submit</button>
				</div>
			</div>
		</div>
	</div>

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
                        // $('#myModal').show();
                         // show Modal
                        
                        if(response.data.pekerjaan == null){
                            alert('Data pekerjaan unit Praktik Mandiri tidak ditemukan di SISDMK');
                        } else {

                            $.each(response.data.pekerjaan, function(key, value){
                                // here you can access all the properties just by typing either value.propertyName or value["propertyName"]
                                // example: value.ri_idx; value.ri_startDate; value.ri_endDate;
                                // console.log(value.KODE_UNIT);

                                var o = new Option(value.UNIT, value.KODE_UNIT);
                                /// jquerify the DOM object 'o' so we can use the html method
                                $(o).html(value.UNIT);
                                $("#unit").append(o);
                            });
                            $('#myModal').modal('show');
                        }
                        
                        //window.location.href = 'https://registrasifasyankes.kemkes.go.id/pm/generateSisdmkByUser/' + nik;
                    } else {
                    alert('NIK tidak terdaftar di SISDMK yang bekerja di unit Praktik Mandiri, silahkan input data di SISDMK atau cek kembali NIK');
                    console.log(response);
                    }
                    }
                });
            }

        });

        
        $("#kirim").click(function(){
            var nik=$('#no_ktp').val();
            var unit=$('#unit').val();
            unit = unit.replace(/\s+/g, '');
            // alert(unit);
            window.location.href = 'https://registrasifasyankes.kemkes.go.id/pm/generateSisdmkByUser/' + nik + "-" + unit;
        });

    })

</script>
