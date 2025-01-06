<?php
  function mysql_fix_string($pdo, $string)
  {
    return $pdo->quote($string);
  }
?>
