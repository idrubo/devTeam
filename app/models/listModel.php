<?php

class listModel extends Model
{
  private $mDB;

  public function __construct () { $this->mDB = new mngDB (); }

  public function listTask ($post)
  {
    $filter = array ('user' => $post ['user'], 'task' => $post ['task']);

    $task = $this->mDB->find ($filter);

    if (count ($task))
    {
      foreach ($task as $t) unset ($t ['_id']);
      return array ($t);
    }
    return false;
  }

  public function listAll ($post)
  {
    $list = array ();

    $task = $this->mDB->find (array ());

    foreach ($task as $t)
    {
      unset ($t ['_id']);
      array_push ($list, $t);
    }

    return $list;
  }
}

?>

