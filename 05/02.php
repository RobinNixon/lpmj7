<?php
  function fix_names($n1, $n2, $n3)
  {
    $n1 = ucfirst(strtolower($n1));
    $n2 = ucfirst(strtolower($n2));
    $n3 = ucfirst(strtolower($n3));

    return $n1 . ' ' . $n2 . ' ' . $n3;
  }

  echo fix_names('WILLIAM', 'henry', 'gatES');
?>
