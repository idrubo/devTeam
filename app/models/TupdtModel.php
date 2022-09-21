<?php

class TupdtModel extends Model
{
	const jsonDir =  ROOT_PATH . '/app/models/';

	const userN = 'user.json';
	const userP = self::jsonDir . self::userN;

	const taskN = 'task.json';
	const taskP = self::jsonDir . self::taskN;

	private $userF;
	private $taskF;

	public function __construct ()
	{
  		/* DEBUG */ varToConsole ('userN', self::userP);

		$this->userF = $this->crtFile (self::userP);

  		/* DEBUG */ varToConsole ('taskN', self::taskP);

		$this->taskF = $this->crtFile (self::taskP);
	}

	public function crtFile ($path)
	{
		try {
			$jsonF = fopen ($path, "a+");
			if (! $jsonF) {throw new Exception('File open failed.');}
		}
		catch (Exception $e) {echo "ERROR: $e";}

		return $jsonF;
	}

	function saveUser ($post)
	{
		/* DEBUG */ varToConsole ('$post', $post);
		/* DEBUG */ varToConsole ('$post', $post);
		/* DEBUG */ varToConsole ('json_encode ($post)', json_encode ($post));

		fwrite ($this->userF, json_encode ($post));
	}
}
?>
