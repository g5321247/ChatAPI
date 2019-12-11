<?php
include(dirname(__FILE__)."/../object/user.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require '../bootstrap.php';
$account = isset($_POST['account']) ? $_POST['account']:'';
$password = isset($_POST['password']) ? md5($_POST['password']):'';
$users =  $queryBuilder -> queryAccount('user', $account);

if (empty($account) || empty($password)) {
  // http_response_code(404);
  $result = ["error"=>"帳號和密碼不得空白"];
  http_response_code(403);
  echo json_encode($result);
}else if (empty($users)) {
  $result = [
    "message" => "帳號不正確",
  ];
  http_response_code(403);
  echo json_encode($result);
} else if ($users[0]->password == $password) {
  $user = $users[0];
  $result = [
    "id"=> $user->id,
    "name"=> $user->name,
    "picture"=> $user->photo,
    "status_text"=> $user->status,
  ];

  echo json_encode($result);
} else {
  $result = [
    "error" => "密碼不正確",
  ];
  http_response_code(403);
  echo json_encode($result);
}

?>
