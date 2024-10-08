<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Edit Surat Keterangan Pengantar Ternak</b></h4>
               </div>
               <div class="card-body mx-5 my-3">
                  <form action="<?= base_url('admin/surat/update-skt'); ?>" method="post">
                     <?= csrf_field() ?>
                     <?php $validation = \Config\Services::validation(); ?>
<?php foreach($surat as $data): ?>
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
                     <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="nik">NIK Pemohon</label>
                        <input type="text" id="nik" name="nik" value="<?= $dt['0']; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                     </div>
                  </div>
                     <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="nama">Nama Pemohon</label>
                        <input type="text" id="nama" name="nama" value="<?= $dt['1']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" id="jk" name="jk" value="<?= $dt['2']; ?>" class="form-control col-md-6" required>
                     </div>
                     <div class="col-md-6">
                        <label for="agama">Agama</label>
                        <input type="text" id="agama" name="agama" value="<?= $dt['3']; ?>" class="form-control col-md-6" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="<?= $dt['4']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <h4 class="mt-4"><strong>KETERANGAN TERNAK :</strong></h4>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-12">
                     <label for="nama_ternak">Nama Ternak</label>
                     <input type="text" id="nama_ternak" name="nama_ternak" value="<?= $dt['5']; ?>" class="form-control col-md-6" required><small>Contoh : Sapi atau Kambing</small>
                  </div>
               </div>
               <div class="row mt-2">
                     <div class="col-md-6">
                     <label for="jenis_ternak">Jenis Ternak</label>
                     <input type="text" id="jenis_ternak" name="jenis_ternak" value="<?= $dt['6']; ?>" class="form-control col-md-12" required>
                  </div>

                     <div class="col-md-6">
                     <label for="ciri_ternak">Ciri - ciri Ternak</label>
                     <input type="text" id="ciri_ternak" name="ciri_ternak" value="<?= $dt['7']; ?>" class="form-control col-md-12" required><small>Contoh : Warna Putih, Panjang Tanduk 15cm</small>
                  </div>
               </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                     <label for="asal">Asal Ternak</label>
                     <input type="text" id="asal" name="asal" value="<?= $dt['8']; ?>" class="form-control col-md-9" required>
                  </div>
               </div>
               <div class="row mt-2">
                     <div class="col-md-12">
                     <label for="tujuan">Tujuan Ternak </label>
                     <input type="text" id="tujuan" name="tujuan" value="<?= $dt['9']; ?>" class="form-control col-md-9" required>
                  </div>
               </div>
               <div class="row mt-2">
                     <div class="col-md-12">
                     <label for="plat">No. Plat Kendaraan</label>
                     <input type="text" id="plat" name="plat" value="<?= $dt['10']; ?>" class="form-control col-md-4" required>
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
<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize
     $( "#nik" ).autocomplete({

       source: function( request, response ) {

           // CSRF Hash
           var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
           var csrfHash = $('.txt_csrfname').val(); // CSRF hash

           // Fetch data
           $.ajax({
             url: "<?=site_url('admin/surat/getWarga')?>",
             type: 'post',
             dataType: "json",
             data: {
                search: request.term,
                 [csrfName]: csrfHash // CSRF Token
              },
              success: function( data ) {
                 // Update CSRF Token
                 $('.txt_csrfname').val(data.token);

                 response( data.data );
              }
           });
        },
        select: function (event, ui) {
           // Set selection
           $('#nik').val(ui.item.label); // display the selected text
           $('#nama').val(ui.item.nama); // save selected id to input
           $('#jk').val(ui.item.jk); // save selected id to input
           $('#tmpl').val(ui.item.tmpl); // save selected id to input
           $('#tgll').val(ui.item.tgll); // save selected id to input
           $('#kwng').val(ui.item.kwng); // save selected id to input
           $('#agama').val(ui.item.agama); // save selected id to input
           $('#status').val(ui.item.status); // save selected id to input
           $('#kerjaan').val(ui.item.kerjaan); // save selected id to input
           $('#prov').val(ui.item.prov); // save selected id to input
           $('#kab').val(ui.item.kab); // save selected id to input
           $('#kec').val(ui.item.kec); // save selected id to input
           $('#desa').val(ui.item.desa); // save selected id to input
           $('#alamat').val(ui.item.alamat); // save selected id to input
           return false;
        },
        focus: function(event, ui){
         $( "#nik" ).val( ui.item.label );
         $( "#nama" ).val( ui.item.nama );
         $( "#jk" ).val( ui.item.jk );
         $( "#tmpl" ).val( ui.item.tmpl );
         $( "#tgll" ).val( ui.item.tgll );
         $( "#kwng" ).val( ui.item.kwng );
         $( "#agama" ).val( ui.item.agama );
         $( "#status" ).val( ui.item.status );
         $( "#kerjaan" ).val( ui.item.kerjaan );
         $( "#prov" ).val( ui.item.prov );
         $( "#kab" ).val( ui.item.kab );
         $( "#kec" ).val( ui.item.kec );
         $( "#desa" ).val( ui.item.desa );
         $( "#alamat" ).val( ui.item.alamat );
         return false;
      },
   }); 
  }); 
</script> 
<?= $this->endSection() ?>