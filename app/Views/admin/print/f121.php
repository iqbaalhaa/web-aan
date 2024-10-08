<style type="text/css">
.kotak {
background-color: #; 
border: 1px solid #17202A; 
height: auto; 
margin: -2px 0px; 
padding: 2px; 
text-align: left; 
width: auto;">
}
.kotak-rtrw {
background-color: #; 
border: 1px solid #17202A; 
height: auto; 
margin: -2px 0px; 
padding: 2px; 
text-align: center; 
width: auto;">
}
.kotak-jp {
background-color: #; 
border: 1px solid #17202A; 
height: auto; 
margin: -1px 0px; 
padding: 2px; 
text-align: left; 
width: 9em;">
}
.kotak-f {
background-color: #; 
border: 2px solid #17202A; 
height: auto; 
margin: -3px 0px; 
padding: 5px;
margin-right: 5px; 
text-align: center;
font-size: 16; 
width: 5em;">
}
.kotak-kode {
background-color: #; 
border: 1px solid #17202A; 
height: auto; 
margin: 0px 0px; 
padding: 0px;
text-align: center;
width: 1.2em;">
}
</style>
<?= $this->include('templates/inc') ?>
<?php foreach ($desa as $ds) :
  // code...
foreach ($surat as $sr ) :
  $dt = explode('#', $sr['isi_surat']);
  $tgl = $sr['tanggal'];
  $bl=format_hari_tanggal($tgl);
  $bln=explode(',',$bl);
  $bulan=$bln['1'];
  $rt=$dt[8];
  $rw=$dt[9];
  $jpe=$dt[10];
  //$rtrw=substr($sr['alamat'],-7);
  //$rtrwex=explode('/',$rtrw);
  //$rt=$rtrwex[0];
  //$rw=$rtrwex[1];
?>


<h1 align="center">
<table width="100%" align="center" border="0" cellspacing="1" cellpadding="4" class="table-print">
    <tr>
    <td colspan="5" align="right"><div class="kotak-f">F-1.21</div>&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><strong>FORMULIR PERMOHONAN KARTU TANDA PENDUDUK (KTP) WARGA NEGARA INDONESIA</strong></td>
  </tr>
  <tr>
    <td colspan="5"><table align="center" width="98%" border="" cellspacing="0" cellpadding="4" rules="rows"><tr><td><small>Perhatian :
<br>1. Harap diisi dengan huruf cetak dan menggunakan tinta hitam
<br>2. Untuk kolom pilihan, harap memberi tanda silang (X) pada kotak pilihan.
<br>3. Setelah formulir ini diisi dan ditandatangani, harap diserahkan kembali ke kantor Kelurahan/Kelurahan</small>
</td></tr></table>
</td>
  </tr>
  <tr><td>

  <table align="left" width="95%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="35%">PEMERINTAH PROVINSI</td><td width="3">:</td><td width="8"><div class="kotak-kode"><?php echo substr($ds['kodeprov'],0,1);?></div></td><td width="4"><div class="kotak-kode"><?php echo substr($ds['kodeprov'],1,1);?></div></td><td></td><td></td><td><div class="kotak"> <?php echo strtoupper($ds['prov']);?></div></td>
  </tr>
  <tr>
    <td>PEMERINTAH KABUPATEN</td><td>:</td><td><div class="kotak-kode"><?php echo substr($ds['kodekab'],0,1);?></div></td><td width="8"><div class="kotak-kode"><?php echo substr($ds['kodekab'],1,1);?></div></td><td></td><td></td><td><div class="kotak"><?php echo strtoupper($ds['kab']);?></div></td>
  </tr>
  <tr>
    <td>KECAMATAN</td><td>:</td><td><div class="kotak-kode"><?php echo substr($ds['kodekec'],0,1);?></div></td><td width="8"><div class="kotak-kode"><?php echo substr($ds['kodekec'],1,1);?></div></td><td></td><td></td><td><div class="kotak"><?php echo strtoupper($ds['kec']);?></div></td>
  </tr>
  <tr>
    <td>DESA/KELURAHAN</td><td>:</td><td><div class="kotak-kode"><?php echo substr($ds['kodedesa'],0,1);?></div></td><td width="8"><div class="kotak-kode"><?php echo substr($ds['kodedesa'],1,1);?></div></td><td width="8"><div class="kotak-kode"><?php echo substr($ds['kodedesa'],2,1);?></div></td><td width="8"><div class="kotak-kode"><?php echo substr($ds['kodedesa'],3,1);?></div></td><td><div class="kotak"><?php echo strtoupper($ds['desa']);?></div></td>
  </tr>
  
  <table align="left" width="90%" border="0" cellspacing="0" cellpadding="4">
   <tr>
    <td width="35%"><u>PERMOHONAN KTP</u></td><td><div class="kotak-jp"><input type="checkbox" id="jp" name="jp" value="A" <?php echo $jpe=='A'? "checked" : '';?>><label for="jp">A. Baru</label></div></td><td><div class="kotak-jp"><input type="checkbox" id="jp" name="jp" value="B" <?php echo $jpe=='B' ? "checked" : '';?>><label for="jp">B. Perpanjangan</label></div></td><td><div class="kotak-jp"><input type="checkbox" id="jp" name="jp" value="C" <?php echo $jpe=='C' ? "checked" : '';?>><label for="jp">C. Pergantian</label></div></td>
  </tr>
