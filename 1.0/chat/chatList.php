<?php
DEFINE('PATH',dirname(dirname(dirname(__FILE__)))."/object");
include(PATH."/user.php");
include(PATH."/friendList.php");
include(PATH."/groupList.php");
include(PATH."/group.php");
include(PATH."/error.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$queryBuilder = require (dirname(dirname(dirname(__FILE__)))."/bootstrap.php");
$userID = isset($_GET['userID']) ? $_GET['userID']:'';

if (empty($userID)) {
  ErrorMessage::getMessage("invalid user id");
  exit;
}

$chatList = new ChatList($queryBuilder,$userID);
$chatList->getChatList();

class ChatList {

  protected $queryBuilder;
  protected $userID;

  function __construct($queryBuilder, $userID) {
    $this->queryBuilder = $queryBuilder;
    $this->userID = $userID;
  }

  function getChatList() {
    $user = $this->getUser();

    if (empty($user)) {
      ErrorMessage::getMessage("invalid user id");
      exit;
    }

    $groups = $this->getGroupsList();

    echo json_encode(
      [
        "chat_lists" => $groups
      ]
    );
  }

  protected function getUser() {
    $sql = "select * from user WHERE id = '{$this->userID}'";
    $users =  $this->queryBuilder -> queryProperty($sql,'user');
    return $users[0];
  }

  function getGroupsList() {
    $groups = $this->getGroups();
    $groupsList = array();

    foreach ($groups as $group) {
      // 0 為單人
      if ($group->type == 0) {
        $groupSql = "select * from group_user WHERE groupID IN ({$group->id}) AND userID <> ({$this->userID})";
        $list =  $this->queryBuilder -> queryProperty($groupSql,'groupList');
        $friendID = $list[0]->userID;
        $sql = "select * from user WHERE id = '{$friendID}'";
        $users =  $this->queryBuilder -> queryProperty($sql,'user');
        $group->title = $users[0]->name;
        $group->image = $users[0]->photo;
      }

      $result = $group->getChatListResult();
      $groupsList[] = $result;
    }
    return $groupsList;
  }

  protected function getGroups() {
    $sql = "select * from group_user WHERE userID = '{$this->userID}'";
    $groupList = $this->queryBuilder -> queryProperty($sql,'groupList');

    $groupsID = array();
    foreach ($groupList as $list) {
      $groupsID[] = ($list->groupID);
    }

    $groupsID = implode(',',$groupsID);
    $groupSql = "select * from groups WHERE id IN ({$groupsID}) ORDER BY messageTime DESC";
    $groups =  $this->queryBuilder -> queryProperty($groupSql,'group');

    return $groups;
  }
}
?>
