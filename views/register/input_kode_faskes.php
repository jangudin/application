   <div class="nav-tabs-custom">
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
  
    <!-- Main content -->
    <section class="content">
	 <a href="<?php echo site_url('admin/index')?>" ><button class="btn btn-success"><i class="fa fa-fw fa-arrow-left"></i> Back</button></a>
	<br><br>
      <div class="row">
        <!-- left column -->
        <div class="col-md-12" >
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">KIRIM INM</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="">
              <div class="box-body">
			  
			  <div class="form-group">
				  <label  class="col-sm-2 control-label">KLINIK</label>
				   <div class="col-sm-5">
				   <select name="jenis_kategori">
					<option value="klinik">Klinik</option>
					<option value="pm">PM</option>
					<option value="lab">Labkes</option>
					<option value="utd">UTD</option>
					<option value="rs">RS</option>
				   </select>
                  
				  </div>
				  <div style="clear:both;"></div>
                </div>
			 
				 <div class="form-group">
				  <label  class="col-sm-2 control-label">KODE FASYANKES *</label>
				   <div class="col-sm-5">
                  <input type="text" name="kode_faskes" required class="form-control" autocomplete="off"  placeholder="KODE FASYANKES">
				  </div>
				  <div style="clear:both;"></div>
                </div>
				
			
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->


        </div>
        <!--/.col (left) -->

        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

            <!-- /.tab-content -->
          </div> 

 <script>
   $(function() {
	  $('.select2').select2();
	  $('[data-mask]').inputmask();
     $("#datepicker").datepicker({autoclose: true});
   });
   
      $('[name="propinsi"]').change(function() {
		 $('#kota').val('');
		 $('#kecamatan').val('');
		    $.ajax({
         url: "<?php echo site_url('register/dropdown5')?>/" + $(this).val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="kota"]'), data, 'id_kota', 'nama_kota');
         }
      }); 
	  
	 
   });
   
   $('[name="kota"]').change(function() {
		 $('#kecamatan').val('');
		    $.ajax({
         url: "<?php echo site_url('register/dropdown6')?>/" + $('#propinsi').val()+"/"+ $(this).val(),
         dataType: "json",
         type: "GET",
         success: function(data) { //
		addOption($('[name="kecamatan"]'), data, 'id_camat', 'nama_camat');
         }
      }); 
	  
	 
   });
   
   

function check() {
    if(document.getElementById('kata_sandi').value ===
            document.getElementById('kata_sandi_confirm').value) {
        document.getElementById('message').innerHTML = "<font color='green'>Password Sama</font>";
		 document.getElementById('submit').disabled = false;
    } else {
        document.getElementById('message').innerHTML = "<font color='red'>Password Tidak Sama</font>";
		 document.getElementById('submit').disabled = true;
    }
}
   
   function addOption(ele, data, key, val) { //alert(data.length);
   $('option', ele).remove();
  
   ele.append(new Option('', 9999));
   $(data).each(function(index) { //alert(eval('data[index].' + nama));
      ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));
	 
   });
}

function cekEmail(values,arrayEmail){
	var str =arrayEmail;
	var res = str.split(",");
res.forEach(myFunction);

function myFunction(value, index, array) {
  if(values==value){
	   alert('Email Sudah Dipakai!');
		document.getElementById('exampleInputEmail1').value = "";
  }
}

}
 </script>
 <script src="<?php echo base_url('assets/js/migrate.js');?>"></script>