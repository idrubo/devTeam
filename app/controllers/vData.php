<?php

/* For create user: */
$GLOBALS ['usrErr'] = "";

/* For create task: */
$GLOBALS ['tusErr'] = $GLOBALS ['desErr'] = "";
$GLOBALS ['dstErr'] = $GLOBALS ['dfiErr'] = "";
$GLOBALS ['staErr'] = "";

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
    /* DEBUG */ msgToConsole ('Into: vData::vTask');
    $r = true;

    /* DEBUG */ varToConsole ('post', $post);

    if (empty ($post ['user'] = trim ($post ['user'])))
    {
      $GLOBALS ['tusErr'] = "Empty !";
      $r = false;
    }

    if (empty ($post ['description'] = trim ($post ['description'])))
    {
      $GLOBALS ['desErr'] = "Empty !";
      $r = false;
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

    /* DEBUG */ varToConsole ('$r', $r);
    /* DEBUG */ msgToConsole ('Leaving: vData::vTask');
    return $r;
  }

  public function setUsrE ($msg) { $GLOBALS ['usrErr'] = $msg; }

  private function isValidDate ($date)
  {
    $format = 'j-n-Y G:i';

    $dt = DateTime::createFromFormat ($format, $date);

    if ($dt) return ($dt->format ($format) === $date);
    else return false;
  }

}

?>

