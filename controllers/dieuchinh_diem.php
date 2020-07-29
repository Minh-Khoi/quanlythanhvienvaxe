<?
include dirname(__FILE__, 2) . "/templates/quanly_session.php";

require_once dirname(__FILE__, 2) . "/models/action/action.php";

$nick_zalo = $_POST['nick_zalo_laixe'];
$diem_dieuchinh = $_POST['diem_dieuchinh'];
echo $diem_dieuchinh;

$action = new action();
$action->dieuchinh_diem($nick_zalo, $diem_dieuchinh);

// $_SESSION['dieuchinhdiem_member'] được thiết lập trong hàm $action->dieuchinh_diem();
header("Location: http://" . $_SERVER["HTTP_HOST"] . "/phanvung_ketoan.php");