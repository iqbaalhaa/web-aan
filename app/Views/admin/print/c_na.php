<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title" align="center"><b>Cetak NA (N1-N5)</b></h4>
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
                                    <a href="<?= base_url('admin/surat/c_n1/'.$row['kode_surat']); ?>" type="button" class="btn btn-primary" target='_BLANK'><i class="material-icons">print</i>&nbsp;N1</a>
                                    <a href="<?= base_url('admin/surat/c_n2/'.$row['kode_surat']); ?>" type="button" class="btn btn-light" target='_BLANK'><i class="material-icons">print</i>&nbsp;N2</a>
                                    <a href="<?= base_url('admin/surat/c_n3/'.$row['kode_surat']); ?>" type="button" class="btn btn-success" target='_BLANK'><i class="material-icons">print</i>&nbsp;N3</a>

                                    <a href="<?= base_url('admin/surat/c_n4/'.$row['kode_surat']); ?>" type="button" class="btn btn-warning" target='_BLANK'><i class="material-icons">print</i>&nbsp;N4 </a>
                                    <a href="<?= base_url('admin/surat/c_n5/'.$row['kode_surat']); ?>" type="button" class="btn btn-danger" target='_BLANK'><i class="material-icons">print</i>&nbsp;N5</a>
                                    <a href="<?= base_url('admin/surat/create-n6/JS037'); ?>" type="button" class="btn btn-info" ><i class="material-icons">print</i>&nbsp;N6</a>
                                    <a href="<?= base_url('admin/surat/create-na/JS032'); ?>" type="button" class="btn" style="background-color: grey; color: white;"><i class="material-icons">home</i> Kembali</a>

                                </div>
                            </div><!-- /# card -->
                        </div>
                    </form>
                    </div>
        </div>
    </div>
</div>

<?php endforeach; ?>
<?= $this->endSection() ?>