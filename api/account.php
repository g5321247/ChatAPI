<?php
require "../object/user.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require '../bootstrap.php';
$account = isset($_POST['account']) ? $_POST['account']:'';
$password = isset($_POST['password']) ? md5($_POST['password']):'';
$users =  $queryBuilder -> queryAccount('user', $account);

if (empty($account) || empty($password)) {
  http_response_code(404);
  $result = ["error"=>"Invalid request body."];

  echo json_encode($result);
} else if ($users[0]->password == $password) {
  echo json_encode($users[0]);
} else {
  $result = [
    "message" => "密碼不正確",
  ];
  echo json_encode($result);
}

?>
