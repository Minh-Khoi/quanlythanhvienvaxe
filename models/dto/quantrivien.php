<?php

class quantrivien
{
  public $quantrivien_id, $ho_ten, $sdt, $nick_zalo, $password, $loai_key;

  /**
   * Class constructor for quantrivien instance.
   */
  public function __construct(
    int $quantrivien_id = null,
    string $ho_ten = null,
    string $sdt = null,
    string $nick_zalo = null,
    string $password = null, //"d41d8cd98f00b204e9800998ecf8427e",
    string $loai_key = null
  ) {
    // echo $quantrivien_id . "<br>";
    // echo $nick_zalo . "<br>";
    // echo $password . "<br>";
    // echo $loai_key . "<br>";
    $this->quantrivien_id = ($quantrivien_id != null) ? $quantrivien_id : $this->quantrivien_id;
    $this->$ho_ten = ($ho_ten != null) ? $ho_ten : $this->ho_ten;
    $this->$sdt = ($sdt != null) ? $sdt : $this->sdt;
    $this->$nick_zalo = ($nick_zalo != null) ? $nick_zalo : $this->nick_zalo;
    $this->password = ($password != null) ? $password : $this->password;
    $this->loai_key = ($loai_key != null) ? $loai_key : $this->loai_key;;
  }

  /** 
   * Another class constructor (without id)
   */
  public static function construct(string $nick_zalo, string $password, string $loai_key)
  {
    $instance = new quantrivien(0, $ho_ten, $sdt, $nick_zalo, $password, $loai_key);
    return $instance;
  }
}