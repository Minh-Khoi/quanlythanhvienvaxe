<?php

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
// nếu người dùng ĐÃ đăng nhập thì chuyển tới trang index
if (isset($_SESSION["is_quantrivien"])) {
  header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hệ thống quản lý Group Highland</title>
</head>

<body style="text-align: center">
  <h1> Hệ thống quản lý Group Highland</h1>
  <h6 style="color: red"><?php echo isset($_SESSION["login_error"]) ? $_SESSION["login_error"] : "" ?></h6>
  <form action="controllers/login_controller.php" method="POST">
    <label for="ten_dang_nhap">Tên đăng nhập</label>
    <input type="text" name="ten_dang_nhap" id="ten_dang_nhap">
    <br>
    <label for="password">password</label>
    <input type="text" name="password" id="password">
    <input type="submit" value="OK">
  </form>
</body>

</html>