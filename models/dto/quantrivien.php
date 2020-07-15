<?php

class quantrivien
{
  public $quantrivien_id, $nick_zalo, $password, $loai_key;

  /**
   * Class constructor for quantrivien instance.
   */
  public function __construct(int $quantrivien_id, string $nick_zalo, string $password, string $loai_key)
  {
    $this->quantrivien_id = $quantrivien_id;
    $this->$nick_zalo = $nick_zalo;
    $this->password = $password;
    $this->loai_key = $loai_key;
  }

  /** 
   * Another class constructor (without id)
   */
  public static function construct(string $nick_zalo, string $password, string $loai_key)
  {
    $instance = new quantrivien(0, $nick_zalo, $password, $loai_key);
    return $instance;
  }
}
