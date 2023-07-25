<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <?php if ($data['kelas']) : ?>
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-4 text-gray-800">Detail Kelas</h1>
                    <div>
                        <button data-toggle="modal" data-target="#tambahModal" class="btn btn-info" style="height: max-content;">Tambah Siswa</button>
                        <button data-toggle="modal" data-target="#formModal" class="btn btn-info" style="height: max-content;">Edit Detail</button>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td class="pr-5 py-2">Nama</td>
                                <td>: <?= $data['kelas']['nama'] ?></td>
                            </tr>
                            <tr>
                                <td class="pr-5 py-2">Kompetensi Keahlian</td>
                                <td>: <?= $data['kelas']['kompetensi_keahlian'] ?></td>
                            </tr>
                            <tr>
                                <td class="pr-5 py-2">Jumlah Siswa</td>
                                <td>: <?= $data['jml']['jumlah_siswa'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <h2 class="h5 mb-4 text-gray-800">Daftar Siswa</h2>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIS</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data['siswa'])) : ?>
                                    <?php foreach ($data['siswa'] as $i => $siswa) : ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $siswa['nis'] ?></td>
                                            <td><?= $siswa['nisn'] ?></td>
                                            <td><?= $siswa['nama'] ?></td>
                                            <td class="d-flex">
                                                <a href="<?= url('/student/detail/' . $siswa['id']) ?>" class="btn btn-warning mr-1"><i class="fas fa-info-circle"></i> Detail</a>
                                                <form action="<?= url('/student/delete/' . $siswa['pengguna_id']) ?>" onsubmit="return confirm('Menghapus data ini akan menghapus beberapa data serupa di tabel berbeda. Anda yakin ingin melanjutkan?')">
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
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/student/store') ?>" method="POST">
                    <input type="hidden" name="kelas_id" value="<?= $data['kelas']['id'] ?>">
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 flex-grow-1 mr-1">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" name="nisn" id="nisn" class="form-control" maxlength="10" minlength="10" required>
                        </div>
                        <div class="mb-3 flex-grow-1">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" name="nis" id="nis" class="form-control" maxlength="5" minlength="5" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Siswa</label>
                        <textarea name="alamat" id="alamat" id="alamat" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">No. Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pembayaran" class="form-label">Pembayaran (Tahun Ajaran)</label>
                        <select name="pembayaran_id" id="pembayaran" class="form-control">
                            <?php foreach ($data['pembayaran'] as $pembayaran) : ?>
                                <option value="<?= $pembayaran['id'] ?>"><?= $pembayaran['tahun_ajaran'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Detail Kelas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/classes/update/' . $data['kelas']['id']) ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $data['kelas']['id'] ?>">
                    <div class="mb-3 flex-grow-1 mr-1">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['kelas']['nama'] ?>" required>
                    </div>
                    <div class="mb-3 flex-grow-1">
                        <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian</label>
                        <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control" value="<?= $data['kelas']['kompetensi_keahlian'] ?>" required>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>