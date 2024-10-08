<?php foreach ($desa as $ds) : ?>

  <footer class="footer has-cards">


    <div class="container">
      <div class="row row-grid align-items-center my-md">
        <div class="col-lg-6">
          <h3 class="text-primary font-weight-light mb-2">Sekretariat : </h3>
          <h6 class="text-warning font-weight-light mb-2">Alamat : <?= $ds['alamat']; ?><br>Telp. : <?= $ds['telp']; ?><br>E-mail : <?= $ds['email']; ?></h6>

        </div>
        <!-- <div class="col-lg-6 text-lg-center btn-wrapper">
          <button target="_blank" href="#" rel="nofollow" class="btn btn-icon-only btn-twitter rounded-circle" data-toggle="tooltip" data-original-title="Follow us">
            <span class="btn-inner--icon"><i class="fa fa-twitter"></i></span>
          </button>
          <button target="_blank" href="#" rel="nofollow" class="btn-icon-only rounded-circle btn btn-facebook" data-toggle="tooltip" data-original-title="Like us">
            <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
          </button>
          <button target="_blank" href="#" rel="nofollow" class="btn btn-icon-only btn-dribbble rounded-circle" data-toggle="tooltip" data-original-title="Follow us">
            <span class="btn-inner--icon"><i class="fa fa-dribbble"></i></span>
          </button>
          <button target="_blank" href="#" rel="nofollow" class="btn btn-icon-only btn-github rounded-circle" data-toggle="tooltip" data-original-title="Star on Github">
            <span class="btn-inner--icon"><i class="fa fa-github"></i></span>
          </button>
        </div> -->
      </div>
      <hr>
      <div class="row align-items-center justify-content-md-between">
        <div class="col-md-6">
          <div class="copyright">
            &copy; 2023 <a href="" target="_blank">Mesy</a>.
          </div>
        </div>
        <!-- <div class="col-md-6">
          <ul class="nav nav-footer justify-content-end">
            <li class="nav-item">
              <a href="" class="nav-link" target="_blank">sdc</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link" target="_blank">License</a>
            </li>
          </ul>
        </div> -->
      </div>
    </div>

  </footer>
  </div>
<?php endforeach; ?>
<!--   Core JS Files   -->
<script src="<?= base_url('assets/assets-warga/js/core/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/assets-warga/js/core/popper.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/assets-warga/js/core/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/assets-warga/js/plugins/perfect-scrollbar.jquery.min.js'); ?>"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="<?= base_url('assets/assets-warga/js/plugins/bootstrap-switch.js'); ?>"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?= base_url('assets/assets-warga/js/plugins/nouislider.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/assets-warga/js/plugins/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/assets-warga/js/plugins/datetimepicker.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/assets-warga/js/plugins/bootstrap-datepicker.min.js'); ?>"></script>
<!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<script src="<?= base_url('assets/assets-warga/js/argon-design-system.min.js?v=1.2.2'); ?>" type="text/javascript"></script>
<!-- jQuery UI JS Auto Complete--
  <script src="<?= base_url('assets/js/core/jquery.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/jquery-ui.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
  -->