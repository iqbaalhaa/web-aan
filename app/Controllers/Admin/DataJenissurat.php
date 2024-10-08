<?php

namespace App\Controllers\Admin;

use App\Models\JenissuratModel;
use App\Models\PermohonanModel;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class DataJenissurat extends BaseController
{
   protected JenissuratModel $jenissuratModel;
   protected PermohonanModel $permohonanModel;

   public function __construct()
   {
      $this->jenissuratModel = new JenissuratModel();
      $this->permohonanModel = new PermohonanModel();
   }

   public function index()
   {
      $kodeSurat = $this->request->getVar('kode_surat') ?? null;
      //$result = $this->suratModel->getAllSuratWithKode($kodeSurat);
      $data = [
         'title' => 'Data Jenis Surat',
         'ctx' => 'surat',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'surat' => $this->jenissuratModel->getAllJenisSurat()

      ];

      return view('admin/data/data-jenis-surat', $data);
   }

   public function ambilDataJenisSurat()
   {
      $kodeSurat = $this->request->getVar('kode_surat') ?? null;
      $result = $this->jenissuratModel->getAllJenisSuratByKode($kodeSurat);

      $data = [
         'data' => $result,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($result)
      ];

      return view('admin/data/list-data-jenis-surat', $data);
   }


}
