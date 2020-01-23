<?php
namespace controller;

use \model\userModel as UserModel;
use \model\codable as Codable;
use \model\messageModel as MessageModel;

class MessageController {

  function getMessages($groupID) {
    $messageModel = new MessageModel();
    $userModel = new UserModel();

    $messages = $messageModel->retrieveMessages($groupID);
    $messagesJSON = array();
    // model 間建立 relationship
    foreach ($messages as $message) {

      $user = $userModel->retrieveUser($message->senderID);
      $sender = $userModel->getResult($user);

      $result = [
        "sender"=> $sender,
        "content"=> $message->message,
        "sending_time"=>(int)$message->messageTime
      ];

      $messagesJSON[] = $result;
    }

    Codable::echoJSONEncode(["data" => $messagesJSON]);
  }
}

?>
