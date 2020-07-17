<?php
require_once dirname(__FILE__, 2) . "/dao/lich.dao.php";
require_once dirname(__FILE__, 2) . "/dao/member.dao.php";
require_once dirname(__FILE__, 2) . "/dao/quantrivien.dao.php";
// error_reporting(E_ERROR | E_PARSE);

class logout_action
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
    // var_dump($_SERVER["HTTP_HOST"] . "/index.php");
  }

  /** THis function handle logout request */
  public function logout_done()
  {
    unset($_SESSION["ID"]);
    session_destroy();
    // header("Location: http://" . $_SERVER["HTTP_HOST"]);
  }
}