<?php
namespace model;

use \entity\messageEntity;

class MessageModel {

  protected $queryBuilder;

  function __construct() {
    $this->queryBuilder= \Bootstrap::getConnection();
  }

  public function retrieveMessages($groupID) {
    $sql = "select * from messages WHERE groupID = '{$groupID}'";
    $messages = $this->queryBuilder -> queryProperty($sql, '\entity\messageEntity');
    return $messages;
  }
}


?>
