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
          <h1 align="center">
            <table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
              <tr>
                <td></td><td></td><td></b></td><td align="left"><?php echo $ds['desa'];?>, <?php echo $bulan;?>&nbsp;&nbsp;&nbsp;</td>
              </tr>
              <tr>
                <td valign="top">Perihal </td><td valign="top">:</td><td valign="top" width="45%"><b>Permohonan Izin Mendirkan Bangunan (IMB)</b></td><td align="left"></td>
              </tr>
              <tr>
                <td valign="top">Lampiran </td><td valign="top">:</td><td valign="top"> 1 (satu) berkas</td><td>Kepada : &nbsp;&nbsp;&nbsp;</td>
              </tr>
              <tr>
                <td valign="top"></td><td valign="top"></td><td valign="top"><b></td>
                  <td>Yth. <b><?php echo $dt[13];?></td>
                  </tr>
                  <tr>
                    <td></td><td></td><td></td><td>Di -</td>
                  </tr>
                  <tr>
                    <td></td><td></td><td></td><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u><?php echo $dt[14];?></u></b></td>
                  </tr>
                  <tr>
                    <td colspan="4">&nbsp;</td>
                  </tr>
                </table>
                <br>
                <table align="center" class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
                  <tr>
                    <td colspan="3">Dengan hormat, </td>
                  </tr>
                  <tr>
                    <td colspan="3">Yang bertanda tangan dibawah ini : </td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;1. Nama Pemohon</td><td>:</td><td><?php echo $dt[1];?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;2. NIK </td><td>:</td><td><?php echo $dt[0];?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;3. Jenis Kelamin </td><td>:</td><td><?php echo $dt[2];?></td>
                  </tr>
                  
                  <tr>
                    <td>&nbsp;&nbsp;4. Tmp&Tgl. Lahir </td><td>:</td><td><?php echo $dt[3];?>, <?php echo $dt[4];?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;3. Agama </td><td>:</td><td><?php echo $dt[5];?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;3. Pekerjaan </td><td>:</td><td><?php echo $dt[6];?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;4. Alamat </td><td>:</td><td><?php echo $dt[7];?></td>
                  </tr>
                  <tr>
                    <td colspan="3"></td>
                  </tr>
                  <tr>
                    <td colspan="3">Dengan ini mengajuan Izin Mendirikan Bangunan sebagai berikut :</td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;1. Jenis Bangunan</td><td>:</td><td><?php echo $dt[8];?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;2. Fungsi/Peruntukan Bangunan</td><td>:</td><td><?php echo $dt[9];?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;3. Jumlah Lantai</td><td>:</td><td><?php echo $dt[10];?> Lantai</td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;4. Ukuran Bangunan</td><td>:</td><td><?php echo $dt[11];?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;5. Lokasi</td><td>:</td><td><?php echo $dt[12];?></td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" align="justify">Demikian Permohonan ini kami sampaikan, atas perhatian serta terkabulnya permohonan ini disampaikan terima kasih.</td>
                  </tr>

                  <tr><td colspan="4">
                    <table width="90%" align="right" border="0" cellspacing="1" cellpadding="4" class="table-print">
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center">Mengetahui,</td><td align="center" class="pull pull-right"><?php echo $ds['desa'];?>,&nbsp;<?php echo $bulan;?></td>
                      </tr>
                      <tr>
                        <td width="50%" align="center"><?php echo $ds['jnp']=='Desa'? "Kepala Desa" : "Lurah";?></td><td align="center" valign="top" class="pull pull-right">Pemohon,</td>
                      </tr>
                      <tr>
                        <td></td><td align="center" class="pull pull-right"></td>
                      </tr>

                      <tr>
                        <td align="center"><br><br><br><u><b><?php echo $sr['nama'];?></b></u><br>NIP. <?php echo $ds['nipkades'];?></td><td align="center" class="pull pull-right"><br><br><br><b><u><?php echo $dt[1];?></u></b></td>
                      </tr> 

                    </table>
                  </td>
                </tr>
              </table>
            <?php endforeach; ?>
            <?php endforeach; ?>
