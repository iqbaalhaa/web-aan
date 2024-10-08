<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

use App\Models\PetugasModel;
use App\Models\SuratModel;
use App\Models\JenissuratModel;
use App\Models\WargaModel;
use App\Models\StaffModel;
use App\Models\DesaModel;
use App\Models\AhliwarisModel;
use App\Models\UndanganModel;
use App\Models\PdinasModel;
use App\Models\SurattugasModel;
use App\Models\KuaModel;
use App\Models\PermohonanModel;

use CodeIgniter\Exceptions\PageNotFoundException;

class DataSurat extends BaseController
{
   protected PetugasModel $petugasModel;
   protected SuratModel $suratModel;
   protected JenissuratModel $jenissuratModel;
   protected StaffModel $staffModel;
   protected WargaModel $wargaModel;
   protected DesaModel $desaModel;
   protected AhliwarisModel $awModel;
   protected UndanganModel $undanganModel;
   protected PdinasModel $sppdModel;
   protected SurattugasModel $tugasModel;
   protected KuaModel $kuaModel;
   protected PermohonanModel $permohonanModel;
   public function __construct()
   {
      $this->petugasModel = new PetugasModel();
      $this->suratModel = new SuratModel();
      $this->jenissuratModel = new JenissuratModel();
      $this->staffModel = new StaffModel();
      $this->wargaModel = new WargaModel();
      $this->desaModel = new DesaModel();
      $this->awModel = new AhliwarisModel();
      $this->undanganModel = new UndanganModel();
      $this->sppdModel = new PdinasModel();
      $this->tugasModel = new SurattugasModel();
      $this->kuaModel = new KuaModel();
      $this->permohonanModel = new PermohonanModel();
   }

   public function index()
   {
      $kodeSurat = $this->request->getVar('kode_surat') ?? null;
      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $staff = $this->staffModel->getAllStaff();
      //$permohonan = $this->permohonanModel->getAllPermohonan();

      $data = [
         'title' => '',
         'ctx' => 'surat',
         'jenis' => $jenis,
         'staff' => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'surat' => $this->suratModel->getAllSuratAndStaffAndJenis(),
         'empty' => empty($jenis),
         'petugas' => $this->petugasModel->getAllPetugas()

      ];

      return view('admin/data/data-surat', $data);
   }

  public function getWarga(){

        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $data = array();

        if(isset($postData['search'])){

            $search = $postData['search'];

            // Fetch record
            $warga = new WargaModel();
            $wargalist = $warga->select('nkk,nik,nama,jk,tmp_lahir,tgl_lahir,kwng,agama,status,kerjaan,prov,kab,kec,desa,alamat')
                ->like('nik',$search)
                ->orderBy('nik')
                ->findAll(2);
            foreach($wargalist as $w){
                $data[] = array(
                    "label" => $w['nik'],
                    "nkk" => $w['nkk'],
                    "nama" => $w['nama'],
                    "jk" => $w['jk'],
                    "tmpl" => $w['tmp_lahir'],
                    "tgll" => $w['tgl_lahir'],
                    "kwng" => $w['kwng'],
                    "agama" => $w['agama'],
                    "status" => $w['status'],
                    "kerjaan" => $w['kerjaan'],
                    "prov" => $w['prov'],
                    "kab" => $w['kab'],
                    "kec" => $w['kec'],
                    "desa" => $w['desa'],
                    "alamat" => $w['alamat'],
                );
            }
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);

    }

   public function ambilDataSurat()
   {
      $kodeSurat = $this->request->getVar('kode_surat') ?? null;
      $result = $this->suratModel->getAllSuratByKode($kodeSurat);

      $data = [
         'data' => $result,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($result)
      ];

      return view('admin/data/list-data-surat', $data);
   }
#START TATA USAHAAAAAAAAAAAAAAAAAAA
#1 BEGIN UNDANGAN
   public function formUndangan($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);

      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Undangan'
      ];

      return view('admin/create/create-undangan', $data);
   }

   public function saveUndangan()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $kegiatan = $this->request->getVar('kegiatan');
      $hari = $this->request->getVar('hari');
      $tgl = $this->request->getVar('tgl');
      $waktu = $this->request->getVar('waktu');
      $tempat = $this->request->getVar('tempat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $kegiatan."#".$hari."#".$tgl."#".$waktu."#".$tempat;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);

      $kodeUdg = $this->request->getVar('kode_suratu');
      $namaUdg = $this->request->getVar('namau');

      $result = $this->undanganModel->saveDataUndangan(NULL, $kodeUdg, $namaUdg);

      $du = $this->undanganModel->getAllUndanganByKode($kodeSurat);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'du'    => $du,
         'staff' => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Undangan berhasil',
            'error' => false
         ]);
          return view('admin/print/undangan', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/surat/create-undangan');
   }

   public function editUndangan($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $du = $this->undanganModel->getAllUndanganByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'du' => $du,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Undangan',
      ];

      return view('admin/edit/edit-undangan', $data);
   }

   public function updateUndangan()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $kegiatan = $this->request->getVar('kegiatan');
      $hari = $this->request->getVar('hari');
      $tgl = $this->request->getVar('tgl');
      $waktu = $this->request->getVar('waktu');
      $tempat = $this->request->getVar('tempat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $kegiatan."#".$hari."#".$tgl."#".$waktu."#".$tempat;
      
      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      
      $idU= $this->request->getVar('idu');
      $delU = $this->undanganModel->delete($idU);
      $kodeUdg = $this->request->getVar('kode_suratu');
      $namaUdg = $this->request->getVar('namau');

      $result = $this->undanganModel->saveDataUndangan($idU, $kodeUdg, $namaUdg);

      $du = $this->undanganModel->getAllUndanganByKode($kodeSurat);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'du'    => $du,
         'staff' => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/undangan', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-undangan/' . $idSurat);
   }

   public function printUndangan($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $du = $this->undanganModel->getAllUndanganByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'du' => $du
      ];

      return view('admin/print/undangan', $data). view('admin/print/topdf');

   }

   #END UNDANGAN

#2 BEGIN PENGANTAR
   public function formPengantar($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);

      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Pengantar'
      ];

      return view('admin/create/create-pengantar', $data);
   }

   public function savePengantar()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $hal = $this->request->getVar('perihal');
      $lam = $this->request->getVar('lampiran');
      $dasar = $this->request->getVar('dasar');
      $lbg = $this->request->getVar('lembaga');
      $almt = $this->request->getVar('alamat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $hal."#".$lam."#".$dasar."#".$lbg."#".$almt;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);

      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Pengantar berhasil',
            'error' => false
         ]);
          return view('admin/print/pengantar', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/surat/create-pengantar');
   }

   public function editPengantar($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Pengantar',
      ];

      return view('admin/edit/edit-pengantar', $data);
   }

   public function updatePengantar()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $hal = $this->request->getVar('perihal');
      $lam = $this->request->getVar('lampiran');
      $dasar = $this->request->getVar('dasar');
      $lbg = $this->request->getVar('lembaga');
      $almt = $this->request->getVar('alamat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $hal."#".$lam."#".$dasar."#".$lbg."#".$almt;
      
      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/pengantar', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-pengantar/' . $idSurat);
   }

   public function printPengantar($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/pengantar', $data). view('admin/print/topdf');

   }

   #END PENGANTAR

#3 BEGIN PEMBERITAHUAN
   public function formPemberitahuan($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);

      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Pemberitahuan'
      ];

      return view('admin/create/create-pemberitahuan', $data);
   }

   public function savePemberitahuan()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $hal = $this->request->getVar('perihal');
      $lam = $this->request->getVar('lampiran');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');
      $isi = $this->request->getVar('isi');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $hal."#".$lam."#".$ke."#".$di."#".$isi;
      $noSurat    = $this->request->getVar('no_surat');
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);

      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Pemberitahuan berhasil',
            'error' => false
         ]);
          return view('admin/print/pemberitahuan', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/surat/create-pemberitahuan');
   }

   public function editPemberitahuan($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Pemberitahuan',
      ];

      return view('admin/edit/edit-pemberitahuan', $data);
   }

   public function updatePemberitahuan()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $hal = $this->request->getVar('perihal');
      $lam = $this->request->getVar('lampiran');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');
      $isi = $this->request->getVar('isi');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $hal."#".$lam."#".$ke."#".$di."#".$isi;
      
      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/pemberitahuan', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-pemberitahuan/' . $idSurat);
   }

   public function printPemberitahuan($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/pemberitahuan', $data). view('admin/print/topdf');

   }

   #END PEMBERITAHUAN

#4 BEGIN HIMBAUAN
   public function formHimbauan($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);

      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Himbauan'
      ];

      return view('admin/create/create-himbauan', $data);
   }

   public function saveHimbauan()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $hal = $this->request->getVar('perihal');
      $lam = $this->request->getVar('lampiran');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');
      $isi = $this->request->getVar('isi');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $hal."#".$lam."#".$ke."#".$di."#".$isi;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);

      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Himbauan berhasil',
            'error' => false
         ]);
          return view('admin/print/himbauan', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/surat/create-himbauan');
   }

   public function editHimbauan($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Himbauan',
      ];

      return view('admin/edit/edit-himbauan', $data);
   }

   public function updateHimbauan()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $hal = $this->request->getVar('perihal');
      $lam = $this->request->getVar('lampiran');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');
      $isi = $this->request->getVar('isi');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $hal."#".$lam."#".$ke."#".$di."#".$isi;
      
      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/himbauan', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-himbauan/' . $idSurat);
   }

   public function printHimbauan($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/himbauan', $data). view('admin/print/topdf');

   }

   #END HIMBAUAN

