<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Edit Surat Undangan</b></h4>
               </div>
               <div class="card-body mx-5 my-3">
                  <form action="<?= base_url('admin/surat/update-undangan'); ?>" method="post">
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
                  <?php foreach($surat as $data): ?>
                     <div class="row mt-2">
                        <div class="col-md-6">
                           <label for="no_surat">Kode Surat</label>
                           <input type="text" id="kode_surat" name="kode_surat" value="<?= $data['kode_surat']; ?>" class="form-control col-md-6"  required readonly style="font-size: 18px; box-shadow: 4px 4px 6px;">
                           <input type="hidden" id="id" name="id" value="<?= $data['id_surat']; ?>" class="form-control col-md-6" required>
                           <input type="hidden" id="user" name="user" value="<?= user()->toArray()['id']; ?>" class="form-control col-md-6" required>
                        </div>
                        <div class="col-md-6">
                           <label for="no_surat">Nomor Surat</label>
                           <input type="text" id="no_surat" name="no_surat" value="<?= $data['no_surat']; ?>" class="form-control col-md-12" required readonly style="font-size: 18px; box-shadow: 4px 4px 6px;">
                        </div>
                  </div>
                  <?php $dt = explode('#', $data['isi_surat']); ?>
                  <hr>
                     <h4><strong>KEGIATAN / ACARA :</strong></h4>
                     <div class="row mt-2">
                        <div class="col-md-12 mt-2">
                           <label for="kegiatan">Kegiatan / Acara</label>
                           <input type="text" id="kegiatan" name="kegiatan" value="<?= $dt['0']; ?>" class="form-control col-md-12" required>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-4">
                           <label for="hari">Hari</label>
                           <select id="hari" name="hari" class="form-control col-md-12" required>
                           <option value="<?= $dt[1]; ?>" selected ><?= $dt[1]; ?></option>
                           <option value="Senin">Senin</option>
                           <option value="Selasa">Selasa</option>
                           <option value="Rabu">Rabu</option>
                           <option value="Kamis">Kamis</option>
                           <option value="Jum\'at">Jum'at</option>
                           <option value="Sabtu">Sabtu</option>
                           <option value="Minggu">Minggu</option>
                        </select>
                        </div>
                        <div class="col-md-4">
                           <label for="tgl">Tanggal</label>
                           <input type="date" id="tgl" name="tgl" value="<?= $dt['2']; ?>" class="form-control col-md-12" required>
                        </div>
                        <div class="col-md-4">
                           <label for="waktu">Waktu</label>
                           <input type="time" id="waktu" name="waktu" value="<?= $dt['3']; ?>" class="form-control col-md-8" required><small>AM = 00:00 - 11:59 (Siang), <br>PM = 12:00 - 23:59 (Malam)</small>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12">
                           <label for="tempat">Tempat</label>
                           <input type="text" id="tempat" name="tempat" value="<?= $dt['4']; ?>" class="form-control col-md-12" required>
                        </div>
                     </div>
                     <div class="panel-body">
                        <h4 class="mt-4"><strong>NAMA / LEMBAGA YANG DIUNDANG :</strong></h4>
                        <hr>
                        <div class="control-group after-add-more">
                           <table width="80%" class="">
                              <tr>
                                <td width="100%">Nama / Lembaga</td>
                                <td></td>
                             </tr>
                             <?php $no=1; foreach ($du as $r1 ) : ?>
                             <tr>
                              <td width="100%"><input type="hidden" id="idu" name="idu[]" value="<?= $r1['id']; ?>">
                           <input type="hidden" id="kode_surat" name="kode_suratu[]" value="<?= $r1['kode_undangan']; ?>"><input type="text" name="namau[]" value="<?= $r1['nama_undangan']; ?>" class="form-control"></td>
                              <td><button class="btn btn-success add-more" type="button"><i class="material-icons">add</i>
                              </button></td>
                           </tr>
                           <?php endforeach; ?>
                        </table>
                     </div>
                     <div class="copy invisible">
                       <div class="control-group">
                          <table width="80%" class="">
                            <tr>
                              <td width="100%">
                                 <input type="hidden" name="kode_suratu[]" value="<?= $data['kode_surat']; ?>">
                                 <input type="text" name="namau[]" class="form-control"></td>
                              <td><button class="btn btn-danger remove" type="button"><i class="material-icons">remove</i></button></td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </div>

                  <h4 class="mt-4"><strong>PENANDA TANGAN SURAT</strong></h4>
                  <hr>
                  <div class="form-group mt-2">
                     <label for="ttd">Penanda Tangan Surat : &nbsp;</label>
                     <select name="ttd" class="custom-select col-md-4" required >
                        <option value="<?= $data['ttd']; ?>"><?= $data['nama']; ?> (<?= $data['jabatan']; ?>)</option>
                        <?php foreach ($staff as $vp) : ?>
                           <?php
                           $id = $vp['id'];
                           $nprf = "{$vp['nama']} ({$vp['jabatan']})";
                           ?>
                           <option value="<?= $id; ?>">
                              <?= "$nprf"; ?>
                           </option>
                        <?php endforeach; ?>
                     </select>
                  </div>
                  <hr>
                  <button type="submit" name="type" value="pdf" class="btn btn-info btn-block">Cetak</button>
               </form>
            <?php endforeach; ?>
               <hr>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
   $(".add-more").click(function(){ 
     var html = $(".copy").html();
     $(".after-add-more").after(html);
  });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove",function(){ 
        $(this).parents(".control-group").remove();
     });
   });
</script>
<?= $this->endSection() ?>