<?php

class dbUtil
{
  private $sql;

  public function __construct ($db) { $this->sql = $db; }

  public function fkIdTasUse ($user)
  {
    $cond = "user = \"$user\"";
    $data = $this->sql->select ('user', 'id', $cond);

    if (count ($data)) return ($idtasuse = (integer) $data [0]['id']);

    return 0;
  }

  public function selectTask ($idt, $t)
  {
    $cond = "idtasuse = \"$idt\" AND task = \"$t\"";
    $data = $this->sql->select ('task', '*', $cond);

    if (count ($data)) return $data; else return false;
  }
}

?>
