<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Add Staff Desa</b></h4>
               </div>
               <div class="card-body mx-3 my-3">
                  <form action="<?= base_url('admin/data/add-staff'); ?>" method="post" enctype="multipart/form-data">
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

                  <h4 class="mt-4"><strong>ADD STAFF DESA: </strong></h4>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-4">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label>Jabatan</label>
                        <input type="text" name="jabatan" class="form-control col-md-12" required>
                     </div>
                  </div>
                 
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-6" align="left">
                        <a href="<?= base_url('admin/data/create-profil');?>" class="btn btn-info">&nbsp;&nbsp;Kembali&nbsp;&nbsp;</a>
                     </div>
                     <div class="col-md-6" align="right">
                        <button type="submit" name="staff" class="btn btn-primary">&nbsp;&nbsp;Simpan&nbsp;&nbsp;</button>
                     </div>
                  </div>
               </form>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>


<?= $this->endSection() ?>