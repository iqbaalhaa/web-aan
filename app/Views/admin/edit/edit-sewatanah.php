<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Input Pernyataan Sewa Tanah</b></h4>
               </div>
               <div class="card-body mx-5 my-3">
                  <form action="<?= base_url('admin/surat/update-sewatanah'); ?>" method="post">
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
<nav>
                <div class="row nav nav-tabs mt-4" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#Pihak1" role="tab" aria-controls="custom-nav-home" aria-selected="true"><b>PIHAK I</b></a>
                    <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#Pihak2" role="tab" aria-controls="custom-nav-profile" aria-selected="false"><b>PIHAK II</b></a>
                    <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#Tanah" role="tab" aria-controls="custom-nav-contact" aria-selected="false"><b>DATA TANAH</b></a>
                    <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#Saksi" role="tab" aria-controls="custom-nav-contact" aria-selected="false"><b>SAKSI</b></a>
                </div>
                </nav>
            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="Pihak1" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                  <h4 class="mt-4"><strong>IDENTITAS YANG MENYEWAKAN (PIHAK I): </strong></h4>
                  <hr>
                     <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik" value="<?= $dt[0]; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                     </div>
                     <div class="col-md-6">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?= $dt[1]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-2">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" id="jk" name="jk" value="<?= $dt[2]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label for="tmpl">Tempat Lahir</label>
                        <input type="text" id="tmpl" name="tmpl" value="<?= $dt[3]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="tgll">Tanggal Lahir</label>
                        <input type="text" id="tgll" name="tgll" value="<?= $dt[4]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="<?= $dt[5]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade show" id="Pihak2" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                  <h4 class="mt-4"><strong>IDENTITAS YANG MENERIMA SEWA (PIHAK II): </strong></h4>
                  <hr>
                     <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="niki">NIK</label>
                        <input type="text" id="niki" name="niki" value="<?= $dt[6]; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                     </div>
                     <div class="col-md-6">
                        <label for="namai">Nama</label>
                        <input type="text" id="namai" name="namai" value="<?= $dt[7]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-2">
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
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamati">Alamat</label>
                        <input type="text" id="alamati" name="alamati" value="<?= $dt[11]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade show" id="Tanah" role="tabpanel" aria-labelledby="custom-nav-home-tab">
               <h4 class="mt-4"><strong>DATA TANAH : </strong></h4>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="luas">Luas Tanah (M2)</label>
                        <input type="number" id="luas" name="luas" value="<?= $dt[12]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-9">
                        <label for="letak">Letak / Lokasi Tanah</label>
                        <input type="text" id="letak" name="letak" value="<?= $dt[13]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="masa">Lama Sewa (bulan)</label>
                        <input type="number" id="masa" name="masa" value="<?= $dt[14]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="nilai">Nilai Sewa </label>
                        <input type="text" id="nilai" name="nilai" value="<?= $dt[15]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  
               <h4 class="mt-4"><strong>BATAS - BATAS TANAH :</strong></h4>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="barat">Batas Barat</label>
                        <input type="text" id="barat" name="barat" value="<?= $dt[16]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="utara">Batas Utara</label>
                        <input type="text" id="utara" name="utara" value="<?= $dt[17]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="timur">Batas Timur</label>
                        <input type="text" id="timur" name="timur" value="<?= $dt[18]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="selatan">Batas Selatan</label>
                        <input type="text" id="selatan" name="selatan" value="<?= $dt[19]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade show" id="Saksi" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                  <h4 class="mt-4"><strong>SAKSI - SAKSI :</strong></h4>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="saksi1">Nama Saksi 1</label>
                        <input type="text" id="saksi1" name="saksi1" value="<?= $dt[20]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label for="saksi2">Nama Saksi 2</label>
                        <input type="text" id="saksi2" name="saksi2" value="<?= $dt[21]; ?>" class="form-control col-md-12" required>
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
            </div>
         </div>
      <?php endforeach; ?>
               <hr>
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