<div class="topnav">
  <div class="container-fluid">
    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

      <div class="collapse navbar-collapse" id="topnav-menu-content">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link arrow-none" href="<?= base_url('dashboard') ?>" >
              <i class="bx bx-home-circle me-2"></i><span key="t-dashboards">Dashboard</span>
            </a>
          </li>

          <?php if (is_admin()): ?>
            <li class="nav-item">
              <a class="nav-link arrow-none" href="<?= base_url('ormawa') ?>" >
                <i class="bx bx-wrench me-2"></i><span key="t-ormawa">Manage Ormawa</span>
              </a>
            </li>
          <?php endif ?>

          <?php if (is_admin()): ?>
            <li class="nav-item">
              <a class="nav-link arrow-none" href="<?= base_url('master_acara') ?>" >
                <i class="bx bx-wrench me-2"></i><span key="t-master_acara">Master Acara</span>
              </a>
            </li>
          <?php endif ?>

          <?php if (is_user()): ?>
            <li class="nav-item">
              <a class="nav-link arrow-none" href="<?= base_url('pemilihan') ?>" >
                <i class="bx bx-wrench me-2"></i><span key="t-master_acara">Acara Pemilihan</span>
              </a>
            </li>
          <?php endif ?>

        </ul>
      </div>
    </nav>
  </div>
</div>

