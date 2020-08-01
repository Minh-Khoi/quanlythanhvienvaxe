<?php

// include dirname(__FILE__, 2) . "/templates/quanly_session.php";
session_start();
require_once dirname(__FILE__, 2) . "/models/action/logout_action.php";


$logout_action = new logout_action();
$logout_action->logout_done();