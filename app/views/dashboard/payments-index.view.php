<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-4 text-gray-800">List Pembayaran</h1>
        <div>
            <button data-toggle="modal" data-target="#formModal" class="btn btn-info">Tambah Pembayaran</button>
        </div>
    </div>
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="my-0 font-weight-bold text-info">List User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tahun Ajaran</th>
                            <th>Nominal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['payments'])) : ?>
                            <?php foreach ($data['payments'] as $i => $payment) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $payment['tahun_ajaran'] ?></td>
                                    <td><?= $payment['nominal'] ?></td>
                                    <td class="d-flex">
                                        <form action="<?= url('/payment/delete/' . $payment['id']) ?>" onsubmit="return confirm('Menghapus data ini akan menghapus beberapa data serupa di tabel berbeda. Anda yakin ingin melanjutkan?')">
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">Silahkan cari terlebih dahulu (＾• ω •＾)</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pembayaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/payment/store') ?>" method="POST">
                    <div class="mb-3 flex-grow-1 mr-1">
                        <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" maxlength="9" required>
                        <small><span class="text-danger">*</span> Format = 202x-202x</small>
                    </div>
                    <div class="mb-3 flex-grow-1">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="number" name="nominal" id="nominal" class="form-control" required>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-info" type="submit">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>