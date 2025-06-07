<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
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
            <ul class="nav nav-tabs">
            <li ><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes/').$user_id;?>">Data Dasar</a></li>	  
            <?php
                // var_dump($user[0]['id_kategori']);
					if ($user[0]['id_kategori']==4 || $user[0]['id_kategori']==5){
				?>
					<li class="active"><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_alkes_new/').$user_id;?>">Data Alkes</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_obat/').$user_id;?>">Data Obat</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_gambar/').$user_id;?>">Data Dokumen</a></li>
				<?php
					} else {
				?>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_alkes/').$user_id;?>">Data Sarpras & Alkes</a></li>
					<li><a href="<?php echo base_url('pm/verifikasi_pengajuan_faskes_sdm/').$user_id;?>">Data SDM</a></li>
				<?php
					}
				?>
			    <?php
				if($this->session->userdata('id_kategori') =='1'){
			   ?>
			   <li><a href="<?php echo base_url('pm/verifikasikan_kirim/').$user_id;?>">Verifikasikan</a></li>
			   <?php
			   }else if($this->session->userdata('id_kategori') =='3'){
			   ?>
			    <li><a href="<?php echo base_url('pm/verifikasikan_kirim/').$user_id;?>">Verifikasikan</a></li>
			   <?php
			   }
			   ?>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
            <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <!-- left column -->
        <div class="col-md-12" >
          <!-- general form elements -->
          <div class="box box-primary">
      
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
                    <table class="table table-bordered">
			 <tbody>
			 <tr>
                <th>NO</th>
                <th>Tipe</th>
                <th>Nama Elemen</th>	 
                <th>Nilai</th>
                <th>Nilai Dua</th>
                <th>Nilai Tiga</th>
             </tr>
				
		<?php
			$no=0;
			foreach(dropdown_alkes_pm($user[0]['id_kategori']) as $key => $value){
			$no++;

			?>
			 <tr>
			 <td><?=$no;?></td>

                <td><?php foreach(dropdown_alkes_pm_type($key) as $key2 => $value2){ echo $value2;  }?></td>
                <td><?=$value?></td>

             <?php
                                                            if(!empty($data)){
                                                                foreach($data as $key2 => $value2){
                                                                    if($value2['id_alkes_obat'] ==$key){
                                                            ?>
                                                                        <td>
                                                                            <?=($value2['is_checked']=='1' ? '&#10004;' : '')?> 
                                                                        </td>
                                                                        <td>
                                                                            <?php foreach(dropdown_alkes_pm_label_nilai_dua($key) as $key4 => $label_nilai_dua){ 
                                                                                    echo $label_nilai_dua;
                                                                                        if($key == 1 || $key == 13){
                                                                                            ?>
                                                                                            </br>
                                                                                            <?=form_dropdown('nilai_dua['.$key.']', dropdown_sumber_air(), $value2['nilai_dua'],'id="nilai_dua" required class="form-control select2" disabled');?>
                                                                                            
                                                                                        <?php
                                                                                            } else if($key == 2 || $key == 14){
                                                                                                ?>
                                                                                                </br>
                                                                                                <?=form_dropdown('nilai_dua['.$key.']', dropdown_sumber_listrik(), $value2['nilai_dua'],'id="nilai_dua" required class="form-control select2" disabled');?>
                                                                                        <?php
                                                                                            } else {
                                                                                                if($label_nilai_dua=='' || $label_nilai_dua==null){
                                                                                                ?>
                                                                                                    <input type="hidden" name="nilai_dua[<?=$key;?>]" placeholder=""  value="">
                                                                                                    
                                                                                                    <?php
                                                                                                        }else{
                                                                                                    ?>
                                                                                                    <input type="text" class="form-control" name="nilai_dua[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="<?=$value2['nilai_dua']?>" disabled>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                }
                                                                                ?>
                                                                            </br>
                                                                        </td>
                                                                        <td>
                                                                            <?php foreach(dropdown_alkes_pm_label_nilai_tiga($key) as $key5 => $label_nilai_tiga){ 
                                                                                echo $label_nilai_tiga;  
                                                                                    if($label_nilai_tiga=='' || $label_nilai_tiga==null){
                                                                                    ?>
                                                                                        <input type="hidden" name="nilai_tiga[<?=$key;?>]" placeholder=""  value="">
                                                                                        
                                                                                        <?php
                                                                                            }else{
                                                                                        ?>
                                                                                        <input type="text" class="form-control" name="nilai_tiga[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="<?=$value2['nilai_tiga']?>" disabled>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                        </td>
                                                            <?php
                                                                    } else {

                                                                    }
                                                                }	
                                                            }else{
                                                            ?>
                                                            <td>
                                                                <input type="checkbox" name="is_checked[<?=$key;?>]"  <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? 'required' : '');  }?>   value="1">
                                                                </br>
                                                                <?php foreach(dropdown_alkes_pm_label_nilai_satu($key) as $key3 => $label_nilai_satu){ echo $label_nilai_satu;  }?>
                                                                <!-- <input type="radio" id="chkYes<?=$key;?>" name="is_checked[<?=$key;?>]" value="1"> <label for="chkYes<?=$key;?>"><?php foreach(dropdown_alkes_pm_label_nilai_satu($key) as $key3 => $label_nilai_satu){ echo $label_nilai_satu;  }?></label>
                                                                <input type="radio" id="chkNo<?=$key;?>" name="is_checked[<?=$key;?>]" value="2"> <label for="chkNo<?=$key;?>"><?php foreach(dropdown_alkes_pm_label_nilai_dua($key) as $key4 => $label_nilai_dua){ echo $label_nilai_dua;  }?></label> -->
                                                            </td>
                                                            <td>
                                                                <?php foreach(dropdown_alkes_pm_label_nilai_dua($key) as $key4 => $label_nilai_dua){ 
                                                                        echo $label_nilai_dua;
                                                                        if($key == 1 || $key == 13){
                                                                            ?>
                                                                            </br>
                                                                            <?=form_dropdown('nilai_dua['.$key.']', dropdown_sumber_air(), '','id="nilai_dua" required class="form-control select2"');?>
                                                                            
                                                                        <?php
                                                                            } else if($key == 2 || $key == 14){
                                                                                ?>
                                                                                </br>
                                                                                <?=form_dropdown('nilai_dua['.$key.']', dropdown_sumber_listrik(), '','id="nilai_dua" required class="form-control select2"');?>
                                                                        <?php
                                                                            } else {
                                                                                if($label_nilai_dua=='' || $label_nilai_dua==null){
                                                                                ?>
                                                                                    <input type="hidden" name="nilai_dua[<?=$key;?>]" placeholder=""  value="">
                                                                            
                                                                            <?php
                                                                                }else{
                                                                            ?>
                                                                            <input type="text" class="form-control" name="nilai_dua[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="">
                                                                                    <?php
                                                                                }
                                                                            }  
                                                                    }
                                                                    ?>
                                                                </br>
                                                                
                                                                
                                                            </td>

                                                            <td>
                                                                <?php foreach(dropdown_alkes_pm_label_nilai_tiga($key) as $key5 => $label_nilai_tiga){ 
                                                                    echo $label_nilai_tiga;  
                                                                        if($label_nilai_tiga=='' || $label_nilai_tiga==null){
                                                                        ?>
                                                                            <input type="hidden" name="nilai_tiga[<?=$key;?>]" placeholder=""  value="">
                                                                            
                                                                            <?php
                                                                                }else{
                                                                            ?>
                                                                            <input type="text" class="form-control" name="nilai_tiga[<?=$key;?>]" placeholder="" <?php foreach(dropdown_alkes_pm_auth($key) as $auth => $valueauth){ echo ($valueauth=='wajib ada' ? '' : '');  }?> value="">
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                
                                                                
                                                            </td>

                                                            <!-- <td>
                                                                <?php 
                                                                    if($key == 1 || $key == 13){
                                                                ?>
                                                                Sumber Air
                                                                <input type="text" name="submer" value=""   id="sumber"  >
                                                                </br>
                                                                Nomor pelanggan PDAM
                                                                <input type="text" name="submer" value=""   id="sumber"  >
                                                                <?php
                                                                    } else if($key == 2 || $key == 14){
                                                                        ?>
                                                                        Sumber Listrik
                                                                        <input type="text" name="submer" value=""   id="sumber"  >
                                                                        </br>
                                                                        Nomor pelanggan PLN
                                                                        <input type="text" name="submer" value=""   id="sumber"  >
                                                                <?php
                                                                    } else if($key == 11 || $key == 21){
                                                                        ?>
                                                                        Nama perusahaan (terdaftar di KLHK)
                                                                        <input type="text" name="submer" value=""   id="sumber"  >
                                                                        </br>
                                                                        No. izin perusahaan transportasi/pengolahan limbah di KLHK
                                                                        <input type="text" name="submer" value=""   id="sumber"  >
                                                                <?php
                                                                    }
                                                                ?>
                                                            </td> -->
                                                            <?php
                                                            }
                                                            ?>
			
			  <input type="hidden" name="id_sarpras_alkes[]" value="<?=$key;?>">
			   
			   </tr>
			 <?php
			}
			 ?>
			 </tbody>
		
			 <tr>
			 <td colspan="3" align="center"></td>
			 </tr>
		
			  
			 </table>
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
   $(function() {
	  $('.select2').select2();
	  $('[data-mask]').inputmask();
     $("#datepicker").datepicker({autoclose: true});
   });
   
      $('[name="id_prov"]').change(function() {
		 $('#id_kota').val('');
		    $.ajax({
         url: "<?php echo site_url('dashboard/dropdown4')?>/" + $(this).val(),
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
   
   </script>
