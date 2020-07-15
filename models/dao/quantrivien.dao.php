<?php
require_once dirname(__FILE__, 2) . "/dto/quantrivien.php";
require_once dirname(__FILE__, 2) . "/pdo/pdo.php";
error_reporting(E_ERROR | E_PARSE);

class quantrivienDAO
{
  private $conn;

  /**
   * Class constructor.
   */
  public function __construct()
  {
    $DBConnector = new DBConnector();
    $this->conn = $DBConnector->get_conn();
  }

  /** 
   * Create an quantrivien Object and add to Database.
   */
  public function create(quantrivien $quantrivien)
  {
    try {
      // enscript paassword
      $new_pass = md5($quantrivien->password);
      // start creating
      $SQL = "insert into quantrivien ( nick_zalo, password, loai_key) 
                                values ( :nick_zalo, :password, :loai_key)";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":nick_zalo", $quantrivien->nick_zalo);
      $stmt->bindParam(":password", $new_pass);
      $stmt->bindParam(":loai_key", $quantrivien->loai_key);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * Update quantrivien by nick_zalo
   */
  public function update_by_zalo(quantrivien $quantrivien)
  {
    try {
      $SQL = "update quantrivien set password = :password ,
                                         loai_key = :loai_key
                                      where nick_zalo=:nick_zalo";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":password", $quantrivien->password);
      $stmt->bindParam(":loai_key", $quantrivien->loai_key);
      $stmt->bindParam(":nick_zalo", $quantrivien->nick_zalo);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * delete quantrivien by nick_zalo
   */
  public function delete_by_zalo(string $nick_zalo)
  {
    try {
      $SQL = "delete from quantrivien  where nick_zalo=:nick_zalo";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":nick_zalo", $nick_zalo);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * read all quantrivien from database
   */
  public function read_all()
  {
    try {
      $SQL = "select * from quantrivien";
      $stmt = $this->conn->prepare($SQL);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_CLASS, "quantrivien");
      return $res;
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * read quantrivien from database by nick_zalo
   */
  public function read_by_zalo(string $nick_zalo)
  {
    try {
      $SQL = "select * from quantrivien where nick_zalo = :nick_zalo";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":nick_zalo", $nick_zalo);

      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_CLASS, "quantrivien");
      return $res[0];
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }
}