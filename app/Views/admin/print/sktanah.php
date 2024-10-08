<?= $this->include('templates/inc') ?>
<?php foreach ($desa as $ds) :
  // code...
?>
  <table width="800" align="center" border="0" cellspacing="1" cellpadding="4" class="table-print">
    <tr>
      <td rowspan="3" width="70"><img src="<?= base_url('assets/img/' . $ds['logo']); ?>" width="60" height="60"></td>
      <td colspan="" align="center"><strong>
          <font size=2 color="black">PEMERINTAH KABUPATEN <?= strtoupper($ds['kab']); ?></font></a>
        </strong></td>
      <td></td>
    </tr>
    <tr>
      <td colspan="" align="center"><strong>
          <font size=3 color="black">KECAMATAN <?= strtoupper($ds['kec']); ?></font></a>
        </strong></td>
      <td width="70"></td>
    </tr>
    <tr>
      <td colspan="" align="center"><strong>
          <font size=5 color="black"><?php echo strtoupper($ds['jnp']); ?> <?php echo strtoupper($ds['desa']); ?></font>
        </strong></td>
      <td width="70"></td>
    </tr>
    <tr>
      <td colspan="3" align="center">
        <hr>
        <font size=2 color="black"><i>Sekretariat : <?= $ds['alamat']; ?></i>
          <hr size="3">
      </td>
    </tr>
    <?php foreach ($surat as $sr) :
      $dt = explode('#', $sr['isi_surat']);
      $tgl = $sr['tanggal'];
      $bl = format_hari_tanggal($tgl);
      $bln = explode(',', $bl);
      $bulan = $bln['1'];
    ?>
      <tr>
        <td colspan="3" align="center"><strong>
            <font size=4 color="black"><u><?php echo strtoupper($sr['nama_surat']); ?> </u></font></a>
          </strong><br>
          <font size=2 color="black">Nomor : <?php echo $sr['no_surat']; ?></font>
        </td>
      </tr>
  </table>
  <br>
  <table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
    <tr>
      <td colspan="4">Yang bertanda tangan dibawah ini <?php echo $ds['jnp'] == 'Desa' ? "Kepala Desa" : "Lurah"; ?> <?php echo $ds['desa']; ?> Kecamatan <?php echo $ds['kec']; ?> Kabupaten <?php echo $ds['kab']; ?>, menerangkan bahwa : </td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="3%">1.</td>
      <td width="25%">Nama</td>
      <td>:</td>
      <td><?php echo $dt[1]; ?></td>
    </tr>
    <tr>
      <td>2.</td>
      <td>NIK</td>
      <td>:</td>
      <td><?php echo $dt[0]; ?></td>
    </tr>
    <tr>
      <td>3.</td>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td><?php echo $dt[2]; ?></td>
    </tr>
    <tr>
      <td>4.</td>
      <td>Tmp. & Tgl. Lahir</td>
      <td>:</td>
      <td><?php echo ucwords(strtolower($dt[3])); ?>, <?php echo $dt[4]; ?></td>
    </tr>
    <tr>
      <td>5.</td>
      <td>Kewarganegaraan</td>
      <td>:</td>
      <td><?php echo $dt[5]; ?></td>
    </tr>
    <tr>
      <td>6.</td>
      <td>Agama</td>
      <td>:</td>
      <td><?php echo $dt[6]; ?></td>
    </tr>
    <tr>
      <td>7.</td>
      <td>Pekerjaan</td>
      <td>:</td>
      <td><?php echo $dt[7]; ?></td>
    </tr>
    <tr>
      <td>8.</td>
      <td>Alamat</td>
      <td>:</td>
      <td><?php echo $dt[8]; ?></td>
    </tr>

    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">Warga tersebut diatas benar memiliki Tanah yang diperoleh dari <?php echo $dt[10]; ?> seluas <?php echo format_angka($dt[9]); ?> M2 <b><i>(<?php echo ucwords(terbilang($dt[9])); ?> Meter Persegi)</i></b> yang terletak di <?php echo $dt[11]; ?>, dengan batas - batas sebagai berikut :</td>
    </tr>
    <tr>
      <td>1.</td>
      <td>Barat berbatasan dengan</td>
      <td>:</td>
      <td><?php echo $dt[12]; ?></td>
    </tr>
    <tr>
      <td>2.</td>
      <td>Utara berbatasan dengan</td>
      <td>:</td>
      <td><?php echo $dt[13]; ?></td>
    </tr>
    <tr>
      <td>3.</td>
      <td>Timur berbatasan dengan</td>
      <td>:</td>
      <td><?php echo $dt[14]; ?></td>
    </tr>
    <tr>
      <td>4.</td>
      <td>Selatan berbatasan dengan</td>
      <td>:</td>
      <td><?php echo $dt[15]; ?></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">Demikian keterangan ini dibuat, untuk dapat dipergunakan sebagaimana mestinya. </td>
    </tr>

    <tr>
      <td colspan="4">
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