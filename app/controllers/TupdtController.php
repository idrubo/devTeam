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

  public function indexAction ()
  {
    // /* DEBUG */ msgToConsole ('Into: TupdtController::indexAction');

    $this->getRequest ();
    $post = $this->_request->getAllParams ();

    /* DEBUG */ varToConsole ('post', $post);

    unset ($post ['create']);

    /* DEBUG */ varToConsole ('post', $post);
    // /* DEBUG */ varToConsole ('gettype (post)', gettype ($post));
    // /* DEBUG */ varToConsole ('empty ($post)', empty ($post));

    if (! empty ($post))
      if ($this->valD->vUser ($post))
        $this->model->saveUser ($post);

    // /* DEBUG */ msgToConsole ('Leaving: TupdtController::indexAction');
  }

  public function taskAction ()
  {
    /* DEBUG */ msgToConsole ('Into: TupdtController::taskAction');
    //
    $this->getRequest ();
    $post = $this->_request->getAllParams ();

    unset ($post ['task']);
    /* DEBUG */ varToConsole ('post', $post);
    /* DEBUG */ varToConsole ('gettype (post)', gettype ($post));
    /* DEBUG */ varToConsole ('empty ($post)', empty ($post));

    if (! empty ($post))
      if ($this->valD->vTask ($post))
        $this->model->saveTask ($post);

    /* DEBUG */ msgToConsole ('Leaving: TupdtController::taskAction');
  }

  public function taskUDAction ()
  {
  }

  public function listAction ()
  {
  }

  public function listVAction ()
  {
  }
}

?>

