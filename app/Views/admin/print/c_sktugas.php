<?= $this->include('templates/inc') ?>
<?php foreach ($desa as $ds) :
  // code...
  

?>

<h1 align="center">
<table width="800" align="center" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td colspan="3" width="70" align="center"><img src="<?= base_url('assets/img/'.$ds['logo']); ?>" width="60" height="60"></td>
  </tr>
  <tr>
    <td colspan="" align="center"><strong><font size=4 color="black"><?php echo $ds['jnp']=='Desa'? "KEPALA DESA" : "LURAH";?> <?php echo strtoupper($ds['desa']);?></font>
    </strong></td>
  </tr>
    <tr>
    <td colspan="" align="center"><strong><font size=4 color="black">KABUPATEN <?php echo strtoupper($ds['kab']);?></font>
    </strong></td>
  </tr>

  <tr>
   <td colspan="3" align="center"></td>
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
  $s=$dt['5'];
  $sl=explode(';', $s);
  //for($i=0; $i < count(
      ?>
  <tr>
    <td colspan="3" align="center"><strong><font size=4 color="black"><u>KEPUTUSAN <?php echo $ds['jnp']=='Desa'? "KEPALA DESA" : "LURAH";?></u></font>
    </strong><br><font size=3 color="black">NOMOR : <?php echo $dt[3]; ?></font><br><br><font size=4 color="black">TENTANG</font><br><font size=4 color="black"> PEMBENTUKAN <?php echo strtoupper($dt[4]);?></font></td>
  </tr>
  <tr>
   <td colspan="3" align="center"></td>
  </tr>
  <tr>
    <td colspan="" align="center"><strong><font size=4 color="black"><?php echo $ds['jnp']=='Desa'? "KEPALA DESA" : "LURAH";?> <?php echo strtoupper($ds['desa']);?></font>
    </strong></td>
  </tr>


</table>
<br>

<table align="center" class="table-print" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>

   <td valign="top">Menimbang</td><td valign="top">:</td><td colspan="2" valign="top"><table>
          <?php $x=1; for ($i=0; $i < sizeof($mn); $i) {
            ?>
          <tr>
            <td valign="top"><?php echo $x++;?>. </td><td valign="top" align="justify"><?php echo $mn[$i++]; ?>;</td>
          </tr>
          <?php } ?>
        </table></td>
  </tr>
  <tr>
   <td valign="top">Mengingat</td><td valign="top">:</td><td colspan="2" valign="top"><table>
          <?php $n=1; for ($y=0; $y < sizeof($dh); $y) {
            ?>
          <tr>
            <td valign="top"><?php echo $n++;?>. </td><td valign="top" align="justify"><?php echo $dh[$y++]; ?>;</td>
          </tr>
          <?php } ?>
        </table></td>
  </tr>
  <tr>
   <td colspan="6" align="center">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="6" align="center"><b>MEMUTUSKAN</b></td>
  </tr>
  <tr>
   <td colspan="6" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Menetapkan</td><td valign="top">:</td><td colspan="4" valign="top" align="justify">Keputusan <?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo ucwords($ds['desa']);?> Tentang  Pembentukan <?php echo ucwords(strtolower($dt[4]));?>.
    </td>
  </tr>
  <tr>
    <td valign="top">KESATU</td><td valign="top">:</td><td colspan="4" valign="top" align="justify">Menunjuk nama - nama yang tercantum pada lampiran keputusan ini sebagai <?php echo ucwords(strtolower($dt[4]));?>.
    </td>
  </tr>
  <tr>
    <td valign="top">KEDUA</td><td valign="top">:</td><td colspan="4" valign="top" align="justify">Tim sebagaimana disebutkan pada diktum kesatu wajib melaksanakan tugas sesuai tugas dan fungsi masing - masing serta wajib melaporkan hasil kegiatannya kepada <?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo ucwords($ds['desa']);?>. 
    </td>
  </tr>
  <tr>
    <td valign="top">KETIGA</td><td valign="top">:</td><td colspan="4" valign="top" align="justify">Keputusan ini berlaku sejak tanggal ditetapkan, dengan ketentuan apabila terdapat kekeliruan dikemudian hari akan adakan perbaikan seperlunya. 
    </td>
  </tr>
  <tr><td colspan="6">
      
</td></tr>

  </table>

<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  
<tr><td></td><td></td><td>
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
    <td align="left" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?>,</td>
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
</td>
</tr>
<tr>
  <td colspan="3">Salinan Keputusan ini disampaikan kepada :</td>
</tr>
<tr>
  <td colspan="3"><table>
          <?php $m=1; for ($x=0; $x < sizeof($sl); $x) {
            ?>
          <tr>
            <td valign="top"><?php echo $m++;?>. </td><td valign="top"><?php echo $sl[$x++]; ?>;</td>
          </tr>
          <?php } ?>
        </table></td>
</tr>
</table>

  <?php endforeach; ?>
  <?php endforeach; ?>
  