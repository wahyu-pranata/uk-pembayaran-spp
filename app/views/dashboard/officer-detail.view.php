<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <?php if ($data['petugas']) : ?>
                <div class="d-flex mb-4 justify-content-between">
                    <h1 class="h3 text-gray-800">Detail Petugas</h1>
                    <div>
                        <button data-toggle="modal" data-target="#resetModal" class="btn btn-info" style="height: max-content;">Reset Password</button>
                        <button data-toggle="modal" data-target="#formModal" class="btn btn-info" style="height: max-content;">Edit Detail</button>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="my-2 font-weight-bold text-info">Detail</h6>
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td class="pr-5 py-2">Nama</td>
                                <td>: <?= $data['petugas']['nama'] ?></td>
                            </tr>
                            <tr>
                                <td class="pr-5 py-2">Username</td>
                                <td>: <?= $data['petugas']['username'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php else : ?>
                <div class="card mb-4">
                    <div class="card-body">
                        Data doesn't exist (＾• ω •＾)
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Detail Petugas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/officer/update/' . $data['petugas']['id']) ?>" method="POST">
                    <input type="hidden" name="pengguna_id" value="<?= $data['petugas']['pengguna_id'] ?>">
                    <div class="mb-3 flex-grow-1 mr-1">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['petugas']['nama'] ?>" required>
                    </div>
                    <div class="mb-3 flex-grow-1">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= $data['petugas']['username'] ?>" required>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password Petugas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/officer/reset/' . $data['petugas']['id']) ?>" method="POST">
                    <input type="hidden" name="pengguna_id" value="<?= $data['petugas']['pengguna_id'] ?>">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password-confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password-confirmation" id="password-confirmation" class="form-control" required>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Tambah</button>
                </form>
                </form>
            </div>
        </div>
    </div>
</div>