<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Profil Desa</b></h4>
               </div>
               <div class="card-body mx-3 my-3">
                  <form action="<?= base_url('admin/data/update-profil'); ?>" method="post" enctype="multipart/form-data">
                     <?= csrf_field() ?>
                     <?php $validation = \Config\Services::validation(); ?>
               <?php foreach($desa as $dt): ?>
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

                     <div class="col-md-6">
                     <input type="hidden" id="id" name="id" value="<?= $dt['id']; ?>" class="form-control col-md-6" required>
                     <input type="hidden" id="user" name="user" value="<?= user()->toArray()['id']; ?>" class="form-control col-md-6" required>
                     </div>

<nav>
                <div class="row nav nav-tabs mt-4" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#desa" role="tab" aria-controls="custom-nav-home" aria-selected="true"><b>DATA KECAMATAN</b></a>
                    <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#Staff" role="tab" aria-controls="custom-nav-profile" aria-selected="false"><b>STAFF KECAMATAN</b></a>
                    <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#Kua" role="tab" aria-controls="custom-nav-contact" aria-selected="false"><b>KUA</b></a>
                    
                </div>
                </nav>
            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="desa" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                  <h4 class="mt-4"><strong>DATA KECAMATAN: </strong></h4>
                  <hr>
                     <div class="row mt-2">
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label>Kode Kecamatan</label>
                        <input type="text" name="kodekec" value="<?= $dt['kodekec']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label>Kecamatan</label>
                        <input type="text" name="kec" value="<?= $dt['kec']; ?>" class="form-control col-md-12" required>
                     </div>
                     
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label>Kode Kabupaten/Kota</label>
                        <input type="text" name="kodekab" value="<?= $dt['kodekab']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label>Kabupaten/Kota</label>
                        <input type="text" name="kab" value="<?= $dt['kab']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label>Kode Provinsi</label>
                        <input type="text" name="kodeprov" value="<?= $dt['kodeprov']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label>Provinsi</label>
                        <input type="text"name="prov" value="<?= $dt['prov']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label>Alamat</label>
                        <textarea rows="2" name="alamat" class="form-control col-md-12" required><?= $dt['alamat']; ?></textarea>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-4">
                        <label>Telp</label>
                        <input type="text" rows="2" name="telp" value="<?= $dt['telp']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label>Email</label>
                        <input type="text" name="email" value="<?= $dt['email']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label>Kode Pos</label>
                        <input type="text" name="pos" value="<?= $dt['pos']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <h4 class="mt-4"><strong>CAMAT: </strong></h4>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-4">
                        <label>Kepala Desa</label>
                        <input type="text" name="kades" value="<?= $dt['kades']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label>NIP CAMAT</label>
                        <input type="text" name="nipkades" value="<?= $dt['nipkades']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <h4 class="mt-4"><strong>LOGO : </strong></h4>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-3" align="center">
                        <img src="<?= base_url('assets/img/'.$dt['logo']); ?>" width="120" height="120">
                     </div>
                     <br>
                     <div class="col-md-9">
                        <label for="logo">Logo</label>
                        <input type="file" id="logo" name="logo" value="<?= $dt['logo']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  
                  <hr>
                  <h4 class="mt-4"><strong>JENIS PEMERINTAHAN</strong></h4>
                  <hr>
                  <div class="form-group mt-2">
                     <select name="jnp" class="custom-select col-md-4" required >
                        <option value="<?= $dt['jnp']; ?>"><?= $dt['jnp']; ?></option>
                           <option value="Desa">Desa</option>
                           <option value="Kelurahan">Kelurahan</option>
                           <option value="Kecamatan">Kecamatan</option>
                           <option value="Pekon">Pekon</option>
                     </select>
                  </div>
                  <hr>
                  <div class="form-group mt-2" align="right">
                  <button type="submit" name="type" value="pdf" class="btn btn-primary">&nbsp;&nbsp;Update&nbsp;&nbsp;</button>
               </div>
               </form>
               </div>
               <?php endforeach; ?>
               <div class="tab-pane fade show" id="Staff" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                  <h4 class="mt-4"><strong>DATA STAFF DESA: </strong></h4>
                  <hr>
                  <a href="<?= base_url('admin/data/add-staff'); ?>" class="btn btn-primary"><i class="material-icons">add</i>Tambah Staff</a>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <div class="card">
                           <div class="card-body table-responsive">
                             <?php if (!$empty) : ?>
                               <table id="bootstrap-data-table-export" class="table table-hover">
                                 <thead class="text-primary">
                                   <th><b>No</b></th>
                                   <th><b>NIP</b></th>
                                   <th><b>Nama</b></th>
                                   <th><b>Jabatan</b></th>
                                   <th><b>Aksi</b></th>
                                </thead>
                                <tbody>
                                   <?php $i = 1;
                                   foreach ($staff as $value) : ?>
                                     <tr>
                                       <td><?= $i; ?></td>
                                       <td><?= $value['nip']; ?></td>
                                       <td><?= $value['nama']; ?></td>
                                       <td><?= $value['jabatan']; ?></td>
                                       <td>

                                         <a href="<?= base_url('admin/data/edit-staff/' . $value['id']); ?>" type="button" class="btn btn-primary p-2" id="<?= $value['id']; ?>">
                                           <i class="material-icons">edit</i></a>
                                           <form action="<?= base_url('admin/data/delete/' . $value['id']); ?>" method="post" class="d-inline">
                                              <?= csrf_field(); ?>
                                              <input type="hidden" name="_method" value="DELETE">
                                              <button onclick="return confirm('Konfirmasi untuk menghapus data');" type="submit" class="btn btn-danger p-2" id="<?= $value['id']; ?>">
                                                <i class="material-icons">delete_forever</i></button>
                                             </form>
                                          </td>
                                       </tr>
                                       <?php $i++;
                                    endforeach; ?>
                                 </tbody>
                              </table>
                           <?php else : ?>
                            <div class="row">
                              <div class="col">
                                <h4 class="text-center text-danger">Data tidak ditemukan</h4>
                             </div>
                          </div>
                       <?php endif; ?>
                    </div>
                 </div>
              </div>
           </div>
        </div>
               
               <div class="tab-pane fade show" id="Kua" role="tabpanel" aria-labelledby="custom-nav-home-tab">
               <h4 class="mt-4"><strong>KANTOR URUSAN AGAMA : </strong></h4>
                  <hr>
                  <?php foreach($kua as $dk): ?>
                  <form action="<?= base_url('admin/data/update-kua'); ?>" method="post">
                     <input type="hidden" id="idkua" name="idkua" value="<?= $dk['id_kua']; ?>" class="form-control col-md-6" required>
                  <div class="row mt-2">
                     <div class="col-md-4">
                        <label>Nama Kepala KUA</label>
                        <input type="text" name="nm_kepala" value="<?= $dk['nm_kepala']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label>NIP Kepala KUA</label>
                        <input type="text" name="nip_kepala" value="<?= $dk['nip_kepala']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label>Pangkat Kepala KUA</label>
                        <input type="text" name="pangjab_kepala" value="<?= $dk['pangjab_kepala']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label>No. Telp KUA</label>
                        <input type="text" name="telp_kua" value="<?= $dk['telp_kua']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-9">
                        <label>Alamat Kantor</label>
                        <input type="text" name="almt_kua" value="<?= $dk['almt_kua']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <hr>
                  <div class="form-group mt-2" align="right">
                  <button type="submit" name="kua" value="pdf" class="btn btn-primary">&nbsp;&nbsp;Update&nbsp;&nbsp;</button>
               </form>
            </div>
         </div>
      <?php endforeach; ?>
               <hr>
            </div>
         </div>
      </div>
   </div>


<?= $this->endSection() ?>