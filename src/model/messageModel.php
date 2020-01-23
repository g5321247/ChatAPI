<?php
namespace model;

class MessageModel {

  protected $queryBuilder;

  function __construct() {
    $this->queryBuilder= \Bootstrap::getConnection();
  }

  public function retrieveMessages($groupID) {
    // 使用 sql join
    $sql = "select * from messages WHERE groupID = '{$groupID}'";
    $messages = $this->queryBuilder -> queryProperty($sql, '\entity\messageEntity');
    return $messages;
  }
}


?>
