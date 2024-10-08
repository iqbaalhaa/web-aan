<?php

namespace App\Models;

use CodeIgniter\Model;

class StatistikModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'data_statistik';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ip','tanggal','hits','online'];

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

public function getAllStatistik()
   {
      return $this->findAll();
   }
   public function getAllStatistikByTanggal($tanggal)
   {
      return $this->where(['tanggal' => $tanggal])
      ->groupBy('tanggal')
      ->findAll();
   }
   public function getAllStatistikByTanggalIp($tanggal)
   {
      return $this->where(['tanggal' => $tanggal])
      ->groupBy('ip')
      ->findAll();
   }
   public function getAllStatistikOnline()
   {
      $bataswaktu       = time() - 300;
      return $this->where(['online' => $bataswaktu])
      ->findAll();
   }

   public function getAllStatistikByIpTanggal($ip, $tanggal)
   {
      return $this->where(['ip' => $ip])
      ->where(['tanggal' => $tanggal])
      ->findAll();
   }
    public function saveStatistik($ip, $tanggal,$waktu)
   {
      return $this->save([
         'ip' => $ip,
         'tanggal' => $tanggal,
         'hits' => 1,
         'online' => $waktu
      ]);
   }
   public function updateStatistik($ip, $tanggal,$waktu)
   {
      return $this->save([
         'ip' => $ip,
         'tanggal' => $tanggal,
         'hits' => 1,
         'online' => $waktu
      ]);
   }
}
