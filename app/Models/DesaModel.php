<?php

namespace App\Models;

use CodeIgniter\Model;

class DesaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_desa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kodedesa','desa','kodekec','kec', 'kodekab','kab','kodeprov','prov','alamat','telp', 'kades','nipkades','sekdes','nipsekdes','bendahara','email','logo','jnp'];

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

public function getDesa()
   {
      return $this->findAll();
   }
public function getDesaById($idDesa)
   {
      return $this->where([$this->primaryKey => $idDesa])->first();
   }

public function getDesaByKode($kodeDesa)
   {
      return $this->where(['kodedesa' => $kodeDesa])
      ->findAll();
}
public function updateDesa($idDesa, $kodeDesa, $desa, $kodekec, $kec, $kodekab, $kab, $kodeprov, $prov, $alamat, $telp, $email, $pos, $kades, $nipkades, $fileName, $jnp)
   {
      return $this->save([
         $this->primaryKey => $idDesa,
         'kodedesa' => $kodeDesa,
         'desa' => $desa,
         'kodekec' => $kodekec,
         'kec' => $kec,
         'kodekab' => $kodekab,
         'kab' => $kab,
         'kodeprov' => $kodeprov,
         'prov' => $prov,
         'alamat' => $alamat,
         'telp' => $telp,
         'email' => $email,
         'pos' => $pos,
         'kades' => $kades,
         'nipkades' => $nipkades,
         'logo' => $fileName,
         'jnp' => $jnp
      ]);
   }
   public function updateDesa2($idDesa, $kodeDesa, $desa, $kodekec, $kec, $kodekab, $kab, $kodeprov, $prov, $alamat, $telp, $email, $pos, $kades, $nipkades, $jnp)
   {
      return $this->save([
         $this->primaryKey => $idDesa,
         'kodedesa' => $kodeDesa,
         'desa' => $desa,
         'kodekec' => $kodekec,
         'kec' => $kec,
         'kodekab' => $kodekab,
         'kab' => $kab,
         'kodeprov' => $kodeprov,
         'prov' => $prov,
         'alamat' => $alamat,
         'telp' => $telp,
         'email' => $email,
         'pos' => $pos,
         'kades' => $kades,
         'nipkades' => $nipkades,
         'jnp' => $jnp
      ]);
   }
   
}
