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

  public function load_memberlist()
  {
    $_SESSION["list_member"] = $this->memberDAO->read_all();
    // var_dump($list_member);
    header("Location: http://" . $_SERVER["HTTP_HOST"] . "/member_list.php");
    die();
  }
}