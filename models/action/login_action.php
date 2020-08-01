<?php
require_once dirname(__FILE__, 2) . "/dao/lich.dao.php";
require_once dirname(__FILE__, 2) . "/dao/member.dao.php";
require_once dirname(__FILE__, 2) . "/dao/quantrivien.dao.php";
// error_reporting(E_ERROR | E_PARSE);

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
    // var_dump($_SERVER["HTTP_HOST"] . "/index.php");
  }

  /** This function handle the login request */
  public function login_accept(string $nick_zalo, string $password)
  {
    try {
      $quantrivien = $this->quantrivienDAO->read_by_zalo($nick_zalo);
      // var_dump(($quantrivien));

      if (!is_null($quantrivien) && md5($password) == $quantrivien->password) {
        $_SESSION["is_quantrivien"] = $nick_zalo;
        $_SESSION["is_quantrivien_key"] = $quantrivien->loai_key;
        $_SESSION["list_quantrivien"] = $this->quantrivienDAO->read_all();
        // var_dump($_SESSION["is_quantrivien"]);
        header("Location: http://" . $_SERVER["HTTP_HOST"]);
      } else {
        $_SESSION["login_error"] = "Wrong nick_zalo and password";
        header("Location: http://" . $_SERVER["HTTP_HOST"] . "/login.php");
      }
    } catch (Exception $e) {
      print_r($e);
    }
  }
}