<?= $this->include('warga/header') ?>
<?= $this->include('templates/inc') ?>
<div class="container mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="title-5" align="center">STATUS PERMOHONAN SURAT
                        </h4>
                        <hr class="line-seprate">
                    </div>

                </div>
</div>
<?php if (!$empty) : ?>
<div class="container mt-2">
        <div class="card ">
            <div class="card-body animated zoomIn" style="overflow-x: scroll;">
                <table id="bootstrap-data-table-export0" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemohon</th>
                            <th>Nama Surat</th>
                            <th>No. Hp</th>
                            <th>Tanggal</th>
                            <th>Foto KTP/KK</th>
                            <th>Pas Photo</th>
                            <th>Status Pengajuan</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $no=1;
                        foreach ($permohonan as $data) :
                            // code...
                        
                           ?>
                           <tr>
                            <td align="center"><?php echo $no++;?></td>
                            <td><?php echo $data['nama'];?></td>
                            <td><?php echo $data['nmsurat'];?></td>
                            <td><?php echo $data['hp'];?></td>
                            <td><?php echo IndonesiaTgl($data['tgl']);?></td>
                            <td><a href="<?= base_url('assets/permohonan/berkas/'.$data['berkas']);?>" target="_BLANK"><img src="<?= base_url('assets/permohonan/berkas/'.$data['berkas']);?>" style=" width: 40px; height:  auto; border-color: white; box-shadow: 2px 1px 4px ;"></a></td>
                            <td><a href="<?= base_url('assets/permohonan/foto/'.$data['foto']);?>" target="_BLANK"><img src="<?= base_url('assets/permohonan/foto/' .$data['foto']);?>" style=" width: 40px; height:  auto; border-color: white; box-shadow: 2px 1px 4px ;"></a></td>
                            <td align="center"><a href="<?= base_url('admin/permohonan/tunggu-permohonan/'.$data['idpermohonan']);?>"><?php if ($data['status']=='Onproccess') : ?> <p style='background:blue;border-radius:5%;padding:0px 5px;box-shadow:2px 1px 2px;color:white;'>On Process</p><?php elseif($data['status']=='ditolak') : ?> <p style='background:red;border-radius:5%;padding:0px 5px;box-shadow:2px 1px 2px;color:white;'>Permohonan ditolak</p>  <?php elseif ($data['status']=='Acc') : ?> <p style='background:grey;border-radius:5%;padding:0px 5px;box-shadow:2px 1px 2px;color:white;'>Sudah acc</p><?php endif; ?></a>
                            </td>

                        </tr>
<?php endforeach; ?>
   

                </tbody>
            </table>
        </div>      
    </div>

</div>
<?php else : ?>

    <div class="container mt-2">
        <div class="card ">

                <h4 align="center">Tidak ada permohonan surat</h4>

        </div>
    </div>
<?php endif; ?>

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
<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export0').DataTable();
    } );
</script>
<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 50,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>


<?= $this->include('warga/footer') ?>
