<?php
session_start();

require_once dirname(__FILE__, 2) . "/models/action/action.php";

$tien_coc = $_POST["tien_coc"];
$thanhvien_datcoc  = $_POST["nick_zalo_laixe_coc"];
var_dump($thanhvien_datcoc);
$action = new action();
$action->dat_coc($thanhvien_datcoc, $tien_coc);
// $_SESSION['dieuchinhcoc_member'] được thiết lập trong hàm $action->dieuchinh_diem();

header("Location: http://" . $_SERVER['HTTP_HOST'] . "/phanvung_ketoan.php");