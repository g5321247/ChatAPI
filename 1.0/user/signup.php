<?php
include(dirname(dirname(dirname(__FILE__)))."/object/user.php");
include(dirname(dirname(dirname(__FILE__)))."/object/error.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require (dirname(dirname(dirname(__FILE__)))."/bootstrap.php");

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array

$account = isset($input['account']) ? $input['account']:'';
$password = isset($input['password']) ? md5($input['password']):'';

if (empty($account) || empty($password)) {
  ErrorMessage::getMessage("帳號和密碼不得空白");
  exit;
}

$sql = "select * from user WHERE account = '{$account}' and password = '{$password}' ";
$user =  $queryBuilder -> querySingleObject($sql,'user');

if(empty($user)) {
  ErrorMessage::getMessage("帳號或密碼不正確");
  exit;
}

$result = $user->getResult();
echo json_encode($result);

?>
