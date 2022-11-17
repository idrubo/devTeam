<?php

class mngDB
{
  private $tasks;

  public function __construct ()
  {
    $this->mongo = new MongoDB\Client('mongodb://localhost:27017');
    $this->tasks = $this->mongo->taskUpdt->task;
  }

  public function insert ($post) { $r = $this->tasks->insertOne ($post); }

  public function findCount ($filter)
  {
    $d = $this->tasks->find ($filter)->toArray ();
    return count ($d);
  }

  public function find ($filter)
  {
    return $this->tasks->find ($filter)->toArray ();
  }

  public function update ($filter, $doc)
  {
    $this->tasks->updateOne ($filter, ['$set' => $doc]);
  }

  public function delete ($filter)
  {
    $r = $this->tasks->deleteOne ($filter);
  }
}
?>

