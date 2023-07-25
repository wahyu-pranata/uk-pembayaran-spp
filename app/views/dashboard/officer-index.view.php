<div class="container-fluid">
    <div class="d-flex flex-column align-items-end mb-4">
        <button data-toggle="modal" data-target="#formModal" class="btn btn-info" style="height: max-content;">Tambah Petugas</button>
    </div>
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="my-2 font-weight-bold text-info">List Petugas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['petugas'])) : ?>
                            <?php foreach ($data['petugas'] as $i => $petugas) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $petugas['username'] ?></td>
                                    <td><?= $petugas['nama'] ?></td>
                                    <td class="d-flex">
                                        <a href="<?= url('/officer/detail/' . $petugas['id']) ?>" class="btn btn-warning mr-1"><i class="fas fa-info-circle"></i> Detail</a>
                                        <form action="<?= url('/officer/delete/' . $petugas['pengguna_id']) ?>" onsubmit="return confirm('Menghapus data ini akan menghapus beberapa data serupa di tabel berbeda. Anda yakin ingin melanjutkan?')">
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">No data available (＾• ω •＾)</td>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/officer/store') ?>" method="POST">
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 flex-grow-1 mr-1">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="mb-3 flex-grow-1">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" name="password" id="password" class="form-control" required>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-info" type="submit">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>