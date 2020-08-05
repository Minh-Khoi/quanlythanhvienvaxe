<?php

session_set_cookie_params(3600, "/");
session_start();
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

  <h1>Danh sách thành viên bị khóa</h1>

  <!-- Search fields -->
  <input type="text" id="myInput" onkeyup="searchTable()"
    placeholder="tìm theo tên, biến số xe, nick zalô, tình trạng hoạt động">

  <table align="center" border="1" id="myTable">
    <thead>
      <tr>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($_SESSION["list_member"] as $index => $member) {
        if ($member->trang_thai != 1){
          echo "<tr class='row'>";
          echo "<td>" . $member->member_id . "</td>";
          echo "<td>" . $member->ho_ten . "</td>";
          echo "<td>" . $member->nick_zalo . "</td>";
          echo "<td>" . $member->so_dienthoai . "</td>";
          echo "<td>" . $member->thoidiem_bikhoa . "</td>";
          echo "<td>" . $member->thoihan_bikhoa . "</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>

</body>
<script>
function logout() {
  // console.log(window.location.host);
  fetch('controllers/logout_controller.php')
    .then(res => {
      window.location.assign("http://" + window.location.host);
    })
}

/** Function này xử lý chức năng tìm kiếm trong bảng */
function searchTable() {
  // Declare variables 
  let input, filter, table, tr, tds;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.querySelectorAll("tr.row");
  // console.log(input);
  // Loop through all table rows, and hide those who don't match the search query
  for (let i = 0; i < tr.length; i++) {
    tds = tr[i].getElementsByTagName("td");
    let txtValues = [];
    for (let j = 0; j < tds.length; j++) {
      txtValues.push(tds[j].textContent || tds[j].innerText);
    }
    for (let j = 0; j < tds.length; j++) {
      if ((txtValues[j].toUpperCase().indexOf(filter) > -1)) {
        tr[i].style.display = "";
        // console.log(txtValues[j]);
        // console.log(filter);
        break;
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

</html>