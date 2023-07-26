<?php

class Report extends Controller
{
    public function __construct()
    {
        if ($_SESSION['user']['role'] != 'admin') {
            return redirect('/');
        }
    }
    public function index()
    {
        $data['title'] = 'Generate Laporan';
        $data['tahun'] = $this->model('Transaksi')->raw("SELECT DISTINCT tahun_dibayar AS 'tahun' FROM transaksi ORDER BY tahun_dibayar");
        $data['bulan'] = $this->model('Transaksi')->raw("SELECT DISTINCT bulan_dibayar AS 'bulan' FROM transaksi ORDER BY bulan_dibayar");
        foreach ($data['bulan'] as $i => $bulan) {
            $dateObj = DateTime::createFromFormat("!m", $bulan['bulan']);
            $data['bulan'][$i]['nama_bulan'] = $dateObj->format("F");
        }
        if (!empty($report)) {
            $data['report'] = $report;
        }
        $this->view([
            'template/dashboard-header',
            'dashboard/report-index',
            'template/dashboard-footer',
        ], $data);
    }
    public function result(string $date_from = '', string $date_until = '')
    {
        $dateFrom = $date_from . ' 00:00:00';
        $dateUntil = $date_until . ' 23:59:59';
        $report = $this->model('Transaksi')->get("WHERE tanggal_dibayar BETWEEN '{$dateFrom}' AND '{$dateUntil}'");
        dd($report);
        if (empty($report)) {
            return redirect('/report', ['danger', 'Data tidak ada!']);
        }
        $data['title'] = 'Laporan';
        $data['report'] = $report;
        $this->view([
            'template/dashboard-header',
            'dashboard/report-index',
            'template/dashboard-footer'
        ], $data);
    }
    public function search()
    {
        return redirect('/report/result/' . $_POST['date_from'] . '/' . $_POST['date_until']);
    }
}
