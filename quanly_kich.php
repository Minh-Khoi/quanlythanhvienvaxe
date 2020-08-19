<?php
require_once dirname(__FILE__) . "/models/dto/member.php";

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
  <style>
    /* Modal for each cells of Table*/
    /* The Modal (background) */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.4);
      /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      /* Could be more or less, depending on screen size */
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

  <h1>Danh sách thành viên bị khóa</h1>

  <!-- Search fields -->
  <input type="text" id="myInput" onkeyup="searchTable()" placeholder="tìm theo tên, biến số xe, nick zalô, tình trạng hoạt động" />

  <table align="center" border="1" id="myTable">
    <thead>
      <tr>
        <th>STT</th>
        <th>Họ tên</th>
        <th>Nick Zalo</th>
        <th>Số điện thoại.</th>
        <th>Thời điểm bị khóa</th>
        <th>Thời hạn khóa</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($_SESSION["list_member"] as $index => $member) {
        if ($member->trang_thai != 1) {
          echo "<tr class='row'>";
          echo "<td>" . $member->member_id . "</td>";
          echo "<td>" . $member->ho_ten . "</td>";
          echo "<td>" . $member->nick_zalo . "</td>";
          echo "<td>" . $member->so_dienthoai . "</td>";
          echo "<td>" . date("d/m/Y h:m:s", $member->thoidiem_bikhoa) . "</td>";
          echo "<td>" . date("d/m/Y h:m:s", $member->thoihan_bikhoa) . "</td>";
          echo "</tr>";
          echo "<!-- The Modal -->
        
              <div  class='modal myModal'>
                  <!-- Modal content -->
                  <div class='modal-content'>
                      <b>Lái xe</b>: $member->ho_ten <br>
                      <b>số điện thoại</b>: $member->so_dienthoai<br>
                      <b>trạng thái</b>: " . (($member->trang_thai == 1) ? 'Bình thường' : 'không HĐ')  . " <br>
                      <b>ghi chú</b>: $member->ghi_chu <br>
                      <b>Biển số xe</b>: $member->BKS <br>
                      <b>Bị khóa đến ngày</b>:" . date("d/m/Y h:m:s", $member->thoihan_bikhoa) . " <br>
                      <br>
                      <button onclick=\"handle_giaikhoa({$member->member_id} )\"> Giải khóa thành viên này </button>
                  </div>
              </div>";
        }
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

  /** xử lý sự kiện giải khóa thành viên */
  function handle_giaikhoa(member_id) {
    let is_forced = true;
    let form_datas = new FormData();
    form_datas.append("member_id", member_id);
    form_datas.append("is_forced", is_forced);

    fetch("controllers/giai_khoa.php", {
        method: "POST",
        body: form_datas
      }).then(res => res.text())
      .then(res => {
        alert("GIải khóa thành công cho thành viên " + member_id);
        window.location.assign("http://" + window.location.host + "/quanly_kich.php");
      })
  }

  // Xử lý Modals khi người dùng click vào một row trong bảng
  // Get the modal
  let modals = document.getElementsByClassName("myModal");
  // Get the button that opens the modal
  let rows = document.querySelectorAll("tr.row");
  for (let i = 0; i < rows.length; i++) {
    // When the user clicks on the button, open the modal 
    rows[i].onclick = function() {
      modals[i].style.display = "block";
    };
    // When the user clicks anywhere outside of the modal, close it
    modals[i].onclick = function(event) {
      if (event.target === modals[i]) {
        modals[i].style.display = "none";
      }
    };
  }
</script>

</html>