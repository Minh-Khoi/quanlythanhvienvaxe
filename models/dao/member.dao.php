<?php
require_once dirname(__FILE__, 2) . "/dto/member.php";
require_once dirname(__FILE__, 2) . "/pdo/pdo.php";
error_reporting(E_ERROR | E_PARSE);

/**
 * Class constructor for chu lich va lai xe.
 */
class memberDAO
{
  private $conn;

  public function __construct()
  {
    $DBConnector = new DBConnector();
    $this->conn = $DBConnector->get_conn();
  }

  /** 
   * Create an member Object and add to Database.
   */
  public function create(member $member)
  {
    try {
      $SQL = "insert into chulich_va_laixe ( nick_zalo, so_diem, trang_thai, BKS, ghi_chu, co_coc, co_anh) 
                                values ( :nick_zalo, :so_diem, :trang_thai, :BKS, :ghi_chu, :co_coc, :co_anh)";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":nick_zalo", $member->nick_zalo);
      $stmt->bindParam(":so_diem", $member->so_diem);
      $stmt->bindParam(":trang_thai", $member->trang_thai);
      $stmt->bindParam(":BKS", $member->BKS);
      $stmt->bindParam(":ghi_chu", $member->ghi_chu);
      $stmt->bindParam(":co_coc", $member->co_coc);
      $stmt->bindParam(":co_anh", $member->co_anh);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * Update member by nick_zalo
   */
  public function update_by_zalo(member $member)
  {
    try {
      $SQL = "update chulich_va_laixe set so_diem = :so_diem ,
                                trang_thai= :trang_thai,
                                BKS= :BKS,
                                ghi_chu= :ghi_chu,
                                co_coc= :co_coc,
                                co_anh= :co_anh
                          where nick_zalo=:nick_zalo";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":so_diem", $member->so_diem);
      $stmt->bindParam(":trang_thai", $member->trang_thai);
      $stmt->bindParam(":BKS", $member->BKS);
      $stmt->bindParam(":ghi_chu", $member->ghi_chu);
      $stmt->bindParam(":co_coc", $member->co_coc);
      $stmt->bindParam(":co_anh", $member->co_anh);
      $stmt->bindParam(":nick_zalo", $member->nick_zalo);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * delete member by nick_zalo
   */
  public function delete_by_zalo(member $member)
  {
    try {
      $SQL = "delete from chulich_va_laixe 
                          where nick_zalo=:nick_zalo";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":nick_zalo", $member->nick_zalo);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * read all member from database
   */
  public function read_all()
  {
    try {
      $SQL = "select * from chulich_va_laixe";
      $stmt = $this->conn->prepare($SQL);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_CLASS, "member");
      return $res;
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
    return null;
  }

  /** 
   * read  member from database by nick_zalo
   */
  public function read_by_zalo(string $nick_zalo)
  {
    try {
      $SQL = "select * from chulich_va_laixe where nick_zalo = :nick_zalo";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":nick_zalo", $nick_zalo);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_CLASS, "member");
      return $res[0];
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
      // return null;
    }
    return null;
  }

  /** 
   * read  member from database by id
   */
  public function read_by_id(int $id)
  {
    try {
      $SQL = "select * from chulich_va_laixe where member_id = :member_id";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":member_id", $id);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_CLASS, "member");
      return $res[0];
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
      // return null;
    }
    return false;
  }
}
