<!DOCTYPE html>
<html lang="en">
<?php foreach ($desa as $ds) : ?>

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
    <!-- jQuery UI CSS AutoComplete -->
    <link rel="stylesheet" href="<?= base_url('assets/css/smoothness-jquery-ui.css'); ?>">

  </head>

  <body class="index-page">
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg bg-white navbar-light position-sticky top-0 shadow py-3">
      <div class="container">
        <a class="navbar-brand mr-lg-5" href="<?= base_url('/'); ?>">
          <img src="<?= base_url('assets/img/' . $ds['logo']); ?>" style="width: 40px; height: 50px;">
        </a>
        <p style="font-size: 28px; margin-left: -30px; margin-bottom: 0px; text-shadow: 0px 1px 4px; font-weight: bold; font-family:fantasy ;">App-Surat <?= $ds['jnp'] == 'Desa' ? "Desa" : "Kelurahan"; ?></p>
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
              <a href="<?= base_url('/'); ?>" class="nav-link">
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
            <li class="nav-item dropdown">
              <a href="<?= base_url('admin/permohonan/status-permohonan'); ?>">
                <i class="fa fa-list d-lg-none"></i>
                <span class="nav-link-inner--text">Status Permohonan</span>
              </a>
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
                <a href="<?= base_url('/logout'); ?>" class="nav-link-inner--text" style="color:white;">Logout</a>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <?php endforeach; ?>