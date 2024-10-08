<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
   protected function initialize()
   {
      $this->allowedFields = [
         'nama',
         'nip',
         'jabatan'
      ];
   }

   protected $table = 'data_staff';

   protected $primaryKey = 'id';

   public function getAllStaff()
   {
      return $this->findAll();
   }
   public function getStaffById($id)
   {
      return $this->where([$this->primaryKey => $id])->first();
   }
   public function getStaffByJabatan()
   {
      $jabatan = 'Bendahara';
      return $this->where(['jabatan' => $jabatan])->findAll();
   }
    public function saveStaff($idStf, $nama, $nip, $jabatan)
   {
      return $this->save([
         $this->primaryKey => $idStf,
         'nama' => $nama,
         'nip' => $nip,
         'jabatan' => $jabatan
      ]);
   }
   

}
