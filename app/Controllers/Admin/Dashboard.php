<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\SuratModel;
use App\Models\JenissuratModel;
use App\Models\PetugasModel;
use App\Models\StaffModel;
use App\Models\WargaModel;
use App\Models\DesaModel;
use App\Models\PermohonanModel;
use App\Models\StatistikModel;
use CodeIgniter\I18n\Time;

class Dashboard extends BaseController
{

   protected PetugasModel $petugasModel;
   protected SuratModel $suratModel;
   protected JenissuratModel $jenissuratModel;
   protected StaffModel $staffModel;
   protected WargaModel $wargaModel;
   protected DesaModel $desaModel;
   protected PermohonanModel $permohonanModel;
   protected StatistikModel $statistikModel;
   public function __construct()
   {

      $this->petugasModel = new PetugasModel();
      $this->suratModel = new SuratModel();
      $this->jenissuratModel = new JenissuratModel();
      $this->staffModel = new StaffModel();
      $this->wargaModel = new WargaModel();
      $this->desaModel = new DesaModel();
      $this->permohonanModel = new PermohonanModel();
      $this->statistikModel = new StatistikModel();
   }

 
   public function index()
   {
        // Statistik user
      $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
      $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
      $waktu   = time(); // 

      // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
      //$query = mysqli_query($con, "SELECT * FROM tb_statistik WHERE ip='$ip' AND tanggal='$tanggal'");
      // Kalau belum ada, simpan data user tersebut ke database
      $s= $this->statistikModel->getAllStatistikByIpTanggal($ip,$tanggal);
      if($s == 0){
        //mysqli_query($con, "INSERT INTO tb_statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
        $result = $this->statistikModel->saveStatistik($ip,$tanggal,$waktu);
      } 
      else{
        //mysqli_query($con, "UPDATE tb_statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
        $result = $this->statistikModel->updateStatistik($ip,$tanggal,$waktu);
      }

      $pengunjung       = $this->statistikModel->getAllStatistikByTanggalIp($tanggal); //mysqli_query($con, "SELECT * FROM tb_statistik WHERE tanggal='$tanggal' GROUP BY ip");
      $totalpengunjung  = $this->statistikModel->getAllStatistik(); // mysqli_query($con, "SELECT COUNT(hits) FROM tb_statistik"); 
      $hits             = $this->statistikModel->getAllStatistikByTanggalIp($tanggal); //mysqli_query($con, "SELECT SUM(hits) as hitstoday FROM tb_statistik WHERE tanggal='$tanggal' GROUP BY  tanggal"); 
      $totalhits        = $this->statistikModel->getAllStatistik(); //mysqli_query($con, "SELECT SUM(hits) FROM tb_statistik"); 
      $tothitsgbr       = $this->statistikModel->getAllStatistik(); //mysqli_query($con, "SELECT SUM(hits) FROM tb_statistik"); 
      $bataswaktu       = time() - 300;
      $pengunjungonline = $this->statistikModel->getAllStatistikOnline(); //mysqli_query($con, "SELECT * FROM tb_statistik WHERE online > '$bataswaktu'");

      $permohonanModel = new PermohonanModel();
      $kodeSurat = $this->request->getVar('kode_surat') ?? null;
      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $jeniss = $this->jenissuratModel->getAllJenisSuratNotTu();
      $staff = $this->staffModel->getAllStaff();
      $warga = $this->wargaModel->getAllWarga();
      $desa = $this->desaModel->getDesa();
      $maxIdPermohonan = $permohonanModel->select('max(id) as maxKode')->first();
      $permohonan = $this->permohonanModel->getAllPermohonan();
      $surat = $this->suratModel->getAllSuratAndStaffAndJenis();
      //$surat = new \App\Models\SuratModel();
      //$pager = \Config\Services::pager();
      $data = [
         'title' => 'Dashboard',
         'ctx' => 'dashboard',
         'jenis' => $jenis,
         'jeniss' => $jeniss,
         'staff' => $staff,
         'warga' => $warga,
         'desa' => $desa,
         'permohonan' => $permohonan,
         'pengunjung' => $pengunjung,
         'totalpengunjung' => $totalpengunjung,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'max'    => $maxIdPermohonan,
         'surat' => $surat,
         //'pager' => $surat->pager,
         'empty' => empty($jenis),
         'petugas' => $this->petugasModel->getAllPetugas()

      ];
     if (user()->toArray()['is_superadmin'] == '1') : 
      return view('admin/dashboard', $data);
      elseif (user()->toArray()['is_superadmin'] == '2') : 
      return view('kades/dashboard', $data);
      endif;
      return view('warga/home', $data);
   }
public function Permohonan()
   {
      $permohonanModel = new PermohonanModel();
      $kodeSurat = $this->request->getVar('kode_surat') ?? null;
      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $jeniss = $this->jenissuratModel->getAllJenisSuratNotTu();
      $staff = $this->staffModel->getAllStaff();
      $warga = $this->wargaModel->getAllWarga();
      $desa = $this->desaModel->getDesa();
      $maxIdPermohonan = $permohonanModel->select('max(id) as maxKode')->first();
      $permohonan = $this->permohonanModel->getAllPermohonan();
      $data = [
         'title' => 'Dashboard',
         'ctx' => 'dashboard',
         'jenis' => $jenis,
         'jeniss' => $jeniss,
         'staff' => $staff,
         'warga' => $warga,
         'desa' => $desa,
         'permohonan' => $permohonan,
         'max'    => $maxIdPermohonan,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'surat' => $this->suratModel->getAllSuratAndStaffAndJenis(),
         'empty' => empty($jenis),
         'petugas' => $this->petugasModel->getAllPetugas()

      ];
     if (user()->toArray()['is_superadmin'] ?? '0' == '1') : 
      return view('admin/data/data-permohonan', $data);
      endif;
      return view('warga/status-permohonan', $data);
   }
public function pelayananSurat()
   {
      $desa = $this->desaModel->getDesa();
      $data = [
         'title' => 'Dashboard',
         'ctx' => 'dashboard',
         'desa' => $desa,
         'empty' => empty($desa),


      ];
     
      return redirect()->to('warga/pelayanan-surat');
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
            $wargalist = $warga->select('nik,nama')
                ->like('nik',$search)
                ->orderBy('nik')
                ->findAll(2);
            foreach($wargalist as $w){
                $data[] = array(
                    "label" => $w['nik'],
                    "nama" => $w['nama'],
                );
            }
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);

    }

