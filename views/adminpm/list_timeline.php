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
			  <ul id="myTab" class="nav nav-tabs">
                  <li class="active"><a href="<?php echo base_url('pmd/list_pajak');?>">Praktik Mandiri</a></li> 
              </ul>
			    <div id="myTabContent" class="tab-content">
			 <div class="tab-pane fade in active">
			 <br>
    			<h3 class="page-header">LIST HISTORY</h3>
<!--
<a href="<?php echo base_url('pmd/tambah_upload_spt');?>"><button class="btn btn-primary" type="button" name="add" value="Tambah" >Tambah</button></a><br><br>-->
    		<form name="form_search" class="form-horizontal" method="POST" action="">

    						<?php 
			//$instalasi=9999;
	 // echo myform_select('Instalasi/Unit', 'instalasi', dropdown_instalasi(null,null), (isset($data2['instalasi']) ? $data2['instalasi'] : '2'),'','');?>
	 <?php //echo myform_select('Poli / SMF', 'poli', dropdown_poli((isset($data2['instalasi']) ? $data2['instalasi'] : '2'),'semua'),(isset($data2['poli']) ? $data2['poli'] : ''),'');?>
	 <?php //echo myform_select('Kasir', 'kasir', dropdown_kasir(),(isset($data2['kasir']) ? $data2['kasir'] : (isset($user['id']) ? $user['id'] : '3254')),'');?>


    <?php /* echo myform_select('Propinsi', 'alamat_propinsi', dropdown_propinsi(),$data['alamat_propinsi'],'','');?>
    <?php echo myform_select('Kota/Kab', 'alamat_kota', dropdown_kota($prop), $data['alamat_kota'],'','');*/?>
	<!--
    <button class="btn btn-primary" type="submit" name="submit" value="save" style="margin-bottom:10px; margin-left:155px;">View</button>-->
     
</form>
<!--<section class="content">
<div class="divest" >-->
<!--
<table class="table-bordered table-condensed"  width="100%" >

		<tr>
		<td><b>No</b></td>
		<td><b>Nama</b></td>
		<td><b>Email</b></td>
		<td><b>Keluhan</b></td>
		<td><b>Kebutuhan</b></td>
		<td><b>Action</b></td>
		</tr>
			<?php 

			foreach ($data['query'] as $key => $value) {
			$id++;
		
		?>
			<tr>
			<td><?php echo $id; ?></td>
			<td><?php echo $value['nama_lengkap']; ?></td>
			<td><?php echo $value['email']; ?></td>
			<td><?php echo $value['keluhan']; ?></td>
			<td><?php echo $value['kebutuhan']; ?></td>
			<td><a href="<?=site_url('dashboard/module_assesment/'.$value['id']);?>" class="btn btn-mini edit-btn" ><i class="glyphicon glyphicon-pencil"></i> TINDAKAN</a> <br> <a onclick="return confirm('Yakin Di Hapus?');" href="<?=site_url('dashboard/hapus_pendaftaran/'.$value['id']);?>" class="btn btn-mini edit-btn" ><i class="glyphicon glyphicon-trash"></i> HAPUS</a></td>
			</tr>
	
		<?php } ?>
	</table>
	 </div>
 </section>
	<div style=" margin-left:10px;">
		<?php echo $data['halaman']; ?>
	</div>
-->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
<div class="box-body">
<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
<div class="row">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NAMA Praktik Mandiri</th>
                  <th>Provinsi</th>
				  <th>Kab/Kota</th>
				   <th>Alamat</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
				<?php 

			foreach ($data['query'] as $key => $value) {
			$id++;
		
		?>
                <tr>
                  <td><?php echo $value['nama_pm']; ?></td>
                  <td><?php echo $value['nama_prop']; ?></td>
				  <td><?php echo $value['nama_kota']; ?></td>
				  <td><?php echo $value['alamat_faskes']; ?></td>
                  <td><a href="<?=site_url('dashboard/timeline/'.$value['id_faskes']);?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> View Status History</button></a></td>
                </tr>
            <?php } ?> 
                </tbody>
               
              </table>
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