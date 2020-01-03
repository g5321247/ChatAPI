<?php
require '../vendor/autoload.php';
include dirname(dirname(__FILE__))."/bootstrap.php";
header("Content-Type: application/json; charset=UTF-8");

use \controller\MessageController as MessageController;

// GET
if (isset($_GET['action'])) {
  $action = $_GET['action'];

  switch ($action) {
    case 'getMessage':
    $groupID = isset($_GET['groupID']) ? $_GET['groupID']:'';
    $vc = new MessageController();
    $vc-> getMessages($groupID);
      break;
  }
  exit;
}

// POST
$inputJSON = file_get_contents('php://input');
$POST = json_decode($inputJSON, TRUE);
if (isset($POST['action'])) {
  $action = $POST['action'];
}

?>
