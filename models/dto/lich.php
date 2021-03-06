<?php

class lich
{
  public $lich_id, $chulich_id, $laixe_id, $noidung_lich, $nhom_diem, $ngay_thang;

  /**
   * Class constructor for lich instance.
   */
  public function __construct(
    int $lich_id = null,
    int $chulich_id = null,
    int $laixe_id = null,
    string $noidung_lich = null,
    int $nhom_diem = null,
    string $ngay_thang = null
  ) {
    $this->lich_id = (isset($lich_id)) ?  $lich_id : $this->lich_id;
    $this->chulich_id = (isset($chulich_id)) ?  $chulich_id : $this->chulich_id;
    $this->laixe_id = (isset($laixe_id)) ?  $laixe_id : $this->laixe_id;
    $this->noidung_lich = (isset($noidung_lich)) ?  $noidung_lich : $this->noidung_lich;
    $this->nhom_diem = (isset($nhom_diem)) ?  $nhom_diem : $this->nhom_diem;
    $this->ngay_thang = (isset($ngay_thang)) ?  $ngay_thang : $this->ngay_thang;
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
  ): lich {
    $instance = new lich(0, $chulich_id, $laixe_id, $noidung_lich, $nhom_diem, $ngay_thang);
    return $instance;
  }
}