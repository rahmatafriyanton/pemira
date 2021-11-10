<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>Login | Pemira - Universitas Pembangunan Nasional Veteran Jakartae</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico">

  <!-- Bootstrap Css -->
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="<?= base_url() ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
  <!-- Sweet Alert-->
   <link href="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
  <div class="account-pages my-5 pt-sm-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
              <div class="row">
                <div class="col-7">
                  <div class="text-primary p-4">
                    <h5 class="text-primary">Selamat Datang!</h5>
                    <p>Masuk untuk gunakan hak suaramu.</p>
                  </div>
                </div>
                <div class="col-5 align-self-end">
                  <img src="<?= base_url() ?>assets/images/profile-img.png" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="auth-logo">
                <a href="" class="auth-logo-light">
                  <div class="avatar-md profile-user-wid mb-4">
                    <span class="avatar-title rounded-circle bg-light">
                      <img src="<?= base_url() ?>assets/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                    </span>
                  </div>
                </a>

                <a href="" class="auth-logo-dark">
                  <div class="avatar-md profile-user-wid mb-4">
                    <span class="avatar-title rounded-circle bg-light">
                      <img src="<?= base_url() ?>assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                    </span>
                  </div>
                </a>
              </div>
              <div class="p-2">
                <form class="form-horizontal" action="" id="form">
                  <div class="alert alert-warning alert-login d-none" role="alert"></div>
                  <?php if ($this->session->flashdata('warning')): ?>
                    <div class="alert alert-warning" role="alert">
                      <?= $this->session->flashdata('warning') ?>
                    </div>
                  <?php endif ?>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Masukkan email">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group auth-pass-inputgroup">
                      <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" aria-label="Password" aria-describedby="password-addon">
                      <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                    </div>
                  </div>

                  <div class="mt-3 d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                  </div>

                  <div class="mt-4 text-center">
                    <h5 class="font-size-14 mb-3">Masuk Menggunakan</h5>

                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a href="<?= $login_button ?>" class="social-list-item bg-danger text-white border-danger">
                          <i class="mdi mdi-google"></i>
                        </a>
                      </li>
                    </ul>
                  </div>

                </form>
              </div>

            </div>
          </div>
          <div class="mt-5 text-center">

            <div>
               Pemira. Crafted with <i class="mdi mdi-heart text-danger"></i> by Kelompok 9</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- end account-pages -->

  <!-- JAVASCRIPT -->
  <script src="<?= base_url() ?>assets/libs/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/metismenu/metisMenu.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
  <script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
  <!-- Sweet Alerts js -->
  <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

  <!-- App js -->
  <script src="<?= base_url() ?>assets/js/app.js"></script>

  <script>
    $('#form').submit(function(e) {
      e.preventDefault();
      $.LoadingOverlay("show");
      var me = $(this);
      $.ajax({
        url: '<?= base_url("auth/auth_login") ?>',
        type: 'post',
        data: me.serialize(),
        dataType: 'json',
        success: function(response) {
          $.LoadingOverlay("hide");
          if (response.error != '' || response.error != null) {
            $('.alert-login').removeClass('d-none').text(response.error)
          } else {
            $('.alert-login').addClass('d-none').text('')
          }
          if (response.success == true) {
            $('.invalid-feedback').remove();
            $('.form-control').removeClass('is-invalid')
              .removeClass('is-valid')
              .addClass('is-valid')

            swal.fire('Berhasil', 'Proses login berhasil!', 'success').then(function() {
              window.location = response.redirect;
            })
          } else {
            $.each(response.message, function(key, value) {
              var element = $('#' + key);
              element.parent()
                .find('.invalid-feedback').remove();
              element.removeClass('is-invalid')
                .removeClass('is-valid')
                .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
              element.parent().append(value);
            })
          }
        }
      })
    })
  </script>
</body>

</html>