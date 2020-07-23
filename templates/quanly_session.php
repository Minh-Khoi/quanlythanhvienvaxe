<?

/** LÀM CÁC BƯỚC NÀY ĐỐI VỚI CÁC FILE ĐƯỢC GỌI BẰNG API */
// BƯỚC 1: KIỂM TRA SESSION
// Nếu trang này được tải tiếp tục tiến trình session trước đó. thiết lập session_id với id của session cũ
if (isset($_SESSION['ID'])) {
  session_id($_SESSION['ID']);
}
session_set_cookie_params(3600, "/");
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
} else {
  if ($_SESSION["is_quantrivien_key"] != "key vàng" && $_SESSION["is_quantrivien_key"] != "kế toán") {
    header("Location: http://" . $_SERVER["HTTP_HOST"]);
  }
}
