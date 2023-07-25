<?php

class Database {
    private $db_user = DB_USER,
            $db_host = DB_HOST,
            $db_name = DB_NAME,
            $db_pass = DB_PASS,
            $dbh,
            $stmt;
    public function __construct()
    {
        $options = [
            PDO::ATTR_PERSISTENT =>true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $this->dbh = new PDO("mysql:host={$this->db_host};dbname={$this->db_name}", $this->db_user, $this->db_pass, $options);
    }
    public function query(string $query) {
        $this->stmt = $this->dbh->prepare($query);
    }
    public function bind(string $param, mixed $value, $type = null)
    {
        if($type == null) {
            switch(true) {
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
        $this->stmt->bindValue($param, $value, $type);
    }
    public function binds(array $params) {
        foreach($params as $key => $value) {
            $this->bind($key, $value);
        }
    }
    public function execute() {
        $this->stmt->execute();
    }
    public function fetch(): array | bool {
        $this->execute();
        return $this->stmt->fetch();
    }
    public function fetchAll(): array {
        $this->execute();
        return $this->stmt->fetchAll();
    }
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }
}