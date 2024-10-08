<?= $this->include('warga/header') ?>
<div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title-5" align="center">INFO !
                        </h2>
                    </div>

                </div>
<div class="container mt-2">
                <form action=""  method="post"  class="form-horizontal">
                    <div class="row form-group">
                        <?php foreach ($permohonan as $row) : ?>  
                            <?php foreach ($desa as $row1) : ?>
                            <?php if ($row['status'] == 'Onproccess'): ?> 
                                <div class="col-md-12"><h4 align="center"><img src="<?= base_url('assets/img/loading.gif'); ?>" style="text-decoration: none; width: 100px;"><br>T u n g g u  . . .<br><strong>"<?php echo $row['nmsurat'];?>" yang kamu ajukan</strong><br> sedang ditinjau oleh Admin/staff <?= $row1['jnp'] == 'Desa' ? "Desa" : "Kelurahan"; ?></h4> </div>
                                <div class="col-md-12 mt-4" align="center"><a href='<?= base_url('/'); ?>' class="btn btn-info">Kembali</a></div>

                            <?php elseif ($row['status'] == 'Acc'): ?>
                                <hr>
                                <div class="col-md-12" style="justify-content: center; text-align: center; border: none;"><img src="<?= base_url('assets/img/terima-kasih.gif'); ?>" style="text-decoration: none"></i><h4 align="center"><br><!-- Silahkan ambil surat kamu dikantor  -->Surat akan di kirimkan ke nomor WhatsApp anda.<?= $row1['jnp'] == 'Desa' ? "Desa" : "Kelurahan"; ?> !</h4> 
                                    <!-- /# card -->
                                </div>
                                <div class="col-md-12  mt-4" align="center"><a href='<?= base_url('/'); ?>' class="btn btn-info">&nbsp;&nbsp;&nbsp;Ok&nbsp;&nbsp;&nbsp;</a></div>

                            <?php elseif($row['status'] == 'ditolak') : ?>
                                <div class="col-md-12"><h4 align="center">Mohon Ma'af, Surat anda belum dapat Kami proses.!</h4> 
                                </div>
                                <div class="col-md-12"><h4 align="center"><b>"<?php echo $row['keterangan'];?>"</b></h4> 
                                </div>
                                <div class="col-md-12 mt-4" align="center"><a href='<?= base_url('/'); ?>' class="btn btn-info">Kembali</a></div>
                            <?php endif; ?>
                        </div>
                    </form>
<?php endforeach; ?>
                </div>
        </div>
    </div>

<?php endforeach; ?>
<!-- Modal permohonan surat -->
        <div class="row">
        <div class="col-md-4">
          <div class="modal fade" id="modal-permohonan-surat" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-body p-0">
                  <div class="card bg-secondary shadow border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-2">
                      <div class="text-center text-muted mb-2">
                        <h3>Langkah - langkah pengajuan permohonan surat secara online</h3>
                      </div>
                      <hr>
                      <div class="text-left mb-2">
                        <ol type="1">
                          <li>Warga melakukan pendaftaran di website</li>
                          <li>Login menggunakan akun (username dan password) yang sebelumnya didaftarkan</li>
                          <li>Klik tombol Kirim Permohonan</li>
                          <li>Mengisi formulir permohonan (online)</li>
                          <li>Selesai</li>
                        </ol>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End Permohonan surat -->

<!-- Modal Persyaratan surat -->
        <div class="row">
        <div class="col-md-4">
          <div class="modal fade" id="modal-persyaratan-surat" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-body p-0">
                  <div class="card bg-secondary shadow border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-2">
                      <div class="text-center text-muted mb-2">
                        <h3>Persyaratan pengajuan permohonan surat online</h3>
                      </div>
                      <hr>
                      <div class="text-left mb-2">
                        <ol type="1">
                          <li>KTP atau Kartu Keluarga (KK)</li>
                          <li>Foto</li>
                          <li>Dokumen pendukung lain *)</li>
                        </ol>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End persyaratan surat -->
<!-- Modal Pengambilan surat -->
        <div class="row">
        <div class="col-md-4">
          <div class="modal fade" id="modal-pengambilan-surat" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-body p-0">
                  <div class="card bg-secondary shadow border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-2">
                      <div class="text-center text-muted mb-2">
                        <h3>Pengambilan surat yang telah diajukan secara online</h3>
                      </div>
                      <hr>
                      <div class="text-left mb-2">
                        <ol type="1">
                          <li>Login ke Webiste menggunakan akun (username dan password) yang sebelumnya didaftarkan</li>
                          <li>Cek Status Permohonan (Klik menu Status Permohonan)</li>
                          <li>Apabila status permohonan <b>Sudah acc</b>, maka surat sudah bisa diambil dikantor Desa/Kelurahan</li>
                        </ol>
                      </div>
                      <hr>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- End persyaratan surat -->
<?= $this->include('warga/footer') ?>