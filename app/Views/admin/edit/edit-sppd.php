<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Edit Surat Perintah Perjalanan Dinas</b></h4>
                  </div>
                  <div class="card-body mx-5 my-3">
                  <form action="<?= base_url('admin/surat/update-sppd'); ?>" method="post">
                     <?= csrf_field() ?>
                     <?php $validation = \Config\Services::validation(); ?>

                     <?php if (session()->getFlashdata('msg')) : ?>
                     <div class="pb-2">
                        <div class="alert alert-danger">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <i class="material-icons">close</i>
                           </button>
                           <?= session()->getFlashdata('msg') ?>
                        </div>
                     </div>
                  <?php endif; ?>
                  <!-- CSRF token --> 
                  <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                  <?php foreach($surat as $data): ?>
                     <div class="row mt-2">
                        <div class="col-md-6">
                           <label for="no_surat">Kode Surat</label>
                           <input type="text" id="kode_surat" name="kode_surat" value="<?= $data['kode_surat']; ?>" class="form-control col-md-6"  required readonly style="font-size: 18px; box-shadow: 4px 4px 6px;">
                           <input type="hidden" id="id" name="id" value="<?= $data['id_surat']; ?>" class="form-control col-md-6" required>
                           <input type="hidden" id="user" name="user" value="<?= user()->toArray()['id']; ?>" class="form-control col-md-6" required>
                        </div>
                        <div class="col-md-6">
                           <label for="no_surat">Nomor Surat</label>
                           <input type="text" id="no_surat" name="no_surat" value="<?= $data['no_surat']; ?>" class="form-control col-md-12" required readonly style="font-size: 18px; box-shadow: 4px 4px 6px;">
                        </div>
                  </div>
                  <?php $dt = explode('#', $data['isi_surat']); ?>
                  <hr>
                     <h4><strong>KETERANGAN PERJALANAN DINAS :</strong></h4>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="kegiatan">Kegiatan / Acara</label>
                           <input type="text" id="kegiatan" name="kegiatan" value="<?= $dt[0]; ?>" class="form-control col-md-12" required>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12">
                           <label for="tempat">Tempat Tujuan</label>
                           <input type="text" id="tempat" name="tempat" value="<?= $dt[1]; ?>" class="form-control col-md-12" required>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-3">
                           <label for="tgl1">Tanggal Berangkat</label>
                           <input type="date" id="tgl1" name="tgl1" value="<?= $dt[2]; ?>" class="form-control col-md-12" required>
                        </div>
                        <div class="col-md-3">
                           <label for="tgl2">Tanggal Kembali</label>
                           <input type="date" id="tgl2" name="tgl2" value="<?= $dt[3]; ?>" class="form-control col-md-12" required>
                        </div>
                     </div>
                     <br>
                     <h4 class="mt-2"><strong>PELAKSANA SPD :</strong></h4>
                     <hr>
                     <div class="row mt-2">
                        <div class="col-md-6 mt-2">
                           <label for="nama">Nama Lengkap</label>
                           <input type="text" id="nama" name="nama" value="<?= $dt[4]; ?>" class="form-control col-md-12" required>
                        </div>
                        <div class="col-md-6 mt-2">
                           <label for="nip">NIP</label>
                           <input type="text" id="nip" name="nip" value="<?= $dt[5]; ?>" class="form-control col-md-8">
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-6 mt-2">
                           <label for="pangkat">Pangkat</label>
                           <input type="text" id="pangkat" name="pangkat" value="<?= $dt[6]; ?>" class="form-control col-md-12">
                        </div>
                        <div class="col-md-6 mt-2">
                           <label for="jabatan">Jabatan</label>
                           <input type="text" id="jabatan" name="jabatan" value="<?= $dt[7]; ?>" class="form-control col-md-12">
                        </div>
                     </div>

                     <br>
                     <div class="panel-body">
                        <h4 class="mt-2"><strong>DATA YANG TURUT SERTA :</strong></h4>
                        <hr>
                        <div class="control-group after-add-more">
                           <table width="100%" class="">
                              <tr>
                                <td width="50%">Nama</td>
                                <td width="25%">Tanggal Lahir</td>
                                <td width="25%">Keterangan</td>
                                <td></td>
                             </tr>
                             <?php foreach ($sppd as $r) {
                                // code...
                             ?>
                             <tr>
                              <td width="50%"><input type="hidden" id="idpd" name="idpd[]" value="<?= $r['id']; ?>"><input type="hidden" id="kode_suratpd" name="kode_suratpd[]" value="<?php echo $r['kode_pd']; ?>">
                              <input type="text" name="namapd[]" value="<?php echo $r['nama_pd']; ?>"class="form-control">
                              </td>
                              <td width="25%"><input type="text" name="tgllpd[]" value="<?php echo $r['tgll_pd']; ?>" class="form-control"></td>
                              <td width="25%"><input type="text" name="ketpd[]" value="<?php echo $r['ket_pd']; ?>" class="form-control"></td>
                              <td><button class="btn btn-success add-more" type="button"><i class="material-icons">add</i>
                              </button></td>
                           </tr>
                        <?php } ?>
                        </table>
                     </div>
                     <div class="copy invisible">
                       <div class="control-group">
                          <table width="100%" class="">
                            <tr>
                              <td width="50%"><input type="hidden" id="kode_suratpd" name="kode_suratpd[]" value="<?php echo $data['kode_surat']; ?>">
                                 <input type="text" name="namapd[]" class="form-control">
                              </td>
                              <td width="25%"><input type="text" name="tgllpd[]" class="form-control"></td>
                              <td width="25%"><input type="text" name="ketpd[]" class="form-control"></td>
                              <td><button class="btn btn-danger remove" type="button"><i class="material-icons">remove</i></button></td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </div>
               <h4><strong>KETERANGAN BIAYA PERJALANAN DINAS :</strong></h4>
               <hr>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="biaya">Tingkat Biaya</label>
                           <select id="biaya" name="biaya" class="form-control col-md-4" required>
                              <option value="<?php echo $dt[8]; ?>" selected><?php echo $dt[8]; ?></option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>
                              <option value="D">D</option>
                              <option value="E">E</option>
                              <option value="F">F</option>
                           </select>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-2 mt-2">
                           <label for="uh">Uang Harian</label>
                           <input type="text" id="uh" name="uh" value="<?php echo $dt[9]; ?>" class="form-control col-md-12">
                        </div>
                        <div class="col-md-2 mt-2">
                           <label for="tr">Transfort</label>
                           <input type="text" id="tr" name="tr" value="<?php echo $dt[10]; ?>" class="form-control col-md-12">
                        </div>

                        <div class="col-md-2 mt-2">
                           <label for="inap">Penginapan</label>
                           <input type="text" id="inap" name="inap" value="<?php echo $dt[11]; ?>" class="form-control col-md-12">
                        </div>
                        <div class="col-md-2 mt-2">
                           <label for="rep">Representatif</label>
                           <input type="text" id="rep" name="rep" value="<?php echo $dt[12]; ?>" class="form-control col-md-12">
                        </div>

                        <div class="col-md-3 mt-2">
                           <label for="sewa">Sewa Kendaraan</label>
                           <input type="text" id="sewa" name="sewa" value="<?php echo $dt[13]; ?>" class="form-control col-md-8">
                        </div>
                     </div>
                     <br>
               <h4 class="mt-2"><strong>PENANDA TANGAN SURAT / KPA / KEPALA SKPD:</strong></h4>
               <hr>
               <div class="form-group mt-2">
                     <label for="ttd">Penanda Tangan Surat : &nbsp;</label>
                     <select name="ttd" class="custom-select col-md-4" required >
                        <option value="<?= $data['ttd']; ?>"><?= $data['nama']; ?> (<?= $data['jabatan']; ?>)</option>
                        <?php foreach ($staff as $vp) : ?>
                           <?php
                           $id = $vp['id'];
                           $nprf = "{$vp['nama']} ({$vp['jabatan']})";
                           ?>
                           <option value="<?= $id; ?>">
                              <?= "$nprf"; ?>
                           </option>
                        <?php endforeach; ?>
                     </select>
                  </div>
               <hr>
               <button type="submit" name="type" value="pdf" class="btn btn-info btn-block">Cetak</button>
            </form>
             <?php endforeach; ?>
            <hr>
         </div>
      </div>
   </div>
</div>
</div>
</div>

<script type="text/javascript">
 $(document).ready(function() {
   $(".add-more").click(function(){ 
    var html = $(".copy").html();
    $(".after-add-more").after(html);
 });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove",function(){ 
       $(this).parents(".control-group").remove();
    });
   });
</script>
<?= $this->endSection() ?>