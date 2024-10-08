<?php

namespace App\Models;

use CodeIgniter\Model;

class AhliwarisModel extends Model
{
   protected function initialize()
   {
      $this->allowedFields = [
         'kodeaw',
         'nm',
         'jk',
         'ttl',
         'alamat',
         'agama',
         'shdk'
      ];
   }

   protected $table = 'data_ahliwaris';

   protected $primaryKey = 'id';

   public function getAllAw()
   {
      return $this->findAll();
   }

   public function getAllAwByKode($kodeSurat)
   {
      return $this->where(['kodeaw' => $kodeSurat])
      ->findAll();
   }
   

   public function saveDataAw($idAw, $kodeSuratAw, $namaAw, $jkAw, $ttlAw, $alamatAw, $agamaAw, $shdk)
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
      $kodeSuratAw    = array_filter($kodeSuratAw);
      $namaAw    = array_filter($namaAw);
      $jkAw      = array_filter($jkAw);
      $ttlAw     = array_filter($ttlAw);
      $alamatAw  = array_filter($alamatAw);
      $agamaAw   = array_filter($agamaAw);
      $shdk      = array_filter($shdk);

      $jAw = count($namaAw);
      for ($i = 0; $i < $jAw; $i++) {
         $data[$i] = [
            'kodeaw' => $kodeSuratAw[$i],
            'nm'  => $namaAw[$i],
            'jk' => $jkAw[$i],
            'ttl' => $ttlAw[$i],
            'alamat' => $alamatAw[$i],
            'agama' => $agamaAw[$i],
            'shdk' => $shdk[$i]
         ];
      }
return $this->insertBatch($data);
   }
   public function updateDataAw($idAw, $kodeSuratAw, $namaAw, $jkAw, $ttlAw, $alamatAw, $agamaAw, $shdk)
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
      $kodeSuratAw    = array_filter($kodeSuratAw);
      $namaAw    = array_filter($namaAw);
      $jkAw      = array_filter($jkAw);
      $ttlAw     = array_filter($ttlAw);
      $alamatAw  = array_filter($alamatAw);
      $agamaAw   = array_filter($agamaAw);
      $shdk      = array_filter($shdk);

      $jAw = count($namaAw);
      for ($i = 0; $i < $jAw; $i++) {
         $data[$i] = [
            'kodeaw' => $kodeSuratAw[$i],
            'nm'  => $namaAw[$i],
            'jk' => $jkAw[$i],
            'ttl' => $ttlAw[$i],
            'alamat' => $alamatAw[$i],
            'agama' => $agamaAw[$i],
            'shdk' => $shdk[$i]
         ];
      }
return $this->insertBatch($data);
   }
}
