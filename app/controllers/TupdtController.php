<?php

class TupdtController extends ApplicationController
{
	private $model;

	public function __construct ()
	{	
		$this->model = new TupdtModel ();
	}

	// DEBUG
	// DEBUG
	// DEBUG

	/*
	 * Need to:
	 *
	 * 1.- Define a Model.                           --> OK
	 * 2.- Get an instance of our model.             --> OK
	 * 3.- Pass the data, as an array, to the model. -->
	 * 4.- Call a Model method for every operation.  -->
	 *
	 * 3.1.- Create an array with two elements: "worker" and "task".
	 * Worker contains 
	 *
	 */

	// DEBUG
	// DEBUG
	// DEBUG

	public function indexAction()
	{
		// /* DEBUG */ msgToConsole ('Into: TupdtController::indexAction');

		$this->getRequest ();
		$post = $this->_request->getAllParams ();

		/* DEBUG */ varToConsole ('$post', $post);

		/* DEBUG */
		/* DEBUG */
		/* DEBUG */
		/* A post must be always validated. */
		if (! empty($post)) $this->model->saveUser ($post);
		/* DEBUG */
		/* DEBUG */
		/* DEBUG */

		// /* DEBUG */ varToConsole ('post', $post);
		// /* DEBUG */ varToConsole ('gettype (post)', gettype ($post));
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
