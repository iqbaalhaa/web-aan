<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Edit NA (N1-N5)</b></h4>
               </div>
               <div class="card-body mx-5 my-3">
                  <form action="<?= base_url('admin/surat/update-na'); ?>" method="post">
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
                    <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#Cs" role="tab" aria-controls="custom-nav-home" aria-selected="true"><b>CALON SUAMI</b></a>
                    <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#Ci" role="tab" aria-controls="custom-nav-profile" aria-selected="false"><b>CALON ISTRI</b></a>
                    <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#Ayah" role="tab" aria-controls="custom-nav-contact" aria-selected="false"><b>AYAH</b></a>
                    <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#Ibu" role="tab" aria-controls="custom-nav-contact" aria-selected="false"><b>IBU</b></a>
                    <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#Akad" role="tab" aria-controls="custom-nav-contact" aria-selected="false"><b>AKAD NIKAH</b></a>
                </div>
                </nav>
            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="Cs" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="nikcs">NIK Calon Suami</label>
                        <input type="text" id="nikcs" name="nikcs" value="<?= $dt[0]; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                     </div>
                 </div>
                 <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="namacs">Nama</label>
                        <input type="text" id="namacs" name="namacs" value="<?= $dt[1]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label for="bincs">Bin</label>
                        <input type="text" id="bincs" name="bincs" value="<?= $dt[2]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="jkcs">Jenis Kelamin</label>
                        <input type="text" id="jkcs" name="jkcs" value="<?= $dt[3]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label for="tmplcs">Tempat Lahir</label>
                        <input type="text" id="tmplcs" name="tmplcs" value="<?= $dt[4]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="tgllcs">Tanggal Lahir</label>
                        <input type="text" id="tgllcs" name="tgllcs" value="<?= $dt[5]; ?>"class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-2">
                        <label for="agamacs">Agama</label>
                        <input type="text" id="agamacs" name="agamacs" value="<?= $dt[7]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="kwngcs">Kewarganegaraan</label>
                        <input type="text" id="kwngcs" name="kwngcs" value="<?= $dt[6]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="kerjaancs">Pekerjaan</label>
                        <input type="text" id="kerjaancs" name="kerjaancs" value="<?= $dt[9]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="statuscs">Status Perkawinan</label>
                        <input type="text" id="statuscs" name="statuscs" value="<?= $dt[8]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamatcs">Alamat</label>
                        <input type="text" id="alamatcs" name="alamatcs" value="<?= $dt[10]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="statusnacs">Status NA</label>
                        <select id="statusnacs" name="statusnacs" onchange="if(this.value=='Numpang Nikah'){document.getElementById('statusnaci').value='Tuan Rumah'} else {document.getElementById('statusnaci').value='Numpang Nikah' };" class="form-control col-md-12" required>
                            <option value="<?= $dt[11]; ?>" selected><?= $dt[11]; ?></option>
                            <option value="Numpang Nikah">Numpang Nikah</option>
                            <option value="Tuan Rumah">Tuan Rumah</option>
                        </select>
                     </div>
                </div>
            </div>
            <div class="tab-pane fade" id="Ci" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="nikci">NIK Calon Istri</label>
                        <input type="text" id="nikci" name="nikci" value="<?= $dt[12]; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                     </div>
                 </div>
                 <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="namaci">Nama</label>
                        <input type="text" id="namaci" name="namaci" value="<?= $dt[13]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label for="bintici">Binti</label>
                        <input type="text" id="bintici" name="bintici" value="<?= $dt[14]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="jkci">Jenis Kelamin</label>
                        <input type="text" id="jkci" name="jkci" value="<?= $dt[15]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label for="tmplci">Tempat Lahir</label>
                        <input type="text" id="tmplci" name="tmplci" value="<?= $dt[16]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="tgllci">Tanggal Lahir</label>
                        <input type="text" id="tgllci" name="tgllci" value="<?= $dt[17]; ?>"class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-2">
                        <label for="agamaci">Agama</label>
                        <input type="text" id="agamaci" name="agamaci" value="<?= $dt[19]; ?>"class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="kwngci">Kewarganegaraan</label>
                        <input type="text" id="kwngci" name="kwngci" value="<?= $dt[18]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="kerjaanci">Pekerjaan</label>
                        <input type="text" id="kerjaanci" name="kerjaanci" value="<?= $dt[21]; ?>"class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="statusci">Status Perkawinan</label>
                        <input type="text" id="statusci" name="statusci" value="<?= $dt[20]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamatci">Alamat</label>
                        <input type="text" id="alamatci" name="alamatci" value="<?= $dt[22]; ?>"class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="statusnaci">Status NA</label>
                        <input type="text" id="statusnaci" name="statusnaci" value="<?= $dt[23]; ?>" class="form-control col-md-12" required readonly>
                     </div>
                </div>
            </div>
            <div class="tab-pane fade" id="Ayah" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="nika">NIK Ayah</label>
                        <input type="text" id="nika" name="nika" value="<?= $dt[24]; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                        <small>NIK Ayah dari Calon Suami atau Istri yang berstatus <b>Tuan Rumah</b></small>
                     </div>
                 </div>
                 <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="namaa">Nama</label>
                        <input type="text" id="namaa" name="namaa" value="<?= $dt[25]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label for="bina">Bin</label>
                        <input type="text" id="bina" name="bina" value="<?= $dt[26]; ?>"class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="jka">Jenis Kelamin</label>
                        <input type="text" id="jka" name="jka" value="<?= $dt[27]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label for="tmpla">Tempat Lahir</label>
                        <input type="text" id="tmpla" name="tmpla" value="<?= $dt[28]; ?>"class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="tglla">Tanggal Lahir</label>
                        <input type="text" id="tglla" name="tglla" value="<?= $dt[29]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-2">
                        <label for="agamaa">Agama</label>
                        <input type="text" id="agamaa" name="agamaa" value="<?= $dt[31]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="kwnga">Kewarganegaraan</label>
                        <input type="text" id="kwnga" name="kwnga" value="<?= $dt[30]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="kerjaana">Pekerjaan</label>
                        <input type="text" id="kerjaana" name="kerjaana" value="<?= $dt[32]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamata">Alamat</label>
                        <input type="text" id="alamata" name="alamata" value="<?= $dt[33]; ?>"class="form-control col-md-12" required>
                     </div>
                  </div>
            </div>
            <div class="tab-pane fade" id="Ibu" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="niki">NIK Ibu</label>
                        <input type="text" id="niki" name="niki" value="<?= $dt[34]; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                        <small>NIK Ibu dari Calon Suami atau Istri yang berstatus <b>Tuan Rumah</b></small>
                     </div>
                 </div>
                 <div class="row mt-2">
                     <div class="col-md-6">
                        <label for="namai">Nama</label>
                        <input type="text" id="namai" name="namai" value="<?= $dt[35]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label for="bintii">Binti</label>
                        <input type="text" id="bintii" name="bintii" value="<?= $dt[36]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="jki">Jenis Kelamin</label>
                        <input type="text" id="jki" name="jki" value="<?= $dt[37]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label for="tmpli">Tempat Lahir</label>
                        <input type="text" id="tmpli" name="tmpli" value="<?= $dt[38]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="tglli">Tanggal Lahir</label>
                        <input type="text" id="tglli" name="tglli" value="<?= $dt[39]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-2">
                        <label for="agamai">Agama</label>
                        <input type="text" id="agamai" name="agamai" value="<?= $dt[41]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-3">
                        <label for="kwngi">Kewarganegaraan</label>
                        <input type="text" id="kwngi" name="kwngi" value="<?= $dt[40]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="kerjaani">Pekerjaan</label>
                        <input type="text" id="kerjaani" name="kerjaani" value="<?= $dt[42]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamati">Alamat</label>
                        <input type="text" id="alamati" name="alamati" value="<?= $dt[43]; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
            </div>
            <div class="tab-pane fade" id="Akad" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                <div class="row mt-2">
                    <div class="col-md-4">
                           <label for="hari">Hari</label>
                           <select id="hari" name="hari" class="form-control col-md-12" required>
                           <option value="<?= $dt[44]; ?>" selected><?= $dt[44]; ?></option>
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
                           <input type="date" id="tgl" name="tgl" value="<?= $dt[45]; ?>" class="form-control col-md-12" required>
                        </div>
                        <div class="col-md-4">
                           <label for="waktu">Waktu</label>
                           <input type="time" id="waktu" name="waktu" value="<?= $dt[46]; ?>" class="form-control col-md-8" required><small>AM = 00:00 - 11:59 (Siang), <br>PM = 12:00 - 23:59 (Malam)</small>
                        </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="tmpakad">Tempat Akad Nikah</label>
                        <input type="text" id="tmpakad" name="tmpakad" value="<?= $dt[47]; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-6">
                        <label for="maskawin">Maskawin</label>
                        <input type="text" id="maskawin" name="maskawin" value="<?= $dt[48]; ?>" class="form-control col-md-12" required>
                     </div>
                 </div>

                 <br>
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
           <?php endforeach; ?>
                </div>
               <hr>
            </div>
         </div>
      </div>
   </div>
