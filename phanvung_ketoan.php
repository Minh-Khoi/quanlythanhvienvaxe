<?php
require_once dirname(__FILE__) . "/models/dto/quantrivien.php";
require_once dirname(__FILE__) . "/models/dto/member.php";

include dirname(__FILE__) . "/templates/quanly_session.php";
// /** LÀM CÁC BƯỚC NÀY ĐỐI VỚI CÁC FILE ĐƯỢC GỌI BẰNG API */
// // BƯỚC 1: KIỂM TRA SESSION
// // Nếu trang này được tải tiếp tục tiến trình session trước đó. thiết lập session_id với id của session cũ
// if (isset($_SESSION['ID'])) {
//   session_id($_SESSION['ID']);
// }
// session_set_cookie_params(3600, "/");
// session_start();
// // Nếu trang này được tải bắt đầu lại với session mới. Sử dụng hàm session_regenerate_id()
// if (!isset($_SESSION['ID'])) {
//   session_regenerate_id();
// }
// $_SESSION["ID"] = session_id();
// // BƯỚC 2: KIỂM TRA ĐĂNG NHẬP: 
// // nếu người dùng chưa đăng nhập thì chuyển tới trang đăng nhập
// if (!isset($_SESSION["is_quantrivien"])) {
//   header("Location: login.php");
// } else {
//   if ($_SESSION["is_quantrivien_key"] != "key vàng" && $_SESSION["is_quantrivien_key"] != "kế toán") {
//     header("Location: http://" . $_SERVER["HTTP_HOST"]);
//   }
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hệ thống quản lý Group Highland</title>
  <style>
  .grid-container-1 {
    display: grid;
    grid-template-columns: 10vw auto;
    /* grid-template-rows: 30px; */
    grid-gap: 10px;
    margin: 15px auto;
  }

  .grid-container-2 {
    display: grid;
    grid-template-columns: 10vw 12vw 8vw 11vw;
    /* grid-template-rows: 30px; */
    grid-gap: 15px;
    margin: 15px auto;
  }
  </style>
</head>

<body style="text-align: center">
  <button onclick="logout()"> LOG OUT </button>
  <div class="" style="margin:0 25vw; border: 2px dotted red; text-align: center">
    <h1>Hệ thống quản lý Group Highland</h1>
    <h2>Tính điểm và phân vùng kế toán</h2>

    <!-- Vùng này cho mục THÊM LỊCH -->
    <h5>THÊM LỊCH</h5>
    <form class="grid-container-1" id="nhom_diem" method="POST" action="controllers/add_lich.php">
      <label for="noidung_lich">Thêm lịch</label>
      <div style="text-align: justify">
        <input type="text" name="noidung_lich" id="noidung_lich" placeholder="Nội dung lịch"> <br>
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

    <!-- Vùng này cho mục Tìm kiếm LỊCH -->
    <form action="" class="grid-container-2" id="timkiem_lich">
      <label for="search_lich">Tìm kiếm</label>
      <div style="text-align: justify">
        <input type="text" name="search_lich" id="search_lich" style="width: 100%"
          placeholder="tìm kiếm thông tin lịch">
      </div>
      <input type="submit" value="TÌm kiếm">
    </form>

    <!-- VÙng này cho mục điều chỉnh điểm -->
    <form action="" class="grid-container-2" id="dieuchinh_diem" style="margin-bottom:0">
      <label for="diem_dieuchinh">Điều chỉnh điểm</label>
      <div style="text-align: justify">
        <input type="text" name="nick_zalo_laixe" id="nick_zalo_laixe" style="width: 100%"
          placeholder="Copy nick zalo lái xe">
      </div>
      <div style="text-align: justify">
        <input type="text" name="diem_laixe" id="diem_laixe" style="width: 85%" disabled>
      </div>
      <div style="text-align: justify">
        <select name="diem_dieuchinh" id="diem_dieuchinh" style="width: auto">
          <option value="+0.5">+0.5</option>
          <option value="+1">+1</option>
          <option value="+1.5">+1.5</option>
          <option value="+2">+2</option>
          <option value="+3">+3</option>

          <option value="-0.5">-0.5</option>
          <option value="-1">-1</option>
          <option value="-1.5">-1.5</option>
          <option value="-2">-2</option>
          <option value="-3">-3</option>
        </select>
        <input type="submit" value="OK" style="margin-left: 5px">
      </div>
    </form>

    <!-- VÙng này cho mục tiền CỌC -->
    <form action="" class="grid-container-2" id="coc">
      <label for="tien_coc">Cọc</label>
      <div style="text-align: justify">
        <input type="text" name="nick_zalo_laixe" id="nick_zalo_laixe" style="width: 100%"
          placeholder="Copy nick zalo lái xe">
      </div>
      <div style="text-align: justify">
        <input type="text" name="tien_coc" id="tien_coc" style="width: 85%">
      </div>
      <input type="submit" value="OK">
    </form>

  </div>
</body>
<script src="./javascript_files/main.js"></script>

</html>