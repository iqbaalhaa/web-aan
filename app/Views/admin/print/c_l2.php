<?= $this->include('templates/inc') ?>
<?php foreach ($desa as $ds) :
  // code...
  ?>
<?php foreach ($surat as $sr ) :
  $dt = explode('#', $sr['isi_surat']);
  $tgl = $sr['tanggal'];
  $tgl2 = $dt[2];
  $tgl3 = $dt[3];
  $bl=format_hari_tanggal($tgl);
  $bln=explode(',',$bl);
  $bl2=format_hari_tanggal($tgl2);
  $bln2=explode(',',$bl2);
  $bl3=format_hari_tanggal($tgl3);
  $bln3=explode(',',$bl3);
  $bulan=$bln['1'];
  $bulan2=$bln2['1'];
  $hari2=$bln2['0'];
  $bulan3=$bln3['1'];
  $hari3=$bln3['0'];
  ?>
<h1 align="center">

<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
    <tr>
    <td colspan="5" align="center"><font size=4><b><u>RINCIAN BIAYA PERJALANAN DINAS</u></b></font></td>
  </tr>
    <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%">Lampiran SPPD Nomor</td><td>: <?php echo $sr['no_surat']; ?></td>
  </tr>
    <tr>
    <td>Tanggal</td><td>: <?php echo $bulan; ?></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
</table>
<table align="center" class="table-list" width="800" border="1" cellspacing="0" cellpadding="4">
    <tr>
    <td align="center">NO</td><td width="50%">PERINCIAN BIAYA</td><td align="center">JUMLAH</td><td>KETERANGAN</td>
  </tr>
  <tr>
    <td align="center">1.</td><td width="50%">Uang harian, Uang saku, Uang makan & Transfort lokal</td><td align="right">Rp. <?php echo format_angka($dt[9]);?></td><td>-</td>
  </tr>
  <tr>
    <td align="center">2.</td><td width="50%">Biaya Transfort</td><td align="right">Rp. <?php echo format_angka($dt[10]);?></td><td>-</td>
  </tr>
    <tr>
    <td align="center">3.</td><td width="50%">Biaya Penginapan</td><td align="right">Rp. <?php echo format_angka($dt[11]);?></td><td>-</td>
  </tr>
    <tr>
    <td align="center">4.</td><td width="50%">Uang Representatif</td><td align="right">Rp. <?php echo format_angka($dt[12]);?></td><td>-</td>
  </tr>
    <tr>
    <td align="center">5.</td><td width="50%">Sewa Kendaraan dalam Kota</td><td align="right">Rp. <?php echo format_angka($dt[13]);?></td><td>-</td>
  </tr>
  <?php 
  $u=$dt[9];
  $t=$dt[10];
  $i=$dt[11];
  $r=$dt[12];
  $s=$dt[13];
  $jumlah=$u+$t+$i+$r+$s;
?>

      <tr>
    <td align="center"></td><td width="50%"><b>JUMLAH</b></td><td align="right"><b>Rp. <?php echo format_angka($jumlah);?></b></td><td>-</td>
  </tr>

      <tr>
    <td align="center"></td><td width="50%" colspan="2">Terbilang : <b><?php echo kekata($jumlah);?> Rupiah</b></td><td>-</td>
  </tr>

  </table>

<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>

<tr><td></td><td></td><td>
<table width="98%" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
          <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td><td align="center" class="pull pull-right"><?php echo $ds['desa'];?>, &nbsp;<?php echo $bulan;?></td>
  </tr>
    <tr>
    <td align="center">Telah dibayar sejumlah <br>Rp. <?php echo format_angka($jumlah);?></td><td align="center" class="pull pull-right">Telah menerima jumlah uang sebesar <br> Rp. <?php echo format_angka($jumlah);?></td>
  </tr>
  <tr>
    <td align="center">Bendahara Pengeluaran</td><td align="center" class="pull pull-right">Yang Menerima,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><u><b><?php foreach ($staff as $st) {
?>
      <?= $st['nama'];}?></b></u></td><td align="center" class="pull pull-right"><u><b><?php echo $dt[4];?></b></u></td>
  </tr>
    <tr>
    <td align="center" colspan="2"><hr></td>
  </tr>
  <tr>
    <td align="center" colspan="2">PERHITUNGAN SPPD RAMPUNG</td>
  </tr>
  <tr>
    <td>Ditetapkan sejumlah</td><td>: Rp. <?php echo format_angka($jumlah);?></td>
  </tr>
    <tr>
    <td>Yang telah dibayar semula</td><td>: Rp. <?php echo format_angka($jumlah);?></td>
  </tr>
    <tr>
    <td>Sisa Kurang / Lebih</td><td>: Rp. _______________</td>
  </tr>
  <tr>
    <td></td><td align="center" class="pull pull-right">Kepala SKP/KPA,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td><td align="center" class="pull pull-right"><u><b><?php echo $sr['nama'];?></b></u></td>
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
