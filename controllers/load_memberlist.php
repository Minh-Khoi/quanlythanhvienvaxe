<?php

session_start();

// require_once dirname(__FILE__, 2) . "/models/action/action.php";
require_once dirname(__FILE__, 2) . "/models/action/action.php";
// var_dump($_SESSION);
if (!isset($_SESSION["is_quantrivien"])) {
  header("Location: http://" . $_SERVER["HTTP_HOST"] . "login.php");
  // exit();
}


$action = new action();
// echo "tai soa";
$action->load_memberlist();