<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <!-- REKAP JUMLAH DATA -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <a href="<?= base_url('admin/data/jenis-surat'); ?>" class="text-white">
                                <i class="material-icons">list</i>
                            </a>
                        </div>
                        <p class="card-category">Jenis Surat</p>
                        <h3 class="card-title"><?= count($jenis); ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-primary">check</i>
                            Jenis
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <a href="<?= base_url('admin/surat'); ?>" class="text-white">
                                <i class="material-icons">table</i>
                            </a>
                        </div>
                        <p class="card-category">Data Surat</p>
                        <h3 class="card-title"><?= count($surat); ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-success">check</i>
                            Data
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <a href="<?= base_url('admin/data/data-warga'); ?>" class="text-white">
                            <i class="material-icons">people</i>
                        </a>
                        </div>
                        <p class="card-category">Warga</p>
                        <h3 class="card-title"><?= count($warga); ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">people</i>
                            Jiwa
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <a href="<?= base_url('admin/petugas'); ?>" class="text-white">
                                <i class="material-icons">person</i>
                            </a>
                        </div>
                        <p class="card-category">Operator</p>
                        <h3 class="card-title"><?= count($petugas); ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">person</i>
                            Op & Adm
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="card">
            <div class="card-header card-header-tabs card-header-info">
               <div class="nav-tabs-navigation">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="nav-tabs-wrapper">
                              <div class="col-md-6">
                                 <p class="d-inline"><b>Data Administrasi Surat</b></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <div class="card-body table-responsive">
             <?php if (!$empty) : ?>
              <table id="bootstrap-data-table-export0" class="table table-hover">
               <thead class="text-primary">
                <th><b>No</b></th>
                <th><b>Tanggal</b></th>
                <th><b>No. Surat</b></th>
                <th><b>Nama Surat</b></th>
                <th><b>Ttd</b></th>
                <th width="15%" align="center"><b>Opsi</b></th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($surat as $value) : ?>
                 <tr>
                  <td><?= $i; ?></td>
                  <td><?= IndonesiaTgl($value['tanggal']); ?></td>
                  <td><?= $value['no_surat']; ?></td>
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
                    <button onclick="return confirm('Konfirmasi untuk menghapus data');" type="submit" class="btn btn-danger p-2" id="<?= $value['id_surat']; ?>">
                     <i class="material-icons">delete_forever</i></button>
             </form>
         </td>
     </tr>
     <?php $i++;
 endforeach; ?>
</tbody>
</table>
<?php /*
<div style="float: right">
<?php echo $data["pager"]->links('default', 'custom_pager') ?>
</div> */
?>
<?php else : ?>
  <div class="row">
   <div class="col">
    <h4 class="text-center text-danger">Data tidak ditemukan</h4>
</div>
</div>
<?php endif; ?>
</div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#bootstrap-data-table-export0').DataTable();
    } );
</script>

<?= $this->endSection() ?>