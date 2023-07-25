<?php

class Transaksi
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function raw(string $query, string $mode = 'all')
    {
        $this->db->query("{$query}");
        if ($mode == 'all') {
            return $this->db->fetchAll();
        } elseif ($mode == 'single') {
            return $this->db->fetch();
        }
    }
    public function get(string $filter = '')
    {
        $this->db->query("SELECT * FROM transaksi_view $filter");
        return $this->db->fetchAll();
    }
    public function getSingle(string $filter = '')
    {
        $this->db->query("SELECT * FROM transaksi_view $filter");
        return $this->db->fetch();
    }
    public function count(string $filter = '')
    {
        $this->db->query("SELECT COUNT(id) AS 'jumlah_transaksi' FROM transaksi $filter");
        return $this->db->fetch();
    }
    public function getSiswaHistory(string $id)
    {
        $this->db->query("SELECT id, bulan_dibayar, tahun_dibayar, tanggal_dibayar FROM transaksi WHERE siswa_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->fetchAll();
    }
    public function insert(array $data)
    {
        $this->db->query("CALL insertTransaksi(:tgl_bayar, :bulan_bayar, :tahun_bayar, :siswa_id, :petugas_id, :pembayaran_id)");
        $this->db->binds([
            ':tgl_bayar' => $data['tanggal_dibayar'],
            ':bulan_bayar' => $data['bulan_dibayar'],
            ':tahun_bayar' => $data['tahun_dibayar'],
            ':siswa_id' => $data['siswa_id'],
            ':petugas_id' => $data['petugas_id'],
            ':pembayaran_id' => $data['pembayaran_id']
        ]);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function delete(string $id)
    {
        $this->db->query("DELETE FROM transaksi WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}
