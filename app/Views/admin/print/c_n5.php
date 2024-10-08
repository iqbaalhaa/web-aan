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
<table width="97%" align="center" border="0" cellspacing="1" cellpadding="1" class="table-print">
  <tr>
    <td colspan="3"><small>LAMPIRAN IV
<br>KEPUTUSAN DIREKTUR JENDERAL BIMBINGAN MASYARAKAT ISLAM
<br>NOMOR 473 TAHUN 2020
<br>TENTANG
<br>PETUNJUK TEKNIS PELAKSANAAN PENCATATAN PERNIKAHAN</small></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><font size=3 color="black">FORMULIR SURAT IZIN ORANG TUA</font>
    </strong></td>
  </tr>
    <tr>
    <td></td><td></td><td align="right">Model N5 &nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><font size=3 color="black"><u>SURAT IZIN ORANG TUA</u></font>
    </strong></td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="5">Yang bertanda tangan dibawah ini:</td>
  </tr>
  <tr>
    <td>A.</td><td>1. </td><td>Nama</td><td>:</td><td><?php echo $dt[25];?></td>
  </tr>
      <tr>
    <td></td><td>2. </td><td>Bin</td><td>:</td><td><?php echo $dt[26];?></td>
  </tr>
  <tr>
    <td></td><td>3. </td><td>NIK</td><td>:</td><td><?php echo $dt[24];?></td>
  </tr>
  <tr>
    <td></td><td>4. </td><td>Tmp. & Tgl. Lahir </td><td>:</td><td><?php echo $dt[28];?>, <?php echo $dt[29];?></td>
  </tr>
  <tr>
    <td></td><td>5. </td><td>Kewarganegaraan</td><td>:</td><td><?php echo $dt[30];?></td>
  </tr>
    <tr>
    <td></td><td>6. </td><td>Agama</td><td>:</td><td><?php echo $dt[31];?></td>
  </tr>
  <tr>
    <td></td><td>7. </td><td>Pekerjaan</td><td>:</td><td><?php echo $dt[32];?></td>
  </tr>
    <tr>
    <td></td><td valign="top">8. </td><td valign="top">Alamat</td><td valign="top">:</td><td><?php echo $dt[33];?>  </td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>B. </td><td>1. </td><td>Nama</td><td>:</td><td><?php echo $dt[35];?></td>
  </tr>
      <tr>
    <td></td><td>2. </td><td>Binti</td><td>:</td><td><?php echo $dt[36];?></td>
  </tr>
  <tr>
    <td></td><td>3. </td><td>NIK</td><td>:</td><td><?php echo $dt[34];?></td>
  </tr>

  <tr>
    <td></td><td>4. </td><td>Tmp. & Tgl. Lahir </td><td>:</td><td><?php echo $dt[38];?>, <?php echo $dt[39];?></td>
  </tr>
  <tr>
    <td></td><td>5. </td><td>Kewarganegaraan</td><td>:</td><td><?php echo $dt[40];?></td>
  </tr>
    <tr>
    <td></td><td>6. </td><td>Agama</td><td>:</td><td><?php echo $dt[41];?></td>
  </tr>
  <tr>
    <td></td><td>7. </td><td>Pekerjaan</td><td>:</td><td><?php echo $dt[42];?></td>
  </tr>
    <tr>
    <td></td><td valign="top">8. </td><td valign="top">Alamat</td><td valign="top">:</td><td><?php echo $dt[43];?> </td>
  </tr>
    <tr>
    <td colspan="5">Adalah ayah dan Ibu Kandung / wali / pengampu dari :</td>
  </tr>
  <tr><td></td><td colspan="5">
<?php echo $dt[11]=='Tuan Rumah' ? "

<table align='center' class='table-list' width='97%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td>1.</td><td> Nama</td><td>:</td><td>$dt[1]</td>
  </tr>
  <tr>
    <td>2.</td><td> NIK</td><td>:</td><td>$dt[0]</td>
  </tr>
    <tr>
    <td>3.</td><td> Jenis Kelamin</td><td>:</td><td> $dt[3]</td>
  </tr>
  <tr>
    <td>4.</td><td> Tmp. & Tgl. Lahir </td><td>:</td><td>$dt[4], $dt[5]</td>
  </tr>
  <tr>
    <td>5.</td><td> Kewarganegaraan</td><td>:</td><td>$dt[6]</td>
  </tr>
    <tr>
    <td>6.</td><td> Agama</td><td>:</td><td>$dt[7]</td>
  </tr>
  <tr>
    <td>7.</td><td> Pekerjaan</td><td>:</td><td>$dt[9]</td>
  </tr>
  <tr>
    <td valign='top'>8.</td><td valign='top'> Alamat</td><td valign='top'>:</td><td valign='top'>$dt[10]</td>
  </tr>
  </table>" : ""; ?>
  <?php echo $dt[23]=='Tuan Rumah' ? "

