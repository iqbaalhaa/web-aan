<?= $this->include('templates/inc') ?>
<?= $this->extend('templates/admin_page_layout') ?>
<?= $this->section('content') ?>
<div class="content">
    <div class="container-fluid">
        <!-- REKAP JUMLAH DATA -->
        <div class="row">

        <div class="card">
            <div class="card-header card-header-tabs card-header-info">
               <div class="nav-tabs-navigation">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="nav-tabs-wrapper">
                              <div class="col-md-6">
                                 <p class="d-inline"><b>Data Permohonan Surat</b></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <div class="card-body table-responsive">
             <?php if (!$empty) : ?>
              <table id="bootstrap-data-table-export0" class="table table-hover">
               <thead class="text-primary">
                <th><b>No</b></th>
                <th><b>Tanggal</b></th>
                <th><b>Nama</b></th>
                <th><b>Nama Surat</b></th>
                <th><b>No. HP</b></th>
                <th><b>KTP/KK</b></th>
                <th><b>Foto</b></th>
                <th><b>Status</b></th>
                <th><b>Opsi</b></th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($permohonan as $value) : ?>
                 <tr>
                  <td><?= $i; ?></td>
                  <td><?= IndonesiaTgl($value['tgl']); ?></td>
                  <td><?= $value['nama']; ?><br><?= $value['nik']; ?></td>
                  <td><b><?= $value['nmsurat']; ?></b></td>
                  <td align="center"><a aria-label="Chat on WhatsApp" href="https://wa.me/<?= $value['hp']; ?>"><img alt="Chat on WhatsApp" src="<?= base_url('assets/img/wa.png'); ?>" style="width: 40px;" /></a></td>
                  <td><a href="<?= base_url('assets/permohonan/berkas/'.$value['berkas']); ?>"><img src="<?= base_url('assets/permohonan/berkas/'.$value['berkas']); ?>" style="width: 60px; height: auto; box-shadow: 1px 2px 3px; padding: 3px;"></a> </td>
                  <td><a href="<?= base_url('assets/permohonan/foto/'.$value['foto']); ?>"><img src="<?= base_url('assets/permohonan/foto/'.$value['foto']); ?>" style="width: 50px; height: auto; box-shadow: 1px 2px 3px; padding: 3px;"></a> </td>
                  <td><b><?= $value['status']; ?></b></td>
                  <td>

                   <a href="<?= base_url('admin/permohonan/aksi-permohonan/'. $value['idpermohonan']); ?>" type="button" class="btn btn-primary p-2" id="<?= $value['kode_surat']; ?>">
                    <i class="material-icons">keyboard</i></a>
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



<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export0').DataTable();
    } );
</script>
<?= $this->endSection() ?>