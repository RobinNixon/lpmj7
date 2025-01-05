<?php // Example 07: login.php
  require_once 'header.php';
  $error = $user = "";

  if (isset($_POST['user'])) {
    $user = $_POST['user'];
    if ($user === "" || $_POST['pass'] === "")
      $error = 'Not all fields were entered';
    else {
      $stmt = $pdo->prepare('SELECT user,pass FROM members WHERE user=?');
      $stmt->execute([$user]);
      $result = $stmt->fetchAll();

      if (count($result) === 0
        || !password_verify($_POST['pass'], $result[0]['pass']))
      {
        $error = "Invalid login attempt";
      } else {
        $_SESSION['user'] = $user;
        header('Location: members.php?view=' . $user);
      }
    }
  }
  $error_html_entities = htmlentities($error);
  $user_html_entities = htmlentities($user);
?>
      <form method="post" action="login.php">
        <p class="error">
            <?php echo $error_html_entities; ?>
        </p>
        <p>
          Please enter your details to log in
        </p>
        <p>
          <label>Username</label>
          <input type="text" maxlength="16" name="user"
            value="<?php echo $user_html_entities; ?>">
        </p>
        <p>
          <label>Password</label>
          <input type="password" name="pass">
        </p>
        <p>
          <label></label>
          <input type="submit" value="Login">
        </p>
      </form>
    </div>
  </body>
</html>