</div>

<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize
     $( "#nikcs" ).autocomplete({

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
           $('#nikcs').val(ui.item.label); // display the selected text
           $('#namacs').val(ui.item.nama); // save selected id to input
           $('#jkcs').val(ui.item.jk); // save selected id to input
           $('#tmplcs').val(ui.item.tmpl); // save selected id to input
           $('#tgllcs').val(ui.item.tgll); // save selected id to input
           $('#kwngcs').val(ui.item.kwng); // save selected id to input
           $('#agamacs').val(ui.item.agama); // save selected id to input
           $('#statuscs').val(ui.item.status); // save selected id to input
           $('#kerjaancs').val(ui.item.kerjaan); // save selected id to input
           $('#provcs').val(ui.item.prov); // save selected id to input
           $('#kabcs').val(ui.item.kab); // save selected id to input
           $('#keccs').val(ui.item.kec); // save selected id to input
           $('#desacs').val(ui.item.desa); // save selected id to input
           $('#alamatcs').val(ui.item.alamat); // save selected id to input
           return false;
        },
        focus: function(event, ui){
         $( "#nikcs" ).val( ui.item.label );
         $( "#namacs" ).val( ui.item.nama );
         $( "#jkcs" ).val( ui.item.jk );
         $( "#tmplcs" ).val( ui.item.tmpl );
         $( "#tgllcs" ).val( ui.item.tgll );
         $( "#kwngcs" ).val( ui.item.kwng );
         $( "#agamacs" ).val( ui.item.agama );
         $( "#statuscs" ).val( ui.item.status );
         $( "#kerjaancs" ).val( ui.item.kerjaan );
         $( "#provcs" ).val( ui.item.prov );
         $( "#kabcs" ).val( ui.item.kab );
         $( "#keccs" ).val( ui.item.kec );
         $( "#desacs" ).val( ui.item.desa );
         $( "#alamatcs" ).val( ui.item.alamat );
         return false;
      },
   }); 
  }); 
