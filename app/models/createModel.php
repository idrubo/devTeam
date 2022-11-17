<?php

class createModel extends Model
{
  private $mDB;

  public function __construct () { $this->mDB = new mngDB (); }

  public function saveTask ($post)
  {
    $filter = array ('user' => $post ['user'], 'task' => $post ['task']);

    $nTasks = $this->mDB->findCount ($filter);

    if (! $nTasks) $this->mDB->insert ($post);
  }
}

?>

