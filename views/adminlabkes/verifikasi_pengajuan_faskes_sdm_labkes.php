


  <!-- Main content -->
    <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
           <li  ><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_labkes/').$this->encrypt->encode($user_id);?>">Data Dasar</a></li>
			  <li ><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_alkes_labkes/').$this->encrypt->encode($user_id);?>" >Data Sarpras & Alkes</a></li>
			  <li class="active" ><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_sdm_labkes/').$this->encrypt->encode($user_id);?>">Data SDM</a></li>
			   <li ><a href="<?php echo base_url('labkes/verifikasi_pengajuan_faskes_jenis_pemeriksaan_labkes/').$this->encrypt->encode($user_id);?>">Data Pelayanan</a></li>
			  
			   <li><a href="<?php echo base_url('labkes/verifikasikan_kirim_labkes/').$this->encrypt->encode($user_id);?>">Verifikasikan</a></li>
			  

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
     
	   <table class="table table-bordered">
			 <tbody>
			 <tr>
			  <th>NO</th>
			     <th>NAMA</th>
				 <th>JABATAN</th>
                 <th>PENDIDIKAN</th>
		
             </tr>
			<?php
			$no=0;
			foreach($data as $key => $value){
				$no++;
			?>
			 <tr>
			 <td><?=$no?></td>
			 <td><?=$value['nama']?></td>
			 <td><?=$value['jabatan']?></td>
			 <td><?=$value['pendidikan']?></td>
			
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
 
				