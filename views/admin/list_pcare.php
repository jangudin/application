<?php
ini_set("memory_limit", "512M");
?>
<style>
	.divest {
		width: 100%;
		height: auto;
		border: thin solid black;
		overflow-x: scroll;
	}

	td#nowrap {
		white-space: nowrap;
	}

	th#nowrap {
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
				<li class="active"><a href="<?php echo base_url('dashboard/list_pcare'); ?>">Bridging PCARE</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade in active">
					<br>
					<h3 class="page-header">Bridging PCARE BPJS Kesehatan</h3>

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
																<th>Kode FASYANKES</th>
																<th>Nama FASYANKES</th>
																<th>Email</th>
																<th>Kedeputian</th>
																<th>Dokumen Integrasi PCare</th>
																<th>ACTION</th>
															</tr>
														</thead>
														<tbody>
															<?php

															foreach ($data['query'] as $key => $value) {
																// var_dump($value);
																$id++;

															?>
																<tr>
																	<td><?php echo $value['kode_fasyankes']; ?></td>
																	<td><?php echo $value['nama_fasyankes']; ?></td>
																	<td><?php echo $value['email']; ?></td>
																	<td><?php echo $value['kedeputian']; ?></td>
																	<td><?php echo $value['dokumen_integrasi_pcare']; ?></td>
																	<td><a target='_blank' href="<?= site_url('assets/uploads/berkas_pcare/' . $value['dokumen_integrasi_pcare']); ?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> View Berkas</button></a></td>
																</tr>
															<?php } ?>
														</tbody>

													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// $(function() {
	// 	$('#example1').DataTable()

	// })
	$('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'csv'
                ]
            });

	/*     $('#example').DataTable( {
	        "processing": true,
	        "serverSide": true,
	        "ajax": {
	            "url": "<?php echo site_url("dashboard/list_user_yang_mendaftar_ajax_server/"); ?>",
	            "data": function ( d ) {
	                d.myKey = "myValue";
	                // d.custom = $('#myInput').val();
	                // etc
	            }
	        }
	    } ); */
</script>