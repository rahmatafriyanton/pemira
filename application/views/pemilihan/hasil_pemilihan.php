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
    <div class="col-md-12">
      <div class="card border shadow-none card-body">
        <div class="alert alert-info" role="alert">
          Anda sudah menggunakan hak suara pada pemilihan ini. Hasil akan tersedia segera setelah periode pemilihan selesai.
        </div>
      </div>
    </div>
    <?php foreach ($data_peserta as $key => $val): ?>
      <div class="col-md-6">
        <div class="card text-center">
          <div class="card-body">
            <div class="card border shadow-none card-body">
              <div class="row">
                <?php foreach ($val as $value): ?>
                  <div class="col-md-6">
                    <div class="mb-4">
                      <img class="rounded-circle avatar-sm" src="<?= base_url('assets/images/users/avatar-2.jpg') ?>" alt="">
                    </div>
                    <h5 class="font-size-15 mb-1"><a href="javascript: void(0);" class="text-dark"><?= $value['nama_lengkap'] ?></a></h5>
                    <p class="text-muted"><?= $value['jurusan'].' - '.$value['fakultas'] ?></p>
                  </div>
                <?php endforeach ?>
                
              </div>
            </div>

            <div>
              <?php $now = date('Y-m-d H:i:s'); if ($data_pemilihan['tanggal_mulai'] < $now && $data_pemilihan['tanggal_selesai'] > $now && $data_pemilihan['tanggal_memilih'] == null): ?>
                <a href="javascript: void(0);" class="btn btn-primary btn_pilih" data-peserta_id="<?= $data_peserta[$key][0]['peserta_id'] ?>" data-pemilihan_id="">
                  Pilih <i class="bx bx-edit-alt ms-2"></i>
                </a>
              <?php endif ?>


              <?php if ($data_pemilihan['tanggal_selesai'] < $now): ?>
               <h1 class="display-4">Display 4</h1>
              <?php endif ?>
            </div>
          </div>
          <div class="card-footer bg-transparent border-top">
            <div class="contact-links d-flex font-size-20">
              <div class="flex-fill">
                <!-- <a class="font-size-12" href="javascript: void(0);"><i class="bx bx-info-circle "></i> Visi & Misi</a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>
