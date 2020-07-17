<?php

class member
{
  public $member_id, $nick_zalo, $so_diem, $trang_thai, $BKS, $co_coc, $ghi_chu, $co_anh;

  /**
   * Class constructor for member instance.
   */
  public function __construct(
    int $member_id = null,
    string $nick_zalo = null,
    int $so_diem = null,
    string $BKS = null,
    string $ghi_chu = null,
    int $co_coc = null,
    int $co_anh = null
  ) {
    $this->member_id = ($member_id != null) ? $member_id : $this->member_id;
    $this->$nick_zalo = ($nick_zalo != null) ? $nick_zalo : $this->nick_zalo;
    $this->so_diem = (isset($so_diem)) ? $so_diem : $this->so_diem;
    $this->BKS = (isset($BKS)) ? $BKS : $this->BKS;
    $this->ghi_chu = (isset($ghi_chu)) ? $ghi_chu : $this->ghi_chu;
    $this->co_coc = (isset($co_coc)) ? $co_coc : $this->co_coc;
    $this->co_anh = (isset($co_anh)) ? $co_anh : $this->co_anh;
  }

  /** 
   * Another Class constructor for member instance. (which have no id)
   */
  public static function construct(
    string $nick_zalo,
    int $so_diem,
    string $BKS,
    string $ghi_chu,
    int $co_coc,
    int $co_anh
  ) {
    $instance = new member(0, $nick_zalo, $so_diem, $BKS, $ghi_chu, $co_coc, $co_anh);
    return $instance;
  }
}