#5 BEGIN JAWABAN
   public function formJawaban($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);

      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Jawaban'
      ];

      return view('admin/create/create-jawaban', $data);
   }

   public function saveJawaban()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $hal = $this->request->getVar('perihal');
      $lam = $this->request->getVar('lampiran');
      $isi = $this->request->getVar('isi');
      $dasar = $this->request->getVar('dasar');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $hal."#".$lam."#".$isi."#".$dasar."#".$ke."#".$di;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);

      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Jawaban berhasil',
            'error' => false
         ]);
          return view('admin/print/jawaban', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/surat/create-jawaban');
   }

   public function editJawaban($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Jawaban',
      ];

      return view('admin/edit/edit-jawaban', $data);
   }

   public function updateJawaban()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $hal = $this->request->getVar('perihal');
      $lam = $this->request->getVar('lampiran');
      $isi = $this->request->getVar('isi');
      $dasar = $this->request->getVar('dasar');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $hal."#".$lam."#".$isi."#".$dasar."#".$ke."#".$di;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/jawaban', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-jawaban/' . $idSurat);
   }

   public function printJawaban($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/jawaban', $data). view('admin/print/topdf');

   }

   #END JAWABAN

#6 BEGIN SPPD
   public function formSppd($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);

      $data = [
         'ctx'    => 'surat',
         'jenis'  => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title'  => 'Surat Perintah Perjalanan Dinas'
      ];

      return view('admin/create/create-sppd', $data);
   }

   public function saveSppd()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $kegiatan = $this->request->getVar('kegiatan');
      $tempat = $this->request->getVar('tempat');
      $tgl1 = $this->request->getVar('tgl1');
      $tgl2 = $this->request->getVar('tgl2');
      $nama = $this->request->getVar('nama');
      $nip = $this->request->getVar('nip');
      $pangkat = $this->request->getVar('pangkat');
      $jabatan = $this->request->getVar('jabatan');
      $biaya = $this->request->getVar('biaya');
      $uh = $this->request->getVar('uh');
      $tr = $this->request->getVar('tr');
      $inap = $this->request->getVar('inap');
      $rep = $this->request->getVar('rep');
      $sewa = $this->request->getVar('sewa');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $kegiatan."#".$tempat."#".$tgl1."#".$tgl2."#".$nama."#".$nip."#".$pangkat."#".$jabatan."#".$biaya."#".$uh."#".$tr."#".$inap."#".$rep."#".$sewa;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);

      $kodePd = $this->request->getVar('kode_suratpd');
      $namaPd = $this->request->getVar('namapd');
      $tgllPd = $this->request->getVar('tgllpd');
      $ketPd = $this->request->getVar('ketpd');

      $result = $this->sppdModel->saveDataSppd(NULL, $kodePd, $namaPd, $tgllPd, $ketPd);

      $sppd = $this->sppdModel->getAllSppdByKode($kodeSurat);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'sppd'    => $sppd,
         'staff' => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'desa' => $desa,
         'ctx'    => 'surat',
         'title'  => 'Surat Perintah Perjalanan Dinas'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Perintah Perjalanan Dinas berhasil',
            'error' => false
         ]);
          return view('admin/print/c_pdinas', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/surat/create-sppd');
   }

   public function editSppd($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $sppd = $this->sppdModel->getAllSppdByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'sppd' => $sppd,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Perintah Perjalanan Dinas'
      ];

      return view('admin/edit/edit-sppd', $data);
   }

   public function updateSppd()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $kegiatan = $this->request->getVar('kegiatan');
      $tempat = $this->request->getVar('tempat');
      $tgl1 = $this->request->getVar('tgl1');
      $tgl2 = $this->request->getVar('tgl2');
      $nama = $this->request->getVar('nama');
      $nip = $this->request->getVar('nip');
      $pangkat = $this->request->getVar('pangkat');
      $jabatan = $this->request->getVar('jabatan');
      $biaya = $this->request->getVar('biaya');
      $uh = $this->request->getVar('uh');
      $tr = $this->request->getVar('tr');
      $inap = $this->request->getVar('inap');
      $rep = $this->request->getVar('rep');
      $sewa = $this->request->getVar('sewa');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $kegiatan."#".$tempat."#".$tgl1."#".$tgl2."#".$nama."#".$nip."#".$pangkat."#".$jabatan."#".$biaya."#".$uh."#".$tr."#".$inap."#".$rep."#".$sewa;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      
      $idPd= $this->request->getVar('idpd');
      $delPd = $this->sppdModel->delete($idPd);
      $kodePd = $this->request->getVar('kode_suratpd');
      $namaPd = $this->request->getVar('namapd');
      $tgllPd = $this->request->getVar('tgllpd');
      $ketPd = $this->request->getVar('ketpd');

      $result = $this->sppdModel->saveDataSppd($idPd, $kodePd, $namaPd, $tgllPd, $ketPd);

      $sppd = $this->sppdModel->getAllSppdByKode($kodeSurat);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'sppd'    => $sppd,
         'staff' => $staff,
         'desa' => $desa,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Cetak Surat Perintah Perjalanan Dinas'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/c_pdinas', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sppd/' . $idSurat);
   }

   public function printSpdinas($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $sppd = $this->sppdModel->getAllSppdByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'sppd' => $sppd,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Perintah Perjalanan Dinas',
      ];

      return view('admin/print/c_pdinas', $data);

   }
public function printSpt($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $sppd = $this->sppdModel->getAllSppdByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'sppd' => $sppd,
         'ctx' => 'surat',
         'title' => 'Surat Perintah Perjalanan Dinas',
      ];

      return view('admin/print/c_spt', $data). view('admin/print/topdf');

   }
   public function printSppd($kodeSurat)
   {
      $sppdModel = new PdinasModel();
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $sppd = $this->sppdModel->getAllSppdByKode($kodeSurat);
      $jsppd = $sppdModel->select('count(*) as jdata')->first();

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'jsppd' => $jsppd,
         'sppd' => $sppd,
         'ctx' => 'surat',
         'title' => 'Surat Perintah Perjalanan Dinas',
      ];

      return view('admin/print/c_sppd', $data). view('admin/print/topdf');

   }
   public function printL1($kodeSurat)
   {
      
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $sppd = $this->sppdModel->getAllSppdByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'sppd' => $sppd,
         'ctx' => 'surat',
         'title' => 'Surat Perintah Perjalanan Dinas',
      ];

      return view('admin/print/c_l1', $data). view('admin/print/topdf');

   }
   public function printL2($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $sppd = $this->sppdModel->getAllSppdByKode($kodeSurat);
      $staff = $this->staffModel->getStaffByJabatan();
      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'sppd' => $sppd,
         'staff' => $staff,
         'ctx' => 'surat',
         'title' => 'Surat Perintah Perjalanan Dinas',
      ];

      return view('admin/print/c_l2', $data). view('admin/print/topdf');

   }
   public function printL3($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $sppd = $this->sppdModel->getAllSppdByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'sppd' => $sppd,
         'ctx' => 'surat',
         'title' => 'Surat Perintah Perjalanan Dinas',
      ];

      return view('admin/print/c_l3', $data). view('admin/print/topdf');

   }
   #END SPPD
#7 BEGIN SURAT TUGAS

   public function formTugas($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);

      $data = [
         'ctx'    => 'surat',
         'jenis'  => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title'  => 'Surat Tugas'
      ];

      return view('admin/create/create-tugas', $data);
   }

   public function saveTugas()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $tugas = $this->request->getVar('tugas');
      $mnb = $this->request->getVar('menimbang');
      $mng = $this->request->getVar('mengingat');
      $nosk = $this->request->getVar('nosk');
      $ttg = $this->request->getVar('tentang');
      $sln = $this->request->getVar('salinan');
      
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $tugas."#".$mnb."#".$mng."#".$nosk."#".$ttg."#".$sln;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);

      $kodeSt = $this->request->getVar('kode_suratst');
      $namaSt = $this->request->getVar('namast');
      $ketSt = $this->request->getVar('ketst');

      $result = $this->tugasModel->saveDataTugas(NULL, $kodeSt, $namaSt, $ketSt);

      $tugas = $this->tugasModel->getAllTugasByKode($kodeSurat);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'tugas'    => $tugas,
         'staff' => $staff,
         'desa' => $desa,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Cetak Surat Tugas'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Tugas berhasil',
            'error' => false
         ]);
          return view('admin/print/c_tugas', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/surat/create-tugas');
   }

   public function editTugas($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $tugas = $this->tugasModel->getAllTugasByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'tugas' => $tugas,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Surat Tugas'
      ];

      return view('admin/edit/edit-tugas', $data);
   }

   public function updateTugas()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $tugas = $this->request->getVar('tugas');
      $mnb = $this->request->getVar('menimbang');
      $mng = $this->request->getVar('mengingat');
      $nosk = $this->request->getVar('nosk');
      $ttg = $this->request->getVar('tentang');
      $sln = $this->request->getVar('salinan');
      
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $tugas."#".$mnb."#".$mng."#".$nosk."#".$ttg."#".$sln;
      
      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      
      $idSt= $this->request->getVar('idst');
      $delSt = $this->tugasModel->delete($idSt);
      $kodeSt = $this->request->getVar('kode_suratst');
      $namaSt = $this->request->getVar('namast');
      $ketSt = $this->request->getVar('ketst');

      $result = $this->tugasModel->saveDataTugas($idSt, $kodeSt, $namaSt, $ketSt);

      $tugas = $this->tugasModel->getAllTugasByKode($kodeSurat);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'tugas'    => $tugas,
         'staff' => $staff,
         'desa' => $desa,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Cetak Surat Tugas'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/c_tugas', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-tugas/' . $idSurat);
   }

   public function printTugas($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $tugas = $this->tugasModel->getAllTugasByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'tugas' => $tugas,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Cetak Surat Tugas',
      ];

      return view('admin/print/c_tugas', $data);

   }
public function printStugas($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $tugas = $this->tugasModel->getAllTugasByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'tugas' => $tugas,
         'ctx' => 'surat',
         'title' => 'Cetak Surat Tugas',
      ];

      return view('admin/print/c_stugas', $data). view('admin/print/topdf');

   }
   
   public function printSkst($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $tugas = $this->tugasModel->getAllTugasByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'tugas' => $tugas,
         'ctx' => 'surat',
         'title' => 'Cetak Surat Tugas',
      ];

      return view('admin/print/c_sktugas', $data). view('admin/print/topdf');

   }
   public function printLamsk($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $tugas = $this->tugasModel->getAllTugasByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'tugas' => $tugas,
         'ctx' => 'surat',
         'title' => 'Cetak Surat Tugas',
      ];

      return view('admin/print/c_lamsktugas', $data). view('admin/print/topdf');

   }
