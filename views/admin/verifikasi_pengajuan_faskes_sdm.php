


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li ><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes/').$this->encrypt->encode($user_id);?>">Data Dasar</a></li>	  
			   <li ><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_alkes/').$this->encrypt->encode($user_id);?>">Data Sarpras & Alkes</a></li>
			   <li class="active"><a href="<?php echo base_url('dashboard/verifikasi_pengajuan_faskes_sdm/').$this->encrypt->encode($user_id);?>">Data SDM</a></li>
			    <?php
				if($this->session->userdata('id_kategori') =='1'){
			   ?>
			   <li><a href="<?php echo base_url('dashboard/verifikasikan_kirim/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
			   <?php
			   }else if($this->session->userdata('id_kategori') =='3'){
			   ?>
			    <li><a href="<?php echo base_url('dashboard/verifikasikan_kirim/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
			   <?php
			   }
			   ?>

            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
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
			foreach(dropdown_sdm($user[0]['jenis_klinik']) as $key => $value){
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
			<?=$value2['jumlah']?>
			 
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
			 <td></td>	
			 </td>	 
			<?php
			 }
			 ?>
			  <td><?php foreach(dropdown_sdm_keterangan($key) as $key2 => $value2){ echo $value2;  }?></td>
			   </tr>
			 <?php
			}
			 ?>
			 </tbody>
			
	
	
			 </table>
				
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
 
				