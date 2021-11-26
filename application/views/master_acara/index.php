<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Master Data Acara</h4>

        <div class="page-title-right">
          <a href="<?= base_url('master_acara/add') ?>" class="btn btn-primary btn-sm waves-effect waves-light">
            <i class="bx bx-plus mr-2"></i> Tambah
          </a>
        </div>

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
                  <th class="align-middle">Penanggung Jawab</th>
                  <th class="align-middle">Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;foreach ($master_pemilihan as $row): ?>
                  <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td>
                      <a href="<?= base_url('pemilihan/detail/').$row['id'] ?>"><?= $row['nama_acara'] ?></a><br>
                      <small><?= $row['nama_ormawa'] ?></small> 
                    </td>
                    <td><?= nice_date($row['tanggal_mulai'], 'd M Y H:i A').' s/d '.nice_date($row['tanggal_selesai'], 'd M Y H:i A') ?></td>
                    <td><?= $row['nama_fakultas'] ?></td>
                    <td><?= $row['nama_lengkap'] ?></td>
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