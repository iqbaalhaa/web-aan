<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\PetugasModel;
use App\Models\DesaModel;
use App\Models\StaffModel;
use App\Models\KuaModel;
use App\Models\WargaModel;
use App\Models\JenissuratModel;
use App\Models\KlasifikasiModel;
use App\Models\PermohonanModel;
use PHPExcel;
use PHPExcel_IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use CodeIgniter\I18n\Time;

class MasterData extends BaseController
{

   protected PetugasModel $petugasModel;
   protected DesaModel $desaModel;
   protected StaffModel $staffModel;
   protected KuaModel $kuaModel;
   protected WargaModel $wargaModel;
   protected JenissuratModel $jenissuratModel;
   protected KlasifikasiModel $klasifikasiModel;
   protected PermohonanModel $permohonanModel;
   public function __construct()
   {

      $this->petugasModel = new PetugasModel();
      $this->desaModel = new DesaModel();
      $this->staffModel = new StaffModel();
      $this->kuaModel = new KuaModel();
      $this->wargaModel = new WargaModel();
      $this->jenissuratModel = new JenissuratModel();
      $this->klasifikasiModel = new KlasifikasiModel();
      $this->permohonanModel = new PermohonanModel();
   }

   public function dataWarga()
   {
      $warga = $this->wargaModel->getAllWarga();
      $data = [
         'title' => 'Data Warga Desa',
         'ctx' => 'data',
         'warga' => $warga,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($warga)

      ];

      return view('admin/data/create/data-warga', $data);
   }

public function importWarga()
   {
      $warga = $this->wargaModel->getAllWarga();
      $data = [
         'title' => 'Import Data Warga Desa',
         'ctx' => 'data',
         'warga' => $warga,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($warga)

      ];

      return view('admin/data/import-warga', $data);
   }
### Script Import versi 1 (tidak difungsikan)
public function importWargaExcel() {
      $path       = 'documents/users/';
      $json       = [];
      $this->upload_config($path);
      if (!$this->upload->do_upload('fileexcel')) {
         $json = [
            'error_message' => showErrorMessage($this->upload->display_errors()),
         ];
      } else {
         $file_data  = $this->upload->data();
         $file_name  = $path.$file_data['file_name'];
         $arr_file   = explode('.', $file_name);
         $extension  = end($arr_file);
         if('csv' == $extension) {
            $reader  = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
         } else {
            $reader  = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
         }
         $spreadsheet   = $reader->load($file_name);
         $sheet_data    = $spreadsheet->getActiveSheet()->toArray();
         $list          = [];
         foreach($sheet_data as $key => $val) {
            if($key != 0) {
               $result  = $this->wargaModel->get([
                  "nkk" => $val[0], 
                  "nik" => $val[1],
                  "nama" => $val[2],
                  "jk" => $val[3],
                  "tmp_lahir" => $val[4],
                  "tgl_lahir" => $val[5],
                  "kwng" => $val[6],
                  "agama" => $val[7],
                  "status" => $val[8],
                  "pend" => $val[9],
                  "kerjaan" => $val[10],
                  "prov" => $val[11],
                  "kab" => $val[12],
                  "kec" => $val[13],
                  "desa" => $val[14],
                  "alamat" => $val[15],
                  "hp" => $val[16],
                  "shdk" => $val[17]
               ]
               );
               if($result) {
               } else {
                  $list [] = [
                     'nkk'                => $val[0],
                     'nik'                => $val[1],
                     'nama'               => $val[2],
                     'jk'                 => $val[3],
                     'tmp_lahir'          => $val[4],
                     'tgl_lahir'          => $val[5],
                     'kwng'               => $val[6],
                     'agama'              => $val[7],
                     'status'             => $val[8],
                     'pend'               => $val[9],
                     'kerjaan'            => $val[10],
                     'prov'               => $val[11],
                     'kab'                => $val[12],
                     'kec'                => $val[13],
                     'desa'               => $val[14],
                     'alamat'             => $val[15],
                     'hp'                 => $val[16],
                     'shdk'               => $val[17]


                  ];
               }
            }
         }
         if(file_exists($file_name))
            unlink($file_name);
         if(count($list) > 0) {
            $result  = $this->wargaModel->saveWarga2($list);
            if($result) {
               $json = [
                  'success_message'    => showSuccessMessage("All Entries are imported successfully."),
               ];
            } else {
               $json = [
                  'error_message'   => showErrorMessage("Something went wrong. Please try again.")
               ];
            }
         } else {
            $json = [
               'error_message' => showErrorMessage("No new record is found."),
            ];
         }
      }
      echo json_encode($json);
   }

