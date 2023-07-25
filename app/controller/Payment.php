<?php

class Payment extends Controller
{
    public function __construct()
    {
        if ($_SESSION['user']['role'] != 'admin') {
            return redirect('/');
        }
    }
    public function index()
    {
        $data['payments'] = $this->model('Pembayaran')->get();
        $data['title'] = "List Pembayaran";
        $this->view([
            'template/dashboard-header',
            'dashboard/payments-index',
            'template/dashboard-footer',
        ], $data);
    }

    public function store()
    {
        $tahunAjaran = $this->model('Pembayaran')->get("WHERE tahun_ajaran = '{$_POST['tahun_ajaran']}'");
        if ($tahunAjaran) {
            return back(['danger', 'Tahun ajaran sudah terdaftar']);
        }
        if (!preg_match("/202[0-9]-202[0-9]/", $_POST['tahun_ajaran'])) {
            return back(['danger', 'Format tahun ajaran anda salah!']);
        }
        try {
            $this->model('Pembayaran')->insert($_POST);
            return back(['success', 'Pembayaran baru berhasil ditambahkan']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
    public function delete(string $id)
    {
        try {
            $this->model('Pembayaran')->delete($id);
            return back(['success', 'Pembayaran terpilih berhasil dihapus']);
        } catch (PDOException $e) {
            return back(['danger', 'Error : ' . $e->getMessage()]);
        }
    }
}
