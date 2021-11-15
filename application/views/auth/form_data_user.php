<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <title>Lengkapi Data | Pemira - Universitas Pembangunan Nasional Veteran Jakarta</title>
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
                    <h5 class="text-primary">SEDIKIT LAGI</h5>
                    <p>Lengkapi data sebelum mulai menggunakan.</p>
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
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" value="<?= $this->session->userdata('email'); ?>" name="email" id="email" placeholder="Masukkan Email" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="<?= $this->session->userdata('nama_lengkap'); ?>" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap" readonly>
                  </div>

                  <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" value="<?= $this->session->userdata('nim'); ?>" name="nim" id="nim" placeholder="Masukkan NIM">
                  </div>

                  <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label" name="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                      <option>Pilih Jenis Kelamin</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="jenjang" class="form-label" name="jenjang">Jenjang</label>
                    <select class="form-control" name="jenjang" id="jenjang">
                      <option>Pilih Jenjang</option>
                      <option value="D3">D3</option>
                      <option value="S1">S1</option>
                      <option value="S2">S2</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="fakultas_id" class="form-label">Fakultas</label>
                    <select class="form-control" name="fakultas_id" id="fakultas_id">
                      <option value="">Pilih Fakultas</option>
                      <?php foreach ($fakultas as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_fakultas'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="jurusan_id" class="form-label">Jurusan</label>
                    <select class="form-control" name="jurusan_id" id="jurusan_id">
                      <option value="">Pilih Jurusan</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group auth-pass-inputgroup">
                      <input type="password" name="password" class="form-control" placeholder="Masukkan password" id="password" aria-label="Password" aria-describedby="password-addon">
                      <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                    </div>
                  </div>               

                  <div class="mt-3 d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">Simpan</button>
                  </div>

                </form>
              </div>

            </div>
          </div>
          <div class="mt-5 text-center">

            <div>
              <p>© <script>
                  document.write(new Date().getFullYear())
                </script> Pemira. Crafted with <i class="mdi mdi-heart text-danger"></i> by Kelompok 9</p>
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
    var jenjang = '';
    var fakultas = ''
    $('#form').submit(function(e) {
      e.preventDefault();
      $.LoadingOverlay("show");
      var me = $(this);
      $.ajax({
        url: '<?= base_url("auth/set_user_data") ?>',
        type: 'post',
        data: me.serialize(),
        dataType: 'json',
        success: function(response) {
          $.LoadingOverlay("hide");
          if (response.success == true) {
            $('.invalid-feedback').remove();
            $('.form-control').removeClass('is-invalid')
              .removeClass('is-valid')
              .addClass('is-valid')

            swal.fire('Berhasil', 'Data Berhasil Disimpan!', 'success').then(function() {
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

    $(document).ready(function() {
      $('#jenjang').change(function (e) {
        e.preventDefault()
        jenjang = $(this).val()
      })

      $('#fakultas_id').change(function (e) {
        e.preventDefault()
        fakultas = $(this).val()
        get_jurusan()
      })
    });

    function get_jurusan() {
      $.LoadingOverlay("show");
      $.ajax({
        url: '<?= base_url("auth/get_jurusan") ?>',
        type: 'post',
        data: {
          jenjang: jenjang,
          fakultas_id: fakultas
        },
        dataType: 'json',
        success: function(response) {
          $.LoadingOverlay("hide");
          options = '';
          $.each(response.jurusan, function( key, value ) {
            console.log('Dataa', value['nama_jurusan'])
            // $("#jurusan_id").append(new Option(value['nama_jurusan'], value['id']));
            options += '<option value='+value['id']+'>'+value['nama_jurusan']+'</option>'

          });
          $('#jurusan_id').html(options)
        }
      })
    }
  </script>
</body>

</html>