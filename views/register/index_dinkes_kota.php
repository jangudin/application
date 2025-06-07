   <div class="nav-tabs-custom">
     <?php
      if ($this->session->flashdata('message_name') != null) {
      ?>
       <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h4><i class="icon fa fa-<?= $this->session->flashdata('icon_name'); ?>"></i> Alert!</h4>
         <?= $this->session->flashdata('message_name'); ?>
       </div>
     <?php
      }
      ?>
     <?php

      if ($this->session->flashdata('pesan_form')):
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
               <h3 class="box-title">Pendaftaran User Login Dinkes</h3>
             </div>
             <!-- /.box-header -->
             <!-- form start -->
             <form role="form" method="POST" action="">
               <div class="box-body">
                 <div class="form-group">
                   <label class="col-sm-2 control-label">Jenis User</label>
                   <div class="col-sm-5">
                     <?= form_dropdown('dinkes', array('3' => 'Dinkes Kabupaten/Kota', '2' => 'Dinkes Provinsi'), '', 'id="dinkes"  onchange="cek_dinkes(this.value)" class="form-control select2" required'); ?>
                   </div>
                   <div style="clear:both;"></div>
                 </div>
                 <div class="form-group">
                   <label class="col-sm-2 control-label">Type User</label>
                   <div class="col-sm-5">
                     <?= form_dropdown('type_user', dropdown_type_user(), '', 'id="type_user"  class="form-control select2" required'); ?>
                   </div>
                   <div style="clear:both;"></div>
                 </div>
                 <div class="form-group">
                   <label class="col-sm-2 control-label">Jabatan *</label>
                   <div class="col-sm-5">
                     <input type="text" name="jabatan" required class="form-control" autocomplete="off" placeholder="Jabatan">
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
                 <div class="form-group">
                   <label class="col-sm-2 control-label">Provinsi *</label>
                   <div class="col-sm-5">
                     <?= form_dropdown('propinsi', dropdown_propinsi_regis(), null, 'id="propinsi" class="form-control select2" required'); ?>
                   </div>
                   <div style="clear:both;"></div>
                 </div>

                 <div class="form-group" id="kota_dinkes">
                   <label class="col-sm-2 control-label">Kota/Kabupaten *</label>
                   <div class="col-sm-5">
                     <?= form_dropdown('kota', dropdown_kota(), '', 'id="kota" class="form-control select2"'); ?>
                   </div>
                   <div style="clear:both;"></div>
                 </div>

                 <div class="box-footer">
                   <?php

                    if ($this->session->flashdata('pesan_form')):
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
     function cek_dinkes(value) {
       if (value == 2) {
         $("#kota_dinkes").css("display", "none");
         $('#kota').select2("val", " ").trigger('change');
       } else if (value == 3) {
         $('#kota_dinkes').removeAttr('style');
       }
     }

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