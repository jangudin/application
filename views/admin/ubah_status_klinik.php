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

    <div class="col-xs-15 col-sm-15">
    	<div class="box">
    		<div class="box-content">

			 <br>
			 <div class="box-body">
                                  <div class="box-body table-responsive no-padding">

    			<h3 class="page-header">UBAH STATUS KLINIK</h3>

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
<div class="box-body">
<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
<div class="row">
              <form role="form" method="POST" action="" enctype='multipart/form-data'>
			    <table class="table table-bordered">
				<?php
				if($data[0]['status_klinik']=='Aktif'){
					$status_klinik_aktif='checked';
					$status_klinik_tidak_aktif='';
				}else if($data[0]['status_klinik']=='Tidak Aktif'){
					$status_klinik_aktif='';
					$status_klinik_tidak_aktif='checked';
				}
				?>
				<tr>
				<td>STATUS</td><td>:</td>
			<td>   
			Aktif <input type="radio" name="status_klinik" <?=$status_klinik_aktif?> value="Aktif">&nbsp;&nbsp;&nbsp;&nbsp;Tidak Aktif <input type="radio" name="status_klinik" <?=$status_klinik_tidak_aktif?>  value="Tidak Aktif">
			</td>
			 </tr>
				<tr>
				<td>KETERANGAN</td><td>:</td>
			<td>   
			<input type="text" name="alasan_status_klinik" value="<?=$data[0]['alasan_status_klinik']?>">
			</td>
			 </tr>
			  <tr>
			<td colspan="3" align="middle">   <input type="hidden" name="id_faskes" value="<?=$id;?>">
			 <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button></td>
			 </tr>
			
			  
			 </table>
            </form>
</div>
</div>
</div></div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

<script>

	
$(function () {
    $('#example1').DataTable()

  })
	
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