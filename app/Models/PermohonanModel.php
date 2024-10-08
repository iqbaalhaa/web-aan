<?php

namespace App\Models;

use CodeIgniter\Model;

class PermohonanModel extends Model
{
   protected function initialize()
   {
      $this->allowedFields = ['idpermohonan','nik', 'nama', 'kode_surat', 'nmsurat', 'page', 'hp', 'berkas', 'foto', 'tgl', 'userid', 'keterangan', 'status'];
   }

   protected $table = 'data_permohonan';

   protected $primaryKey = 'id';

   public function getAllPermohonan()
   {
      return $this->findAll();
   }
   public function getPermohonanById($id)
   {
      return $this->where([$this->primaryKey => $id])->first();
   }
   
   #Untuk dipanggil dilaporan Surat
   public function getAllPermohonanByNik($nik)
   {
      return $this->where(['nik' => $nik])->findAll();
   }

    public function getAllPermohonanByIdp($idp)
   {
      return $this->where(['idpermohonan' => $idp])->findAll();
   }

    public function getAllPermohonanByUser($userid)
   {
      $userid = user()->toArray()['id'];
      return $this
      ->where(['userid' => $userid])
      ->findAll();
   }
   public function getAllPermohonanByUserId($userid, $idp)
   {
      return $this
      ->where(['userid' => $userid])
      ->where(['idpermohonan' => $idp])
      ->findAll();
   }
   public function getAllPermohonanByStatusOnproccess()
   {
      $status ='Onproccess';
      return $this->where('status =', $status)->findAll();
   }
public function getAllPermohonanByStatusAcc()
   {
      $statusAcc ='Acc';
      return $this->where('status =', $statusAcc)->findAll();
   }
public function getAllPermohonanByStatusTolak()
   {
      $statusTolak ='ditolak';
      return $this->where('status =', $statusTOlak)->findAll();
   }


   public function kirimPermohonan($id,$idp,$nik,$nama,$kode_jenis,$nmsurat,$page,$telp,$fileName,$fotoName,$userid)
   {
      return $this->save([
         $this->primaryKey => $id,
         'idpermohonan' => $idp,
         'nik' => $nik,
         'nama' => $nama,
         'kode_surat' => $kode_jenis,
         'nmsurat' => $nmsurat,
         'page' => $page,
         'hp' => $telp,
         'berkas' => $fileName,
         'foto' => $fotoName,
         'userid' => $userid,
         'status' => 'Onproccess'
      ]);
   }
   
    public function updatePermohonan($id, $idp, $terima)
   {
      return $this->save([
         $this->primaryKey => $id,
         'idpermohonan' => $idp,
         'status' => $terima
      ]);
   }
   public function updateTolakPermohonan($id, $idp, $ket, $tolak)
   {
      return $this->save([
         $this->primaryKey => $id,
         'idpermohonan' => $idp,
         'keterangan' => $ket,
         'status' => $tolak
      ]);
   }
}
