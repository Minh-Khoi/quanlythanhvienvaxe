<?php
if (isset($_SESSION['ID'])) {
  session_id($_SESSION['ID']);
}
session_start();
$_SESSION["ID"] = session_id();

require_once dirname(__FILE__, 2) . "/models/action/logout_action.php";


$logout_action = new logout_action();
$logout_action->logout_done();