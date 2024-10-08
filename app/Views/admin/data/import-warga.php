<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <?php if (session()->getFlashdata('msg')) : ?>
            <div class="pb-2 px-3">
               <div class="alert alert-success">
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
                     <div class="col-md-6">
                        <div class="nav-tabs-wrapper">
                              <div class="col-md-6">
                                 <p class="d-inline"><b>Import Data Warga </b></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="container-fluid">
            <div class="col-md-12 mx-4 my-4">
            <form action="<?php echo base_url('admin/data/prosesExcel') ?>" id="form-upload-warga" method="post" autocomplete="off" enctype="multipart/form-data">
         
            <label>File Excel</label>
            <input type="file" name="fileexcel" class="form-control col-md-8" id="file" required accept=".xls, .xlsx" />
            <a href="<?= base_url('admin/data/download-format-warga'); ?>" class="btn btn-danger col-md-3" type="submit"><i class="material-icons">list</i>Download Format disini </a>
            <button class="btn btn-primary col-md-3" type="submit" id="btnUpload"><i class="material-icons">upload</i>Import</button>
            </form>
               <br>
               <div class="form-group">
                    <div class="text-center">
                        <div class="user-loader" style="display: none; ">
                            <a href="<?= base_url('admin/data/data-warga'); ?>"><i class="material-icons">people</i> &nbsp; Silahkan cek ...</a>
                        </div>
                    </div>
                </div>
            </div>
         </div>

         </div>
      </div>
   </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $("body").on("submit", "#form-upload-warga", function(e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('admin/data/prosesExcel') ?>",
                data: data,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    $("#btnUpload").prop('disabled', true);
                    $(".user-loader").show();
                }, 
                success: function(result) {
                    $("#btnUpload").prop('disabled', false);
                    if($.isEmptyObject(result.error_message)) {
                        $(".result").html(result.success_message);
                    } else {
                        $(".sub-result").html(result.error_message);
                    }
                    $(".user-loader").hide();
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>