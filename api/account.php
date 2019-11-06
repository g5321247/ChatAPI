<?php

require "../user.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require '../bootstrap.php';
$account = isset($_POST['account']) ? $_POST['account']:'';
$password = isset($_POST['password']) ? md5($_POST['password']):'';
$users =  $queryBuilder -> queryAccount('user', $account);
$user = $users[0];

if ($user->password == $password) {
  echo json_encode($user);
} else {
  $result = [
    "message" => "密碼不正確",
  ];
  echo json_encode($result);
}

?>
