<?php

namespace App\Models;

use CodeIgniter\Model;

class UndanganModel extends Model
{
   protected function initialize()
   {
      $this->allowedFields = [
         'kode_undangan',
         'nama_undangan'
      ];
   }

   protected $table = 'data_undangan';

   protected $primaryKey = 'id';

   public function getAllUndangan()
   {
      return $this->findAll();
   }

   public function getAllUndanganByKode($kodeSurat)
   {
      return $this->where(['kode_undangan' => $kodeSurat])
      ->findAll();
   }
   

   public function saveDataUndangan($idU, $kodeUdg, $namaUdg)
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
      $kodeUdg    = array_filter($kodeUdg);
      $namaUdg    = array_filter($namaUdg);

      $jU = count($namaUdg);
      for ($i = 0; $i < $jU; $i++) {
         $data[$i] = [
            'kode_undangan' => $kodeUdg[$i],
            'nama_undangan'  => $namaUdg[$i]
         ];
      }
return $this->insertBatch($data);
   }
   public function updateDataUndangan($idU, $kodeUdg, $namaUdg)
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
      $kodeUdg    = array_filter($kodeUdg);
      $namaUdg    = array_filter($namaUdg);

      $jU = count($namaUdg);
      for ($i = 0; $i < $jU; $i++) {
         $data[$i] = [
            'kode_undangan' => $kodeUdg[$i],
            'nama_undangan'  => $namaUdg[$i]
         ];
      }
return $this->insertBatch($data);
   }
}
