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

  $stmt = $pdo->prepare('INSERT INTO classics
    VALUES(:author,:title,:category,:year,:isbn)');
  $stmt->execute([
    'author'   => 'Emily Brontë',
    'title'    => 'Wuthering Heights',
    'category' => 'Classic Fiction',
    'year'     => 1847,
    'isbn'     => '9780553212587'
  ]);
  printf("%d Row inserted.\n", $stmt->rowCount());
?>
