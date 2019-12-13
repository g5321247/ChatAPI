<?php
include(dirname(dirname(dirname(__FILE__)))."/object/user.php");
include(dirname(dirname(dirname(__FILE__)))."/object/friendList.php");
include(dirname(dirname(dirname(__FILE__)))."/object/groupList.php");
include(dirname(dirname(dirname(__FILE__)))."/object/group.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require (dirname(dirname(dirname(__FILE__)))."/bootstrap.php");
$userID = isset($_GET['userID']) ? $_GET['userID']:'';

$sql = "select * from group_user WHERE userID = '{$userID}'";
$groupList = $queryBuilder -> queryProperty($sql,'groupList');

$sql = "select * from friendList WHERE userID = '{$userID}'";
$friendList =  $queryBuilder -> queryProperty($sql,'friendList');

$sql = "select * from user WHERE id = '{$userID}'";
$users =  $queryBuilder -> queryProperty($sql,'user');
$mainPage = $users[0] -> getResult();

// 群組列表
$groupsID = array();
foreach ($groupList as $list) {
  $groupsID[] = ($list->groupID);
}

$groupsID = implode(',',$groupsID);
$groupSql = "select * from groups WHERE id IN ({$groupsID})";
$groups =  $queryBuilder -> queryProperty($groupSql,'group');
$groupsList = array();

foreach ($groups as $group) {
  $result = $group->getResult();

  $groupsList[] = $result;
}

$mainPage['chat_groups'] = $groupsList;


// 朋友列表
$friendsID = array();
foreach ($friendList as $list) {
  $friendsID[] = ($list->friendID);
}
$friendsID = implode(',',$friendsID);
$friendSql = "select * from user WHERE id IN ({$friendsID})";
$friends =  $queryBuilder -> queryProperty($friendSql,'user');

$friendsList = array();

foreach ($friends as $user) {
  $result = $user->getResult();
  $friendsList[] = $result;
}

$mainPage['friends'] = $friendsList;

echo json_encode($mainPage);
?>