<table align='center' class='table-list' width='97%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td>1.</td><td> Nama</td><td>:</td><td>$dt[13]</td>
  </tr>
  <tr>
    <td>2.</td><td> NIK</td><td>:</td><td>$dt[12]</td>
  </tr>
    <tr>
    <td>3.</td><td> Jenis Kelamin</td><td>:</td><td>$dt[15]</td>
  </tr>
  <tr>
    <td>4.</td><td> Tmp. & Tgl. Lahir </td><td>:</td><td>$dt[16], $dt[17]</td>
  </tr>
  <tr>
    <td>5.</td><td> Kewarganegaraan</td><td>:</td><td>$dt[18]</td>
  </tr>
    <tr>
    <td>6.</td><td> Agama</td><td>:</td><td>$dt[19]</td>
  </tr>
  <tr>
    <td>7.</td><td> Pekerjaan</td><td>:</td><td>$dt[21]</td>
  </tr>
  <tr>
    <td valign='top'>8.</td><td valign='top'> Alamat</td><td valign='top'>:</td><td valign='top'>$dt[22]</td>
  </tr>

  </table>" : ""; ?>

</td></tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
<td colspan="5">Memberikan izin kepada anak kami untuk melakukan pernikahan dengan : </td> 
<tr><td></td><td colspan="5">
    <?php echo $dt[11]=='Numpang Nikah' ? "

<table align='center' class='table-list' width='97%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td>1.</td><td> Nama</td><td>:</td><td>$dt[1]</td>
  </tr>
  <tr>
    <td>2.</td><td> NIK</td><td>:</td><td>$dt[0]</td>
  </tr>
    <tr>
    <td>3.</td><td> Jenis Kelamin</td><td>:</td><td> $dt[3]</td>
  </tr>
  <tr>
    <td>4.</td><td> Tmp. & Tgl. Lahir </td><td>:</td><td>$dt[4], $dt[5]</td>
  </tr>
  <tr>
    <td>5.</td><td> Kewarganegaraan</td><td>:</td><td>$dt[6]</td>
  </tr>
    <tr>
    <td>6.</td><td> Agama</td><td>:</td><td>$dt[7]</td>
  </tr>
  <tr>
    <td>7.</td><td> Pekerjaan</td><td>:</td><td>$dt[9]</td>
  </tr>
  <tr>
    <td valign='top'>8.</td><td valign='top'> Alamat</td><td valign='top'>:</td><td valign='top'>$dt[10]</td>
  </tr>
  </table>" : ""; ?>
  <?php echo $dt[23]=='Numpang Nikah' ? "

<table align='center' class='table-list' width='97%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td>1.</td><td> Nama</td><td>:</td><td>$dt[13]</td>
  </tr>
  <tr>
    <td>2.</td><td> NIK</td><td>:</td><td>$dt[12]</td>
  </tr>
    <tr>
    <td>3.</td><td> Jenis Kelamin</td><td>:</td><td>$dt[15]</td>
  </tr>
  <tr>
    <td>4.</td><td> Tmp. & Tgl. Lahir </td><td>:</td><td>$dt[16], $dt[17]</td>
  </tr>
  <tr>
    <td>5.</td><td> Kewarganegaraan</td><td>:</td><td>$dt[18]</td>
  </tr>
    <tr>
    <td>6.</td><td> Agama</td><td>:</td><td>$dt[19]</td>
  </tr>
  <tr>
    <td>7.</td><td> Pekerjaan</td><td>:</td><td>$dt[21]</td>
  </tr>
  <tr>
    <td valign='top'>8.</td><td valign='top'> Alamat</td><td valign='top'>:</td><td valign='top'>$dt[22]</td>
  </tr>

  </table>" : ""; ?>
</td></tr>
    <tr>
    <td colspan="5">Demikian Surat izin ini di buat dengan kesadaran tanpa ada paksaan dari siapapun dan untuk digunakan seperlunya..</td>
  </tr>
</table>
<tr><td colspan="3">
<table width="100%" align="right" border="0" cellspacing="1" cellpadding="0" class="table-print">
  <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td></td><td></td><td align="center" class="pull pull-right"> <?php echo $ds['desa'];?>, <?php echo $bulan;?></td>
  </tr>    <tr>
    <td align="center">Ayah,</td><td></td><td align="center" class="pull pull-right">Ibu,</td>
  </tr>
    <tr>
    <td></td><td rowspan="4" align="center" width="20%"></td> <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><u><?php echo $dt[25];?></u></td><td align="center" class="pull pull-right"><u><?php echo $dt[35];?></u></td>
  </tr>
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
<?php endforeach; ?>
