<?= $this->include('templates/inc') ?>
<?php foreach ($desa as $ds) :
  // code...
 $bl=format_hari_tanggal($bulan);
 $bln=explode(',',$bl);
 $bulan2=$bln['1'];
 $bulan3=explode(" ", $bulan2);
 $bulan4=$bulan3[2];
 $bulan5=$bulan3[3];
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
   <tr>
     <td colspan="3" align="center"><strong><font size=4 color="black"><u>LAPORAN ADMINISTRASI SURAT</u></font>
     </strong><br><font size=3 color="black">Bulan : <?php echo $bulan4; ?> <?php echo $bulan5; ?></font></td>
  </tr>
</table>

<div class="card">
   <div class="card-header card-header-tabs card-header-info">
      <div class="nav-tabs-navigation">
         <div class="row">
            <div class="col-md-6">
               <div class="nav-tabs-wrapper">
                  <div class="col-md-6">
                     <p class="d-inline"><b>Data Administrasi Surat </b></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="card-body table-responsive">
      <?php if (!$empty) : ?>
         <table align="center" width="100%" border="1" cellpadding="6" cellspacing="1">
            <thead class="text-primary">
               <th><b>No</b></th>
               <th><b>Tanggal</b></th>
               <th><b>No. Surat</b></th>
               <th><b>Kode</b></th>
               <th><b>Nama Surat</b></th>
            </thead>
            <tbody>
               <?php $i = 1;
               foreach ($surat as $value) : ?>
                  <tr>
                     <td><?= $i; ?></td>
                     <td><?= IndonesiaTgl($value['tanggal']); ?></td>
                     <td><?= $value['no_surat']; ?></td>
                     <td><?= $value['kode_surat']; ?></td>
                     <td><?= $value['nama_surat']; ?></td>
                  </tr>
                  <?php $i++;
               endforeach; ?>
            </tbody>
         </table>
      <?php else : ?>
         <div class="row">
            <div class="col">
               <h4 class="text-center text-danger">Data tidak ditemukan</h4>
            </div>
         </div>
      <?php endif; ?>
      <br>
      <?php 
      $t=format_hari_tanggal(date('Y-m-d'));
      $tg=explode(',', $t);
      $tgl=$tg[1];
      ?>
      <div class="row col-md-10">
         <table width="100%">
            <tr>
               <td width="50%"></td>
               <td align="center"><?php echo $ds['desa'];?>,&nbsp;<?php echo $tgl;?><br>Staff</td>
            </tr>
            <tr>
               <td width="50%"></td>
               <td align="center"><br><br></td>
            </tr>
            <tr>
               <td width="50%"></td>
               <td align="center"><u><?= strtoupper(user()->toArray()['username']); ?></u></td>
            </tr>
         </table>
      </div>
      
   </div>
   <?php endforeach; ?>       