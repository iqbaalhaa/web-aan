<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use DateTime;
use DateInterval;
use DatePeriod;

use App\Models\SuratModel;
use App\Models\JenissuratModel;
use App\Models\DesaModel;
use App\Models\PermohonanModel;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class GenerateLaporan extends BaseController
{
   protected SuratModel $suratModel;
   protected JenissuratModel $jenissuratModel;
   protected DesaModel $desaModel;
   protected PermohonanModel $permohonanModel;
   public function __construct()
   {
      $this->suratModel = new SuratModel();
      $this->jenissuratModel = new JenissuratModel();
      $this->desaModel = new DesaModel();
      $this->permohonanModel = new PermohonanModel();
   }

   public function index()
   {
      $surat = $this->suratModel->getAllSurat();
      $jenis = $this->jenissuratModel->getAllJenisSurat();

      $data = [
         'title' => 'Generate Laporan',
         'ctx' => 'laporan',
         'surat' => $surat,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'jenis' => $jenis
         
      ];

      return view('admin/laporan/laporan', $data);
   }

public function printLaporanSurat()
   {
      $kodeJenis = $this->request->getVar('jenis');
      $surat = $this->suratModel->getAllSuratByJenis($kodeJenis);
      $bulan = $this->request->getVar('bulan');
      if (empty($surat)) {
         session()->setFlashdata([
            'msg' => 'Data Surat kosong!',
            'error' => true
         ]);
         return redirect()->to('/admin/laporan/laporan-surat');
      }

     // $jenis = $this->jenissuratModel->where(['kode_jenis' => $kodeJenis])->first();

      //$bl = $bulan->format('Y-m');
      $suratByBulan = $this->suratModel->getAllSuratByJenisBulan($kodeJenis, $bulan);
      $desa = $this->desaModel->getDesa();
      $data = [
         'surat' => $suratByBulan,
         'bulan' => $bulan,
         'desa' => $desa,
         'empty' => empty($surat)
         
      ];


      return view('admin/laporan/laporan-surat', $data). view('admin/print/topdf');
   }


   public function printLaporanSurat2()
   {
      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $surat = $this->suratModel->getAllSuratAndStaffAndJenis();

      $data = [
         'title' => '',
         'ctx' => 'surat',
         'jenis' => $jenis,
         'surat' => $surat,
         'empty' => empty($surat)

      ];

      return view('admin/laporan/laporan-surat', $data). view('admin/print/topdf');
   }

}
