<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Data Warga Desa</b></h4>
               </div>
               <div class="card-body mx-2 my-2">
                  <a href="<?= base_url('admin/data/add-warga'); ?>" class="btn btn-primary"><i class="material-icons">add</i>Tambah Warga</a>
                  <a href="<?= base_url('admin/data/import-warga'); ?>" class="btn btn-success"><i class="material-icons">upload</i>Import Data Warga</a>
                  <!-- <a href="<?= base_url('admin/data/download-warga'); ?>" target="_BLANK" class="btn btn-danger"><i class="material-icons">download</i>Download Data Warga</a> -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card-body table-responsive">
                           <?php if (!$empty) : ?>
                              <table id="bootstrap-data-table-export" class="table table-hover">
                                 <thead class="text-primary">
                                    <th><b>No</b></th>
                                    <th><b>NIK</b></th>
                                    <th><b>NKK</b></th>
                                    <th><b>Nama</b></th>
                                    <th><b>Jenis Kelamin</b></th>
                                    <th><b>Tmp&Tgl. Lahir</b></th>
                                    <th><b>Alamat</b></th>
                                    <th><b>Aksi</b></th>
                                 </thead>
                                 <tbody>
                                    <?php $i = 1;
                                    foreach ($warga as $value) : ?>
                                       <tr>
                                          <td><?= $i; ?></td>
                                          <td><?= substr($value['nik'], 0, 6); ?>***</td>
                                          <td>***<?= substr($value['nkk'], 10, 6); ?></td>
                                          <td><?= $value['nama']; ?></td>
                                          <td><?= $value['jk']; ?></td>
                                          <td><?= $value['tmp_lahir']; ?>, <?= $value['tgl_lahir']; ?></td>
                                          <td><?= $value['alamat']; ?></td>
                                          <td>

                                             <a href="<?= base_url('admin/data/edit-warga/' . $value['id']); ?>" type="button" class="btn btn-primary p-2" id="<?= $value['id']; ?>">
                                                <i class="material-icons">edit</i></a>
                                             <form action="<?= base_url('admin/data/delete-warga/' . $value['id']); ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button onclick="return confirm('Konfirmasi untuk menghapus data');" type="submit" class="btn btn-danger p-2" id="<?= $value['id']; ?>">
                                                   <i class="material-icons">delete_forever</i></button>
                                             </form>
                                          </td>
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
                        </div>
                     </div>
                  </div>
               </div>


            </div>

            <hr>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
   $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
   });
</script>
<?= $this->endSection() ?>