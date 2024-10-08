<?php

namespace App\Models;

use CodeIgniter\Model;

class WargaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'data_warga';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nkk','nik','nama','jk','tmp_lahir', 'tgl_lahir','kwng','agama','status','pend','kerjaan','prov', 'kab','kec','desa','alamat','hp','shdk','foto','ket'];

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

public function getAllWarga()
   {
      return $this->findAll();
   }
   public function getWargaById($idw)
   {
      return $this->where([$this->primaryKey => $idw])->first();
   }
    public function saveWarga($idw, $nkk,$nik,$nama,$jk,$tmp_lahir,$tgl_lahir,$kwng,$agama,$status,$pend,$kerjaan,$prov,$kab,$kec,$desa,$alamat,$hp,$shdk,$fileName)
   {
      return $this->save([
         $this->primaryKey => $idw,
         'nkk' => $nkk,
         'nik' => $nik,
         'nama' => $nama,
         'jk' => $jk,
         'tmp_lahir' => $tmp_lahir,
         'tgl_lahir' => $tgl_lahir,
         'kwng' => $kwng,
         'agama' => $agama,
         'status' => $status,
         'pend' => $pend,
         'kerjaan' => $kerjaan,
         'prov' => $prov,
         'kab' => $kab,
         'kec' => $kec,
         'desa' => $desa,
         'alamat' => $alamat,
         'hp' => $hp,
         'shdk' => $shdk,
         'foto' => $fileName,
         'ket' => 'Aktif'
      ]);
   }
   public function saveWarga2($idw, $nkk,$nik,$nama,$jk,$tmp_lahir,$tgl_lahir,$kwng,$agama,$status,$pend,$kerjaan,$prov,$kab,$kec,$desa,$alamat,$hp,$shdk)
   {
      return $this->save([
         $this->primaryKey => $idw,
         'nkk' => $nkk,
         'nik' => $nik,
         'nama' => $nama,
         'jk' => $jk,
         'tmp_lahir' => $tmp_lahir,
         'tgl_lahir' => $tgl_lahir,
         'kwng' => $kwng,
         'agama' => $agama,
         'status' => $status,
         'pend' => $pend,
         'kerjaan' => $kerjaan,
         'prov' => $prov,
         'kab' => $kab,
         'kec' => $kec,
         'desa' => $desa,
         'alamat' => $alamat,
         'hp' => $hp,
         'shdk' => $shdk
      ]);
   }

}
