<?php
session_start();
require_once dirname(__FILE__, 2) . "/models/action/login_action.php";


//This file will be called by the views login.php (by submit login form)
$nick_zalo = $_POST["ten_dang_nhap"];
$password = $_POST["password"];
$login_action = new login_action();

// var_dump($nick_zalo);

$login_action->login_accept($nick_zalo, $password);
// print_r("<pre>");
// var_dump($_SESSION);
// print_r("<pre>");
// header("Location: http://" . $_SERVER["HTTP_HOST"]);