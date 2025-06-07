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
			  <h3 class="page-header">MASTER DATA USER AKSES</h3>
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

          <div class="box">
            <div class="box-header">
<div class="box-body">
<div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
<div class="row">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>NO</th>
                  <th>EMAIL</th>
                  <th>NAMA LENGKAP</th>
				  <th>NAMA FASYANKES</th>
				   <th>USER AKSES</th>
				    <th>TANGGAL BUAT</th>
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
                  <td><?php echo $value['email']; ?></td>
                  <td><?php echo $value['nama_lengkap']; ?></td>
				  <td><?php echo $value['nama_fasyankes']; ?></td>
				   <td><?php echo $value['type_user']; ?></td>
				   <td><?php echo date('d-m-Y H:i:s',strtotime($value['tgl_buat_user'])); ?></td>
                  <td><a href="<?=site_url('dashboard/edit_user_akses/'.$this->encrypt->encode($value['id']));?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> EDIT</button></a></td>
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