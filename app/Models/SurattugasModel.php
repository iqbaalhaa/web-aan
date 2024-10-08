<?php

namespace App\Models;

use CodeIgniter\Model;

class SurattugasModel extends Model
{
   protected function initialize()
   {
      $this->allowedFields = [
         'kode_tgs',
         'nama_tgs',
         'ket_tgs'
      ];
   }

   protected $table = 'data_stugas';

   protected $primaryKey = 'id';

   public function getAllTugas()
   {
      return $this->findAll();
   }

   public function getAllTugasByKode($kodeSurat)
   {
      return $this->where(['kode_tgs' => $kodeSurat])
      ->findAll();
   }
   

   public function saveDataTugas($idTgs, $kodeTgs, $namaTgs, $ketTgs)
   {
      /*
      var_dump($kodeSuratAw);
      var_dump($namaAw);
      var_dump($jkAw);
      var_dump($ttlAw);
      var_dump($alamatAw);
      var_dump($agamaAw);
      var_dump($shdk);
      */
      $kodeTgs    = array_filter($kodeTgs);
      $namaTgs    = array_filter($namaTgs);
      $ketTgs    = array_filter($ketTgs);

      $jT = count($namaTgs);
      for ($i = 0; $i < $jT; $i++) {
         $data[$i] = [
            'kode_tgs' => $kodeTgs[$i],
            'nama_tgs'  => $namaTgs[$i],
            'ket_tgs'  => $ketTgs[$i]
         ];
      }
return $this->insertBatch($data);
   }
   public function updateDataTugas($idTgs, $kodeTgs, $namaTgs, $ketTgs)
   {
      /*
      var_dump($kodeSuratAw);
      var_dump($namaAw);
      var_dump($jkAw);
      var_dump($ttlAw);
      var_dump($alamatAw);
      var_dump($agamaAw);
      var_dump($shdk);
      */
      $kodeTgs    = array_filter($kodeTgs);
      $namaTgs    = array_filter($namaTgs);
      $ketTgs    = array_filter($ketTgs);

      $jT = count($namaTgs);
      for ($i = 0; $i < $jT; $i++) {
         $data[$i] = [
            'kode_tgs' => $kodeTgs[$i],
            'nama_tgs'  => $namaTgs[$i],
            'ket_tgs'  => $ketTgs[$i]
         ];
      }
return $this->insertBatch($data);
   }
}