   public function upload_config($path) {
      if (!is_dir($path)) 
         mkdir($path, 0777, TRUE);     
      $config['upload_path']     = './'.$path;     
      $config['allowed_types']   = 'csv|CSV|xlsx|XLSX|xls|XLS';
      $config['max_filename']    = '255';
      $config['encrypt_name']    = TRUE;
      $config['max_size']     = 4096; 
      $this->load->library('upload', $config);
   }
# Script Import Versi 2
public function prosesExcel()
      {
         $file_excel = $this->request->getFile('fileexcel');
         $ext = $file_excel->getClientExtension();
         if($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
         } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
         }
         $spreadsheet = $render->load($file_excel);
   
         $data = $spreadsheet->getActiveSheet()->toArray();
         foreach($data as $x => $row) {
            if ($x == 0) {
               continue;
            }
            
            $nkk = $row[0];
            $nik = $row[1];
            $nama = $row[2];
            $jk = $row[3];
            $tmp_lahir = $row[4];
            $tgl_lahir = $row[5];
            $kwng = $row[6];
            $agama = $row[7];
            $status = $row[8];
            $pend = $row[9];
            $kerjaan = $row[10];
            $prov = $row[11];
            $kab = $row[12];
            $kec = $row[13];
            $desa = $row[14];
            $alamat = $row[15];
            $hp = $row[16];
            $shdk = $row[17];

   
            $db = \Config\Database::connect();

            $cekNik = $db->table('data_warga')->getWhere(['nik'=>$nik])->getResult();

            if(count($cekNik) > 0) {
               session()->setFlashdata('message','<b style="color:red">Data Gagal di Import NIK ada yang sama</b>');
            } else {
   
            $simpandata = [
               'nkk' => $nkk, 'nik' => $nik, 'nama'=> $nama,'jk'=> $jk,'tmp_lahir'=> $tmp_lahir,'tgl_lahir'=> $tgl_lahir,'kwng'=> $kwng,'agama'=> $agama,'status'=> $status,'pend'=> $pend,'kerjaan'=> $kerjaan,'prov'=> $prov,'kab'=> $kab,'kec'=> $kec,'desa'=> $desa,'alamat'=> $alamat,'hp'=> $hp,'shdk'=> $shdk
            ];
   
            $db->table('data_warga')->insert($simpandata);
            session()->setFlashdata('message','Berhasil import excel'); 
         }
      }
        $warga = $this->wargaModel->getAllWarga();
         $data = [
         'title' => 'Data Warga Desa',
         'ctx' => 'data',
         'warga' => $warga,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($warga)

      ];
         return view('admin/data/import-warga', $data);
      }

   public function prosesExcel2()
   {
      
      $file = $this->request->getFile('fileexcel');

      if($file){
         $excelReader  = new PHPExcel();
         //mengambil lokasi temp file
         $fileLocation = $file->getTempName();
         //baca file
         $objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
         //ambil sheet active
         $sheet   = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
         //looping untuk mengambil data
         foreach ($sheet as $idx => $row) {
            //skip index 1 karena title excel
            if($idx==1){
               continue;
            }
                $nkk = $row['A']; // Ambil data nkk
                $nik = $row['B']; // Ambil data nik
                $nama = $row['C']; // Ambil data nama
                $jk = $row['D']; // Ambil data jk
                $tmp_lahir = $row['E']; // Ambil data tmp lahir
                $tgl_lahir = $row['F']; // Ambil data tgl lahir
                $kwng = $row['G']; // Ambil data kwng
                $agama = $row['H']; // Ambil data agama
                $status = $row['I']; // Ambil data status
                $pend = $row['J']; // Ambil data alamat
                $kerjaan = $row['K']; // Ambil data kerjaan
                $alamat = $row['L']; // Ambil data alamat
                $kelurahan = $row['M']; // Ambil data kelurahan
                $kec = $row['N']; // Ambil data kec
                $kab = $row['O']; // Ambil data kab
                $prov = $row['P']; // Ambil data prov
                $hp = $row['Q']; // Ambil data hp
                $shdk = $row['R']; // Ambil data shdk
                $foto = $row['S']; // Ambil data foto
                $ket = $row['T']; // Ambil data ket

            // insert data
            $this->wargaModel->insert([
               'nkk'=>$nkk,
               'nik'=>$nik,
               'nama'=>$nama,
               'jk'=>$jk,
               'tmp_lahir'=>$tmp_lahir,
               'tgl_lahir'=>$tgl_lahir,
               'kwng'=>$kwng,
               'agama'=>$agama,
               'status'=>$status,
               'pend'=>$pend,
               'kerjaan'=>$kerjaan,
               'alamat'=>$alamat,
               'kelurahan'=>$kelurahan,
               'kec'=>$kec,
               'kab'=>$kab,
               'prov'=>$prov,
               'hp'=>$hp,
               'shdk'=>$shdk,
               'foto'=>$foto,
               'ket'=>$ket
            ]);
         }
      }
      $warga = $this->wargaModel->getAllWarga();
         $data = [
         'title' => 'Data Warga Desa',
         'ctx' => 'data',
         'warga' => $warga,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($warga)

      ];

      session()->setFlashdata('message','Berhasil import excel');
      return view('admin/data/create/data-warga', $data);
   }
