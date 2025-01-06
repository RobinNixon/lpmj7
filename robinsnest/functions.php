<?php // Example 01: functions.php
  $dbhost = 'localhost';  // Change as necessary
  $db     = 'robinsnest'; // Change as necessary
  $dbuser = 'robinsnest'; // Change as necessary
  $dbpass = 'password';   // Change as necessary
  $chrset = 'utf8mb4';
  $dbattr = "mysql:host=$dbhost;dbname=$db;charset=$chrset";
  $opts   =
  [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try {
    $pdo = new PDO($dbattr, $dbuser, $dbpass, $opts);
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

  function destroySession()
  {
    $_SESSION=array();

    if (session_id() !== "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function showProfile($user, $pdo)
  {
    if (file_exists("$user.jpg"))
      echo "<img src='$user.jpg' style='float:left;'>";

    $stmt = $pdo->prepare("SELECT * FROM profiles WHERE user=?");
    $stmt->execute([$user]);

    $row = $stmt->fetch();
    if ($row)
      echo htmlentities($row['text']) . "<br style='clear:left;'><br>";
    else
      echo "<p>Nothing to see here, yet</p><br>";
  }
?>
