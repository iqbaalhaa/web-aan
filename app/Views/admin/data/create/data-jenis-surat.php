<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Data Jenis Surat</b></h4>
               </div>

               <div class="card-body mx-2 my-2">
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
                  <div class="row">
                     <div class="col-md-12">

                           <div class="card-body table-responsive">
                            <?php if (!$empty) : ?>
                             <table id="bootstrap-data-table-export" class="table table-hover">
                              <thead class="text-primary">
                               <th><b>No</b></th>
                               <th><b>Kode Jenis/Klasifikasi</b></th>
                               <th><b>Kategori Surat</b></th>
                               <th><b>Nama Surat</b></th>
                               <th><b>Link Halaman</b></th>
                               <th><b>Persyaratan</b></th>
                               <th><b>Aksi</b></th>
                            </thead>
                            <tbody>
                               <?php $i = 1;
                               foreach ($jenis as $value) : ?>
                                <tr>
                                 <td><?= $i; ?></td>
                                 <td><?= $value['kode_jenis']; ?>/<?= $value['klasifikasi_surat']; ?></td>
                                 <td><?= $value['kategori_surat']; ?></td>
                                 <td><?= $value['nama_surat']; ?></td>
                                 <td><?= $value['page']; ?></td>
                                 <td><?= $value['persyaratan']; ?></td>
                                 <td>

                                  <a href="<?= base_url('admin/data/edit-jenis-surat/' . $value['kode_jenis']); ?>" type="button" class="btn btn-primary p-2" id="<?= $value['kode_jenis']; ?>">
                                   <i class="material-icons">edit</i></a>
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
    } );
</script>
<?= $this->endSection() ?>