<?php

class Connection {

  public static function make($config) {
    try {
      return new PDO('mysql:host=127.0.0.1;dbname=mytodo', 'root', "1234");
    } catch (\Exception $e) {
        die($e->getmessage());
    }
  }
}
