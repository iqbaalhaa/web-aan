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
      $bulan=$bln['1'];
      ?>
      <tr>
        <td colspan="3" align="center"><strong><font size=4 color="black"><u><?php echo strtoupper($sr['nama_surat']); ?> </u></font></a>
        </strong><br><font size=2 color="black">Nomor : <?php echo $sr['no_surat']; ?></font></td>
      </tr>
    </table>

    <table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td colspan="3" align="justify">Yang bertanda tangan dibawah ini adalah Warga <?php echo $dt[6];?>, Menyatakan bahwa kami benar - benar tidak keberatan adanya Pendirian, Renovasi, Perluasan Bangunan/Bangun Bangunan yang diperuntukan <b><?php echo $dt[5];?></b> milik <?php echo $dt[1];?> sepanjang tidak mengganggu lingkungan tempat warga sekitar tinggal, <br><br>Adapun yang menyetujui surat izin gangguan ini adalah nama – nama sebagai berikut : </td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">
          <table align="center" class="table-list" width="95%" border="1" cellspacing="1" cellpadding="2">
            <tr>
              <td width="5%" align="center">No</td><td width="30%" align="center">Nama</td><td width="40%" align="center">Alamat</td><td width="25%" align="center">Tanda Tangan</td>
            </tr>
            <?php
            $jr=$dt['7'];
            for($x=1;$x<=$jr;$x++){ ?>
             <tr>
              <td width="5%" align="center"><?php echo $x; ?>.</td><td width="30%"></td><td width="40%"></td><td width="25%" align="center"><small>.....................</small></td>
            </tr>
          <?php } ?>
        </table>
      </td>

      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="justify">Demikian Surat izin gangguan ini dibuat dengan sebenarnya, untuk dipergunakan untuk <?php echo $dt[8];?>.</td>
      </tr>

      <tr><td colspan="4">
        <table width="100%" align="center" border="0" cellspacing="1" cellpadding="4" class="table-print">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td></td><td align="center" class="pull pull-right"><?php echo $ds['desa'];?>,&nbsp;<?php echo $bulan;?></td>
          </tr>
          <tr>
            <td width="50%" align="center">Ketua RT</td><td align="center" valign="top" class="pull pull-right">Ketua RW,</td>
          </tr>
          <tr>
            <td></td><td align="center" class="pull pull-right"></td>
          </tr>
          <tr>
            <td align="center"><br><br><br>_________________</td><td align="center" class="pull pull-right"><br><br><br>_________________</td>
          </tr> 
          <tr>
            <td align="center" valign="top" class="pull pull-right" colspan="2">Mengetahui, <br><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?> <?php echo $ds['desa'];?></td>
          </tr>
          <tr>
            <td align="center" class="pull pull-right" colspan="2"></td>
          </tr>
          <tr>
            <td align="center" class="pull pull-right" colspan="2"><br><br><br><u><b><?php echo $sr['nama'];?></b></u><br>NIP. <?php echo $ds['nipkades'];?></td>
          </tr> 
        </table>
      </td>
    </tr>
  </table>
<?php endforeach; ?>
<?php endforeach; ?>
