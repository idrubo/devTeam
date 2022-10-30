<?php

require_once INCLUDE_PATH . '/app/models/fsys.php';
require_once INCLUDE_PATH . '/app/models/dataUtil.php';

class listModel extends Model
{
  private $dUtil;

  public function __construct ()
  {
    $this->dUtil = new dataUtil ();

    if (! file_exists (fsys::userP)) { fsys::xCrt (fsys::userP); }
    if (! file_exists (fsys::taskP)) { fsys::xCrt (fsys::taskP); }
  }

  public function listTask ($post)
  {
    $jsonTsk = fSys::jRead (fSys::taskP);

    $phpTsk = json_decode ($jsonTsk, true);

    $tasks = $this->dUtil->getDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']);

    if ($tasks !== false) return array ($tasks);
    else                  return false;
  }

  public function listAll ($post)
  {
    $jsonTsk = fSys::jRead (fSys::taskP);

    $phpTsk = json_decode ($jsonTsk, true);

    return $phpTsk;
  }
}
?>

