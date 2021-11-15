<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>Dashboard | Pemira - Universitas Pembangunan Nasional Veteran Jakarta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Aplikasi Evoting UPNVJ" name="description" />
  <meta content="Themesbrand" name="author" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- Bootstrap Css -->
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="<?= base_url() ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
  <!-- <link href="<?= base_url() ?>assets/css/custom.css" id="app-style" rel="stylesheet" type="text/css" /> -->

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
  <script src="<?= base_url() ?>assets/libs/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/metismenu/metisMenu.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>


  <script src="<?= base_url() ?>assets/js/app.js"></script>
</body>

</html>