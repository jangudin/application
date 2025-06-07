


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                 <li ><a href="<?php echo base_url('utd/verifikasi_pengajuan_faskes_utd/').$user_id;?>">Data Dasar</a></li>
				<li  class="active"><a href="<?php echo base_url('utd/verifikasi_pengajuan_faskes_sdm_utd/').$user_id;?>">Data SDM</a></li>
				 <li ><a href="<?php echo base_url('utd/verifikasi_pengajuan_faskes_sarpras_alkes_utd/').$user_id;?>">Data Sarpras</a></li>
				  <li ><a href="<?php echo base_url('utd/verifikasi_pengajuan_faskes_alkes_utd/').$user_id;?>">Data Alkes</a></li>
	
			   <li><a href="<?php echo base_url('utd/verifikasikan_kirim_utd/').$user_id;?>">Verifikasikan</a></li>
			

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
           
		   <?php
		   if(!empty($user[0]['jenis_utd'])){
		   ?>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="" enctype='multipart/form-data'>
                    <table class="table table-bordered">
			 <tbody>
			 <tr>
				  <th>NO</th>
			      <th>SDM</th> 
                  <th>JUMLAH</th>
				  <th>KETERANGAN</th>
             </tr>
				
		<?php

			$no=0;
			foreach(dropdown_sdm_utd() as $key => $value){
			$no++;
			
	
			
			


			?>
			 <tr>
			 <td><?=$no;?></td>
			 <td><?=$value?></td>
			 
			 <?php
			 if(!empty($data)){
			 	foreach($data as $key2 => $value2){
					
				if($value2['id_sdm'] ==$key){
			 ?>
			 <td>
			 <input type="number" name="jumlah[<?=$key;?>]" value="<?=$value2['jumlah']?>"  placeholder="Jumlah" class="form-control" autocomplete="off" id="jumlah" >
			 </td>	
			 <?php
				}else{
			 ?>

			 <?php
				}
			 ?>
			
			 <?php
			}?>
			
			<?php
			}else{
			?>
			 	 <td>
			 <input type="number" name="jumlah[<?=$key;?>]" value=""    class="form-control"  placeholder="Jumlah"  autocomplete="off" id="jumlah" >
			 </td>	 
			<?php
			 }
			 ?>
			 <td width="30%"><?php 	foreach(dropdown_data_sdm_utd_sub_keterangan($key) as $key3 => $value3){ echo $value3; } ?></td>
			  <input type="hidden" name="id_sdm[]" value="<?=$key;?>">
			   </tr>
			 <?php
			}
			 ?>
			 </tbody>
	</table>
            </form>
			<?php
		   }else{
			 echo 'Harap Selesaikan Data Dasar UTD Terlebih Dahulu';  
		   }
			?>
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
 
				