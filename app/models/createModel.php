<?php

require_once INCLUDE_PATH . '/app/models/dbUtil.php';

class createModel extends Model
{
  private $sql, $util;

  public function __construct ()
  {
    $this->sql = new SQL ();
    $this->util = new dbUtil ($this->sql);
  }

  public function saveUser ($post)
  {
    $u = $post ['user'];
    $cond = "user = \"$u\"";

    $records = $this->sql->select ('user', 'user', $cond);

    if (! count ($records))
    {
      $user = "(\"$u\")";
      $this->sql->insert ('user', '(user)', $user);
    }
  }

  public function checkUser ($user) { return $this->util->fkIdTasUse ($user); }

  public function saveTask ($post)
  {
    $u = $post ['user'];
    $t = $post ['description'];
    $idtasuse = $this->util->fkIdTasUse ($u);

    $task = $this->util->selectTask ($idtasuse, $t);

    if ($task === false)
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
}
?>

