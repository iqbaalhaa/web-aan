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
    <td colspan="3" align="center"><strong><font size=3 color="black">FORMULIR <?php echo strtoupper($sr['nama_surat']); ?>
      
    </font>
    </strong></td>
  </tr>
    <tr>
    <td></td><td></td><td align="right">Model N1 &nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><font size=3>DESA / KELURAHAN </td><td>:</td><td><?php echo strtoupper($ds['desa']);?></font></td>
  </tr>
  <tr>
    <td width="25%"><font size=3>KECAMATAN </td><td>:</td><td><?php echo strtoupper($ds['kec']);?></font></td>
  </tr>
  <tr>
    <td width="25%"><font size=3>KABUPATEN </td><td>:</td><td><?php echo strtoupper($ds['kab']);?></font></a>
    </td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><font size=3 color="black">FORMULIR PENGANTAR NIKAH
      </font>
    </strong><br><small><?php echo $sr['no_surat'];?></small></td>
  </tr>
      <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">Yang bertanda tangan dibawah ini <?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?> Kecamatan <?php echo $ds['kec'];?> Kabupaten <?php echo $ds['kab'];?>, menerangkan dengan sesungguhnya bahwa :</td>
  </tr>
  
</table>
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
  <tr>
    <td>9.</td><td> Status Pernikahan</td><td>:</td><td>$dt[8]</td>
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
  <tr>
    <td>9.</td><td> Status Pernikahan</td><td>:</td><td>$dt[20]</td>
  </tr>
  </table>" : ""; ?>

<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="4">adalah benar Anak dari Pernikahan seorang pria :</td>
  </tr>
  <tr>
    <td>1. </td><td>Nama</td><td>:</td><td><?php echo $dt[25];?> BIN <?php echo $dt[26];?></td>
  </tr>
  <tr>
    <td>2. </td><td>NIK</td><td>:</td><td><?php echo $dt[24];?></td>
  </tr>
    <tr>
    <td>3. </td><td>Jenis Kelamin</td><td>:</td><td><?php echo $dt[27];?></td>
  </tr>
  <tr>
    <td>4. </td><td>Tmp. & Tgl. Lahir </td><td>:</td><td><?php echo $dt[28];?>, <?php echo $dt[29];?></td>
  </tr>
  <tr>
    <td>5. </td><td>Kewarganegaraan</td><td>:</td><td><?php echo $dt[30];?></td>
  </tr>
    <tr>
    <td>6. </td><td>Agama</td><td>:</td><td><?php echo $dt[31];?></td>
  </tr>
  <tr>
    <td>7. </td><td>Pekerjaan</td><td>:</td><td><?php echo $dt[32];?></td>
  </tr>
    <tr>
    <td valign="top">8. </td><td valign="top">Alamat</td><td valign="top">:</td><td><?php echo $dt[33];?> </td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="4">dengan seorang wanita :</td>
  </tr>
  <tr>
    <td>1. </td><td>Nama</td><td>:</td><td><?php echo $dt[35];?> BINTI <?php echo $dt[36];?></td>
  </tr>
  <tr>
    <td>2. </td><td>NIK</td><td>:</td><td><?php echo $dt[34];?></td>
  </tr>
    <tr>
    <td>3. </td><td>Jenis Kelamin</td><td>:</td><td><?php echo $dt[37];?></td>
  </tr>
  <tr>
    <td>4. </td><td>Tmp. & Tgl. Lahir </td><td>:</td><td><?php echo $dt[38];?>, <?php echo $dt[39];?></td>
  </tr>
  <tr>
    <td>5. </td><td>Kewarganegaraan</td><td>:</td><td><?php echo $dt[40];?></td>
  </tr>
    <tr>
    <td>6. </td><td>Agama</td><td>:</td><td><?php echo $dt[41];?></td>
  </tr>
  <tr>
    <td>7. </td><td>Pekerjaan</td><td>:</td><td><?php echo $dt[42];?></td>
  </tr>
    <tr>
    <td valign="top">8. </td><td valign="top">Alamat</td><td valign="top">:</td><td><?php echo $dt[43];?></td>
  </tr>
  </table>

<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">Demikian, Surat pengantar ini dibuat dengan mengingat sumpah jabatan dan untuk dipergunakan sebagaimana mestinya.</td>
  </tr>

<tr><td colspan="4">
<table width="100%" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
    <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
    <tr>
    <td></td><td align="center" class="pull pull-right"><?php echo $ds['desa'];?>,&nbsp;<?php echo $bulan;?></td>
  </tr>
  <tr>
    <td rowspan="3"  width="50%"></td><td align="center" valign="top" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?>,</td>
  </tr>
  <tr>
    <td align="center" class="pull pull-right"></td>
  </tr>
  <tr>
    <td align="center" class="pull pull-right"><br><br><u><b><?php echo $sr['nama'];?></b></u><br>NIP. <?php echo $sr['nip'];?></td>
  </tr> 
</table>
</td>
</tr>
</table>
<?php endforeach; ?>
  <?php endforeach; ?>
