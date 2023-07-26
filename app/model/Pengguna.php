<?php


namespace Models;

use Core\Database;

class Pengguna
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function get(string $filter = null)
    {
        $this->db->query("SELECT * FROM pengguna $filter");
        return $this->db->fetchAll();
    }
    public function getSingle(string $filter = null)
    {
        $this->db->query("SELECT * FROM pengguna $filter");
        return $this->db->fetch();
    }
    public function insert(array $data)
    {
        $this->db->query("CALL insertPengguna(:username, :password, :role)");
        $this->db->binds([
            ':username' => $data['username'],
            ':password' => $data['password'],
            ':role' => $data['role']
        ]);
        $this->db->execute();
        $this->db->rowCount();
    }
    public function update(array $data)
    {
        $this->db->query("UPDATE pengguna SET username = :username WHERE id = :id");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':id', $data['pengguna_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function resetPassword(array $data)
    {
        $this->db->query("UPDATE pengguna SET password = :password WHERE id = :id");
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':id', $data['pengguna_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function delete(string $id)
    {
        $this->db->query("DELETE FROM pengguna WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}
