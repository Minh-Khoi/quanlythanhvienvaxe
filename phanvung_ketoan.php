<?php
require_once dirname(__FILE__) . "/models/dto/quantrivien.php";
require_once dirname(__FILE__) . "/models/dto/member.php";


session_set_cookie_params(3600, "/");
session_start();
if ($_SESSION['is_quantrivien_key'] != "key vàng" && $_SESSION['is_quantrivien_key'] != "kế toán") {
  die("<b>bạn không có quyền truy cập trang này</b>");
}

// make the input value blank
unset($_SESSION["dieuchinhdiem_member"]);
unset($_SESSION["dieuchinhcoc_member"]);
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

  <!-- Form chuyển trang -->
  <form action="controllers/load_memberlist.php" method="post">
    <label for="xe_va_thanhvien">Quản lý xe và thành viên</label>
    <input type="submit" value="GO" id="xe_va_thanhvien">
  </form>
  <form action="" method="post">
    <label for="kich">Quản lý Kích (Khóa)</label>
    <input type="submit" value="GO" id="kich">
  </form>
  <form action="phanvung_ketoan.php" method="post">
    <label for="phanvung_ketoan">Quản lý điểm và phân vùng kế toán</label>
    <input type="submit" value="GO" id="phanvung_ketoan">
  </form>

  <div class="" style="margin:0 25vw; border: 2px dotted red; text-align: center">
    <h1>Hệ thống quản lý Group Highland</h1>
    <h2>Tính điểm và phân vùng kế toán</h2>

    <!-- Vùng này cho mục THÊM LỊCH -->
    <h5>THÊM LỊCH</h5>
    <form class="grid-container-1" id="nhom_diem" method="POST" action="controllers/add_lich.php">
      <label for="noidung_lich">Thêm lịch</label>
      <div style="text-align: justify">
        <input type="text" name="noidung_lich" id="noidung_lich" placeholder="Nội dung lịch" required> <br>
        <input type="text" name="zalo_chulich" id="zalo_chulich" placeholder="nick zalo chủ lịch" required>
      </div>
      <label for="zalo_laixe">Lái xe</label>
      <div style="text-align: justify">
        <input type="text" name="zalo_laixe" id="zalo_laixe" placeholder="nick zalo lái xe" required>
      </div>
      <label for="nhom_diem">Nhóm điểm</label>
      <div style="text-align: justify">
        +-
        <select name="nhom_diem" id="nhom_diem">
          <option value="0.5" selected>0.5</option>
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
    <p style="color: red">
      <? echo (isset($_SESSION['chulich_wrong_zalo']) ? $_SESSION['chulich_wrong_zalo'] : "") . "<br>"
        . (isset($_SESSION['laixe_wrong_zalo']) ? $_SESSION['laixe_wrong_zalo'] : ""); ?>
    </p>

    <!-- Vùng này cho mục Tìm kiếm LỊCH -->
    <form action="tracuu_lich.php" method="POST" class="grid-container-2" id="timkiem_lich">
      <label for="search_lich">Tìm kiếm</label>
      <div style="text-align: justify">
        <input type="text" name="search_lich" id="search_lich" style="width: 100%" placeholder="tìm kiếm thông tin lịch"
          <?= (isset($_SESSION['search_lich']) ? "value='{$_SESSION['search_lich']}'" : "") ?>>
      </div>
      <input type="submit" value="TÌm kiếm">
    </form>

    <!-- VÙng này cho mục điều chỉnh điểm -->
    <form action="controllers/dieuchinh_diem.php" class="grid-container-2" id="dieuchinh_diem" method="POST"
      style="margin-bottom:0">
      <label for="diem_dieuchinh">Điều chỉnh điểm</label>
      <div style="text-align: justify">
        <input type="text" name="nick_zalo_laixe" id="nick_zalo_laixe" style="width: 100%"
          placeholder="Copy nick zalo lái xe" onblur="hienthidiem_onblur()"
          <?= (isset($_SESSION['dieuchinhdiem_member'])) ? "value='{$_SESSION['dieuchinhdiem_member']['zalo']}'" : "" ?>>
      </div>
      <div style="text-align: justify">
        <input type="text" name="diem_laixe" id="diem_laixe" style="width: 85%" disabled
          <?= (isset($_SESSION['dieuchinhdiem_member'])) ? "value='{$_SESSION['dieuchinhdiem_member']['diem']}'" : "" ?>>
      </div>
      <div style="text-align: justify">
        <select name="diem_dieuchinh" id="diem_dieuchinh" style="width: auto">
          <option value="0.5" selected>+0.5</option>
          <option value="1">+1</option>
          <option value="1.5">+1.5</option>
          <option value="2">+2</option>
          <option value="3">+3</option>

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
    <form action="controllers/dat_coc.php" class="grid-container-2" id="coc" method="POST">
      <label for="tien_coc">Cọc</label>
      <div style="text-align: justify">
        <input type="text" name="nick_zalo_laixe_coc" id="nick_zalo_laixe_coc" style="width: 100%"
          placeholder="Copy nick zalo lái xe" onblur="hienthitiencoc()"
          <?= (isset($_SESSION['dieuchinhcoc_member'])) ? "value='{$_SESSION['dieuchinhcoc_member']['zalo']}'" : "" ?>>
      </div>
      <div style="text-align: justify">
        <input type="text" name="tien_coc" id="tien_coc" style="width: 85%"
          <?= (isset($_SESSION['dieuchinhcoc_member'])) ? "value='{$_SESSION['dieuchinhcoc_member']['tien']}'" : "" ?>>
      </div>
      <input type="submit" value="OK">
    </form>

  </div>
</body>
<script src="./javascript_files/main.js"></script>
<script>
/** THis function use for event onblur of element input #hien_thi_diem */
function hienthidiem_onblur() {
  let form_datas = new FormData();
  let laixe = document.getElementById('nick_zalo_laixe');
  let zalo_laixe = laixe.value;
  form_datas.append("zalo_laixe", zalo_laixe);
  // console.log(document.querySelector('select#diem_dieuchinh').value);

  fetch("controllers/hienthi_diem_member.php", {
      method: "POST",
      body: form_datas
    }).then(res => res.text())
    .then((res) => {
      document.querySelector('input#diem_laixe').value = res;
    })
}

/** THis function use for event onblur of element input #tien_coc */
function hienthitiencoc() {
  let form_datas = new FormData();
  let laixe = document.getElementById('nick_zalo_laixe_coc');
  let zalo_laixe = laixe.value;
  form_datas.append("zalo_laixe", zalo_laixe);

  fetch("controllers/hienthi_tiencoc.php", {
      method: "POST",
      body: form_datas
    }).then(res => res.text())
    .then((res) => {
      document.querySelector('input#tien_coc').value = res;
    })
}
</script>

</html>

<?
unset($_SESSION['chulich_wrong_zalo']);
unset($_SESSION['laixe_wrong_zalo']);
unset($_SESSION['search_lich']);
unset($_SESSION['dieuchinhdiem_member']);
unset($_SESSION['dieuchinhcoc_member']);