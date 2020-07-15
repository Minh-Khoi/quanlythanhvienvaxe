<?php
require_once dirname(__FILE__, 2) . "/dao/lich.dao.php";
require_once dirname(__FILE__, 2) . "/dao/member.dao.php";
require_once dirname(__FILE__, 2) . "/dao/quantrivien.dao.php";
error_reporting(E_ERROR | E_PARSE);

class login_action
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

  public function login_accept(string $nick_zalo, string $password)
  {
    $quantrivien = $this->quantrivienDAO->read_by_zalo($nick_zalo);
    if (md5($password) == $quantrivien->password) {
      $_SESSION["is_quantrivien"] = $nick_zalo;
      header("Location: " . $_SERVER["HTTP_REFERER"] . "index.php");
    } else { }
  }
}