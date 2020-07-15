<?php

class lich
{
  public $lich_id, $chulich_id, $laixe_id, $noidung_lich, $nhom_diem, $ngay_thang;

  /**
   * Class constructor for lich instance.
   */
  public function __construct(
    int $lich_id,
    int $chulich_id,
    int $laixe_id,
    string $noidung_lich,
    int $nhom_diem,
    string $ngay_thang
  ) {
    $this->lich_id = $lich_id;
    $this->chulich_id = $chulich_id;
    $this->laixe_id = $laixe_id;
    $this->noidung_lich = $noidung_lich;
    $this->nhom_diem = $nhom_diem;
    $this->ngay_thang = $ngay_thang;
  }


  /** 
   * Another Class constructor for lich instance. (which have no id)
   */
  public static function construct(
    int $chulich_id,
    int $laixe_id,
    string $noidung_lich,
    int $nhom_diem,
    string $ngay_thang
  ) {
    $instance = new lich(0, $chulich_id, $laixe_id, $noidung_lich, $nhom_diem, $ngay_thang);
    return $instance;
  }
}