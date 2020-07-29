<?
include dirname(__FILE__, 2) . "/templates/quanly_session.php";

require_once dirname(__FILE__, 2) . "/models/action/action.php";

$action = new action();
$nick_zalo = $_POST['zalo_laixe'];
$result = $action->hienthi_diem($nick_zalo);

echo $result;