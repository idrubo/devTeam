<?php

class DraftModel extends Model
{
	const jsonName = 'db.json';
	const jsonDir  = ROOT_PATH . '/app/models/';
	const jsonPath = DraftModel::jsonDir . DraftModel::jsonName;

	private $jsonF;

	public function __construct ()
	{

		/* DEBUG */ varToConsole ('jsonPath', DraftModel::jsonPath);

		try {
			$this->jsonF = fopen (DraftModel::jsonPath, "a+");

			if (! $this->jsonF) {throw new Exception('File open failed.');}
		}
		catch (Exception $e) {echo "ERROR: $e";}
	}
}
?>
