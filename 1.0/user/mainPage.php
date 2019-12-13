<?php
include(dirname(dirname(dirname(__FILE__)))."/object/user.php");
include(dirname(dirname(dirname(__FILE__)))."/object/friendList.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require (dirname(dirname(dirname(__FILE__)))."/bootstrap.php");
$userID = isset($_GET['userID']) ? $_GET['userID']:'';

$sql = "select * from friendList WHERE userID = '{$userID}'";
$lists =  $queryBuilder -> queryProperty($sql,'friendList');
$friendsID = array();

foreach ($lists as $list) {
  $friendsID[] = ($list->friendID);
}

$friendsID = implode(',',$friendsID);
$friendSql = "select * from user WHERE id IN ({$friendsID})";
$friends =  $queryBuilder -> queryProperty($friendSql,'user');

$friendsList = array();
foreach ($friends as $user) {
  $photo = isset($user->photo) ? $user->photo : "";
  $status = isset($user->status) ? $user->status : "";

  $result = [
    "id"=> $user->id,
    "name"=> $user->name,
    "picture"=> $photo,
    "status_text"=> $status,
  ];

  $friendsList[] = $result;
}

echo json_encode($friendsList);
?>
