<?

require_once dirname(__FILE__) . "/models/dao/lich.dao.php";
require_once dirname(__FILE__) . "/models/dao/member.dao.php";

session_set_cookie_params(3600, "/");
session_start();
$_SESSION['search_lich'] = (isset($_POST['search_lich'])) ? $_POST['search_lich'] : $_SESSION['search_lich'];

$noidung_lich = $_SESSION['search_lich'];
$lichDAO = new lichDAO();
$lich = $lichDAO->read_by_noidung($noidung_lich);
if (!isset($lich)) {
  die("Không tìm thấy lịch với nội dung trên");
}

$memberDAO = new memberDAO();
$chulich = $memberDAO->read_by_id($lich->chulich_id);
$laixe = $memberDAO->read_by_id($lich->laixe_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tra cứu Lịch </title>
</head>

<body style="text-align: center">
  <h1>TRa cứu lịch số <?= $lich->lich_id ?></h1>
  <p>
    <b>nội dung:</b> <?= $noidung_lich ?>
  </p>
  <p>
    <b>Chủ lịch:</b> <?= $chulich->ho_ten . ' (' . $chulich->nick_zalo . ')' ?>
  </p>
  <p>
    <b>Lái xe:</b> <?= $laixe->ho_ten . ' (' . $laixe->nick_zalo . ')' ?>
  </p>
  <p>
    <b>Nhóm điểm:</b> <?= $lich->nhom_diem ?>
  </p>
  <p>
    <b>Ngày đặt lịch:</b> <?= $lich->ngay_thang ?>
  </p>
  <form action="phanvung_ketoan.php">
    <input type="submit" value="Trở lại">
  </form>
</body>

</html>