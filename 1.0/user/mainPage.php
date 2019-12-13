<?php
include(dirname(dirname(dirname(__FILE__)))."/object/user.php");
include(dirname(dirname(dirname(__FILE__)))."/object/friendList.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require (dirname(dirname(dirname(__FILE__)))."/bootstrap.php");
$userID = isset($_GET['userID']) ? $_GET['userID']:'';

$sql = "select * from friendList WHERE userID = '{$userID}'";
$lists =  $queryBuilder -> queryProperty($sql,'friendList');

$sql = "select * from user WHERE id = '{$userID}'";
$users =  $queryBuilder -> queryProperty($sql,'user');
$mainPage = $users[0] -> getResult();


// 朋友列表
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

  $result = $user->getResult();

  $friendsList[] = $result;
}

$mainPage['friends'] = $friendsList;

echo json_encode($mainPage);
?>
