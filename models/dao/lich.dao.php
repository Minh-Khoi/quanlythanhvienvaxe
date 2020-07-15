<?php
require_once dirname(__FILE__, 2) . "/dto/lich.php";
require_once dirname(__FILE__, 2) . "/pdo/pdo.php";
error_reporting(E_ERROR | E_PARSE);

class lichDAO
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
   * Create an lich Object and add to Database.
   */
  public function create(lich $lich)
  {
    try {
      $SQL = "insert into lich ( chulich_id, laixe_id, noidung_lich, nhom_diem, ngay_thang) 
                                values ( :chulich_id, :laixe_id, :noidung_lich, :nhom_diem, :ngay_thang)";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":chulich_id", $lich->chulich_id);
      $stmt->bindParam(":laixe_id", $lich->laixe_id);
      $stmt->bindParam(":noidung_lich", $lich->noidung_lich);
      $stmt->bindParam(":nhom_diem", $lich->nhom_diem);
      $stmt->bindParam(":ngay_thang", $lich->ngay_thang);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * update lich by id
   */
  public function update_by_id(lich $lich)
  {
    try {
      $SQL = "update lich set chulich_id = :chulich_id, laixe_id= :laixe_id, 
                              noidung_lich = :noidung_lich, nhom_diem = :nhom_diem, ngay_thang = :ngay_thang
                          where lich_id = :lich_id";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":chulich_id", $lich->chulich_id);
      $stmt->bindParam(":laixe_id", $lich->laixe_id);
      $stmt->bindParam(":noidung_lich", $lich->noidung_lich);
      $stmt->bindParam(":nhom_diem", $lich->nhom_diem);
      $stmt->bindParam(":ngay_thang", $lich->ngay_thang);
      $stmt->bindParam(":lich_id", $lich->lich_id);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * delete lich by id
   */
  public function delete_by_id(int $id)
  {
    try {
      $SQL = "delete from lich
                          where lich_id = :lich_id";
      $stmt = $this->conn->prepare($SQL);
      $stmt->bindParam(":lich_id", $id);

      $stmt->execute();
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * read all lich from database
   */
  public function read_all()
  {
    try {
      $SQL = "select * from lich";
      $stmt = $this->conn->prepare($SQL);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_CLASS, "lich");
      return $res;
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }

  /** 
   * read lich from database by id
   */
  public function read_by_id(int $id)
  {
    try {
      $SQL = "select * from lich where lich_id = :lich_id";
      $stmt = $this->conn->prepare($SQL);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_CLASS, "lich");
      return $res[0];
    } catch (PDOException $e) {
      print_r("error is " . $e->getMessage());
    }
  }
}