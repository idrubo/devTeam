<?php

$GLOBALS ['usrErr'] = "";
$GLOBALS ['desErr'] = $GLOBALS ['dstErr'] = $GLOBALS ['dfiErr'] = "";

class vData
{
	public function vUser ($post)
	{
    if (empty ($post = trim ($post ['user'])))
    {
      $GLOBALS ['usrErr'] = "Empty !!!";
      return false;
    }
		return true;
  }

	public function vTask ($post)
  {
    $r = true;

    if (empty ($post ['user'] = trim ($post ['user'])))
    {
      $GLOBALS ['usrErr'] = "Empty !!!";
      $r = false;
    }

    /* DEBUG */ varToConsole ('post', $post);
    if (empty ($post ['description'] = trim ($post ['description'])))
    {
      $GLOBALS ['desErr'] = "Empty !!!";
      $r = false;
    }

		return $r;
	}
}

?>

