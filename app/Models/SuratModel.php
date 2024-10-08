<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
   protected function initialize()
   {
      $this->allowedFields = [
         'kode_surat',
         'kode_jenis',
         'no_surat',
         'nama_surat',
         'isi_surat',
         'ttd',
         'user',
         'unique_code'
      ];
   }

   protected $table = 'tb_detailsurat';

   protected $primaryKey = 'id_surat';
   //protected $returnType = 'object'; 

   public function getAllSurat()
   {
      return $this->findAll();
   }
   public function getSuratById($id)
   {
      return $this->join(
         'data_staff',
         'data_staff.id = tb_detailsurat.ttd',
         'LEFT'
         )
      ->join(
         'data_jenissurat',
         'data_jenissurat.kode_jenis = tb_detailsurat.kode_jenis',
         'LEFT'
         )

      ->where([$this->primaryKey => $id])->first();
   }
   public function getSuratAwById($id)
   {
      return $this->join(
         'data_staff',
         'data_staff.id = tb_detailsurat.ttd',
         'LEFT'
         )
      ->join(
         'data_jenissurat',
         'data_jenissurat.kode_jenis = tb_detailsurat.kode_jenis',
         'LEFT'
         )
       ->join(
         'tb_ahliwaris',
         'tb_ahliwaris.kodeaw = tb_detailsurat.kode_surat',
         'LEFT'
         )
      ->where([$this->primaryKey => $id])->first();
   }
   #Untuk dipanggil dilaporan Surat
   public function getAllSuratByJenis($kodeJenis)
   {
      return $this->join(
         'data_jenissurat',
         'data_jenissurat.kode_jenis = tb_detailsurat.kode_jenis',
         'LEFT'
         )->where(['tb_detailsurat.kode_jenis' => $kodeJenis])->findAll();
   }
   public function getAllSuratByJenisBulan($kodeJenis, $bulan)
   {
      return $this->join(
         'data_jenissurat',
         'data_jenissurat.kode_jenis = tb_detailsurat.kode_jenis',
         'LEFT'
         )
      ->where(['tb_detailsurat.kode_jenis' => $kodeJenis])
      //->where(['tb_detailsurat.tanggal' => $bulan])
      ->where("DATE_FORMAT(tb_detailsurat.tanggal,'%Y-%m') =","$bulan")
      ->findAll();
   }

   public function getAllSuratByKode($kodeSurat)
   {
      return $this->join(
         'data_staff',
         'data_staff.id = tb_detailsurat.ttd',
         'LEFT'
         )
      ->join(
         'data_jenissurat',
         'data_jenissurat.kode_jenis = tb_detailsurat.kode_jenis',
         'LEFT'
         )
      ->where(['tb_detailsurat.kode_surat' => $kodeSurat])
      ->findAll();
   }

   public function getAllSuratAndStaffAndJenis()
   {
      return $this->join(
         'data_staff',
         'data_staff.id = tb_detailsurat.ttd',
         'LEFT'
         )
      ->join(
         'data_jenissurat',
         'data_jenissurat.kode_jenis = tb_detailsurat.kode_jenis',
         'LEFT'
         )
      ->orderBy('tb_detailsurat.id_surat', 'DESC')
      ->findAll();
   }

   public function saveSurat($idSurat, $kodeSurat, $kodeJenis, $noSurat, $namaSurat, $isiSurat, $ttd, $user)
   {
      return $this->save([
         $this->primaryKey => $idSurat,
         'kode_surat' => $kodeSurat,
         'kode_jenis' => $kodeJenis,
         'no_surat' => $noSurat,
         'nama_surat' => $namaSurat,
         'isi_surat' => $isiSurat,
         'ttd' => $ttd,
         'user' => $user,
         'unique_code' => sha1($kodeSurat . md5($namaSurat))
      ]);
   }
   
    public function updateSurat($idSurat, $noSurat, $isiSurat, $ttd, $user)
   {
      return $this->save([
         $this->primaryKey => $idSurat,
         'no_surat' => $noSurat,
         'isi_surat' => $isiSurat,
         'ttd' => $ttd,
         'user' => $user
      ]);
   }
}
