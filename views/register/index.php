<div class="nav-tabs-custom">
	<?php
	if ($this->session->flashdata('message_name') != null) {
	?>
		<div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">�</button>
			<h4><i class="icon fa fa-<?= $this->session->flashdata('icon_name'); ?>"></i> Alert!</h4>
			<?= $this->session->flashdata('message_name'); ?>
		</div>
	<?php
	}
	?>
	<?php

	if ($this->session->flashdata('pesan_form')) :
		echo $this->session->flashdata('pesan_form');
	endif

	?>
	<!-- Main content -->
	<section class="content">
		<a href="<?php echo site_url('admin/index') ?>"><button class="btn btn-success"><i class="fa fa-fw fa-arrow-left"></i> Back</button></a>
		<br><br>
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">PENDAFTARAN USER LOGIN FASYANKES - </h3><a href="https://dfo.kemkes.go.id/Registrasi"> Pendaftaran User Puskesmas Klik Disini</a>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" method="POST" action="">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-2 control-label">Kategori User Pendaftaran *</label>
								<div class="col-sm-5">
									<?= form_dropdown('id_kategori', dropdown_kategori(), '', 'id="id_kategori" onchange="cek_user(this.value)" required class="form-control select2"'); ?>
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group" id="id_kategori_pm_user">
								<label class="col-sm-2 control-label">Kategori Praktik Mandiri *</label>
								<div class="col-sm-5">
									<?= form_dropdown('id_kategori_pm', dropdown_kategori_pm(), '', 'id="id_kategori_pm" style="width:100%" class="form-control select2"'); ?>
								</div>
								<div style="clear:both;"></div>
							</div>
							<!--		
				<div class="form-group">
				<label  class="col-sm-2 control-label">Jenis Klinik *</label>
				<div class="col-sm-5">
				<?php array() ?>
				<?= form_dropdown('jenis_klinik', dropdown_jenis_klinik(), '', 'id="jenis_klinik" required class="form-control select2"'); ?>
				</div>  
				<div style="clear:both;"></div>
				</div>
				
				<div class="form-group">
				<label  class="col-sm-2 control-label">Jenis Perawatan *</label>
				<div class="col-sm-5">
				<?php array() ?>
				<?= form_dropdown('jenis_perawatan', dropdown_jenis_perawatan(), '', 'id="jenis_perawatan" required class="form-control select2"'); ?>
				</div>  
				<div style="clear:both;"></div>
				</div>
		       -->
							<div class="form-group" id="jabatan_user">
								<label class="col-sm-2 control-label">Jabatan *</label>
								<div class="col-sm-5">
									<input type="text" name="jabatan" class="form-control" autocomplete="off" placeholder="Jabatan">
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group" id="nama_fasyankes_user">
								<label class="col-sm-2 control-label">Nama Fasyankes *</label>
								<div class="col-sm-5">
									<input type="text" name="nama_fasyankes" class="form-control" autocomplete="off" placeholder="Nama Fasyankes">
								</div>
								<div style="clear:both;"></div>
							</div>
							<?php
							$email = '';
							foreach ($jml_email as $keyjml_email => $valuejml_email) {
								$email = $email . $valuejml_email['email'] . ',';
							}
							?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Email address *</label>
								<div class="col-sm-5">
									<input type="email" name="email" required class="form-control" onchange="cekEmail(this.value,'<?= $email; ?>');" autocomplete="off" id="exampleInputEmail1" placeholder="Email">
									<span id='messageEmail'></span>
								</div>
								<div style="clear:both;"></div>
							</div>
							<div class="form-group">
								<span id="password_strength">Strength...</span>
								<label class="col-sm-2 control-label">Password *</label>
								<div class="col-sm-5">
									<input type="password" name="kata_sandi" required class="form-control" autocomplete="off" id="kata_sandi" placeholder="Password" onkeyup="CheckPasswordStrength(this.value)">
									<input type="hidden" name="cek_pass_s" value="" required id="cek_pass_s">
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Confirm Password *</label>
								<div class="col-sm-5">
									<input type="password" name="kata_sandi_confirm" required class="form-control" autocomplete="off" id="kata_sandi_confirm" placeholder="Confirm Password" onchange="check()">
									<span id='message'></span>
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group">

								<label class="col-sm-2 control-label">No KTP *</label>
								<div class="col-sm-5">
									<input type="text" name="no_ktp" class="form-control" required autocomplete="off" id="exampleInput" placeholder="No KTP" data-inputmask="'mask': ['9999999999999999']" data-mask="">
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Nama Lengkap *</label>
								<div class="col-sm-5">
									<input type="text" name="nama_lengkap" class="form-control" required autocomplete="off" id="exampleInput" placeholder="Nama Lengkap">
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Jenis Kelamin *</label>
								<div class="col-sm-5">
									<?= form_dropdown('jenis_kelamin', array('L' => 'Laki-laki', 'P' => 'Perempuan'), '', 'id="jenis_kelamin" class="form-control select2" required'); ?>
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">No Handphone *</label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-phone"></i>
										</div>
										<input type="text" name="no_hp" class="form-control" data-inputmask="'mask': ['9999-9999-9999-9']" data-mask="" required>
									</div>
								</div>
								<div style="clear:both;"></div>
								<!-- /.input group -->
							</div>



							<div class="form-group">
								<label class="col-sm-2 control-label">Tempat/ Tanggal Lahir *</label>
								<div class="col-sm-2">
									<input type="text" name="tempat_lahir" class="form-control" autocomplete="off" id="exampleInput" placeholder="Tempat Lahir" required>
								</div>
								<div class="col-sm-3">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" name="tgl_lahir" class="form-control pull-right" id="datepicker" placeholder="Tanggal Lahir Contoh : 28/10/1988" required>
									</div>
								</div>
								<!-- /.input group -->
								<div style="clear:both;"></div>
							</div>


							<div class="form-group" display="none" id="kewarganegaraan_user">
								<label class="col-sm-2 control-label">Kewarganegaraan *</label>
								<div class="col-sm-5">
									<input type="text" name="kewarganegaraan" id="kewarganegaraan" class="form-control" autocomplete="off" placeholder="Kewarganegaraan">
								</div>
								<div style="clear:both;"></div>
							</div>



							<hr>
							<h4>Alamat Fasyankes</h4>
							<div class="form-group">
								<label class="col-sm-2 control-label">Provinsi *</label>
								<div class="col-sm-5">
									<?= form_dropdown('propinsi', dropdown_propinsi_regis(), null, 'id="propinsi" class="form-control select2" required'); ?>
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Kabupaten/Kota *</label>
								<div class="col-sm-5">
									<?= form_dropdown('kota', dropdown_kota(), '', 'id="kota" class="form-control select2" required'); ?>
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Kecamatan *</label>
								<div class="col-sm-5">
									<?= form_dropdown('kecamatan', dropdown_kecamatan(), '', 'id="kecamatan" class="form-control select2" required'); ?>
								</div>
								<div style="clear:both;"></div>
							</div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Alamat *</label>
								<div class="col-sm-5">
									<textarea name="alamat" id="alamat" class="form-control" rows="3" required placeholder="Alamat ..."></textarea>
								</div>
								<div style="clear:both;"></div>
							</div>

							<div id="pm_wilayah" style="display:none;">
								<h4 id="header_alamat_user">Alamat Domisili User</h4>
								<div class="form-group">
									<label class="col-sm-2 control-label">Provinsi *</label>
									<div class="col-sm-5">
										<?= form_dropdown('propinsi_pm', dropdown_propinsi(), '', 'id="propinsi_pm" style="width:100%" class="form-control select2"'); ?>
									</div>
									<div style="clear:both;"></div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Kabupaten/Kota *</label>
									<div class="col-sm-5">
										<?= form_dropdown('kota_pm', dropdown_kota(), '', 'id="kota_pm" style="width:100%"  class="form-control select2"'); ?>
									</div>
									<div style="clear:both;"></div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Kecamatan *</label>
									<div class="col-sm-5">
										<?= form_dropdown('kecamatan_pm', dropdown_kecamatan(), '', 'id="kecamatan_pm" style="width:100%"  class="form-control select2"'); ?>
									</div>
									<div style="clear:both;"></div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Alamat *</label>
									<div class="col-sm-5">
										<textarea name="alamat_pm" id="alamat_pm" class="form-control" rows="3" placeholder="Alamat Praktik Mandiri..."></textarea>
									</div>
									<div style="clear:both;"></div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<?php

								if ($this->session->flashdata('pesan_form')) :
									echo $this->session->flashdata('pesan_form');
								endif

								?>
								<!--<?= $captcha['captcha'] ?><br>Masukan kode captcha yang sesuai gambar di atas<br/>-->
								<h3><?= $captcha_new; ?></h3>
								<input type="text" name="captcha" placeholder="Jawab Hasil Penjumlahan!">
							</div>
							<div class="box-footer">
								<button type="submit" name="submit" id="submit" disabled class="btn btn-primary">Submit</button>
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
	$(document).ready(function() {
		$("#kewarganegaraan_user").css("display", "none");
		$("#id_kategori_pm_user").css("display", "none");




	});

	function CheckPasswordStrength(password) {
		var password_strength = document.getElementById("password_strength");


		//if textBox is empty
		if (password.length == 0) {
			password_strength.innerHTML = "";
			return;
		}

		//Regular Expressions
		var regex = new Array();
		regex.push("[A-Z]"); //For Uppercase Alphabet
		regex.push("[a-z]"); //For Lowercase Alphabet
		regex.push("[0-9]"); //For Numeric Digits
		regex.push("[$@$!%*#?&]"); //For Special Characters

		var passed = 0;

		//Validation for each Regular Expression
		for (var i = 0; i < regex.length; i++) {
			if ((new RegExp(regex[i])).test(password)) {
				passed++;
			}
		}

		//Validation for Length of Password
		if (passed > 2 && password.length > 8) {
			passed++;
		}

		//Display of Status
		var color = "";
		var lolos = 0;
		var passwordStrength = "";
		switch (passed) {
			case 0:
				passwordStrength = "Password Lemah! (** Password :Minimal 8 karakter, memiliki huruf besar, huruf kecil, angka dan spesial karakter.)";
				color = "darkorange";
				lolos = 0;
				break;
			case 1:
				passwordStrength = "Password Lemah! (** Password :Minimal 8 karakter, memiliki huruf besar, huruf kecil, angka dan spesial karakter.)";
				color = "Red";
				lolos = 0;
				break;
			case 2:
				passwordStrength = "Password Lemah! (** Password :Minimal 8 karakter, memiliki huruf besar, huruf kecil, angka dan spesial karakter.)";
				color = "darkorange";
				lolos = 0;
				break;
			case 3:
				passwordStrength = "Password Lemah! (** Password :Minimal 8 karakter, memiliki huruf besar, huruf kecil, angka dan spesial karakter.)";
				color = "darkorange";
				lolos = 0;
				break;
			case 4:
				passwordStrength = "Password Lemah! (** Password :Minimal 8 karakter, memiliki huruf besar, huruf kecil, angka dan spesial karakter.)";
				color = "darkorange";
				lolos = 0;
				break;
			case 5:
				passwordStrength = "Password Kuat!.";
				color = "darkgreen";
				lolos = 1;
				break;
		}
		password_strength.innerHTML = passwordStrength;
		password_strength.style.color = color;
		document.getElementById("cek_pass_s").value = lolos;

	}


	function cek_user(value) {
		if (value == 9) {
			$('#jabatan').val("-");
			$("#jabatan_user").css("display", "none");
			$('#nama_fasyankes').val("-");
			$("#nama_fasyankes_user").css("display", "none");

			$('#id_kategori_pm_user').removeAttr('style');
			$('#kewarganegaraan_user').removeAttr('style');
			$('#pm_wilayah').css('display', 'block');
		} else {
			$('#jabatan_user').removeAttr('style');
			$('#nama_fasyankes_user').removeAttr('style');

			$("#id_kategori_pm_user").css("display", "none");
			$("#kewarganegaraan_user").css("display", "none");


			$("#pm_wilayah").css("display", "none");

			$('#kewarganegaraan').val('');
			//$('#id_kategori_pm').select2("val", " ").trigger('change');
			$('#id_kategori_pm').val("").select2();
			$('#propinsi_pm').val("").select2();

			$('#propinsi_pm').select2("val", " ").trigger('change');
			$('#kota_pm').select2("val", " ").trigger('change');
			$('#kecamatan_pm').select2("val", " ").trigger('change');
			$('#alamat_pm').val('');
			/*

			$('#kewarganegaraan').val('');
			$("#kewarganegaraan_user").css("display","none");

			$("#header_alamat_user").css("display","none");

			$("#propinsi_pm_user").css("display","none");
			$('#propinsi_pm').select2("val", " ").trigger('change');
			$("#kota_pm_user").css("display","none");
			$('#kota_pm').select2("val", " ").trigger('change');
			$("#kecamatan_pm_user").css("display","none");
			$('#kecamatan_pm').select2("val", " ").trigger('change');

			$("#alamat_pm_user").css("display","none");
			$('#alamat_pm').val('');
			*/

		}
	}

	$(function() {

		$('.select2').select2();
		$('[data-mask]').inputmask();
		$("#datepicker").datepicker({
			autoclose: true
		});
	});

	$('[name="propinsi"]').change(function() {
		$('#kota').val('');
		$('#kecamatan').val('');
		$.ajax({
			url: "<?php echo site_url('register/dropdown5') ?>/" + $(this).val(),
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
			url: "<?php echo site_url('register/dropdown6') ?>/" + $('#propinsi').val() + "/" + $(this).val(),
			dataType: "json",
			type: "GET",
			success: function(data) { //
				addOption($('[name="kecamatan"]'), data, 'id_camat', 'nama_camat');
			}
		});


	});


	$('[name="propinsi_pm"]').change(function() {
		$('#kota_pm').val('');
		$('#kecamatan_pm').val('');
		$.ajax({
			url: "<?php echo site_url('register/dropdown5') ?>/" + $(this).val(),
			dataType: "json",
			type: "GET",
			success: function(data) { //
				addOption($('[name="kota_pm"]'), data, 'id_kota', 'nama_kota');
			}
		});


	});

	$('[name="kota_pm"]').change(function() {
		$('#kecamatan_pm').val('');
		$.ajax({
			url: "<?php echo site_url('register/dropdown6') ?>/" + $('#propinsi_pm').val() + "/" + $(this).val(),
			dataType: "json",
			type: "GET",
			success: function(data) { //
				addOption($('[name="kecamatan_pm"]'), data, 'id_camat', 'nama_camat');
			}
		});


	});



	function check() {
		if (document.getElementById('kata_sandi').value ===
			document.getElementById('kata_sandi_confirm').value) {
			if (document.getElementById('cek_pass_s').value == '1') {
				document.getElementById('message').innerHTML = "<font color='green'>Password Sama</font>";
				document.getElementById('submit').disabled = false;
			} else {
				document.getElementById('message').innerHTML = "<font color='red'>Password Lemah!</font>";
				document.getElementById('submit').disabled = true;
			}
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

	function cekEmail(values, arrayEmail) {
		//var str =arrayEmail;
		//var res = str.split(",");
		//res.forEach(myFunction);

		$.ajax({
			url: "<?php echo site_url('register/cek_email') ?>/" + encodeURI(values),
			dataType: "json",
			type: "GET",
			success: function(data) { //

				if (data[0].id) {
					alert('Email Sudah Dipakai!');
					document.getElementById('exampleInputEmail1').value = "";
				}
			}
		});

		/* function myFunction(value, index, array) {
		  if(values==value){
			   alert('Email Sudah Dipakai!');
				document.getElementById('exampleInputEmail1').value = "";
		  }
		} */

	}
</script>
<script src="<?php echo base_url('assets/js/migrate.js'); ?>"></script>