<?php

class TupdtController extends ApplicationController
{
	private $model;

	public function __construct ()
	{	
		$this->model = new TupdtModel ();
	}

	public function indexAction()
	{
		// /* DEBUG */ msgToConsole ('Into: TupdtController::indexAction');

		$this->getRequest ();
		$post = $this->_request->getAllParams ();

		// /* DEBUG */ varToConsole ('post', $post);
		// /* DEBUG */ varToConsole ('gettype (post)', gettype ($post));
		// /* DEBUG */ varToConsole ('empty ($post)', empty ($post));

		if (! empty ($post))
		{
			$this->vData->vUser ($post);
			$this->model->checkUser ($post);
			$this->model->saveUser ($post);
		}

		// /* DEBUG */ msgToConsole ('Leaving: TupdtController::indexAction');
	}

	public function taskAction()
	{
	}

	public function taskUDAction()
	{
	}

	public function listAction()
	{
	}

	public function listVAction()
	{
	}
}

?>
