<?php // Example 11: messages.php
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

  if (isset($_POST['text']) && $_POST['text'] !== "") {
    $stmt = $pdo->prepare('INSERT INTO messages VALUES(NULL, ?, ?, ?, ?, ?)');
    $stmt->execute([$user, $view, (int)$_POST['pm'], time(), $_POST['text']]);
  }

  if ($view !== "") {
    if ($view === $user)
      $name1 = $name2 = "Your";
    else {
      $name1 = "<a
        href='members.php?view=$view_html_entities'>$view_html_entities</a>'s";
      $name2 = "$view_html_entities's";
    }

    echo "<h3>$name1 Messages</h3>";
    showProfile($view, $pdo);
?>
      <form method="post"
        action="messages.php?view=<?php echo $view_html_entities; ?>">
        <p>Type here to leave a message</p>
        <p>
          <input type="radio" name="pm" id="public"
            value="0" checked="checked">
          <label for="public">Public</label>
          <input type="radio" name="pm" id="private" value="1">
          <label for="private">Private</label>
        </p>
        <textarea name="text" cols="50"></textarea>
        <br>
        <input type="submit" class="button" value="Post Message">
      </form><br>
<?php
    date_default_timezone_set('UTC');

    if (isset($_GET['erase'])) {
      $stmt = $pdo->prepare('DELETE FROM messages WHERE id=? AND recip=?');
      $stmt->execute([(int)$_GET['erase'], $user]);
    }

    $stmt = $pdo->prepare('SELECT * FROM messages
      WHERE recip=? ORDER BY time DESC');
    $stmt->execute([$view]);
    $num = $stmt->rowCount();

    while ($row = $stmt->fetch()) {
      $pm = $row['pm'] === '1';
      $auth_html_entities = htmlentities($row['auth']);
      $message_html_entities = htmlentities($row['message']);
      $id_html_entities = htmlentities($row['id']);

      if (!$pm || $row['auth'] === $user || $row['recip'] === $user) {
        echo date('M jS \'y g:ia:', $row['time']);
        echo " <a href='messages.php?view=$auth_html_entities'>
          $auth_html_entities</a> ";

        if (!$pm)
          echo "wrote: &quot;$message_html_entities&quot; ";
        else
          echo "whispered: <span class='whisper'>
            &quot;$message_html_entities&quot;</span> ";

        if ($row['recip'] === $user)
          echo "[<a href='messages.php?view=$view_html_entities" .
               "&erase=$id_html_entities'>erase</a>]";

        echo "<br>";
      }
    }
  }

  if (!$num)
    echo "<br><span class='info'>No messages yet</span><br><br>";

  echo "<br><a class='button'
    href='messages.php?view=$view_html_entities'>Refresh messages</a>";
?>

    </div>
  </body>
</html>
