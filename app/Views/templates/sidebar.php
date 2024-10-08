<?php
$context = $ctx ?? 'dashboard';
switch ($context) {
   case 'surat1':
   case 'surat2':
   case 'surat3':
   case 'surat4':
   case 'surat5':
   case 'surat6':
      $sidebarColor = 'azure';
      break;
   case 'petugas':
      $sidebarColor = 'rose';
      break;
   case 'masterdata':
      $sidebarColor = 'green';
      break;

   case 'laporan':
      $sidebarColor = 'danger';
      break;

   default:
      $sidebarColor = 'purple';
      break;
}
?>
<div class="sidebar" data-color="<?= $sidebarColor; ?>" data-background-color="black" data-image="<?= base_url('assets/img/sidebar/sidebar10.jpg'); ?>">
   <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
   <div class="logo">
      <div class="sidenav-header">
         <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
         <a class="navbar-brand m-0" href="<?= base_url('admin'); ?>" target="_self">
            <img src="<?php echo base_url('assets/img/logo.png'); ?>" class="navbar-brand-img h-100" alt="main_logo" style="width: 40px; margin-left: 10px;">
            <span class="ms-1 font-weight-bold text-white">Tanah Kampung</span>

         </a>
      </div>
   </div>
   <div class="sidebar-wrapper">
      <ul class="nav">
         <li class="nav-item <?= $context == 'dashboard' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin'); ?>">
               <i class="material-icons">dashboard</i>
               <p>Dashboard</p>
            </a>
         </li>
         <?php if (user()->toArray()['is_superadmin'] == '1') : ?>
            <li class="nav-item <?= $context == 'surat1' ? 'active' : ''; ?>">
               <!-- <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false" href="#tu">
               <i class="material-icons">desk</i>
               <span class="sidenav-normal">Tata Usaha<b class="caret"></b></span>
            </a> -->
               <div class="collapse " id="tu">
                  <ul class="nav nav-sm flex-column">
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-undangan/JS001'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Udangan </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-pengantar/JS002'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pengantar </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-pemberitahuan/JS003'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pemberitahuan </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-himbauan/JS004'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Himbauan </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-jawaban/JS005'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Jawaban </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sppd/JS006'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">SPPD </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-tugas/JS007'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Tugas </span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <!-- <li class="nav-item <?= $context == 'surat2' ? 'active' : ''; ?>">
               <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false" href="#umum">
                  <i class="material-icons">people</i>
                  <span class="sidenav-normal">Umum<b class="caret"></b></span>
               </a>
               <div class="collapse " id="umum">
                  <ul class="nav nav-sm flex-column">
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sku/JS008'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Usaha </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sktu/JS009'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Tempat Usaha </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skbr/JS010'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pengantar Barang </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skt/JS011'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pengantar Ternak </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sktm/JS012'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Tidak Mampu (Personal) </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skktm/JS013'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Keluarga Tidak Mampu </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skrtm/JS014'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Rumah Tangga Miskin </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skphs/JS015'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Penghasilan </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skortu/JS016'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Orang Tua </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skanak/JS017'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Anak </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skmati/JS018'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Kematian </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skpergi/JS019'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Bepergian </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skaw/JS020'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Ahli Waris </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sklbg/JS021'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Domisili Lembaga </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skkb/JS022'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Kelakuan Baik </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-skck/JS023'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pengantar SKCK </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-simb/JS024'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pengantar IMB </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sig/JS025'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Izin Gangguan (HO) </span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <li class="nav-item <?= $context == 'surat3' ? 'active' : ''; ?>">
               <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false" href="#pddk">
                  <i class="material-icons">groups</i>
                  <span class="sidenav-normal">Kependudukan<b class="caret"></b></span>
               </a>
               <div class="collapse " id="pddk">
                  <ul class="nav nav-sm flex-column">
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-bedaid/JS026'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Beda Identitas </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-domisili/JS027'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Domisili </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-pindah/JS028'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pindah </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-kelahiran/JS029'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Kelahiran </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-pemakaman/JS030'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pemakaman </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-f121/JS031'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Permohonan KTP (F121) </span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <li class="nav-item <?= $context == 'surat4' ? 'active' : ''; ?>">
               <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false" href="#nkh">
                  <i class="material-icons">favorite</i>
                  <span class="sidenav-normal">Pernikahan<b class="caret"></b></span>
               </a>
               <div class="collapse " id="nkh">
                  <ul class="nav nav-sm flex-column">
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-na/JS032'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">NA </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sknh/JS033'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Keterangan Nikah </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-pnikah/JS034'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pernah Nikah </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-bnikah/JS035'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Belum Nikah </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-dj/JS036'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Duda/Janda </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-n6/JS037'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">N6 </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-cerai/JS038'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Cerai </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-pstatus/JS039'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Pernyataan Status </span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <li class="nav-item <?= $context == 'surat5' ? 'active' : ''; ?>">
               <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false" href="#tnh">
                  <i class="material-icons">map</i>
                  <span class="sidenav-normal">Pertanahan<b class="caret"></b></span>
               </a>
               <div class="collapse " id="tnh">
                  <ul class="nav nav-sm flex-column">
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sktanah/JS040'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Keterangan Tanah </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sporadik/JS041'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Sporadik </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sewatanah/JS042'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Sewa Tanah </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-jualbelitanah/JS043'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Jual/beli Tanah </span>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-gadaitanah/JS044'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Gadai Tanah </span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <li class="nav-item <?= $context == 'surat6' ? 'active' : ''; ?>">
               <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false" href="#ln">
                  <i class="material-icons">folder</i>
                  <span class="sidenav-normal">Lainnya<b class="caret"></b></span>
               </a>
               <div class="collapse " id="ln">
                  <ul class="nav nav-sm flex-column">
                     <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('admin/surat/create-sklain/JS045'); ?>">
                           <i class="material-icons">check</i>
                           <span class="sidenav-normal">Keterangan Lainnya </span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li> -->
         <?php endif; ?>
         <li class="nav-item <?= $context == 'masterdata' ? 'active' : ''; ?>">
            <a class="nav-link " data-bs-toggle="collapse" aria-expanded="false" href="#data">
               <i class="material-icons">laptop</i>
               <span class="sidenav-normal">Master Data<b class="caret"></b></span>
            </a>
            <div class="collapse " id="data">
               <ul class="nav nav-sm flex-column">
                  <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
                     <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/data/create-profil'); ?>">
                           <i class="material-icons">check</i>
                           <p>Profil</p>
                        </a>
                     </li>
                  <?php endif; ?>
                  <li class="nav-item">
                     <a class="nav-link " href="<?= base_url('admin/data/data-warga'); ?>">
                        <i class="material-icons">check</i>
                        <span class="sidenav-normal">Warga </span>
                     </a>
                  </li>
                  <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
                     <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/data/jenis-surat'); ?>">
                           <i class="material-icons">check</i>
                           <p>Jenis Surat</p>
                        </a>
                     </li>
                  <?php endif; ?>
                  <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
                     <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/data/klasifikasi'); ?>">
                           <i class="material-icons">check</i>
                           <p>Klasifikasi</p>
                        </a>
                     </li>
                  <?php endif; ?>
               </ul>
            </div>
         </li>
         <li class="nav-item <?= $context == 'laporan' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('admin/laporan'); ?>">
               <i class="material-icons">print</i>
               <p>Laporan</p>
            </a>
         </li>
         <?php if (user()->toArray()['is_superadmin'] ?? '0' == '1') : ?>
            <li class="nav-item <?= $context == 'petugas' ? 'active' : ''; ?>">
               <a class="nav-link" href="<?= base_url('admin/petugas'); ?>">
                  <i class="material-icons">person</i>
                  <p>Data Petugas</p>
               </a>
            </li>
         <?php endif; ?>
      </ul>
   </div>
</div>