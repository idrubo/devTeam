<?php

class TupdtModel extends Model
{
	private $userF;
	private $taskF;

	public function crtFile ($path)
	{
		try {
			$jsonF = fopen ($path, "a+");
			if (! $jsonF) {throw new Exception('File open failed.');}
		}
		catch (Exception $e) {echo "ERROR: $e";}

		return $jsonF;
	}

	public function __construct ()
	{
		$jsonName = 'user.json';
		$jsonDir  = ROOT_PATH . '/app/models/';
		$jsonPath = $jsonDir . $jsonName;

  		/* DEBUG */ varToConsole ('jsonPath', $jsonPath);

		$this->userF = $this->crtFile ($jsonPath);
	}
}
?>
