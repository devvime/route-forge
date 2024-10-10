<?php

class CRUD
{

  private $conn;

  public function __construct(
    $db_host,
    $db_username,
    $db_password,
    $db_name
  ) {
    $this->conn = new mysqli(
      $db_host,
      $db_username,
      $db_password,
      $db_name
    );
  }

  public function create($table, $data)
  {
    $query = "INSERT INTO `$table` SET";
    foreach ($data as $field => $value) {
      $query .= "`$field` = '$value', ";
    }
    $query = rtrim($query, ', ');
    if ($this->conn->query($query)) {
      return true;
    } else {
      return false;
    }
  }

  public function read($table, $where = '')
  {
    $query = "SELECT * FROM `$table`";
    if (!empty($where)) {
      $query .= " WHERE $where";
    }
    $result = $this->conn->query($query);
    if ($result) {
      return $result->fetch_all();
    } else {
      return false;
    }
  }

  public function update($table, $data, $where)
  {
    $query = "UPDATE `$table` SET";
    foreach ($data as $field => $value) {
      $query .= "`$field` = '$value', ";
    }
    $query = rtrim($query, ', ');
    $query .= " WHERE $where";
    if ($this->conn->query($query)) {
      return true;
    } else {
      return false;
    }
  }

  public function delete($table, $where)
  {
    $query = "DELETE FROM `$table` WHERE $where";
    if ($this->conn->query($query)) {
      return true;
    } else {
      return false;
    }
  }
}
