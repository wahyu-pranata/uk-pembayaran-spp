<?php

class Petugas
{
    protected $db;
    private $table = "petugas";
    public function __construct()
    {
        $this->db = new Database();
    }
    public function insert(array $data)
    {
        $this->db->query("CALL insertPetugas(:nama, :pengguna_id)");
        $this->db->bindValues([
            ':nama' => $data['nama'],
            ':pengguna_id' => $data['pengguna_id']
        ]);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function count()
    {
        try {
            $this->db->query("SELECT COUNT(*) as jumlah_petugas FROM " . $this->table);
            return $this->db->fetch();
        } catch (Exception $e) {
            return array("response" => "error", "message" => $e->getMessage());
        }
    }
    public function update(array $data)
    {
        $this->db->query("UPDATE petugas SET nama = :nama WHERE id = :id");
        $this->db->bind(':nama', $data['nama']);
        $this->db->bind(':id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
