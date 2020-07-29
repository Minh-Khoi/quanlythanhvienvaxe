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
      $SQL = "insert into chulich_va_laixe
                            ( ho_ten, nick_zalo, so_diem, trang_thai, BKS, ghi_chu, co_coc, co_anh) 
                      values ( :ho_ten, :nick_zalo, :so_diem, :trang_thai, :BKS, :ghi_chu, :co_coc, :co_anh)";
      $stmt = $this->conn->prepare($SQL);

      $stmt->bindParam(":ho_ten", $member->ho_ten);
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
   * Update member by member_id. This is a helper for the next function swap_by_zalo()
   */
  private function update_by_id(member $member)
  {
    try {
      $SQL = "update chulich_va_laixe set so_diem = :so_diem ,
                                trang_thai= :trang_thai,
                                BKS= :BKS,
                                ghi_chu= :ghi_chu,
                                co_coc= :co_coc,
                                co_anh= :co_anh,
                                ho_ten= :ho_ten,
                                nick_zalo=:nick_zalo
                            where member_id = :member_id";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":so_diem", $member->so_diem);
      $stmt->bindParam(":trang_thai", $member->trang_thai);
      $stmt->bindParam(":BKS", $member->BKS);
      $stmt->bindParam(":ghi_chu", $member->ghi_chu);
      $stmt->bindParam(":co_coc", $member->co_coc);
      $stmt->bindParam(":co_anh", $member->co_anh);
      $stmt->bindParam(":ho_ten", $member->ho_ten);
      $stmt->bindParam(":nick_zalo", $member->nick_zalo);
      $stmt->bindParam(":member_id", $member->member_id);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }
  /** 
   * This function swap the order of 2 member in database. 
   */
  public function swap_by_zalo(member $m1, member $m2)
  {
    try {
      // Set an holder for $m1
      $holder = clone $m1;
      // update member $m1 as $m2 properties (except member_id)
      $m1->ho_ten = $m2->ho_ten;
      $m1->nick_zalo = $m2->nick_zalo;
      $m1->so_diem = $m2->so_diem;
      $m1->trang_thai = $m2->trang_thai;
      $m1->BKS = $m2->BKS;
      $m1->ghi_chu = $m2->ghi_chu;
      $m1->co_coc = $m2->co_coc;
      $m1->co_anh = $m2->co_anh;
      // Invoke function update_by_id, replace the old properties of $m1 (already saved in Database)
      // and replace new properties which 've been copied from $m2
      $this->update_by_id($m1);

      // the object member "$holder" is holding the old properties of $m1, then replace its member_id with
      // member_id of $m2. Then update $m2 in database with properties of $holder
      $holder->member_id = $m2->member_id;
      $this->update_by_id($holder);
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
      usort($res, function (member $m, member $n) {
        return $m->member_id - $n->member_id;
      });
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