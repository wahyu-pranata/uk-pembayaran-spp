<?php

class User extends Controller
{
    public function __construct()
    {
        if ($_SESSION['user']['role'] != 'admin') {
            return redirect('/');
        }
    }
    public function index(string $mode = '')
    {
        if ($mode == 'siswa') {
            $data['user'] = $this->model('Siswa')->get();
        } elseif ($mode == 'petugas') {
            $data['user'] = $this->model('Petugas')->getPengguna("WHERE role = 'petugas'", 'all');
        }
        $data['title'] = 'List User';
        $this->view([
            'template/dashboard-header',
            'dashboard/user-index',
            'template/dashboard-footer',
        ], $data);
    }
    public function search()
    {
        redirect('/user/' . $_POST['role']);
    }
    public function delete(string $id)
    {
        try {
            $this->model('Pengguna')->delete($id);
            return back(['success', 'Pengguna terpilih berhasil dihapus']);
        } catch (PDOException $e) {
            return back(['danger', 'Error : ' . $e->getMessage()]);
        }
    }
}
