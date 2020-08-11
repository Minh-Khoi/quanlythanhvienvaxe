<?php

session_start();
require_once dirname(__FILE__, 2) . "/models/action/action.php";

$member_id = $_POST["member_id"];
$is_forced = $_POST["is_forced"];

$action = new action();
$action->release_thanhvien($member_id, $is_forced);