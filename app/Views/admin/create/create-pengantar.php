<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Input Surat Pengantar</b></h4>
                  <!-- <p class="card-category">Angkatan 2022/2023</p> -->               </div>
                  <div class="card-body mx-5 my-3">
                     <form action="<?= base_url('admin/surat/create-pengantar'); ?>" method="post">
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
                     <?php foreach ($max as $maxval) : 
                        $kodesurat = $maxval;
                        $urutan = (int) substr($kodesurat, 2, 4);
                        $urutan++;

                        $huruf = "SR";
                        $kodesurat = $huruf . sprintf("%04s", $urutan);
                        $nourut = sprintf("%04s", $urutan);
                        ?>

                        <div class="row mt-2">
                           <?php foreach ($jenis as $jn) : ?>
                              <div class="col-md-6">
                                 <label for="no_surat">Kode Surat</label>
                                 <input type="text" id="kode_surat" name="kode_surat" value="<?php echo $kodesurat; ?>" class="form-control col-md-6" required readonly style="font-size: 18px; box-shadow: 4px 4px 6px;">
                                 <input type="hidden" id="user" name="user" value="<?= user()->toArray()['id']; ?>" class="form-control col-md-6" required>
                                 <input type="hidden" id="nama_surat" name="nama_surat" value="<?= $jn['nama_surat']; ?>" class="form-control col-md-6" required>
                                 <input type="hidden" id="kode_jenis" name="kode_jenis" value="<?= $jn['kode_jenis']; ?>" class="form-control col-md-6" required>
                              </div>
                              <div class="col-md-6">
                                 <label for="no_surat">Nomor Surat</label>
                                 <input type="text" id="no_surat" name="no_surat" value="<?= $jn['klasifikasi_surat']; ?>/<?php echo $nourut; ?>/<?php echo getRomawi(date('m'));?>/<?php echo date('Y'); ?>" class="form-control col-md-12" required readonly style="font-size: 18px; box-shadow: 4px 4px 6px;">
                              </div>
                           <?php endforeach; ?>
                        <?php endforeach; ?>
                     </div>
                     <hr>
                     <h4><strong>DETAIL PENGANTAR :</strong></h4>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="perihal">Perihal</label>
                           <input type="text" id="perihal" name="perihal" class="form-control col-md-12" required><small>Contoh : Laporan Penduduk Bulan Oktober 2023</small>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="lampiran">Lampiran</label>
                           <input type="text" id="lampiran" name="lampiran" class="form-control col-md-6" required><small>Contoh : 1 (satu) Berkas</small>
                        </div>
                     </div>
                     <h4 class="mt-2"><strong>DASAR / LANDASAN :</strong></h4>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="dasar">Dasar</label>
                           <textarea rows="3" id="dasar" name="dasar" class="form-control col-md-12" required></textarea>
                           <small>Contoh : Surat Camat Way Asalan Nomor : 123, Tanggal 28 Oktober 2023, Perihal Laporan Penduduk Bulan Oktober 2023</small>
                        </div>
                     </div>
                     <h4 class="mt-2"><strong>LEMBAGA YANG DITUJU :</strong></h4>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="lembaga">Nama / Lembaga yang dituju</label>
                           <input type="text" id="lembaga" name="lembaga" class="form-control col-md-6" required><small>Contoh : Camat Way Asalan</small>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="alamat">Alamat yang dituju</label>
                           <input type="text" id="alamat" name="alamat" class="form-control col-md-12" required><small>Contoh : TEMPAT</small>
                        </div>
                     </div>
                     <br>
               <h4 class="mt-2"><strong>PENANDA TANGAN SURAT :</strong></h4>
               <hr>
               <div class="form-group mt-2">
                  <label for="ttd">Penanda Tangan Surat : &nbsp;</label>
                  <select name="ttd" class="custom-select col-md-4" required >
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