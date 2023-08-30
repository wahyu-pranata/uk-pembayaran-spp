<?php

class Database
{
    // Nilai ini diambil dari file config/config.php
    private $db_user = DB_USER,
        $db_host = DB_HOST,
        $db_name = DB_NAME,
        $db_pass = DB_PASS,
        $dbh,
        $stmt;

    public function __construct()
    {
        // Option koneksi dari PDO
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        // DBH (Database Handler) berfungsi untuk berkomunikasi dengan database
        $this->dbh = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_user, $this->db_pass, $options);
    }

    /**
     * Mempersiapkan query sebelum dijalankan
     */
    public function query(string $query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * Mengikat nilai dengan query SQL untuk mencegah SQL injection
     */
    public function bind(string $param, $value, $type = null)
    {
        if ($type == null) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        // https://www.php.net/manual/en/pdostatement.bindvalue
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Menjalankan fungsi bind namun dengan banyak nilai, lihat lebih banyak pada class-class pada directory model
     */
    public function bindValues(array $params)
    {
        foreach ($params as $key => $value) {
            $this->bind($key, $value);
        }
    }

    /** 
     * Jalankan SQL query
     * 
     */
    public function execute()
    {
        $this->stmt->execute();
    }

    /**
     * Ambil satu baris pertama data yang dikembalikan oleh perintah SQL
     */
    public function fetch(): array
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    /**
     * Ambil semua baris data yang dikembalikan perintah SQL 
     */
    public function fetchAll(): array
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    /**
     * 
     * Ambil banyaknya baris data yang dikembalikan perintah SQL
     */
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }
}
