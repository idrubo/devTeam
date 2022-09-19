<?php

class TupdtModel extends Model
{
	const jsonName = 'db.json';
	const jsonDir  = ROOT_PATH . '/app/models/';
	const jsonPath = TupdtModel::jsonDir . TupdtModel::jsonName;

	private $jsonF;

	public function __construct ()
	{

		/* DEBUG */ varToConsole ('jsonPath', TupdtModel::jsonPath);

		try {
			$this->jsonF = fopen (TupdtModel::jsonPath, "a+");

			if (! $this->jsonF) {throw new Exception('File open failed.');}
		}
		catch (Exception $e) {echo "ERROR: $e";}
	}
}
?>