#Script Cadanagn ----------------------------
   public function getJenis(){

        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $data = array();

        if(isset($postData['search'])){

            $search = $postData['search'];

            // Fetch record
            $jenis = new JenissuratModel();
            $jenislist = $jenis->select('kode_jenis,nama_surat,page')
                ->like('nama_surat',$search)
                ->orderBy('id')
                ->findAll(5);
            foreach($jenislist as $w){
                $data[] = array(
                    "label" => $w['nama_surat'],
                    "kode_jenis" => $w['kode_jenis'],
                    "page" => $w['page'],
                );
            }
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);

    }

   public function kirimPermohonan()
   {
      $permohonanModel = new PermohonanModel();
      $maxIdPermohonan = $permohonanModel->select('max(id) as maxKode')->first();
      $idp = $this->request->getVar('id');
      $kodeJenis = $this->request->getVar('kode_jenis');
      $nik = $this->request->getVar('nik');
      $nama = $this->request->getVar('nama');
      $telp = $this->request->getVar('telp');
      $userid = $this->request->getVar('user');
      $berkas = $this->request->getFile('berkas');
      $fileName = $berkas->getRandomName();
      $foto = $this->request->getFile('foto');
      $fotoName = $foto->getRandomName();
      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeJenis);
      foreach ($jenis as $jn) {
         // code...
      
      $kode_jenis = $jn['kode_jenis'];
      $nmsurat = $jn['nama_surat'];
      $page = $jn['page'];


      if(!empty($foto && $berkas)){
         $foto->move('assets/permohonan/foto', $fotoName);
         $berkas->move('assets/permohonan/berkas', $fileName);
      $result = $this->permohonanModel->kirimPermohonan(NULL, $idp, $nik, $nama, $kode_jenis, $nmsurat, $page, $telp, $fileName, $fotoName, $userid);
   }
}
      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $jeniss = $this->jenissuratModel->getAllJenisSuratNotTu();
      $desa = $this->desaModel->getDesa();
      $warga = $this->wargaModel->getAllWarga();
      $permohonan = $this->permohonanModel->getAllPermohonanByUserId($userid, $idp);

      $data = [
         'max'    => $maxIdPermohonan,
         'title' => 'Kirim Permohonan',
         'permohonan' => $permohonan,
         'jeniss' => $jeniss,
         'jenis' => $jenis,
         'warga' => $warga,
         'desa' => $desa,
         'max'    => $maxIdPermohonan,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'surat' => $this->suratModel->getAllSuratAndStaffAndJenis(),
         'petugas' => $this->petugasModel->getAllPetugas()
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Permohonan berhasil dikirim',
            'error' => false
         ]);
          return view('warga/tunggu_permohonan', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal kirim permohonan',
         'error' => true
      ]);
      return redirect()->to('warga/home', $data);
   }

