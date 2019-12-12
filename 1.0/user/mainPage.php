<?php
include(dirname(dirname(dirname(__FILE__)))."/object/user.php");
include(dirname(dirname(dirname(__FILE__)))."/object/friendList.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require (dirname(dirname(dirname(__FILE__)))."/bootstrap.php");
$userID = isset($_GET['userID']) ? $_GET['userID']:'';

$sql = "select * from friendList WHERE userID = '{$userID}'";
$lists =  $queryBuilder -> queryProperty($sql,'friendList');

foreach ($lists as $list) {
  var_dump($list->friendID);
}

 ?>
