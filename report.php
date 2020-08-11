<?php
require_once dirname(__FILE__) . "/models/dto/member.php";

session_set_cookie_params(3600, "/");
session_start();
// $_SESSION['ID'] = session_id();
// var_dump($_SESSION);
//  KIỂM TRA ĐĂNG NHẬP: 
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
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Hệ thống quản lý Group Highland</title>
</head>

<body style="text-align: center">
  <button onclick="logout()"> LOG OUT </button>
  <h1>danh sách điểm đến ngày <?= date("d/m/Y h:m:s", time()) ?></h1>
  <table align="center" border="1">
    <thead>
      <tr>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
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
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
  <form action="controllers/load_memberlist.php" method="post">
    <label for="xe_va_thanhvien">Quản lý xe và thành viên</label>
    <input type="submit" value="GO" id="xe_va_thanhvien">
  </form>
  <form action="quanly_kich.php" method="post">
    <label for="kich">Quản lý Kích (Khóa)</label>
    <input type="submit" value="GO" id="kich">
  </form>
  <form action="phanvung_ketoan.php" method="post">
    <label for="phanvung_ketoan">Quản lý điểm và phân vùng kế toán</label>
    <input type="submit" value="GO" id="phanvung_ketoan">
  </form>
</body>
<script>
function logout() {
  // console.log(window.location.host);
  fetch('controllers/logout_controller.php').then(res => res.text())
    .then(res => {
      console.log(res);
      window.location.assign("http://" + window.location.host);
    })
}
</script>

</html>