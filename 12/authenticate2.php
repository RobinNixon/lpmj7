<?php // authenticate2.php
  require_once 'login.php';

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (\PDOException $e)
  {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

  if (isset($_SERVER['PHP_AUTH_USER']) &&
      isset($_SERVER['PHP_AUTH_PW']))
  {

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username=:un');
    $stmt->execute([':un' => $_SERVER['PHP_AUTH_USER']]);

    if (!$stmt->rowCount()) die("User not found");

    $row = $stmt->fetch();
    $fn  = $row['forename'];
    $sn  = $row['surname'];
    $un  = $row['username'];
    $pw  = $row['password'];
      
    if (password_verify($_SERVER['PHP_AUTH_PW'], $pw))
    {
      session_start();

      $_SESSION['forename'] = $fn;
      $_SESSION['surname']  = $sn;

      echo htmlspecialchars("$fn $sn : Hi $fn,
        you are now logged in as '$un'");
      die ("<p><a href='continue.php'>Click here to continue</a></p>");
    }
    else die("Invalid username/password combination");
  }
  else
  {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    die ("Please enter your username and password");
  }
?>
