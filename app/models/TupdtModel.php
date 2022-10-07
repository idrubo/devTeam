<?php

require INCLUDE_PATH . '/app/models/fsys.php';

class TupdtModel extends Model
{
  public function __construct ()
  {
    if (! file_exists (fsys::userP)) { fsys::xCrt (fsys::userP); }
    if (! file_exists (fsys::taskP)) { fsys::xCrt (fsys::taskP); }
  }

  public function saveUser ($post)
  {
    $user = (object) $post;

    $jsonUsr = fSys::jRead (fSys::userP);

    $phpUsr = json_decode ($jsonUsr, true);

    if (! $this->checkItem ($phpUsr, 'user', $post ['user']))
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

    return $this->checkItem ($phpUsr, 'user', $user ['user']);
  }

  public function saveTask ($post)
  {
    $task = (object) $post;

    $jsonTsk = fSys::jRead (fSys::taskP);

    $phpTsk = json_decode ($jsonTsk, true);

    if (! $this->checkDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']))
    {
      array_push ($phpTsk, $task);
      $jsonTsks = json_encode ($phpTsk);

      fSys::jWrite (fSys::taskP, $jsonTsks);
    }
  }

  public function updateTask ($post)
  {
    $task = (object) $post;

    $jsonTsk = fSys::jRead (fSys::taskP);

    $phpTsk = json_decode ($jsonTsk, true);

    if ($this->delDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']))
    {
      array_push ($phpTsk, (object) $task);
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

    if ($this->delDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']))
    {
      $jsonTsks = json_encode ($phpTsk);

      fSys::jWrite (fSys::taskP, $jsonTsks);

      return true;
    }

    return false;
  }

  public function listTask ($post)
  {
    $jsonTsk = fSys::jRead (fSys::taskP);

    $phpTsk = json_decode ($jsonTsk, true);

    $tasks = $this->getDbl ($phpTsk, 'user', $post ['user'], 'description', $post ['description']);

    if ($tasks !== false) return array ($tasks);
    else                  return false;
  }

  public function listAll ($post)
  {
    $jsonTsk = fSys::jRead (fSys::taskP);

    $phpTsk = json_decode ($jsonTsk, true);

    return $phpTsk;
  }

  private function checkItem ($arr, $key, $str)
  {
    foreach ($arr as $v)
      if (! strcasecmp ($v [$key], $str))
        return true;

    return false;
  }

  private function getDbl ($arr, $key1, $str1, $key2, $str2)
  {
    foreach ($arr as $v)
      if (! strcasecmp ($v [$key1], $str1))
        if (! strcasecmp ($v [$key2], $str2))
          return $v;

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

  private function delDbl (&$arr, $key1, $str1, $key2, $str2)
  {
    $i = 0;

    foreach ($arr as $v)
    {
      if (! strcasecmp ($v [$key1], $str1))
        if (! strcasecmp ($v [$key2], $str2))
        {
          unset ($arr [$i]);
          $arr = array_values ($arr);
          return true;
        }
      $i++;
    }

    return false;
  }
}
?>

