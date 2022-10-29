<?php

require INCLUDE_PATH . '/app/controllers/vData.php';

/* DEBUG */
/* DEBUG */
/* DEBUG */
/* Must be moved to app/views/scripts/list/ */
require INCLUDE_PATH . '/app/views/scripts/tupdt/view.php';
/* DEBUG */
/* DEBUG */
/* DEBUG */

$GLOBALS ['listing'] = "";

class CreateController extends ApplicationController
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

