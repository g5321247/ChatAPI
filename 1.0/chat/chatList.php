<?php
include(dirname(dirname(dirname(__FILE__)))."/object/user.php");
include(dirname(dirname(dirname(__FILE__)))."/object/friendList.php");
include(dirname(dirname(dirname(__FILE__)))."/object/groupList.php");
include(dirname(dirname(dirname(__FILE__)))."/object/group.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require (dirname(dirname(dirname(__FILE__)))."/bootstrap.php");

function showErrorMessage() {
  http_response_code(403);
  $result = [
      "message" => "invalid user id",
  ];
  echo json_encode($result);
  exit;
}

$userID = isset($_GET['userID']) ? $_GET['userID']:'';

if (empty($userID)) {
  showErrorMessage();
}

$sql = "select * from user WHERE id = '{$userID}'";
$users =  $queryBuilder -> queryProperty($sql,'user');

if (empty($users[0])) {
  showErrorMessage();
}

$chatList = $users[0] -> getResult();

$sql = "select * from group_user WHERE userID = '{$userID}'";
$groupList = $queryBuilder -> queryProperty($sql,'groupList');

// 群組列表
$groupsID = array();
foreach ($groupList as $list) {
  $groupsID[] = ($list->groupID);
}

$groupsID = implode(',',$groupsID);
$groupSql = "select * from groups WHERE id IN ({$groupsID})";
$groups =  $queryBuilder -> queryProperty($groupSql,'group');

//排序規則
function cmp($a, $b) {
    return $a->messageTime < $b->messageTime;
}

usort($groups, "cmp");

$groupsList = array();

foreach ($groups as $group) {
  // 0 為單人
  if ($group->type == 0) {
    $groupSql = "select * from group_user WHERE groupID IN ({$group->id}) AND userID <> ({$userID})";
    $list =  $queryBuilder -> queryProperty($groupSql,'groupList');
    $friendID = $list[0]->userID;
    $sql = "select * from user WHERE id = '{$friendID}'";
    $users =  $queryBuilder -> queryProperty($sql,'user');
    $group->title = $users[0]->name;
    $group->image = $users[0]->photo;
  }

  $result = $group->getChatListResult();
  $groupsList[] = $result;
}

echo json_encode(
  [
    "chat_lists" => $groupsList
  ]
);
?>
