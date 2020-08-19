<?
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
  <form action="quanly_kich.php" method="post">
    <label for="kich">Quản lý Kích (Khóa)</label>
    <input type="submit" value="GO" id="kich">
  </form>
  <form action="phanvung_ketoan.php" method="post">
    <label for="phanvung_ketoan">Quản lý điểm và phân vùng kế toán</label>
    <input type="submit" value="GO" id="phanvung_ketoan">
  </form>

  <h1>Hệ thống quản lý Group Highland</h1>
  <!-- This button rollback to homepage -->
  <form action="controllers/rollback_home.php">
    <input type="submit" value="return to HOME">
  </form>

  <!-- Search fields -->
  <input type="text" id="myInput" onkeyup="searchTable()"
    placeholder="tìm theo tên, biến số xe, nick zalô, tình trạng hoạt động">

  <table align="center" border="1" id="myTable">
    <thead>
      <tr>
        <th>STT</th>
        <th>Họ tên</th>
        <th>Nick Zalo</th>
        <th>Số điện thoại</th>
        <th>Trạng thái</th>
        <th>Biển kiểm soát</th>
        <th>Ghi chú</th>
        <th>Có cọc </th>
        <th>Có ảnh </th>
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
        echo "<td>" . (isset($member->co_coc) ? "x" : "") . "</td>";
        echo "<td>" . ((strlen($member->co_anh) > 0) ? "x" : "") . "</td>";
        echo "</tr>";

        // Prepare links for images
        $images =  $member->get_array_of_link_anh();
        // var_dump($images);

        echo "<!-- The Modal -->
        
          <div  class='modal myModal'>
              <!-- Modal content -->

            <div class='modal-content'>
              <!-- Field of images -->
              <div class=\"img_fields_for{$member->member_id}\">";
        for ($i = 0; $i < count($images) - 1; $i++) {
          echo "<img src=\"{$images[$i]}\" alt=\"ảnh\" style=\"width:50px;height:60px;\" >";
        }
        echo  " <br>
                <input type=\"file\" value=\"Upload ảnh\">
                <button onclick=\"them_anh({$member->member_id})\">UPLOAD</button>
              </div> 
              <b>Lái xe</b>: $member->ho_ten <br>
                  <b>số điện thoại</b>: $member->so_dienthoai<br>
                  <b>trạng thái</b>: " . (($member->trang_thai == 1) ? 'Bình thường' : 'không HĐ')  . " <br>
                  <b>ghi chú</b>: $member->ghi_chu <br>
                  <b>Biển số xe</b>: $member->BKS <br>
                  <b>có cọc</b>: "
          . ((isset($member->co_coc) && is_numeric($member->co_coc)) ? 'có' : 'không') . '<br>
            '
          // Vùng này để form hoán đổi
          . '
                <button onclick="show_field_hoandoi(' . $member->member_id . ')">Hoán đổi đến vị trí số</button>
                <div style="display:none" class="hoandoi_chothanhvien' . $member->member_id . '">
                  <input type="text" > <button onclick="handle_hoandoi( '
          . $member->member_id . ',0)">OK</button> <br>
                  <button onclick="handle_hoandoi(' . $member->member_id . ','
          . (($member->member_id != 1) ? (intval($member->member_id) - 1) : 0)
          . ')"> Lên trên </button>  
                  <button onclick="handle_hoandoi(' . $member->member_id . ','
          . (($member->member_id != count($_SESSION["list_member"])) ? (intval($member->member_id) + 1) : 0)
          . ')"> xuống dưới </button>    
                </div> <br>' .
          // vùng ngày để form "KHÓA thành viên"
          '
              <button onclick="show_field_khoathanhvien(' . $member->member_id . ')">KHÓA thành viên này</button>
              <div style="display:none" class="khoa_chothanhvien' . $member->member_id . '">
                <input type="number" 
                    class="thoigian_khoathanhvien' . $member->member_id . '" placeholder="Khóa bao lâu">
                <select class="donvi_thoigian_khoathanhvien' . $member->member_id . '">
                  <option value="hour">giờ</option>
                  <option value="day">ngày</option>
                  <option value="month">tháng</option>
                </select>
                <button onclick="handle_khoathanhvien(' . $member->member_id . ')">OK</button> <br>
              </div> <br>
          </div>

        </div>';
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

