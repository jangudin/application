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
                <li class="active"><a href="<?php echo base_url('password');?>">Update password</a></li>
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
                                                <form role="form" action="<?php echo base_url('Password/changepassword/')?>" method="post">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Masukkan Password Lama</label>
                                                                <div class="col-sm-5">
                                                                    <input required type="password" id="lastpasswordfirst" name="lastpasswordfirst" class="form-control form-control-xl" placeholder="Last Password">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Masukkan Password Baru</label>
                                                                <div class="col-sm-5">
                                                                    <input required type="password" id="newpasswordfirst" name="newpasswordfirst" class="form-control form-control-xl" placeholder="New Password">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label  class="col-sm-2 control-label">Ulangi Password Baru</label>
                                                                <div class="col-sm-5">
                                                                    <input required type="password" id="newpasswordsecond" name="newpasswordsecond" class="form-control form-control-xl" placeholder="Confirm Password">
                                                                </div>  
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <input type="hidden" name="id" id="id" value="<?php echo $this->session->userdata('id'); ?>">
                                                        <input type="hidden" name="email" id="email" value="<?php echo $this->session->userdata('email'); ?>">
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
