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
    // /* DEBUG */ msgToConsole ('Into: TupdtController::createAction');

    $this->getRequest ();
    $post = $this->_request->getAllParams ();

    if (! empty ($post))
    {
      if (array_key_exists ('crtUser', $post))
        $this->crtUser ($post);

      if (array_key_exists ('crtTask', $post))
        $this->crtTask ($post);
    }

    // /* DEBUG */ msgToConsole ('Leaving: TupdtController::createAction');
  }

  public function UDAction ()
  {
    /* DEBUG */ msgToConsole ('Into: TupdtController::UDAction');

    $this->getRequest ();
    $post = $this->_request->getAllParams ();

    if (! empty ($post))
    {
      if (array_key_exists ('update', $post))
        $this->updtTask ($post);

      if (array_key_exists ('delete', $post))
        $this->delTask ($post);
    }

    /* DEBUG */ msgToConsole ('Leaving: TupdtController::UDAction');
  }

  public function listAction ()
  {
    /* DEBUG */ msgToConsole ('Into: TupdtController::listAction');

    $this->getRequest ();
    $post = $this->_request->getAllParams ();

    if (! empty ($post))
    {
      if (array_key_exists ('lstTask', $post))
        $this->lstTask ($post);

      if (array_key_exists ('lstAll', $post))
        $this->lstAll ($post);
    }

    /* DEBUG */ msgToConsole ('Leaving: TupdtController::listAction');
  }

  public function crtUser ($post)
  {
    // /* DEBUG */ msgToConsole ('Into: TupdtController::crtUser');

    // /* DEBUG */ varToConsole ('post', $post);
    unset ($post ['crtUser']);

    /* DEBUG */ varToConsole ('post', $post);
    // /* DEBUG */ varToConsole ('gettype (post)', gettype ($post));
    // /* DEBUG */ varToConsole ('empty ($post)', empty ($post));

    if ($this->valD->vUser ($post))
      $this->model->saveUser ($post);

    // /* DEBUG */ msgToConsole ('Leaving: TupdtController::crtUser');
  }

  public function crtTask ($post)
  {
    // /* DEBUG */ msgToConsole ('Into: TupdtController::crtTask');

    // /* DEBUG */ varToConsole ('post', $post);
    unset ($post ['crtTask']);

    // /* DEBUG */ varToConsole ('post', $post);
    // /* DEBUG */ varToConsole ('gettype (post)', gettype ($post));
    // /* DEBUG */ varToConsole ('empty ($post)', empty ($post));

    if ($this->valD->vTask ($post))
    {
      $user = array ('user' => $post ['user']);
      // /* DEBUG */ varToConsole ('$user', $user);

      if ($this->model->checkUser ($user))
        $this->model->saveTask ($post);
      else
        $this->valD->setUsrE ('Must exist !!!');
    }

    // /* DEBUG */ msgToConsole ('Leaving: TupdtController::crtTask');
  }

  public function updtTask ($post)
  {
    /* DEBUG */ msgToConsole ('Into: TupdtController::updtTask');

    unset ($post ['update']);

    if ($this->valD->vUpdT ($post))
      if (! $this->model->updateTask ($post))
        $this->valD->setUpdTE ('Not found !!!');

    /* DEBUG */ msgToConsole ('Leaving: TupdtController::updtTask');
  }

  public function delTask($post)
  {
    /* DEBUG */ msgToConsole ('Into: TupdtController::delTask');

    unset ($post ['delete']);

    if ($this->valD->vDelT ($post))
      if (! $this->model->deleteTask ($post))
        $this->valD->setDelTE ('Not found !!!');

    /* DEBUG */ msgToConsole ('Leaving: TupdtController::delTask');
  }

  public function lstTask ($post)
  {
    unset ($post ['lstTask']);

    if ($this->valD->vLisT ($post))
    {
      if (($tasks = $this->model->listTask ($post)) !== false)
        $this->prnV->showTasks ($tasks);
      else
        $this->valD->setLstTE ('NOT found !!!');
    }

    /* DEBUG */ varToConsole ('$tasks', $tasks);

  }

  public function lstAll ($post)
  {
    unset ($post ['lstAll']);

    $tasks = $this->model->listAll ($post);

    // /* DEBUG */ varToConsole ('$tasks', $tasks);

    if (! count ($tasks) == 0) $this->prnV->showTasks ($tasks);
  }

}

?>

