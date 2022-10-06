<?php

class prnV
{
  public function showTasks ($tasks)
  {
    $GLOBALS ['listing'] = '<table class="text-Navy">';
    $GLOBALS ['listing'] .= '<tr><th class="pr-2 pl-2">User</th><th class="pr-2 pl-2">Description</th>';
    $GLOBALS ['listing'] .= '<th class="pr-2 pl-2">Start</th><th class="p-1">End</th><th>Status</th></tr>';

    foreach ($tasks as $t)
    {
      $GLOBALS ['listing'] .= "<tr>";

      $GLOBALS ['listing'] .= '<td class="pr-2 pl-2">' . $t ['user']        . '</td>';
      $GLOBALS ['listing'] .= '<td class="pr-2 pl-2">' . $t ['description'] . '</td>';
      $GLOBALS ['listing'] .= '<td class="pr-2 pl-2">' . $t ['dStart']      . '</td>';
      $GLOBALS ['listing'] .= '<td class="pr-2 pl-2">' . $t ['dFinish']     . '</td>';
      $GLOBALS ['listing'] .= '<td class="pr-2 pl-2">' . $t ['status']      . '</td>';

      $GLOBALS ['listing'] .= "</tr>";

    }

    $GLOBALS ['listing'] .= "</table>";

    // /* DEBUG */ varToConsole ('$GLOBALS [listing]', $GLOBALS ['listing']);
  }
}

?>

