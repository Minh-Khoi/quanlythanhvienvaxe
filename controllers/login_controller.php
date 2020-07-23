<?php

include dirname(__FILE__, 2) . "/templates/quanly_session.php";

require_once dirname(__FILE__, 2) . "/models/action/login_action.php";

//This file will be called by the views login.php (by submit login form)
$nick_zalo = $_POST["ten_dang_nhap"];
$password = $_POST["password"];
$login_action = new login_action();
$login_action->login_accept($nick_zalo, $password);
