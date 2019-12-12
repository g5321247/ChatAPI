<?php

class QueryBuilder {

  protected $pdo;

  public function __construct(Pdo $pdo)
  {
    $this->pdo = $pdo;
    $this->pdo->query('SET NAMES "utf8"');
  }

  public function selectAll($table, $type) {
    $statement = $this->pdo->prepare("select * from {$table}");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_CLASS, $type);

    return $result;
  }

  public function query($table, String $column, String $value) : Array {
    $statement = $this->pdo->prepare("select * from `{$table}` WHERE `{$column}` = '{$value}'");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_CLASS, 'User');

    return $result;
  }

  public function queryProperty(String $sql, $property) : Array {
    $statement = $this->pdo->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_CLASS, $property);

    return $result;
  }

}