public function downloadWarga()
   {
   
        $wargaModel = new WargaModel();
        $warga = $wargaModel->getAllWarga();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'NKK')
            ->setCellValue('C1', 'NIK')
            ->setCellValue('D1', 'Nama')
            ->setCellValue('E1', 'Jenis Kalamin')
            ->setCellValue('F1', 'Tempat Lahir')
            ->setCellValue('G1', 'Tanggal Lahir')
            ->setCellValue('H1', 'Kewarganegaraan')
            ->setCellValue('I1', 'Agama')
            ->setCellValue('J1', 'Status')
            ->setCellValue('K1', 'Pendidikan')
            ->setCellValue('L1', 'Pekerjaan')
            ->setCellValue('M1', 'Provinsi')
            ->setCellValue('N1', 'Kabupaten')
            ->setCellValue('O1', 'Kecamatan')
            ->setCellValue('P1', 'Desa')
            ->setCellValue('Q1', 'Alamat')
            ->setCellValue('R1', 'No. HP')
            ->setCellValue('S1', 'SHDK')
            ->setCellValue('T1', 'Foto')
            ->setCellValue('U1', 'Ket');
            
        $column = 2;

        foreach ($warga as $w) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $w['id'])
                ->setCellValue('B' . $column, $w['nkk'])
                ->setCellValue('C' . $column, $w['nik'])
                ->setCellValue('D' . $column, $w['nama'])
                ->setCellValue('E' . $column, $w['jk'])
                ->setCellValue('F' . $column, $w['tmp_lahir'])
                ->setCellValue('G' . $column, $w['tgl_lahir'])
                ->setCellValue('H' . $column, $w['kwng'])
                ->setCellValue('I' . $column, $w['agama'])
                ->setCellValue('J' . $column, $w['status'])
                ->setCellValue('K' . $column, $w['pend'])
                ->setCellValue('L' . $column, $w['kerjaan'])
                ->setCellValue('M' . $column, $w['prov'])
                ->setCellValue('N' . $column, $w['kab'])
                ->setCellValue('O' . $column, $w['kec'])
                ->setCellValue('P' . $column, $w['desa'])
                ->setCellValue('Q' . $column, $w['alamat'])
                ->setCellValue('R' . $column, $w['hp'])
                ->setCellValue('S' . $column, $w['shdk'])
                ->setCellValue('T' . $column, $w['foto'])
                ->setCellValue('U' . $column, $w['ket']);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-warga';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
