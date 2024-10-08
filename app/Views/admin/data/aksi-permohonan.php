<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <!-- REKAP JUMLAH DATA -->
        <div class="row">
        <div class="card">
            <div class="card-header card-header-tabs card-header-info">
               <div class="nav-tabs-navigation">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="nav-tabs-wrapper">
                              <div class="col-md-6">
                                 <p class="d-inline"><b>Konfirmasi Permohonan Surat</b></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
        <div class="card-body card-block">
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
            <?php
            foreach ($permohonan as $row) : ?>

                <form action="<?= base_url('admin/permohonan/ekspermohonan'); ?>"  method="post" class="form-horizontal">
                    <div class="card-body card-block">
                        <input type="hidden" id="idp" name="idp" class="form-control" value="<?php echo $row ['idpermohonan']; ?>">
                        <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $row ['id']; ?>">
                        <div class="row mt-2">
                            <div class="col col-md-3"><label for="nmsurat" class=" form-control-label">Nama Surat</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="nmsurat" name="nmsurat" class="form-control" value="<?php echo $row ['nmsurat']; ?> (<?php echo $row ['status']; ?>)" readonly="readonly" ></div>
                        </div>
                            <div class="row mt-2">
                            <div class="col col-md-3"><label for="nik" class="form-control-label">NIK</label></div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="nik" name="nik" value="<?php echo $row ['nama']; ?> (<?php echo $row ['nik']; ?>)" readonly="readonly" class="form-control"></div>
                            </div>

                            <div class="row mt-2">
                                <div class="col col-md-3"><label for="keterangan" class=" form-control-label">Keterangan</label></div>
                                <div class="col-12 col-md-9"><textarea rows="2" id="keterangan" name="keterangan" class="form-control"></textarea><small>Contoh : Foto KTP Buram, Silahkan foto ulang</small>

                                </div>
                            </div>
                            <hr>


                            <div class="card">
                                <div class="card-body" style="text-align-last: center; align-items: center;">
                                    <button name='terima' type="submit" value="Acc" class="btn btn-primary"><i class="material-icons">check</i> Terima & Buatkan Surat</button>
                                    <button id='tolak' name='tolak' type="submit" value="ditolak" class="btn btn-danger"><i class="material-icons">close</i> Tolak Permohoan</button>                           
                                    <a href='<?= base_url('admin/permohonan'); ?>' class="btn btn-info"><i class="material-icons">home</i>Kembali</a>                                      
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