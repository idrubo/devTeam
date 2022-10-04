<?php

require 'fsys.php';

class TupdtModel extends Model
{
  public function __construct ()
  {
    // /* DEBUG */ msgToConsole ('Into TupdtModel::__construct.');
    if (! file_exists (fsys::userP)) { fsys::xCrt (fsys::userP); }
    if (! file_exists (fsys::taskP)) { fsys::xCrt (fsys::taskP); }

    // /* DEBUG */ varToConsole ('fsys::userP', fsys::userP);
    // /* DEBUG */ varToConsole ('fsys::taskP', fsys::taskP);
    // /* DEBUG */ msgToConsole ('Leaving TupdtModel::__construct.');
  }

  public function saveUser ($post)
  {
    // /* DEBUG */ msgToConsole ('Into TupdtModel::saveUser.');

    $user = (object) $post;

    $jsonUsr = fSys::jRead (fSys::userP);
    // /* DEBUG */ varToConsole ('$jsonUsr', $jsonUsr);

    $phpUsr = json_decode ($jsonUsr, true);

    if (! $this->checkItem ($phpUsr, 'user', $post ['user']))
    {
      array_push ($phpUsr, $user);
      $jsonUsrs = json_encode ($phpUsr);

      fSys::jWrite (fSys::userP, $jsonUsrs);

      // /* DEBUG */ varToConsole ('$jsonUsrs', $jsonUsrs);
    }

    // /* DEBUG */ msgToConsole ('Leaving TupdtModel::saveUser.');
  }

  public function checkUser ($user)
  {
    // /* DEBUG */ msgToConsole ('Into TupdtModel::checkUser.');

    $jsonUsr = fSys::jRead (fSys::userP);

    $phpUsr = json_decode ($jsonUsr, true);

    return $this->checkItem ($phpUsr, 'user', $user ['user']);

    // /* DEBUG */ msgToConsole ('Leaving TupdtModel::checkUser.');
  }

  public function saveTask ($post)
  {
    /* DEBUG */ msgToConsole ('Into TupdtModel::saveTask.');

    $task = (object) $post;

    $jsonTsk = fSys::jRead (fSys::taskP);

    /* DEBUG */ varToConsole ('$jsonTsk', $jsonTsk);

    $phpTsk = json_decode ($jsonTsk, true);

    if (! $this->checkDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']))
    {
      array_push ($phpTsk, $task);
      $jsonTsks = json_encode ($phpTsk);

      /* DEBUG */ varToConsole ('$jsonTsks', $jsonTsks);

      fSys::jWrite (fSys::taskP, $jsonTsks);
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

  private function checkDbl ($arr, $key1, $str1, $key2, $str2)
  {
    foreach ($arr as $v)
      if (! strcasecmp ($v [$key1], $str1))
        if (! strcasecmp ($v [$key2], $str2))
          return true;

    return false;
  }
}
?>