public function downloadFormatWarga()
   {
      $warga = $this->wargaModel->getAllWarga();
      $desa = $this->desaModel->getDesa();
      $data = [
         //'title' => 'Download Data Warga Desa',
         //'ctx' => 'data',
         'warga' => $warga,
         'desa' => $desa,
         'empty' => empty($warga)
      ];

     // return redirect()->download('admin/data/datawarga');
     return $this->response->download('assets/formatdatawarga.xls', null);
      //return redirect()->to('admin/laporan/datapenduduk', $warga);
   }

   #1 BEGIN PROFIL DESA
   public function formProfil()
   {

      $desa = $this->desaModel->getDesa();
      $staff = $this->staffModel->getAllStaff();
      $kua = $this->kuaModel->getKua();
      $data = [
         'ctx' => 'data',
         'desa' => $desa,
         'staff' => $staff,
         'kua' => $kua,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($staff),
         'title' => 'Profil '
      ];

      return view('admin/data/create/create-profil', $data);
   }

   
   public function editProfil($kodeDesa)
   {

      $desa = $this->desaModel->getDesaByKode($kodeDesa);
      $kua = $this->kuaModel->getKua();
      if (empty($desa)) {
         throw new PageNotFoundException('Data profil dengan kode ' . $kodeDesa . ' tidak ditemukan');
      }

      $data = [
         'desa' => $desa,
         'kua' => $kua,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'ctx' => 'data',
         'title' => 'Profil',
      ];

      return view('admin/data/edit/edit-profil', $data);
   }

   public function updateProfil()
   {
      $idDesa = $this->request->getVar('id');
      $profilLama = $this->desaModel->getDesaById($idDesa);
      if (!$this->validate([
         'logo' => [
            'rules' => 'uploaded[logo]|mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]|max_size[logo,2048]',
            'errors' => [
               'uploaded' => 'Harus Ada File yang diupload',
               'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
               'max_size' => 'Ukuran File Maksimal 2 MB'
            ]
 
         ]
      ])); 

      $kodeDesa = $this->request->getVar('kodedesa');
      $desa = $this->request->getVar('desa');
      $kodekec = $this->request->getVar('kodekec');
      $kec = $this->request->getVar('kec');
      $kodekab = $this->request->getVar('kodekab');
      $kab = $this->request->getVar('kab');
      $kodeprov = $this->request->getVar('kodeprov');
      $prov = $this->request->getVar('prov');
      $alamat = $this->request->getVar('alamat');
      $telp = $this->request->getVar('telp');
      $email = $this->request->getVar('email');
      $pos = $this->request->getVar('pos');
      $kades = $this->request->getVar('kades');
      $nipkades = $this->request->getVar('nipkades');
      $jnp = $this->request->getVar('jnp');
      $logo = $this->request->getFile('logo');
      $fileName = $logo->getRandomName();
      
      if(!empty($logo)){
         $logo->move('assets/img/', $fileName);

         $result = $this->desaModel->updateDesa($idDesa, $kodeDesa, $desa, $kodekec, $kec, $kodekab, $kab, $kodeprov, $prov, $alamat, $telp, $email, $pos, $kades, $nipkades, $fileName, $jnp);
        


      }else{
         $result = $this->desaModel->updateDesa2($idDesa, $kodeDesa, $desa, $kodekec, $kec, $kodekab, $kab, $kodeprov, $prov, $alamat, $telp, $email, $pos, $kades, $nipkades, $jnp);
      }

      $desa = $this->desaModel->getDesaByKode($kodeDesa);
      $staff = $this->staffModel->getAllStaff();
      $kua = $this->kuaModel->getKua();
      $data = [
         'ctx' => 'data',
         'desa' => $desa,
         'staff' => $staff,
         'kua' => $kua,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($staff),
         'title' => 'Profil'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit profil berhasil',
            'error' => false
         ]);
         return view('admin/data/create/create-profil', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-profil/' . $idDesa);
   }
   #END PROFIL

   #BEGIN STAFF DESA
   public function formAddstaff()
   {

      $staff = $this->staffModel->getAllStaff();

      $data = [
         'ctx' => 'data',
         'staff'  => $staff,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Add Staff'
      ];

      return view('admin/data/create/add-staff', $data);
   }

   public function saveStaff()
   {

      $nama = $this->request->getVar('nama');
      $nip = $this->request->getVar('nip');
      $jabatan = $this->request->getVar('jabatan');
      
      $result = $this->staffModel->saveStaff(NULL, $nama, $nip, $jabatan);

      $staff = $this->staffModel->getAllStaff();
      $desa = $this->desaModel->getDesa();
      $kua = $this->kuaModel->getKua();
      $data = [
         'staff' => $staff,
         'desa' => $desa,
         'kua' => $kua,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($staff),
         'title' => 'Add Staff'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Tambah Staff berhasil',
            'error' => false
         ]);
          return view('admin/data/create/create-profil', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal input surat',
         'error' => true
      ]);
      return redirect()->to('/admin/data/create/add-staff', $data);
   }

   public function editStaff($idStf)
   {

      $staff = $this->staffModel->getStaffById($idStf);
      if (empty($staff)) {
         throw new PageNotFoundException('Data Staff dengan Id ' . $idStf . ' tidak ditemukan');
      }

      $data = [
         'staff' => $staff,
         'ctx' => 'data',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Edit Staff'
      ];

      return view('admin/data/edit/edit-staff', $data);
   }

   public function updateStaff()
   {
      $idStf = $this->request->getVar('id');
      $staffLama = $this->staffModel->getStaffById($idStf);
      $nama = $this->request->getVar('nama');
      $nip = $this->request->getVar('nip');
      $jabatan = $this->request->getVar('jabatan');
      
      $result = $this->staffModel->saveStaff($idStf, $nama, $nip, $jabatan);

      $staff = $this->staffModel->getAllStaff();
      $desa = $this->desaModel->getDesa();
      $kua = $this->kuaModel->getKua();
      $data = [
         'staff' => $staff,
         'desa' => $desa,
         'kua' => $kua,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($staff),
         'title' => 'Edit Staff'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit Staff berhasil',
            'error' => false
         ]);
         return view('admin/data/create/create-profil', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/data/edit/edit-staff/' . $idStf);
   }
   
   #END ADD STAFF

   #BEGIN UPDATE KUA
   
   public function updateKua()
   {
      $idKua = $this->request->getVar('idkua');
      $kuaLama = $this->kuaModel->getKuaById($idKua);
      $nmk = $this->request->getVar('nm_kepala');
      $nipk = $this->request->getVar('nip_kepala');
      $jabk = $this->request->getVar('pangjab_kepala');
      $telpk = $this->request->getVar('telp_kua');
      $almtk = $this->request->getVar('almt_kua');
      
      $result = $this->kuaModel->saveKua($idKua, $nmk, $nipk, $jabk, $telpk, $almtk);

      $staff = $this->staffModel->getAllStaff();
      $desa = $this->desaModel->getDesa();
      $kua = $this->kuaModel->getKua();
      $data = [
         'staff' => $staff,
         'desa' => $desa,
         'kua' => $kua,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($staff),
         'title' => 'Update KUA'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit KUA berhasil',
            'error' => false
         ]);
         return view('admin/data/create/create-profil', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/data/edit/edit-staff/' . $idStf);
   }
   
   #END UPDATE KUA

   #4 BEGIN WARGA DESA
   public function formAddwarga()
   {

      $warga = $this->wargaModel->getAllWarga();
      $data = [
         'ctx' => 'data',
         'warga' => $warga,
         'empty' => empty($warga),
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Tambah Data Warga'
      ];

      return view('admin/data/create/add-warga', $data);
   }

   
   public function editWarga($idw)
   {

      $warga = $this->wargaModel->getWargaById($idw);
      if (empty($warga)) {
         throw new PageNotFoundException('Data Warga dengan id ' . $idw . ' tidak ditemukan');
      }

      $data = [
         'warga' => $warga,
         'ctx' => 'data',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Edit Data Warga',
      ];

      return view('admin/data/edit/edit-warga', $data);
   }

