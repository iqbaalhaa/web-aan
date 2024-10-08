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
    <td colspan="3" align="center"><strong><font size=4 color="black"><u><?php echo strtoupper($dt[8]); ?> </u></font></a>
    </strong><br><font size=2 color="black">Nomor : <?php echo $sr['no_surat']; ?></font></td>
  </tr>
</table>
<br>
<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">Yang bertanda tangan dibawah ini <?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?> Kecamatan <?php echo $ds['kec'];?> Kabupaten <?php echo $ds['kab'];?>, menerangkan bahwa : </td>
  </tr>
      <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%">1. Nama</td><td>:</td><td><?php echo $dt[1];?></td>
  </tr>
  <tr>
    <td>2. NIK</td><td>:</td><td><?php echo $dt[0];?></td>
  </tr>
    <tr>
    <td>3. Jenis Kelamin</td><td>:</td><td><?php echo $dt[2];?></td>
  </tr>
  <tr>
    <td>4. Tmp. & Tgl. Lahir</td><td>:</td><td><?php echo ucwords(strtolower($dt[3]));?>, <?php echo $dt[4];?> </td>
  </tr>
  <tr>
    <td>5. Agama</td><td>:</td><td><?php echo $dt[5];?></td>
  </tr>
  <tr>
    <td>6. Pekerjaan</td><td>:</td><td><?php echo $dt[6];?></td>
  </tr>
  <tr>
    <td>7. Alamat</td><td>:</td><td><?php echo $dt[7];?> </td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3"><?php echo $dt[9];?></td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">Demikian keterangan ini dibuat, untuk dapat dipergunakan sebagaimana mestinya.</td>
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
    <td align="center" class="pull pull-right"><br><br><br><u><b><?php echo $sr['nama'];?></b></u><br>NIP. <?php echo $sr['nip'];?></td>
  </tr> 
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
  <?php endforeach; ?>
