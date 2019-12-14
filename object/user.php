<?php

class User {

   public $uuid;
   public $account;
   public $password;
   public $name;
   public $photo;
   public $status;
   public $friendID;
   public $groupID;

   public function getResult() {
     $status = isset($this->status) ? $this->status : "";
     $photo = isset($this->photo) ? $this->photo : "";

     $result = [
       "id"=> (int)$this->id,
       "name"=> $this->name,
       "picture"=> $photo,
       "status_text"=> $status,
     ];

     return $result;
   }

}


?>
