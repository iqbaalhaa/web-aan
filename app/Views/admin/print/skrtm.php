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
    <td colspan="4">Yang bertanda tangan dibawah ini <?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?> Kecamatan <?php echo $ds['kec'];?> Kabupaten <?php echo $ds['kab'];?>, menerangkan bahwa : </td>
  </tr>
    <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>I.</td><td colspan="3">SUAMI :</td>
  </tr>
  <tr>
    <td></td><td width="25%">Nama</td><td>:</td><td><b><?php echo $dt[1];?></b></td>
  </tr>
  <tr>
    <td></td><td>NIK</td><td>:</td><td><?php echo $dt[0];?></td>
  </tr>
    <tr>
    <td></td><td>Tmp.&Tgl. Lahir</td><td>:</td><td><?php echo ucwords($dt[2]);?>, &nbsp;<?php echo $dt[3];?></td>
  </tr>
    <tr>
    <td></td><td>Agama</td><td>:</td><td><?php echo $dt[4];?></td>
  </tr>
    <tr>
    <td></td><td>Alamat</td><td>:</td><td><?php echo $dt[5];?> <?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?></td>
  </tr>
<tr>
    <td colspan="4">&nbsp;</td>
  </tr>
<tr>
    <td>II.</td><td colspan="3">ISTRI :</td>
  </tr>
    <tr>
    <td></td><td>Nama </td><td>:</td><td><b><?php echo $dt[7];?></b></td>
  </tr>
  <tr>
    <td></td><td>NIK</td><td>:</td><td><?php echo $dt[6];?></td>
  </tr>
    <tr>
    <td></td><td>Tmp.&Tgl. Lahir</td><td>:</td><td><?php echo ucwords($dt[8]);?>, &nbsp; <?php echo $dt[9];?></td>
  </tr>
    <tr>
    <td></td><td>Agama</td><td>:</td><td><?php echo $dt[10];?></td>
  </tr>
    <tr>
    <td></td><td>Alamat</td><td>:</td><td><?php echo $dt[11];?> <?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>


    <tr>
    <td colspan="4">Warga tersebut diatas adalah bernar Warga <?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?> yang termasuk kategori Rumah Tangga Miskin.</td>
  </tr>
  <tr>
    <td colspan="4">Adapun Surat Keterangan ini dipergunakan untuk :</td>
  </tr>
  <tr>
  <td colspan="4" align="center"><br><b><?php echo strtoupper($dt[12]);?></b></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="4">Demikian keterangan ini dibuat dengan sebenarnya, untuk dapat dipergunakan sebagaimana mestinya.</td>
  </tr>

<tr><td colspan="4">
<table width="100%" align="center" border="0" cellspacing="1" cellpadding="4" class="table-print">
    <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
    </td><td width="40%"></td><td align="center" class="pull pull-right" width="40%"><?php echo $ds['desa'];?>,&nbsp;<?php echo $bulan;?></td>
  </tr>
  <tr>
   <td align="center">TKSK Kecamatan <?php echo $ds['kec'];?></td><td align="center" valign="top" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?></td>
  </tr>

  <tr>
    <td align="center"><br><br><br>_______________________</td><td align="center" class="pull pull-right"><br><br><br><br><u><b><?php echo $sr['nama'];?></b></u><br>NIP. <?php echo $ds['nipkades'];?></td>
  </tr> 
  <tr>
    <td align="center" colspan="2">Camat <?php echo $ds['kec'];?></td>
  </tr> 
  <tr>
    <td align="center" colspan="2"><br><br><br><br><b>__________________</b><br>NIP. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
</td>
</tr>
</table>
<?php endforeach; ?>

<?php endforeach; ?>