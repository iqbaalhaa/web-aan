<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title" align="center"><b>Cetak SPPD</b></h4>
              </div>
              <div class="card-body mx-5 my-3">
                 <form action="" method="post">
                     <?php foreach ($surat as $row) :
                        ?>

                        <div class="row form-group">
                            <div class="col col-md-6"><label for="kodesurat" class="form-control-label">Kode Surat</label><input type="text" id="kodesurat" name="kodesurat" value="<?php echo $row ['kode_surat']; ?>" readonly="readonly" class="form-control">
                            </div>

                            <div class="col col-md-6"><label for="nosurat" class=" form-control-label">No. Surat</label><input type="text" id="nosurat" name="nosurat" class="form-control" value="<?php echo $row ['no_surat']; ?>" readonly="readonly" ></div>
                        </div>
                        <hr>


                        <div class="card">
                            <div class="card-body" style="text-align-last: center;">
                                <a href="<?= base_url('admin/surat/c_spt/'.$row['kode_surat']); ?>" type="button" class="btn btn-primary" target='_BLANK'><i class="material-icons">print</i> SPT</a>
                                <a href="<?= base_url('admin/surat/c_sppd/'.$row['kode_surat']); ?>" type="button" class="btn btn-light" target='_BLANK'><i class="material-icons">print</i> SPPD</a>
                                <a href="<?= base_url('admin/surat/c_l1/'.$row['kode_surat']); ?>" type="button" class="btn btn-success" target='_BLANK'><i class="material-icons">print</i> Lamp. 1</a>
                                <a href="<?= base_url('admin/surat/c_l2/'.$row['kode_surat']); ?>" type="button" class="btn btn-warning" target='_BLANK'><i class="material-icons">print</i> Lamp. 2 </a>
                                <a href="<?= base_url('admin/surat/c_l3/'.$row['kode_surat']); ?>" type="button" class="btn btn-danger" target='_BLANK'><i class="material-icons">print</i> Lamp. 3</a>
                                <a href="<?= base_url('admin/surat/create-sppd/JS006'); ?>" type="button" class="btn" style="background-color: grey; color: white;"><i class="material-icons">home</i> Kembali</a>

                            </div>
                        </div><!-- /# card -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?php endforeach; ?>
<?= $this->endSection() ?>
