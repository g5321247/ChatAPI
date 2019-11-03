<?php

require 'task.php';

$queryBuilder = require 'bootstrap.php';
$tasks =  $queryBuilder -> selectAll('todos');

var_dump($tasks);

?>

<!-- require 'index.view.php'; -->
