<?php

namespace App\Models;

use CodeIgniter\Model;

class KuaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'data_kua';
    protected $primaryKey       = 'id_kua';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nm_kepala','nip_kepala','pangjab_kepala','telp_kua','almt_kua'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

public function getKua()
   {
      return $this->findAll();
   }
   public function getKuaById($idKua)
   {
      return $this->where([$this->primaryKey => $idKua])->first();
   }
   public function saveKua($idKua, $nmk, $nipk, $jabk, $telpk, $almtk)
   {
      return $this->save([
         $this->primaryKey => $idKua,
         'nm_kepala' => $nmk,
         'nip_kepala' => $nipk,
         'pangjab_kepala' => $jabk,
         'telp_kua' => $telpk,
         'almt_kua' => $almtk
      ]);
   }

}
