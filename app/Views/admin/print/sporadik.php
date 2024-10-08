<?= $this->include('templates/inc') ?>
<?php foreach ($desa as $ds) :
  // code...
  ?>

<?php foreach ($surat as $sr ) :
  $dt = explode('#', $sr['isi_surat']);
  $tgl = $sr['tanggal'];
  $bl=format_hari_tanggal($tgl);
  $bln=explode(',',$bl);
  $bulan=$bln['1'];
  ?>
<h1 align="center">
<table width="800" align="center" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td colspan="3" align="center"><strong><font size=4 color="black"><u><?php echo strtoupper($sr['nama_surat']); ?> </u></font></td>
  </tr>
</table>
<br>
<table align="center" class="table-list" width="90%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td colspan="5">Yang bertanda tangan dibawah ini : </td>
  </tr>
      <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
   <tr>
    <td width="3%">1. </td><td width="25%">Nama</td><td>:</td><td><?php echo $dt[1];?></td>
  </tr>
  <tr>
    <td>2. </td><td>NIK</td><td>:</td><td><?php echo $dt[0];?></td>
  </tr>
    <tr>
    <td>3. </td><td>Tmp.&Tgl. Lahir</td><td>:</td><td><?php echo ucwords(strtolower($dt[3]));?>, &nbsp;<?php echo $dt[4];?></td>
  </tr>
  <tr>
    <td>4. </td><td>Kewarganegaraan</td><td>:</td><td><?php echo $dt[5];?></td>
  </tr>
    <tr>
    <td>5. </td><td>Agama</td><td>:</td><td><?php echo $dt[6];?></td>
  </tr>
  <tr>
    <td>6. </td><td>Pekerjaan</td><td>:</td><td><?php echo $dt[7];?></td>
  </tr>
    <tr>
    <td>7. </td><td valign="top">Alamat</td><td valign="top">:</td><td valign="top"><?php echo $dt[8];?></td>
  </tr>
  <tr><td colspan="5">&nbsp;</td></tr>

      <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="5">Demikian ini menyatakan bahwa saya dengan itikad baik telah menguasai sebidang tanah seluas <?php echo format_angka($dt[9]);?> Ha./m2 *) yang terletak di :</td>
  </tr>
  <tr>
    <td>1.</td><td>Jalan</td><td>:</td><td colspan="2"><?php echo $dt[10];?></td>
  </tr>
  <tr>
    <td>2.</td><td>RT/RW</td><td>:</td><td colspan="2"><?php echo $dt[11];?></td>
  </tr>
  <tr>
    <td>3.</td><td><?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?></td><td>:</td><td colspan="2"><?php echo $dt[12];?></td>
  </tr>
  <tr>
    <td>4.</td><td>Kota Administrasi</td><td>:</td><td colspan="2"><?php echo $dt[13];?></td>
  </tr>
  <tr>
    <td>5.</td><td>NIB</td><td>:</td><td colspan="2"><?php echo $dt[14];?></td>
  </tr>
<tr>
    <td>6.</td><td>Status Tanah</td><td>:</td><td colspan="2"><?php echo $dt[15];?></td>
  </tr>
<tr>
    <td>7.</td><td>Dipergunakan untuk</td><td>:</td><td colspan="2"><?php echo $dt[16];?></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td><td></td>
  </tr>
  <tr>
    <td colspan="5">Batas - batas tanah :</td>
  </tr>

  <tr>
    <td>1.</td><td>Barat berbatasan dengan</td><td>:</td><td colspan="2"><?php echo $dt[19];?></td>
  </tr>
      <tr>
    <td>2.</td><td>Utara berbatasan dengan</td><td>:</td><td colspan="2"><?php echo $dt[20];?></td>
  </tr>
      <tr>
    <td>3.</td><td>Timur berbatasan dengan</td><td>:</td><td colspan="2"><?php echo $dt[21];?></td>
  </tr>
      <tr>
    <td>4.</td><td>Selatan berbatasan dengan</td><td>:</td><td colspan="2"><?php echo $dt[22];?></td>
  </tr>
    <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="5" align="justify">Bahwa bidang tanah tersebut saya kuasai/miliki <?php echo $dt[17];?> sejak tahun <?php echo $dt[18];?> yang sampai saat ini saya kuasai terus menerus, tidak dijadikan / menjadi jaminan sesuatu hutang dan tidak dalam sengketa.<br>Surat pernyataan ini saya buat dengan penuh tanggung jawab dan saya bersedia mengangkat sumpah bila diperlukan. Apabila ternyata permintaan ini tidak benar saya bersedia dituntut dihadapan pihak yang berwenang.</td>
  </tr>
<tr>
    <td>1.</td><td>Nama</td><td>:</td><td colspan="2"><?php echo $dt[23];?></td>
  </tr>
      <tr>
    <td></td><td>Umur</td><td>:</td><td colspan="2"><?php echo $dt[24];?> Tahun</td>
  </tr>
      <tr>
    <td></td><td>Pekerjaan</td><td>:</td><td colspan="2"><?php echo $dt[25];?></td>
  </tr>
      <tr>
    <td></td><td>Alamat</td><td>:</td><td colspan="2"><?php echo $dt[26];?></td>
  </tr>
  <tr>
    <td>2.</td><td>Nama</td><td>:</td><td colspan="2"><?php echo $dt[27];?></td>
  </tr>
      <tr>
    <td></td><td>Umur</td><td>:</td><td colspan="2"><?php echo $dt[28];?> Tahun</td>
  </tr>
      <tr>
    <td></td><td>Pekerjaan</td><td>:</td><td colspan="2"><?php echo $dt[29];?></td>
  </tr>
      <tr>
    <td></td><td>Alamat</td><td>:</td><td colspan="2"><?php echo $dt[30];?></td>
  </tr>
 <tr>
    <td colspan="4">Saksi - saksi :</td><td width="30%" align="center"><?php echo $ds['desa'];?>,&nbsp;<?php echo $bulan;?><br>Yang membuat pernyataan</td>
  </tr>
   <tr>
    <td>1.</td><td><?php echo $dt[23];?></td><td></td><td>(_______________)</td>
  </tr>
   <tr>
    <td colspan="4">&nbsp;<br></td><td><small style="color: grey;">Materai</small></td>
  </tr>
   <tr>
    <td>2.</td><td><?php echo $dt[27];?></td><td></td><td>(_______________)</td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td align="center"><b><u><?php echo $dt[1];?></u></b></td>
  </tr>
<tr><td colspan="4">
<table width="90%" align="right" border="0" cellspacing="1" cellpadding="2" class="table-print">
  <tr>
    <td></td><td align="center" class="pull pull-right">Mengetahui</td>
  </tr>
  <tr>
    <td rowspan="3" width="20%"></td><td align="center" valign="top" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?><br><small>No. <?php echo $sr['no_surat'];?></small></td>
  </tr>
  <tr>
    <td align="center" class="pull pull-right"></td>
  </tr>
  <tr>
    <td align="center" class="pull pull-right" width="45%"><br><br><br><u><b><?php echo $sr['nama'];?></b></u><br>NIP. <?php echo $sr['nip'];?></td>
  </tr> 
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
  <?php endforeach; ?>