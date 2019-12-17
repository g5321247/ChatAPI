<?php
DEFINE('PATH',dirname(dirname(dirname(__FILE__)))."/object");
include(PATH."/error.php");
include(PATH."/user.php");
include(PATH."/message.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$queryBuilder = require (dirname(dirname(dirname(__FILE__)))."/bootstrap.php");
$groupID = isset($_GET['groupID']) ? $_GET['groupID']:'';

if (empty($groupID)) {
  ErrorMessage::getMessage("invalid group id");
  exit;
}

$chatroom = new Chatroom($queryBuilder, $groupID);
$chatroom -> getMessages();

class Chatroom {

  protected $queryBuilder;
  protected $groupID;

  function __construct($queryBuilder, $groupID) {
    $this->queryBuilder = $queryBuilder;
    $this->groupID = $groupID;
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
