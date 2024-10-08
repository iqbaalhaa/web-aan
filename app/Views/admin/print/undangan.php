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
  $bl=format_hari_tanggal($tgl);
  $bln=explode(',',$bl);
  $bl2=format_hari_tanggal($tgl2);
  $bln2=explode(',',$bl2);
  $bulan=$bln['1'];
  $bulan2=$bln2['1'];
  $hari2=$bln2['0'];
  ?>

<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td></td><td></td><td></td><td align="left"><?php echo $ds['desa'];?>, <?php echo $bulan;?>&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td>Nomor </td><td>:</td><td><?php echo $sr['no_surat'];?></td><td align="left"></td>
  </tr>
      <tr>
    <td>Lampiran </td><td>:</td><td>-</td><td>Kepada Yth,&nbsp;&nbsp;&nbsp;</td>
  </tr>
    <tr>
    <td valign="top">Perihal</td><td valign="top">:</td><td valign="top" width="50%"><b><?php echo $dt[0];?></b></td>
    <td rowspan="4">
      <table align="center" class="table-list" width="98%" border="0" cellspacing="1" cellpadding="2">
        <?php $no=1;
foreach ($du as $rr) {
  // code...
  ?>
        <tr>
          <td><?php echo $no++;?>.</td>
          <td><?php echo $rr['nama_undangan'];?></td>
        </tr>
      <?php }?>
      </table>

    </td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

  <table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
    <tr>
    <td colspan="3">Assalamu 'alaikum Wr. Wb.<br></td>
  </tr>
    <tr>
    <td colspan="3">Dengan hormat,</td>
  </tr>
  <tr>
    <td colspan="3" align="justify">Dalam rangka <?php echo $dt['0'];?> <?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?> Kecamatan <?php echo $ds['kec'];?> Kabupaten <?php echo $ds['kab'];?>, mengundang Bapak/Ibu untuk dapat hadir pada : </td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Hari</td><td>:</td><td><?php echo strtoupper($hari2);?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Tanggal</td><td>:</td><td><?php echo $bulan2;?></td>
  </tr>
    <tr>
    <td>&nbsp;&nbsp;Waktu</td><td>:</td><td><?php echo $dt[3];?> WIB.</td>
  </tr>
    <tr>
    <td>&nbsp;&nbsp;Tempat</td><td>:</td><td><?php echo $dt[4];?></td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3" align="justify">Demikian undangan ini dibuat, mengingat pentingnya Acara tersebut dimohon agar kiranya dapat hadir tepat pada waktunya dan atas perhatian serta kehadirannya disampaikan terimakasih.<br></td>
  </tr>
    <tr>
    <td colspan="3">Wassalamu 'alaikum Wr. Wb.</td>
  </tr>

<tr><td></td><td></td><td>
<table width="400" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
          <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?></td>
  </tr>
      <tr>
    <td>&nbsp;</td>
  </tr>
      <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="pull pull-right"><b><u><?php echo $sr['nama'];?></u></b></td>
  </tr>
  <tr>
    <td align="center" class="pull pull-right">NIP. <?php echo $ds['nipkades'];?></td>
  </tr>  
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
  <?php endforeach; ?>
