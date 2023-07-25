<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h1 class="h3 mb-4 text-gray-800">List Kelas</h1>
        <button data-toggle="modal" data-target="#formModal" class="btn btn-info" style="height: max-content;">Tambah Kelas</button>
    </div>
    <?php Flasher::flash() ?>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="my-0 font-weight-bold text-info">Detail Kelas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data['classes'])) : ?>
                            <?php foreach ($data['classes'] as $i => $kelas) : ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $kelas['nama'] ?></td>
                                    <td><?= $kelas['kompetensi_keahlian'] ?></td>
                                    <td class="d-flex">
                                        <a href="<?= url('/classes/detail/' . $kelas['id']) ?>" class="btn btn-warning mr-1"><i class="fas fa-info-circle"></i> Detail</a>
                                        <form action="<?= url('/classes/delete/' . $kelas['id']) ?>" onsubmit="return confirm('Menghapus data ini akan menghapus beberapa data serupa di tabel berbeda. Anda yakin ingin melanjutkan?')">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/classes/store') ?>" method="POST">
                    <div class="mb-3 flex-grow-1 mr-1">
                        <label for="nama" class="form-label">Nama Kelas</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3 flex-grow-1">
                        <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian</label>
                        <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control" required>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-info" type="submit">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>