<?php

class Student extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            return redirect('/auth', ['danger', 'Silahkan login terlebih dahulu!']);
        }
    }
    public function index()
    {
        if ($_SESSION['user']['role'] != 'admin') {
            return redirect('/');
        }
        $data['title'] = 'List Siswa';
        $data['kelas'] = $this->model('Kelas')->get();
        $data['pembayaran'] = $this->model('Pembayaran')->get();
        $data['siswa'] = $this->model('Siswa')->getPengguna();
        $this->view([
            'template/dashboard-header',
            'dashboard/student-index',
            'template/dashboard-footer',
        ], $data);
    }
    public function detail(string $id)
    {
        $data['title'] = 'Detail Siswa';
        $data['kelas'] = $this->model('Kelas')->get();
        $data['pembayaran'] = $this->model('Pembayaran')->get();
        $data['history'] = $this->model('Transaksi')->getSiswaHistory($id);
        $data['siswa'] = $this->model('Siswa')->getSingle('WHERE id = ' . $id, 'single');
        $this->view([
            'template/dashboard-header',
            'dashboard/student-detail',
            'template/dashboard-footer'
        ], $data);
    }

    // POST Method
    public function store()
    {
        if ($_SESSION['user']['role'] != 'admin') {
            return redirect('/');
        }
        $data = $_POST;
        $sameStudent = $this->model('Siswa')->get("WHERE nis = '{$data['nis']}' OR nisn = '{$data['nisn']}'");
        if ($sameStudent) {
            return back(['danger', 'NIS atau NISN sudah terdaftar!']);
        }
        $data['password'] = password_hash($data['nisn'], PASSWORD_DEFAULT);
        try {
            $this->model('Pengguna')->insert(['username' => $_POST['nis'], 'password' => $data['password'], 'role' => 'siswa']);
            $pengguna = $this->model('Pengguna')->getSingle('WHERE username = ' . $_POST['nis']);
            $data['pengguna_id'] = $pengguna['id'];
            $this->model('Siswa')->insert($data);
            return back(['success', 'Siswa baru berhasil ditambah']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
    public function update(string $id)
    {
        if ($_SESSION['user']['role'] != 'admin') {
            return redirect('/');
        }
        $data = $_POST;
        $data['id'] = $id;
        try {
            $this->model('Siswa')->update($data);
            return back(['success', 'Detail siswa berhasil diperbarui']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        if ($_SESSION['user']['role'] != 'admin') {
            return redirect('/');
        }
        try {
            $this->model('Pengguna')->delete($id);
            return back(['success', 'Siswa terpilih berhasil dihapus']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
}
