<?= $this->include('warga/header') ?>
<?php foreach ($desa as $ds) : ?>

  <!-- End Navbar -->
  <div class="wrapper">
    <div class="section section-hero section-shaped">
      <div class="shape shape-style-1 shape-primary">
        <!-- <span class="span-150"></span>
        <span class="span-50"></span>
        <span class="span-50"></span>
        <span class="span-75"></span>
        <span class="span-100"></span>
        <span class="span-75"></span>
        <span class="span-50"></span>
        <span class="span-100"></span>
        <span class="span-50"></span>
        <span class="span-100"></span> -->
      </div>
      <div class="page-header">
        <div class="container shape-container d-flex align-items-center py-md">
          <div class="col px-0">
            <div class="row align-items-center justify-content-center">
              <div class="col-lg-12 text-center">
                <?php $validation = \Config\Services::validation(); ?>

                <?php if (session()->getFlashdata('msg')) : ?>
                  <div class="pb-2">
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">x</i>
                      </button>
                      <?= session()->getFlashdata('msg') ?>
                    </div>
                  </div>
                <?php endif; ?>
                <h4 style="font-size: 50px; color: white;">Selamat Datang</h4>
                <p class="lead text-white">di Website layanan administrasi surat <?= $ds['jnp'] == 'Desa' ? "Desa" : "Kelurahan"; ?> <?= $ds['desa']; ?> Kecamatan <?= $ds['kec']; ?> Kabupaten <?= $ds['kab']; ?> </p>
                <div class="btn-wrapper mt-5">
                  <button data-toggle="modal" data-target="#modal-permohonan" class="btn btn-lg btn-white btn-icon mb-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="fa fa-send"></i></span>
                    <span class="btn-inner--text" style="padding-left:20px;padding-right:20px;">Kirim Permohonan</span>
                  </button>
                </div>

                <div class="mt-5">
                  <small class="font-weight-bold mb-0 mr-2 text-white">by.</small>
                  <p style="height: 28px; color: white;">** <?= $ds['jnp'] == 'Desa' ? "Desa" : "Kelurahan"; ?> <?= $ds['desa'];  ?>**</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>

    <div class="section section-js-components">
      <div class="container">
        <!-- Modals -->
        <!-- Modals Permohonan -->
        <div class="row">
          <div class="col-md-6">
            <div class="modal fade" id="modal-permohonan" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-md" role="document" style="z-index:99999999;">
                <div class="modal-content">
                  <div class="modal-body p-0">
                    <div class="card bg-secondary shadow border-0 mb-0">
                      <div class="card-header bg-white pb-25">
                        <div class="text-muted text-center mb-0">
                          <h4>Formulir Permohonan Surat</h4>
                        </div>

                      </div>
                      <div class="card-body px-lg-5 py-lg-2">
                        <div class="text-center text-muted mb-2">
                          <small>Silahkan lengkapi formulir dibawah</small>
                        </div>

                        <form method="post" action="<?= base_url(); ?>admin/permohonan/kirim" enctype="multipart/form-data">
                          <?= csrf_field() ?>
                          <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                          <?php foreach ($max as $maxval) :
                            $kodesurat = $maxval;
                            $urutan = (int) substr($kodesurat, 0, 2);
                            $urutan++;
                            $nourut = sprintf($urutan);
                          ?>

                            <div class="form-group mb-3">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-vcard"></i></span>
                                </div>
                                <select name="kode_jenis" id="kode_jenis" class="form-control" required>
                                  <?php foreach ($jeniss as $jn) {
                                    // code...
                                  ?>
                                    <option value="<?= $jn['kode_jenis']; ?>"><?= $jn['nama_surat']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group mb-3">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-vcard"></i></span>
                                </div>
                                <input type="text" name="nik" id="nik" placeholder="NIK" class="form-control" autofocus maxlength="16" required>
                              </div>
                            </div>

                            <div class="form-group mb-3">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" class="form-control" required>
                              </div>
                            </div>
                            <div class="form-group mb-3">

                              <!-- SCRIPT BARU  -->
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" name="telp" id="telp" placeholder="No. WhatsApp : +6285266490680" class="form-control">
                              </div>

                              <script>
                                // Ambil elemen input nomor telepon
                                var inputTelp = document.getElementById('telp');

                                // Tambahkan event listener untuk memantau perubahan pada input nomor telepon
                                inputTelp.addEventListener('input', function(event) {
                                  // Ambil nilai input nomor telepon
                                  var nomorTelp = event.target.value;

                                  // Pastikan nomor telepon tidak kosong dan tidak sudah memiliki awalan +62
                                  if (nomorTelp && !nomorTelp.startsWith('+62')) {
                                    // Tambahkan awalan +62 ke nilai nomor telepon
                                    event.target.value = '+62' + nomorTelp;
                                  }
                                });
                              </script>

                              <!-- SCRIPT BARU  -->

                            </div>
                            <div class="form-group mb-3">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-id-card-o"></i></span>
                                </div>
                                <input type="file" name="berkas" id="berkas" placeholder="Berkas Persyaratan" class="form-control" required>
                              </div>
                            </div>
                            <div class="form-group mb-3">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-file-picture-o"></i></span>
                                </div>
                                <input type="file" name="foto" id="foto" placeholder="Foto Pemohon" class="form-control" required>
                              </div>
                            </div>
                            <input type="hidden" id="user" name="user" value="<?= user()->toArray()['id']; ?>">
                            <input type="hidden" id="id" name="id" value="<?php echo $nourut; ?>">
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4">Kirim</button>
                            </div>
                          <?php endforeach; ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Permohonan -->
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
                            <li>Apabila status permohonan <b>Sudah acc</b>, maka surat akan di kirimkan melalui no WhatsApp anda atau bisa diambil dikantor Desa/Kelurahan</li>
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
        <div class="container py-md">
          <div class="row row-grid justify-content-between align-items-center">
            <div class="col-lg-7 text-center" style="top:-150px">
              <h3 class="display-4">Web Pelayanan Administrasi Surat</h3>
              <h5> <span class="text-success"><?= $ds['jnp'] == 'Desa' ? "Desa" : "Kelurahan"; ?> <?= $ds['desa']; ?> Kecamatan <?= $ds['kec']; ?> Kabupaten <?= $ds['kab']; ?></span></h5>
              <p class="lead">Web pelayanan administrasi ini merupakan inovasi desa yang diharapkan dapat mempermudah warga yang ingin mengurus Administrasi surat di <?= $ds['jnp'] == 'Desa' ? "Desa" : "Kelurahan"; ?>.</p>
              <!-- <div class="btn-wrapper">
                <a href="#" class="btn btn-primary mb-3 mb-sm-0">Daftar Persyaratan</a>
                <a href="#" class="btn btn-default">Download Formulir</a>
              </div>
              <div class="text-center">
                <h4 class="display-4 mb-5 mt-5">Statistik</h4>
                <div class="row justify-content-center">
                  <div class="col-lg-2 col-4">
                    <a href="#" target="_blank" data-toggle="tooltip" data-original-title="Bootstrap 4 - Most popular front-end component library">
                      <img src="<?= base_url('assets/assets-warga/img/icons/penduduk.png'); ?>" class="img-fluid">
                    </a>
                    <p style="text-shadow: 1px 1px 2px; font-weight: bold; font-size:22px;"><?= count($warga); ?></p>
                    <p style="font-size: 14px; margin-top: -25px; text-align-last: center; align-items: center;">Jumlah Warga</p>
                  </div>
                  <div class="col-lg-2 col-4">
                    <a href="#" target="_blank" data-toggle="tooltip" data-original-title="Vue.js - The progressive javascript framework">
                      <img src="<?= base_url('assets/assets-warga/img/icons/jenissurat.png'); ?>" class="img-fluid">
                    </a>
                    <p style="text-shadow: 1px 1px 2px; font-weight: bold; font-size:22px;"><?= count($jenis); ?></p>
                    <p style="font-size: 14px; margin-top: -25px; text-align-last: center; align-items: center;">Jumlah Jenis Surat</p>
                  </div>
                  <div class="col-lg-2 col-4">
                    <a href="#" target="_blank" data-toggle="tooltip" data-original-title="Angular - One framework. Mobile &amp; desktop">
                      <img src="<?= base_url('assets/assets-warga/img/icons/surat.png'); ?>" class="img-fluid">
                    </a>
                    <p style="text-shadow: 1px 1px 2px; font-weight: bold; font-size:22px;"><?= count($surat); ?></p>
                    <p style="font-size: 14px; margin-top: -25px; text-align-last: center; align-items: center;">Jumlah Surat</p>
                  </div>
                  <div class="col-lg-2 col-4">
                    <a href="#" target="_blank" data-toggle="tooltip" data-original-title="Sketch - Digital design toolkit">
                      <img src="<?= base_url('assets/assets-warga/img/icons/pengunjung.png'); ?>" class="img-fluid">
                    </a>
                    <p style="text-shadow: 1px 1px 2px; font-weight: bold; font-size:22px;"><?= count($pengunjung); ?></p>
                    <p style="font-size: 14px; margin-top: -25px; text-align-last: center; align-items: center;">Total Pengunjung</p>
                  </div>
                  <div class="col-lg-2 col-4">
                    <a href="#" target="_blank" data-toggle="tooltip" data-original-title="Adobe Photoshop - Software for digital images manipulation">
                      <img src="<?= base_url('assets/assets-warga/img/icons/totalhits.png'); ?>" class="img-fluid">
                    </a>
                    <p style="text-shadow: 1px 1px 2px; font-weight: bold; font-size:22px;"><?= count($totalpengunjung); ?></p>
                    <p style="font-size: 14px; margin-top: -25px; text-align-last: center; align-items: center;">Total Hits</p>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="col-lg-5 mb-lg-auto">
              <div class="card bg-secondary shadow border-0">
                <div class="card-header bg-white pb-3">
                  <div class="btn-wrapper text-center">
                    <h4 class="btn-inner--text">Registrasi</h4>
                  </div>
                </div>
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <small>Silahkan lengkapi form registrasi dibawah </small>
                  </div>
                  <?= view('Myth\Auth\Views\_message_block') ?>

                  <form action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input name="email" id="email" class="form-control" placeholder="Email" type="email">
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input name="username" id="username" class="form-control" placeholder="Username" type="text">
                      </div>
                    </div>
                    <div class="form-group focused">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input name="password" id="password" class="form-control" placeholder="Password" type="password">
                      </div>
                    </div>
                    <div class="form-group focused">
                      <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                        </div>
                        <input name="pass_confirm" id="pass_confirm" class="form-control" placeholder="Ketik ulang password" type="password">
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary my-4">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- SVG separator -->
          <div class="separator separator-bottom separator-skew">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
          </div>
          <br>
          <div class="container py-md">
            <div class="container container-lg">
              <div class="row">
                <!-- <div class="col-md-6 mb-2 mb-md-0">
          <div class="card card-lift--hover shadow border-0">
            <a href="#" title="Landing Page">
              <img src="<?= base_url('assets/img/dashboard1.png'); ?>" class="card-img" style="padding: 5px; box-shadow: 1px 2px 4px;">
            </a>
          </div>
        </div>
        <div class="col-md-6 mb-2 mb-lg-0">
          <div class="card card-lift--hover shadow border-0">
            <a href="#" title="Profile Page">
              <img src="<?= base_url('assets/img/dashboard2.png'); ?>" class="card-img" style="padding: 5px; box-shadow: 1px 2px 4px;">
            </a>
          </div>
        </div> -->
              </div>
            </div>
          </div>
          </section>
        <?php endforeach; ?>

        <?= $this->include('warga/footer') ?>

        <script>
          function scrollToDownload() {

            if ($('.section-download').length != 0) {
              $("html, body").animate({
                scrollTop: $('.section-download').offset().top
              }, 1000);
            }
          }
        </script>
        <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
        <script>
          window.TrackJS &&
            TrackJS.install({
              token: "ee6fab19c5a04ac1a32a645abde4613a",
              application: "argon-design-system-pro"
            });
        </script>

        <script type='text/javascript'>
          var gw = $.noConflict();
          gw(document).ready(function() {
            // Initialize
            gw("#nik").autocomplete({

              source: function(request, response) {

                // CSRF Hash
                var csrfName = gw('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = gw('.txt_csrfname').val(); // CSRF hash


                // Fetch data
                gw.ajax({
                  url: "<?= site_url('admin/permohonan/getwarga') ?>",
                  type: 'post',
                  dataType: "json",
                  data: {
                    search: request.term,
                    [csrfName]: csrfHash // CSRF Token
                  },
                  success: function(data) {
                    // Update CSRF Token
                    gw('.txt_csrfname').val(data.token);

                    response(data.data);
                  }
                });
              },
              select: function(event, ui) {
                // Set selection
                gw('#nik').val(ui.item.label); // display the selected text
                gw('#nama').val(ui.item.nama); // save selected id to input

                return false;
              },
              focus: function(event, ui) {
                gw("#nik").val(ui.item.label);
                gw("#nama").val(ui.item.nama);
                return false;
              },
            });
          });
        </script>
        </body>

        </html>