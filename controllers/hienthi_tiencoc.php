<?php
session_start();

require_once dirname(__FILE__, 2) . "/models/action/action.php";

$zalo = $_POST['zalo_laixe'];
$action = new action();

echo $action->hienthi_tiencoc($zalo);