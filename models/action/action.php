<?
require_once dirname(__FILE__, 2) . "/dao/member.dao.php";
require_once dirname(__FILE__, 2) . "/dao/quantrivien.dao.php";
require_once dirname(__FILE__, 2) . "/dao/lich.dao.php";
// error_reporting(E_ERROR | E_PARSE);

class action
{
  private $quantrivienDAO, $memberDAO, $lichDAO;

  /**
   * Class constructor.
   */
  public function __construct()
  {
    $this->quantrivienDAO = new quantrivienDAO();
    $this->memberDAO = new memberDAO();
    $this->lichDAO = new lichDAO();
  }

  /** LOad list of member from database  */
  public function load_memberlist()
  {
    $_SESSION["list_member"] = $this->memberDAO->read_all();
    foreach ($_SESSION["list_member"] as $k => $member) {
      $this->release_thanhvien($member->member_id, false);
    }
    header("Location: http://" . $_SERVER["HTTP_HOST"] . "/member_list.php");
    // die();
  }

  /** add 01 lich object into database (for scontrollers/add_lich.php)*/
  public function add_lich(
    int $chulich_id,
    int $laixe_id,
    string $noidung_lich,
    int $nhom_diem,
    string $ngaythang_datlich
  ) {
    $lich = lich::construct($chulich_id, $laixe_id, $noidung_lich, $nhom_diem, $ngaythang_datlich);
    $this->lichDAO->create($lich);
  }

  /** HIỂN thị điểm của một member (dùng cho controllers/hienthi_diem_member.php) */
  public function hienthi_diem(string $nick_zalo)
  {
    $member = $this->memberDAO->read_by_zalo($nick_zalo);
    return $member->so_diem;
  }

  /** Tính toán và điều chỉnh điểm của member theo yêu cầu (dùng cho controllers/dieuchinh_diem.php) */
  public function dieuchinh_diem(string $nick_zalo, float $nhom_diem)
  {
    $member = $this->memberDAO->read_by_zalo($nick_zalo);
    $member->so_diem += $nhom_diem;
    echo $nhom_diem;
    // echo $member->so_diem;
    $this->memberDAO->update_by_zalo($member);

    $_SESSION['dieuchinhdiem_member']['zalo'] = $nick_zalo;
    $_SESSION['dieuchinhdiem_member']['diem'] = $member->so_diem;
  }

  /** Save tiền cọc vào CSDL (bảng chulich_va_laixe) */
  public function dat_coc(string $nick_zalo, int $tien)
  {
    $member = $this->memberDAO->read_by_zalo($nick_zalo);
    $member->co_coc = $tien;
    $this->memberDAO->update_by_zalo($member);

    $_SESSION["dieuchinhcoc_member"]['tien'] = $tien;
    $_SESSION["dieuchinhcoc_member"]['zalo'] = $nick_zalo;
  }

  /** Hiển thị tiền cọc của một member (dùng cho controllers/hienthi_tiencoc.php) */
  public function hienthi_tiencoc(string $nick_zalo)
  {
    $member = $this->memberDAO->read_by_zalo($nick_zalo);
    return $member->co_coc;
  }

  /** Hooán đổi thông tin giữa 2 members (hoán đổi member_id) */
  public function hoan_doi(int $id_bandau, int $id_moi)
  {
    $member1 = $this->memberDAO->read_by_id($id_bandau);
    $member2 = $this->memberDAO->read_by_id($id_moi);

    if (isset($member1) && isset($member2)) {
      // echo "fine";
      $this->memberDAO->swap($member1, $member2);
    } else {
      die("không hoán đổi được");
    }
  }

  /** Khóa thành viên (theo id) */
  public function khoa_thanhvien(int $member_id, int $thoihan, string $donvi_tinh)
  {
    $member = $this->memberDAO->read_by_id($member_id);
    // calculate the "thoi gian khoa"
    $thoidiem_bikhoa = time();
    $thoihan_giaikhoa = $thoidiem_bikhoa;
    if ($donvi_tinh == "hour") {
      $thoihan_giaikhoa += $thoihan * 3600;
    } else if ($donvi_tinh == "day") {
      $thoihan_giaikhoa += $thoihan * 3600 * 24;
    } else if ($donvi_tinh == "month") {
      $thoihan_giaikhoa += $thoihan * 3600 * 24 * 30;
    }
    // echo $donvi_tinh;
    $member->trang_thai = 0;
    $member->thoidiem_bikhoa = $thoidiem_bikhoa;
    $member->thoihan_bikhoa = $thoihan_giaikhoa;

    $this->memberDAO->update_by_zalo($member);
  }

  /** 
   * GIẢI PHÓNG CHO THÀNH VIÊN BỊ KHÓA 
   * Nhằm xử lý giải khóa thành viên trược tiếp (file quanly_kich.php)
   * và giải khóa thành viên sau khi hết thời hạn khóa (trong hàm $this->load_memberlist() kể trên)
   */
  public function release_thanhvien(int $member_id, bool $is_forced)
  {
    $member = $this->memberDAO->read_by_id($member_id);

    if ($is_forced) {
      $member->thoidiem_bikhoa = null;
      $member->thoihan_bikhoa = null;
      $member->trang_thai = 1;
    } else if ($member->thoihan_bikhoa <= time()) {
      $member->thoidiem_bikhoa = null;
      $member->thoihan_bikhoa = null;
      $member->trang_thai = 1;
    }
    $this->memberDAO->update_by_zalo($member);
    $_SESSION["list_member"] = $this->memberDAO->read_all();
  }

  /** save link ảnh vào database (ở trường co_anh) */
  public function save_link_image(int $id_thanhvien, string $link)
  {
    $member = $this->memberDAO->read_by_id($id_thanhvien);
    // Cộng vào chuỗi co_anh trong CSDL kèm theo dấu ';'
    $member->co_anh .= $link . ';';
    // trường hợp số link ảnh nhiều hơn 3, xóa ảnh đầu tiên
    $array_of_links = $member->get_array_of_link_anh();
    while (count($array_of_links) - 1 > 3) {
      // Trên thực tế hàm get_array_of_link_anh() luôn có thừa một phần tử rỗng ỏ index cuối cùng
      $first_link = array_shift($array_of_links);
      $member->co_anh = implode(';', $array_of_links);
      unlink(dirname(__FILE__, 3) . '/action' . '/' . $first_link);
    }

    $this->memberDAO->update_by_zalo($member);
    $_SESSION["list_member"] = $this->memberDAO->read_all();
  }
}