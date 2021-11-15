<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

        <div class="page-title-right">
          <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active">Beranda</li>
          </ol>
        </div>

      </div>
    </div>
  </div>
  <!-- end page title -->

  <div class="row">
    <div class="col-xl-4">
      <div class="card overflow-hidden">
        <div class="bg-primary bg-soft">
          <div class="row">
            <div class="offset-7 col-5 align-self-end">
              <img src="assets/images/profile-img.png" alt="" class="img-fluid">
            </div>
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="row">
            <?php var_dump($this->session->userdata()); ?>
            <div class="col-sm-4">
              <div class="avatar-md profile-user-wid mb-4">
                <img src="assets/images/users/avatar-2.jpg" alt="" class="img-thumbnail rounded-circle">
              </div>
              <h5 class="font-size-15 text-truncate"><?= $this->session->userdata('nama_lengkap'); ?></h5>
              <!-- <p class="text-muted mb-0 text-truncate">UI/UX Designer</p> -->
              <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">Lihat Profil</a>
            </div>

            <div class="col-sm-8">
              <div class="pt-4">

                <div class="row">
                  <div class="col-6">
                    <h5 class="font-size-15">125</h5>
                    <p class="text-muted mb-0">Pemilihan</p>
                  </div>
                  <div class="col-6">
                    <h5 class="font-size-15">50</h5>
                    <p class="text-muted mb-0">Suara</p>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col-xl-8">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">Acara Akan Datang</h4>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="align-middle">ID</th>
                  <th class="align-middle">Kegiatan</th>
                  <th class="align-middle">Tanggal</th>
                  <th class="align-middle">Peserta</th>
                  <th class="align-middle">Pemilih</th>
                  <th class="align-middle">Status</th>
                  <th class="align-middle">Detail</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2540</a> </td>
                  <td>Pemilihan Ketua BEM Universitas 2021</td>
                  <td>20 Oktober 2021</td>
                  <td>3</td>
                  <td>1054</td>
                  <td>
                    <span class="badge badge-pill badge-soft-info font-size-11">Belum Dibuka</span>
                  </td>
                  <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                      <i class="far fa-eye"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>

<!-- Modal -->
<div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transaction-detailModalLabel">Rincian Pemilihan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="mb-2">ID: <span class="text-primary">#SK2540</span></p>
        <p class="mb-4">Kegiatan: <span class="text-primary">Pemilihan Ketua BEM Universitas 2021</span></p>

        <div class="table-responsive">
          <table class="table align-middle table-nowrap">
            <thead>
              <tr>
                <th scope="col" width="5px">No Urut</th>
                <th scope="col" width="20%">Foto</th>
                <th scope="col">Nama Lengkap</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>1</th>
                <th scope="row">
                  <div>
                    <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-sm">
                  </div>
                </th>
                <td>
                  <div>
                    <h5 class="text-truncate font-size-14">Daffa Rabbani</h5>
                  </div>
                </td>
              </tr>

              <tr>
                <th>2</th>
                <th scope="row">
                  <div>
                    <img src="assets/images/users/avatar-3.jpg" alt="" class="avatar-sm">
                  </div>
                </th>
                <td>
                  <div>
                    <h5 class="text-truncate font-size-14">Zaki</h5>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="alert alert-info" role="alert">
          Untuk informasi selengkapnya, klik <a href="">di sini!</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->