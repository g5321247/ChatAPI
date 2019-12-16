<?php

class ErrorMessage {

  public static function getMessage($message) {
    $result = [
      "message" => $message,
    ];

    echo json_encode($result);
  }

}

?>
