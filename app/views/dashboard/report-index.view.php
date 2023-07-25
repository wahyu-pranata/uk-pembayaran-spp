<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Buat Laporan</h1>
    <?php Flasher::flash() ?>
    <form action="<?= url('/report/search') ?>" class="mb-4 d-flex align-items-end" method="POST">
        <div class="flex-grow-1 mr-1">
            <label for="date_from">Dari Tanggal</label>
            <input type="date" name="date_from" id="date_from" class="form-control" required>
        </div>
        <div class="flex-grow-1 mr-1">
            <label for="date_until">Sampai Tanggal</label>
            <input type="date" name="date_until" id="date_until" class="form-control" required>
        </div>
        <div>
            <button type="submit" class="btn btn-info px-3">Buat</button>
        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Siswa</th>
                        <th>Bulan Bayar / Tahun Bayar</th>
                        <th>Petugas</th>
                        <th>Pembayaran Tahun Ajaran</th>
                        <th>Nominal</th>
                        <th>Tanggal Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data['report'])) : ?>
                        <?php foreach ($data['report'] as $i => $report) : ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= $report['nama_siswa'] ?></td>
                                <td><?= date("F", mktime(0, 0, 0, $report['bulan_dibayar'] + 1, 0, 2023)) ?> / <?= $report['tahun_dibayar'] ?></td>
                                <td><?= $report['nama_petugas'] ?></td>
                                <td><?= $report['tahun_ajaran'] ?></td>
                                <td><?= $report['nominal'] ?></td>
                                <td><?= date_format(date_create($report['tanggal_dibayar']), "d M Y") ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center">No data available (＾• ω •＾)</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>