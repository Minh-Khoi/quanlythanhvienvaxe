<?php
require_once dirname(__FILE__) . "/models/dto/quantrivien.php";
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
  <title>Hệ thống quản lý Group Highland</title>
  <style>
  .grid-container {
    display: grid;
    grid-template-columns: 10vw auto;
    /* grid-template-rows: 30px; */
    grid-gap: 10px;
    margin: 15px auto;
  }
  </style>
</head>

<body>
  <div class="" style="margin:0 25vw; border: 2px dotted red; text-align: center">
    <h1>Hệ thống quản lý Group Highland</h1>
    <h2>Tính điểm và phân vùng kế toán</h2>
    <h5>THÊM LỊCH</h5>
    <form class="grid-container" id="nhom_diem">
      <label for="them_lich">Thêm lịch</label>
      <div style="text-align: justify">
        <input type="text" name="them_lich" id="them_lich" placeholder="Nội dung lịch"> <br>
        <input type="text" name="zalo_chulich" id="zalo_chulich" placeholder="nick zalo chủ lịch">
      </div>
      <label for="zalo_laixe">Lái xe</label>
      <div style="text-align: justify">
        <input type="text" name="zalo_laixe" id="zalo_laixe" placeholder="nick zalo lái xe">
      </div>
      <label for="nhom_diem">Nhóm điểm</label>
      <div style="text-align: justify">
        +-
        <select name="nhom_diem" id="nhom_diem">
          <option value="0.5">0.5</option>
          <option value="1">1</option>
          <option value="1.5">1.5</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
      <label for="ngaythang_datlich">ngày tháng</label>
      <div style="text-align: justify">
        <input type="text" name="ngaythang_datlich" id="ngaythang_datlich" placeholder="ngày tháng đặt lịch">
      </div>
    </form>
    <input type="submit" form="nhom_diem" value="OK">
  </div>
</body>

</html>