<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Tambah Data Warga Desa</b></h4>
               </div>
               <div class="card-body mx-3 my-3">
                  <form action="<?= base_url('admin/data/add-warga'); ?>" method="post" enctype="multipart/form-data">
                     <?= csrf_field() ?>
                     <?php $validation = \Config\Services::validation(); ?>

                     <?php if (session()->getFlashdata('msg')) : ?>
                     <div class="pb-2">
                        <div class="alert alert-danger">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <i class="material-icons">close</i>
                           </button>
                           <?= session()->getFlashdata('msg') ?>
                        </div>
                     </div>
                  <?php endif; ?>
                  <!-- CSRF token --> 
                  <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                  <h4 class="mt-4"><strong>DATA WARGA : </strong></h4>
                  <hr>
                     <div class="row mt-2">
                     <div class="col-md-3">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label>NKK </label>
                        <input type="text" name="nkk" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label>Jenis Kelamin</label>
                        <select name="jk" class="form-control col-md-12" required>
                           <option value="Laki-laki">Laki-laki</option>
                           <option value="Perempuan">Perempuan</option>
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tmp_lahir" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-2">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label>Kewarganegaraan</label>
                        <input type="text" name="kwng" class="form-control col-md-12" required>
                     </div>
                  </div>
                     <div class="row mt-2">
                     <div class="col-md-3">
                        <label>Agama</label>
                        <select name="agama" class="form-control col-md-12" required>
                           <option value="Islam">Islam</option>
                           <option value="Protestan">Protestan</option>
                           <option value="Katholik">Katholik</option>
                           <option value="Hindu">Hindu</option>
                           <option value="Budha">Budha</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label>Status</label>
                        <select name="status" class="form-control col-md-12" required>
                           <option value="Kawin">Kawin</option>
                           <option value="Belum Kawin">Belum Kawin</option>
                           <option value="Cerai Hidup">Cerai Hidup</option>
                           <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                     </div>

                     <div class="col-md-3">
                        <label>Pendidikan</label>
                        <select name="pend" class="form-control col-md-12" required>
                           <option value="Belum Sekolah">Belum Sekolah</option>
                           <option value="Tidak Sekolah">Tidak Sekolah</option>
                           <option value="SD">SD</option>
                           <option value="SMP">SMP</option>
                           <option value="SMA">SMA</option>
                           <option value="D1">D1</option>
                           <option value="D2">D2</option>
                           <option value="D3">D3</option>
                           <option value="S1">S1</option>
                           <option value="S2">S2</option>
                           <option value="S3">S3</option>
                        </select>
                     </div>
                     <div class="col-md-3">
                        <label>Pekerjaan</label>
                        <select name="kerjaan" class="form-control col-md-12" required>
                           <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                           <option value="Petani">Petani</option>
                           <option value="Pedagang">Pedagang</option>
                           <option value="Wiraswasta">Wiraswasta</option>
                           <option value="Honorer">Honorer</option>
                           <option value="Nelayan">Nelayan</option>
                           <option value="Karyawan Swasta">Karyawan Swasta</option>
                           <option value="ASN">ASN</option>
                           <option value="TNI/POLRI">TNI/POLRI</option>
                           <option value="Lainnya">Lainnya</option>                        
                        </select>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label>Provinsi</label>
                        <input type="text" name="prov" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label>Kabupaten</label>
                        <input type="text" name="kab" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label>Kecamatan</label>
                        <input type="text" name="kec" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label>Desa</label>
                        <input type="text" name="desa" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label>Alamat Lengkap</label>
                        <input type="text" name="alamat" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label>No. Hp</label>
                        <input type="text" name="hp" class="form-control col-md-12">
                     </div>
                     <div class="col-md-3">
                        <label>SHDK</label>
                        <select name="shdk" class="form-control col-md-12" required>
                           <option value="Kepala Keluarga">Kepala Keluarga</option>
                           <option value="Suami">Suami</option>
                           <option value="Istri">Istri</option>
                           <option value="Anak">Anak</option>
                           <option value="Orang Tua">Orang Tua</option>
                           <option value="Famili Lain">Famili Lain</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control col-md-12">
                     </div>
                  </div>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-6" align="left">
                        <a href="<?= base_url('admin/data/data-warga');?>" class="btn btn-info">&nbsp;&nbsp;Kembali&nbsp;&nbsp;</a>
                     </div>
                     <div class="col-md-6" align="right">
                        <button type="submit" name="swarga" class="btn btn-primary">&nbsp;&nbsp;Simpan&nbsp;&nbsp;</button>
                     </div>
                  </div>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>

<?= $this->endSection() ?>