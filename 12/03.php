<?php //setupusers.php
  require_once 'login.php';

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (\PDOException $e)
  {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

  $query = "CREATE TABLE users (
    forename VARCHAR(32) NOT NULL,
    surname  VARCHAR(32) NOT NULL,
    username VARCHAR(32) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
  )";

  $result = $pdo->query($query);

  $forename = 'Bill';
  $surname  = 'Smith';
  $username = 'bsmith';
  $password = 'mysecret';
  $hash     = password_hash($password, PASSWORD_DEFAULT);
  
  add_user($pdo, $forename, $surname, $username, $hash);

  $forename = 'Pauline';
  $surname  = 'Jones';
  $username = 'pjones';
  $password = 'acrobat';
  $hash     = password_hash($password, PASSWORD_DEFAULT);
  
  add_user($pdo, $forename, $surname, $username, $hash);

  function add_user($pdo, $fn, $sn, $un, $pw)
  {
    $stmt = $pdo->prepare('INSERT INTO users VALUES(:fn,:sn,:un,:pw)');
    $stmt->execute([
      ':fn' => $fn,
      ':sn' => $sn,
      ':un' => $un,
      ':pw' => $pw
    ]);
  }
?>
