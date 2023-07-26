<?php

class Siswa
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function insert(array $data)
    {
        $this->db->query('CALL insertSiswa(:nis, :nisn, :nama, :alamat, :telepon, :kelas_id, :pengguna_id, :pembayaran_id)');
        $this->db->bindValues([
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
        $this->db->bindValues([
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
