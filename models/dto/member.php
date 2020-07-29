<?php

class member
{
  public $member_id, $ho_ten, $nick_zalo, $so_diem, $trang_thai, $BKS, $co_coc, $ghi_chu, $co_anh;

  /**
   * Class constructor for member instance.
   */
  public function __construct(
    int $member_id = null,
    string $ho_ten = null,
    string $nick_zalo = null,
    string $so_dienthoai = null,
    float $so_diem = null,
    int $trang_thai = null,
    string $BKS = null,
    string $ghi_chu = null,
    int $co_coc = null,
    int $co_anh = null
  ) {
    $this->member_id = ($member_id != null) ? $member_id : $this->member_id;
    $this->$ho_ten = ($ho_ten != null) ? $ho_ten : $this->ho_ten;
    $this->$nick_zalo = ($nick_zalo != null) ? $nick_zalo : $this->nick_zalo;
    $this->$so_dienthoai = ($so_dienthoai != null) ? $so_dienthoai : $this->so_dienthoai;
    $this->so_diem = (isset($so_diem)) ? $so_diem : $this->so_diem;
    $this->trang_thai = (isset($trang_thai)) ? $trang_thai : $this->trang_thai;
    $this->BKS = (isset($BKS)) ? $BKS : $this->BKS;
    $this->ghi_chu = (isset($ghi_chu)) ? $ghi_chu : $this->ghi_chu;
    $this->co_coc = (isset($co_coc)) ? $co_coc : $this->co_coc;
    $this->co_anh = (isset($co_anh)) ? $co_anh : $this->co_anh;
  }

  /** 
   * Another Class constructor for member instance. (which have no id)
   */
  public static function construct(
    string $ho_ten,
    string $nick_zalo,
    string $so_dienthoai,
    float $so_diem,
    int $trang_thai,
    string $BKS,
    string $ghi_chu,
    int $co_coc,
    int $co_anh
  ): member {
    $instance = new member(
      0,
      $ho_ten,
      $nick_zalo,
      $so_dienthoai,
      $so_diem,
      $trang_thai,
      $BKS,
      $ghi_chu,
      $co_coc,
      $co_anh
    );
    return $instance;
  }
}