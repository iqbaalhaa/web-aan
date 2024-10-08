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
  $tglm = $dt[7];
  $blm=format_hari_tanggal($tglm);
  $blnm=explode(',',$blm);
  $bulanm=$blnm['1'];
?>

<body onLoad="window.print()" style='font-family: Bookman Old Style ; font-size: 12pt;' >
<h1 align="center">
<table width="800" align="center" border="0" cellspacing="1" cellpadding="4" class="table-print">
  
    <tr>
    <td colspan="3" align="center"><strong><font size=4 color="black"><u>PERNYATAAN AHLI WARIS ANAK KANDUNG</u></font>
    </strong></td>
  </tr>
</table>
<br>
<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3" align="justify">Kami yang bertanda tangan dibawah ini, Ahli Waris dari Alm/Almh 
<?php echo $dt[1]; ?> menyatakan dan menerangkan dengan sesungguhnya 
serta sanggup diangkat sumpah bahwa Alm/Almh <?php echo $dt[1]; ?> adalah benar telah 
meninggal dunia pada tanggal <?php echo $bulanm; ?> di <?php echo $dt[8]; ?> dan bertempat 
tinggal terakhir di jalan <?php echo $dt[6]; ?>.<br>
Semasa hidupnya, Alm/Almh <?php echo $dt[1]; ?> telah melangsungkan pernikahan 
dengan <?php echo $dt[9]; ?> (jika suami/istri masih hidup). Dari pernikahan Alm/Almh 
<?php echo $dt[1]; ?> dengan <?php echo $dt[9]; ?> telah dikaruniai <?php echo $dt[10]; ?> (<?php echo kekata($dt[10]); ?> ) orang anak kandung yang masih hidup, yang merupakan ahli waris yang sah dari Alm/Almh 
<?php echo $dt[1]; ?> dengan <?php echo $dt[9]; ?> yakni: </td>
  </tr>
      <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
  <table align="center" class="table" width="98%" border="0" cellspacing="2" cellpadding="2">
<?php $no=1;
    $ke=1;
    $ke2=1; foreach ($waris as $raw ) {

?>
    <tr>
      <td align="left" width="3%" valign="top"><?php echo $no++;?>.</td><td align="center" width="12%" valign="bottow"><p style="box-shadow: 1px 1px 1px; width:80px; height: 100px;"><small><br><br>Pas Photo<br>2x3 cm</small></p></td>
      <td valign="top"><?php echo $raw['nm'];?>, <?php if ($raw['jk']=='L') echo 'Laki-laki';?><?php if ($raw['jk']=='P') echo 'Perempuan';?>, <?php echo $raw['ttl'];?>, <?php echo $raw['agama'];?>, <?php echo $raw['alamat'];?>,<?php echo $raw['shdk'];?>, adalah Anak Kandung ke <?php echo $ke++;?> (<?php echo kekata($ke2++);?> ) dari Alm/Almh. <?php echo $dt[1]; ?> dan <?php echo $dt[9]; ?>.
</td>
</tr><?php } ?>

</table>
<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3" align="justify">Disini dapat kami jelaskan bahwa selain nama-nama tersebut di atas, kami menyatakan bahwa tidak ada Ahli Waris lain dari alm/Almh. <?php echo $dt[1]; ?> dan <?php echo $dt[9]; ?>.<br>
Surat Pernyataan Ahli Waris ini kami buat dengan sesunggguhnya, apabila surat pernyataan ini 
tidak benar dan/atau ada pihak lain yang mengaku sebagai ahli waris dengan membawa bukti –
bukti yang sah dan otentik maka dengan sendirinya Surat Pernyataan Ahli Waris ini batal (tidak 
berlaku lagi).<br>
Demikian Surat Pernyataan Ahli Waris ini kami buat dengan sesungguhnya dan sebenar-benarnya, apabila ada kesalahan/kebohongan dalam pernyataan ini, kami bersedia dituntut dipengadilan.</td>
  </tr>

<tr><td colspan="4">
<table width="98%" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td><u>Ahli Waris :</u></td><td></td><td></td>
  </tr>
<?php $noo=1; foreach ($waris as $raww ) {
  
?>
  <tr>
    <td width="30%"><?php echo $noo++;?>. <?php echo $raww['nm'];?><br>&nbsp;</td><td>(___________)<br>&nbsp;</td>
  </tr><?php } ?>
  <tr>
    <td><u>Saksi - saksi :</u></td><td></td><td align="center" class="pull pull-right"><?php echo $ds['desa'];?>,&nbsp;<?php echo $bulan;?><br>Mengetahui,<br><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?></td>
  </tr>
  <tr>
    <td>1. ______________________</td><td>(___________)</td><td><br>&nbsp;</td>
  </tr>
  <tr>
    <td>2. ______________________</td><td>(___________)</td><td><br>&nbsp;</td>
  </tr>
  <tr>
    <td>3. ______________________</td><td>(___________)</td><td align="center" valign="top" class="pull pull-right"><u><b><?php echo $sr['nama'];?></b></u><br>NIP. <?php echo $sr['nip'];?></td>
  </tr>
  
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
  <?php endforeach; ?>
