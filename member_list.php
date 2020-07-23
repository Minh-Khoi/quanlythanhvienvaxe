<?
require_once dirname(__FILE__) . "/models/dto/member.php";

include dirname(__FILE__) . "/templates/quanly_session.php";
// /** LÀM CÁC BƯỚC NÀY ĐỐI VỚI CÁC FILE ĐƯỢC GỌI BẰNG API */
// // BƯỚC 1: KIỂM TRA SESSION
// // Nếu trang này được tải tiếp tục tiến trình session trước đó. thiết lập session_id với id của session cũ
// if (isset($_SESSION['ID'])) {
//   session_id($_SESSION['ID']);
// }
// session_set_cookie_params(360, "/");
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
// }
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
  <h1>Hệ thống quản lý Group Highland</h1>
  <!-- This button rollback to homepage -->
  <form action="controllers/rollback_home.php">
    <input type="submit" value="return to HOME">
  </form>

  <!-- Search fields -->
  <input type="text" id="myInput" onkeyup="searchTable()" placeholder="tìm theo tên, biến số xe, nick zalô, tình trạng hoạt động">

  <table align="center" border="1" id="myTable">
    <thead>
      <tr>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum dolor.</th>
        <th>Lorem, ipsum.</th>
        <th>Lorem, </th>
        <th>Lorem, </th>
      </tr>
    </thead>
    <tbody>
      <?php
      function get_shortform_of_ghichu(string $ghichu)
      {
        $array = explode(" ", $ghichu);
        $res = "";
        $i = 0;
        while ($i < 4 && $i < count($array)) {
          $res .= $array[$i] . " ";
          $i++;
          if ($i == 4 && count($array) >= 5) {
            $res .= "...";
          }
        }
        return $res;
      }

      foreach ($_SESSION["list_member"] as $index => $member) {
        echo "<tr class='row'>";
        echo "<td>" . $member->member_id . "</td>";
        echo "<td>" . $member->ho_ten . "</td>";
        echo "<td>" . $member->nick_zalo . "</td>";
        echo "<td>" . $member->so_dienthoai . "</td>";
        echo "<td>" . (($member->trang_thai == 1) ? "Bình thường" : "không HĐ") . "</td>";
        echo "<td>" . $member->BKS . "</td>";
        echo "<td>" . get_shortform_of_ghichu($member->ghi_chu) . "</td>";
        echo "<td>" . (($member->co_coc == 1) ? "x" : "") . "</td>";
        echo "<td>" . (($member->co_anh == 1) ? "x" : "") . "</td>";
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
                      <b>có cọc</b>: " . (($member->co_coc == 'x') ? 'có' : 'không') . `
                  </div>

              </div>`;
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

  // Xử lý Modals khi người dùng click vào một row trong bảng
  // Get the modal
  let modals = document.getElementsByClassName("myModal");
  // Get the button that opens the modal
  let rows = document.querySelectorAll("tr.row");
  for (let i = 0; i < rows.length; i++) {
    // When the user clicks on the button, open the modal 
    console.log(i);
    rows[i].onclick = function() {
      console.log(i);
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