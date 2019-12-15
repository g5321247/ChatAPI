<?php

class Error {

  public static function getMessage($message) {
    $result = [
      "message" => $message,
    ];
    return $result;
  }
}

?>
