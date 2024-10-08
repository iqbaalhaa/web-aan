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
  $bl=format_hari_tanggal($tgl);
  $bln=explode(',',$bl);
  $bulan=$bln['1'];
  ?>
<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
    <tr>
    <td>Nomor </td><td>:</td><td><?php echo $sr['no_surat'];?></td><td align="left"><?php echo $ds['desa'];?>, <?php echo $bulan;?>&nbsp;&nbsp;&nbsp;</td>
  </tr>
      <tr>
    <td>Lampiran </td><td>:</td><td> 1 (satu) berkas</td><td>Kepada Yth,&nbsp;&nbsp;&nbsp;</td>
  </tr>
    <tr>
    <td valign="top">Perihal</td><td valign="top">:</td><td valign="top"><b>Permohonan Penerbitan SKCK</b></td>
    <td><b><?php echo $dt[9];?></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td>Di -</td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u><?php echo $dt[10];?></u></b></td>
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
    <td colspan="3" align="justify">Bersama ini <?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?> Kecamatan <?php echo $ds['kec'];?> Kabupaten <?php echo $ds['kab'];?>, mohon agar kiranya Bapak/Ibu <?php echo $dt[9];?> bersedia menerbikan SKCK untuk warga kami sebagai berikut : </td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Nama</td><td>:</td><td><?php echo $dt[1];?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;NIK</td><td>:</td><td><?php echo $dt[0];?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Jenis Kelamin</td><td>:</td><td><?php echo $dt[2];?></td>
  </tr>
    <tr>
    <td>&nbsp;&nbsp;Tmp.&Tgl. Lahir</td><td>:</td><td><?php echo $dt[3];?>, <?php echo $dt[4];?>.</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Agama</td><td>:</td><td><?php echo $dt[5];?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;Pekerjaan</td><td>:</td><td><?php echo $dt[6];?></td>
  </tr>
    <tr>
    <td>&nbsp;&nbsp;Alamat</td><td>:</td><td><?php echo $dt[7];?></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3" align="justify">Adapun SKCK tersebut akan digunakan untuk <?php echo $dt[8];?>.<br></td>
  </tr>
    <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3" align="justify">Demikian permohonan ini kami sampaikan atas perhatian serta perkenan Bapak/Ibu <?php echo $dt[9];?> disampaikan terimakasih.<br></td>
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
