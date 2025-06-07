<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


    <!-- Main content -->
    <section class="content">

      <div class="row">
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
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
          
			<?php
			//if('1'=='3'){
			?>
            <div class="tab-content">
		
			<form method="POST">
			
			
			
              <div class="active tab-pane" id="activity">
             <table class="table table-bordered">
			 <thead> 
			  <tr>
			 <td>Nama</td>  <td>Subject</td> <td>Pesan</td><td>Action</td>
			 </tr>
			 <tr><td><?=$kirim_pesan['data'][0]['nama_tujuan'];?></td>  
			 <td><input type="hidden"  name="id_faskes" value="<?=$kirim_pesan['id_faskes']?>"><input type="hidden"  name="id_tujuan" value="<?=$kirim_pesan['id_tujuan']?>">
			 <input type="hidden"  name="id_message" value="<?=$kirim_pesan['id_message']?>">
			 <input type="text" placeholder="subject" name="subject" value=""></td> 
			 <td><textarea  name="keterangan"></textarea></td>
			 <td><input type="submit"  name="submit" value="Kirim"></td>
			 </tr>
			
			 </thead>
			 <tbody>
			 
			 </tbody>
			 </table>
                
				
              </div>
           </form>
              </div>
			  <?php
			//}
			  ?>
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
 