#END SURAT TUGAS

#START UMUMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
# 8 BEGIN SKU 
   public function formSku($kodeSurat)
   {
      $suratModel = new SuratModel();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Usaha'
      ];

      return view('admin/create/create-sku', $data);
   }

   public function saveSku()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $ju = $this->request->getVar('jenis_usaha');
      $sejak = $this->request->getVar('sejak');
      $lokasi = $this->request->getVar('lokasi');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$agama."#".$alamat."#".$ju."#".$sejak."#".$lokasi;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Usaha berhasil',
            'error' => false
         ]);
          return view('admin/print/sku', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sku');
   }

   public function editSku($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Usaha'
      ];

      return view('admin/edit/edit-sku', $data);
   }

   public function updateSku()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $ju = $this->request->getVar('jenis_usaha');
      $sejak = $this->request->getVar('sejak');
      $lokasi = $this->request->getVar('lokasi');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');

      $isiSurat = $nik."#".$nama."#".$jk."#".$agama."#".$alamat."#".$ju."#".$sejak."#".$lokasi;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sku', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sku/' . $idSurat);
   }
      public function printSku($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sku', $data). view('admin/print/topdf');

   }
#END SKU 

# 9 BEGIN SKTU
   public function formSktu($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Tempat Usaha'
      ];

      return view('admin/create/create-sktu', $data);
   }

   public function saveSktu()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $nu = $this->request->getVar('nama_usaha');
      $ju = $this->request->getVar('jenis_usaha');
      $sejak = $this->request->getVar('sejak');
      $pekerja = $this->request->getVar('pekerja');
      $izin = $this->request->getVar('izin');
      $lokasi = $this->request->getVar('lokasi');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$agama."#".$alamat."#".$nu."#".$ju."#".$sejak."#".$pekerja."#".$izin."#".$lokasi;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Tempat Usaha berhasil',
            'error' => false
         ]);
          return view('admin/print/sktu', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sktu');
   }

   public function editSktu($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Tempat Usaha',
      ];

      return view('admin/edit/edit-sktu', $data);
   }

   public function updateSktu()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $nu = $this->request->getVar('nama_usaha');
      $ju = $this->request->getVar('jenis_usaha');
      $sejak = $this->request->getVar('sejak');
      $pekerja = $this->request->getVar('pekerja');
      $izin = $this->request->getVar('izin');
      $lokasi = $this->request->getVar('lokasi');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');

      $isiSurat = $nik."#".$nama."#".$jk."#".$agama."#".$alamat."#".$nu."#".$ju."#".$sejak."#".$pekerja."#".$izin."#".$lokasi;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sktu', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sktu/' . $idSurat);
   }
   public function printSktu($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sktu', $data). view('admin/print/topdf');

   }
   #END SKTU

   #10 BEGIN SKBR
   public function formSkbr($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar Barang'
      ];

      return view('admin/create/create-skbr', $data);
   }

   public function saveSkbr()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $nb = $this->request->getVar('nama_barang');
      $jb = $this->request->getVar('jenis_barang');
      $jml = $this->request->getVar('jumlah');
      $asal = $this->request->getVar('asal');
      $tujuan = $this->request->getVar('tujuan');
      $plat = $this->request->getVar('plat');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$agama."#".$alamat."#".$nb."#".$jb."#".$jml."#".$asal."#".$tujuan."#".$plat;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Pengantar Barang berhasil',
            'error' => false
         ]);
          return view('admin/print/skbr', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skbr');
   }

   public function editSkbr($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar Barang',
      ];

      return view('admin/edit/edit-skbr', $data);
   }

   public function updateSkbr()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $nb = $this->request->getVar('nama_barang');
      $jb = $this->request->getVar('jenis_barang');
      $jml = $this->request->getVar('jumlah');
      $asal = $this->request->getVar('asal');
      $tujuan = $this->request->getVar('tujuan');
      $plat = $this->request->getVar('plat');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$agama."#".$alamat."#".$nb."#".$jb."#".$jml."#".$asal."#".$tujuan."#".$plat;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skbr', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skbr/' . $idSurat);
   }
      public function printSkbr($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skbr', $data). view('admin/print/topdf');

   }

   #END SKBR

#11 BEGIN SKT TERNAK
   public function formSkt($kodeSurat)
   {  
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar Ternak'
      ];

      return view('admin/create/create-skt', $data);
   }

   public function saveSkt()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $nt = $this->request->getVar('nama_ternak');
      $jt = $this->request->getVar('jenis_ternak');
      $ct = $this->request->getVar('ciri_ternak');
      $asal = $this->request->getVar('asal');
      $tujuan = $this->request->getVar('tujuan');
      $plat = $this->request->getVar('plat');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$agama."#".$alamat."#".$nt."#".$jt."#".$ct."#".$asal."#".$tujuan."#".$plat;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Pengantar Ternak berhasil',
            'error' => false
         ]);
          return view('admin/print/skt', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skt');
   }

   public function editSkt($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar Ternak',
      ];

      return view('admin/edit/edit-skt', $data);
   }

   public function updateSkt()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $nt = $this->request->getVar('nama_ternak');
      $jt = $this->request->getVar('jenis_ternak');
      $ct = $this->request->getVar('ciri_ternak');
      $asal = $this->request->getVar('asal');
      $tujuan = $this->request->getVar('tujuan');
      $plat = $this->request->getVar('plat');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$agama."#".$alamat."#".$nt."#".$jt."#".$ct."#".$asal."#".$tujuan."#".$plat;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skt', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skt/' . $idSurat);
   }
   public function printSkt($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skt', $data). view('admin/print/topdf');

   }
   #END SKTERNAK

   #12 BEGIN SKTM KETERANGAN TIDAK MAMPU
   public function formSktm($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Tidak Mampu'
      ];

      return view('admin/create/create-sktm', $data);
   }

   public function saveSktm()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$untuk;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Tidak Mampu berhasil',
            'error' => false
         ]);
          return view('admin/print/sktm', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sktm');
   }

   public function editSktm($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Tidak Mampu',
      ];

      return view('admin/edit/edit-sktm', $data);
   }

   public function updateSktm()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$untuk;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sktm', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sktm/' . $idSurat);
   }
      public function printSktm($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sktm', $data). view('admin/print/topdf');

   }

   #END SKM KETERANGAN TIDAK MAMPU
   #13 BEGIN SKKTM KETERANGAN KELURGA TIDAK MAMPU 
   public function formSkktm($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Keluarga Tidak Mampu'
      ];

      return view('admin/create/create-skktm', $data);
   }

   public function saveSkktm()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$untuk;

      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Keluarga Tidak Mampu berhasil',
            'error' => false
         ]);
          return view('admin/print/skktm', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skktm');
   }

   public function editSkktm($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Keluarga Tidak Mampu',
      ];

      return view('admin/edit/edit-skktm', $data);
   }

   public function updateSkktm()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');
      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$untuk;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skktm', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skktm/' . $idSurat);
   }

   public function printSkktm($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skktm', $data). view('admin/print/topdf');

   }

   #END SKM KETERANGAN TIDAK MAMPU

#14 BEGIN SKRTM KETERANGAN RUMAH TANGGA MISKIN
   public function formSkrtm($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Rumah Tangga Miskin'
      ];

      return view('admin/create/create-skrtm', $data);
   }

   public function saveSkrtm()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$untuk;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Rumah Tangga Miskin berhasil',
            'error' => false
         ]);
          return view('admin/print/skrtm', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skrtm');
   }

   public function editSkrtm($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Rumah Tangga Miskin',
      ];

      return view('admin/edit/edit-skrtm', $data);
   }

   public function updateSkrtm()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');
      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$untuk;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skrtm', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skrtm/' . $idSurat);
   }

   public function printSkrtm($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skrtm', $data). view('admin/print/topdf');

   }

   #END SKRTM KETERANGAN RUMAH TANGGA MISKIN

   #15 BEGIN SKPHS PENGHASILAN
   public function formSkphs($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Penghasilan'
      ];

      return view('admin/create/create-skphs', $data);
   }

   public function saveSkphs()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $phs = $this->request->getVar('penghasilan');
      $sumber = $this->request->getVar('sumber');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$phs."#".$sumber;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Penghasilan berhasil',
            'error' => false
         ]);
          return view('admin/print/skphs', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skphs');
   }

   public function editSkphs($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Penghasilan',
      ];

      return view('admin/edit/edit-skphs', $data);
   }

   public function updateSkphs()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $phs = $this->request->getVar('penghasilan');
      $sumber = $this->request->getVar('sumber');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$phs."#".$sumber;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skphs', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skphs/' . $idSurat);
   }

   public function printSkphs($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skphs', $data). view('admin/print/topdf');

   }

   #END SKPHS KETERANGAN PENGHASILAN

   #16 BEGIN SKORTU
   public function formSkortu($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Orang Tua'
      ];

      return view('admin/create/create-skortu', $data);
   }

   public function saveSkortu()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $nika = $this->request->getVar('nika');
      $namaa = $this->request->getVar('namaa');
      $jka = $this->request->getVar('jka');
      $tmpla = $this->request->getVar('tmpla');
      $tglla = $this->request->getVar('tglla');
      $agamaa = $this->request->getVar('agamaa');
      $alamata = $this->request->getVar('alamata');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$nika."#".$namaa."#".$jka."#".$tmpla."#".$tglla."#".$agamaa."#".$alamata;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Orang Tua berhasil',
            'error' => false
         ]);
          return view('admin/print/skortu', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skortu');
   }

   public function editSkortu($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Orang Tua',
      ];

      return view('admin/edit/edit-skortu', $data);
   }

   public function updateSkortu()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $nika = $this->request->getVar('nika');
      $namaa = $this->request->getVar('namaa');
      $jka = $this->request->getVar('jka');
      $tmpla = $this->request->getVar('tmpla');
      $tglla = $this->request->getVar('tglla');
      $agamaa = $this->request->getVar('agamaa');
      $alamata = $this->request->getVar('alamata');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$nika."#".$namaa."#".$jka."#".$tmpla."#".$tglla."#".$agamaa."#".$alamata;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skortu', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skortu/' . $idSurat);
   }

   public function printSkortu($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skortu', $data). view('admin/print/topdf');

   }

   #END SKORTU 

