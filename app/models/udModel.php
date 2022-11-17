<?php

class udModel extends Model
{
  private $mDB;

  public function __construct () { $this->mDB = new mngDB (); }

  public function updateTask ($post)
  {
    $filter = array ('user' => $post ['user'], 'task' => $post ['task']);

    $task = $this->mDB->find ($filter);

    if (count ($task))
     {
       foreach ($task as $tsk)
       {
         if (empty ($post ['startD']))  $post ['startD']  = $tsk ['startD'];
         if (empty ($post ['finishD'])) $post ['finishD'] = $tsk ['finishD'];
       }

       $this->mDB->update ($filter, $post);
 
       return true;
     }
 
     return false;
  }

  public function deleteTask ($post)
  {
    $filter = array ('user' => $post ['user'], 'task' => $post ['task']);

    $task = $this->mDB->find ($filter);

     if (count ($task))
     {
       $this->mDB->delete ($filter);
       return true;
    }

     return false;
  }
}
?>

