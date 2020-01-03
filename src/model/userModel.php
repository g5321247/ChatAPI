<?php
namespace model;

class UserModel {

  protected $queryBuilder;

  function __construct() {
    $this->queryBuilder= \Bootstrap::getConnection();
  }

  public function getResult($entity) {
    $status = isset($entity->status) ? $entity->status : "";
    $photo = isset($entity->photo) ? $entity->photo : "";

    $result = [
      "id"=> (int)$entity->id,
      "name"=> $entity->name,
      "picture"=> $photo,
      "status_text"=> $status,
    ];

    return $result;
  }

  public function retrieveUser($userID) {
    $sql = "select * from user WHERE id = '{$userID}'";
    $user =  $this->queryBuilder -> querySingleObject($sql,'\entity\userEntity');
    return $user;
  }
}

?>
