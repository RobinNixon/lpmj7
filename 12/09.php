<?php
  function sanitizeString($var)
  {
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
  }

  function sanitizeMySQL($pdo, $var)
  {
    $var = $pdo->quote($var);
    $var = sanitizeString($var);
    return $var;
  }
?>
