<?php

require_once INCLUDE_PATH . '/app/models/dbUtil.php';

class createModel extends Model
{
  private $mDB;

  public function __construct () { $this->mDB = new mongoDB (); }

  public function saveTask ($post)
  {
    $filter = array ('user' => $post ['user'], 'task' => $post ['task']);

    $nTasks = $this->mDB->findCount ($filter);

    if (! $nTasks) $this->mDB->insert ($post);
  }
}

?>

