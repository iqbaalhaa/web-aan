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
    <td></td><td></td><td align="right">Model N6 &nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><font size=3>DESA/KELURAHAN </td><td>:</td><td><?php echo strtoupper($ds['desa']);?></font></td>
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
    <td colspan="3" align="center"><strong><font size=3 color="black">SURAT KETERANGAN KEMATIAN SUAMI/ISTRI
      </font>
    </strong><br><small><?php echo $sr['no_surat'];?></small></td>
  </tr>
</table>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">Yang bertanda tangan dibawah ini <?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?> Kecamatan <?php echo $ds['kec'];?> Kabupaten <?php echo $ds['kab'];?>, menerangkan dengan sesungguhnya bahwa :</td>
  </tr>
    <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>1.</td><td> Nama</td><td>:</td><td><?php echo $dt[1];?></td>
  </tr>
    <tr>
    <td>2.</td><td> Bin / Binti</td><td>:</td><td><?php echo $dt[2];?></td>
  </tr>
  <tr>
    <td>3.</td><td> NIK</td><td>:</td><td><?php echo $dt[0];?></td>
  </tr>
    <tr>
    <td>4.</td><td> Jenis Kelamin</td><td>:</td><td><?php echo $dt[3];?></td>
  </tr>
  <tr>
    <td>5.</td><td> Tmp. & Tgl. Lahir </td><td>:</td><td><?php echo $dt[4];?>, <?php echo $dt[5];?></td>
  </tr>
  <tr>
    <td>6.</td><td> Kewarganegaraan</td><td>:</td><td><?php echo $dt[6];?></td>
  </tr>
    <tr>
    <td>7.</td><td> Agama</td><td>:</td><td><?php echo $dt[7];?></td>
  </tr>
    <tr>
    <td>8.</td><td> Alamat</td><td>:</td><td><?php echo $dt[8];?></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  </table>
<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td width="36%">Telah meninggal dunia pada tanggal </td><td>:</td><td><?php echo IndonesiaTgl($dt[18]);?></td>
  </tr>
    <tr>
    <td>Di </td><td>:</td><td><?php echo $dt[19];?></td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">yang bersangkutan adalah <b><?php echo $dt[20];?></b> dari :</td>
  </tr>
  </table>
<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>1. </td><td>Nama</td><td>:</td><td><?php echo $dt[10];?></td>
  </tr>
    <tr>
    <td>2.</td><td> Bin / Binti </td><td>:</td><td><?php echo $dt[11];?></td>
  </tr>
  <tr>
    <td>3. </td><td>NIK</td><td>:</td><td><?php echo $dt[9];?></td>
  </tr>
    <tr>
    <td>4. </td><td>Jenis Kelamin</td><td>:</td><td><?php echo $dt[12];?></td>
  </tr>
  <tr>
    <td>5. </td><td>Tmp. & Tgl. Lahir </td><td>:</td><td><?php echo $dt[13];?>, <?php echo $dt[14];?></td>
  </tr>
  <tr>
    <td>6. </td><td>Kewarganegaraan</td><td>:</td><td><?php echo $dt[15];?></td>
  </tr>
    <tr>
    <td>7. </td><td>Agama</td><td>:</td><td><?php echo $dt[16];?></td>
  </tr>
    <tr>
    <td>9. </td><td>Alamat</td><td>:</td><td><?php echo $dt[17];?></td>
  </tr>
  </table>

<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">Demikian surat keterangan ini dibuat dengan mengingat sumpah jabatan dan untuk digunakan seperlunya.</td>
  </tr>

<tr><td></td><td></td><td></td></tr>
</table>
<table width="90%" align="right" border="0" cellspacing="1" cellpadding="0" class="table-print">
  <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td></td><td></td><td align="center" class="pull pull-right"><?php echo $ds['desa'];?>, &nbsp;<?php echo $bulan;?></td>
  </tr>    <tr>
    <td></td><td></td><td align="center" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?>,</td>
  </tr>
        <tr>
    <td rowspan="4" align="left" width="50%"></td> <td></td>
  </tr>
      <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td><td align="center" class="pull pull-right"><br><br><u><b><?php echo $sr['nama'];?></b></u></td>
  </tr>
  <tr>
    <td></td><td align="center" class="pull pull-right">NIP. <?php echo $sr['nip'];?></td>
  </tr> 
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
<?php endforeach; ?>
