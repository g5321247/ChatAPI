<?php

class Group {
   public $id;
   public $title;
   public $image;
   public $type;
   public $lastMessage;
   public $messageTime;

   public function getResult() {
     $image = isset($this->image) ? $this->image : "";
     $result = [
       "chat_id"=> (int)$this->id,
       "name"=> $this->title,
       "picture"=> $image,
     ];

     return $result;
   }

   public function getChatListResult() {
     $result = $this->getResult();

     $result["last_message"] = $this->lastMessage;
     $result["last_message_time"] = $this->messageTime;

     return $result;
   }
}


?>
