<?php

// Model untuk tabel kelas
class Kelas extends Model
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function insert(array $data)
    {
        // Prefix titik dua (:) menandakan bahwa nilai harus dibind terlebih dahulu
        $this->db->query("INSERT INTO kelas(nama, kompetensi_keahlian) VALUES(:nama, :kompetensi_keahlian)");

        // Bind beberapa value sekaligus menggunakan binds
        $this->db->bindValues([
            ':nama' => $data['nama'],
            ':kompetensi_keahlian' => $data['kompetensi_keahlian']
        ]);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function update(array $data, string $id)
    {
        $this->db->query("UPDATE kelas SET nama = :nama, kompetensi_keahlian = :kompetensi_keahlian WHERE id = :id");
        $this->db->bindValues([
            ':nama' => $data['nama'],
            ':kompetensi_keahlian' => $data['kompetensi_keahlian'],
            ':id' => $id
        ]);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function delete(string $id)
    {
        $this->db->query("DELETE FROM kelas WHERE id = :id");

        // Karena yang perlu dibind hanya satu nilai saja, cukup gunakan perintah bind
        $this->db->bind(":id", $id);
        $this->db->execute();
    }
}