public function saveWarga()
   {

      $nik = $this->request->getVar('nik');
      $nkk = $this->request->getVar('nkk');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmp_lahir');
      $tgll = $this->request->getVar('tgl_lahir');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $status = $this->request->getVar('status');
      $pend = $this->request->getVar('pend');
      $kerjaan = $this->request->getVar('kerjaan');
      $prov = $this->request->getVar('prov');
      $kab = $this->request->getVar('kab');
      $kec = $this->request->getVar('kec');
      $desa = $this->request->getVar('desa');
      $alamat = $this->request->getVar('alamat');
      $hp = $this->request->getVar('hp');
      $shdk = $this->request->getVar('shdk');
      $foto = $this->request->getFile('foto');
      $fileName = $foto->getRandomName();
      
      if(!empty($foto)){
         $foto->move('assets/img/warga', $fileName);

         $result = $this->wargaModel->saveWarga(NULL, $nkk,$nik,$nama,$jk,$tmpl,$tgll,$kwng,$agama,$status,$pend,$kerjaan,$prov,$kab,$kec,$desa,$alamat,$hp,$shdk,$fileName);

      }else{
         $result = $this->wargaModel->saveWarga(NULL, $nkk,$nik,$nama,$jk,$tmpl,$tgll,$kwng,$agama,$status,$pend,$kerjaan,$prov,$kab,$kec,$desa,$alamat,$hp,$shdk);
      }

      $warga = $this->wargaModel->getAllWarga();
      $data = [
         'ctx' => 'data',
         'warga' => $warga,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($warga),
         'title' => 'Data Warga'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit Data Warga berhasil',
            'error' => false
         ]);
         return view('admin/data/create/data-warga', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal menambah data',
         'error' => true
      ]);
      return redirect()->to('/admin/data/create/add-warga');
   }

   public function updateWarga()
   {
      $idw = $this->request->getVar('id');
      $wargaLama = $this->wargaModel->getWargaById($idw);

      $nik = $this->request->getVar('nik');
      $nkk = $this->request->getVar('nkk');
      $nama = $this->request->getVar('nama');
      $jk = $this->request->getVar('jk');
      $tmpl = $this->request->getVar('tmp_lahir');
      $tgll = $this->request->getVar('tgl_lahir');
      $kwng = $this->request->getVar('kwng');
      $agama = $this->request->getVar('agama');
      $status = $this->request->getVar('status');
      $pend = $this->request->getVar('pend');
      $kerjaan = $this->request->getVar('kerjaan');
      $prov = $this->request->getVar('prov');
      $kab = $this->request->getVar('kab');
      $kec = $this->request->getVar('kec');
      $desa = $this->request->getVar('desa');
      $alamat = $this->request->getVar('alamat');
      $hp = $this->request->getVar('hp');
      $shdk = $this->request->getVar('shdk');
      $ket = $this->request->getVar('ket');
      $foto = $this->request->getFile('foto');
      $fileName = $foto->getRandomName();
      
      if(!empty($foto)){
         $foto->move('assets/img/warga', $fileName);

         $result = $this->wargaModel->saveWarga($idw, $nkk,$nik,$nama,$jk,$tmpl,$tgll,$kwng,$agama,$status,$pend,$kerjaan,$prov,$kab,$kec,$desa,$alamat,$hp,$shdk,$fileName);

      }else{
         $result = $this->wargaModel->saveWarga(NULL, $nkk,$nik,$nama,$jk,$tmpl,$tgll,$kwng,$agama,$status,$pend,$kerjaan,$prov,$kab,$kec,$desa,$alamat,$hp,$shdk);
      }

      $warga = $this->wargaModel->getAllWarga();
      $data = [
         'ctx' => 'data',
         'warga' => $warga,
         'empty' => empty($warga),
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Update Data Warga'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit Data Warga berhasil',
            'error' => false
         ]);
         return view('admin/data/create/data-warga', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/edit/edit-warga' . $idw);
   }


    public function delete($id)
   {
      $result = $this->staffModel->delete($id);

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Data berhasil dihapus',
            'error' => false
         ]);
         return redirect()->to('/admin/data/create-profil');
      }

      session()->setFlashdata([
         'msg' => 'Gagal menghapus data',
         'error' => true
      ]);
      return redirect()->to('/admin/data/create-profil');
   }
   public function deleteWarga($id)
   {
      $result = $this->wargaModel->delete($id);

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Data berhasil dihapus',
            'error' => false
         ]);
         return redirect()->to('/admin/data/data-warga');
      }

      session()->setFlashdata([
         'msg' => 'Gagal menghapus data',
         'error' => true
      ]);
      return redirect()->to('/admin/data/data-warga');
   }
