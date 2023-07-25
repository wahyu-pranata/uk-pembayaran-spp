<?php

class Kelas
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function get(string $filter = '')
    {
        $this->db->query("SELECT * FROM kelas $filter");
        return $this->db->fetchAll();
    }
    public function getSingle(string $filter = '')
    {
        $this->db->query("SELECT * FROM kelas $filter");
        return $this->db->fetch();
    }
    public function count()
    {
        $this->db->query("SELECT COUNT(id) AS 'jumlah_kelas' FROM kelas");
        return $this->db->fetch();
    }
    public function insert(array $data)
    {
        $this->db->query("INSERT INTO kelas(nama, kompetensi_keahlian) VALUES(:nama, :kompetensi_keahlian)");
        $this->db->binds([
            ':nama' => $data['nama'],
            ':kompetensi_keahlian' => $data['kompetensi_keahlian']
        ]);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function update(array $data)
    {
        $this->db->query("UPDATE kelas SET nama = :nama, kompetensi_keahlian = :kompetensi_keahlian WHERE id = :id");
        $this->db->binds([
            ':nama' => $data['nama'],
            ':kompetensi_keahlian' => $data['kompetensi_keahlian'],
            ':id' => $data['id']
        ]);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function delete(string $id)
    {
        $this->db->query("DELETE FROM kelas WHERE id = :id");
        $this->db->bind(":id", $id);
        $this->db->execute();
    }
}
