<?php
  require_once 'login.php';

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e)
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
  }

  $user  = mysql_fix_string($pdo, $_POST['user']);
  $pass  = mysql_fix_string($pdo, $_POST['pass']);
  $query = "SELECT * FROM users WHERE user='$user' AND pass='$pass'";

  echo 'Search result: ' . entities_fix_string($_GET['search']);

  //Etc…

  function entities_fix_string($string)
  {
    return htmlentities($string);
  }    

  function mysql_fix_string($pdo, $string)
  {
    return $pdo->quote($string);
  }
?>
