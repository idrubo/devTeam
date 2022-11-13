<?php

require INCLUDE_PATH . '/app/controllers/vData.php';

class CreateController extends ApplicationController
{
  private $model;
  private $valD;

  public function __construct ()
  {	
    $this->model = new createModel ();
    $this->valD  = new vData ();
  }

  public function createAction ()
  {
    $this->getRequest ();
    $post = $this->_request->getAllParams ();

    if (! empty ($post))
      if (array_key_exists ('crtTask', $post))
        $this->crtTask ($post);
  }

  private function crtTask ($post)
  {
    unset ($post ['crtTask']);

    if ($this->valD->vTask ($post))
      $this->model->saveTask ($post);
  }
}
?>

