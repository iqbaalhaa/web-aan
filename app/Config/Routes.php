<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Scan
//$routes->get('/', 'Scan::index');
$routes->get('/', 'Admin\Dashboard::index');
/*
$routes->group('home', function (RouteCollection $routes) {
   $routes->get('/', 'Admin\Dashboard::home');
   $routes->get('/register', 'Register::index');
   $routes->post('/register/process', 'Register::process');
   $routes->get('/login', 'Login::index',['as' => 'login']);
   $routes->post('login/process', 'Login::process');
   $routes->get('logout', 'Login::logout');

*/
// Admin
$routes->group('admin', function (RouteCollection $routes) {

   // Admin dashboard
   $routes->get('', 'Admin\Dashboard::index');
   $routes->get('dashboard', 'Admin\Dashboard::dashboard');
   //ambil nama berdasarkan nik
   $routes->post('surat/getWarga', 'Admin\DataSurat::getWarga');
   // admin lihat data surat
   $routes->get('surat', 'Admin\DataSurat::index');
   $routes->post('surat', 'Admin\DataSurat::ambilDataSurat');
// Profil
   $routes->get('data/create-profil', 'Admin\MasterData::formProfil');
   $routes->post('data/create-profil', 'Admin\MasterData::saveProfil');
   $routes->get('data/edit-profil/(:any)', 'Admin\MasterData::editProfil/$1');
   $routes->post('data/update-profil', 'Admin\MasterData::updateProfil');

// Staff
   $routes->get('data/add-staff', 'Admin\MasterData::formAddstaff');
   $routes->post('data/add-staff', 'Admin\MasterData::saveStaff');
   $routes->get('data/edit-staff/(:any)', 'Admin\MasterData::editStaff/$1');
   $routes->post('data/update-staff', 'Admin\MasterData::updateStaff');
   $routes->delete('data/delete/(:any)', 'Admin\MasterData::delete/$1');
// Kua
   $routes->post('data/update-kua', 'Admin\MasterData::updateKua');

// Warga
   $routes->get('data/data-warga', 'Admin\MasterData::dataWarga');
   $routes->get('data/add-warga', 'Admin\MasterData::formAddwarga');
   $routes->post('data/add-warga', 'Admin\MasterData::saveWarga');
   $routes->get('data/edit-warga/(:any)', 'Admin\MasterData::editWarga/$1');
   $routes->post('data/update-warga', 'Admin\MasterData::updateWarga');
   $routes->delete('data/delete-warga/(:any)', 'Admin\MasterData::deleteWarga/$1');

   $routes->get('data/import-warga', 'Admin\MasterData::importWarga');
   $routes->post('data/prosesExcel', 'Admin\MasterData::prosesExcel');
   //$routes->post('data/prosesExcel', 'Admin\MasterData::importWargaExcel');
   $routes->get('data/download-warga', 'Admin\MasterData::downloadWarga');
   $routes->get('data/download-format-warga', 'Admin\MasterData::downloadFormatWarga');

// Jenis Surat
   $routes->get('data/jenis-surat', 'Admin\MasterData::dataJs');
   $routes->get('data/edit-jenis-surat/(:any)', 'Admin\MasterData::editJs/$1');
   $routes->post('data/update-jenis-surat', 'Admin\MasterData::updateJs');
//   $routes->delete('data/delete-jenis-surat/(:any)', 'Admin\MasterData::deleteJs/$1');
// Jenis Surat
   $routes->get('data/klasifikasi', 'Admin\MasterData::dataKls');
   
// Undangan
   $routes->get('surat/create-undangan/(:any)', 'Admin\DataSurat::formUndangan/$1');
   $routes->post('surat/create-undangan', 'Admin\DataSurat::saveUndangan');
   $routes->get('surat/edit-undangan/(:any)', 'Admin\DataSurat::editUndangan/$1');
   $routes->post('surat/update-undangan', 'Admin\DataSurat::updateUndangan');
   $routes->get('surat/undangan/(:any)', 'Admin\DataSurat::printUndangan/$1');
// Pengantar
   $routes->get('surat/create-pengantar/(:any)', 'Admin\DataSurat::formPengantar/$1');
   $routes->post('surat/create-pengantar', 'Admin\DataSurat::savePengantar');
   $routes->get('surat/edit-pengantar/(:any)', 'Admin\DataSurat::editPengantar/$1');
   $routes->post('surat/update-pengantar', 'Admin\DataSurat::updatePengantar');
   $routes->get('surat/pengantar/(:any)', 'Admin\DataSurat::printPengantar/$1');
// Pemberitahuan
   $routes->get('surat/create-pemberitahuan/(:any)', 'Admin\DataSurat::formPemberitahuan/$1');
   $routes->post('surat/create-pemberitahuan', 'Admin\DataSurat::savePemberitahuan');
   $routes->get('surat/edit-pemberitahuan/(:any)', 'Admin\DataSurat::editPemberitahuan/$1');
   $routes->post('surat/update-pemberitahuan', 'Admin\DataSurat::updatePemberitahuan');
   $routes->get('surat/pemberitahuan/(:any)', 'Admin\DataSurat::printPemberitahuan/$1');
// himbauan
   $routes->get('surat/create-himbauan/(:any)', 'Admin\DataSurat::formHimbauan/$1');
   $routes->post('surat/create-himbauan', 'Admin\DataSurat::saveHimbauan');
   $routes->get('surat/edit-himbauan/(:any)', 'Admin\DataSurat::editHimbauan/$1');
   $routes->post('surat/update-himbauan', 'Admin\DataSurat::updateHimbauan');
   $routes->get('surat/himbauan/(:any)', 'Admin\DataSurat::printHimbauan/$1');
// jawaban
   $routes->get('surat/create-jawaban/(:any)', 'Admin\DataSurat::formJawaban/$1');
   $routes->post('surat/create-jawaban', 'Admin\DataSurat::saveJawaban');
   $routes->get('surat/edit-jawaban/(:any)', 'Admin\DataSurat::editJawaban/$1');
   $routes->post('surat/update-jawaban', 'Admin\DataSurat::updateJawaban');
   $routes->get('surat/jawaban/(:any)', 'Admin\DataSurat::printJawaban/$1');
// SPPD
   $routes->get('surat/create-sppd/(:any)', 'Admin\DataSurat::formSppd/$1');
   $routes->post('surat/create-sppd', 'Admin\DataSurat::saveSppd');
   $routes->get('surat/edit-sppd/(:any)', 'Admin\DataSurat::editSppd/$1');
   $routes->post('surat/update-sppd', 'Admin\DataSurat::updateSppd');
   $routes->get('surat/sppd/(:any)', 'Admin\DataSurat::printSpdinas/$1');
   $routes->get('surat/c_spt/(:any)', 'Admin\DataSurat::printSpt/$1');
   $routes->get('surat/c_sppd/(:any)', 'Admin\DataSurat::printSppd/$1');
   $routes->get('surat/c_l1/(:any)', 'Admin\DataSurat::printL1/$1');
   $routes->get('surat/c_l2/(:any)', 'Admin\DataSurat::printL2/$1');
   $routes->get('surat/c_l3/(:any)', 'Admin\DataSurat::printL3/$1');

// TUGAS
   $routes->get('surat/create-tugas/(:any)', 'Admin\DataSurat::formTugas/$1');
   $routes->post('surat/create-tugas', 'Admin\DataSurat::saveTugas');
   $routes->get('surat/edit-tugas/(:any)', 'Admin\DataSurat::editTugas/$1');
   $routes->post('surat/update-tugas', 'Admin\DataSurat::updateTugas');
   $routes->get('surat/tugas/(:any)', 'Admin\DataSurat::printTugas/$1');
   $routes->get('surat/c_stugas/(:any)', 'Admin\DataSurat::printStugas/$1');
   $routes->get('surat/c_sktugas/(:any)', 'Admin\DataSurat::printSkst/$1');
   $routes->get('surat/c_lamsktugas/(:any)', 'Admin\DataSurat::printLamsk/$1');

// SKU
   $routes->get('surat/create-sku/(:any)', 'Admin\DataSurat::formSku/$1');
   $routes->post('surat/create-sku', 'Admin\DataSurat::saveSku');
   $routes->get('surat/edit-sku/(:any)', 'Admin\DataSurat::editSku/$1');
   $routes->post('surat/update-sku', 'Admin\DataSurat::updateSku');
//   $routes->delete('surat/del-sku/(:any)', 'Admin\DataSurat::delete/$1');
   $routes->get('surat/sku/(:any)', 'Admin\DataSurat::printSku/$1');
// SKTU
   $routes->get('surat/create-sktu/(:any)', 'Admin\DataSurat::formSktu/$1');
   $routes->post('surat/create-sktu', 'Admin\DataSurat::saveSktu');
   $routes->get('surat/edit-sktu/(:any)', 'Admin\DataSurat::editSktu/$1');
   $routes->post('surat/update-sktu', 'Admin\DataSurat::updateSktu');
//   $routes->delete('surat/del-sktu/(:any)', 'Admin\DataSurat::delete/$1');
   $routes->get('surat/sktu/(:any)', 'Admin\DataSurat::printSktu/$1');
// SKBR
   $routes->get('surat/create-skbr/(:any)', 'Admin\DataSurat::formSkbr/$1');
   $routes->post('surat/create-skbr', 'Admin\DataSurat::saveSkbr');
   $routes->get('surat/edit-skbr/(:any)', 'Admin\DataSurat::editSkbr/$1');
   $routes->post('surat/update-skbr', 'Admin\DataSurat::updateSkbr');
//   $routes->delete('surat/del-skbr/(:any)', 'Admin\DataSurat::delete/$1');
   $routes->get('surat/skbr/(:any)', 'Admin\DataSurat::printSkbr/$1');
// SKT
   $routes->get('surat/create-skt/(:any)', 'Admin\DataSurat::formSkt/$1');
   $routes->post('surat/create-skt', 'Admin\DataSurat::saveSkt');
   $routes->get('surat/edit-skt/(:any)', 'Admin\DataSurat::editSkt/$1');
   $routes->post('surat/update-skt', 'Admin\DataSurat::updateSkt');
   $routes->get('surat/skt/(:any)', 'Admin\DataSurat::printSkt/$1');
// SKTM
   $routes->get('surat/create-sktm/(:any)', 'Admin\DataSurat::formSktm/$1');
   $routes->post('surat/create-sktm', 'Admin\DataSurat::saveSktm');
   $routes->get('surat/edit-sktm/(:any)', 'Admin\DataSurat::editSktm/$1');
   $routes->post('surat/update-sktm', 'Admin\DataSurat::updateSktm');
   $routes->get('surat/sktm/(:any)', 'Admin\DataSurat::printSktm/$1');
// SKKTM
   $routes->get('surat/create-skktm/(:any)', 'Admin\DataSurat::formSkktm/$1');
   $routes->post('surat/create-skktm', 'Admin\DataSurat::saveSkktm');
   $routes->get('surat/edit-skktm/(:any)', 'Admin\DataSurat::editSkktm/$1');
   $routes->post('surat/update-skktm', 'Admin\DataSurat::updateSkktm');
   $routes->get('surat/skktm/(:any)', 'Admin\DataSurat::printSkktm/$1');
// SKRTM
   $routes->get('surat/create-skrtm/(:any)', 'Admin\DataSurat::formSkrtm/$1');
   $routes->post('surat/create-skrtm', 'Admin\DataSurat::saveSkrtm');
   $routes->get('surat/edit-skrtm/(:any)', 'Admin\DataSurat::editSkrtm/$1');
   $routes->post('surat/update-skrtm', 'Admin\DataSurat::updateSkrtm');
   $routes->get('surat/skrtm/(:any)', 'Admin\DataSurat::printSkrtm/$1');
// SKPHS
   $routes->get('surat/create-skphs/(:any)', 'Admin\DataSurat::formSkphs/$1');
   $routes->post('surat/create-skphs', 'Admin\DataSurat::saveSkphs');
   $routes->get('surat/edit-skphs/(:any)', 'Admin\DataSurat::editSkphs/$1');
   $routes->post('surat/update-skphs', 'Admin\DataSurat::updateSkphs');
   $routes->get('surat/skphs/(:any)', 'Admin\DataSurat::printSkphs/$1');
// SKORTU
   $routes->get('surat/create-skortu/(:any)', 'Admin\DataSurat::formSkortu/$1');
   $routes->post('surat/create-skortu', 'Admin\DataSurat::saveSkortu');
   $routes->get('surat/edit-skortu/(:any)', 'Admin\DataSurat::editSkortu/$1');
   $routes->post('surat/update-skortu', 'Admin\DataSurat::updateSkortu');
   $routes->get('surat/skortu/(:any)', 'Admin\DataSurat::printSkortu/$1');
// SKANAK
   $routes->get('surat/create-skanak/(:any)', 'Admin\DataSurat::formSkanak/$1');
   $routes->post('surat/create-skanak', 'Admin\DataSurat::saveSkanak');
   $routes->get('surat/edit-skanak/(:any)', 'Admin\DataSurat::editSkanak/$1');
   $routes->post('surat/update-skanak', 'Admin\DataSurat::updateSkanak');
   $routes->get('surat/skanak/(:any)', 'Admin\DataSurat::printSkanak/$1');
// SKMATI
   $routes->get('surat/create-skmati/(:any)', 'Admin\DataSurat::formSkmati/$1');
   $routes->post('surat/create-skmati', 'Admin\DataSurat::saveSkmati');
   $routes->get('surat/edit-skmati/(:any)', 'Admin\DataSurat::editSkmati/$1');
   $routes->post('surat/update-skmati', 'Admin\DataSurat::updateSkmati');
   $routes->get('surat/skmati/(:any)', 'Admin\DataSurat::printSkmati/$1');   
// SKPERGI
   $routes->get('surat/create-skpergi/(:any)', 'Admin\DataSurat::formSkpergi/$1');
   $routes->post('surat/create-skpergi', 'Admin\DataSurat::saveSkpergi');
   $routes->get('surat/edit-skpergi/(:any)', 'Admin\DataSurat::editSkpergi/$1');
   $routes->post('surat/update-skpergi', 'Admin\DataSurat::updateSkpergi');
   $routes->get('surat/skpergi/(:any)', 'Admin\DataSurat::printSkpergi/$1');   
// SKAHLI WARIS
   $routes->get('surat/create-skaw/(:any)', 'Admin\DataSurat::formSkaw/$1');
   $routes->post('surat/create-skaw', 'Admin\DataSurat::saveSkaw');
   $routes->get('surat/edit-ahliwaris/(:any)', 'Admin\DataSurat::editSkaw/$1');
   $routes->post('surat/update-skaw', 'Admin\DataSurat::updateSkaw');
   $routes->get('surat/ahliwaris/(:any)', 'Admin\DataSurat::printAw/$1');
   $routes->get('surat/skaw/(:any)', 'Admin\DataSurat::printSkaw/$1');
   $routes->get('surat/pernyataan-aw/(:any)', 'Admin\DataSurat::printPaw/$1');
// SKLBG
   $routes->get('surat/create-sklbg/(:any)', 'Admin\DataSurat::formSklbg/$1');
   $routes->post('surat/create-sklbg', 'Admin\DataSurat::saveSklbg');
   $routes->get('surat/edit-sklbg/(:any)', 'Admin\DataSurat::editSklbg/$1');
   $routes->post('surat/update-sklbg', 'Admin\DataSurat::updateSklbg');
   $routes->get('surat/sklbg/(:any)', 'Admin\DataSurat::printSklbg/$1');
// SKB
   $routes->get('surat/create-skkb/(:any)', 'Admin\DataSurat::formSkkb/$1');
   $routes->post('surat/create-skkb', 'Admin\DataSurat::saveSkkb');
   $routes->get('surat/edit-skkb/(:any)', 'Admin\DataSurat::editSkkb/$1');
   $routes->post('surat/update-skkb', 'Admin\DataSurat::updateSkkb');
   $routes->get('surat/skkb/(:any)', 'Admin\DataSurat::printSkkb/$1');
// SKCK
   $routes->get('surat/create-skck/(:any)', 'Admin\DataSurat::formSkck/$1');
   $routes->post('surat/create-skck', 'Admin\DataSurat::saveSkck');
   $routes->get('surat/edit-skck/(:any)', 'Admin\DataSurat::editSkck/$1');
   $routes->post('surat/update-skck', 'Admin\DataSurat::updateSkck');
   $routes->get('surat/skck/(:any)', 'Admin\DataSurat::printSkck/$1');
// SIMB
   $routes->get('surat/create-simb/(:any)', 'Admin\DataSurat::formSimb/$1');
   $routes->post('surat/create-simb', 'Admin\DataSurat::saveSimb');
   $routes->get('surat/edit-simb/(:any)', 'Admin\DataSurat::editSimb/$1');
   $routes->post('surat/update-simb', 'Admin\DataSurat::updateSimb');
   $routes->get('surat/simb/(:any)', 'Admin\DataSurat::printSimb/$1');
// sig
   $routes->get('surat/create-sig/(:any)', 'Admin\DataSurat::formSig/$1');
   $routes->post('surat/create-sig', 'Admin\DataSurat::saveSig');
   $routes->get('surat/edit-sig/(:any)', 'Admin\DataSurat::editSig/$1');
   $routes->post('surat/update-sig', 'Admin\DataSurat::updateSig');
   $routes->get('surat/sig/(:any)', 'Admin\DataSurat::printSig/$1');
// bedaid
   $routes->get('surat/create-bedaid/(:any)', 'Admin\DataSurat::formBedaid/$1');
   $routes->post('surat/create-bedaid', 'Admin\DataSurat::saveBedaid');
   $routes->get('surat/edit-bedaid/(:any)', 'Admin\DataSurat::editBedaid/$1');
   $routes->post('surat/update-bedaid', 'Admin\DataSurat::updateBedaid');
   $routes->get('surat/bedaid/(:any)', 'Admin\DataSurat::printBedaid/$1');
// domisili
   $routes->get('surat/create-domisili/(:any)', 'Admin\DataSurat::formDomisili/$1');
   $routes->post('surat/create-domisili', 'Admin\DataSurat::saveDomisili');
   $routes->get('surat/edit-domisili/(:any)', 'Admin\DataSurat::editDomisili/$1');
   $routes->post('surat/update-domisili', 'Admin\DataSurat::updateDomisili');
   $routes->get('surat/domisili/(:any)', 'Admin\DataSurat::printDomisili/$1');
// pindah
   $routes->get('surat/create-pindah/(:any)', 'Admin\DataSurat::formPindah/$1');
   $routes->post('surat/create-pindah', 'Admin\DataSurat::savePindah');
   $routes->get('surat/edit-pindah/(:any)', 'Admin\DataSurat::editPindah/$1');
   $routes->post('surat/update-pindah', 'Admin\DataSurat::updatePindah');
   $routes->get('surat/pindah/(:any)', 'Admin\DataSurat::printPindah/$1');
// kelahiran
   $routes->get('surat/create-kelahiran/(:any)', 'Admin\DataSurat::formKelahiran/$1');
   $routes->post('surat/create-kelahiran', 'Admin\DataSurat::saveKelahiran');
   $routes->get('surat/edit-kelahiran/(:any)', 'Admin\DataSurat::editKelahiran/$1');
   $routes->post('surat/update-kelahiran', 'Admin\DataSurat::updateKelahiran');
   $routes->get('surat/kelahiran/(:any)', 'Admin\DataSurat::printKelahiran/$1');

// pemakaman
   $routes->get('surat/create-pemakaman/(:any)', 'Admin\DataSurat::formPemakaman/$1');
   $routes->post('surat/create-pemakaman', 'Admin\DataSurat::savePemakaman');
   $routes->get('surat/edit-pemakaman/(:any)', 'Admin\DataSurat::editPemakaman/$1');
   $routes->post('surat/update-pemakaman', 'Admin\DataSurat::updatePemakaman');
   $routes->get('surat/pemakaman/(:any)', 'Admin\DataSurat::printPemakaman/$1');
   
// f121
   $routes->get('surat/create-f121/(:any)', 'Admin\DataSurat::formF121/$1');
   $routes->post('surat/create-f121', 'Admin\DataSurat::saveF121');
   $routes->get('surat/edit-f121/(:any)', 'Admin\DataSurat::editF121/$1');
   $routes->post('surat/update-f121', 'Admin\DataSurat::updateF121');
   $routes->get('surat/f121/(:any)', 'Admin\DataSurat::printF121/$1');
// SPPD
   $routes->get('surat/create-na/(:any)', 'Admin\DataSurat::formNa/$1');
   $routes->post('surat/create-na', 'Admin\DataSurat::saveNa');
   $routes->get('surat/edit-na/(:any)', 'Admin\DataSurat::editNa/$1');
   $routes->post('surat/update-na', 'Admin\DataSurat::updateNa');
   $routes->get('surat/na/(:any)', 'Admin\DataSurat::printNa/$1');
   $routes->get('surat/c_n1/(:any)', 'Admin\DataSurat::printN1/$1');
   $routes->get('surat/c_n2/(:any)', 'Admin\DataSurat::printN2/$1');
   $routes->get('surat/c_n3/(:any)', 'Admin\DataSurat::printN3/$1');
   $routes->get('surat/c_n4/(:any)', 'Admin\DataSurat::printN4/$1');
   $routes->get('surat/c_n5/(:any)', 'Admin\DataSurat::printN5/$1');
// NIKAH
   $routes->get('surat/create-sknh/(:any)', 'Admin\DataSurat::formSknh/$1');
   $routes->post('surat/create-sknh', 'Admin\DataSurat::saveSknh');
   $routes->get('surat/edit-sknh/(:any)', 'Admin\DataSurat::editSknh/$1');
   $routes->post('surat/update-sknh', 'Admin\DataSurat::updateSknh');
   $routes->get('surat/sknh/(:any)', 'Admin\DataSurat::printSknh/$1');
// PERNAH NIKAH
   $routes->get('surat/create-pnikah/(:any)', 'Admin\DataSurat::formPnikah/$1');
   $routes->post('surat/create-pnikah', 'Admin\DataSurat::savePnikah');
   $routes->get('surat/edit-pnikah/(:any)', 'Admin\DataSurat::editPnikah/$1');
   $routes->post('surat/update-pnikah', 'Admin\DataSurat::updatePnikah');
   $routes->get('surat/pnikah/(:any)', 'Admin\DataSurat::printPnikah/$1');
// BELUM NIKAH
   $routes->get('surat/create-bnikah/(:any)', 'Admin\DataSurat::formBnikah/$1');
   $routes->post('surat/create-bnikah', 'Admin\DataSurat::saveBnikah');
   $routes->get('surat/edit-bnikah/(:any)', 'Admin\DataSurat::editBnikah/$1');
   $routes->post('surat/update-bnikah', 'Admin\DataSurat::updateBnikah');
   $routes->get('surat/bnikah/(:any)', 'Admin\DataSurat::printBnikah/$1');
// DUDA JANDA
   $routes->get('surat/create-dj/(:any)', 'Admin\DataSurat::formDj/$1');
   $routes->post('surat/create-dj', 'Admin\DataSurat::saveDj');
   $routes->get('surat/edit-dj/(:any)', 'Admin\DataSurat::editDj/$1');
   $routes->post('surat/update-dj', 'Admin\DataSurat::updateDj');
   $routes->get('surat/dj/(:any)', 'Admin\DataSurat::printDj/$1');
// DUDA JANDA
   $routes->get('surat/create-n6/(:any)', 'Admin\DataSurat::formN6/$1');
   $routes->post('surat/create-n6', 'Admin\DataSurat::saveN6');
   $routes->get('surat/edit-n6/(:any)', 'Admin\DataSurat::editN6/$1');
   $routes->post('surat/update-n6', 'Admin\DataSurat::updateN6');
   $routes->get('surat/n6/(:any)', 'Admin\DataSurat::printN6/$1');
// CERAI
   $routes->get('surat/create-cerai/(:any)', 'Admin\DataSurat::formCerai/$1');
   $routes->post('surat/create-cerai', 'Admin\DataSurat::saveCerai');
   $routes->get('surat/edit-cerai/(:any)', 'Admin\DataSurat::editCerai/$1');
   $routes->post('surat/update-cerai', 'Admin\DataSurat::updateCerai');
   $routes->get('surat/cerai/(:any)', 'Admin\DataSurat::printCerai/$1');
// PERNYATAAN STATUS PERKAWINAN
   $routes->get('surat/create-pstatus/(:any)', 'Admin\DataSurat::formPstatus/$1');
   $routes->post('surat/create-pstatus', 'Admin\DataSurat::savePstatus');
   $routes->get('surat/edit-pstatus/(:any)', 'Admin\DataSurat::editPstatus/$1');
   $routes->post('surat/update-pstatus', 'Admin\DataSurat::updatePstatus');
   $routes->get('surat/pstatus/(:any)', 'Admin\DataSurat::printPstatus/$1');
// KETERANGAN TANAH
   $routes->get('surat/create-sktanah/(:any)', 'Admin\DataSurat::formSktanah/$1');
   $routes->post('surat/create-sktanah', 'Admin\DataSurat::saveSktanah');
   $routes->get('surat/edit-sktanah/(:any)', 'Admin\DataSurat::editSktanah/$1');
   $routes->post('surat/update-sktanah', 'Admin\DataSurat::updateSktanah');
   $routes->get('surat/sktanah/(:any)', 'Admin\DataSurat::printSktanah/$1');
// SPORADIK
   $routes->get('surat/create-sporadik/(:any)', 'Admin\DataSurat::formSporadik/$1');
   $routes->post('surat/create-sporadik', 'Admin\DataSurat::saveSporadik');
   $routes->get('surat/edit-sporadik/(:any)', 'Admin\DataSurat::editSporadik/$1');
   $routes->post('surat/update-sporadik', 'Admin\DataSurat::updateSporadik');
   $routes->get('surat/sporadik/(:any)', 'Admin\DataSurat::printSporadik/$1');
// SEWA TANAH
   $routes->get('surat/create-sewatanah/(:any)', 'Admin\DataSurat::formSewatanah/$1');
   $routes->post('surat/create-sewatanah', 'Admin\DataSurat::saveSewatanah');
   $routes->get('surat/edit-sewatanah/(:any)', 'Admin\DataSurat::editSewatanah/$1');
   $routes->post('surat/update-sewatanah', 'Admin\DataSurat::updateSewatanah');
   $routes->get('surat/sewatanah/(:any)', 'Admin\DataSurat::printSewatanah/$1');
// JUAL BELI TANAH
   $routes->get('surat/create-jualbelitanah/(:any)', 'Admin\DataSurat::formJualbelitanah/$1');
   $routes->post('surat/create-jualbelitanah', 'Admin\DataSurat::saveJualbelitanah');
   $routes->get('surat/edit-jualbelitanah/(:any)', 'Admin\DataSurat::editJualbelitanah/$1');
   $routes->post('surat/update-jualbelitanah', 'Admin\DataSurat::updateJualbelitanah');
   $routes->get('surat/jualbelitanah/(:any)', 'Admin\DataSurat::printJualbelitanah/$1');
// GADAI TANAH
   $routes->get('surat/create-gadaitanah/(:any)', 'Admin\DataSurat::formGadaitanah/$1');
   $routes->post('surat/create-gadaitanah', 'Admin\DataSurat::saveGadaitanah');
   $routes->get('surat/edit-gadaitanah/(:any)', 'Admin\DataSurat::editGadaitanah/$1');
   $routes->post('surat/update-gadaitanah', 'Admin\DataSurat::updateGadaitanah');
   $routes->get('surat/gadaitanah/(:any)', 'Admin\DataSurat::printGadaitanah/$1');
// LAIN2
   $routes->get('surat/create-sklain/(:any)', 'Admin\DataSurat::formSklain/$1');
   $routes->post('surat/create-sklain', 'Admin\DataSurat::saveSklain');
   $routes->get('surat/edit-sklain/(:any)', 'Admin\DataSurat::editSklain/$1');
   $routes->post('surat/update-sklain', 'Admin\DataSurat::updateSklain');
   $routes->get('surat/sklain/(:any)', 'Admin\DataSurat::printSklain/$1');

   // admin hapus data surat
   $routes->delete('surat/delete/(:any)', 'Admin\DataSurat::delete/$1');
   // Kirim Permohonan
   $routes->get('permohonan', 'Admin\Dashboard::Permohonan');
   $routes->post('permohonan/getjenis', 'Admin\Dashboard::getJenis');
   
   $routes->post('permohonan/kirim', 'Admin\Dashboard::kirimPermohonan');
   $routes->post('permohonan/getwarga', 'Admin\Dashboard::getWarga');
   $routes->get('permohonan/status-permohonan', 'Admin\Dashboard::statusPermohonan');
   $routes->get('permohonan/tunggu-permohonan/(:any)', 'Admin\Dashboard::tungguPermohonan/$1');
   $routes->get('permohonan/aksi-permohonan/(:any)', 'Admin\Dashboard::aksiPermohonan/$1');
   $routes->post('permohonan/ekspermohonan', 'Admin\Dashboard::eksPermohonan');
   $routes->get('pelayanan/surat', 'Admin\Dashboard::pelayananSurat');

   // admin generate QR
   $routes->get('generate', 'Admin\GenerateQR::index');
   $routes->post('generate/surat', 'Admin\QRGenerator::generateQrSurat');

   // admin buat laporan
   $routes->get('laporan', 'Admin\GenerateLaporan::index');
   $routes->get('laporan/surat', 'Admin\GenerateLaporan::printLaporanSurat');
   // superadmin lihat data petugas
   $routes->get('petugas', 'Admin\DataPetugas::index');
   $routes->post('petugas', 'Admin\DataPetugas::ambilDataPetugas');
   // superadmin tambah data petugas
   $routes->get('petugas/register', 'Admin\DataPetugas::registerPetugas');
   // superadmin edit data petugas
   $routes->get('petugas/edit/(:any)', 'Admin\DataPetugas::formEditPetugas/$1');
   $routes->post('petugas/edit', 'Admin\DataPetugas::updatePetugas');
   // superadmin hapus data petugas
   $routes->delete('petugas/delete/(:any)', 'Admin\DataPetugas::delete/$1');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
   require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
