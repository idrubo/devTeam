<?php

require 'vData.php';

$GLOBALS ['listing'] = "";

class TupdtController extends ApplicationController
{
  private $model;
  private $valD;

  public function __construct ()
  {	
    $this->model = new TupdtModel ();
    $this->valD  = new vData ();
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
      unset ($post ['lstTask']);

      if ($this->valD->vLisT ($post))
        $tasks = $this->model->listTask ($post);

      /* DEBUG */
      /* DEBUG */
      /* DEBUG */
      /* Return an error if the task is NOT listed. */
      /* A button "All Tasks" may be added. */
      /* DEBUG */
      /* DEBUG */
      /* DEBUG */

      /* DEBUG */ varToConsole ('$tasks', $tasks);

      $this->showTask ($tasks);
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

  public function showTask ($tasks)
  {
    $GLOBALS ['listing'] = "";

    foreach ($tasks as $t)
      $GLOBALS ['listing'] .= "<br>" . json_encode ($t);

    /* DEBUG */ varToConsole ('$GLOBALS [listing]', $GLOBALS ['listing']);
  }

}

?>