</script>
<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize
     $( "#nikci" ).autocomplete({

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
           $('#nikci').val(ui.item.label); // display the selected text
           $('#namaci').val(ui.item.nama); // save selected id to input
           $('#jkci').val(ui.item.jk); // save selected id to input
           $('#tmplci').val(ui.item.tmpl); // save selected id to input
           $('#tgllci').val(ui.item.tgll); // save selected id to input
           $('#kwngci').val(ui.item.kwng); // save selected id to input
           $('#agamaci').val(ui.item.agama); // save selected id to input
           $('#statusci').val(ui.item.status); // save selected id to input
           $('#kerjaanci').val(ui.item.kerjaan); // save selected id to input
           $('#provci').val(ui.item.prov); // save selected id to input
           $('#kabci').val(ui.item.kab); // save selected id to input
           $('#kecci').val(ui.item.kec); // save selected id to input
           $('#desaci').val(ui.item.desa); // save selected id to input
           $('#alamatci').val(ui.item.alamat); // save selected id to input
           return false;
        },
        focus: function(event, ui){
         $( "#nikci" ).val( ui.item.label );
         $( "#namaci" ).val( ui.item.nama );
         $( "#jkci" ).val( ui.item.jk );
         $( "#tmplci" ).val( ui.item.tmpl );
         $( "#tgllci" ).val( ui.item.tgll );
         $( "#kwngci" ).val( ui.item.kwng );
         $( "#agamaci" ).val( ui.item.agama );
         $( "#statusci" ).val( ui.item.status );
         $( "#kerjaanci" ).val( ui.item.kerjaan );
         $( "#provci" ).val( ui.item.prov );
         $( "#kabci" ).val( ui.item.kab );
         $( "#kecci" ).val( ui.item.kec );
         $( "#desaci" ).val( ui.item.desa );
         $( "#alamatci" ).val( ui.item.alamat );
         return false;
      },
   }); 
  }); 
</script> 
<script type='text/javascript'>
   $(document).ready(function(){
     // Initialize
     $( "#nika" ).autocomplete({

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
           $('#nika').val(ui.item.label); // display the selected text
           $('#namaa').val(ui.item.nama); // save selected id to input
           $('#jka').val(ui.item.jk); // save selected id to input
           $('#tmpla').val(ui.item.tmpl); // save selected id to input
           $('#tglla').val(ui.item.tgll); // save selected id to input
           $('#kwnga').val(ui.item.kwng); // save selected id to input
           $('#agamaa').val(ui.item.agama); // save selected id to input
           $('#statusa').val(ui.item.status); // save selected id to input
           $('#kerjaana').val(ui.item.kerjaan); // save selected id to input
           $('#prova').val(ui.item.prov); // save selected id to input
           $('#kaba').val(ui.item.kab); // save selected id to input
           $('#keca').val(ui.item.kec); // save selected id to input
           $('#desaa').val(ui.item.desa); // save selected id to input
           $('#alamata').val(ui.item.alamat); // save selected id to input
           return false;
        },
        focus: function(event, ui){
         $( "#nika" ).val( ui.item.label );
         $( "#namaa" ).val( ui.item.nama );
         $( "#jka" ).val( ui.item.jk );
         $( "#tmpla" ).val( ui.item.tmpl );
         $( "#tglla" ).val( ui.item.tgll );
         $( "#kwnga" ).val( ui.item.kwng );
         $( "#agamaa" ).val( ui.item.agama );
         $( "#statusa" ).val( ui.item.status );
         $( "#kerjaana" ).val( ui.item.kerjaan );
         $( "#prova" ).val( ui.item.prov );
         $( "#kaba" ).val( ui.item.kab );
         $( "#keca" ).val( ui.item.kec );
         $( "#desaa" ).val( ui.item.desa );
         $( "#alamata" ).val( ui.item.alamat );
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