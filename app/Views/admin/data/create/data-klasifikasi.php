<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Daftar Klasifikasi Surat</b></h4>
               </div>
               <div class="card-body mx-2 my-2">
                  <div class="row">
                     <div class="col-md-12">
                           <div class="card-body table-responsive">
                            <?php if (!$empty) : ?>
                             <table id="bootstrap-data-table-export" class="table table-hover">
                              <thead class="text-primary">
                               <th><b>No</b></th>
                               <th><b>Kode</b></th>
                               <th><b>Klasifikasi</b></th>
                            </thead>
                            <tbody>
                               <?php $i = 1;
                               foreach ($klasifikasi as $value) : ?>
                                <tr>
                                 <td><?= $i; ?></td>
                                 <td><?= $value['kode']; ?></td>
                                 <td><?= $value['klasifikasi']; ?></td>
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