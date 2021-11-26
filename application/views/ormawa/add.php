<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Tambah Ormawa</h4>

        <div class="page-title-right">
          <a href="<?= base_url('ormawa') ?>" class="btn btn-light btn-sm waves-effect waves-light">
            <i class="bx bx-left-arrow mr-2"></i> Kembali
          </a>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="">
          <div class="card-body">
            <div class="font-size-16 p-3 text-center">
              <h5 class="">Masukkan Data Organisasi Mahasiswa E-voting</h5>
            </div>
              <div class="row gx-5 m-3">
                <div class="col-md-4 text-center">
                  <img src="https://www.clipartmax.com/png/middle/92-925246_window-cleaning-placeholder-icon-png.png" class="img_placeholder img-fluid img-thumbnail" style="max-height:200px!important" alt="">
                  <div class="my-3 text-center">
                    <!-- <button class="btn btn-success btn-sm">Upload Logo</button> -->
                    <input class="form-control" type="hidden" id="photo" value="" name="photo" onkeyup="change_image(this)">
                    <input type="file" class="photo_input" id="photo_input" accept="image/png, image/gif, image/jpeg" onchange="set_base64(this)" hidden />
                    <label for="photo_input" class="btn btn-success btn-sm shadow-0 my-3">Upload Logo</label>
                    <button type="button" class="btn btn-danger btn-sm d-none btn_hapus" onclick="hapus_gambar(this)">Hapus</button>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="form-group mb-3">
                    <label for="">Nama Ormawa</label>
                    <input type="text" class="form-control" name="nama_ormawa" id="nama_ormawa">
                  </div>

                  <div class="form-group mb-3">
                    <label for="">Fakultas</label>
                    <select class="form-control select2" name="fakultas_id" id="fakultas_id" data-placeholder="Pilih Fakultas">
                      <option value=""></option>
                      <?php foreach ($fakultas as $row): ?>
                        <option value="<?= $row['id'] ?>"><?= $row['nama_fakultas'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="form-group mb-3">
                    <label for="">Pengurus</label>
                    <select class="form-control select2" name="user_id" id="user_id" data-placeholder="Pilih Pengurus">
                      <option value=""></option>
                    </select>
                  </div>
                </div>
              </div>
          </div>

          <div class="card-footer">
            <div class="d-flex justify-content-end p-3">
              <button type="button" class="btn btn-outline-secondary me-2">Batal</button>
              <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  var fakultas_id = 0;

  $(document).ready(function() {
    $('form').submit(function(e) {
      e.preventDefault()
      $.LoadingOverlay("show");
      $.ajax({
        url: '<?= base_url("ormawa/add_proccess") ?>',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(response) {
          $.LoadingOverlay("hide");
          if (response.success) {
            swal.fire('Berhasil', response.msg, 'success').then(function() {
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


    $('#fakultas_id').change(function(e) {
      e.preventDefault()
      fakultas_id = $(this).val()
      get_users()
    })
    $('.select2').select2()
    get_users()
  });

  function get_users() {
    // $("#user_id").html('')
    $('#user_id').select2({
      ajax: {
        url: '<?= base_url($this->class.'/get_users '); ?>',
        dataType: 'json',
        type: 'POST',
        data: function(params) {
          var query = {
            search: params.term,
            fakultas_id: fakultas_id,
            page: params.page || 0
          }
          return query
        },
        processResults: function(data, params) {
          params.page = params.page || 0;

          return {
            results: data.results,
            pagination: {
              more: (params.page * 7) < data.count_filtered
            }
          };
        },
        placeholder: 'Pilih Pengurus',
        minimumInputLength: 0,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
      }
    });
  }

  function formatRepo(repo) {
    if (repo.loading) {
      return repo.text;
    }

    var $container = $(
      "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__title'></div>" +
      "</div>"
    );

    $container.find(".select2-result-repository__title").text(repo.text);

    return $container;
  }

  function formatRepoSelection(repo) {
    return repo.text;
  }

  function getBase64(file) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => resolve(reader.result);
      reader.onerror = error => reject(error);
    });
  }

  function set_base64(file) {
    getBase64(file.files[0]).then(
      function(data) {
        parent = $(file).parent()
        console.log("DATAAA", $(file).parent())
        $('.img_placeholder').attr('src', data)
        parent.find('.form-control').val(data)
        $('.btn_hapus').removeClass('d-none')
        // $('.img_placeholder').attr('src', data)
      }
    );
  }

  function change_image(file) {
    $('.img_placeholder').attr('src', $(file).val())
    $('.btn_hapus').removeClass('d-none')
  }

  function hapus_gambar(file) {
    parent = $(file).parent()
    $('.img_placeholder').attr('src', 'https://www.clipartmax.com/png/middle/92-925246_window-cleaning-placeholder-icon-png.png')
    $('.btn_hapus').addClass('d-none')
    parent.find('.form-control').val('')
  }
</script>