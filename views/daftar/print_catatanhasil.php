<body onload="window.print()";>
<style>
     #judul {
     font-size:10px;
   }
   #font-normal {
     font-size:20px;
   }
  </style>

<table style="height: 71px;" width="859">
<tbody>
<tr>
<td width="70px"><img src="<?php echo base_url('assets/img/logo_d_enjuss.png') ?>" alt="" width="60px;" /></td>
<td><h3>CATATAN HASIL<br />MONITORING PELAKSANAAN PENELITIAN<br>RSUP PERSAHABATAN TAHUN <?=date('Y')?></h3></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>

<table style="height: 71px;" width="859">

<tbody style="background-color:grey">
<tr>
<td align="center"><img src="<?php echo base_url('assets/img/111.png') ?>" alt="" height="120px" width="859"  /></td>
</tr>
</tbody>
</table>

<p>&nbsp;</p>

<table style="height: 78px; font-size:17px;" width="859">
<tbody id="font-normal">
<tr>
<td colspan="3"><b>I. IDENTITAS PENELITIAN</b></td>
</tr>
<tr>
<td width="30%">- Nama Peneliti Utama</td>
<td width="1%">:</td>
<td width="60%"><div style="border-bottom: 1px solid;"><?=$data[0]['nama_lengkap']?></div></td>
</tr>
<tr>
<td>- Judul Peneliti</td>
<td>:</td>
<td><div style="border-bottom: 1px solid;"><?=$data[0]['judul_proposal']?></div></td>
</tr>
<tr>
<td>- Institusi (Pendidikan)</td>
<td>:</td>
<td><div style="border-bottom: 1px solid;">&nbsp;</div></td>
</tr>
<tr>
<td>- Lokasi/ Unit Kerja Pendidikan</td>
<td>:</td>
<td><div style="border-bottom: 1px solid;">&nbsp;</div></td>
</tr>
<tr>
<td>- Waktu Penelitian</td>
<td>:</td>
<td><div style="border-bottom: 1px solid;">&nbsp;</div></td>
</tr>
<tr height="30px">
<td colspan="3"></td>
</tr>
<tr>
<td colspan="3"><b>II. SURAT LOLOS KAJI ETIK (ETHICAL CLEARANCE)</b></td>
</tr>
<tr>
<td>- Surat Ethical Clearance</td>
<td>:</td>
<td><div style="border-bottom: 1px solid;">&nbsp;</div></td>
</tr>
<tr>
<td>- Nomor</td>
<td>:</td>
<td><div style="border-bottom: 1px solid;">&nbsp;</div></td>
</tr>
<tr>
<td>- Tanggal Dikeluarkan</td>
<td>:</td>
<td><div style="border-bottom: 1px solid;">&nbsp;</div></td>
</tr>
<tr height="30px">
<td colspan="3"></td>
</tr>
<tr>
<td colspan="3"><b>III. HASIL MONITORING PENELITIAN</b></td>
</tr>
<tr>
<td colspan="3">
<table width="100%">
<tr>
<td></td>
<td></td>
<td>Ya</td>
<td>Tdk</td>
<td>Keterangan :</td>
</tr>
<tr>
<td>1. Apakah fasilitas tempat layak</td>
<td>:</td>
<td><input type="checkbox" name="pilihan[]"   id="ya" value="Ya"></td>
<td><input type="checkbox" name="pilihan[]"   id="tidak" value="Tidak"></td>
<td><input type="text" name="keterangan[]" style="width:100%;" id="keterangan" value=""> </td>
</tr>
<tr>
<td>2. Apakah informed concent terbaru</td>
<td>:</td>
<td><input type="checkbox" name="pilihan[]"   id="ya" value="Ya"></td>
<td><input type="checkbox" name="pilihan[]"   id="tidak" value="Tidak"></td>
<td><input type="text" name="keterangan[]" style="width:100%;" id="keterangan" value=""> </td>
</tr>
<tr>
<td>3. Adakah Ketaatan/penolakan</td>
<td>:</td>
<td><input type="checkbox" name="pilihan[]"   id="ya" value="Ya"></td>
<td><input type="checkbox" name="pilihan[]"   id="tidak" value="Tidak"></td>
<td><input type="text" name="keterangan[]" style="width:100%;" id="keterangan" value=""> </td>
</tr>
<tr>
<td>4. Adakah formulir catatan klinis</td>
<td>:</td>
<td><input type="checkbox" name="pilihan[]"   id="ya" value="Ya"></td>
<td><input type="checkbox" name="pilihan[]"   id="tidak" value="Tidak"></td>
<td><input type="text" name="keterangan[]" style="width:100%;" id="keterangan" value=""> </td>
</tr>
<tr>
<td>5. Adakah resiko & manfaat relatif</td>
<td>:</td>
<td><input type="checkbox" name="pilihan[]"   id="ya" value="Ya"></td>
<td><input type="checkbox" name="pilihan[]"   id="tidak" value="Tidak"></td>
<td><input type="text" name="keterangan[]" style="width:100%;" id="keterangan" value=""> </td>
</tr>
<tr>
<td>6. Apakah penyimpanan data & hasil</td>
<td>:</td>
<td><input type="checkbox" name="pilihan[]"   id="ya" value="Ya"></td>
<td><input type="checkbox" name="pilihan[]"   id="tidak" value="Tidak"></td>
<td><input type="text" name="keterangan[]" style="width:100%;" id="keterangan" value=""> </td>
</tr>
<tr>
<td>7. Bagaimana subjek bekerjasama</td>
<td>:</td>
<td><input type="checkbox" name="pilihan[]"   id="ya" value="Ya"></td>
<td><input type="checkbox" name="pilihan[]"   id="tidak" value="Tidak"></td>
<td><input type="text" name="keterangan[]" style="width:100%;" id="keterangan" value=""> </td>
</tr>
<tr height="30px">
<td colspan="5"></td>
</tr>
<tr>
<td colspan="5"><textarea style="width:100%; height: 100px;">Catatan :</textarea></td>
</tr>
</table>
</td>
</tr>
<tr>
<td><b>KESIMPULAN HASIL</b></td>
<td>:</td>
<td>Penelitian yang dilaksanakan yang bersangkutan</td>
</tr>
<tr>
<td></td>
<td>:</td>
<td><input type="checkbox" name="pilihan[]"   id="ya" value="Ya"> Sesuai dengan protokol penelitian</td>
</tr>
<tr>
<td></td>
<td>:</td>
<td><input type="checkbox" name="pilihan[]"   id="tidak" value="Tidak"> Tidak Sesuai dengan protokol penelitian</td>
</tr>
<tr>
<td colspan="3">
<table width="100%">
<tr>
<td colspan="2" align="right">Jakarta, ............................2019</td>
</tr>
<tr>
<td>Mengetahui,</td>
<td>Petugas Monitoring,</td>
</tr>
<tr>
<td>Kepala Unit Kerja/Ruangan</td>
<td>Ketua/Sek/Anggota KEPK RSUP Persahabatan</td>
</tr>
<tr height="50px">
<td colspan="2"></td>
</tr>
<tr>
<td><div style="border-bottom: 1px solid;">&nbsp;</div></td>
<td><div style="border-bottom: 1px solid;">&nbsp;</div></td>
</tr>
</table>
</td>
</tr>
</tbody>
</table>


</body>