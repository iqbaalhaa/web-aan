<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Edit Surat Jawaban</b></h4>
               </div>
               <div class="card-body mx-5 my-3">
                  <form action="<?= base_url('admin/surat/update-jawaban'); ?>" method="post">
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
                     <h4><strong>DETAIL JAWABAN :</strong></h4>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="perihal">Perihal</label>
                           <input type="text" id="perihal" name="perihal" value="<?= $dt[0]; ?>" class="form-control col-md-12" required><small>Contoh : Laporan Pencapaian Pembayaran Pajak Bumi dan Bangunan Tahun 2023</small>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="lampiran">Lampiran</label>
                           <input type="text" id="lampiran" name="lampiran" value="<?= $dt[1]; ?>" class="form-control col-md-6" required><small>Contoh : 1 (satu) Berkas</small>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="isi">Dasar</label>
                           <textarea rows="3" id="isi" name="isi" class="form-control col-md-12" required><?= $dt[2]; ?></textarea>
                           <small>Contoh : Pencapaian Pembayaran Pajak Bumi dan Bangunan Kelurahan Dagelan sudah mencapai 75% sebagaimana data terlampir.</small>
                        </div>
                     </div>
                     <h4 class="mt-2"><strong>DASAR / LANDASAN :</strong></h4>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="dasar">Dasar</label>
                           <textarea rows="3" id="dasar" name="dasar" class="form-control col-md-12" required><?= $dt[3]; ?></textarea>
                           <small>Contoh : Surat Camat Way Sulan Nomor : 123, Tanggal 12 Oktober 2023, Perihal Laporan Pencapaian Pembayaran Pajak Bumi dan Bangunan Tahun 2023</small>
                        </div>
                     </div>
                     <h4 class="mt-2"><strong>LEMBAGA YANG DITUJU :</strong></h4>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="ke">Nama / Lembaga yang dituju</label>
                           <input type="text" id="ke" name="ke" value="<?= $dt[4]; ?>" class="form-control col-md-6" required><small>Contoh : Camat Way Asalan</small>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="di">Alamat yang dituju</label>
                           <input type="text" id="di" name="di" value="<?= $dt[5]; ?>" class="form-control col-md-12" required><small>Contoh : TEMPAT</small>
                        </div>
                     </div>
                     <br>

                  <h4 class="mt-4"><strong>PENANDA TANGAN SURAT</strong></h4>
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