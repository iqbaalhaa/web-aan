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
  ?>
<table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="4" align="center"><strong><font size=4 color="black"><u><?php echo strtoupper($sr['nama_surat']); ?> </u></font>
    </strong></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">Yang bertanda tangan dibawah ini :</td>
  </tr>
    <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="3%">1. </td><td width="20%">Nama</td><td>:</td><td><?php echo $dt[1];?></td>
  </tr>
  <tr>
    <td>2. </td><td>NIK</td><td>:</td><td><?php echo $dt[0];?></td>
  </tr>
    <tr>
    <td>3. </td><td>Tmp.&Tgl. Lahir</td><td>:</td><td><?php echo ucwords(strtolower($dt[2]));?>, &nbsp;<?php echo $dt[3];?></td>
  </tr>
  <tr>
    <td>4. </td><td>Kewarganegaraan</td><td>:</td><td><?php echo $dt[4];?></td>
  </tr>
    <tr>
    <td>5. </td><td>Agama</td><td>:</td><td><?php echo $dt[5];?></td>
  </tr>
  <tr>
    <td>6. </td><td>Pekerjaan</td><td>:</td><td><?php echo $dt[6];?></td>
  </tr>
    <tr>
    <td>7. </td><td valign="top">Alamat</td><td valign="top">:</td><td valign="top"><?php echo $dt[7];?></td>
  </tr>
  <tr><td colspan="3">&nbsp;</td></tr>
<tr>
    <td colspan="4">Dengan ini menyatakan dengan sesungguhnya bahwa saya BELUM / SUDAH *) menikah.
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
    <tr>
    <td colspan="4">Demikian pernyataan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</td>
  </tr>

<tr><td colspan="4">
<table width="90%" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td></td>
            <td align="center" class="pull pull-right"><?php echo $ds['desa']; ?>,&nbsp;<?php echo $bulan; ?></td>
          </tr>
          <tr>
            <td rowspan="3" width="50%"></td>
            <td align="center" valign="top" class="pull pull-right"><?php echo $ds['jnp'] == 'Desa' ? "Kepala Desa" : "Lurah"; ?> <?php echo $ds['desa']; ?></td>
          </tr>
          <tr>
            <td align="center">
              <img align="center" src="<?= base_url('assets/img/stemttd.png'); ?>" style="width: 270px; margin-top:-30px; margin-bottom:-30px">
            </td>
          </tr>
          <tr>
            <td style="margin-top:-290px" align="center" class="pull pull-right"><u><b><?php echo $sr['nama']; ?></b></u><br>NIP. <?php echo $ds['nipkades']; ?></td>
          </tr>
        </table>
</td>
</tr>
</table>
  <?php endforeach; ?>
<?php endforeach; ?>
