<style>
.divest {
    width: 100%;
    height: auto;
    border: thin solid black;
	overflow-x: scroll;
}
td#nowrap{
 white-space: nowrap;
}
th#nowrap{
 white-space: nowrap;
}
.content {
	min-height: 250px;
	padding: 15px;
	margin-right: auto;
	margin-left: auto;
	padding-left: 15px;
	padding-right: 15px;
}
</style>
			<?php
if($this->session->flashdata('message_name') !=null){
?>
<div class="alert alert-<?=$this->session->flashdata('kode_name');?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4>
                <?=$this->session->flashdata('message_name');?>
              </div>
<?php
}
?>
    <div class="col-xs-15 col-sm-15">
    	<div class="box">
    		<div class="box-content">
		
			    <div id="myTabContent" class="tab-content">
			 <div class="tab-pane fade in active">
	
<section class="content">
      <div class="row">
        <div class="col-xs-12">
			  <h3 class="page-header">TAMBAH MASTER DATA SDM</h3>
 <a href="<?php echo site_url('dashboard/master_data_sdm')?>" ><button class="btn btn-success"><i class="fa fa-fw fa-arrow-left"></i> Kembali</button></a>

      <div class="box box-info">
 
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="POST" action="">
              <div class="box-body">
                <div class="form-group">
				 <label  class="col-sm-2 control-label">JENIS KLINIK</label>
				  <div class="col-sm-5">
				  <input type="hidden" name="id" value="<?=$data[0]['id']?>" >
				  <?=form_dropdown('jenis_klinik', dropdown_jenis_klinik(), $data[0]['jenis_klinik'],'id="jenis_klinik" required class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				 <div class="form-group">
				  <label  class="col-sm-2 control-label">TITLE *</label>
				   <div class="col-sm-5">
                  <input type="text" name="sdm" value="<?=$data[0]['sdm']?>" required class="form-control" autocomplete="off" >
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				<div class="form-group">
				 <label  class="col-sm-2 control-label">AUTHENTIFIKASI</label>
				  <div class="col-sm-5">
				
				 <?=form_dropdown('auth', dropdown_auth(), (!empty($data[0]['auth']) ? $data[0]['auth'] : 'tidak wajib ada'),'id="auth"  class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
				
				<div class="form-group">
				  <label  class="col-sm-2 control-label">KETERANGAN</label>
				   <div class="col-sm-5">
                  <textarea name="keterangan" style="width:100%"><?=$data[0]['keterangan']?></textarea>
				  </div>
				  <div style="clear:both;"></div>
                </div>
             
			 <div class="form-group">
				 <label  class="col-sm-2 control-label">SUB KETERANGAN</label>
				  <div class="col-sm-5">
				
				 <?=form_dropdown('sub_keterangan', dropdown_sub_keterangan(), $data[0]['sub_keterangan'],'id="sub_keterangan"  class="form-control select2"');?>
				  </div>
				  <div style="clear:both;"></div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
			 
			    
                <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>



</div>
</div>
</section>
</div>
</div>
</div>
</div>
</div>

<script>

   $(function() {
	  $('.select2').select2();
	  $('[data-mask]').inputmask();
     $("#datepicker").datepicker({autoclose: true});
   });
   
	
/*     $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo site_url("dashboard/list_user_yang_mendaftar_ajax_server/");?>",
            "data": function ( d ) {
                d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        }
    } ); */

</script>