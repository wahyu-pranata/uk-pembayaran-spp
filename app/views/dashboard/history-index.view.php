<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="h3 mb-4 text-gray-800">Profil Saya</h1>
            <div class="card mb-4">
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="pr-5 py-2">Nama</td>
                            <td><?= $data['siswa']['nama'] ?></td>
                        </tr>
                        <tr>
                            <td class="pr-5 py-2">NIS</td>
                            <td><?= $data['siswa']['nis'] ?></td>
                        </tr>
                        <tr>
                            <td class="pr-5 py-2">NISN</td>
                            <td><?= $data['siswa']['nisn'] ?></td>
                        </tr>
                        <tr>
                            <td class="pr-5 py-2">Alamat</td>
                            <td><?= $data['siswa']['alamat'] ?></td>
                        </tr>
                        <tr>
                            <td class="pr-5 py-2">Telepon</td>
                            <td><?= $data['siswa']['telepon'] ?></td>
                        </tr>
                        <tr>
                            <td class="pr-5 py-2">Kelas</td>
                            <td><?= $data['siswa']['kelas'] ?></td>
                        </tr>
                        <tr>
                            <td class="pr-5 py-2">Kompetensi Keahlian</td>
                            <td><?= $data['siswa']['kompetensi_keahlian'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <h2 class="h5 mb-4 text-gray-800">History Pembayaran</h2>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tahun</th>
                                <th>Bulan</th>
                                <th>Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['history'])) : ?>
                                <?php foreach ($data['history'] as $i => $history) : ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= $history['tahun_dibayar'] ?></td>
                                        <td><?= date("F", mktime(0, 0, 0, $history['bulan_dibayar'] + 1, 0, 2023)) ?></td>
                                        <td><?= date_format(date_create($history['tanggal_dibayar']), "d M Y") ?></td>
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
</div>
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Detail Siswa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/student/update/' . $data['siswa']['id']) ?>" method="POST">
                    <input type="hidden" name="pengguna_id" value="<?= $data['siswa']['pengguna_id'] ?>">
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 flex-grow-1 mr-1">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" name="nis" id="nis" class="form-control" maxlength="5" minlength="5" value="<?= $data['siswa']['nis'] ?>" required>
                        </div>
                        <div class="mb-3 flex-grow-1">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" name="nisn" id="nisn" class="form-control" maxlength="10" minlength="10" value="<?= $data['siswa']['nisn'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['siswa']['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Siswa</label>
                        <textarea name="alamat" id="alamat" id="alamat" class="form-control" required><?= $data['siswa']['alamat'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">No. Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" value="<?= $data['siswa']['telepon'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas_id" id="kelas" class="form-control">
                            <?php foreach ($data['kelas'] as $kelas) : ?>
                                <option value="<?= $kelas['id'] ?>" <?= $data['siswa']['kelas_id'] == $kelas['id'] ? 'selected' : '' ?>><?= $kelas['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="pembayaran" class="form-label">Pembayaran (Tahun Ajaran)</label>
                        <select name="pembayaran_id" id="pembayaran" class="form-control">
                            <?php foreach ($data['pembayaran'] as $pembayaran) : ?>
                                <option value="<?= $pembayaran['id'] ?>" <?= $data['siswa']['pembayaran_id'] == $pembayaran['id'] ? 'selected' : '' ?>><?= $pembayaran['tahun_ajaran'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Edit</button>
                </form>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bayarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bayar SPP</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('/transaction/store') ?>" method="POST">
                    <input type="hidden" name="siswa_id" value="<?= $data['siswa']['id'] ?>">
                    <input type="hidden" name="pembayaran_id" value="<?= $data['siswa']['pembayaran_id'] ?>">
                    <input type="hidden" name="petugas_id" value="<?= $_SESSION['user']['id'] ?>">
                    <div class="mb-3">
                        <label for="tahun">Tahun</label>
                        <select name="tahun_dibayar" id="tahun" class="form-control">
                            <option value="2021">2021</option>
                            <option value="2022">2021</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <select name="bulan_dibayar" id="bulan" class="form-control">
                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                <option value="<?= $i ?>"><?= date("F", mktime(0, 0, 0, $i + 1, 0, 0)) ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Bayar</button>
                </form>
                </form>
            </div>
        </div>
    </div>
</div>