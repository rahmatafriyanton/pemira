<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Tambah Acara</h4>

        <div class="page-title-right">
          <a href="<?= base_url('master_acara') ?>" class="btn btn-light btn-sm waves-effect waves-light">
            <i class="bx bx-left-arrow mr-2"></i> Kembali
          </a>
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form action="" id="form">
            <input type="hidden" name="fakultas_id" id="fakultas_id" value="8">
            <div id="wizard">
              <!-- Seller Details -->
              <h3>Detail Acara</h3>
              <section>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="">Nama Acara</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_acara" id="nama_acara" placeholder="Ex: Pemilihan Ketua BEM" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="">Organisasi Mahasiswa</label>
                  <div class="col-sm-10">
                    <select name="ormawa_id" id="ormawa_id" class="form-control select2" data-placeholder="Pilih Ormawa">
                      <option value=""></option>
                      <?php foreach ($ormawa as $row): ?>
                        <option value="<?= $row['id'] ?>" data-fakultas_id ="<?= $row['fakultas_id'] ?>"><?= $row['nama_ormawa'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label class="col-md-2 col-form-label">Tanggal</label>
                  <div class="col-md-10">
                    <input class="form-control tanggal" name="tanggal" type="text" value="" id="tanggal">
                  </div>
                </div>
              </section>

              <!-- Company Document -->
              <h3>Data Peserta</h3>
              <section>
                <div id="form_paslon">
                  <?php $this->load->view('master_acara/form_single'); ?>
                </div>    
                <button class="btn btn-success mt-3 mt-lg-0 tambah_paslon" type="button">Tambah Paslon</button>
              </section>

              <!-- Bank Details -->
              <h3>Data Pemilih</h3>
              <section>
                <div class="row mb-3">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-hover table-striped w-100" id="table_pemilih">
                        <thead class="table-light">
                          <tr>
                            <th><input type="checkbox" class="select_all_pemilih" value="1"></th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>NIM</th>
                            <th>Fakultas</th>
                            <th>Jurusan</th>
                            <th>Jenis Kelamin</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </section>

            </div>
          </form>

        </div>
        <!-- end card body -->
      </div>
      <!-- end card -->
    </div>
    <!-- end col -->
  </div>
</div>

<script>
  var fakultas_id = 8
  var data_pemilih = '';
  $(document).ready(function() {
    $('#form').on('submit', function(e) {
      e.preventDefault()
      $.LoadingOverlay("show");
      $.ajax({
        url: '<?= base_url("master_acara/add_proccess") ?>',
        type: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
          $.LoadingOverlay("hide");
          if (response.success) {
            swal.fire('Berhasil', response.msg, 'success').then(function() {
              window.location = response.redirect;
            })
          } else {
            swal.fire('Gagal', 'Lengkapi Semua Data', 'error')
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
    $(document).on('select2:select','#ormawa_id',function(data){
      // alert($(this).val())
      data = $(data.params.data.element)
      fakultas_id = data.data('fakultas_id')
      $('#fakultas_id').val(fakultas_id)

      init_data_pemilih()
    });

    $("#wizard").steps({
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slide",
      onFinishing: function (event, currentIndex) {
        $('#form').trigger('submit');
      }
    })
    
    
    $('.tanggal').daterangepicker({
      autoUpdateInput: false,
      showDropdowns: false,
      minYear: 1901,
      minDate : new Date(),
      timePicker: true,
      timePicker24Hour: true,
      drops: 'auto',
      applyButtonClasses: 'btn-primary',
      cancelButtonClasses: 'btn-light',
      locale: {
        format: 'YYYY-MM-DD HH:MM',
        cancelLabel: 'Batal',
        applyLabel: 'Pilih',
      }
    });

    $(document).on('click','.hapus_paslon',function(e) {
      e.preventDefault();
      $('#' + $(this).data('id_paslon')).remove()
    })

    $(document).on('click','.tambah_paslon',function(e) {
      e.preventDefault();
      get_form_paslon()
    })

    function get_form_paslon() {
      $.ajax({
        url: '<?= base_url("master_acara/get_form_paslon") ?>',
        type: 'post',
        success: function(html) {
          $('#form_paslon').append(html);
        }
      })
    }

    function init_data_pemilih() {
      $.ajax({
        url: '<?= base_url("master_acara/get_data_pemilih") ?>',
        type: 'post',
        async: false,
        data: {
          fakultas_id: fakultas_id
        },
        dataType: 'json',
        success: function(response) {
          data_pemilih = response.data
        }
      })
      $('#table_pemilih').DataTable().clear().destroy();
      var mytable = $('#table_pemilih').DataTable({
        data: data_pemilih,
        ordering: false,
        columns: [
            { data: 'checkbox' },
            { data: 'nama_lengkap' },
            { data: 'email' },
            { data: 'nim' },
            { data: 'nama_fakultas' },
            { data: 'nama_jurusan' },
            { data: 'jenis_kelamin' }
        ]
      }) 
    }

    $(document).on('change','.select_all_pemilih',function(e) {
      $('.data_pemilih').removeAttr('checked');
        var pemilih = $(".data_pemilih");
        pemilih.prop("checked", !pemilih.prop("checked"));
    })

    $(document).on('change','.data_pemilih',function(e) {
      if ($('.data_pemilih:checked').length == $('.data_pemilih').length) {
       $('.select_all_pemilih').prop('checked', 'checked')
      } else {
        $('.select_all_pemilih').prop('checked', '')
      }
   });

    $('.tanggal').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD HH:MM') + ' s/d ' + picker.endDate.format('YYYY-MM-DD HH:MM'));
    });
    $('.select2').select2()
  });

</script>
  