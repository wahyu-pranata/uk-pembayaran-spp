<?php

class Classes extends Controller
{
    public function __construct()
    {
        if($_SESSION['user']['role'] == 'siswa') {
            return redirect('/');
        }
    }
    public function index()
    {
        $data['title'] = 'List Kelas';
        $data['classes'] = $this->model('Kelas')->get();
        $this->view([
            'template/dashboard-header',
            'dashboard/classes-index',
            'template/dashboard-footer'
        ], $data);
    }
    public function detail(string $id)
    {
        $data['title'] = 'Detail Kelas';
        $data['kelas'] = $this->model('Kelas')->getSingle("WHERE id = {$id}");
        $data['jml'] = $this->model('Siswa')->count("WHERE kelas_id = {$id}");
        $data['siswa'] = $this->model('Siswa')->get("WHERE kelas_id = {$id}");
        $data['pembayaran'] = $this->model('Pembayaran')->get();
        $this->view([
            'template/dashboard-header',
            'dashboard/classes-detail',
            'template/dashboard-footer'
        ], $data);
    }

    public function store()
    {
        try {
            $this->model('Kelas')->insert($_POST);
            return back(['success', 'Kelas baru berhasil ditambahkan!']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
    public function update(string $id)
    {
        try {
            $this->model('Kelas')->update($_POST);
            return back(['success', 'Kelas ini berhasil diperbarui!']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
    public function delete(string $id)
    {
        try {
            $this->model('Kelas')->delete($id);
            return back(['success', 'Kelas terpilih berhasil dihapus']);
        } catch(PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
}
