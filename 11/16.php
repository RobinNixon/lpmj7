<?php
  function mysql_fix_string($pdo, $string)
  {
    $string = stripslashes($string);
    return $pdo->quote($string);
  }
?>