#17 BEGIN SKANAK
   public function formSkanak($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Anak'
      ];

      return view('admin/create/create-skanak', $data);
   }

   public function saveSkanak()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $nika = $this->request->getVar('nika');
      $namaa = $this->request->getVar('namaa');
      $jka = $this->request->getVar('jka');
      $tmpla = $this->request->getVar('tmpla');
      $tglla = $this->request->getVar('tglla');
      $agamaa = $this->request->getVar('agamaa');
      $alamata = $this->request->getVar('alamata');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$nika."#".$namaa."#".$jka."#".$tmpla."#".$tglla."#".$agamaa."#".$alamata;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Anak berhasil',
            'error' => false
         ]);
          return view('admin/print/skanak', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skanak');
   }

   public function editSkanak($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Anak'
      ];

      return view('admin/edit/edit-skanak', $data);
   }

   public function updateSkanak()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $nika = $this->request->getVar('nika');
      $namaa = $this->request->getVar('namaa');
      $jka = $this->request->getVar('jka');
      $tmpla = $this->request->getVar('tmpla');
      $tglla = $this->request->getVar('tglla');
      $agamaa = $this->request->getVar('agamaa');
      $alamata = $this->request->getVar('alamata');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$nika."#".$namaa."#".$jka."#".$tmpla."#".$tglla."#".$agamaa."#".$alamata;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skanak', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skanak/' . $idSurat);
   }

   public function printSkanak($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skanak', $data). view('admin/print/topdf');

   }

   #END SKANAK

#18 BEGIN KETERANGAN KEMATIAN
   public function formSkmati($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Kematian'
      ];

      return view('admin/create/create-skmati', $data);
   }

   public function saveSkmati()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $bin = $this->request->getVar('bin');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $sebab = $this->request->getVar('sebab');
      $hari = $this->request->getVar('hari');
      $tanggal = $this->request->getVar('tanggal');
      $waktu = $this->request->getVar('waktu');
      $tempat = $this->request->getVar('tempat');
      $shdk = $this->request->getVar('shdk');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$bin."#".$jk."#".$agama."#".$alamat."#".$niki."#".$namai."#".$jki."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$sebab."#".$hari."#".$tanggal."#".$waktu."#".$tempat."#".$shdk;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Kematian berhasil',
            'error' => false
         ]);
          return view('admin/print/skmati', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skmati');
   }

   public function editSkmati($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Kematian'
      ];

      return view('admin/edit/edit-skmati', $data);
   }

   public function updateSkmati()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $bin = $this->request->getVar('bin');
      $jk = $this->request->getVar('jk');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $sebab = $this->request->getVar('sebab');
      $hari = $this->request->getVar('hari');
      $tanggal = $this->request->getVar('tanggal');
      $waktu = $this->request->getVar('waktu');
      $tempat = $this->request->getVar('tempat');
      $shdk = $this->request->getVar('shdk');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$bin."#".$jk."#".$agama."#".$alamat."#".$niki."#".$namai."#".$jki."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$sebab."#".$hari."#".$tanggal."#".$waktu."#".$tempat."#".$shdk;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skmati', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skmati/' . $idSurat);
   }

   public function printSkmati($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skmati', $data). view('admin/print/topdf');

   }

   #END KEMATIAN

#19 BEGIN KETERANGAN BEPERGIAN
   public function formSkpergi($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Bepergian'
      ];

      return view('admin/create/create-skpergi', $data);
   }

   public function saveSkpergi()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $tujuan = $this->request->getVar('tujuan');
      $kegiatan = $this->request->getVar('kegiatan');
      $tanggal = $this->request->getVar('tanggal');
      $bawaan = $this->request->getVar('bawaan');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
     $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$tujuan."#".$kegiatan."#".$tanggal."#".$bawaan;

      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Bepergian berhasil',
            'error' => false
         ]);
          return view('admin/print/skpergi', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skpergi');
   }

   public function editSkpergi($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Bepergian'
      ];

      return view('admin/edit/edit-skpergi', $data);
   }

   public function updateSkpergi()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');

      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $tujuan = $this->request->getVar('tujuan');
      $kegiatan = $this->request->getVar('kegiatan');
      $tanggal = $this->request->getVar('tanggal');
      $bawaan = $this->request->getVar('bawaan');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$tujuan."#".$kegiatan."#".$tanggal."#".$bawaan;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skpergi', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skpergi/' . $idSurat);
   }

   public function printSkpergi($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skpergi', $data). view('admin/print/topdf');

   }

   #END BEPERGIAN

#20 BEGIN KETERANGAN AHLI WARIS
   public function formSkaw($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);

      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Ahli Waris'
      ];

      return view('admin/create/create-skaw', $data);
   }

   public function saveSkaw()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $tglm = $this->request->getVar('tglm');
      $tmpm = $this->request->getVar('tmpm');
      $klg = $this->request->getVar('keluarga');
      $jaw = $this->request->getVar('jaw');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$tglm."#".$tmpm."#".$klg."#".$jaw;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);

      $kodeSuratAw = $this->request->getVar('kode_surataw');
      $namaAw = $this->request->getVar('namaaw');
      $jkAw = $this->request->getVar('jkaw');
      $ttlAw = $this->request->getVar('ttlaw');
      $alamatAw = $this->request->getVar('alamataw');
      $agamaAw = $this->request->getVar('agamaaw');
      $shdk = $this->request->getVar('shdk');

      $result = $this->awModel->saveDataAw(NULL, $kodeSuratAw, $namaAw, $jkAw, $ttlAw, $alamatAw, $agamaAw, $shdk);

      $waris = $this->awModel->getAllAwByKode($kodeSurat);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'waris'    => $waris,
         'staff' => $staff,
         'desa' => $desa,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Ahli Waris'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Ahli Waris berhasil',
            'error' => false
         ]);
          return view('admin/print/c_ahliwaris', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/surat/create-skaw');
   }

   public function editSkaw($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $waris = $this->awModel->getAllAwByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'waris' => $waris,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Ahli Waris'
      ];

      return view('admin/edit/edit-ahliwaris', $data);
   }

   public function updateSkaw()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $tglm = $this->request->getVar('tglm');
      $tmpm = $this->request->getVar('tmpm');
      $klg = $this->request->getVar('keluarga');
      $jaw = $this->request->getVar('jaw');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$tglm."#".$tmpm."#".$klg."#".$jaw;
      
      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      
      $idAw= $this->request->getVar('idaw');
      $delAw = $this->awModel->delete($idAw);
      $kodeSuratAw = $this->request->getVar('kode_surataw');
      $namaAw = $this->request->getVar('namaaw');
      $jkAw = $this->request->getVar('jkaw');
      $ttlAw = $this->request->getVar('ttlaw');
      $alamatAw = $this->request->getVar('alamataw');
      $agamaAw = $this->request->getVar('agamaaw');
      $shdk = $this->request->getVar('shdk');

      $result = $this->awModel->updateDataAw($idAw, $kodeSuratAw, $namaAw, $jkAw, $ttlAw, $alamatAw, $agamaAw, $shdk);

      $waris = $this->awModel->getAllAwByKode($kodeSurat);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'waris'    => $waris,
         'staff' => $staff,
         'desa' => $desa,
         'title' => 'Keterangan Ahli Waris',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/c_ahliwaris', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skaw/' . $idSurat);
   }

   public function printAw($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $waris = $this->awModel->getAllAwByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'waris' => $waris,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Ahli Waris'
      ];

      return view('admin/print/c_ahliwaris', $data);

   }
      public function printSkaw($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $waris = $this->awModel->getAllAwByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'waris' => $waris
      ];

      return view('admin/print/skaw', $data). view('admin/print/topdf');

   }
public function printPaw($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $waris = $this->awModel->getAllAwByKode($kodeSurat);

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'waris' => $waris
      ];

      return view('admin/print/c_pernyataan-aw', $data). view('admin/print/topdf');

   }

   #END AHLI WARIS

#21 BEGIN SK DOMISILI LEMBAGA 
   public function formSklbg($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Domisili Lembaga'
      ];

      return view('admin/create/create-sklbg', $data);
   }

   public function saveSklbg()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $alamat = $this->request->getVar('alamat');
      $nl = $this->request->getVar('nama_lembaga');
      $bl = $this->request->getVar('bidang_lembaga');
      $sejak = $this->request->getVar('sejak');
      $lokasi = $this->request->getVar('lokasi');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$alamat."#".$nl."#".$bl."#".$sejak."#".$lokasi;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Domisili Lembaga berhasil',
            'error' => false
         ]);
          return view('admin/print/sklbg', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sklbg');
   }

   public function editSklbg($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Domisili Lembaga'
      ];

      return view('admin/edit/edit-sklbg', $data);
   }

   public function updateSklbg()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $alamat = $this->request->getVar('alamat');
      $nl = $this->request->getVar('nama_lembaga');
      $bl = $this->request->getVar('bidang_lembaga');
      $sejak = $this->request->getVar('sejak');
      $lokasi = $this->request->getVar('lokasi');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$alamat."#".$nl."#".$bl."#".$sejak."#".$lokasi;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sklbg', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sklbg/' . $idSurat);
   }
      public function printSklbg($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sklbg', $data). view('admin/print/topdf');

   }
#END SK DOMISILI LEMBAGA

#22 BEGIN SKKB SURAT KETERANGAN KELAKUAN BAIK
   public function formSkkb($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Kelakuan Baik'
      ];

      return view('admin/create/create-skkb', $data);
   }

   public function saveSkkb()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$untuk;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Kelakuan Baik berhasil',
            'error' => false
         ]);
          return view('admin/print/skkb', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skkb');
   }

   public function editSkkb($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Kelakuan Baik'
      ];

      return view('admin/edit/edit-skkb', $data);
   }

   public function updateSkkb()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$untuk;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skkb', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skkb/' . $idSurat);
   }

   public function printSkkb($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skkb', $data). view('admin/print/topdf');

   }

   #END SKKB KETERANGAN KELAKUAN BAIK

