<?php
session_start();

require_once dirname(__FILE__, 2) . "/models/action/action.php";

$action = new action();

$id_bandau = $_POST["id_bandau_send"];
$id_moi = $_POST["id_moi_send"];

$action->hoan_doi($id_bandau, $id_moi);