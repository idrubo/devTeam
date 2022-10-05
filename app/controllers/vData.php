<?php

/* For create user: */
$GLOBALS ['usrErr'] = "";

/* For create task: */
$GLOBALS ['tusErr'] = $GLOBALS ['desErr'] = "";
$GLOBALS ['dstErr'] = $GLOBALS ['dfiErr'] = "";
$GLOBALS ['staErr'] = "";

/* For update task: */
$GLOBALS ['uusErr'] = $GLOBALS ['udeErr'] = "";
$GLOBALS ['udsErr'] = $GLOBALS ['udfErr'] = "";
$GLOBALS ['ustErr'] = "";

/* For delete task: */
$GLOBALS ['dusErr'] = $GLOBALS ['ddeErr'] = "";

/* For listing task: */
$GLOBALS ['lusErr'] = $GLOBALS ['ldeErr'] = "";

class vData
{
  public function vUser ($post)
  {
    $r = true;

    if (empty ($post ['user'] = trim ($post ['user'])))
    {
      $GLOBALS ['usrErr'] = "Empty !!!";
      return $r = false;
    }

    if (strlen ($post ['user']) > 20)
    {
      $GLOBALS ['usrErr'] = "Too long !!!";
      return $r = false;
    }

    return $r;
  }

  public function vTask ($post)
  {
    // /* DEBUG */ msgToConsole ('Into: vData::vTask');
    $r = true;

    // /* DEBUG */ varToConsole ('post', $post);

    if (empty ($post ['user'] = trim ($post ['user'])))
    {
      $GLOBALS ['tusErr'] = "Empty !";
      $r = false;
    }

    if (strlen ($post ['user']) > 20)
    {
      $GLOBALS ['usrErr'] = "Too long !!!";
      return $r = false;
    }

    if (empty ($post ['description'] = trim ($post ['description'])))
    {
      $GLOBALS ['desErr'] = "Empty !";
      $r = false;
    }

    if (strlen ($post ['description']) > 50)
    {
      $GLOBALS ['desErr'] = "Too long !!!";
      return $r = false;
    }

    if (! empty ($post ['dStart'] = trim ($post ['dStart'])))
      if (! $this->isValidDate ($post ['dStart']))
      {
        $GLOBALS ['dstErr'] = "Invalid !";
        $r = false;
      }

    if (! empty ($post ['dFinish'] = trim ($post ['dFinish'])))
      if (! $this->isValidDate ($post ['dFinish']))
      {
        $GLOBALS ['dfiErr'] = "Invalid !";
        $r = false;
      }

    if (empty ($post ['status']))
    {
      $GLOBALS ['staErr'] = "Empty !";
      $r = false;
    }

    return $r;
  }

  public function vUpdT ($post)
  {
    // /* DEBUG */ msgToConsole ('Into: vData::vUpdT');
    $r = true;

    // /* DEBUG */ varToConsole ('post', $post);

    if (empty ($post ['user'] = trim ($post ['user'])))
    {
      $GLOBALS ['uusErr'] = "Empty !";
      $r = false;
    }

    if (strlen ($post ['user']) > 20)
    {
      $GLOBALS ['uusErr'] = "Too long !!!";
      return $r = false;
    }

    if (empty ($post ['description'] = trim ($post ['description'])))
    {
      $GLOBALS ['udeErr'] = "Empty !";
      $r = false;
    }

    if (strlen ($post ['description']) > 50)
    {
      $GLOBALS ['udeErr'] = "Too long !!!";
      return $r = false;
    }

    if (! empty ($post ['dStart'] = trim ($post ['dStart'])))
      if (! $this->isValidDate ($post ['dStart']))
      {
        $GLOBALS ['udsErr'] = "Invalid !";
        $r = false;
      }

    if (! empty ($post ['dFinish'] = trim ($post ['dFinish'])))
      if (! $this->isValidDate ($post ['dFinish']))
      {
        $GLOBALS ['udfErr'] = "Invalid !";
        $r = false;
      }

    if (empty ($post ['status']))
    {
      $GLOBALS ['ustErr'] = "Empty !";
      $r = false;
    }

    // /* DEBUG */ varToConsole ('$r', $r);
    // /* DEBUG */ msgToConsole ('Leaving: vData::vUpdT');
    return $r;
  }

  public function vDelT ($post)
  {
    // /* DEBUG */ msgToConsole ('Into: vData::vDelT');
    $r = true;

    // /* DEBUG */ varToConsole ('post', $post);

    if (empty ($post ['user'] = trim ($post ['user'])))
    {
      $GLOBALS ['dusErr'] = "Empty !";
      $r = false;
    }

    if (strlen ($post ['user']) > 20)
    {
      $GLOBALS ['dusErr'] = "Too long !!!";
      return $r = false;
    }

    if (empty ($post ['description'] = trim ($post ['description'])))
    {
      $GLOBALS ['ddeErr'] = "Empty !";
      $r = false;
    }

    if (strlen ($post ['description']) > 50)
    {
      $GLOBALS ['ddeErr'] = "Too long !!!";
      return $r = false;
    }

    // /* DEBUG */ varToConsole ('$r', $r);
    // /* DEBUG */ msgToConsole ('Leaving: vData::vData');
    return $r;
  }

  public function vLisT ($post)
  {
    // /* DEBUG */ msgToConsole ('Into: vData::vLisT');
    $r = true;

    // /* DEBUG */ varToConsole ('post', $post);

    $post ['user'] = trim ($post ['user']);

    if (strlen ($post ['user']) > 20)
    {
      $GLOBALS ['lusErr'] = "Too long !!!";
      return $r = false;
    }

    $post ['description'] = trim ($post ['description']);

    if (strlen ($post ['description']) > 50)
    {
      $GLOBALS ['ldeErr'] = "Too long !!!";
      return $r = false;
    }

    // /* DEBUG */ varToConsole ('$r', $r);
    // /* DEBUG */ msgToConsole ('Leaving: vData::vData');
    return $r;
  }

  public function setUsrE ($msg) { $GLOBALS ['usrErr'] = $msg; }

  public function setUpdTE ($msg)
  {
    $GLOBALS ['uusErr'] = $GLOBALS ['udeErr'] = $msg;
  }

  public function setDelTE ($msg)
  {
    $GLOBALS ['dusErr'] = $GLOBALS ['ddeErr'] = $msg;
  }

  public function setLisTE ($msg)
  {
    $GLOBALS ['lusErr'] = $GLOBALS ['ldeErr'] = $msg;
  }

  private function isValidDate ($date)
  {
    $format = 'j-n-Y G:i';

    $dt = DateTime::createFromFormat ($format, $date);

    if ($dt) return ($dt->format ($format) === $date);
    else return false;
  }

}

?>

