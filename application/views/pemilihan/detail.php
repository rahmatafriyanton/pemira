<?php  $now = date('Y-m-d H:i:s'); ?>
<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18"><?= $data_pemilihan['nama_acara'] ?></h4>
        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Pemilihan</a></li>
            <li class="breadcrumb-item active"><?= $data_pemilihan['nama_acara'] ?></li>
          </ol>
        </div>
      </div>

    </div>
  </div>

  <div class="row">
    <?php if ($data_pemilihan['tanggal_selesai'] > $now && $data_pemilihan['tanggal_memilih'] != null): ?>
      <div class="col-md-12">
        <div class="card border shadow-none card-body">
          <div class="alert alert-info" role="alert">
            Anda sudah menggunakan hak suara pada pemilihan ini. Hasil akan tersedia segera setelah periode pemilihan selesai.
          </div>
        </div>
      </div>
    <?php endif ?>
    <?php foreach ($data_peserta as $key => $val): ?>
      <div class="col-md-6">
        <div class="card text-center">
          <div class="card-body">
            <div class="card border shadow-none card-body">
              <div class="row">
                <?php foreach ($val as $value): ?>
                  <div class="col-md-6">
                    <div class="mb-4">
                      <?php if ($value['photo'] == '' || $value['photo'] == null): ?>
                        <img class="rounded-circle avatar-sm" src="https://www.clipartmax.com/png/middle/92-925246_window-cleaning-placeholder-icon-png.png" alt="">
                      <?php else: ?>
                        <img class="rounded-circle avatar-sm" src="<?= base_url($value['photo']) ?>" alt="">
                      <?php endif ?>
                    </div>
                    <h5 class="font-size-15 mb-1"><a href="javascript: void(0);" class="text-dark"><?= $value['nama_lengkap'] ?></a></h5>
                    <p class="text-muted"><?= $value['jurusan'].' - '.$value['fakultas'] ?></p>
                  </div>
                <?php endforeach ?>
                
              </div>
            </div>

            <div>
              <?php if ($data_pemilihan['tanggal_mulai'] < $now && $data_pemilihan['tanggal_selesai'] > $now && $data_pemilihan['tanggal_memilih'] == null): ?>
                <a href="javascript: void(0);" class="btn btn-primary btn_pilih" data-peserta_id="<?= $data_peserta[$key][0]['peserta_id'] ?>" data-pemilihan_id="">
                  Pilih <i class="bx bx-edit-alt ms-2"></i>
                </a>
              <?php endif ?>

              <?php if ($data_pemilihan['tanggal_selesai'] < $now): 
                $params['pemilihan_id'] = $data_pemilihan['id'];
                $params['peserta_id'] = $data_peserta[$key][0]['peserta_id'];
                $hasil = $this->pemilihan->get_hasil_pemilihan($params);
              ?>
               <h1 class="display-6"><?= number_format((float)($hasil / $total_pemilih) * 100, 2, '.', ''); ?>%</h1>
               <div class="text-muted">
                <?= $hasil.' dari '.$total_pemilih.' suara' ?>
              </div>
              <?php endif ?>
            </div>
          </div>
          <div class="card-footer bg-transparent border-top">
            <div class="contact-links d-flex font-size-20">
              <div class="flex-fill">
                <a class="visi_misi" href="javascript: void(0);" data-pemilihan_id="<?= $data_pemilihan['id'] ?>" data-peserta_id="<?= $data_peserta[$key][0]['peserta_id'] ?>"><i class="bx bx-message-square-dots"></i></a>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>

<div class="modal fade" id="modalPemilihan" tabindex="-1" aria-labelledby="modalPemilihanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-4">
          <div class="avatar-md mx-auto mb-4">
            <div class="avatar-title bg-light rounded-circle text-primary h1">
              <i class="bx bx-info-circle"></i>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-xl-10">
              <h4 class="text-primary">Apakah kamu yakin?</h4>
              <p class="text-muted font-size-14 mb-4">
                Setelah pilihan terkirim kamu tidak dapat melakukan perubahan. <br><br>
                <b>Masukkan token untuk konfirmasi</b>
              </p>


              <form action="" id="form_pemilihan">
                <div class="input-group bg-light rounded">
                  <input type="hidden" name="peserta_id" id="peserta_id" value="">
                  <input type="hidden" name="pemilihan_id" id="pemilihan_id" value="<?= $data_pemilihan['id'] ?>">
                  <input type="text" name="token" id="token" class="form-control bg-transparent border-0" aria-describedby="button-addon2" placeholder="Ex: xxxxxx">

                  <button class="btn btn-primary" type="submit" id="button-addon2">
                    <i class="bx bx-edit-alt"></i>
                  </button>

                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 

<div class="modal fade" id="modalVisiMisi" tabindex="-1" aria-labelledby="modalVisiMisiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title"><i class="bx bx-info-circle  me-2"></i>Visi & Misi Calon</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="visi_misi_container">
       
      </div>
    </div>
  </div>
</div>  

<script>
  $(document).ready(function() {
    var peserta_id = ''
    var pemilihan_id = ''
    $('#form_pemilihan').submit(function(e) {
      e.preventDefault()
      $.ajax({
        url: '<?= base_url("pemilihan/proses_pemilihan") ?>',
        type: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
          $.LoadingOverlay("hide");
          if (response.success == true) {
            $('.invalid-feedback').remove();
            $('.form-control').removeClass('is-invalid')
              .removeClass('is-valid')
              .addClass('is-valid')

            swal.fire('Berhasil', 'Pemilihan berhasil!', 'success').then(function() {
              location.reload()
            })
          } else if (response.alert == false && response.success == false) {
            $.each(response.message, function(key, value) {
              var element = $('#' + key);
              element.parent()
                .find('.invalid-feedback').remove();
              element.removeClass('is-invalid')
                .removeClass('is-valid')
                .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
              element.parent().append(value);
            })
          } else {
            swal.fire('Gagal', response.message, 'error')
          }
        }
      })
    }) 

    $('.visi_misi').click(function(e) {
      e.preventDefault()
      peserta_id = $(this).data('peserta_id')
      pemilihan_id = $(this).data('pemilihan_id')
      get_visi_misi()
      $('#modalVisiMisi').modal('show')
    })

    function get_visi_misi() {
      $.ajax({
        url: '<?= base_url("pemilihan/get_visi_misi") ?>',
        type: 'post',
        data: {
          peserta_id: peserta_id,
          pemilihan_id: pemilihan_id
        },
        success: function(html) {
          $('#visi_misi_container').html(html);
        }
      })
    }

    $('.btn_pilih').click(function(e) {
      e.preventDefault()
      $('.invalid-feedback').remove();
      $('.form-control').removeClass('is-invalid').removeClass('is-valid')
      $('#form_pemilihan')[0].reset();
      $('#peserta_id').val($(this).data('peserta_id'))
      $('#modalPemilihan').modal('show')

    });
  });
</script>