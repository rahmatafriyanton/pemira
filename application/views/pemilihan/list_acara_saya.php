<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Data Acara Saya</h4>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="table-list" class="table font-size-12 table-bordered table-nowrap align-middle text-wrap w-100 dataTable no-footer">
              <thead class="table-light text-center">
                <tr>
                  <th class="align-middle">#</th>
                  <th class="align-middle">Kegiatan</th>
                  <th class="align-middle" width="10%">Tanggal</th>
                  <th class="align-middle">Fakultas</th>
                  <th class="align-middle">Status</th>
                  <th class="align-middle">Kelengkapan Data</th>
                  <th class="align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;foreach ($master_pemilihan as $row): 
                  $now = date('Y-m-d H:i:s');
                  if ($row['tanggal_mulai'] < $now && $row['tanggal_selesai'] > $now) {
                    $status = "<span class='badge font-size-10 bg-success'>Berlangsung</span>";
                  } else if ($row['tanggal_mulai'] > $now) {
                    $status = "<span class='badge font-size-10 bg-info'>Belum Dibuka</span>";
                  } else if ($row['tanggal_selesai'] < $now) {
                    $status = "<span class='badge font-size-10 bg-danger'>Selesai</span>";
                  }

                  $params['peserta_id'] = $row['peserta_id'];
                  $params['pemilihan_id'] = $row['pemilihan_id'];
                  $visi_misi = $this->pemilihan->get_visi_misi($params);

                  if ($visi_misi == null || $row['photo'] == null || $row['photo'] == '') {
                    $status_lengkap = '<span class="badge bg-warning font-size-10">Belum Lengkap</span>';
                  } else {
                    $status_lengkap = '<span class="badge bg-success font-size-10">Lengkap</span>';
                  }

                ?>
                  <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td>
                      <a href="<?= base_url('pemilihan/detail/').$row['id'] ?>"><?= $row['nama_acara'] ?></a><br>
                      <small><?= $row['nama_ormawa'] ?></small> 
                    </td>
                    <td><?= nice_date($row['tanggal_mulai'], 'd M Y H:i A').' s/d '.nice_date($row['tanggal_selesai'], 'd M Y H:i A') ?></td>
                    <td><?= $row['nama_fakultas'] ?></td>
                    <td class="text-center">
                      <?= $status ?>
                    </td>
                    <td class="text-center">
                      <?= $status_lengkap ?>
                    </td>
                    <td class="text-center">
                      <button type="" class="btn btn-primary btn-sm btn_lengkapi_data" data-pemilihan_id="<?= $row['pemilihan_id'] ?>" data-peserta_id="<?= $row['peserta_id'] ?>">
                        <i class="bx bx-area font-size-16"></i>
                      </button>
                    </td>
                  </tr>   
                <?php $no++;endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalLengkapiData" tabindex="-1" aria-labelledby="modalLengkapiDataLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lengkapi Data Peserta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="form_lengkapi_data">
        
      </form>
    </div>
  </div>
</div>
<script>
  var pemilihan_id, peserta_id;
  $(document).ready(function() {
    $('#table-list').DataTable()

    $('#form_lengkapi_data').submit(function(e) {
      e.preventDefault()
      $.LoadingOverlay("show");
      $.ajax({
        url: '<?= base_url("pemilihan/proses_lengkapi_data") ?>',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(response) {
          $.LoadingOverlay("hide");
          if (response.success) {
            swal.fire('Berhasil', 'Lengkapi data berhasil', 'success').then(function() {
              location.reload()
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

    $('.btn_lengkapi_data').click(function(e) {
      e.preventDefault()
      pemilihan_id = $(this).data('pemilihan_id')
      peserta_id = $(this).data('peserta_id')
      $('#form_lengkapi_data').html('')
      get_form_paslon()
      $('#modalLengkapiData').modal('show')
    })

    function get_form_paslon() {
      $.ajax({
        url: '<?= base_url("pemilihan/get_form_lengkapi_data") ?>',
        type: 'post',
        data: {
          peserta_id: peserta_id,
          pemilihan_id: pemilihan_id
        },
        success: function(html) {
          $('#form_lengkapi_data').append(html);
        }
      })
    }
  });
</script>