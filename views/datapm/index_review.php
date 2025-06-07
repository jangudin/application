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
                    <li class="active"><a href="<?php echo base_url('pm/index_review');?>">Jawaban Ya/Tidak</a></li>
                    <li><a href="<?php echo base_url('pm/index_review_star');?>" >Jawaban Bintang</a></li>
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
                                                            <label  class="col-sm-2 control-label">Bulan</label>
                                                                <div class="col-sm-5">
                                                                    <?php
                                                                        // var_dump(dropdown_nama_obat());
                                                                    ?>
                                                                    
                                                                <?=form_dropdown('bulan', dropdown_bulan(), $bulan,'id="bulan" class="form-control select2"');?>
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Tahun</label>
                                                                <div class="col-sm-5">
                                                                    <input type="text" name="tahun" value="<?=$tahun;?>"   id="tahun"  class="form-control" autocomplete="off">
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
                            
                            <div class="row">
                                <!-- left column -->
                                <div class="col-md-12" >
                                    <!-- general form elements -->
                                    <div class="box box-primary">
                                        <div class="box-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th style="text-align: center">No</th>
                                                    <th style="text-align: center">Kepuasan Pasien</th>
                                                    <th style="text-align: center">Jumlah Jawab Ya</th>
                                                    <th style="text-align: center">Jumlah Jawab Tidak</th>
                                                </tr>
                                                <?php 
                                                $no=0;
                                                foreach ($review as $key => $value) { 
                                                    $no++;
                                                ?>
                                                
                                                    <tr>
                                                        <td><?=$no?></td>
                                                        <td><?=$value['question_description']?></td>
                                                        <td style="text-align: center"><?=$value['ya']?></td>
                                                        <td style="text-align: center"><?=$value['tidak']?></td>
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
</section>
<script>
    

</script>
