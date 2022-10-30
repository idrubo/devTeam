<?php

require INCLUDE_PATH . '/app/controllers/vData.php';
require INCLUDE_PATH . '/app/views/scripts/list/view.php';

$GLOBALS ['listing'] = "";

class ListController extends ApplicationController
{
  private $model;
  private $valD;
  private $prnV;

  public function __construct ()
  {	
    $this->model = new listModel ();
    $this->valD  = new vData ();
    $this->prnV  = new prnV ();
  }

  public function listAction ()
  {
    $this->getRequest ();
    $post = $this->_request->getAllParams ();

    if (! empty ($post))
    {
      if (array_key_exists ('lstTask', $post))
        $this->lstTask ($post);

      if (array_key_exists ('lstAll', $post))
        $this->lstAll ($post);
    }
  }

  private function lstTask ($post)
  {
    unset ($post ['lstTask']);

    if ($this->valD->vLisT ($post))
    {
      if (($tasks = $this->model->listTask ($post)) !== false)
        $this->prnV->showTasks ($tasks);
      else
        $this->valD->setLstTE ('NOT found !!!');
    }
  }

  private function lstAll ($post)
  {
    unset ($post ['lstAll']);

    $tasks = $this->model->listAll ($post);


    if (! count ($tasks) == 0) $this->prnV->showTasks ($tasks);
  }
}
?>

