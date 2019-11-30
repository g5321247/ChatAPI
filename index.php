<?php

require 'object/user.php';

$queryBuilder = require 'bootstrap.php';
$users =  $queryBuilder -> selectAll('User');

if (count($users)>0) {
  $userArray = array();
  $userArray["users"] = array();

  foreach ($users as $key => $userModel) {
    $user = array(
      "id" => $userModel->uuid,
      "name" => $userModel->name,
      "photo" => $userModel->photo,
    );

    array_push($userArray["users"], $user);
  }

  http_response_code(200);
  echo json_encode($userArray);
}


// var_dump($users);

?>

<!-- require 'index.view.php'; -->
