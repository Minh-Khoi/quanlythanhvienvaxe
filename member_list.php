<?
require_once dirname(__FILE__) . "/models/dto/member.php";

/** LÀM CÁC BƯỚC NÀY ĐỐI VỚI CÁC FILE ĐƯỢC GỌI BẰNG API */
// BƯỚC 1: KIỂM TRA SESSION
// Nếu trang này được tải tiếp tục tiến trình session trước đó. thiết lập session_id với id của session cũ
if (isset($_SESSION['ID'])) {
  session_id($_SESSION['ID']);
}
session_start();
// Nếu trang này được tải bắt đầu lại với session mới. Sử dụng hàm session_regenerate_id()
if (!isset($_SESSION['ID'])) {
  session_regenerate_id();
}
$_SESSION["ID"] = session_id();
// BƯỚC 2: KIỂM TRA ĐĂNG NHẬP: 
// nếu người dùng chưa đăng nhập thì chuyển tới trang đăng nhập
if (!isset($_SESSION["is_quantrivien"])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Quản lý Group Highland</title>
</head>

<body style="text-align: center">
  <button onclick="logout()"> LOG OUT </button>
  <h1>Hệ thống quản lý Group Highland</h1>
  <table align="center" border="1">
    <thead>
      <tr>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum.</th>
        <th>Lorem, </th>
        <th>Lorem, </th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($_SESSION["list_member"] as $index => $member) {
        echo "<tr>";
        echo "<td>" . $member->member_id . "</td>";
        echo "<td>" . $member->ho_ten . "</td>";
        echo "<td>" . $member->nick_zalo . "</td>";
        echo "<td>" . $member->so_diem . "</td>";
        echo "<td>" . (($member->trang_thai == 1) ? "Bình thường" : "không HĐ") . "</td>";
        echo "<td>" . $member->BKS . "</td>";
        echo "<td>" . $member->ghi_chu . "</td>";
        echo "<td>" . (($member->co_coc == 1) ? "x" : "") . "</td>";
        echo "<td>" . (($member->co_anh == 1) ? "x" : "") . "</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
  <form action="" method="post">
    <label for="xe_va_thanhvien">Quản lý xe và thành viên</label>
    <input type="submit" value="GO" id="xe_va_thanhvien">
  </form>
  <form action="" method="post">
    <label for="kich">Quản lý Kích (Khóa)</label>
    <input type="submit" value="GO" id="kich">
  </form>
  <form action="" method="post">
    <label for="phanvung_ketoan">Quản lý điểm và phân vùng kế toán</label>
    <input type="submit" value="GO" id="phanvung_ketoan">
  </form>
</body>
<script>
function logout() {
  console.log(window.location.host);
  fetch('controllers/logout_controller.php')
    .then(res => {
      window.location.assign("http://" + window.location.host);
    })
}
</script>

</html>