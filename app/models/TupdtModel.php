<?php

class TupdtModel extends Model
{
	const jsonDir = ROOT_PATH . '/app/models/';

	const userF = 'user.json';
	const taskF = 'task.json';
	const userP = self::jsonDir . self::userF;
	const taskP = self::jsonDir . self::taskF;

	/* DEBUG */
	/*
	 * Create a class that could create, open, read and write a file as it checks for errors.
	 */
	/* DEBUG */

	public function crtFile ($path)
	{
		try {
			$jsonF = fopen ($path, "w+");
			if (! $jsonF) {throw new Exception('File open failed.');}

			fwrite ($jsonF, '[]');
			fclose ($jsonF);
		}
		catch (Exception $e) {echo "ERROR: $e";}
	}

	public function __construct ()
	{
		if (! file_exists (self::userP)) { $this->crtFile (self::userP); }

		// /* DEBUG */ varToConsole ('self::userP', self::userP);
	}

	function saveUser ($post)
	{
		// 2.- Convert the array to an object.
		//
		$user = (object) $post;
		/* DEBUG */ varToConsole ('$user', $user);
		/* DEBUG */ varToConsole ('gettype ($user)', gettype ($user));

		// 3.- Read the file as a PHP array.
		//
		$jsonF = fopen (self::userP, "r");
		$jsonUsr = fgets ($jsonF);

		echo "\n\$jsonUsr: " . $jsonUsr;

		if (empty ($jsonUsr))  $jsonUsr = "[]";

		echo "\n\$jsonUsr: " . $jsonUsr;
		fclose ($jsonF);

		$phpUsr = json_decode ($jsonUsr, true);
		echo "\n\$phpUsr: "; var_dump ($phpUsr);

	}

}
?>

