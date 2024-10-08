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
    <td colspan="3" align="center"><strong><font size=4 color="black"><u>SURAT PERINTAH TUGAS</u></font></a>
    </strong><br><font size=2 color="black">Nomor : <?php echo $sr['no_surat']; ?></font></td>
  </tr>
</table>
<br>
<table align="center" class="table-print" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="4">Yang bertanda tangan dibawah ini :</td>
  </tr>

  <tr>
    <td></td><td>Nama</td><td>:</td><td><?php echo $sr['nama'];?></td>
  </tr>
  <tr>
    <td></td><td>NIP</td><td>:</td><td><?php echo $sr['nip'];?></td>
  </tr>
    <tr>
    <td></td><td>Pangkat</td><td>:</td><td>-</td>
  </tr>
    <tr>
    <td></td><td>Jabatan</td><td>:</td><td><?php echo $sr['jabatan'];?></td>
  </tr>
  <tr>
    <td colspan="4" align="center"></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><b>MENUGASKAN :</b></td>
  </tr>
  <tr>
    <td colspan="4" align="center"></td>
  </tr>
  <tr>
    <td></td><td>Nama</td><td>:</td><td><?php echo $dt[4];?></td>
  </tr>
  <tr>
    <td></td><td>NIP</td><td>:</td><td><?php echo $dt[5];?></td>
  </tr>
    <tr>
    <td></td><td>Pangkat</td><td>:</td><td><?php echo $dt[6];?></td>
  </tr>
    <tr>
    <td></td><td>Jabatan</td><td>:</td><td><?php echo $dt[7];?></td>
  </tr>

  </table>

<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Untuk <b><?php echo $dt[0];?></b> di <b><?php echo $dt[1];?></b> pada tanggal : <b><?php echo $bulan2;?></b> sampai dengan <b><?php echo $bulan3;?></b>.</td>
  </tr>
      <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="3">Demikian untuk menjadi maklum dan dilaksanakan dengan sebaik - baiknya.</td>
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
    <td align="center" class="pull pull-right"><b><u><?php echo $sr['nama'];?></u></b></td>
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