#23 BEGIN SKCK SURAT PENGANTAR SKCK
   public function formSkck($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar SKCK'
      ];

      return view('admin/create/create-skck', $data);
   }

   public function saveSkck()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');
      $untuk = $this->request->getVar('untuk');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
     $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$kerjaan."#".$alamat."#".$untuk."#".$ke."#".$di;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Pengantar SKCK berhasil',
            'error' => false
         ]);
          return view('admin/print/skck', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-skck');
   }

   public function editSkck($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar SKCK'
      ];

      return view('admin/edit/edit-skck', $data);
   }

   public function updateSkck()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');
      $untuk = $this->request->getVar('untuk');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$kerjaan."#".$alamat."#".$untuk."#".$ke."#".$di;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/skck', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-skck/' . $idSurat);
   }

   public function printSkck($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/skck', $data). view('admin/print/topdf');

   }

   #END SKKB KETERANGAN KELAKUAN BAIK

#24 BEGIN SIMB IZIN MENDIRIKAN BANGUNAN
   public function formSimb($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Permohonan Izin Mendirikan Bangunan'
      ];

      return view('admin/create/create-simb', $data);
   }

   public function saveSimb()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');
      $jb = $this->request->getVar('jenis_bangunan');
      $fb = $this->request->getVar('fungsi_bangunan');
      $jl = $this->request->getVar('jumlah_lantai');
      $ub = $this->request->getVar('ukuran_bangunan');
      $lb = $this->request->getVar('lokasi_bangunan');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
     $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$kerjaan."#".$alamat."#".$jb."#".$fb."#".$jl."#".$ub."#".$lb."#".$ke."#".$di;

      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Permohonan Izin Mendirikan Bangunan berhasil',
            'error' => false
         ]);
          return view('admin/print/simb', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-simb');
   }

   public function editSimb($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Permohonan Izin Mendirikan Bangunan'
      ];

      return view('admin/edit/edit-simb', $data);
   }

   public function updateSimb()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');
      $jb = $this->request->getVar('jenis_bangunan');
      $fb = $this->request->getVar('fungsi_bangunan');
      $jl = $this->request->getVar('jumlah_lantai');
      $ub = $this->request->getVar('ukuran_bangunan');
      $lb = $this->request->getVar('lokasi_bangunan');
      $ke = $this->request->getVar('ke');
      $di = $this->request->getVar('di');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$kerjaan."#".$alamat."#".$jb."#".$fb."#".$jl."#".$ub."#".$lb."#".$ke."#".$di;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/simb', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-simb/' . $idSurat);
   }

   public function printSimb($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/simb', $data). view('admin/print/topdf');

   }

   #END SIMB IZIN MENDIRIKAN BANGUNAN

#25 BEGIN SIG IZIN GANGGUAN
   public function formSig($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Izin Gangguan'
      ];

      return view('admin/create/create-sig', $data);
   }

   public function saveSig()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');
      $nu = $this->request->getVar('nama_usaha');
      $lu = $this->request->getVar('lokasi_usaha');
      $ttg = $this->request->getVar('tetangga');
      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
     $isiSurat = $nik."#".$nama."#".$jk."#".$kerjaan."#".$alamat."#".$nu."#".$lu."#".$ttg."#".$untuk;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Izin Gangguan berhasil',
            'error' => false
         ]);
          return view('admin/print/sig', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sig');
   }

   public function editSig($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Izin Gangguan',
      ];

      return view('admin/edit/edit-sig', $data);
   }

   public function updateSig()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');
      $nu = $this->request->getVar('nama_usaha');
      $lu = $this->request->getVar('lokasi_usaha');
      $ttg = $this->request->getVar('tetangga');
      $untuk = $this->request->getVar('untuk');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
     $isiSurat = $nik."#".$nama."#".$jk."#".$kerjaan."#".$alamat."#".$nu."#".$lu."#".$ttg."#".$untuk;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sig', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sig/' . $idSurat);
   }

   public function printSig($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sig', $data). view('admin/print/topdf');

   }

   #END SIG SURAT IZIN GANGGUAN

#26 BEGIN SK BEDA IDENTITAS
   public function formBedaid($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Perbedaan Identitas'
      ];

      return view('admin/create/create-bedaid', $data);
   }

   public function saveBedaid()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $id1 = $this->request->getVar('id1');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $id2 = $this->request->getVar('id2');
      $nik2 = $this->request->getVar('nik2');
      $nama2 = $this->request->getVar('nama2');
      $jk2 = $this->request->getVar('jk2');
      $tmpl2 = $this->request->getVar('tmpl2');
      $tgll2 = $this->request->getVar('tgll2');
      $agama2 = $this->request->getVar('agama2');
      $alamat2 = $this->request->getVar('alamat2');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$id1."#".$nik2."#".$nama2."#".$jk2."#".$tmpl2."#".$tgll2."#".$agama2."#".$alamat2."#".$id2;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Perbedaan Identitas berhasil',
            'error' => false
         ]);
          return view('admin/print/bedaid', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-bedaid');
   }

   public function editBedaid($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Tidak Perbedaan Identitas'
      ];

      return view('admin/edit/edit-bedaid', $data);
   }

   public function updateBedaid()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $id1 = $this->request->getVar('id1');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      
      $id2 = $this->request->getVar('id2');
      $nik2 = $this->request->getVar('nik2');
      $nama2 = $this->request->getVar('nama2');
      $jk2 = $this->request->getVar('jk2');
      $tmpl2 = $this->request->getVar('tmpl2');
      $tgll2 = $this->request->getVar('tgll2');
      $agama2 = $this->request->getVar('agama2');
      $alamat2 = $this->request->getVar('alamat2');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$id1."#".$nik2."#".$nama2."#".$jk2."#".$tmpl2."#".$tgll2."#".$agama2."#".$alamat2."#".$id2;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/bedaid', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-bedaid/' . $idSurat);
   }
      public function printBedaid($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/bedaid', $data). view('admin/print/topdf');

   }

   #END SK BEDA IDENTITAS

#27 BEGIN SK DOMISILI
   public function formDomisili($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Domisili'
      ];

      return view('admin/create/create-domisili', $data);
   }

   public function saveDomisili()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $sejak = $this->request->getVar('sejak');
      $untuk = $this->request->getVar('untuk');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$sejak."#".$untuk;

      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Domisili berhasil',
            'error' => false
         ]);
          return view('admin/print/domisili', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-domisili');
   }

   public function editDomisili($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Domisili'
      ];

      return view('admin/edit/edit-domisili', $data);
   }

   public function updateDomisili()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $sejak = $this->request->getVar('sejak');
      $untuk = $this->request->getVar('untuk');
      
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$sejak."#".$untuk;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/domisili', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-domisili/' . $idSurat);
   }
      public function printDomisili($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/domisili', $data). view('admin/print/topdf');

   }

   #END SK DOMISILI

#28 BEGIN SK PINDAH
   public function formPindah($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar Pindah'
      ];

      return view('admin/create/create-pindah', $data);
   }

   public function savePindah()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nkk = $this->request->getVar('nkk');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $tujuan = $this->request->getVar('tujuan');
      $kel = $this->request->getVar('keluarga');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nkk."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$tujuan."#".$kel;

      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Pengantar Pindah berhasil',
            'error' => false
         ]);
          return view('admin/print/pindah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-pindah');
   }

   public function editPindah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar Pindah'
      ];

      return view('admin/edit/edit-pindah', $data);
   }

   public function updatePindah()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nkk = $this->request->getVar('nkk');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $tujuan = $this->request->getVar('tujuan');
      $kel = $this->request->getVar('keluarga');
      
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nkk."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$tujuan."#".$kel;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/pindah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-pindah/' . $idSurat);
   }
      public function printPindah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/pindah', $data). view('admin/print/topdf');

   }

   #END SK PINDAH

#29 BEGIN KETERANGAN KELAHIRAN
   public function formKelahiran($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Kelahiran'
      ];

      return view('admin/create/create-kelahiran', $data);
   }

   public function saveKelahiran()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $nika = $this->request->getVar('nika');
      $namaa = $this->request->getVar('namaa');
      $jka = $this->request->getVar('jka');
      $tmpla = $this->request->getVar('tmpla');
      $tglla = $this->request->getVar('tglla');
      $agamaa = $this->request->getVar('agamaa');
      $alamata = $this->request->getVar('alamata');
      $anakke = $this->request->getVar('anakke');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$nika."#".$namaa."#".$jka."#".$tmpla."#".$tglla."#".$agamaa."#".$alamata."#".$anakke;

      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Kelahiran berhasil',
            'error' => false
         ]);
          return view('admin/print/kelahiran', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-kelahiran');
   }

   public function editKelahiran($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Kelahiran'
      ];

      return view('admin/edit/edit-kelahiran', $data);
   }

   public function updateKelahiran()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $nika = $this->request->getVar('nika');
      $namaa = $this->request->getVar('namaa');
      $jka = $this->request->getVar('jka');
      $tmpla = $this->request->getVar('tmpla');
      $tglla = $this->request->getVar('tglla');
      $agamaa = $this->request->getVar('agamaa');
      $alamata = $this->request->getVar('alamata');
      $anakke = $this->request->getVar('anakke');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$nika."#".$namaa."#".$jka."#".$tmpla."#".$tglla."#".$agamaa."#".$alamata."#".$anakke;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/kelahiran', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-kelahiran/' . $idSurat);
   }

   public function printKelahiran($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/kelahiran', $data). view('admin/print/topdf');

   }

   #END KETERANGAN KELAHIRAN

   #30 BEGIN SK PEMAKAMAN
   public function formPemakaman($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Pemakaman'
      ];

      return view('admin/create/create-pemakaman', $data);
   }

   public function savePemakaman()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $tglm = $this->request->getVar('tglm');
      $makam = $this->request->getVar('makam');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$tglm."#".$makam;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Pemakaman berhasil',
            'error' => false
         ]);
          return view('admin/print/pemakaman', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-pemakaman');
   }

   public function editPemakaman($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar Pemakaman'
      ];

      return view('admin/edit/edit-pemakaman', $data);
   }

   public function updatePemakaman()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $tglm = $this->request->getVar('tglm');
      $makam = $this->request->getVar('makam');
      
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$tglm."#".$makam;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/pemakaman', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-pemakaman/' . $idSurat);
   }
      public function printPemakaman($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/pemakaman', $data). view('admin/print/topdf');

   }

   #END SK PEMAKAMAN

   #31 BEGIN SK F121
   public function formF121($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar KTP'
      ];

      return view('admin/create/create-f121', $data);
   }

   public function saveF121()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nkk = $this->request->getVar('nkk');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $rt = $this->request->getVar('rt');
      $rw = $this->request->getVar('rw');
      $jp = $this->request->getVar('jp');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nkk."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$rt."#".$rw."#".$jp;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Pengantar KTP berhasil',
            'error' => false
         ]);
          return view('admin/print/f121', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-f121');
   }

   public function editF121($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pengantar KTP'
      ];

      return view('admin/edit/edit-f121', $data);
   }

   public function updateF121()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nkk = $this->request->getVar('nkk');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');
      $rt = $this->request->getVar('rt');
      $rw = $this->request->getVar('rw');
      $jp = $this->request->getVar('jp');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nkk."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$rt."#".$rw."#".$jp;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/f121', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-f121/' . $idSurat);
   }
      public function printF121($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/f121', $data). view('admin/print/topdf');

   }

   #END SK F121

