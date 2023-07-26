<?php

class Transaksi
{
    protected $db;
    private $table = "transaksi";
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getSiswaHistory(string $id)
    {
        $this->db->query("SELECT id, bulan_dibayar, tahun_dibayar, tanggal_dibayar FROM transaksi WHERE siswa_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->fetchAll();
    }
    public function count()
    {
        try {
            $this->db->query("SELECT COUNT(*) AS jumlah_transaksi FROM " . $this->table);
            return $this->db->fetch();
        } catch (Exception $e) {
            return array("response" => "error", "message" => $e->getMessage());
        }
    }
    function update(array $data, string $id)
    {
    }
    public function insert(array $data)
    {
        $this->db->query("CALL insertTransaksi(:tgl_bayar, :bulan_bayar, :tahun_bayar, :siswa_id, :petugas_id, :pembayaran_id)");
        $this->db->bindValues([
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
