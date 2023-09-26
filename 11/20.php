<?php
  function mysql_entities_fix_string($pdo, $string)
  {
    return htmlentities(mysql_fix_string($pdo, $string));
  }    

  function mysql_fix_string($pdo, $string)
  {
    $string = stripslashes($string);
    return $pdo->real_escape_string($string);
  }
?>
