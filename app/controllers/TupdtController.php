<?php

require INCLUDE_PATH . '/app/controllers/vData.php';
require INCLUDE_PATH . '/app/views/scripts/tupdt/view.php';

$GLOBALS ['listing'] = "";

class TupdtController extends ApplicationController
{
  private $model;
  private $valD;
  private $prnV;

  public function __construct ()
  {	
    $this->model = new TupdtModel ();
    $this->valD  = new vData ();
    $this->prnV  = new prnV ();
  }

  public function createAction ()
  {
    $this->getRequest ();
    $post = $this->_request->getAllParams ();

    if (! empty ($post))
    {
      if (array_key_exists ('crtUser', $post))
        $this->crtUser ($post);

      if (array_key_exists ('crtTask', $post))
        $this->crtTask ($post);
    }
  }

  public function UDAction ()
  {
    $this->getRequest ();
    $post = $this->_request->getAllParams ();

    if (! empty ($post))
    {
      if (array_key_exists ('update', $post))
        $this->updtTask ($post);

      if (array_key_exists ('delete', $post))
        $this->delTask ($post);
    }
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

  private function crtUser ($post)
  {
    unset ($post ['crtUser']);

    if ($this->valD->vUser ($post))
      $this->model->saveUser ($post);
  }

  private function crtTask ($post)
  {
    unset ($post ['crtTask']);

    if ($this->valD->vTask ($post))
    {
      $user = array ('user' => $post ['user']);

      if ($this->model->checkUser ($user))
        $this->model->saveTask ($post);
      else
        $this->valD->setTusrE ('Must exist !!!');
    }
  }

  private function updtTask ($post)
  {
    unset ($post ['update']);

    if ($this->valD->vUpdT ($post))
      if (! $this->model->updateTask ($post))
        $this->valD->setUpdTE ('Not found !!!');
  }

  private function delTask($post)
  {
    unset ($post ['delete']);

    if ($this->valD->vDelT ($post))
      if (! $this->model->deleteTask ($post))
        $this->valD->setDelTE ('Not found !!!');
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