#32 BEGIN Na
   public function formNa($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'NA'
      ];

      return view('admin/create/create-na', $data);
   }

   public function saveNa()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nikcs = $this->request->getVar('nikcs');
      $namacs = $this->request->getVar('namacs');
      $bincs = $this->request->getVar('bincs');
      $jkcs = $this->request->getVar('jkcs');
      $tmplcs = $this->request->getVar('tmplcs');
      $tgllcs = $this->request->getVar('tgllcs');
      $kwngcs = $this->request->getVar('kwngcs');
      $agamacs = $this->request->getVar('agamacs');
      $statuscs = $this->request->getVar('statuscs');
      $kerjaancs = $this->request->getVar('kerjaancs');
      $alamatcs = $this->request->getVar('alamatcs');
      $statusnacs = $this->request->getVar('statusnacs');

      $nikci = $this->request->getVar('nikci');
      $namaci = $this->request->getVar('namaci');
      $bintici = $this->request->getVar('bintici');
      $jkci = $this->request->getVar('jkci');
      $tmplci = $this->request->getVar('tmplci');
      $tgllci = $this->request->getVar('tgllci');
      $kwngci = $this->request->getVar('kwngci');
      $agamaci = $this->request->getVar('agamaci');
      $statusci = $this->request->getVar('statusci');
      $kerjaanci = $this->request->getVar('kerjaanci');
      $alamatci = $this->request->getVar('alamatci');
      $statusnaci = $this->request->getVar('statusnaci');

      $nika = $this->request->getVar('nika');
      $namaa = $this->request->getVar('namaa');
      $bina = $this->request->getVar('bina');
      $jka = $this->request->getVar('jka');
      $tmpla = $this->request->getVar('tmpla');
      $tglla = $this->request->getVar('tglla');
      $kwnga = $this->request->getVar('kwnga');
      $agamaa = $this->request->getVar('agamaa');
      $kerjaana = $this->request->getVar('kerjaana');
      $alamata = $this->request->getVar('alamata');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $bintii = $this->request->getVar('bintii');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $kwngi = $this->request->getVar('kwngi');
      $agamai = $this->request->getVar('agamai');
      $kerjaani = $this->request->getVar('kerjaani');
      $alamati = $this->request->getVar('alamati');
       $hari = $this->request->getVar('hari');
        $tgl = $this->request->getVar('tgl');
         $waktu = $this->request->getVar('waktu');
         $tmpakad = $this->request->getVar('tmpakad');
          $maskawin = $this->request->getVar('maskawin');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nikcs."#".$namacs."#".$bincs."#".$jkcs."#".$tmplcs."#".$tgllcs."#".$kwngcs."#".$agamacs."#".$statuscs."#".$kerjaancs."#".$alamatcs."#".$statusnacs."#".$nikci."#".$namaci."#".$bintici."#".$jkci."#".$tmplci."#".$tgllci."#".$kwngci."#".$agamaci."#".$statusci."#".$kerjaanci."#".$alamatci."#".$statusnaci."#".$nika."#".$namaa."#".$bina."#".$jka."#".$tmpla."#".$tglla."#".$kwnga."#".$agamaa."#".$kerjaana."#".$alamata."#".$niki."#".$namai."#".$bintii."#".$jki."#".$tmpli."#".$tglli."#".$kwngi."#".$agamai."#".$kerjaani."#".$alamati."#".$hari."#".$tgl."#".$waktu."#".$tmpakad."#".$maskawin;

      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input NA berhasil',
            'error' => false
         ]);
          return view('admin/print/c_na', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-na');
   }

   public function editNa($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'NA'
      ];

      return view('admin/edit/edit-na', $data);
   }

   public function updateNa()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nikcs = $this->request->getVar('nikcs');
      $namacs = $this->request->getVar('namacs');
      $bincs = $this->request->getVar('bincs');
      $jkcs = $this->request->getVar('jkcs');
      $tmplcs = $this->request->getVar('tmplcs');
      $tgllcs = $this->request->getVar('tgllcs');
      $kwngcs = $this->request->getVar('kwngcs');
      $agamacs = $this->request->getVar('agamacs');
      $statuscs = $this->request->getVar('statuscs');
      $kerjaancs = $this->request->getVar('kerjaancs');
      $alamatcs = $this->request->getVar('alamatcs');
      $statusnacs = $this->request->getVar('statusnacs');

      $nikci = $this->request->getVar('nikci');
      $namaci = $this->request->getVar('namaci');
      $bintici = $this->request->getVar('bintici');
      $jkci = $this->request->getVar('jkci');
      $tmplci = $this->request->getVar('tmplci');
      $tgllci = $this->request->getVar('tgllci');
      $kwngci = $this->request->getVar('kwngci');
      $agamaci = $this->request->getVar('agamaci');
      $statusci = $this->request->getVar('statusci');
      $kerjaanci = $this->request->getVar('kerjaanci');
      $alamatci = $this->request->getVar('alamatci');
      $statusnaci = $this->request->getVar('statusnaci');

      $nika = $this->request->getVar('nika');
      $namaa = $this->request->getVar('namaa');
      $bina = $this->request->getVar('bina');
      $jka = $this->request->getVar('jka');
      $tmpla = $this->request->getVar('tmpla');
      $tglla = $this->request->getVar('tglla');
      $kwnga = $this->request->getVar('kwnga');
      $agamaa = $this->request->getVar('agamaa');
      $kerjaana = $this->request->getVar('kerjaana');
      $alamata = $this->request->getVar('alamata');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $bintii = $this->request->getVar('bintii');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $kwngi = $this->request->getVar('kwngi');
      $agamai = $this->request->getVar('agamai');
      $kerjaani = $this->request->getVar('kerjaani');
      $alamati = $this->request->getVar('alamati');
      $hari = $this->request->getVar('hari');
        $tgl = $this->request->getVar('tgl');
         $waktu = $this->request->getVar('waktu');
         $tmpakad = $this->request->getVar('tmpakad');
          $maskawin = $this->request->getVar('maskawin');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nikcs."#".$namacs."#".$bincs."#".$jkcs."#".$tmplcs."#".$tgllcs."#".$kwngcs."#".$agamacs."#".$statuscs."#".$kerjaancs."#".$alamatcs."#".$statusnacs."#".$nikci."#".$namaci."#".$bintici."#".$jkci."#".$tmplci."#".$tgllci."#".$kwngci."#".$agamaci."#".$statusci."#".$kerjaanci."#".$alamatci."#".$statusnaci."#".$nika."#".$namaa."#".$bina."#".$jka."#".$tmpla."#".$tglla."#".$kwnga."#".$agamaa."#".$kerjaana."#".$alamata."#".$niki."#".$namai."#".$bintii."#".$jki."#".$tmpli."#".$tglli."#".$kwngi."#".$agamai."#".$kerjaani."#".$alamati."#".$hari."#".$tgl."#".$waktu."#".$tmpakad."#".$maskawin;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Cetak NA'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/c_na', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-na/' . $idSurat);
   }

   public function printNa($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Cetak NA'
      ];

      return view('admin/print/c_na', $data);

   }
public function printN1($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'title' => 'Cetak NA'
      ];

      return view('admin/print/c_n1', $data) . view('admin/print/topdf');

   }
public function printN2($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $kua = $this->kuaModel->getKua();
      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'kua' => $kua,
         'title' => 'Cetak NA'
      ];

      return view('admin/print/c_n2', $data) . view('admin/print/topdf');

   }
   public function printN3($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $kua = $this->kuaModel->getKua();
      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'kua' => $kua,
         'title' => 'Cetak NA'
      ];

      return view('admin/print/c_n3', $data) . view('admin/print/topdf');

   }
   public function printN4($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $kua = $this->kuaModel->getKua();
      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'kua' => $kua,
         'title' => 'Cetak NA'
      ];

      return view('admin/print/c_n4', $data) . view('admin/print/topdf');

   }
   public function printN5($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();
      $kua = $this->kuaModel->getKua();
      $data = [
         'surat' => $surat,
         'desa' => $desa,
         'kua' => $kua,
         'title' => 'Cetak NA'
      ];

      return view('admin/print/c_n5', $data) . view('admin/print/topdf');

   }
   #END N1-N5

#33 BEGIN SK MENIKAH
   public function formSknh($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Menikah'
      ];

      return view('admin/create/create-sknh', $data);
   }

   public function saveSknh()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $tgl = $this->request->getVar('tgl');
      $secara = $this->request->getVar('secara');
      $mahar = $this->request->getVar('mahar');
      $saksi1 = $this->request->getVar('saksi1');
      $saksi2 = $this->request->getVar('saksi2');
      $alasan = $this->request->getVar('alasan');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$tgl."#".$secara."#".$mahar."#".$saksi1."#".$saksi2."#".$alasan;

      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Menikah berhasil',
            'error' => false
         ]);
          return view('admin/print/sknh', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sknh');
   }

   public function editSknh($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Menikah'
      ];

      return view('admin/edit/edit-sknh', $data);
   }

   public function updateSknh()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $tgl = $this->request->getVar('tgl');
      $secara = $this->request->getVar('secara');
      $mahar = $this->request->getVar('mahar');
      $saksi1 = $this->request->getVar('saksi1');
      $saksi2 = $this->request->getVar('saksi2');
      $alasan = $this->request->getVar('alasan');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$tgl."#".$secara."#".$mahar."#".$saksi1."#".$saksi2."#".$alasan;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sknh', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sknh/' . $idSurat);
   }
      public function printSknh($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sknh', $data). view('admin/print/topdf');

   }

   #END SK MENIKAH
