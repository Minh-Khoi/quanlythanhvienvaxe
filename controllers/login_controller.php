<?php
if (isset($_SESSION['ID'])) {
  session_id($_SESSION['ID']);
}
session_start();
$_SESSION["ID"] = session_id();

require_once dirname(__FILE__, 2) . "/models/action/login_action.php";

//This file will be called by the views login.php (by submit login form)
$nick_zalo = $_POST["ten_dang_nhap"];
$password = $_POST["password"];
$login_action = new login_action();
$login_action->login_accept($nick_zalo, $password);