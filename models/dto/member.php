<?php

class member
{
  public $member_id, $nick_zalo, $so_diem, $trang_thai, $BKS, $co_coc, $ghi_chu, $co_anh;

  /**
   * Class constructor for member instance.
   */
  public function __construct(int $member_id, string $nick_zalo, int $so_diem, string $BKS, string $ghi_chu, int $co_coc, int $co_anh)
  {
    $this->member_id = $member_id;
    $this->$nick_zalo = $nick_zalo;
    $this->so_diem = $so_diem;
    $this->BKS = $BKS;
    $this->$ghi_chu = $ghi_chu;
    $this->$co_coc = $co_coc;
    $this->co_anh = $co_anh;
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