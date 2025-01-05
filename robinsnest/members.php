<?php // Example 09: members.php
  require_once 'header.php';

  if (!$loggedin)
    die("</div></body></html>");
  $user = $_SESSION['user'];

  if (isset($_GET['view'])) {
    $view = $_GET['view'];
    $view_html_entities = htmlentities($view);

    if ($_GET['view'] === $user)
      $name = "Your";
    else
      $name = "$view_html_entities's";

    echo "<h3>$name Profile</h3>";
    showProfile($view, $pdo);
    echo "<a class='button'
      href='messages.php?view=$view_html_entities'>View $name messages</a>";
    die("</div></body></html>");
  }

  if (isset($_GET['add'])) {
    $stmt = $pdo->prepare('SELECT * FROM friends WHERE user=? AND friend=?');
    $stmt->execute([$_GET['add'], $user]);
    if (!$stmt->rowCount()) {
      $stmt = $pdo->prepare("INSERT INTO friends VALUES (?, ?)");
      $stmt->execute([$_GET['add'], $user]);
    }
  } elseif (isset($_GET['remove'])) {
    $stmt = $pdo->prepare('DELETE FROM friends WHERE user=? AND friend=?');
    $stmt->execute([$_GET['remove'], $user]);
  }
?>
      <p><strong>Other members</strong></p>
      <ul>
<?php
  $stmt = $pdo->prepare("SELECT user FROM members ORDER BY user");
  $stmt->execute();
  if (!$stmt->rowCount()) {
    echo '<li>No other members</li>';
  }
  while ($row = $stmt->fetch()) {
    if ($row['user'] === $user)
      continue;
    $rowuser_html_entities = htmlentities($row['user']);

    echo "<li><a
      href='members.php?view=$rowuser_html_entities'>$rowuser_html_entities</a>";
    $follow = "follow";

    $stmt2 = $pdo->prepare('SELECT * FROM friends WHERE user=? AND friend=?');
    $stmt2->execute([$row['user'], $user]);
    $t1 = $stmt2->rowCount();

    $stmt2->execute([$user, $row['user']]);
    $t2 = $stmt2->rowCount();

    if (($t1 + $t2) > 1)
      echo " &harr; is a mutual friend";
    elseif ($t1)
      echo " &larr; you are following";
    elseif ($t2) {
      echo " &rarr; is following you";
      $follow = "recip";
    }

    if (!$t1)
      echo " [<a href='members.php?add=$rowuser_html_entities'>$follow</a>]";
    else
      echo " [<a href='members.php?remove=$rowuser_html_entities'>drop</a>]";
  }
?>
      </ul>
    </div>
  </body>
</html>
