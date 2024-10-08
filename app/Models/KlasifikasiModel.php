<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasifikasiModel extends Model
{
   protected function initialize()
   {
      $this->allowedFields = [
         'kode',
         'klasifikasi'
      ];
   }

   protected $table = 'data_klasifikasi';

   protected $primaryKey = 'id';

   public function getAllKlasifikasi()
   {
      return $this->findAll();
   }
   public function getKlasifikasiById($id)
   {
      return $this->where([$this->primaryKey => $id])->first();
   }

}
