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
  $bl=format_hari_tanggal($tgl);
  $bln=explode(',',$bl);
  $bulan=$bln['1'];
  ?>
    <tr>
    <td colspan="3" align="center"><strong><font size=4 color="black"><u><?php echo strtoupper($sr['nama_surat']); ?> </u></font></a>
    </strong><br><font size=2 color="black">Nomor : <?php echo $sr['no_surat']; ?></font></td>
  </tr>
</table>

<br>
<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">Yang bertanda tangan dibawah ini <?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?> Kecamatan <?php echo $ds['kec'];?> Kabupaten <?php echo $ds['kab'];?>, menerangkan bahwa : </td>
  </tr>
</table>
<table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="25%">Nama</td><td>:</td><td><?php echo $dt[1];?> Bin/Binti <?php echo $dt[2]; ?></td>
  </tr>
  <tr>
    <td>NIK</td><td>:</td><td><?php echo $dt[0];?></td>
  </tr>
    <tr>
    <td>Jenis Kelamin</td><td>:</td><td><?php echo $dt[3];?></td>
  </tr>
    <tr>
    <td>Agama</td><td>:</td><td><?php echo $dt[4];?></td>
  </tr>
    <tr>
    <td>Alamat</td><td>:</td><td><?php echo $dt[5];?> <?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo  $ds['desa'];?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Warga tersebut diatas adalah benar Warga <?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?> yang telah Meninggal Dunia / Mati berdasarkan Laporan dari : </td>
  </tr>
  <tr>
    <td>Nama</td><td>:</td><td><?php echo $dt[7];?></td>
  </tr>
  <tr>
    <td>NIK</td><td>:</td><td><?php echo $dt[6];?></td>
  </tr>
    <tr>
    <td>Jenis Kelamin</td><td>:</td><td><?php echo $dt[8];?></td>
  </tr>
  <tr>
    <td>Tmp.&Tgl. Lahir</td><td>:</td><td><?php echo $dt[9];?>, <?php echo $dt[10];?></td>
  </tr>
    <tr>
    <td>Agama</td><td>:</td><td><?php echo $dt[11];?></td>
  </tr>
    <tr>
    <td>Alamat</td><td>:</td><td><?php echo $dt[12];?> <?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo  $ds['desa'];?></td>
  </tr>

      <tr>
    <td>Hubungan dengan Alm./Almh.</td><td>:</td><td><?php echo $dt[18];?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><b>KETERANGAN TEMPAT/WAKTU & SEBAB KEMATIAN :</b></td>
  </tr>

  <tr>
    <td>Sebab</td><td>:</td><td><?php echo $dt[13];?></td>
  </tr>
  <tr>
    <td>Hari</td><td>:</td><td><?php echo $dt[14];?></td>
  </tr>
    <tr>
    <td>Tanggal</td><td>:</td><td><?php echo IndonesiaTgl($dt[15]);?></td>
  </tr>
    <tr>
    <td>Waktu</td><td>:</td><td><?php echo $dt[16];?> WIB</td>
  </tr>
    <tr>
    <td>Tempat</td><td>:</td><td><?php echo $dt[17];?></td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">Demikian keterangan ini dibuat dengan sebenar - benarnya untuk dapat dipergunakan sebagaimana mestinya.</td>
  </tr>
<tr><td colspan="4">
<table width="90%" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
    <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
    <tr>
    <td></td><td align="center" class="pull pull-right"><?php echo $ds['desa'];?>,&nbsp;<?php echo $bulan;?></td>
  </tr>
  <tr>
    <td rowspan="3" width="50%"></td><td align="center" valign="top" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?></td>
  </tr>
  <tr>
    <td align="center" class="pull pull-right"></td>
  </tr>
  <tr>
    <td align="center" class="pull pull-right"><br><br><br><u><b><?php echo $sr['nama'];?></b></u><br>NIP. <?php echo $ds['nipkades'];?></td>
  </tr> 
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
  <?php endforeach; ?>
