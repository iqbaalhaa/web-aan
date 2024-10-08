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
    <td colspan="3" align="center"><strong><font size=3 color="black">FORMULIR PERSETUJUAN CALON PENGANTIN
      
    </font>
    </strong></td>
  </tr>
    <tr>
    <td></td><td></td><td align="right">Model N4 &nbsp;&nbsp;&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><font size=3 color="black">SURAT PERSETUJUAN PENGANTIN
      </font>
    </strong><br><small><?php echo $sr['no_surat'];?></small></td>
  </tr>
      <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">Yang bertanda tangan dibawah ini  :</td>
  </tr>
</table>
<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="4">A. Calon Suami :</td>
  </tr>
  <tr>
    <td>1.</td><td>Nama</td><td>:</td><td><?php echo $dt[1];?></td>
  </tr>
  <tr>
    <td>2.</td><td>Bin</td><td>:</td><td><?php echo $dt[2];?></td>
  </tr>
  <tr>
    <td>3.</td><td> NIK</td><td>:</td><td><?php echo $dt[0];?></td>
  </tr>
  <tr>
    <td>4.</td><td> Tmp. & Tgl. Lahir </td><td>:</td><td><?php echo $dt[4];?>, <?php echo $dt[5];?></td>
  </tr>
  <tr>
    <td>5.</td><td> Kewarganegaraan</td><td>:</td><td><?php echo $dt[6];?></td>
  </tr>
    <tr>
    <td>6.</td><td> Agama</td><td>:</td><td><?php echo $dt[7];?></td>
  </tr>
  <tr>
    <td>7.</td><td> Pekerjaan</td><td>:</td><td><?php echo $dt[9];?></td>
  </tr>
    <tr>
    <td valign="top">8.</td><td valign="top"> Alamat</td><td valign="top">:</td><td><?php echo $dt[10];?></td>
  </tr>
      <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
<tr><td colspan="4">B. Calon Istri :</td>
  </tr>
    <tr>
    <td>1.</td><td>Nama</td><td>:</td><td><?php echo $dt[13];?></td>
  </tr>
  <tr>
    <td>2.</td><td>Binti</td><td>:</td><td><?php echo $dt[14];?></td>
  </tr>
  <tr>
    <td>3.</td><td> NIK</td><td>:</td><td><?php echo $dt[12];?></td>
  </tr>
  <tr>
    <td>4.</td><td> Tmp. & Tgl. Lahir </td><td>:</td><td><?php echo $dt[16];?>, <?php echo $dt[17];?></td>
  </tr>
  <tr>
    <td>5.</td><td> Kewarganegaraan</td><td>:</td><td><?php echo $dt[18];?></td>
  </tr>
    <tr>
    <td>6.</td><td> Agama</td><td>:</td><td><?php echo $dt[19];?></td>
  </tr>
  <tr>
    <td>7.</td><td> Pekerjaan</td><td>:</td><td><?php echo $dt[21];?></td>
  </tr>
    <tr>
    <td valign="top">8.</td><td valign="top"> Alamat</td><td valign="top">:</td><td><?php echo $dt[22];?>  </td>
  </tr>
  </table>
  
<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">Menyatakan dengan sesungguhnya bahwa atas dasar suka rela, dengan kesadaran sendiri, tanpa ada paksaan dari siapapun juga, setuju untuk melangsungkan pernikahan.
    <br>Demikian Surat persetujuan ini di buat untuk digunakan seperlunya.</td>
  </tr>

<tr><td></td><td></td><td></td></tr>
</table>
<table width="100%" align="center" border="0" cellspacing="1" cellpadding="0" class="table-print">
  <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td></td><td></td></data><td align="center" class="pull pull-right"> <?php echo $ds['desa'];?>, <?php echo $bulan;?></td>
  </tr>    
  <tr>
    <td align="center">Calon Suami,</td><td></td><td align="center" class="pull pull-right">Calon Istri,</td>
  </tr>
  <tr>
    <td></td><td rowspan="5" align="center"  width="20%"></td> <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><u><?php echo $dt[1];?></u></td><td align="center" class="pull pull-right"><u><?php echo $dt[13];?></u></td>
  </tr>
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
<?php endforeach; ?>
