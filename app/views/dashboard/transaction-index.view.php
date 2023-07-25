<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-4 text-gray-800">Entri Transaksi</h1>
        <!-- <button data-toggle="modal" data-target="#formModal" class="btn btn-info" style="height: max-content;">Entri Transaksi</button> -->
    </div>
    <?php Flasher::flash() ?>
    <form action="<?= url('/transaction/search') ?>" method="post" class="d-flex align-items-end mb-3">
        <div class="mr-1">
            <label for="nis">NIS</label>
            <input type="text" name="nis" id="nis" class="form-control" maxlength="5" required>
        </div>
        <div>
            <button type="submit" class="btn btn-outline-info">Cari</button>
        </div>
    </form>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Entri Transaksi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/transaction/store') ?>" method="POST">
                    <input type="hidden" name="petugas_id" value="<?= $_SESSION['user']['id'] ?>">
                    <input type="hidden" name="siswa_id" value="<?= $data['siswa']['id'] ?>">
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan_dibayar" id="bulan" class="form-control">
                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                <option value="<?= $i ?>"><?= date("F", mktime(0, 0, 0, $i + 1, 0, 0)) ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tahun">Tahun</label>
                        <select name="tahun_dibayar" id="tahun" class="form-control">
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-info" type="submit">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>