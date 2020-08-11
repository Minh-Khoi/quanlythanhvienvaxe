<?php
session_start();

require_once dirname(__FILE__, 2) . "/models/action/action.php";

$id_thanhvien = intval($_POST["id_thanhvien"]);
$thoigian_khoathanhvien = intval($_POST["thoigian_khoathanhvien"]);
$donvi_thoigian_khoathanhvien = ($_POST["donvi_thoigian_khoathanhvien"]);

$action = new action();
$action->khoa_thanhvien($id_thanhvien, $thoigian_khoathanhvien, $donvi_thoigian_khoathanhvien);