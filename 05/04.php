<?php
  $a1 = 'WILLIAM';
  $a2 = 'henry';
  $a3 = 'gatES';

  function fix_names()
  {
    global $a1; $a1 = ucfirst(strtolower($a1));
    global $a2; $a2 = ucfirst(strtolower($a2));
    global $a3; $a3 = ucfirst(strtolower($a3));
  }

  echo $a1 . ' ' . $a2 . ' ' . $a3 . '<br>';
  fix_names();
  echo $a1 . ' ' . $a2 . ' ' . $a3;
?>
