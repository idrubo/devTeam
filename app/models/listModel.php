<?php

require_once INCLUDE_PATH . '/app/models/dbUtil.php';

class listModel extends Model
{
  private $sql, $util;

  public function __construct ()
  {
    $this->sql = new SQL ();
    $this->util = new dbUtil ($this->sql);
  }

  public function listTask ($post)
  {
    $u = $post ['user'];
    $t = $post ['description'];
    $idtasuse = $this->util->fkIdTasUse ($u);

    if (! $idtasuse) return false;

    $task = $this->util->selectTask ($idtasuse, $t);

    if ($task !== false)
    {
      foreach ($task as $t)
      {
        unset ($t ['id']);
        unset ($t ['idtasuse']);
        $t ['user'] = $u;
      }

      return array ($t);
    }

    return false;
  }

  public function listAll ($post)
  {
    $list = array ();

    $task = $this->sql->select ('task', '*', 'true');

    foreach ($task as $t)
    {
      $id = $t ['idtasuse'];
      $user = $this->sql->select ('user', 'user', "id = \"$id\"");

      unset ($t ['id']);
      unset ($t ['idtasuse']);

      foreach ($user as $u) $t ['user'] = $u ['user'];

      array_push ($list, $t);
    }

    return $list;
  }
}
?>

