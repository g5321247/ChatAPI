<?php

class Group {
   public $id;
   public $title;
   public $image;
   public $type;

   public function getResult() {
     echo 'wew';
     $result = [
       "id"=> $this->id,
       "name"=> $this->title,
       "picture"=> $this->image,
     ];

     return $result;
   }
}


?>
