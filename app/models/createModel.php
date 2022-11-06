<?php

require_once INCLUDE_PATH . '/app/models/fsys.php';
require_once INCLUDE_PATH . '/app/models/dataUtil.php';

class createModel extends Model
{
  private $sql;

  public function __construct () { $this->sql = new SQL (); }

  public function saveUser ($post)
  {
    $u = $post ['user'];
    $user = "user = \"$u\"";

    $records = $this->sql->select ('user', 'user', $user);

    if (! count ($records))
    {
      $user = "(\"$u\")";
      $this->sql->insert ('user', '(user)', $user);
    }
  }

  public function checkUser ($user) { return $this->fkIdTasUse ($user); }

  public function saveTask ($post)
  {
    $u = $post ['user'];
    $d = $post ['description'];

    $idtasuse = $this->fkIdTasUse ($u);
    $cond = "idtasuse = \"$idtasuse\" AND task = \"$d\"";
    $data = $this->sql->select ('task', '*', $cond);

    if (! count ($data))
    {
      $fields = 'idtasuse, task';
      $task   = $post ['description'];
      $values = "$idtasuse, \"$task\"";

      if (! empty ($post ['dStart']))
      {
        $fields = $fields . ', startD';
        $startD = $post ['dStart'];
        $values = $values . ", \"$startD\"";
      }

      if (! empty ($post ['dFinish']))
      {
        $fields = $fields . ', finishD';
        $finishD = $post ['dFinish'];
        $values = $values . ", \"$finishD\"";
      }

      $fields = "(" . $fields .  ", status" . ")";
      $status  = $post ['status'];
      $values = "(" . $values . ", \"$status\"" . ")";

      $this->sql->insert ('task', $fields, $values);
    }
  }

  private function fkIdTasUse ($user)
  {
    $cond = "user = \"$user\"";
    $data = $this->sql->select ('user', 'id', $cond);

    if (count ($data)) return ($idtasuse = (integer) $data [0]['id']);

    return 0;
  }
}
?>