#34 BEGIN SK PERNAH MENIKAH
   public function formPnikah($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Pernah Menikah'
      ];

      return view('admin/create/create-pnikah', $data);
   }

   public function savePnikah()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $kwngi = $this->request->getVar('kwngi');
      $agamai = $this->request->getVar('agamai');
      $kerjaani = $this->request->getVar('kerjaani');
      $alamati = $this->request->getVar('alamati');

      $tgl = $this->request->getVar('tgl');
      $secara = $this->request->getVar('secara');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$kwngi."#".$agamai."#".$kerjaani."#".$alamati."#".$tgl."#".$secara;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Pernah Menikah berhasil',
            'error' => false
         ]);
          return view('admin/print/pnikah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-pnikah');
   }

   public function editPnikah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Pernah Menikah'
      ];

      return view('admin/edit/edit-pnikah', $data);
   }

   public function updatePnikah()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $kwngi = $this->request->getVar('kwngi');
      $agamai = $this->request->getVar('agamai');
      $kerjaani = $this->request->getVar('kerjaani');
      $alamati = $this->request->getVar('alamati');

      $tgl = $this->request->getVar('tgl');
      $secara = $this->request->getVar('secara');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$kwngi."#".$agamai."#".$kerjaani."#".$alamati."#".$tgl."#".$secara;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/pnikah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-pnikah/' . $idSurat);
   }
      public function printPnikah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/pnikah', $data). view('admin/print/topdf');

   }

   #END SK PERNAH MENIKAH

#35 BEGIN SK BELUM MENIKAH
   public function formBnikah($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Belum Menikah'
      ];

      return view('admin/create/create-bnikah', $data);
   }

   public function saveBnikah()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Belum Menikah berhasil',
            'error' => false
         ]);
          return view('admin/print/bnikah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-bnikah');
   }

   public function editBnikah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Belum Menikah'
      ];

      return view('admin/edit/edit-bnikah', $data);
   }

   public function updateBnikah()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/bnikah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-bnikah/' . $idSurat);
   }
      public function printBnikah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/bnikah', $data). view('admin/print/topdf');

   }

   #END SK BELUM MENIKAH

#36 BEGIN SK DUDA JANDA
   public function formDj($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Duda / janda'
      ];

      return view('admin/create/create-dj', $data);
   }

   public function saveDj()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Duda / Janda berhasil',
            'error' => false
         ]);
          return view('admin/print/dj', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-dj');
   }

   public function editDj($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Duda / Janda'
      ];

      return view('admin/edit/edit-dj', $data);
   }

   public function updateDj()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/dj', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-dj/' . $idSurat);
   }
      public function printDj($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/dj', $data). view('admin/print/topdf');

   }

   #END SK DUDA JANDA 
   
   #37 BEGIN N6
   public function formN6($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Kematian Suami/Istri (N6)'
      ];

      return view('admin/create/create-n6', $data);
   }

   public function saveN6()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $bin = $this->request->getVar('bin');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $bini = $this->request->getVar('bini');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $kwngi = $this->request->getVar('kwngi');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $tanggal = $this->request->getVar('tanggal');
      $tempat = $this->request->getVar('tempat');
      $shdk = $this->request->getVar('shdk');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$bin."#".$jk."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$alamat."#".$niki."#".$namai."#".$bini."#".$jki."#".$tmpli."#".$tglli."#".$kwngi."#".$agamai."#".$alamati."#".$tanggal."#".$tempat."#".$shdk;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Kematian Suami/Istri (N6) berhasil',
            'error' => false
         ]);
          return view('admin/print/n6', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-n6');
   }

   public function editN6($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Kematian Suami/Istri (N6)'
      ];

      return view('admin/edit/edit-n6', $data);
   }

   public function updateN6()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);
      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $bin = $this->request->getVar('bin');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $bini = $this->request->getVar('bini');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $kwngi = $this->request->getVar('kwngi');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $tanggal = $this->request->getVar('tanggal');
      $tempat = $this->request->getVar('tempat');
      $shdk = $this->request->getVar('shdk');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$bin."#".$jk."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$alamat."#".$niki."#".$namai."#".$bini."#".$jki."#".$tmpli."#".$tglli."#".$kwngi."#".$agamai."#".$alamati."#".$tanggal."#".$tempat."#".$shdk;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/n6', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-n6/' . $idSurat);
   }

   public function printN6($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/n6', $data). view('admin/print/topdf');

   }

   #END N6 

#38 BEGIN CERAI
   public function formCerai($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Cerai'
      ];

      return view('admin/create/create-cerai', $data);
   }

   public function saveCerai()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $tglc = $this->request->getVar('tglcerai');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$tglc;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Cerai berhasil',
            'error' => false
         ]);
          return view('admin/print/cerai', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-cerai');
   }

   public function editCerai($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Cerai'
      ];

      return view('admin/edit/edit-cerai', $data);
   }

   public function updateCerai()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $agamai = $this->request->getVar('agamai');
      $alamati = $this->request->getVar('alamati');

      $tglc = $this->request->getVar('tglcerai');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$agama."#".$alamat."#".$niki."#".$namai."#".$tmpli."#".$tglli."#".$agamai."#".$alamati."#".$tglc;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/cerai', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-cerai/' . $idSurat);
   }

   public function printCerai($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/cerai', $data). view('admin/print/topdf');

   }

   #END CERAI


 #39 BEGIN SK STATUS PERKAWINAN
   public function formPstatus($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pernyataan Status Perkawinan'
      ];

      return view('admin/create/create-pstatus', $data);
   }

   public function savePstatus()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Pernyataan Status Perkawinan berhasil',
            'error' => false
         ]);
          return view('admin/print/pstatus', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-pstatus');
   }

   public function editPstatus($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pernyataan Status Perkawinan'
      ];

      return view('admin/edit/edit-pstatus', $data);
   }

   public function updatePstatus()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/pstatus', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-pstatus/' . $idSurat);
   }
      public function printPstatus($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/pstatus', $data). view('admin/print/topdf');

   }

   #END SK STATUS PERKAWINAN 

#40 BEGIN SK TANAH
   public function formSktanah($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Tanah'
      ];

      return view('admin/create/create-sktanah', $data);
   }

   public function saveSktanah()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $luas = $this->request->getVar('luas');
      $asal = $this->request->getVar('asal');
      $letak = $this->request->getVar('letak');
      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat."#".$luas."#".$asal."#".$letak."#".$b."#".$u."#".$t."#".$s;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan Tanah berhasil',
            'error' => false
         ]);
          return view('admin/print/sktanah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sktanah');
   }

   public function editSktanah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Tanah'
      ];

      return view('admin/edit/edit-sktanah', $data);
   }

   public function updateSktanah()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $luas = $this->request->getVar('luas');
      $asal = $this->request->getVar('asal');
      $letak = $this->request->getVar('letak');
      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat."#".$luas."#".$asal."#".$letak."#".$b."#".$u."#".$t."#".$s;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sktanah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sktanah/' . $idSurat);
   }
      public function printSktanah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sktanah', $data). view('admin/print/topdf');

   }

   #END SK TANAH

#41 BEGIN SPORADIK
   public function formSporadik($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Sporadik'
      ];

      return view('admin/create/create-sporadik', $data);
   }

   public function saveSporadik()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $luas = $this->request->getVar('luas');
      $letak = $this->request->getVar('letak');
      $rtrw = $this->request->getVar('rtrw');
      $desa = $this->request->getVar('desa');
      $kota = $this->request->getVar('kota');
      $nib = $this->request->getVar('nib');
      $statust = $this->request->getVar('statust');
      $untuk = $this->request->getVar('untuk');
      $asal = $this->request->getVar('asal');
      $sejak = $this->request->getVar('sejak');

      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $ns1 = $this->request->getVar('namasaksi1');
      $us1 = $this->request->getVar('umursaksi1');
      $ks1 = $this->request->getVar('kerjaansaksi1');
      $as1 = $this->request->getVar('alamatsaksi1');
      $ns2 = $this->request->getVar('namasaksi2');
      $us2 = $this->request->getVar('umursaksi2');
      $ks2 = $this->request->getVar('kerjaansaksi2');
      $as2 = $this->request->getVar('alamatsaksi2');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');

      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat."#".$luas."#".$letak."#".$rtrw."#".$desa."#".$kota."#".$nib."#".$statust."#".$untuk."#".$asal."#".$sejak."#".$b."#".$u."#".$t."#".$s."#".$ns1."#".$us1."#".$ks1."#".$as1."#".$ns2."#".$us2."#".$ks2."#".$as2;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Sporadik berhasil',
            'error' => false
         ]);
          return view('admin/print/sporadik', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sporadik');
   }

   public function editSporadik($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Sporadik'
      ];

      return view('admin/edit/edit-sporadik', $data);
   }

   public function updateSporadik()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');

      $luas = $this->request->getVar('luas');
      $letak = $this->request->getVar('letak');
      $rtrw = $this->request->getVar('rtrw');
      $desa = $this->request->getVar('desa');
      $kota = $this->request->getVar('kota');
      $nib = $this->request->getVar('nib');
      $statust = $this->request->getVar('statust');
      $untuk = $this->request->getVar('untuk');
      $asal = $this->request->getVar('asal');
      $sejak = $this->request->getVar('sejak');

      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $ns1 = $this->request->getVar('namasaksi1');
      $us1 = $this->request->getVar('umursaksi1');
      $ks1 = $this->request->getVar('kerjaansaksi1');
      $as1 = $this->request->getVar('alamatsaksi1');
      $ns2 = $this->request->getVar('namasaksi2');
      $us2 = $this->request->getVar('umursaksi2');
      $ks2 = $this->request->getVar('kerjaansaksi2');
      $as2 = $this->request->getVar('alamatsaksi2');
      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');

      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$kwng."#".$agama."#".$kerjaan."#".$alamat."#".$luas."#".$letak."#".$rtrw."#".$desa."#".$kota."#".$nib."#".$statust."#".$untuk."#".$asal."#".$sejak."#".$b."#".$u."#".$t."#".$s."#".$ns1."#".$us1."#".$ks1."#".$as1."#".$ns2."#".$us2."#".$ks2."#".$as2;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sporadik', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sporadik/' . $idSurat);
   }
      public function printSporadik($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sporadik', $data). view('admin/print/topdf');

   }
 # END SPORADIK

