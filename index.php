<?php
require_once dirname(__FILE__) . "/models/dto/quantrivien.php";

// KIỂM TRA SESSION
// Nếu trang này được tải tiếp tục tiến trình session. thiết lập session_id với id của session cũ
if (isset($_SESSION['ID'])) {
  session_id($_SESSION['ID']);
}
session_start();
// Nếu trang này được tải bắt đầu lại với session mới. Sử dụng hàm session_regenerate_id()
if (!isset($_SESSION['ID'])) {
  session_regenerate_id();
}
$_SESSION["ID"] = session_id();
// var_dump($_SESSION["list_quantrivien"][0]);

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
  <h1>Hệ thống quản lý Group Highland</h1>
  <table align="center" border="1">
    <thead>
      <tr>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($_SESSION["list_quantrivien"] as $index => $quantrivien) {
        echo "<tr>";
        echo "<td>" . $quantrivien->quantrivien_id . "</td>";
        echo "<td>" . $quantrivien->nick_zalo . "</td>";
        echo "<td>" . $quantrivien->loai_key . "</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

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