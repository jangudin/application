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
                                        <div class="box-body">
                                            <!-- <div class="row gallery">
                                            <?php foreach ($img as $key => $valueuu) { ?>
                                                    <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">

                                                        <h6 style="text-align: center;"><?=$valueuu['gambar']?></h6>
                                                        <a href="" data-bs-toggle="modal" data-bs-target="#galleryModal<?=$valueuu['id']?>">
                                                            <img class="w-100 active" src="<?=$valueuu['url_full']?>">
                                                        </a>
                                                        <br><br>
                                                            <a href="" data-bs-toggle="modal" data-bs-target="#galleryModal2<?=$valueuu['id']?>" class="btn btn-success">Edit</a>
                                                            <a href="" data-bs-toggle="modal" data-bs-target="#galleryModal3<?=$valueuu['id']?>" class="btn btn-danger">Hapus</a>
                                            </div>
                                            <?php } ?>  -->
                                            <table class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Pertanyaan</th>
                                                    <th>Deskripsi</th>
                                                    <th>Jawaban</th>
                                                    <th>Tanggal Dibuat</th>
                                                </tr>
                                                
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
