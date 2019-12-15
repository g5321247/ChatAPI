<?php

class Group {
   public $id;
   public $title;
   public $image;
   public $type;
   public $lastMessage;
   public $messageTime;

   public function getResult() {
     $result = [
       "id"=> (int)$this->id,
       "name"=> $this->title,
       "picture"=> $this->image,
     ];

     return $result;
   }

   public function getChatListResult() {
     $result = $this->getResult();

     $result[] = [
       "last_message"=> $this->lastMessage,
       "last_message_time"=> $this->messageTime,
     ];

     return $result;
   }
}


?>
