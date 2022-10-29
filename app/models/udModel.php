<?php

require_once INCLUDE_PATH . '/app/models/fsys.php';
require_once INCLUDE_PATH . '/app/models/dataUtil.php';

class udModel extends Model
{
  private $dUtil;

  public function __construct ()
  {
    $this->dUtil = new dataUtil ();

    if (! file_exists (fsys::userP)) { fsys::xCrt (fsys::userP); }
    if (! file_exists (fsys::taskP)) { fsys::xCrt (fsys::taskP); }
  }

  public function updateTask ($post)
  {
    $udTsk = $post;

    $jsonTsk = fSys::jRead (fSys::taskP);

    $phpTsk = json_decode ($jsonTsk, true);

    $tasks = $this->dUtil->getDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']);

    if ($tasks != false)
    {
      $this->dUtil->delDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']);

      if (empty ($udTsk ['dStart']))  $udTsk ['dStart']  = $tasks ['dStart'];
      if (empty ($udTsk ['dFinish'])) $udTsk ['dFinish'] = $tasks ['dFinish'];

      array_push ($phpTsk, (object) $udTsk);
      $jsonTsks = json_encode ($phpTsk);

      fSys::jWrite (fSys::taskP, $jsonTsks);

      return true;
    }
    return false;
  }

  public function deleteTask ($post)
  {
    $jsonTsk = fSys::jRead (fSys::taskP);

    $phpTsk = json_decode ($jsonTsk, true);

    if ($this->dUtil->delDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']))
    {
      $jsonTsks = json_encode ($phpTsk);

      fSys::jWrite (fSys::taskP, $jsonTsks);

      return true;
    }

    return false;
  }
}
?>

