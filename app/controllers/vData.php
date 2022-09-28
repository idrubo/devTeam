<?php

class vData
{
	public function vUser ($post)
	{
		if (empty ($post = trim ($post ['user']))) return false;
		return true;
	}
}

?>

