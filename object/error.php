<?php

class ErrorMessage {

  public static function getMessage($message) {
    $result = [
      "message" => $message,
    ];
    http_response_code(403);
    echo json_encode($result);
  }

}

?>
