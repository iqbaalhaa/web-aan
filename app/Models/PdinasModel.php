<?php

namespace App\Models;

use CodeIgniter\Model;

class PdinasModel extends Model
{
   protected function initialize()
   {
      $this->allowedFields = [
         'kode_pd',
         'nama_pd',
         'tgll_pd',
         'ket_pd'
      ];
   }

   protected $table = 'data_pdinas';

   protected $primaryKey = 'id';

   public function getAllSppd()
   {
      return $this->findAll();
   }

   public function getAllSppdByKode($kodeSurat)
   {
      return $this->where(['kode_pd' => $kodeSurat])
      ->findAll();
   }
   

   public function saveDataSppd($idPd, $kodePd, $namaPd, $tgllPd, $ketPd)
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
      $kodePd  = array_filter($kodePd);
      $namaPd   = array_filter($namaPd);
      $tgllPd  = array_filter($tgllPd);
      $ketPd  = array_filter($ketPd);

      $jPd = count($namaPd);
      for ($i = 0; $i < $jPd; $i++) {
         $data[$i] = [
            'kode_pd' => $kodePd[$i],
            'nama_pd'  => $namaPd[$i],
            'tgll_pd'  => $tgllPd[$i],
            'ket_pd'  => $ketPd[$i]
         ];
      }
return $this->insertBatch($data);
   }
   public function updateDataSppd($idPd, $kodePd, $namaPd, $tgllPd, $ketPd)
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
      $kodePd  = array_filter($kodePd);
      $namaPd   = array_filter($namaPd);
      $tgllPd  = array_filter($tgllPd);
      $ketPd  = array_filter($ketPd);

      $jPd = count($namaPd);
      for ($i = 0; $i < $jPd; $i++) {
         $data[$i] = [
            'kode_pd' => $kodePd[$i],
            'nama_pd'  => $namaPd[$i],
            'tgll_pd'  => $tgllPd[$i],
            'ket_pd'  => $ketPd[$i]
         ];
      }
return $this->insertBatch($data);
   }
}
