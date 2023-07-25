<div class="container-fluid">
  <?php Flasher::flash() ?>
  <h1 class="h3 mb-4 text-gray-800">Selamat datang, <?= $_SESSION['user']['nama'] ?></h1>
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Total Transaksi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['transaksi']['all'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Transaksi Minggu Ini</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['transaksi']['last_week'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Jumlah Petugas</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['jml_petugas']['jumlah_petugas'] ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr class="sidebar-divider">
  <h4 class="mb-4 text-gray-800">Murid yang belum bayar SPP: </h4>
  <video autoplay loop muted>
    <source src="<?= url('/video/acumalaka.mp4') ?>" type="video/mp4">
  </video>
</div>