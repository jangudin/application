


    <h3>DETAIL JENIS PEMERIKSAAN</h3>
	<table  class="table-bordered table-condensed" style="font-size:14px; margin:10 10 10 0px;" width="100%">
	<tr>
	<td>ID</td><td>:</td><td><?=$data[0]['id_faskes']?></td>
	</tr>
	<tr>
	<td>TYPE</td><td>:</td><td><?=$data[0]['type']?></td>
	</tr>
	<tr>
	<td>NIP</td><td>:</td><td><?=$data[0]['nik']?></td>
	</tr>
	<tr>
	<td>NAMA</td><td>:</td><td><?=$data[0]['nama']?></td>
	</tr>
	<tr>
	<td>FUNGSIONAL</td><td>:</td><td><?=$data[0]['fungsional']?></td>
	</tr>
	<tr>
	<td>FUNGSIONAL LAINNYA</td><td>:</td><td><?=$data[0]['fungsional_lainnya']?></td>
	</tr>
	<tr>
	<td>SIP</td><td>:</td><td><?=$data[0]['sip']?></td>
	</tr>
	<tr>
	<td>SIP KE</td><td>:</td><td><?=$data[0]['sip_ke']?></td>
	</tr>
	<tr>
	<td>UPLOAD DOKUMEN SIP</td><td>:</td><td>  <a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_dokumen_sip']);?>"><?=$data[0]['upload_dokumen_sip']?></a></td>
	</tr>
	<tr>
	<td>TANGGAL BERAKHIR SIP</td><td>:</td><td><?=date('d-m-Y',strtotime($data[0]['tanggal_berakhir_sip']))?></td>
	</tr>
	<tr>
	<td>STR</td><td>:</td><td><?=$data[0]['str']?></td>
	</tr>
	<tr>
	<td>UPLOAD DOKUMEN STR</td><td>:</td><td><a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_dokumen_str']);?>"><?=$data[0]['upload_dokumen_str']?></a></td>
	</tr>
	<tr>
	<td>TANGGAL BERAKHIR SIP</td><td>:</td><td><?=date('d-m-Y',strtotime($data[0]['tanggal_berakhir_str']))?></td>
	</tr>
	<tr>
	<td>PENDIDIKAN DAN PELATIHAN</td><td>:</td><td><?=$data[0]['penddikan_dan_pelatihan']?></td>
	</tr>
	<tr>
	<td>UPLOAD DOKUMEN PENDIDIKAN DAN PELATIHAN</td><td>:</td><td><a target="_blank" href="<?php echo base_url('assets/uploads/berkas_operasional/'.$data[0]['upload_dokumen_penddikan_dan_pelatihan']);?>"><?=$data[0]['upload_dokumen_penddikan_dan_pelatihan']?></a></td>
	</tr>
	<tr>
	<td>TANGGAL PENDIDIKAN DAN PELATIHAN</td><td>:</td><td><?=date('d-m-Y',strtotime($data[0]['tanggal_pendidikan_dan_pelatihan']))?></td>
	</tr>
	<tr>
	<td>JENIS PEMERIKSAAN</td><td>:</td><td><?=$data[0]['jenis_pemeriksaan']?></td>
	</tr>
	<tr>
	<td>PEMERIKSAAN TAMBAHAN</td><td>:</td><td><?=$data[0]['pemeriksaan_tambahan']?></td>
	</tr>
		<tr>
	<td>PEMERIKSAAN TAMBAHAN LAINNYA</td><td>:</td><td><?=$data[0]['pemeriksaan_tambahan_lainnya']?></td>
	</tr>


	</table>



<script type="text/javascript">




$(document).ready(function(){
	


	
	$('.footer').empty();
	$('.footer').append(' <a class="close" name="close" id="close" >Close</a>');
	$('#close').click(function(){


$(this).trigger('close.facebox');


		
	});

});





</script>

