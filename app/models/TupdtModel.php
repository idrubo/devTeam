<?php

require 'fsys.php';

class TupdtModel extends Model
{
  public function __construct ()
  {
    /* DEBUG */ msgToConsole ('Into TupdtModel::__construct.');
    if (! file_exists (fsys::userP)) { fsys::xCrt (fsys::userP); }
    if (! file_exists (fsys::taskP)) { fsys::xCrt (fsys::taskP); }

    /* DEBUG */ varToConsole ('fsys::userP', fsys::userP);
    /* DEBUG */ varToConsole ('fsys::taskP', fsys::taskP);
    /* DEBUG */ msgToConsole ('Leaving TupdtModel::__construct.');
  }

  public function saveUser ($post)
  {
    /* DEBUG */ msgToConsole ('Into TupdtModel::saveUser.');

    $user = (object) $post;

    $jsonF = fSys::xOpen (fsys::userP, "r");
    $jsonUsr = fSys::xGets ($jsonF);

    /* DEBUG */ varToConsole ('+++$jsonUsr+++', $jsonUsr);

    fclose ($jsonF);

    $phpUsr = json_decode ($jsonUsr, true);

    if (! $this->checkItem ($phpUsr, 'user', $post ['user']))
    {
      array_push ($phpUsr, $user);
      $jsonUsrs = json_encode ($phpUsr);

      $jsonF = fSys::xOpen (fSys::userP, "w");

      // /* DEBUG */ varToConsole ('$jsonUsrs', $jsonUsrs);

      fSys::xWrite ($jsonF, $jsonUsrs);
      fclose ($jsonF);
    }

    /* DEBUG */ msgToConsole ('Leaving TupdtModel::saveUser.');
  }

  public function saveTask ($post)
  {
    /* DEBUG */ msgToConsole ('Into TupdtModel::saveTask.');

    $task = (object) $post;

    $jsonF = fSys::xOpen (fsys::taskP, "r");
    $jsonTsk = fSys::xGets ($jsonF);

    /* DEBUG */ varToConsole ('$jsonTsk', $jsonTsk);

    fclose ($jsonF);

    $phpTsk = json_decode ($jsonTsk, true);

    /* DEBUG */
    /* DEBUG */
    /* DEBUG */
    /* 
     * Must check for 'user' and 'description'. For a task to be equal to another
     * both fileds must be equal.
     */
    /* DEBUG */
    /* DEBUG */
    /* DEBUG */
    if ((! $this->checkItem ($phpUsr, 'user', $post ['user'])) ||
      (! $this->checkItem ($phpUsr, 'description', $post ['description'])))
    {
      array_push ($phpTsk, $task);
      $jsonTsks = json_encode ($phpTsk);

      $jsonF = fSys::xOpen (fSys::taskP, "w");

      /* DEBUG */ varToConsole ('$jsonTsks', $jsonTsks);

      fSys::xWrite ($jsonF, $jsonTsks);
      fclose ($jsonF);
    }

    /* DEBUG */ msgToConsole ('Leaving TupdtModel::saveTask.');
  }

  private function checkItem ($arr, $key, $str)
  {
    foreach ($arr as $v)
      if (! strcasecmp ($v [$key], $str))
        return true;

    return false;
  }
}
?>

