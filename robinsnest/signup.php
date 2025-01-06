<?php // Example 05: signup.php
  require_once 'header.php';

  $error = $user = "";
  if (isset($_SESSION['user']))
    destroySession();

  if (isset($_POST['user'])) {
    $user = $_POST['user'];
    if ($_POST['user'] === "" || $_POST['pass'] === "")
      $error = 'Not all fields were entered';
    else {
      $stmt = $pdo->prepare('SELECT * FROM members WHERE user=?');
      $stmt->execute([$user]);
      if ($stmt->rowCount())
        $error = 'That username already exists<br><br>';
      else {
        $stmt = $pdo->prepare('INSERT INTO members VALUES(?, ?)');
        $stmt->execute([$user, password_hash($_POST['pass'], PASSWORD_DEFAULT)]);
        die('<h4>Account created</h4>Please Log in.</div></body></html>');
      }
    }
  }
  $error_html_entities = htmlentities($error);
  $user_html_entities = htmlentities($user);
?>
      <form method="post" action="signup.php">
      <p class="error">
        <?php echo $error_html_entities; ?>
      </p>
      <p>Please enter your details to sign up</p>
      <p>
        <label>Username</label>
        <input type="text" maxlength="16" name="user" id="username"
          value="<?php echo $user_html_entities; ?>"><br>
        <label></label><span id="used">&nbsp;</span>
      </p>
      <p>
        <label>Password</label>
        <input type="text" name="pass">
      </p>
      <p>
        <label></label>
        <input type="submit" value="Sign Up">
      </p>
      </form>
      <script>
        const field = byId('username');
        field.onblur = () => {
          if (field.value === '')
            return
          const data = new FormData()
          data.set('user', field.value)
          fetch('checkuser.php', { method: 'post', body: data})
            .then(response => response.text())
            .then(text => byId('used').innerHTML = text)
        }
      </script>  
    </div>
  </body>
</html>
