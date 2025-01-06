<?php
  function entities_fix_string($string)
  {
    return htmlentities($string);
  }    

  function mysql_fix_string($pdo, $string)
  {
    return $pdo->quote($string);
  }
?>