#42 BEGIN PERNYATAAN SEWA TANAH
   public function formSewatanah($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pernyataan Sewa Tanah'
      ];

      return view('admin/create/create-sewatanah', $data);
   }

   public function saveSewatanah()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $alamati = $this->request->getVar('alamati');

      $luas = $this->request->getVar('luas');
      $letak = $this->request->getVar('letak');
      $masa = $this->request->getVar('masa');
      $nilai = $this->request->getVar('nilai');

      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $saksi1 = $this->request->getVar('saksi1');
      $saksi2 = $this->request->getVar('saksi2');;

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$alamat."#".$niki."#".$namai."#".$jki."#".$tmpli."#".$tglli."#".$alamati."#".$luas."#".$letak."#".$masa."#".$nilai."#".$b."#".$u."#".$t."#".$s."#".$saksi1."#".$saksi2;

      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Pernyatan Sewa Tanah berhasil',
            'error' => false
         ]);
          return view('admin/print/sewatanah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sewatanah');
   }

   public function editSewatanah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pernyataan Sewa Tanah'
      ];

      return view('admin/edit/edit-sewatanah', $data);
   }

   public function updateSewatanah()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $alamati = $this->request->getVar('alamati');

      $luas = $this->request->getVar('luas');
      $letak = $this->request->getVar('letak');
      $masa = $this->request->getVar('masa');
      $nilai = $this->request->getVar('nilai');

      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $saksi1 = $this->request->getVar('saksi1');
      $saksi2 = $this->request->getVar('saksi2');;

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$alamat."#".$niki."#".$namai."#".$jki."#".$tmpli."#".$tglli."#".$alamati."#".$luas."#".$letak."#".$masa."#".$nilai."#".$b."#".$u."#".$t."#".$s."#".$saksi1."#".$saksi2;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sewatanah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sewatanah/' . $idSurat);
   }
      public function printSewatanah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sewatanah', $data). view('admin/print/topdf');

   }

   #END PERNYATAAN SEWA TANAH

#43 BEGIN PERNYATAAN JUAL BELI TANAH
   public function formJualbelitanah($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pernyataan Jual Beli Tanah'
      ];

      return view('admin/create/create-jualbelitanah', $data);
   }

   public function saveJualbelitanah()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $alamati = $this->request->getVar('alamati');

      $luas = $this->request->getVar('luas');
      $letak = $this->request->getVar('letak');
      $nilai = $this->request->getVar('nilai');

      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $saksi1 = $this->request->getVar('saksi1');
      $saksi2 = $this->request->getVar('saksi2');;

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$alamat."#".$niki."#".$namai."#".$jki."#".$tmpli."#".$tglli."#".$alamati."#".$luas."#".$letak."#".$nilai."#".$b."#".$u."#".$t."#".$s."#".$saksi1."#".$saksi2;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Pernyataan Jual Beli Tanah berhasil',
            'error' => false
         ]);
          return view('admin/print/jualbelitanah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-jualbelitanah');
   }

   public function editJualbelitanah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pernyataan Jual Beli Tanah'
      ];

      return view('admin/edit/edit-jualbelitanah', $data);
   }

   public function updateJualbelitanah()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $alamati = $this->request->getVar('alamati');

      $luas = $this->request->getVar('luas');
      $letak = $this->request->getVar('letak');
      $nilai = $this->request->getVar('nilai');

      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $saksi1 = $this->request->getVar('saksi1');
      $saksi2 = $this->request->getVar('saksi2');;

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$alamat."#".$niki."#".$namai."#".$jki."#".$tmpli."#".$tglli."#".$alamati."#".$luas."#".$letak."#".$nilai."#".$b."#".$u."#".$t."#".$s."#".$saksi1."#".$saksi2;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/jualbelitanah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-jualbelitanah/' . $idSurat);
   }
      public function printJualbelitanah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/jualbelitanah', $data). view('admin/print/topdf');

   }

   #END PERNYATAAN JUAL BELI TANAH


#44 BEGIN PERNYATAAN GADAI TANAH
      public function formGadaitanah($kodeSurat)
   {
      $suratModel = new SuratModel();
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pernyataan Gadai Tanah'
      ];

      return view('admin/create/create-gadaitanah', $data);
   }

   public function saveGadaitanah()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');

      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $alamati = $this->request->getVar('alamati');

      $luas = $this->request->getVar('luas');
      $letak = $this->request->getVar('letak');
      $nilai = $this->request->getVar('nilai');

      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $saksi1 = $this->request->getVar('saksi1');
      $saksi2 = $this->request->getVar('saksi2');;

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$alamat."#".$niki."#".$namai."#".$jki."#".$tmpli."#".$tglli."#".$alamati."#".$luas."#".$letak."#".$nilai."#".$b."#".$u."#".$t."#".$s."#".$saksi1."#".$saksi2;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Pernyaan Gadai Tanah berhasil',
            'error' => false
         ]);
          return view('admin/print/gadaitanah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-gadaitanah');
   }

   public function editGadaitanah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Pernyataan Gadai Tanah'
      ];

      return view('admin/edit/edit-gadaitanah', $data);
   }

   public function updateGadaitanah()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $alamat = $this->request->getVar('alamat');

      $niki = $this->request->getVar('niki');
      $namai = $this->request->getVar('namai');
      $jki = $this->request->getVar('jki');
      $tmpli = $this->request->getVar('tmpli');
      $tglli = $this->request->getVar('tglli');
      $alamati = $this->request->getVar('alamati');

      $luas = $this->request->getVar('luas');
      $letak = $this->request->getVar('letak');
      $nilai = $this->request->getVar('nilai');

      $b = $this->request->getVar('barat');
      $u = $this->request->getVar('utara');
      $t = $this->request->getVar('timur');
      $s = $this->request->getVar('selatan');

      $saksi1 = $this->request->getVar('saksi1');
      $saksi2 = $this->request->getVar('saksi2');;

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$alamat."#".$niki."#".$namai."#".$jki."#".$tmpli."#".$tglli."#".$alamati."#".$luas."#".$letak."#".$nilai."#".$b."#".$u."#".$t."#".$s."#".$saksi1."#".$saksi2;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/gadaitanah', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-gadaitanah/' . $idSurat);
   }
      public function printGadaitanah($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/gadaitanah', $data). view('admin/print/topdf');

   }
   
   #END PERNYATAAN GADAI TANAH
  
  #45 BEGIN SURAT KETERANGAN LAIN 
   public function formSklain($kodeSurat)
   {
      $suratModel = new SuratModel();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeSurat);
      $maxKodesurat = $suratModel->select('max(kode_surat) as maxKode')->first();
      $staff = $this->staffModel->getAllStaff();
      $data = [
         'ctx' => 'surat',
         'jenis' => $jenis,
         'max'    => $maxKodesurat,
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Lain'
      ];

      return view('admin/create/create-sklain', $data);
   }

   public function saveSklain()
   {

      $kodeSurat = $this->request->getVar('kode_surat');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $noSurat = $this->request->getVar('no_surat');
      $namaSurat = $this->request->getVar('nama_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');
      $ns = $this->request->getVar('nmsurat');
      $isi = $this->request->getVar('isi');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$kerjaan."#".$alamat."#".$ns."#".$isi;
      
      $result = $this->suratModel->saveSurat(NULL, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Input Surat Keterangan berhasil',
            'error' => false
         ]);
          return view('admin/print/sklain', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/create/create-sklain');
   }

   public function editSklain($kodeSurat)
   {
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getAllStaff();
      if (empty($surat)) {
         throw new PageNotFoundException('Data surat dengan kode ' . $kodeSurat . ' tidak ditemukan');
      }

      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Keterangan Lain'
      ];

      return view('admin/edit/edit-sklain', $data);
   }

   public function updateSklain()
   {
      $idSurat = $this->request->getVar('id');
      $suratLama = $this->suratModel->getSuratById($idSurat);

      $kodeSurat = $this->request->getVar('kode_surat');
      $noSurat = $this->request->getVar('no_surat');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmpl');
      $tgll = $this->request->getVar('tgll');
      $agama = $this->request->getVar('agama');
      $kerjaan = $this->request->getVar('kerjaan');
      $alamat = $this->request->getVar('alamat');
      $ns = $this->request->getVar('nmsurat');
      $isi = $this->request->getVar('isi');

      $ttd = $this->request->getVar('ttd');
      $user = $this->request->getVar('user');
      $isiSurat = $nik."#".$nama."#".$jk."#".$tmpl."#".$tgll."#".$agama."#".$kerjaan."#".$alamat."#".$ns."#".$isi;

      $result = $this->suratModel->updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $staff = $this->staffModel->getStaffById($ttd);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $surat,
         'staff' => $staff,
         'desa' => $desa
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit surat berhasil',
            'error' => false
         ]);
         return view('admin/print/sklain', $data) . view('admin/print/topdf');
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-sklain/' . $idSurat);
   }
      public function printSklain($kodeSurat)
   {
      //$id = $this->uri->getSegment(3);
      $surat = $this->suratModel->getAllSuratByKode($kodeSurat);
      $desa = $this->desaModel->getDesa();

      $data = [
         'surat' => $surat,
         'desa' => $desa
      ];

      return view('admin/print/sklain', $data). view('admin/print/topdf');

   }
#END SKU 

   # DELETEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
   public function delete($id)
   {
      $result = $this->suratModel->delete($id);

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Data berhasil dihapus',
            'error' => false
         ]);
         return redirect()->to('/admin/surat');
      }

      session()->setFlashdata([
         'msg' => 'Gagal menghapus data',
         'error' => true
      ]);
      return redirect()->to('/admin/surat');
   }
}
