<?php

class QueryBuilder {

  protected $pdo;

  public function __construct(Pdo $pdo)
  {
    $this -> pdo = $pdo;
  }

  public function selectAll($table, $type) {
    $statement = $this->pdo->prepare("select * from {$table}");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_CLASS, $type);

    return $result;
  }

  public function queryAccount($table, String $value) : Array {
    $statement = $this->pdo->prepare("select * from `{$table}` WHERE account = '{$value}'");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_CLASS, 'User');

    // $_SESSION['account'] = $value;
    return $result;
  }
}
