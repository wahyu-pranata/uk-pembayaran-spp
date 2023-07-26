<?php

class Profile extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) && $_SESSION['user']['role'] != 'siswa') {
            return redirect('/');
        }
    }
    public function index()
    {
        $data['title'] = 'Profil Siswa';
        $data['kelas'] = $this->model('Kelas')->get();
        $data['pembayaran'] = $this->model('Pembayaran')->get();
        $data['history'] = $this->model('Transaksi')->getSiswaHistory($_SESSION['user']['id']);
        $data['siswa'] = $this->model('Siswa')->getSingle('WHERE id = ' . $_SESSION['user']['id'], 'single');
        $this->view([
            'template/dashboard-header',
            'dashboard/history-index',
            'template/dashboard-footer',
        ], $data);
    }
}
