<?php // Example 10: friends.php
  require_once 'header.php';

  if (!$loggedin)
    die("</div></body></html>");
  $user = $_SESSION['user'];

  if (isset($_GET['view'])) {
    $view = $_GET['view'];
  } else {
    $view = $user;
  }
  $view_html_entities = htmlentities($view);

  if ($view === $user) {
    $name1 = $name2 = "Your";
    $name3 = "You are";
  } else {
    $name1 = "<a
      href='members.php?view=$view_html_entities'>$view_html_entities</a>'s";
    $name2 = "$view_html_entities's";
    $name3 = "$view_html_entities is";
  }

  // Uncomment this line if you wish the user’s profile to show here
  // showProfile($view);

  $followers = $following = [];

  $stmt = $pdo->prepare('SELECT * FROM friends WHERE user=?');
  $stmt->execute([$view]);
  while ($row = $stmt->fetch()) {
    $followers[] = $row['friend'];
  }

  $stmt = $pdo->prepare('SELECT * FROM friends WHERE friend=?');
  $stmt->execute([$view]);
  while ($row = $stmt->fetch()) {
    $following[] = $row['user'];
  }

  $mutual    = array_intersect($followers, $following);
  $followers = array_diff($followers, $mutual);
  $following = array_diff($following, $mutual);
  $friends   = FALSE;

  echo "<br>";

  if (sizeof($mutual)) {
    echo "<span class='subhead'>$name2 mutual friends</span><ul>";
    foreach ($mutual as $friend) {
      $fr_html_entities = htmlentities($friend);
      echo "<li><a
        href='members.php?view=$fr_html_entities'>$fr_html_entities</a>";
    }
    echo "</ul>";
    $friends = TRUE;
  }

  if (sizeof($followers)) {
    echo "<span class='subhead'>$name2 followers</span><ul>";
    foreach ($followers as $friend)
      $fr_html_entities = htmlentities($friend);
      echo "<li><a
        href='members.php?view=$fr_html_entities'>$fr_html_entities</a>";
    echo "</ul>";
    $friends = TRUE;
  }

  if (sizeof($following)) {
    echo "<span class='subhead'>$name3 following</span><ul>";
    foreach ($following as $friend)
      $fr_html_entities = htmlentities($friend);
      echo "<li><a
        href='members.php?view=$fr_html_entities'>$fr_html_entities</a>";
    echo "</ul>";
    $friends = TRUE;
  }

  if (!$friends)
    echo "<br>You don't have any friends yet.";
?>
    </div>
  </body>
</html>