public function statusPermohonan()
   {
      $permohonanModel = new PermohonanModel();
      $kodeSurat = $this->request->getVar('kode_surat') ?? null;
      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $jeniss = $this->jenissuratModel->getAllJenisSuratNotTu();
      $staff = $this->staffModel->getAllStaff();
      $warga = $this->wargaModel->getAllWarga();
      $desa = $this->desaModel->getDesa();
      $userid = user()->toArray()['id'];
      $permohonan = $this->permohonanModel->getAllPermohonanByUser($userid);
      $data = [
         'title' => 'Dashboard',
         'ctx' => 'dashboard',
         'jenis' => $jenis,
         'jeniss' => $jeniss,
         'staff' => $staff,
         'warga' => $warga,
         'desa' => $desa,
         'permohonan'    => $permohonan,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'surat' => $this->suratModel->getAllSuratAndStaffAndJenis(),
         'empty' => empty($permohonan),
         'petugas' => $this->petugasModel->getAllPetugas()

      ];
      return view('warga/status-permohonan', $data);
   }
public function tungguPermohonan($idp)
   {

      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $desa = $this->desaModel->getDesa();
      $warga = $this->wargaModel->getAllWarga();
      $permohonan = $this->permohonanModel->getAllPermohonanByIdp($idp);

      $data = [
         'title' => 'Status Permohonan',
         'permohonan' => $permohonan,
         'jenis' => $jenis,
         'warga' => $warga,
         'desa' => $desa,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'surat' => $this->suratModel->getAllSuratAndStaffAndJenis(),
         'petugas' => $this->petugasModel->getAllPetugas()
      ];


          return view('warga/tunggu_permohonan', $data);
      
   }

   public function aksiPermohonan($idp)
   {

      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $desa = $this->desaModel->getDesa();
      $warga = $this->wargaModel->getAllWarga();
      $permohonan = $this->permohonanModel->getAllPermohonanByIdp($idp);

      $data = [
         'title' => 'Konfirmasi Permohonan',
         'permohonan' => $permohonan,
         'jenis' => $jenis,
         'warga' => $warga,
         'desa' => $desa,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'surat' => $this->suratModel->getAllSuratAndStaffAndJenis(),
         'petugas' => $this->petugasModel->getAllPetugas()
      ];


          return view('admin/data/aksi-permohonan', $data);
      
   }
public function eksPermohonan()
   {
      $id = $this->request->getVar('id');
      $idp = $this->request->getVar('idp');
      $terima = $this->request->getVar('terima');
      $tolak = $this->request->getVar('tolak');
      $ket = $this->request->getVar('keterangan');

      if($terima == 'Acc'){
      $result = $this->permohonanModel->updatePermohonan($id, $idp, $terima);
      
      $permohonan = $this->permohonanModel->getAllPermohonanByIdp($idp);
       foreach ($permohonan as $row) {
      $data = [
         'title' => 'Konfirmasi Permohonan',
         'permohonan' => $permohonan,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($permohonan)
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Permohonan berhasil di Acc, segera selesaikan pembuatan surat',
            'error' => false
         ]);
          return redirect()->to('admin/surat/create-'.$row['page'].'/' . $row['kode_surat']);
         }
      }
      session()->setFlashdata([
         'msg' => 'Gagal Acc ',
         'error' => true
      ]);
      return view('admin/data/data-permohonan', $data);

   
      }

   if($tolak == 'ditolak' & !empty($ket)){
      $result = $this->permohonanModel->updateTolakPermohonan($id, $idp, $ket, $tolak);
      
      $permohonan = $this->permohonanModel->getAllPermohonanByIdp($idp);
       foreach ($permohonan as $row) {
      $data = [
         'title' => 'Konfirmasi Permohonan',
         'permohonan' => $permohonan,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($permohonan)
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Permohonan ditolak',
            'error' => false
         ]);
          return view('admin/data/data-permohonan', $data);
      }
      }

      }
      $permohonan = $this->permohonanModel->getAllPermohonanByIdp($idp);
       foreach ($permohonan as $row) {
      $data = [
         'title' => 'Konfirmasi Permohonan',
         'permohonan' => $permohonan,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($permohonan)
      ];
      session()->setFlashdata([
         'msg' => 'Penolakan Permohonan gagal, Keterangan atau alasan Penolakan harus diisi ',
         'error' => true
      ]);
      return view('admin/data/aksi-permohonan', $data);
}
   
}


}
