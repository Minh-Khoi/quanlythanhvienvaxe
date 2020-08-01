<?php
session_unset();
session_set_cookie_params(3600, "/");
session_start();
// KIỂM TRA ĐĂNG NHẬP: 
// nếu người dùng đã đăng nhập thì chuyển tới trang chính
if (isset($_SESSION["is_quantrivien"])) {
  header("Location: http://" . $_SERVER["HTTP_HOST"]);
}

?>
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