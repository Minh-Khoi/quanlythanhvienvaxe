<?
include dirname(__FILE__, 2) . "/templates/quanly_session.php";

require_once dirname(__FILE__, 2) . "/models/action/action.php";
require_once dirname(__FILE__, 2) . "/models/dao/member.dao.php";

$action = new action();
$noidung_lich = $_POST['noidung_lich'];
$nhom_diem = $_POST['nhom_diem'];
$ngaythang_datlich = $_POST['ngaythang_datlich'];


$zalo_chulich  = $_POST['zalo_chulich'];
$zalo_laixe  = $_POST['zalo_laixe'];
// FIND ID of Chulich and Laixe
$memberDAO = new memberDAO();
$chulich_id = $memberDAO->read_by_zalo($zalo_chulich)->member_id;
$laixe_id = $memberDAO->read_by_zalo($zalo_laixe)->member_id;

if (isset($chulich_id) && isset($laixe_id)) {
  $action->add_lich($chulich_id, $laixe_id, $noidung_lich, $nhom_diem, $ngaythang_datlich);
} else {
  $_SESSION["chulich_wrong_zalo"] = (isset($chulich_id)) ? "" : "không có zalô chủ lịch $zalo_chulich";
  $_SESSION["laixe_wrong_zalo"] = (isset($zalo_laixe)) ? "" : "không có zalô lái xe $zalo_laixe";
}
header("Location: http://" . $_SERVER['HTTP_HOST'] . "/phanvung_ketoan.php");