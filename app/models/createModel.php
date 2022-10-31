<?php

require_once INCLUDE_PATH . '/app/models/fsys.php';
require_once INCLUDE_PATH . '/app/models/dataUtil.php';

class createModel extends Model
{
  private $sql;

  public function __construct () { $this->sql = new SQL (); }

  public function saveUser ($post)
  {
  }

  public function checkUser ($user)
  {
  }

  public function saveTask ($post)
  {
  }
}
?>

