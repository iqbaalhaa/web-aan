<?= $this->include('templates/inc') ?>
<?php foreach ($desa as $ds) :
  // code...
  ?>
<table width="800" align="center" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td rowspan="3" width="70"><img src="<?= base_url('assets/img/'.$ds['logo']); ?>" width="60" height="60"></td>
    <td colspan="" align="center"><strong><font size=2 color="black">PEMERINTAH KABUPATEN <?= strtoupper($ds['kab']); ?></font></a>
    </strong></td><td></td>
  </tr>
    <tr>
    <td colspan="" align="center"><strong><font size=3 color="black">KECAMATAN <?= strtoupper($ds['kec']); ?></font></a>
    </strong></td><td width="70"></td>
  </tr>
    <tr>
    <td colspan="" align="center"><strong><font size=5 color="black"><?php echo strtoupper($ds['jnp']);?> <?php echo strtoupper($ds['desa']);?></font></strong></td>
    <td width="70"></td>
  </tr>
    <tr>
   <td colspan="3" align="center"><hr><font size=2 color="black"><i>Sekretariat : <?= $ds['alamat'];?></i><hr size="3"></td>
  </tr>
 
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

    <tr>
    <td colspan="3" align="center"><strong><font size=4 color="black"><u>DAFTAR PENGELUARAN RIL</u></font></a>
    </strong></td>
  </tr>
</table>
<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
    <tr>
    <td colspan="5">Yang bertanda tangan dibawah ini :</td>
  </tr>
  <tr>
    <td width="25%">Nama</td><td>: <?php echo $sr['nama']; ?></td>
  </tr>
    <tr>
    <td>NIP</td><td>: <?php echo $sr['nip']; ?></td>
  </tr>
      <tr>
    <td>Jabatan</td><td>: <?php echo $sr['jabatan']; ?></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="justify">Berdasarkan Surat Perjalanan Dinas Nomor : <?php echo $sr['no_surat']; ?>, Tanggal : <?php echo $bulan; ?>, dengan ini Kami menyatakan dengan sesungguhnya bahwa :</td>
  </tr>
   <tr>
    <td colspan="5" align="justify">1. Biaya Transfort pegawai dan/atau biaya penginapan di bawah ini yang tidak dapat diperoleh bukti - bukti pengeluarannya, meliputi :</td>
  </tr>
</table>
<table align="center" class="table-list" width="95%" border="1" cellspacing="0" cellpadding="4">
    <tr>
    <td align="center">NO</td><td width="50%">URAIAN</td><td align="center">JUMLAH</td>
  </tr>
  <tr>
    <td align="center">1.</td><td width="50%">Uang harian, Uang saku, Uang makan & Transfort lokal</td><td align="right">Rp. <?php echo format_angka($dt[9]);?></td>
  </tr>
  <tr>
    <td align="center">2.</td><td width="50%">Biaya Transfort</td><td align="right">Rp. <?php echo format_angka($dt[10]);?></td>
  </tr>
    <tr>
    <td align="center">3.</td><td width="50%">Biaya Penginapan</td><td align="right">Rp. <?php echo format_angka($dt[11]);?></td>
  </tr>
    <tr>
    <td align="center">4.</td><td width="50%">Uang Representatif</td><td align="right">Rp. <?php echo format_angka($dt[12]);?></td>
  </tr>
    <tr>
    <td align="center">5.</td><td width="50%">Sewa Kendaraan dalam Kota</td><td align="right">Rp. <?php echo format_angka($dt[13]);?></td>
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
    <td align="center"></td><td width="50%"><b>JUMLAH</b></td><td align="right"><b>Rp. <?php echo format_angka($jumlah);?></b></td>
  </tr>

      <tr>
    <td align="center"></td><td width="50%" colspan="2">Terbilang : <b><?php echo kekata($jumlah);?> Rupiah</b></td>
  </tr>

  </table>

<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
   <tr>
    <td colspan="5" align="justify">2. Jumlah uang tersebut pada angka 1 di atas benar - benar dikeluarkan untuk pelaksanaan Perjalanan Dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran, kami bersedia untuk menyetorkan kelebihan tersebut ke kas Negara.</td>
  </tr>
     <tr>
    <td colspan="5" align="justify">Demikian pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.</td>
  </tr>
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
    <td align="center">Kepala SKPD/KPA</td><td align="center" class="pull pull-right">Pelaksana SPD,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><u><b><?php echo $sr['nama'];?></b></u></td><td align="center" class="pull pull-right"><u><b><?php echo $dt['4'];?></b></u></td>
  </tr>
    <tr>
    <td align="center">NIP. <?php echo $sr['nip'];?></td><td align="center" class="pull pull-right">NIP. <?php echo $dt[5];?></td>
  </tr>
</table>
</td>
</tr>
</table>
<?php endforeach; ?>
<?php endforeach; ?>