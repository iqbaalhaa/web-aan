<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="card">
               <div class="card-header card-header-info">
                  <h4 class="card-title"><b>Form Edit Surat Keterangan Ahli Waris</b></h4>

               </div>
               <div class="card-body mx-5 my-3">
                  <form action="<?= base_url('admin/surat/update-skaw'); ?>" method="post">
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
                  <?php foreach ($surat as $data ) :
                     ?>
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
                        <label for="nik">NIK Alm/Almh</label>
                        <input type="text" id="nik" name="nik" value="<?= $dt['0']; ?>" class="form-control col-md-12" required style="font-size: 18px; box-shadow: 4px 4px 6px;">
                     </div>
                  </div>
                     <div class="row mt-2">
                        <div class="col-md-6">
                           <label for="nama">Nama Alm/Almh</label>
                           <input type="text" id="nama" name="nama" value="<?= $dt['1']; ?>" class="form-control col-md-12" required>
                        </div>
                     </div>
                  <div class="row mt-2">
                     <div class="col-md-3">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" id="jk" name="jk" value="<?= $dt['2']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-4">
                        <label for="tmpl">Tempat Lahir</label>
                        <input type="text" id="tmpl" name="tmpl" value="<?= $dt['3']; ?>" class="form-control col-md-12" required>
                     </div>
                     <div class="col-md-3">
                        <label for="tgll">Tanggal Lahir</label>
                        <input type="text" id="tgll" name="tgll" value="<?= $dt['4']; ?>" class="form-control col-md-6" required>
                     </div>
                     <div class="col-md-2">
                        <label for="agama">Agama</label>
                        <input type="text" id="agama" name="agama" value="<?= $dt['5']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <div class="row mt-2">
                     <div class="col-md-12">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="<?= $dt['6']; ?>" class="form-control col-md-12" required>
                     </div>
                  </div>
                  <h4 class="mt-4"><strong>KETERANGAN KEMATIAN & KELUARGA :</strong></h4>
                     <hr>
                  <div class="row mt-2">
                        <div class="col-md-3">
                           <label for="tglm">Tanggal Meninggal</label>
                           <input type="text" id="tglm" name="tglm" value="<?= $dt['7']; ?>" class="form-control col-md-12" required>
                        </div>
                        <div class="col-md-6">
                           <label for="tmpm">Tempat Meninggal</label>
                           <input type="text" id="tmpm" name="tmpm" value="<?= $dt['8']; ?>" class="form-control col-md-12" required>
                        </div>
                     </div>
                  <div class="row mt-2">
                        <div class="col-md-6">
                           <label for="keluarga">Nama Suami/Istri</label>
                           <input type="text" id="keluarga" name="keluarga" value="<?= $dt['9']; ?>" class="form-control col-md-12" required>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-2">
                           <label for="jaw">Jumlah Anak</label>
                           <input type="text" id="jaw" name="jaw" value="<?= $dt['10']; ?>" class="form-control col-md-12" required>
                        </div>
                     </div>
                  <?php endforeach; ?>
                  <div class="panel-body">
                     <h4 class="mt-4"><strong>DATA AHLI WARIS :</strong></h4>
                     <hr>
                     <div class="control-group after-add-more">
                        <table class="">
                           <tr>
                             <td width="20%">Nama</td>
                             <td width="7%">L/P</td>
                             <td width="25%">Tmp&tgl. Lahir</td>
                             <td width="25%">Alamat</td>
                             <td width="13%">Agama</td>
                             <td width="10%">SHDK</td>
                             <td></td>
                          </tr>
                          <?php $no=1; foreach ($waris as $r1 ) : ?>
                          <tr>
                           <input type="hidden" name="idaw[]" value="<?= $r1['id']; ?>">
                           <input type="hidden" name="kode_surataw[]" value="<?= $r1['kodeaw']; ?>">
                            <td width="20%"><input type="text" name="namaaw[]" value="<?= $r1['nm']; ?>" class="form-control"></td>
                            <td width="7%"><select name="jkaw[]" class="form-control">
                              <option value="<?= $r1['jk']; ?>"><?= $r1['jk']; ?></option>
                              <option>---</option>
                              <option value="L">L</option>
                              <option value="P">P</option>
                           </select></td>
                           <td width="25%"><input type="text" name="ttlaw[]" value="<?= $r1['ttl']; ?>" class="form-control"></td>
                           <td width="25%"><input type="text" name="alamataw[]" value="<?= $r1['alamat']; ?>" class="form-control"></td>
                           <td width="13%"><select name="agamaaw[]" class="form-control">
                              <option value="<?= $r1['agama']; ?>"><?= $r1['agama']; ?></option>
                              <option>---------</option>
                              <option value="Islam">Islam</option>
                              <option value="Katholik">Katholik</option>
                              <option value="Protestan">Protestan</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha">Budha</option>
                           </select></td>
                           <td width="10%"><select name="shdk[]" class="form-control">
                              <option value="<?= $r1['shdk']; ?>"><?= $r1['shdk']; ?></option>
                              <option>---------</option>
                              <option value="Suami">Suami</option>
                              <option value="Istri">Istri</option>
                              <option value="Anak">Anak</option>
                              <option value="Cucu">Cucu</option>
                           </select>
                        </td>
                        <td><button class="btn btn-success add-more" type="button"><i class="material-icons">add</i>
                        </button></td>
                     </tr>
                  <?php endforeach; ?>
                  </table>
               </div>
               <div class="copy invisible">
                 <div class="control-group">
                    <table class="">
                      <tr>
                        <input type="hidden" name="kode_surataw[]" value="<?= $data['kode_surat']; ?>">
                        <td width="20%"><input type="text" name="namaaw[]" class="form-control"></td>
                        <td width="7%"><select name="jkaw[]" class="form-control">
                           <option value="L">L</option>
                           <option value="P">P</option>
                        </select></td>
                        <td width="25%"><input type="text" name="ttlaw[]" class="form-control"></td>
                        <td width="25%"><input type="text" name="alamataw[]" class="form-control"></td>
                        <td width="13%"><select name="agamaaw[]" class="form-control">
                           <option value="Islam">Islam</option>
                           <option value="Katholik">Katholik</option>
                           <option value="Protestan">Protestan</option>
                           <option value="Hindu">Hindu</option>
                           <option value="Budha">Budha</option>
                        </select></td>
                        <td width="10%"><select name="shdk[]" class="form-control">
                           <option value="Suami">Suami</option>
                           <option value="Istri">Istri</option>
                           <option value="Anak">Anak</option>
                           <option value="Cucu">Cucu</option>
                        </select></td>
                        <td><button class="btn btn-danger remove" type="button"><i class="material-icons">remove</i></button></td>
                     </tr>
                  </table>
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