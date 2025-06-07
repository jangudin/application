<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<!-- Main content -->
<section class="content">

	<div class="row">

		<!-- /.col -->
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<?php
				if ($this->session->flashdata('message_name') != null) {
				?>
					<div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
						<h4><i class="icon fa fa-<?= $this->session->flashdata('icon_name'); ?>"></i> Peringatan!</h4>
						<?= $this->session->flashdata('message_name'); ?>
					</div>
				<?php
				}
				?>
				<ul class="nav nav-tabs">
					<li><a href="<?php echo base_url('labkes/inputan_data_faskes_labkes'); ?>">Data Dasar</a></li>
					<li><a href="<?php echo base_url('labkes/inputan_data_sarpras_alkes_labkes'); ?>">Data Sarpras & Alkes</a></li>
					<li><a href="<?php echo base_url('labkes/inputan_data_sdm_labkes'); ?>">Struktur Organisasi</a></li>
					<li class="active"><a href="<?php echo base_url('labkes/inputan_jenis_pemeriksaan_labkes'); ?>">Data Pelayanan</a></li>
					<li><a href="<?php echo base_url('labkes/selesaikan_labkes'); ?>">Kirim Data</a></li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="activity">
						<!-- Main content -->
						<section class="content">

							<div class="row">
								<!-- left column -->
								<div class="col-md-12">
									<!-- general form elements -->
									<div class="box box-primary">


										<!-- /.box-header -->
										<!-- form start -->
										<form role="form" method="POST" action="" enctype='multipart/form-data'>
											<input type='hidden' name='action' value="<?= (!empty($status) ? $status : '') ?>">
											<input type='hidden' name='id_jenis_pemeriksaan' value="<?= (!empty($id_jenis_pemeriksaan) ? $id_jenis_pemeriksaan : '') ?>">
											<table class="table table-bordered">
												<tbody>
													<tr>
														<td>TYPE PELAYANAN</td>
														<td>:</td>
														<td><?= form_dropdown('type', dropdown_jenis_pemeriksaan_type(), (!empty($data2[0]) ? $data2[0]['type'] : ''), 'id="type" class="form-control select2" required'); ?></td>
													</tr>
													<?php
													if ($data2[0]['type'] != 'Pelayanan Parasitologi Klinik' && !empty($data2[0]['type'])) {
														$val_pemeriksaan_tambahan = '';
													} else {
														$val_pemeriksaan_tambahan = 'disabled';
													}
													?>
													<tr>
														<td>JENIS PEMERIKSAAN</td>
														<td>:</td>
														<td><?= form_dropdown('jenis_pemeriksaan[]', dropdown_jenis_pemeriksaan(), (!empty($data2[0]) ? explode(',', $data2[0]['jenis_pemeriksaan']) : ''), 'id="jenis_pemeriksaan" class="form-control select2" multiple'); ?></td>
													</tr>
													<tr>
														<td>PEMERIKSAAN TAMBAHAN</td>
														<td>:</td>
														<td><?= form_dropdown('pemeriksaan_tambahan[]', dropdown_pemeriksaan_tambahan(), (!empty($data2[0]) ? explode(',', $data2[0]['pemeriksaan_tambahan']) : ''), 'id="pemeriksaan_tambahan" ' . $val_pemeriksaan_tambahan . ' class="form-control select2" multiple '); ?></td>
													</tr>
													<tr>
														<td>PEMERIKSAAN LAINNYA</td>
														<td>:</td>
														<td><textarea <?= $val_pemeriksaan_tambahan; ?> name="pemeriksaan_tambahan_lainnya" id="pemeriksaan_tambahan_lainnya"><?= (!empty($data2[0]) ? $data2[0]['pemeriksaan_tambahan_lainnya'] : '') ?></textarea></td>
													</tr>

													<?php
													if (!empty($status)) {
													?>
														<tr>
															<td>TENAGA TEKNIS</td>
															<td>:</td>
															<td><?= form_dropdown('fungsional', dropdown_fungsional_labkes(), (!empty($data2[0]) ? $data2[0]['fungsional'] : ''), ' id="fungsional" class="form-control select2" required'); ?></td>
														</tr>
													<?php
													} else {
													?>
														<tr>
															<td>TENAGA TEKNIS</td>
															<td>:</td>
															<td><?= form_dropdown('fungsional', dropdown_fungsional_labkes(), (!empty($data2[0]) ? $data2[0]['fungsional'] : ''), 'onchange="openshowtenagateknis(this.value)" id="fungsional" class="form-control select2" required'); ?></td>
														</tr>
													<?php
													}
													?>
													<?php
													if (($data2[0]['fungsional'] == 'Dokter Spesialis Lainnya' || $data2[0]['fungsional'] == 'S1 Biologi/tenaga non kesehatan lain')  && !empty($data2[0]['fungsional'])) {
														$val_fungsional = '';
													} else {
														$val_fungsional = 'disabled';
													}
													?>
													<tr>
														<td>TENAGA TEKNIS LAINNYA</td>
														<td>:</td>
														<td colspan="4"><textarea <?= $val_fungsional ?> name="fungsional_lainnya" id="fungsional_lainnya"><?= (!empty($data2[0]) ? $data2[0]['fungsional_lainnya'] : '') ?></textarea></td>
													</tr>
													<tr>
														<td width="15%">NAMA</td>
														<td width="1%">:</td>
														<td width="30%"><input type="text" name="nama" value="<?= (!empty($data2[0]) ? $data2[0]['nama'] : '') ?>" class="form-control" placeholder="NAMA" required autocomplete="off" id="nama"></td>
													</tr>
													<tr>
														<td width="10%">NIK</td>
														<td width="1%">:</td>
														<td width="20%"><input type="text" name="nik" value="<?= (!empty($data2[0]) ? $data2[0]['nik'] : '') ?>" class="form-control" placeholder="NIK" required autocomplete="off" id="nik"></td>
													</tr>
													<tr>
														<td>SIP</td>
														<td>:</td>
														<td><input type="text" name="sip" value="<?= (!empty($data2[0]) ? $data2[0]['sip'] : '') ?>" class="form-control" placeholder="SIP" required autocomplete="off" id="sip"></td>
													</tr>
													<tr>
														<td>SIP KE</td>
														<td>:</td>
														<td><input type="text" name="sip_ke" value="<?= (!empty($data2[0]) ? $data2[0]['sip_ke'] : '') ?>" class="form-control" placeholder="SIP KE" required autocomplete="off" id="sip_ke"></td>
													</tr>
													<tr>
														<td>Link Drive Dokumen SIP</td>
														<td>:</td>
														<td>
															<input class="form-control" type="text" name="upload_dokumen_sip" id="upload_dokumen_sip" value="<?= (empty($data2[0]['upload_dokumen_sip']) ? '' : $data2[0]['upload_dokumen_sip']) ?>">
															<!-- <input type="file" name="upload_dokumen_sip" id="upload_dokumen_sip">
															<a target="_blank" href="<?php //echo base_url('assets/uploads/berkas_operasional/' . $data2[0]['upload_dokumen_sip']); 
																						?>"><?php //echo $data2[0]['upload_dokumen_sip']; 
																							?></a> <input type="hidden" name="old_upload_dokumen_sip" value="<? //= $data2[0]['upload_dokumen_sip'] 
																																								?>" id="old_upload_dokumen_sip"> -->
														</td>
													</tr>
													<tr>
														<td>TANGGAL BERAKHIR</td>
														<td>:</td>
														<td><input type="text" name="tanggal_berakhir_sip" value="<?= (!empty($data2[0]) ? date('d-m-Y', strtotime($data2[0]['tanggal_berakhir_sip'])) : '') ?>" class="form-control datepicker" placeholder="TANGGAL BERAKHIR SIP" required autocomplete="off" id="tanggal_berakhir_sip"></td>
													</tr>
													<tr>
														<td>STR</td>
														<td>:</td>
														<td><input type="text" name="str" value="<?= (!empty($data2[0]) ? $data2[0]['str'] : '') ?>" class="form-control" placeholder="STR" autocomplete="off" id="str"></td>
													</tr>
													<tr>
														<td>Link Drive Dokumen STR</td>
														<td>:</td>
														<td>

															<input class="form-control" type="text" name="upload_dokumen_str" id="upload_dokumen_str" value="<?= (empty($data2[0]['upload_dokumen_str']) ? '' : $data2[0]['upload_dokumen_str']) ?>">

															<!-- <input type="file" name="upload_dokumen_str" id="upload_dokumen_str"><a target="_blank" href="<?php //echo base_url('assets/uploads/berkas_operasional/' . $data2[0]['upload_dokumen_str']); 
																																								?>"><?php //echo $data2[0]['upload_dokumen_str']; 
																																									?></a>
															<input type="hidden" name="old_upload_dokumen_str" value="<? //= $data2[0]['upload_dokumen_str'] 
																														?>" id="old_upload_dokumen_str"> -->
														</td>
													</tr>
													<tr>
														<td>TANGGAL BERAKHIR </td>
														<td>:</td>
														<td><input type="text" name="tanggal_berakhir_str" value="<?= (!empty($data2[0]) ? date('d-m-Y', strtotime($data2[0]['tanggal_berakhir_str'])) : '') ?>" class="form-control datepicker" placeholder="TANGGAL BERAKHIR STR" required autocomplete="off" id="tanggal_berakhir_str"></td>
													</tr>
													<tr>
														<td>PENDIDIKAN DAN PELATIHAN</td>
														<td>:</td>
														<td><input type="text" name="penddikan_dan_pelatihan" value="<?= (!empty($data2[0]) ? $data2[0]['penddikan_dan_pelatihan'] : '') ?>" class="form-control" placeholder="PENDIDIKAN DAN PELATIHAN" autocomplete="off" id="penddikan_dan_pelatihan"></td>
													</tr>
													<tr>
														<td>TANGGAL MULAI </td>
														<td>:</td>
														<td><input type="text" name="tanggal_pendidikan_dan_pelatihan" value="<?= (!empty($data2[0]) ? date('d-m-Y', strtotime($data2[0]['tanggal_pendidikan_dan_pelatihan'])) : '') ?>" class="form-control datepicker" placeholder="TANGGAL MULAI" autocomplete="off" id="tanggal_pendidikan_dan_pelatihan"></td>
													</tr>
													<tr>
														<td>Link Drive Dokumen Pendidikan dan Pelatihan</td>
														<td>:</td>

														<td>
															<input class="form-control" type="text" name="upload_dokumen_penddikan_dan_pelatihan" id="upload_dokumen_penddikan_dan_pelatihan" value="<?= (empty($data2[0]['upload_dokumen_penddikan_dan_pelatihan']) ? '' : $data2[0]['upload_dokumen_penddikan_dan_pelatihan']) ?>">
															<!-- <input type="file" name="upload_dokumen_penddikan_dan_pelatihan" id="upload_dokumen_penddikan_dan_pelatihan"><a target="_blank" href="<?php //echo base_url('assets/uploads/berkas_operasional/' . $data2[0]['upload_dokumen_penddikan_dan_pelatihan']); 
																																																		?>"><? php // echo $data2[0]['upload_dokumen_penddikan_dan_pelatihan']; 
																																																			?></a><input type="hidden" name="old_upload_dokumen_penddikan_dan_pelatihan" value="<? //= $data2[0]['upload_dokumen_penddikan_dan_pelatihan'] 
																																																																																																					?>" id="old_upload_dokumen_penddikan_dan_pelatihan"> -->
														</td>
													</tr>
													<tr>
														<td colspan="3"><?php
																		if (empty($data2[0]['final'])) {
																		?><input type="hidden" name="id_faskes" value="<?= $user_id; ?>">
																<?php
																			if ($status == 'edit') {
																?>
																	<button type="submit" name="submit" id="submit" class="btn btn-primary">Rubah</button> |<a class="btn btn-primary" href="<?php echo base_url('labkes/inputan_jenis_pemeriksaan_labkes/'); ?>">Batal Rubah</a>
																<?php
																			} else {
																?>
																	<button type="submit" name="submit" id="submit" class="btn btn-primary">Simpan</button>
																<?php
																			}
																		} else {
																?>
																<font color="orange">Data Sedang Di Verifikasi</font>
															<?php
																		}
															?>
														</td>
													</tr>
												</tbody>
											</table>

										</form>
										<hr>
										<h3>LIST DATA</h3>
										<table class="table table-bordered">
											<tbody>
												<tr>
													<th>NO</th>
													<th>TYPE</th>
													<th>NIK</th>
													<th>NAMA</th>
													<th>FUNGSIONAL</th>
													<th>ACTION</th>
												</tr>


												<?php
												$no = 0;
												foreach ($data as $key => $value) {
													$no++;
												?>
													<tr>
														<td><?= $no ?></td>
														<td><?= $value['type'] ?></td>
														<td><?= $value['nik'] ?></td>
														<td><?= $value['nama'] ?></td>
														<td><?= $value['fungsional'] ?></td>
														<td><a onclick="detail_jenis_pemeriksaan('<?= $value['id']; ?>')" class="btn btn-mini edit-btn"><button class="btn btn-primary"><i class="glyphicon glyphicon-zoom-in"></i> View</button></a> | <a href="<?php echo base_url('labkes/inputan_jenis_pemeriksaan_labkes') . "/" . $value['id']; ?>/edit"><button type="submit" name="submit" id="submit" class="btn btn-primary">Edit</button></a> | <a onclick="return confirm('Apakah Anda Yakin?')" href="<?php echo base_url('labkes/inputan_jenis_pemeriksaan_labkes') . "/" . $value['id']; ?>/hapus"><button type="submit" name="submit" id="submit" class="btn btn-primary">Hapus</button></a></td>
													</tr>
												<?php
												}
												?>
											</tbody>


										</table>

									</div>
									<!-- /.box -->


								</div>
								<!--/.col (left) -->

								<!--/.col (right) -->
							</div>
							<!-- /.row -->
						</section>
						<!-- /.content -->


					</div>

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
	$("#type").change(function() {

		if (this.value == 'Pelayanan Parasitologi Klinik') {
			$('#pemeriksaan_tambahan').prop("disabled", true);
			$('#pemeriksaan_tambahan_lainnya').prop("disabled", true);

		} else {
			$('#pemeriksaan_tambahan').prop("disabled", false);
			$('#pemeriksaan_tambahan_lainnya').prop("disabled", false);
		}
	});


	$("#fungsional").change(function() {

		if (this.value == 'Dokter Spesialis Lainnya' || this.value == 'S1 Biologi/tenaga non kesehatan lain') {
			$('#fungsional_lainnya').prop("disabled", false);

		} else {
			$('#fungsional_lainnya').prop("disabled", true);
		}
	});


	function openshowtenagateknis(value) {


		if (value == 'Tidak ada dokter spesialis') {
			$('#nama').attr('required', false);
			$('#nik').attr('required', false);
			$('#sip').attr('required', false);
			$('#sip_ke').attr('required', false);
			$('#upload_dokumen_sip').attr('required', false);
			$('#tanggal_berakhir_sip').attr('required', false);
			$('#str').attr('required', false);
			$('#upload_dokumen_str').attr('required', false);
			$('#tanggal_berakhir_str').attr('required', false);

		} else {
			$('#nama').attr('required', true);
			$('#nik').attr('required', true);
			$('#sip').attr('required', true);
			$('#sip_ke').attr('required', true);
			$('#upload_dokumen_sip').attr('required', true);
			$('#tanggal_berakhir_sip').attr('required', true);
			$('#str').attr('required', true);
			$('#upload_dokumen_str').attr('required', true);
			$('#tanggal_berakhir_str').attr('required', true);

		}


	}



	$(function() {
		$('.select2').select2();
		$('[data-mask]').inputmask();

	});
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
		todayHighlight: 'TRUE',
		autoclose: true,
	});

	$('[name="id_prov"]').change(function() {
		$('#id_kota').val('');
		$.ajax({
			url: "<?php echo site_url('dashboard/dropdown4') ?>/" + $(this).val(),
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


	function detail_jenis_pemeriksaan(id_jenis_pemeriksaan) {
		// $.facebox.settings.overlay = 'false';


		$.facebox(function() {
			$.post('<?php echo site_url('dashboard/detail_jenis_pemeriksaan') ?>' + "/" + id_jenis_pemeriksaan, function(data) {
				$.facebox(data);
			});
		});

	}
</script>
<link href="<?php echo base_url('assets/css/facebox.css'); ?>" rel="stylesheet">
<script type="text/javascript" src="<?= base_url('assets/js/facebox.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/migrate.js'); ?>"></script>