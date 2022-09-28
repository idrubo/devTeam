<?php

require 'fsys.php';

class TupdtModel extends Model
{
	public function __construct ()
	{
		if (! file_exists (fsys::userP)) { fsys::xCrt (fsys::userP); }

		// /* DEBUG */ varToConsole ('fsys::userP', fsys::userP);
	}

	function saveUser ($post)
	{
		// /* DEBUG */ msgToConsole ('Into saveUser.');

		$user = (object) $post;

		$jsonF = fSys::xOpen (fsys::userP, "r");
		$jsonUsr = fSys::xGets ($jsonF);

		// /* DEBUG */ varToConsole ('$jsonUsr', $jsonUsr);

		fclose ($jsonF);

		$phpUsr = json_decode ($jsonUsr, true);

		array_push ($phpUsr, $user);

		$jsonF = fSys::xOpen (fSys::userP, "w");
		$jsonUsrs = json_encode ($phpUsr);

		// /* DEBUG */ varToConsole ('$jsonUsrs', $jsonUsrs);

		fSys::xWrite ($jsonF, $jsonUsrs);
		fclose ($jsonF);
	}
}
?>

