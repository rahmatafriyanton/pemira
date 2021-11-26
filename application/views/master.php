<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>Dashboard | Pemira - Universitas Pembangunan Nasional Veteran Jakarta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Aplikasi Evoting UPNVJ" name="description" />
  <meta content="Themesbrand" name="author" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">

  <!-- DataTables -->
  <link href="<?= base_url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet"
    type="text/css" />
  <link href="<?= base_url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet"
    type="text/css" />
  <link rel="stylesheet" href="<?= base_url('assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') ?>">
  <!-- Sweet Alert-->
  <link href="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
  <!-- Daterangepicker -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/libs/select2/css/select2.min.css') ?>">
  <!-- Summernote -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

  <!-- Bootstrap Css -->
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />

  <!-- App Css-->
  <link href="<?= base_url() ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
  <!-- <link href="<?= base_url() ?>assets/css/custom.css" id="app-style" rel="stylesheet" type="text/css" /> -->

  <script src="<?= base_url() ?>assets/libs/jquery/jquery.min.js"></script>
  <style>
    body[data-layout="horizontal"][data-topbar="light"] .topnav .navbar-nav .nav-link {
      color: rgb(255, 255, 255);
    }
    body[data-layout="horizontal"][data-topbar="light"] .topnav .navbar-nav .nav-link:focus, 
    body[data-layout="horizontal"][data-topbar="light"] .topnav .navbar-nav .nav-link:hover,
    body[data-layout="horizontal"][data-topbar="light"] .topnav .navbar-nav .nav-link.active {
      color: #000 !important;
      text-shadow: none;
    }

  </style>
</head>


<body data-topbar="light" data-layout="horizontal">
  <div id="layout-wrapper">
    <?php $this->load->view('templates/topbar'); ?>
    <?php $this->load->view('templates/topnav'); ?>

    <div class="main-content">
      <div class="page-content">
        <?php $this->load->view($contents); ?>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <script>
                document.write(new Date().getFullYear())
              </script> © UPNVJ.
            </div>
            <div class="col-sm-6">
              <div class="text-sm-end d-none d-sm-block">
                Develop by Kelompok 9
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- END layout-wrapper -->



  <!-- JAVASCRIPT -->
  <script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/metismenu/metisMenu.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>

  <!-- Required datatable js -->
  <script src="<?= base_url('assets/libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/libs/datatables.net-select/js/dataTables.select.min.js') ?>"></script>
  <script src="<?= base_url('assets/libs/datatables.net-select-bs4/js/select.bootstrap4.min.js') ?>"></script>

  <!-- Form Mask -->
  <script src="<?= base_url('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') ?>"></script>
  <!-- Sweet Alerts js -->
  <script src="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
  <!-- Select2 -->
  <script src="<?= base_url('assets/libs/select2/js/select2.min.js') ?>"></script>
  <!-- jquery step -->
  <script src="<?= base_url('assets/libs/jquery-steps/build/jquery.steps.min.js') ?>"></script>

  <!-- Moment -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <!-- Daterangepicker -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <!-- Summernote -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  <!-- Loading Overlay -->
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>


  <script src="<?= base_url() ?>assets/js/app.js"></script>
</body>

</html>