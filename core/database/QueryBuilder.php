<?php

class QueryBuilder {

  protected $pdo;

  public function __construct(Pdo $pdo)
  {
    $this -> pdo = $pdo;
  }

  public function selectAll($table)
  {
    $statement = $this->pdo->prepare("select * from {$table}");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_CLASS, 'Task');

    return $result;
  }
}
