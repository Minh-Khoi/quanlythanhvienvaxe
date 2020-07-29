<?
require_once dirname(__FILE__, 2) . "/dao/member.dao.php";
require_once dirname(__FILE__, 2) . "/dao/quantrivien.dao.php";
require_once dirname(__FILE__, 2) . "/dao/lich.dao.php";

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

  /** LOad list of member from database (for index.php) */
  public function load_memberlist()
  {
    $_SESSION["list_member"] = $this->memberDAO->read_all();
    // var_dump($list_member);
    header("Location: http://" . $_SERVER["HTTP_HOST"] . "/member_list.php");
    die();
  }

  /** add 01 lich object into database (for controllers/add_lich.php)*/
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
}