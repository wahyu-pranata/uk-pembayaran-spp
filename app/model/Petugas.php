<?php

class Petugas {
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function get(string $filter = '') {
        $this->db->query("SELECT * FROM petugas $filter");
        return $this->db->fetchAll();
    }
    public function getSingle(string $filter = '') {
        $this->db->query("SELECT * FROM petugas $filter");
        return $this->db->fetch();
    }
    public function getPengguna(string $filter = '', string $mode = 'all') {
        $this->db->query("SELECT * FROM pengguna_petugas $filter");
        if($mode == 'all') {
            return $this->db->fetchAll();
        } elseif($mode == 'single') {
            return $this->db->fetch();
        }
    }
    public function count($filter = '')
    {
        $this->db->query("SELECT COUNT(id) AS 'jumlah_petugas' FROM pengguna_petugas $filter");
        return $this->db->fetch();
    }
    public function insert(array $data) {
        $this->db->query("CALL insertPetugas(:nama, :pengguna_id)");
        $this->db->binds([
            ':nama' => $data['nama'],
            ':pengguna_id' => $data['pengguna_id']
        ]);
        $this->db->execute();
        return $this->db->rowCount();
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