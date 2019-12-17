<?php
DEFINE('PATH',dirname(dirname(dirname(__FILE__)))."/object");
include(PATH."/error.php");
include(PATH."/user.php");
include(PATH."/message.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require (dirname(dirname(dirname(__FILE__)))."/bootstrap.php");

$status;

// GET
$groupID = isset($_GET['groupID']) ? $_GET['groupID']:'';

// POST
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
$sendrID = isset($input['userID']) ? $input['userID']:'';
$newContent = isset($input['message']) ? $input['message']:'';

if (!empty($groupID)) {
  $status = "GET";
}

if (!empty($sendrID)) {
  $status = "POST";
}

if (empty($groupID) && empty($sendrID)) {
  ErrorMessage::getMessage("invalid parameter");
  exit;
}

$chatroom = new Chatroom($queryBuilder, $groupID);

switch ($status) {
  case 'GET':
    $chatroom -> getMessages();
  case 'POST':
    // 放在這是避免 get 的 groupID 被蓋掉
    $groupID = isset($input['groupID']) ? $input['groupID']:'';
    $currentTime = time();

    $sql = "INSERT INTO messages (id, groupID, senderID, message, messageTime)
      VALUES (NULL, '{$groupID}', '{$sendrID}', '{$newContent}', '{$currentTime}')";
    $statement = $chatroom->createNewMessage($sql);
    echo $statement;
}


class Chatroom {

  protected $queryBuilder;
  protected $groupID;

  function __construct($queryBuilder, $groupID) {
    $this->queryBuilder = $queryBuilder;
    $this->groupID = $groupID;
  }

  function createNewMessage($sql) {
      $this->queryBuilder -> create($sql);
  }

  function getMessages() {
    $messages = $this->retrieveMessages();
    $messagesJSON = array();

    foreach ($messages as $message) {
      $sender = ($this->retrieveUser($message->senderID))->getResult();
      $result = [
        "sender"=> $sender,
        "content"=> $message->message,
        "sending_time"=>(int)$message->messageTime
      ];

      $messagesJSON[] = $result;
    }

    echo json_encode($messagesJSON);
  }

  protected function retrieveUser($userID) {
    $sql = "select * from user WHERE id = '{$userID}'";
    $users =  $this->queryBuilder -> querySingleObject($sql,'user');
    return $users;
  }

  protected function retrieveMessages() {
    $sql = "select * from messages WHERE groupID = '{$this->groupID}'";
    $messages = $this->queryBuilder -> queryProperty($sql, 'message');
    return $messages;
  }
}

?>
