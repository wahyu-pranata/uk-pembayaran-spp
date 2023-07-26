<?php

namespace Core;

use Core\Database;
use Exception;

// Class model yang menjadi dasar dari kelas model-model yang lain
abstract class Model
{
  private $db;
  protected $table;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function select(string $filter = "", $mode = "single")
  {
    try {
      if ($mode != "single" || $mode != "all") {
        throw new Exception("Wrong select mode!");
      }

      $this->db->query("SELECT * FROM " . $this->table . $filter);

      if ($mode == "single") {
        return $this->db->fetch();
      }

      return $this->db->fetchAll();
    } catch (Exception $e) {
      return array("response" => "error", "message" => $e->getMessage());
    }
  }

  public function count()
  {
    try {
      $this->db->query("SELECT COUNT(*) FROM " . $this->table);
      return $this->db->fetch();
    } catch (Exception $e) {
      return array("response" => "error", "message" => $e->getMessage());
    }
  }

  abstract public function insert(array $data);
  abstract public function update(array $data, string $id);
  abstract public function delete(string $id);
}