# END WARGA 

   # BEGIN JENIS SURAT
   public function dataJs()
   {

      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $data = [
         'ctx' => 'data',
         'jenis' => $jenis,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($jenis),
         'title' => 'Data Jenis Surat'
      ];

      return view('admin/data/create/data-jenis-surat', $data);
   }
    public function dataKls()
   {

      $klasifikasi = $this->klasifikasiModel->getAllKlasifikasi();
      $data = [
         'ctx' => 'data',
         'klasifikasi' => $klasifikasi,
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'empty' => empty($klasifikasi),
         'title' => 'Data Klasifikasi Surat'
      ];

      return view('admin/data/create/data-klasifikasi', $data);
   }
    public function editJs($kodeJenis)
   {

      $jenis = $this->jenissuratModel->getJenisSuratByKode($kodeJenis);
      $klasifikasi = $this->klasifikasiModel->getAllKlasifikasi();
      if (empty($jenis)) {
         throw new PageNotFoundException('Data Jneis Surat dengan kode ' . $kodeJenis . ' tidak ditemukan');
      }

      $data = [
         'jenis' => $jenis,
         'klasifikasi' => $klasifikasi,
         'ctx' => 'data',
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Edit Data Jenis Surat',
      ];

      return view('admin/data/edit/edit-jenis-surat', $data);
   }
   public function updateJs()
   {
      $idj = $this->request->getVar('id');
      
      $jenisLama = $this->jenissuratModel->getJenisSuratById($idj);
      //$kodeJenis = $this->request->getVar('kode_jenis');
      $ns = $this->request->getVar('nama_surat');
      $psr = $this->request->getVar('persyaratan');
      $ket = $this->request->getVar('keterangan');

      $result = $this->jenissuratModel->updateJenissurat($idj,$ns,$psr,$ket);

      $klasifikasi = $this->klasifikasiModel->getAllKlasifikasi();
      $jenis = $this->jenissuratModel->getAllJenisSurat();
      $data = [
         'ctx' => 'data',
         'jenis' => $jenis,
         'empty' => empty($jenis),
         'onproccess' => $this->permohonanModel->getAllPermohonanByStatusOnproccess(),
         'title' => 'Update Data Jenis Surat'
      ];

      if ($result) {
         session()->setFlashdata([
            'msg' => 'Edit Data Jenis Surat berhasil',
            'error' => false
         ]);
         return view('admin/data/create/data-jenis-surat', $data);
      }

      session()->setFlashdata([
         'msg' => 'Gagal mengubah data',
         'error' => true
      ]);
      return redirect()->to('/admin/data/create/data-jenis-surat' . $data);
   }
}
