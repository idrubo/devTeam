<?php

class fSys
{
	const jsonDir = ROOT_PATH . '/app/models/';

	const userF = 'user.json';
	const taskF = 'task.json';
	const userP = self::jsonDir . self::userF;
	const taskP = self::jsonDir . self::taskF;

	public static function xCrt ($path)
	{
		try
		{
			$jsonF = fopen ($path, "w+");
			if (! $jsonF) {throw new Exception ('File creation failed.');}

			fwrite ($jsonF, '[]');
			fclose ($jsonF);
		}
		catch (Exception $e) {echo "ERROR: $e";}
	}

	public static function xOpen ($path, $mode)
	{
		try
	       	{
			$jsonF = fopen ($path, $mode);
			if (! $jsonF) {throw new Exception ('File open failed.');}
		}
		catch (Exception $e) {echo "ERROR: $e";}

		return $jsonF;
	}

	public static function xGets ($file)
	{
		try
		{
			if (($jsonS = fgets ($file)) === false)
				throw new Exception ('File read failed.');
		}
		catch (Exception $e) {echo "ERROR: $e";}

		return $jsonS;
	}

	public static function xWrite ($file, $data)
	{
		try
		{
			if (($jsonS = fwrite ($file, $data)) === false)
				throw new Exception ('File write failed.');
		}
		catch (Exception $e) {echo "ERROR: $e";}

		return $jsonS;
	}
}

?>

