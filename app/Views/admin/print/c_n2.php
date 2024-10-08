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
<table width="100%" align="center" border="0" cellspacing="1" cellpadding="1" class="table-print">
  <tr>
    <td colspan="3">LAMPIRAN IV
<br>KEPUTUSAN DIREKTUR JENDERAL BIMBINGAN MASYARAKAT ISLAM
<br>NOMOR 473 TAHUN 2020
<br>TENTANG
<br>PETUNJUK TEKNIS PELAKSANAAN PENCATATAN PERNIKAHAN</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong><font size=4 color="black">FORMULIR PERMOHONAN KEHENDAK NIKAH</font></a>
    </strong></td>
  </tr>
    <tr>
    <td></td><td></td><td align="right">Model N2 &nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td>Perihal : <b>Permohonan Kehendak Nikah</b></td><td></td><td align="right"><?php echo $ds['desa'];?>, &nbsp;<?php echo $bulan;?>&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr><?php foreach ($kua as $k) :
    // code...
  
  ?>
    <td colspan="3">Kepada Yth, <br> Kepala KUA Kecamatan / PPN LN <br> Di <br>&nbsp;&nbsp;&nbsp;&nbsp;<u><?php echo $ds['kec'];?></u></td>
  </tr>
</table>
<br>
<table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">

  <tr>
    <td colspan="3">Dengan hormat, kami mengajukan permohonan kehendak nikah untuk atas nama :</td>
  </tr>
</table>
<table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>Calon Suami</td><td>:</td><td><?php echo $dt[1];?></td>
  </tr>
    <tr>
    <td>Calon Istri</td><td>:</td><td><?php echo $dt[13];?></td>
  </tr>
  <tr>
    <td>Hari/Tanggal/Jam</td><td>:</td><td><?php echo $dt[44];?>, <?php echo IndonesiaTgl($dt[45]);?>, Jam <?php echo $dt[46];?> WIB</td>
  </tr>
    <tr>
    <td>Tempat Akad Nikah</td><td>:</td><td><?php echo $dt[47];?></td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Bersama ini kami sampaikan surat-surat yang diperlukan untuk diperiksa sebagai berikut:
    <br>1. Surat pengantar nikah dari Kelurahan/Kelurahan
    <br>2. Persetujuan calon mempelai
    <br>3. Fotokopi KTP
    <br>4. Fotokopi akte kelahiran
    <br>5. Fotokopi kartu keluarga
    <br>6. Paspoto 2x3 = 3 lembar berlatar belakang biru
    <br>7. ________________________________
    <br>8. ________________________________
    </td>
  </tr>
  </table>


<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">Demikian permohonan ini kami sampaikan, kiranya dapat diperiksa, dihadiri, dan dicatat sesuai dengan ketentuan peraturan perundang - undangan.</td>
  </tr>

<tr><td></td><td></td><td></td></tr>
</table>
<table width="100%" align="right" border="0" cellspacing="1" cellpadding="0" class="table-print">
  <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td width="35%">Diterima tanggal _________________</td><td align="center" class="pull pull-right"></td>
  </tr>   
  <tr>
    <td>Yang Menerima, <br>Kepala KUA / PPN LN</td> <td></td><td align="center" class="pull pull-right">Pemohon,</td>
  </tr>
  <tr>
     <td></td><td>&nbsp;</td>
  </tr>
  <tr>
    <td></td><td rowspan="3" align="center" width="20%"></td> <td></td>
  </tr>
  <tr>
     <td></td><td>&nbsp;</td>
  </tr>
  <tr>
    <td><u><?= $k['nm_kepala']; ?></u></td><td align="center" class="pull pull-right"><u><?= $dt[1];?></u></td>
  </tr>
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>