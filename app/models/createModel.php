<?php

require_once INCLUDE_PATH . '/app/models/fsys.php';
require_once INCLUDE_PATH . '/app/models/dataUtil.php';

class createModel extends Model
{
  private $dUtil;

  public function __construct ()
  {
    $this->dUtil = new dataUtil ();

    if (! file_exists (fsys::userP)) { fsys::xCrt (fsys::userP); }
    if (! file_exists (fsys::taskP)) { fsys::xCrt (fsys::taskP); }
  }

  public function saveUser ($post)
  {
    $user = (object) $post;

    $jsonUsr = fSys::jRead (fSys::userP);

    $phpUsr = json_decode ($jsonUsr, true);

    if (! $this->dUtil->checkItem ($phpUsr, 'user', $post ['user']))
    {
      array_push ($phpUsr, $user);
      $jsonUsrs = json_encode ($phpUsr);

      fSys::jWrite (fSys::userP, $jsonUsrs);
    }
  }

  public function checkUser ($user)
  {
    $jsonUsr = fSys::jRead (fSys::userP);

    $phpUsr = json_decode ($jsonUsr, true);

    return $this->dUtil->checkItem ($phpUsr, 'user', $user ['user']);
  }

  public function saveTask ($post)
  {
    $task = (object) $post;

    $jsonTsk = fSys::jRead (fSys::taskP);

    $phpTsk = json_decode ($jsonTsk, true);

    if (! $this->dUtil->checkDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']))
    {
      array_push ($phpTsk, $task);
      $jsonTsks = json_encode ($phpTsk);

      fSys::jWrite (fSys::taskP, $jsonTsks);
    }
  }
}
?>

