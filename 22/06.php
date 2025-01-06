<?php // Example 06: checkuser.php
  require_once 'functions.php';

  if (isset($_POST['user'])) {
    $stmt = $pdo->prepare('SELECT * FROM members WHERE user=?');
    $stmt->execute([$_POST['user']]);

    $user_html_entities = htmlentities($_POST['user']);
    if ($stmt->rowCount())
      echo  "<span class='taken'>&nbsp;&#x2718; " .
            "The username '$user_html_entities' is taken</span>";
    else
      echo "<span class='available'>&nbsp;&#x2714; " .
           "The username '$user_html_entities' is available</span>";
  }
?>
