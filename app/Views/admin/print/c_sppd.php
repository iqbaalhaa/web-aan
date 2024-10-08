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
</table>

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
<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="60%">SKPD : <?php echo $ds['jnp']=='DESA'? "Desa" : "KELURAHAN";?> <?php echo strtoupper($ds['desa']);?></td><td></td><td>Lembar ke</td><td>:</td>
  </tr>
    <tr>
    <td></td><td></td><td>Kode No. </td><td>:</td>
  </tr>
    <tr>
    <td></td><td></td><td>Nomor </td><td>: <?php echo $sr['no_surat']; ?></td>
  </tr>
    <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="5" align="center"><font size=4><b><u>SURAT PERINTAH PERJALANAN DINAS</u></b></font></td>
  </tr>
    <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
</table>
<table align="center" class="table-list" width="800" border="1" cellspacing="0" cellpadding="4">


  <tr>
    <td align="center">1.</td><td width="40%">Nama Kepala SKPD/KPA</td><td>:</td><td colspan="2"><?php echo $sr['nama'];?></td>
  </tr>
  <tr>
    <td align="center">2. </td><td>Nama / NIP Pegawai yang melaksanakan Perjalanan Dinas</td><td>:</td><td colspan="2"><?php echo $dt[4];?> / <br>NIP.: <?php echo $dt[5];?></td>
  </tr>
    <tr>
    <td align="center" rowspan="3">3. </td><td>a. Pangkat dan Golongan</td><td>:</td><td colspan="2"><?php echo $dt[6];?></td>
  </tr>
    <tr>
    <td>b. Jabatan</td><td>:</td><td colspan="2"><?php echo $dt[7];?></td>
  </tr>
      <tr>
    <td>c. Tingkat Biaya Perjalanan Dinas</td><td>:</td><td colspan="2"><?php echo $dt[8];?></td>
  </tr>
 
  <tr>
    <td align="center">4.</td><td>Maksud Perjalanan Dinas</td><td>:</td><td colspan="2"><?php echo $dt[0];?></td>
  </tr>
  <tr>
    <td align="center">5. </td><td>Alat Angkutan yang digunakan</td><td>:</td><td colspan="2">_____________</td>
  </tr>
    <tr>
    <td align="center" rowspan="2">6 </td><td>a. Tempat Berangkat</td><td>:</td><td colspan="2"><?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?> </td>
  </tr>
    <tr>
    <td>b. Tempat Tujuan</td><td>:</td><td colspan="2"><?php echo $dt[1];?></td>
  </tr>
  <tr>
    <td align="center" rowspan="3">7. </td><td>a. Lamanya Perjalanan Dinas</td><td>:</td><td colspan="2">_____ Hari *)</td>
  </tr>
    <tr>
    <td>b. Tanggal Berangkat</td><td>:</td><td colspan="2"><?php echo $bulan2;?></td>
  </tr>
    <tr>
    <td>c. Tanggal Harus Kembali / Tiba ditempat Baru *)</td><td>:</td><td colspan="2"><?php echo $bulan3;?></td>
  </tr>
    <?php foreach ($jsppd as $rrr) {

      // code...
?>
    <tr>
    <td align="center" rowspan="<?php echo(int)$jsppd['jdata']+1; ?>">8. </td><td>Pengikut :  Nama</td><td></td><td>Tanggal Lahir</td><td>Keterangan</td>
  </tr>
  <?php }?>
   <?php $no=1; foreach ($sppd as $rr) {
      // code...
?>
  <tr>
    <td><?php echo $no++; ?>. <?php echo $rr['nama_pd'];?></td><td></td><td><?php echo $rr['tgll_pd'];?></td><td><?php echo $rr['ket_pd'];?></td>
  </tr>
<?php }?>

  <tr>
    <td align="center" rowspan="3">9. </td><td>Pembebanan Anggaran</td><td></td><td colspan="2"></td>
  </tr>
   <tr>
    <td>a. Instansi</td><td></td><td colspan="2"><?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?></td>
  </tr>
   <tr>
    <td>b. Akun</td><td></td><td colspan="2">__________________</td>
  </tr>
    <tr>
    <td align="center">10. </td><td>Keterangan lain</td><td>:</td><td colspan="2">-</td>
  </tr>
  </table>

<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>

<tr><td></td><td></td><td>
<table width="400" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
          <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td align="center" class="pull pull-right"><?php echo $ds['desa'];?>, &nbsp;<?php echo $bulan;?></td>
  </tr>    <tr>
    <td align="center" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?>,</td>
  </tr>
      <tr>
    <td>&nbsp;</td>
  </tr>
      <tr>
    <td>&nbsp;</td>
  </tr>
      <tr>
    <td align="center" class="pull pull-right"><u><b><?php echo $sr['nama'];?></b></u></td>
  </tr>
        <tr>
    <td align="center" class="pull pull-right">NIP. <?php echo $sr['nip'];?></td>
  </tr>
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
  <?php endforeach; ?>
