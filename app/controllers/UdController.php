<?php

require INCLUDE_PATH . '/app/controllers/vData.php';

class UDController extends ApplicationController
{
  private $model;
  private $valD;

  public function __construct ()
  {	
    $this->model = new udModel ();
    $this->valD  = new vData ();
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
}
?>

