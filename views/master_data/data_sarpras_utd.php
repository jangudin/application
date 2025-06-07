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
		
			    <div id="myTabContent" class="tab-content">
			 <div class="tab-pane fade in active">
	
<section class="content">
      <div class="row">
        <div class="col-xs-12">
			  <h3 class="page-header">MASTER DATA SARPRAS UTD</h3>
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
<a href="<?php echo base_url('dashboard/tambah_master_data_sarpras_utd');?>"><button class="btn btn-primary" type="button" name="add" value="Tambah" >Tambah</button></a>
          <div class="box">
            <div class="box-header">
<div class="box-body">
<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
<div class="row">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>NO</th>
                  <th>TYPE</th>
				  <th>SUB TYPE</th>
				  <th>SARPRAS</th>
				  <th>KETERANGAN</th>
				  <th>UTAMA</th>
				  <th>MADYA</th>
				  <th>PRATAMA</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
				<?php 
$no=0;

			foreach ($data['query'] as $key => $value) {
				$no++;
			$id++;
		
		?>
                <tr>
				<td><?php echo $no; ?></td>
                  <td><?php echo $value['type']; ?></td>
				   <td><?php echo $value['sub_type']; ?></td>
				  <td><?php echo $value['nama_sarpras']; ?></td>
				   <td><?php echo $value['sub_keterangan']; ?></td>
				  <td><?php echo ($value['utama']==1 ? 'Ada' : 'Tidak Ada'); ?></td>
				   <td><?php echo ($value['madya']==1 ? 'Ada' : 'Tidak Ada'); ?></td>
				   <td><?php echo ($value['pratama']==1 ? 'Ada' : 'Tidak Ada'); ?></td>
                  <td><a href="<?=site_url('dashboard/tambah_master_data_sarpras_utd/'.$this->encrypt->encode($value['id']));?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> EDIT</button></a><br><a href="<?=site_url('dashboard/hapus_master_data_sarpras_utd/'.$this->encrypt->encode($value['id']));?>" onclick="return confirm('Yakin Ingin Di Hapus?');"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> DELETE</button></a></td>
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
</section>
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