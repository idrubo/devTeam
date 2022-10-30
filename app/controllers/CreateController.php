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
    {
      if (array_key_exists ('crtUser', $post))
        $this->crtUser ($post);

      if (array_key_exists ('crtTask', $post))
        $this->crtTask ($post);
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
}
?>

