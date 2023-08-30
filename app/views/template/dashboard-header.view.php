<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= url('/') ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-info-circle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Siap SPP</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?= getPath() == '/' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= url('/') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider" />
      <?php if ($_SESSION['user']['role'] != 'siswa') : ?>
        <li class="nav-item <?= checkPath('/transaction') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= url('/transaction') ?>">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Entri Transaksi</span>
          </a>
        </li>
      <?php else : ?>
        <li class="nav-item <?= checkPath('/profile') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= url('/profile') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil Saya</span>
          </a>
        </li>
      <?php endif; ?>
      <?php if ($_SESSION['user']['role'] == 'admin') : ?>
        <li class="nav-item  <?= checkPath('/student') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= url('/student') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Siswa</span>
          </a>
        </li>
        <li class="nav-item <?= checkPath('/officer') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= url('/officer') ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Petugas</span>
          </a>
        </li>
      <?php endif ?>
      <?php if ($_SESSION['user']['role'] != 'siswa') : ?>
        <li class="nav-item <?= checkPath('/classes') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= url('/classes') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelas</span>
          </a>
        </li>
      <?php endif ?>
      <?php if ($_SESSION['user']['role'] == 'admin') : ?>
        <li class="nav-item <?= checkPath('/user') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= url('/user') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
          </a>
        </li>
        <li class="nav-item <?= checkPath('/payment') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= url('/payment') ?>">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Pembayaran</span>
          </a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item <?= checkPath('/report') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= url('/report') ?>">
            <i class="fas fa-fw fa-clipboard"></i>
            <span>Laporan</span>
          </a>
        </li>
      <?php endif ?>




      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['user']['nama'] ?></span>
                <img class="img-profile rounded-circle" src="<?= url('/img/undraw_profile.svg') ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>
        </nav>