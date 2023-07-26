<?php

class Officer extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            return redirect('/auth', ['danger', 'Silahkan login terlebih dahulu!']);
        }
        if ($_SESSION['user']['role'] != 'admin') {
            return redirect('/');
        }
    }
    public function index()
    {
        $data['title'] = 'List Petugas';
        $data['petugas'] = $this->model('Petugas')->getPengguna("WHERE role = 'petugas'");
        $this->view([
            'template/dashboard-header',
            'dashboard/officer-index',
            'template/dashboard-footer',
        ], $data);
    }
    public function detail(string $id)
    {
        $data['title'] = 'Detail Petugas';
        $data['petugas'] = $this->model('Petugas')->getPengguna('WHERE id = ' . $id . ' AND role = "petugas"', 'single');
        $this->view([
            'template/dashboard-header',
            'dashboard/officer-detail',
            'template/dashboard-footer'
        ], $data);
    }

    // POST
    public function store()
    {
        $sameOfficer = $this->model('Petugas')->getPengguna("WHERE username = '{$_POST['username']}' OR nama = '{$_POST['nama']}' ");
        if ($sameOfficer) {
            return back(['danger', 'Nama/username petugas sudah terdaftar!']);
        }
        $data = [
            'username' => $_POST['username'],
            'nama' => $_POST['nama'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'role' => 'petugas'
        ];
        try {
            $this->model('Pengguna')->insert($data);
            $newPengguna = $this->model('Pengguna')->getSingle("WHERE username = '{$data['username']}'");
            $data['pengguna_id'] = $newPengguna['id'];
            $this->model('Petugas')->insert($data);
            return back(['success', 'Berhasil menambahkan petugas baru!']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
    public function update(string $id)
    {
        $data = $_POST;
        $data['id'] = $id;
        try {
            $this->model('Pengguna')->update($data);
            $this->model('Petugas')->update($data);
            return back(['success', 'Berhasil memperbarui petugas!']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
    public function reset(string $id)
    {
        $data = $_POST;
        try {
            if ($data['password'] == $data['password-confirmation']) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $this->model('Pengguna')->resetPassword($data);
                return back(['success', 'Password petugas berhasil direset!']);
            }
            return back(['danger', 'Konfirmasi password tidak sesuai']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
    public function delete(string $id)
    {
        try {
            $this->model('Pengguna')->delete($id);
            return back(['success', 'Petugas terpilih berhasil dihapus!']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
}
