<?php

class dataUtil
{
  public function checkItem ($arr, $key, $str)
  {
    foreach ($arr as $v)
      if (! strcasecmp ($v [$key], $str))
        return true;

    return false;
  }

  public function getDbl ($arr, $key1, $str1, $key2, $str2)
  {
    foreach ($arr as $v)
      if (! strcasecmp ($v [$key1], $str1))
        if (! strcasecmp ($v [$key2], $str2))
          return $v;

    return false;
  }

  public function checkDbl ($arr, $key1, $str1, $key2, $str2)
  {
    foreach ($arr as $v)
      if (! strcasecmp ($v [$key1], $str1))
        if (! strcasecmp ($v [$key2], $str2))
          return true;

    return false;
  }

  public function delDbl (&$arr, $key1, $str1, $key2, $str2)
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

