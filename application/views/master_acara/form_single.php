<?php $id_paslon = strtolower(random_string('alpha', 16)); ?>
<div class="card border shadow-none card-body pb-0" id="paslon_<?= $id_paslon ?>">
  <div class="col-md-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
      <h5 class="font-size-14 mb-3">Data Paslon</h5>

      <div class="page-title-right">
        <button class="btn btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?= $id_paslon ?>" aria-expanded="false" aria-controls="collapse">Collapse</button>
      </div>

    </div>
  </div>
  
  <div class="row" id="collapse_<?= $id_paslon ?>" class="collapse hide">
    <div class="col-md-6">
      <div class="card border shadow-none card-body">
        <h5 class="font-size-12 text-warning"><i>*) Data Calon Ketua</i></h5>

        <div class="form-group mb-3">
          <label for="">NIM</label>
          <input type="text" class="form-control nim" name="peserta[ketua][nim][]" placeholder="ex: 0000000000000" required>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="" for="">Nama Lengkap</label>
              <input type="text" class="form-control nama_lengkap" name="peserta[ketua][nama_lengkap][]" placeholder="" readonly required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="">Email</label>
              <input type="text" class="form-control email" name="peserta[ketua][email][]" placeholder="" readonly required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="">Fakultas</label>
              <input type="text" class="form-control fakultas" name="peserta[ketua][fakultas][]" placeholder="" readonly required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="">Jurusan</label>
              <input type="text" class="form-control jurusan" name="peserta[ketua][jurusan][]" placeholder="" readonly required>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card border shadow-none card-body">
        <h5 class="font-size-12 text-warning"><i>*) Data Calon Wakil Ketua</i></h5>

        <div class="form-group mb-3">
          <label for="">NIM</label>
          <input type="text" class="form-control nim" name="peserta[wakil_ketua][nim][]" placeholder="ex: 0000000000000" required>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="" for="">Nama Lengkap</label>
              <input type="text" class="form-control nama_lengkap" name="peserta[wakil_ketua][nama_lengkap][]" placeholder="" readonly required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="">Email</label>
              <input type="text" class="form-control email" name="peserta[wakil_ketua][email][]" placeholder="" readonly required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="">Fakultas</label>
              <input type="text" class="form-control fakultas" name="peserta[wakil_ketua][fakultas][]" placeholder="" readonly required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label for="">Jurusan</label>
              <input type="text" class="form-control jurusan" name="peserta[wakil_ketua][jurusan][]" placeholder="" readonly required>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 ">
      <button class="btn btn-danger mt-3 mt-lg-0 float-end mb-3 hapus_paslon" data-id_paslon="paslon_<?= $id_paslon ?>" type="button">Hapus Paslon</button>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.nim').keyup(function (e) {
      element = $(this)
      parent = $(this).parent().parent()
      parent.find('.nama_lengkap').val('')
      parent.find('.email').val('')
      parent.find('.fakultas').val('')
      parent.find('.jurusan').val('')
      parent = $(this).parent().parent()
      $.ajax({
        url: '<?= base_url("master_acara/get_data_calon") ?>',
        type: 'post',
        data: {
          nim: $(this).val(),
          fakultas_id: fakultas_id
        },
        dataType: 'json',
        success: function(response) {
          
          if (response.success) {
            element.parent().find('.invalid-feedback').remove();
            element.removeClass('is-invalid')
            data = response.data
            parent.find('.nama_lengkap').val(data.nama_lengkap)
            parent.find('.email').val(data.email)
            parent.find('.fakultas').val(data.nama_fakultas)
            parent.find('.jurusan').val(data.nama_jurusan)
            // alert(data.nama_lengkap)
          } else {
              element.parent()
                .find('.invalid-feedback').remove();
              element.removeClass('is-invalid')
                .removeClass('is-valid')
                .addClass(response.message.length > 0 ? 'is-invalid' : 'is-valid');
              element.parent().append(response.message);
          }
        }
      })
    })
  });
</script>
