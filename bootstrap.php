<?php
require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';

class Bootstrap {
  public static function getConnection() {
    $config = require 'config.php';
    return new QueryBuilder(
      Connection::make($config['database'])
    );
  }
}

$config = require 'config.php';
return new QueryBuilder(
  Connection::make($config['database'])
);
