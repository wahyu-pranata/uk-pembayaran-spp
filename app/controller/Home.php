<?php

class Home extends Controller {
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            return redirect('/auth', ['danger','Silahkan login terlebih dahulu!']);
        }
    }
    public function index() {
        $sevenDaysAgo = date("Y-m-d H:i:s", strtotime("-1 week"));
        $now = date("Y-m-d H:i:s", time());

        $all_transaksi = $this->model('Transaksi')->count();
        $transaksi_minggu_terakhir = $this->model('Transaksi')->count("WHERE tanggal_dibayar BETWEEN '{$sevenDaysAgo}' AND '{$now}'");

        $data['transaksi']['all'] = $all_transaksi['jumlah_transaksi'];
        $data['transaksi']['last_week'] = $transaksi_minggu_terakhir['jumlah_transaksi']; 
        $data['jml_petugas'] = $this->model('Petugas')->count("WHERE role = 'petugas'");
        $data['title'] = 'Home';
        $this->view([
            'template/dashboard-header',
            'home/index',
            'template/dashboard-footer',
        ], $data);
    }
}