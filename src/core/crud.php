<?php

class CRUD
{
  private $conn;

  public function __construct($db_host, $db_username, $db_password, $db_name)
  {
    try {
      $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
      $this->conn = new PDO($dsn, $db_username, $db_password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }

  public function create($table, $data)
  {
    $fields = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    
    $query = "INSERT INTO `$table` ($fields) VALUES ($placeholders)";
    
    try {
      $stmt = $this->conn->prepare($query);
      $stmt->execute(array_values($data));
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function read($table, $where = '', $params = [])
  {
    $query = "SELECT * FROM `$table`";
    if (!empty($where)) {
      $query .= " WHERE $where";
    }

    try {
      $stmt = $this->conn->prepare($query);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return false;
    }
  }

  public function update($table, $data, $where, $whereParams = [])
  {
    $setClause = implode(', ', array_map(fn($field) => "`$field` = ?", array_keys($data)));

    $query = "UPDATE `$table` SET $setClause WHERE $where";

    try {
      $stmt = $this->conn->prepare($query);
      $stmt->execute(array_merge(array_values($data), $whereParams));
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function delete($table, $where, $params = [])
  {
    $query = "DELETE FROM `$table` WHERE $where";
    
    try {
      $stmt = $this->conn->prepare($query);
      $stmt->execute($params);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
}

