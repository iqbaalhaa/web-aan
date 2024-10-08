<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Input Surat Keterangan Tanah</b></h4>
               </div>
               <div class="card-body mx-5 my-3">
                  <form action="<?= base_url('admin/surat/create-sktanah'); ?>" method="post">
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
                  <?php foreach ($max as $maxval) : 
                     $kodesurat = $maxval;
                     $urutan = (int) substr($kodesurat, 2, 4);
                     $urutan++;

                     $huruf = "SR";
                     $kodesurat = $huruf . sprintf("%04s", $urutan);
                     $nourut = sprintf("%04s", $urutan);
                     ?>
                     
                     <div class="row mt-2">
                        <?php foreach ($jenis as $jn) : ?>
                        <div class="col-md-6">
                           <label for="no_surat">Kode Surat</label>
                           <input type="text" id="kode_surat" name="kode_surat" value="<?php echo $kodesurat; ?>" class="form-control col-md-6" required readonly style="font-size: 18px; box-shadow: 4px 4px 6px;">
                           <input type="hidden" id="user" name="user" value="<?= user()->toArray()['id']; ?>" class="form-control col-md-6" required>
                           <input type="hidden" id="nama_surat" name="nama_surat" value="<?= $jn['nama_surat']; ?>" class="form-control col-md-6" required>
                           <input type="hidden" id="kode_jenis" name="kode_jenis" value="<?= $jn['kode_jenis']; ?>" class="form-control col-md-6" required>
                        </div>
                        <div class="col-md-6">
                           <label for="no_surat">Nomor Surat</label>
                           <input type="text" id="no_surat" name="no_surat" value="<?= $jn['klasifikasi_surat']; ?>/<?php echo $nourut; ?>/<?php echo getRomawi(date('m'));?>/<?php echo date('Y'); ?>" class="form-control col-md-12" required readonly style="font-size: 18px; box-shadow: 4px 4px 6px;">
                        </div>
                     <?php endforeach; ?>
                      <?php endforeach; ?>
                  </div>

                  <h4 class="mt-4"><strong>DATA PEMILIK TANAH : </strong></h4>
                  <hr>
                     <div class="row mt-2">
                     <div class="col-md-6 mt-2">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                     </div>
                     <div class="col-md-6 mt-2">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-2">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" id="jk" name="jk" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="tmpl">Tempat Lahir</label>
                        <input type="text" id="tmpl" name="tmpl" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-2">
                        <label for="tgll">Tanggal Lahir</label>
                        <input type="text" id="tgll" name="tgll" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="kwng">Kewarganegaraan</label>
                        <input type="text" id="kwng" name="kwng" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-2">
                        <label for="agama">Agama</label>
                        <input type="text" id="agama" name="agama" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="kerjaan">Pekerjaan</label>
                        <input type="text" id="kerjaan" name="kerjaan" class="form-control col-md-6" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control col-md-12" required>
                     </div>
                  </div>
               <h4 class="mt-4"><strong>DATA TANAH : </strong></h4>
                  <hr>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="luas">Luas Tanah (M2)</label>
                        <input type="number" id="luas" name="luas" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-9">
                        <label for="letak">Letak / Lokasi Tanah</label>
                        <input type="text" id="letak" name="letak" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-8">
                        <label for="asal">Asal / Perolehan Tanah </label>
                        <input type="text" id="asal" name="asal" class="form-control col-md-12" required><small>Contoh : Pembelian dari Bpk. xxxx atau Warisan, dll</small>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="barat">Batas Barat</label>
                        <input type="text" id="barat" name="barat" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="utara">Batas Utara</label>
                        <input type="text" id="utara" name="utara" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="timur">Batas Timur</label>
                        <input type="text" id="timur" name="timur" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="selatan">Batas Selatan</label>
                        <input type="text" id="selatan" name="selatan" class="form-control col-md-12" required>
                     </div>
                  </div>
                  
                  <h4 class="mt-4"><strong>PENANDA TANGAN SURAT</strong></h4>
                  <hr>
                  <div class="form-group mt-2">
                     <label for="ttd">Penanda Tangan Surat : &nbsp;</label>
                     <select name="ttd" class="custom-select col-md-4" required >
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