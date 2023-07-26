<?php

class Pembayaran
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function insert(array $data)
    {
        $this->db->query("INSERT INTO pembayaran(tahun_ajaran, nominal) VALUES(:tahun_ajaran, :nominal)");
        $this->db->bindValues([
            ':tahun_ajaran' => $data['tahun_ajaran'],
            ':nominal' => $data['nominal'],
        ]);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function delete(string $id)
    {
        $this->db->query("DELETE FROM pembayaran WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
    }
}
