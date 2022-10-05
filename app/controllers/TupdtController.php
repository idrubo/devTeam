<?php

require 'vData.php';

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
    // /* DEBUG */ msgToConsole ('Into: TupdtController::UDAction');

    // /* DEBUG */ msgToConsole ('Leaving: TupdtController::UDAction');
  }

  public function listAction ()
  {
    // /* DEBUG */ msgToConsole ('Into: TupdtController::listAction');
    // /* DEBUG */ msgToConsole ('Leaving: TupdtController::listAction');
  }

  public function crtUser ($post)
  {
    // /* DEBUG */ msgToConsole ('Into: TupdtController::crtUser');

    // /* DEBUG */ varToConsole ('post', $post);
    unset ($post ['crtUser']);

    // /* DEBUG */ varToConsole ('post', $post);
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

}

?>

