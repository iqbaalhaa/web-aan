<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Edit Surat Keterangan Kematian</b></h4>
                  <!-- <p class="card-category">Angkatan 2022/2023</p> -->
               </div>
               <div class="card-body mx-5 my-3">
                  <form action="<?= base_url('admin/surat/update-skmati'); ?>" method="post">
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
                        <label for="nik">NIK Alm/Almh.</label>
                        <input type="text" id="nik" name="nik" value="<?= $dt[0]; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="nama">Nama Alm/Almh.</label>
                        <input type="text" id="nama" name="nama" value="<?= $dt[1]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label for="bin">Bin/Binti</label>
                        <input type="text" id="bin" name="bin" value="<?= $dt[2]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="jk">Jenis Kelamin Alm/Almh.</label>
                        <input type="text" id="jk" name="jk" value="<?= $dt[3]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="agama">Agama Alm/Almh.</label>
                        <input type="text" id="agama" name="agama" value="<?= $dt[4]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamat">Alamat Terakhir Alm/Almh.</label>
                        <input type="text" id="alamat" name="alamat" value="<?= $dt[5]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <br>
                  <h4><strong>KETERANGAN TANGGAL/WAKTU & SEBAB KEMATIAN </strong></h4>
                  <hr>
                     <div class="row mt-2">
                     <div class="col-md-6 mt-2">
                        <label for="sebab">Sebab</label>
                        <input type="text" id="sebab" name="sebab" value="<?= $dt[13]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-4">
                        <label for="hari">Hari</label>
                        <select id="hari" name="hari" class="form-control col-md-12" required>
                           <option value="<?= $dt[14]; ?>" selected ><?= $dt[14]; ?></option>
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
                        <label for="tanggal">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?= $dt[15]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label for="waktu">Waktu</label>
                        <input type="time" id="waktu" name="waktu" value="<?= $dt[16]; ?>" class="form-control col-md-12" required><small>AM = 00:00 - 11:59 (Siang), <br>PM = 12:00 - 23:59 (Malam)</small>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="tempat">Tempat</label>
                        <input type="text" id="tempat" name="tempat" value="<?= $dt[17]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                     </div>
                  </div>                  
                  <br>
                  <h4><strong>DATA PELAPOR</strong></h4>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="niki">NIK </label>
                        <input type="text" id="niki" name="niki" value="<?= $dt[6]; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="namai">Nama</label>
                        <input type="text" id="namai" name="namai" value="<?= $dt[7]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="jki">Jenis Kelamin</label>
                        <input type="text" id="jki" name="jki" value="<?= $dt[8]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label for="tmpli">Tempat Lahir</label>
                        <input type="text" id="tmpli" name="tmpli" value="<?= $dt[9]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="tglli">Tanggal Lahir</label>
                        <input type="text" id="tglli" name="tglli" value="<?= $dt[10]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-2">
                        <label for="agamai">Agama</label>
                        <input type="text" id="agamai" name="agamai" value="<?= $dt[11]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamati">Alamat</label>
                        <input type="text" id="alamati" name="alamati" value="<?= $dt[12]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="shdk">Hubungan Dengan Alm/Almh</label>
                        <select id="shdk" name="shdk" class="form-control col-md-6" required>
                           <option value="<?= $dt[18]; ?>" selected><?= $dt[18]; ?></option>
                           <option value="Orang tua">Orang tua</option>
                           <option value="Anak">Anak</option>
                           <option value="Suami">Suami</option>
                           <option value="Istri">Istri</option>
                           <option value="Famili lain">Famili lain</option>
                           <option value="Lainnya">Lainnya</option>
                        </select>
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
<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize
     $( "#niki" ).autocomplete({

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
           $('#niki').val(ui.item.label); // display the selected text
           $('#namai').val(ui.item.nama); // save selected id to input
           $('#jki').val(ui.item.jk); // save selected id to input
           $('#tmpli').val(ui.item.tmpl); // save selected id to input
           $('#tglli').val(ui.item.tgll); // save selected id to input
           $('#kwngi').val(ui.item.kwng); // save selected id to input
           $('#agamai').val(ui.item.agama); // save selected id to input
           $('#statusi').val(ui.item.status); // save selected id to input
           $('#kerjaani').val(ui.item.kerjaan); // save selected id to input
           $('#provi').val(ui.item.prov); // save selected id to input
           $('#kabi').val(ui.item.kab); // save selected id to input
           $('#keci').val(ui.item.kec); // save selected id to input
           $('#desai').val(ui.item.desa); // save selected id to input
           $('#alamati').val(ui.item.alamat); // save selected id to input
           return false;
        },
        focus: function(event, ui){
         $( "#niki" ).val( ui.item.label );
         $( "#namai" ).val( ui.item.nama );
         $( "#jki" ).val( ui.item.jk );
         $( "#tmpli" ).val( ui.item.tmpl );
         $( "#tglli" ).val( ui.item.tgll );
         $( "#kwngi" ).val( ui.item.kwng );
         $( "#agamai" ).val( ui.item.agama );
         $( "#statusi" ).val( ui.item.status );
         $( "#kerjaani" ).val( ui.item.kerjaan );
         $( "#provi" ).val( ui.item.prov );
         $( "#kabi" ).val( ui.item.kab );
         $( "#keci" ).val( ui.item.kec );
         $( "#desai" ).val( ui.item.desa );
         $( "#alamati" ).val( ui.item.alamat );
         return false;
      },
   }); 
  }); 
</script> 
<?= $this->endSection() ?>