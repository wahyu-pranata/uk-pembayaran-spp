<?php

class Siswa
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function get(string $filter = '')
    {
        $this->db->query("SELECT * FROM pengguna_siswa $filter");
        return $this->db->fetchAll();
    }
    public function getSingle(string $filter = '')
    {
        $this->db->query("SELECT * FROM pengguna_siswa $filter");
        return $this->db->fetch();
    }
    public function getPengguna(string $filter = '', string $mode = 'all')
    {
        $this->db->query("SELECT * FROM pengguna_siswa $filter");
        if ($mode == 'all') {
            return $this->db->fetchAll();
        } elseif ($mode == 'single') {
            return $this->db->fetch();
        }
    }
    public function count(string $filter)
    {
        $this->db->query("SELECT COUNT(id) AS 'jumlah_siswa' FROM pengguna_siswa $filter");
        return $this->db->fetch();
    }
    public function insert(array $data)
    {
        $this->db->query('CALL insertSiswa(:nis, :nisn, :nama, :alamat, :telepon, :kelas_id, :pengguna_id, :pembayaran_id)');
        $this->db->binds([
            ':nis' => $data['nis'],
            ':nisn' => $data['nisn'],
            ':nama' => $data['nama'],
            ':alamat' => $data['alamat'],
            ':telepon' => $data['telepon'],
            ':kelas_id' => $data['kelas_id'],
            ':pengguna_id' => $data['pengguna_id'],
            ':pembayaran_id' => $data['pembayaran_id'],
        ]);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function update(array $data)
    {
        $this->db->query('CALL updateSiswa(:id, :pengguna_id, :nis, :nisn, :nama, :alamat, :telepon, :kelas_id, :pembayaran_id)');
        $this->db->binds([
            ':id' => $data['id'],
            ':pengguna_id' => $data['pengguna_id'],
            ':nis' => $data['nis'],
            ':nisn' => $data['nisn'],
            ':nama' => $data['nama'],
            ':alamat' => $data['alamat'],
            ':telepon' => $data['telepon'],
            ':kelas_id' => $data['kelas_id'],
            ':pembayaran_id' => $data['pembayaran_id']
        ]);
        $this->db->execute();
    }
    public function destroy(string $id)
    {
        $this->db->query('DELETE FROM siswa WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
    public function updatePengguna(string $username, int $pengguna_id)
    {
        $this->db->query('UPDATE siswa SET pengguna_id = :pengguna_id WHERE nis = :nis');
        $this->db->bind(':pengguna_id', $pengguna_id);
        $this->db->bind(':nis', $username);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
