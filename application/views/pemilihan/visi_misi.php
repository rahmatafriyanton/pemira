<div class="row">
  <div class="col-md-12">
    <div class="card text-center">
      <div class="card-body pb-0">
        <div class="card border shadow-none card-body">
          <div class="row">
            <?php foreach ($peserta as $value): ?>
            <div class="col-md-6">
              <div class="mb-4">
                <?php if ($value['photo'] == '' || $value['photo'] == null): ?>
                <img class="rounded-circle avatar-sm" src="https://www.clipartmax.com/png/middle/92-925246_window-cleaning-placeholder-icon-png.png" alt="">
                <?php else: ?>
                <img class="rounded-circle avatar-sm" src="<?= base_url($value['photo']) ?>" alt="">
                <?php endif ?>
              </div>
              <h5 class="font-size-15 mb-1"><a href="javascript: void(0);" class="text-dark"><?= $value['nama_lengkap'] ?></a></h5>
              <p class="text-muted">
                (<?= $value['nim'] ?>) <br>
                <?= $value['jurusan'].' - '.$value['fakultas'] ?>  
              </p>
            </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>

      <div class="card-body text-center">
        <?php if ($visi_misi != null): ?>
          <h5 class="card-title">Visi</h5>
          <div class="mb-3"><?= $visi_misi[0]['visi'] ?></div>

          <h5 class="card-title">Misi</h5>
          <div class="mb-3"><?= $visi_misi[0]['misi'] ?></div>
        <?php else: ?>
          <div class="alert alert-info" role="alert">
            Visi & Misi Calon Belum Tersedia
          </div>
        <?php endif ?>
      </div>
      
    </div>
  </div>
</div>

<div class="row">
  
</div>