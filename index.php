<?php
// nếu người dùng chưa đăng nhập thì chuyển tới trang đăng nhập
if (!isset($_POST["member"])) {
  header("Location: login.php");
}
// nếu người dùng đã đăng nhập thì kiểm tra xem người dùng có phải admin hay không
// nếu phải thì chuyển tới trang key list admin, nếu không phải thì chuyển tới key_list_member
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
  <h1>Hệ thống quản lý Group Highland</h1>
  <table align="center" border="1">
    <thead>
      <tr>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
      </tr>
      <tr>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
      </tr>
      <tr>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
        <td>Lorem, ipsum.</td>
      </tr>
    </tbody>
  </table>


</body>

</html>