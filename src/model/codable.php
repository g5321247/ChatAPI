<?php
namespace model;

class Codable {

  public static function echoJSONEncode($data) {
    echo json_encode($data);
  }
}

?>
