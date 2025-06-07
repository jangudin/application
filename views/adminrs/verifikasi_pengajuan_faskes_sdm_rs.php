


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
          <li  ><a href="<?php echo base_url('rs/verifikasi_pengajuan_faskes_rs/').$this->encrypt->encode($user_id);?>">Data Dasar</a></li>
				<li class="active"><a href="<?php echo base_url('rs/verifikasi_pengajuan_faskes_sdm_rs/').$this->encrypt->encode($user_id);?>">Data SDM</a></li>
				 <li ><a href="<?php echo base_url('rs/verifikasi_pengajuan_faskes_tt_rs/').$this->encrypt->encode($user_id);?>">Data TT</a></li>
				  <li ><a href="<?php echo base_url('rs/verifikasi_pengajuan_pelayanan_rs/').$this->encrypt->encode($user_id);?>">Data Pelayanan</a></li>
			  
			   <li><a href="<?php echo base_url('rs/verifikasikan_kirim_rs/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
			  

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
			      <th>SDM</th>
				 
                  <th>JUMLAH</th>
             </tr>
				
		<?php

			$no=0;
			foreach(dropdown_sdm_rs() as $key => $value){
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
			}
			}else{
			?>
			 	 <td>
			 <input type="number" name="jumlah[<?=$key;?>]" value=""    class="form-control"  placeholder="Jumlah"  autocomplete="off" id="jumlah" >
			 </td>	 
			<?php
			 }
			 ?>
			  <input type="hidden" name="id_sdm[]" value="<?=$key;?>">
			   </tr>
			 <?php
			}
			 ?>
			 </tbody>
	<?php
				if(empty($data2[0]['final'])){
			?>
               <tr>
			 <td></td>
			 <td></td>
			 <td> 
			 <input type="hidden" name="id_faskes" value="<?=$user_id;?>">
			 <button type="submit" name="submit" id="submit"  class="btn btn-primary">Submit</button></td>
			 </tr>
			
			 <?php
			}else{
			 ?>
			  <tr>
			 <td></td>
			 <td></td>
			 <td> 
			<div class="box-footer">
                <font color="orange">Data Sedang DI Verifikasi</font>
              </div></td>
			 </tr>
			 
			 <?php
			}
			 ?></table>
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
 
				