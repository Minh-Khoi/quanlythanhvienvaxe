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
}