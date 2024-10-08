<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <?php if (session()->getFlashdata('msg')) : ?>
            <div class="pb-2 px-3">
               <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <i class="material-icons">close</i>
                  </button>
                  <?= session()->getFlashdata('msg') ?>
               </div>
            </div>
         <?php endif; ?>

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
      <table id="bootstrap-data-table-export" class="table table-hover">
         <thead class="text-primary">
            <th><b>No</b></th>
            <th><b>Tanggal</b></th>
            <th><b>No. Surat</b></th>
            <th><b>Kode</b></th>
            <th><b>Nama Surat</b></th>
            <th><b>TTD</b></th>
            <th><b>Aksi</b></th>
         </thead>
         <tbody>
            <?php $i = 1;
            foreach ($surat as $value) : ?>
               <tr>
                  <td><?= $i; ?></td>
                  <td><?= $value['tanggal']; ?></td>
                  <td><?= $value['no_surat']; ?></td>
                  <td><?= $value['kode_surat']; ?></td>
                  <td><b><?= $value['nama_surat']; ?></b></td>
                  <td><?= $value['nama']; ?></td>
                  <td>
                     <a href="<?= base_url('admin/surat/'.$value['page'].'/' . $value['kode_surat']); ?>" type="button" class="btn btn-primary p-2" id="<?= $value['kode_surat']; ?>">
                    <i class="material-icons">print</i></a>
                     <a href="<?= base_url('admin/surat/edit-'.$value['page'].'/' . $value['kode_surat']); ?>" type="button" class="btn btn-primary p-2" id="<?= $value['kode_surat']; ?>">
                    <i class="material-icons">edit</i></a>
                     <form action="<?= base_url('admin/surat/delete/' . $value['id_surat']); ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button onclick="return confirm('Konfirmasi untuk menghapus data');" type="submit" class="btn btn-danger p-2" id="<?= $value['id_surat']; ?>"><i class="material-icons">delete_forever</i></button>
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
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    } );
</script>
<?= $this->endSection() ?>