</table>

</td></tr>
</table>

<tr><td colspan="4">
<table align="center" class="table-list" width="97%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="23%"><div class="kotak-jp">1. Nama Lengkap</div></td><td colspan="3"><div class="kotak"><?php echo $dt[2];?></div></td>
  </tr>
  <tr>
    <td><div class="kotak-jp">2. No. KK</div></td><td colspan="3"><div class="kotak"><?php echo $dt[1];?></div></td>
  </tr>
  <tr>
    <td><div class="kotak-jp">3. NIK</div></td><td colspan="3"><div class="kotak"><?php echo $dt[0];?></div></td>
  </tr>
    <tr>
    <td><div class="kotak-jp">4. Alamat</div></td><td colspan="3"><div class="kotak"><?php echo $dt[7];?>&nbsp; <?php echo $ds['jnp']=='Desa'? "Desa" : "Kelurahan";?> <?php echo $ds['desa'];?> <?php echo $ds['desa'];?></div></td>
  </tr>
  <tr>
    <td></td><td colspan="3"><div class="kotak">Kec. <?php echo $ds['kec'];?> &nbsp;Kab. <?php echo $ds['kab'];?></div></td>
  </tr>
  <tr>
    <td></td><td colspan="3">
      <table align="left" class="table-list" width="100%" border="0" cellspacing="0" cellpadding="2" style="margin-left: -2px;"><tr><td width="8%"><div class="kotak-rtrw">RT </div></td><td></td><td><div class="kotak-rtrw"><?php echo $rt;?></div></td><td></td><td width="8%"><div class="kotak-rtrw">RW </div></td><td></td><td><div class="kotak-rtrw"><?php echo $rw;?></div></td><td></td><td width="18%"><div class="kotak-rtrw">Kode Pos :</div></td><td></td><td><div class="kotak-rtrw"><?php echo $ds['pos'];?></div></td></td>
  </tr>
</table>
</td></tr>
<tr>
   <td colspan="3"><table align="left" class="table-list" width="100%" border="1" cellspacing="0" cellpadding="2" style="margin-left: -2px;"><tr><td width="30%" align="center">Pas Photo (2x3)</td><td width="25%" align="center">Cap Jempol</td><td width="45%" align="center">Specimen Tanda Tangan</td>
  </tr>
  <tr><td width="30%" align="center" rowspan="2"><img src="<?= base_url('assets/img/oval.png'); ?>" width="90px" height="110px"></td><td width="25%" rowspan="2"></td><td width="45%"></td>
  </tr>
  <tr><td width="45%" height="10px"><small>Ket : Cap Jempol/Tanda tangan</small></td>
  </tr>
</table>
</td><td align="center" width="40%"><?php echo $ds['desa'];?>,&nbsp;<?php echo $bulan;?><br><br><br><br><br><br><u><?php echo $dt[2];?></u></td>

</tr>
  

<tr><td colspan="5">
<table width="100%" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
    <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="center"> Mengetahui,</td>
  </tr>
  <tr>
    <td rowspan="3" align="center" width="10%"></td><td align="left">Camat <?php echo $ds['kec'];?></td><td align="center" valign="top" class="pull pull-right"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?></td>
  </tr>
  <tr>
    <td align="center" class="pull pull-right"></td>
  </tr>
  <tr>
    <td align="left" class="pull pull-right"><br><br><br>______________________<br>NIP.</td><td align="center" class="pull pull-right"><br><br><br><u><b><?php echo $sr['nama'];?></b></u><br>NIP. <?php echo $sr['nip'];?></td>
  </tr> 
</table>
</td>
</tr>
</table>
  <?php endforeach; ?>
<?php endforeach; ?>
