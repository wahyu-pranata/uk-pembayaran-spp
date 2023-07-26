<?php

class Transaction extends Controller
{
    public function index()
    {
        $data['title'] = 'List Transaksi';
        $data['history'] = $this->model('Transaksi')->get();
        // $data['siswa'] = $this->model('Siswa')->get();
        $this->view([
            'template/dashboard-header',
            'dashboard/transaction-index',
            'template/dashboard-footer',
        ], $data);
    }
    public function store()
    {
        $data = $_POST;
        if (!isset($data['pembayaran_id'])) {
            $siswa = $this->model('siswa')->getSingle("WHERE id = '{$data['siswa_id']}'");
            $data['pembayaran_id'] = $siswa['pembayaran_id'];
        }
        $sameData = $this->model('Transaksi')->getSingle("WHERE siswa_id = '{$data['siswa_id']}' AND tahun_dibayar = '{$data['tahun_dibayar']}' AND bulan_dibayar = '{$data['bulan_dibayar']}'");
        if (!$sameData) {
            $data['tanggal_dibayar'] = date("Y-m-d H:i:s", time());
            try {
                $this->model('Transaksi')->insert($data);
                return back(['success', 'Entri transaksi berhasil']);
            } catch (PDOException $e) {
                return back(['danger', 'Error: ' . $e->getMessage()]);
            }
        }
        return back(['danger', 'Siswa sudah membayar pada waktu tersebut!']);
    }
    public function delete(string $id)
    {
        try {
            $this->model('Transaksi')->delete($id);
            return back(['success', 'Transaksi berhasil dihapus']);
        } catch (PDOException $e) {
            return back(['danger', 'Error: ' . $e->getMessage()]);
        }
    }
    public function search()
    {
        $siswa = $this->model('Siswa')->getSingle("WHERE nis = '{$_POST['nis']}'");
        if ($siswa) {
            return redirect('/student/detail/' . $siswa['id']);
        } else {
            return back(['danger', 'Siswa tidak ditemukan!']);
        }
    }
}
