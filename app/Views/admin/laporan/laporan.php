<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <?php if (session()->getFlashdata('msg')) : ?>
               <div class="pb-2 px-3">
                  <div class="alert alert-<?= session()->getFlashdata('error') == true ? 'danger' : 'success'  ?> ">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                     </button>
                     <?= session()->getFlashdata('msg') ?>
                  </div>
               </div>
            <?php endif; ?>
            <div class="card">
               <div class="card-header card-header-tabs card-header-info">
                  <div class="nav-tabs-navigation">
                     <div class="row">
                        <div class="col">
                           <h4 class="card-title"><b>Generate Laporan</b></h4>
                           <p class="card-category">Laporan Surat</p>
                        </div>
                     </div>
                  </div>
               </div>
               <form action="<?= base_url('admin/laporan/surat'); ?>" method="get" class="card-body d-flex flex-column">
               <div class="card-body">
                  <div class="col-md-12 col-lg-12">
                  <div class="row">
                           <div class="col-lg-4">
                                 <div class="col-md-6">
                                    <p class="d-inline"><b>Bulan :</b></p>
                                 </div>
                                 <div class="col-md-12">
                                    <input type="month" name="bulan" id="bulan" class="form-control" value="<?= date('Y-m'); ?>" required>
                                 </div>
                           </div>
                           <div class="col-lg-6">
                                 <div class="col-md-6">
                                    <p class="d-inline"><b>Jenis :</b></p>
                                 </div>
                                 <div class="col-md-12">
                                    <select name="jenis" class="custom-select" required >
                                       <option value="">--Pilih Jenis--</option>
                                       <?php foreach ($jenis as $value) : ?>
                                          <?php
                                          $kodeJenis = $value['kode_jenis'];
                                          $jenis = "{$value['nama_surat']}";
                                          ?>
                                          <option value="<?= $kodeJenis; ?>">
                                             <?= "$jenis"; ?>
                                          </option>
                                       <?php endforeach; ?>
                                    </select>
                                 </div>
                           </div>

                     </div>
                  </div>
               </div>
            </div>
                              <div class="errMsg"></div>
                              <div class="mt-auto d-flex flex-column">
                                 <button type="submit" name="type" value="pdf" class="btn btn-danger pl-3">
                                    <div class="row align-items-center">
                                       <div class="col-auto">
                                          <i class="material-icons" style="font-size: 32px;">print</i>
                                       </div>
                                       <div class="col">
                                          <div class="text-start">
                                             <h4 class="d-inline"><b>Generate Laporan</b></h4>
                                          </div>
                                       </div>
                                    </div>
                                 </button>

                                 <!-- <button type="submit" name="type" value="xls" class="btn btn-success pl-3 mt-auto">
                                 <div class="row align-items-center">
                                    <div class="col-auto">
                                       <i class="material-icons" style="font-size: 32px;">table_view</i>
                                    </div>
                                    <div class="col">
                                       <div class="text-start">
                                          <h4 class="d-inline"><b>Generate xls</b></h4>
                                       </div>
                                    </div>
                                 </div>
                              </button> -->
                              </div>

                           </form>
                        </div>
                     </div>
                  </div>
                  <br><br>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection() ?>