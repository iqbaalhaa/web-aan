<?php

namespace App\Models;

use CodeIgniter\Model;

class JenissuratModel extends Model
{
   protected function initialize()
   {
      $this->allowedFields = [
         'kode_jenis',
         'klasifikasi_surat',
         'kategori_surat',
         'nama_surat',
         'page',
         'persyaratan',
         'keterangan'
      ];
   }

   protected $table = 'data_jenissurat';

   protected $primaryKey = 'id';

   public function getAllJenisSurat()
   {
      return $this->findAll();
   }
   public function getJenisSuratById($id)
   {
      return $this->where([$this->primaryKey => $id])->first();
   }
   public function getAllJenisSuratNotTu()
   {
      $where ='Tata Usaha';
      return $this->where('kategori_surat !=', $where)->findAll();
   }
   public function getJenisSuratByKode($kodeJenis)
   {
      return $this->where(['kode_jenis' => $kodeJenis])->findAll();
   }
   public function updateJenissurat($idj, $ns, $psr, $ket)
   {
      return $this->save([
         $this->primaryKey => $idj,
         'nama_surat' => $ns,
         'persyaratan' => $psr,
         'keterangan' => $ket
      ]);
   }
}
