<?php
require '../object/user.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require '../bootstrap.php';
$users =  $queryBuilder -> selectAll('use', 'User');

// $user = isset($_POST['user'])?$_POST['user']:'';
// !empty($user)

if (count($users) > 0) {
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
} else {
  http_response_code(404);
  $result = ["message"=>"data not found"];
  echo json_encode($result);
}

?>
