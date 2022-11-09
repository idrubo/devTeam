<?php

require_once INCLUDE_PATH . '/app/models/dbUtil.php';

class udModel extends Model
{
  private $sql, $util;

  public function __construct ()
  {
    $this->sql = new SQL ();
    $this->util = new dbUtil ($this->sql);
  }

  public function updateTask ($post)
  {
    $u = $post ['user'];
    $t = $post ['description'];
    $idtasuse = $this->util->fkIdTasUse ($u);

    $task = $this->util->selectTask ($idtasuse, $t);

    if ($task !== false)
    {
      foreach ($task as $tsk)
      {
        if (empty ($post ['dStart']))  $post ['dStart']  = $tsk ['startD'];
        if (empty ($post ['dFinish'])) $post ['dFinish'] = $tsk ['finishD'];
      }

      $table   = 'task';
      $dS      = $post ['dStart'];
      $dF      = $post ['dFinish'];
      $st      = $post ['status'];

      if (! empty ($dS)) $columns = "startD = \"$dS\"";

      if (! empty ($dF)) $columns .= ", finishD = \"$dF\"";

      $columns .= ", status = \"$st\"";

      $cond    = "idtasuse = $idtasuse AND task = \"$t\"";
      $this->sql->update ($table, $columns, $cond);

      return true;
    }

    return false;
  }

  public function deleteTask ($post)
  {
    $u = $post ['user'];
    $t = $post ['description'];
    $idtasuse = $this->util->fkIdTasUse ($u);

    $task = $this->util->selectTask ($idtasuse, $t);

    if ($task !== false)
    {
      $table = 'task';
      $cond  = "idtasuse = $idtasuse AND task = \"$t\"";
      $this->sql->delete ($table, $cond);

      return true;
    }

    return false;
  }
}
?>

