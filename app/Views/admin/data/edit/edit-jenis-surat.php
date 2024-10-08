<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Edit Jenis Surat Desa</b></h4>
               </div>
               <div class="card-body mx-3 my-3">
                  <form action="<?= base_url('admin/data/update-jenis-surat'); ?>" method="post">
                     <?= csrf_field() ?>
                     <?php $validation = \Config\Services::validation(); ?>
<?php foreach ($jenis as $value) : ?>
                     
                  <!-- CSRF token --> 
                  <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
 
                  <h4 class="mt-4"><strong>JENIS SURAT : </strong></h4>
                  <hr>
                  <div class="row mt-2">
               </div>
                  <input type="hidden" name="id" value="<?= $value['id']; ?>" class="form-control col-md-12" required>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label>Kode Jenis</label>
                        <input type="text" name="kode_jenis" value="<?= $value['kode_jenis']; ?>" class="form-control col-md-12" required readonly>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label>Kode Klasifikasi</label>
                        <select name="kode_klasifikasi" value="<?= $value['klasifikasi_surat']; ?>" class="form-control col-md-12" required>
                           <option value="<?= $value['klasifikasi_surat']; ?>" selected><?= $value['klasifikasi_surat']; ?></option>
                        <?php foreach ($klasifikasi as $jk) {
                           // code...
                           ?>
                           <option value="<?= $jk['kode']; ?>"><?= $jk['kode']; ?> <?= $jk['klasifikasi']; ?></option>
                        <?php } ?>
                     </select>
                     </div>

                     <div class="col-md-6">
                        <label>Nama Surat</label>
                        <input type="text" name="nama_surat" value="<?= $value['nama_surat']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-4">
                        <label>Page Link</label>
                        <input type="text" name="page" value="<?= $value['page']; ?>" class="form-control col-md-12" required readonly>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label>Persyaratan</label>
                        <input type="text" name="persyaratan" value="<?= $value['persyaratan']; ?>" class="form-control col-md-12" >
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" value="<?= $value['keterangan']; ?>" class="form-control col-md-12">
                     </div>
                  </div>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-6" align="left">
                        <a href="<?= base_url('admin/data/jenis-surat');?>" class="btn btn-info">&nbsp;&nbsp;Kembali&nbsp;&nbsp;</a>
                     </div>
                     <div class="col-md-6" align="right">
                        <button type="submit" name="sjenis" class="btn btn-primary">&nbsp;&nbsp;Update&nbsp;&nbsp;</button>
                     </div>
                  </div>
               </form>
            <?php endforeach; ?>
               </div>
            </div>
         </div>
      </div>
   </div>

<?= $this->endSection() ?>