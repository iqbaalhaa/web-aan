<?= $this->include('templates/inc') ?>
<?php foreach ($desa as $ds) :
  // code...
  ?>
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
<h1 align="center">
<table align="center" class="table-list" width="95%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td></td>
    <td width="50%">
        <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr><td>I.</td><td width="30%">Berangkat dari </td><td>:</td><td><?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?></td></tr>
          <tr><td></td><td>Ke</td><td>:</td><td><?php echo $dt[1];?></td></tr>
          <tr><td></td><td>Pada Tanggal </td><td>:</td><td><?php echo IndonesiaTgl($dt[2]);?></td></tr>
          <tr><td></td><td>Kepala SKPD</td></tr>
          <tr><td></td><td colspan="3"> <br> <br> <br> <br><u><b><?php echo $sr['nama'];?></b></u></td></tr>
          <tr><td></td><td colspan="3">NIP. <?php echo $sr['nip'];?></td></tr>
        </table>
    </td>
  </tr>
    <tr>

    <td width="50%" valign="top">
        <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr><td>II.</td><td width="30%">Tiba di </td><td>:</td><td><?php echo $dt[1];?></td></tr>
          <tr><td></td><td>Pada Tanggal </td><td>:</td><td>____/_____/_______</td></tr>
          <tr><td></td><td>Kepala SKPD</td></tr>
          <tr><td></td><td colspan="3"> <br> <br> <br><br> <br>_________________________</td></tr>
          <tr><td></td><td colspan="3">NIP. _____________________</td></tr>
        </table>
    </td>
    <td width="50%">
        <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr><td>&nbsp;&nbsp;</td><td width="30%">Berangkat dari </td><td>:</td><td>__________________</td></tr>
          <tr><td></td><td>Ke</td><td>:</td><td>__________________</td></tr>
          <tr><td></td><td>Pada Tanggal </td><td>:</td><td>____/_____/_______</td></tr>
          <tr><td></td><td>Kepala SKPD</td></tr>
          <tr><td></td><td colspan="3"> <br> <br> <br> <br>_________________________</td></tr>
          <tr><td></td><td colspan="3">NIP. _____________________</td></tr>
        </table>
    </td>
  </tr>
  <tr>
    <td width="50%" valign="top">
        <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr><td>III.</td><td width="30%">Tiba di </td><td>:</td><td>__________________</td></tr>
          <tr><td></td><td>Pada Tanggal </td><td>:</td><td>____/_____/_______</td></tr>
          <tr><td></td><td>Kepala SKPD</td></tr>
          <tr><td></td><td colspan="3"> <br> <br><br> <br> <br>_________________________</td></tr>
          <tr><td></td><td colspan="3">NIP. _____________________</td></tr>
        </table>
    </td>
    <td width="50%">
        <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr><td>&nbsp;&nbsp;</td><td width="30%">Berangkat dari </td><td>:</td><td>__________________</td></tr>
          <tr><td></td><td>Ke</td><td>:</td><td><?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?></td></tr>
          <tr><td></td><td>Pada Tanggal </td><td>:</td><td>____/_____/_______</td></tr>
          <tr><td></td><td>Kepala SKPD</td></tr>
          <tr><td></td><td colspan="3"> <br> <br> <br> <br>_________________________</td></tr>
          <tr><td></td><td colspan="3">NIP. _____________________</td></tr>
        </table>
    </td>
  </tr>
  <tr>
    <td width="50%" valign="top">
        <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr><td>IV.</td><td width="30%">Tiba di </td><td>:</td><td>__________________</td></tr>
          <tr><td></td><td>Pada Tanggal </td><td>:</td><td>____/_____/_______</td></tr>
          <tr><td></td><td>Kepala SKPD</td></tr>
          <tr><td></td><td colspan="3"> <br> <br><br> <br> <br>_________________________</td></tr>
          <tr><td></td><td colspan="3">NIP. _____________________</td></tr>
        </table>
    </td>
    <td width="50%">
        <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr><td>&nbsp;&nbsp;</td><td width="30%">Berangkat dari </td><td>:</td><td>__________________</td></tr>
          <tr><td></td><td>Ke</td><td>:</td><td><?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?></td></tr>
          <tr><td></td><td>Pada Tanggal </td><td>:</td><td>____/_____/_______</td></tr>
          <tr><td></td><td>Kepala SKPD</td></tr>
          <tr><td></td><td colspan="3"> <br> <br> <br> <br>_________________________</td></tr>
          <tr><td></td><td colspan="3">NIP. _____________________</td></tr>
        </table>
    </td>
  </tr>
    <tr>
    <td width="50%" valign="top">
        <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr><td>V.</td><td width="30%">Tiba di </td><td>:</td><td>__________________</td></tr>
          <tr><td></td><td>Pada Tanggal </td><td>:</td><td>____/_____/_______</td></tr>
          <tr><td></td><td>Kepala SKPD</td></tr>
          <tr><td></td><td colspan="3"> <br> <br><br> <br><br> <br>_________________________</td></tr>
          <tr><td></td><td colspan="3">NIP. _____________________</td></tr>
        </table>
    </td>
    <td width="50%">
        <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr><td>&nbsp;&nbsp;</td><td colspan="2" rowspan="3" align="justify">Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata - mata untuk kepentingan jabatan dalam waktu yang sesingkat - singkatnya.</td></tr>
          <tr><td></td></tr>
          <tr><td></td></tr>
          <tr><td></td><td>Kepala SKPD</td></tr>
          <tr><td></td><td colspan="3"> <br> <br> <br> <br><u><b><?php echo $sr['nama'];?></b></u></td></tr>
          <tr><td></td><td colspan="3">NIP. <?php echo $sr['nip'];?></td></tr>
        </table>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr><td>V. </td><td width="100%" colspan="2">&nbsp;Catatan lain - lain </td></tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2">
      <table align="center" class="table-list" width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr><td>VI.</td><td width="100%" colspan="2">PERHATIAN </td></tr>
        <tr><td></td><td width="100%" colspan="2" align="justify">KPA yang menerbitkan SPPD, Pegawai yang melakukan perjalanan Dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan - peraturan Keuangan Negara apabila Negara menderita rugi akibat kesalahan, kelalaian dan kealpaannya.</td></tr>
      </table></td>
  </tr>
</table>


<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>

<tr><td></td><td></td><td>

</td>
</tr>
</table>
  <?php endforeach; ?>
  <?php endforeach; ?>
