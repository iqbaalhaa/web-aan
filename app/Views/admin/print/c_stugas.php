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
      $bulan=$bln[1];
      $m=$dt[1];
      $mn=explode(';',$m);
      $d=$dt[2];
      $dh=explode(';', $d);

      ?>
      <tr>
        <td colspan="3" align="center"><strong><font size=6 color="black"><u>SURAT TUGAS</u></font></a>
        </strong><br><font size=2 color="black">Nomor : <?php echo $sr['no_surat']; ?></font></td>
      </tr>
    </table>
    <br>

    <table align="center" class="table-print" width="800" border="0" cellspacing="1" cellpadding="2">

      <tr>
       <td valign="top" width="20%">Menimbang</td>
       <td valign="top">:</td>
       <td colspan="2" valign="top">
        <table>
          <?php $x=1; for ($i=0; $i < sizeof($mn); $i) {
            ?>
          <tr>
            <td valign="top"><?php echo $x++;?>. </td><td valign="top" align="justify"><?php echo $mn[$i++]; ?>;</td>
          </tr>
          <?php } ?>
        </table>
        </td>
      </tr>
      <tr>
       <td valign="top">Dasar Hukum</td>
       <td valign="top">:</td>
       <td colspan="2" valign="top">
        <table>
          <?php $n=1; for ($y=0; $y < sizeof($dh); $y) {
            ?>
          <tr>
            <td valign="top"><?php echo $n++;?>. </td><td valign="top" align="justify"><?php echo $dh[$y++]; ?>;</td>
          </tr>
          <?php } ?>
        </table>

        </td>
      </tr>
      <tr>
       <td colspan="6" align="center">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="6" align="center"><b>MENUGASKAN</b></td>
     </tr>
     <tr>
       <td colspan="6" align="left">Kepada :</td>
     </tr>
     <tr><td colspan="6">
      <table align="center" class="table-print" width="80%" border="1" cellspacing="1" cellpadding="2">
        <thead>
          <tr>
            <td align="center">No. </td><td>Nama </td><td>Keterangan</td>
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
  </td></tr>

</table>

<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Untuk : <b><?php echo $dt[0];?></b></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Demikian surat tugas ini dibuat agar dilaksanakan dengan penuh tanggung jawab.</td>
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
