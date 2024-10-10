
<!DOCTYPE html>
<html lang="en">
<?php foreach ($desa as $ds) :
  // code...
?>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/assets-warga/img/apple-icon.png'); ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/assets-warga/img/logo.png'); ?>">
    <title>
      <?= $title; ?> <?= $ds['jnp'] == 'Desa' ? "Desa" : "Kelurahan"; ?> <?= $ds['desa']; ?>
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="<?= base_url('assets/assets-warga/css/nucleo-icons.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/assets-warga/css/nucleo-svg.css'); ?>" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="<?= base_url('assets/assets-warga/css/font-awesome.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/assets-warga/css/nucleo-svg.css'); ?>" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="<?= base_url('assets/assets-warga/css/argon-design-system.css?v=1.2.2'); ?>" rel="stylesheet" />
  </head>

  <body class="index-page">
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-3">
      <div class="container">
        <a class="navbar-brand mr-lg-5" href="#">
          <img src="<?= base_url('assets/img/' . $ds['logo']); ?>" style="width: 40px; height: 50px;">
        </a>
        <p style="font-size: 28px; margin-left: -30px; margin-bottom: 0px; text-shadow: 0px 1px 4px; font-weight: bold; font-family:fantasy ;">Tanah Kampung</p>
        <p style="font-size: 28px; margin-left: 10px; margin-bottom: 0px;">|</p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="<?= base_url('/'); ?>">
                  <img src="<?= base_url('assets/img/' . $ds['logo']); ?>">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
            <li class="nav-item dropdown">
              <a href="<?= base_url('/'); ?>" class="nav-link" data-toggle="dropdown" href="#" role="button">
                <i class="fa fa-home d-lg-none"></i>
                <span class="nav-link-inner--text">Home</span>
              </a>
            </li>

            <li class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                <i class="fa fa-laptop d-lg-none"></i>
                <span class="nav-link-inner--text">Pelayanan</span>
              </a>
              <div class="dropdown-menu dropdown-menu-xl">
                <div class="dropdown-menu-inner">
                  <a href="#" data-toggle="modal" data-target="#modal-permohonan-surat" class="media d-flex align-items-center">
                    <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                      <i class="ni ni-spaceship"></i>
                    </div>
                    <div class="media-body ml-3">
                      <h6 class="heading text-primary mb-md-1">Permohonan Surat Online</h6>
                      <p class="description d-none d-md-inline-block mb-0">Anda dapat mengajukan permohonan surat secara online setelah Registrasi dan Login</p>
                    </div>
                  </a>
                  <a href="#" data-toggle="modal" data-target="#modal-persyaratan-surat" class="media d-flex align-items-center">
                    <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                      <i class="ni ni-palette"></i>
                    </div>
                    <div class="media-body ml-3">
                      <h6 class="heading text-primary mb-md-1">Persyaratan Administrasi</h6>
                      <p class="description d-none d-md-inline-block mb-0">Agar dapat mengajukan permohonan surat, baik secara online atau offline (langsung ke kantor desa) warga diharapkan melengkapi persyaratan yang diperlukan.</p>
                    </div>
                  </a>
                  <a href="#" data-toggle="modal" data-target="#modal-pengambilan-surat" class="media d-flex align-items-center">
                    <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
                      <i class="ni ni-ui-04"></i>
                    </div>
                    <div class="media-body ml-3">
                      <h5 class="heading text-warning mb-md-1">Pengambilan Surat</h5>
                      <p class="description d-none d-md-inline-block mb-0">Setelah permohonan disetujui dan surat sudah dicetak warga dapat mengecek melalui website atau datang langsung ke kantor desa untuk mengambil surat terkait.</p>
                    </div>
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            <!-- <li class="nav-item">
              <a class="nav-link nav-link-icon" href="#" target="_blank" data-toggle="tooltip" title="Like us on Facebook">
                <i class="fa fa-facebook-square"></i>
                <span class="nav-link-inner--text d-lg-none">Facebook</span>
              </a>
            </li> -->
            <li class="nav-item d-none d-lg-block">
              <button type="button" class="btn btn-primary btn-icon">
                <span class="btn-inner--icon">
                  <i class="fa fa-login"></i>
                </span>
                <span class="nav-link-inner--text" data-toggle="modal" data-target="#modal-form">Login</span>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
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
                  <?= view('\App\Views\admin\_message_block') ?>
                  <h4 style="font-size: 50px; color: white;">Selamat Datang</h4>
                  <p class="lead text-white">di Website layanan administrasi surat <?= $ds['jnp'] == 'Desa' ? "Desa" : "Kelurahan"; ?> <?= $ds['desa']; ?> Kecamatan <?= $ds['kec']; ?> Kabupaten <?= $ds['kab']; ?> </p>
                  <div class="btn-wrapper mt-5">
                    <button data-toggle="modal" data-target="#modal-form" class="btn btn-lg btn-white btn-icon mb-3 mb-sm-0">
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
          <!-- Modals Login Administrator-->
          <div class="row">
            <div class="col-md-4">
              <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-secondary shadow border-0 mb-0">
                        <div class="card-header bg-white pb-25">
                          <div class="text-muted text-center mb-0">
                            <h4>Login</h4>
                          </div>

                        </div>
                        <div class="card-body px-lg-5 py-lg-2">
                          <div class="text-center text-muted mb-2">
                            <small>Silahkan masukkan username dan password anda</small>
                          </div>

                          <form action="<?= url_to('warga') ?>" method="post">
                            <?= csrf_field() ?>

                            <?php if ($config->validFields === ['email']) : ?>
                              <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                  <label class="bmd-label-floating"><?= lang('Auth.email') ?></label>
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                  </div>
                                  <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" autofocus>
                                  <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                  </div>
                                </div>
                              </div>
                            <?php else : ?>
                              <div class="form-group">
                                <label class="bmd-label-floating"><?= lang('Auth.emailOrUsername') ?></label>
                                <div class="input-group input-group-alternative">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                  </div>
                                  <input class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" autofocus>
                                  <div class="invalid-feedback">
                                    <?= session('errors.login') ?>
                                  </div>
                                </div>
                              </div>

                            <?php endif; ?>
                            <div class="form-group">
                              <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>">
                                <div class="invalid-feedback">
                                  <?= session('errors.password') ?>
                                </div>
                              </div>
                            </div>

                            <?php if ($config->allowRemembering) : ?>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                  <?= lang('Auth.rememberMe') ?>
                                </label>
                              </div>
                            <?php endif; ?>
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary my-4"><?= lang('Auth.loginAction') ?></button>
                            </div>
                            <?php if ($config->activeResetter) : ?>
                              <p><a href="<?= url_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                            <?php endif; ?>
                            <div class="clearfix"></div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Login Administrator -->

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
          </div><!-- End Pengambilan surat -->
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
            </section>

            <footer class="footer has-cards">
              <div class="container container-lg">
                <!-- <div class="row">
        <div class="col-md-6 mb-5 mb-md-0">
          <div class="card card-lift--hover shadow border-0">
            <a href="#" title="Landing Page">
              <img src="<?= base_url('assets/img/dashboard1.png'); ?>" class="card-img" style="padding: 5px; box-shadow: 1px 2px 4px;">
            </a>
          </div>
        </div>
        <div class="col-md-6 mb-5 mb-lg-0">
          <div class="card card-lift--hover shadow border-0">
            <a href="#" title="Profile Page">
              <img src="<?= base_url('assets/img/dashboard2.png'); ?>" class="card-img" style="padding: 5px; box-shadow: 1px 2px 4px;">
            </a>
          </div>
        </div>
      </div> -->
              </div>

              <div class="container">
                <div class="row row-grid align-items-center my-md">
                  <div class="col-lg-6">
                    <h3 class="text-primary font-weight-light mb-2">Sekretariat : </h3>
                    <h6 class="text-warning font-weight-light mb-2">Alamat : <?= $ds['alamat']; ?><br>Telp. : <?= $ds['telp']; ?><br>E-mail : <?= $ds['email']; ?></h6>

                  </div>
                </div>
                <hr>
                <div class="row align-items-center justify-content-md-between">
                  <div class="col-md-6">
                    <div class="copyright">
                      &copy; 2024 <a href="" target="_blank">Mhd Annajmi</a>
                    </div>
                  </div>
                  <!-- <div class="col-md-6">
                    <ul class="nav nav-footer justify-content-end">
                      <li class="nav-item">
                        <a href="" class="nav-link" target="_blank">sdc</a>
                      </li>
                      <li class="nav-item">
                        <a href="" class="nav-link" target="_blank">About Us</a>
                      </li>
                      <li class="nav-item">
                        <a href="" class="nav-link" target="_blank">Blog</a>
                      </li>
                      <li class="nav-item">
                        <a href="" class="nav-link" target="_blank">License</a>
                      </li>
                    </ul>
                  </div> -->
                </div>
              </div>

            </footer>
          </div>
        <?php endforeach; ?>
        <!--   Core JS Files   -->
        <script src="<?= base_url('assets/assets-warga/js/core/jquery.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/assets-warga/js/core/popper.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/assets-warga/js/core/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/assets-warga/js/plugins/perfect-scrollbar.jquery.min.js'); ?>"></script>
        <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
        <script src="<?= base_url('assets/assets-warga/js/plugins/bootstrap-switch.js'); ?>"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="<?= base_url('assets/assets-warga/js/plugins/nouislider.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/assets-warga/js/plugins/moment.min.js'); ?>"></script>
        <script src="<?= base_url('assets/assets-warga/js/plugins/datetimepicker.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/assets-warga/js/plugins/bootstrap-datepicker.min.js'); ?>"></script>
        <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <script src="<?= base_url('assets/assets-warga/js/argon-design-system.min.js?v=1.2.2'); ?>" type="text/javascript"></script>
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
  </body>

</html>