/** Hiển thị text field và button cho chức năng hoán đổi vị trí */
function show_field_hoandoi(id_thanhvien) {
  if (document.querySelector(".hoandoi_chothanhvien" + id_thanhvien).style.display == "none") {
    document.querySelector(".hoandoi_chothanhvien" + id_thanhvien).style.display = "block";
  } else {
    document.querySelector(".hoandoi_chothanhvien" + id_thanhvien).style.display = "none";
  }
}

/** Hiển thị text field và button cho chức năng khóa thành viên */
function show_field_khoathanhvien(id_thanhvien) {
  // console.log(id_thanhvien);
  if (document.querySelector(".khoa_chothanhvien" + id_thanhvien).style.display == "none") {
    document.querySelector(".khoa_chothanhvien" + id_thanhvien).style.display = "block";
  } else {
    document.querySelector(".khoa_chothanhvien" + id_thanhvien).style.display = "none";
  }
}

/** Call API handle_hoandoi để hoán đổi thông tin giữa các thành viên */
function handle_hoandoi(id_bandau, id_moi) {
  let id_bandau_send = id_bandau;
  let id_moi_send = -1;
  // Nếu ID mới == 0 thì lấy giá trị trong ô input, trường hợp ô input rỗng thì không thực hiện lệnh fetch API
  if ((id_moi == 0) &&
    document.querySelector(".hoandoi_chothanhvien" + id_bandau + " input").value.length == 0) {
    // do nothing
  } else {
    if (id_moi == 0) {
      id_moi_send = document.querySelector(".hoandoi_chothanhvien" + id_bandau + " input").value;
    } else {
      id_moi_send = id_moi;
    }
    // console.log(id_moi_send);
    // Call Fetch API
    let form_datas = new FormData();
    form_datas.append("id_bandau_send", id_bandau_send);
    form_datas.append("id_moi_send", id_moi_send);
    // console.log(id_moi_send);
    fetch("controllers/hoan_doi.php", {
        method: "POST",
        body: form_datas
      }).then(res => res.text())
      .then(res => {
        if (res.length == 0) {
          alert("Hoán đổi thành công" + res);
        } else {
          alert(res);
        }
        window.location.assign("http://" + window.location.host + "/controllers/load_memberlist.php");
      })
  }
}

/** Call API handle_hoandoi để khóa 01 thành viên */
function handle_khoathanhvien(id_thanhvien) {
  let thoigian_khoathanhvien = document.querySelector(".thoigian_khoathanhvien" + id_thanhvien).value;
  let donvi_thoigian_khoathanhvien = document.querySelector(".donvi_thoigian_khoathanhvien" + id_thanhvien).value;

  let form_datas = new FormData();
  form_datas.append("id_thanhvien", id_thanhvien);
  form_datas.append("thoigian_khoathanhvien", thoigian_khoathanhvien);
  form_datas.append("donvi_thoigian_khoathanhvien", donvi_thoigian_khoathanhvien);
  fetch("controllers/khoa_chothanhvien.php", {
      method: "POST",
      body: form_datas
    }).then(res => res.text())
    .then(res => {
      if (res.length == 0) {
        alert("Khóa thành công " + res);
      } else {
        alert(res);
      }
      window.location.assign("http://" + window.location.host + "/controllers/load_memberlist.php");
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
        break;
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

/** Handle feature thêm ảnh cho member */
function them_anh(id) {
  let files = document.querySelector(".img_fields_for" + id + " input").files[0];
  let form_datas = new FormData();
  form_datas.append("id_thanhvien", id);
  form_datas.append("files", files);
  fetch('controllers/them_anh.php', {
      method: "POST",
      body: form_datas
    }).then(res => res.text())
    .then(res => {
      if (res == "") {
        alert("thêm ảnh thành công");
        window.location.assign("http://" + window.location.host + "/controllers/load_memberlist.php");
      } else {
        alert(res);
      }
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