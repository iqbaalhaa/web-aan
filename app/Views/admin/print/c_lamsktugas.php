<?= $this->include('templates/inc') ?>
<?php foreach ($desa as $ds) :
  // code...
?>
<?php foreach ($surat as $sr ) :
      $dt = explode('#', $sr['isi_surat']);
      $tgl = $sr['tanggal'];
      $bl=format_hari_tanggal($tgl);
      $bln=explode(',',$bl);
      $bulan=$bln[1];
      $m=$dt[1];
      $mn=explode(';',$m);
      $d=$dt[2];
      $dh=explode(';', $d);
  $s=$dt['5'];
  $sl=explode(';', $s);
  //for($i=0; $i < count(
      ?>
<h1 align="center">
<h5>LAMPIRAN : <br>KEPUTUSAN <?php echo $ds['jnp']=='Desa'? "KEPALA DESA" : "LURAH";?>  <?php echo strtoupper($ds['desa']);?><br>NOMOR &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $dt[3]; ?> <br>TANGGAL : <?php echo $bulan;?></h5>
<h3 align="center">SUSUNAN <?php echo strtoupper($dt[4]);?></h3>
<table align="center" class="table-print" width="90%" border="1" cellspacing="1" cellpadding="2">
        <thead>
        <tr>
          <td align="center"><b>No.</b></td><td><b>Nama</b></td><td><b>Keterangan</b></td>
        </tr>
      </thead>
    <?php $no=1;
        foreach ($tugas as $rt) {
        // code...
         ?>
      <tbody>
        <tr>
          <td align="center"><?php echo $no++;?></td><td><?php echo $rt['nama_tgs'];?></td><td><?php echo $rt['ket_tgs'];?></td>
        </tr>
      </tbody>
    <?php  } ?>
      </table>

  <table width="300" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
          <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td align="left" class="pull pull-right"></td>
  </tr>
   <tr>
    <td align="left" class="pull pull-right">Ditetapkan di <?php echo $ds['desa'];?><br>Pada tanggal :<?php echo $bulan;?></td>
  </tr>    
  <tr>
    <td align="left" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?>, </td>
  </tr>
      <tr>
    <td>&nbsp;</td>
  </tr>
      <tr>
    <td>&nbsp;</td>
  </tr>
      <tr>
    <td align="left" class="pull pull-right"><b><u><?php echo $sr['nama'];?></u></b></td>
  </tr>
  <tr>
    <td align="left" class="pull pull-right">NIP. <?php echo $sr['nip'];?></td>
  </tr>
</table>
<?php endforeach ?>
<?php endforeach ?>