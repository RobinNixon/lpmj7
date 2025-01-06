<?php // Example 04: index.php
  require_once 'header.php';

  echo "<div class='center'>Welcome to Robin's Nest,";

  if ($loggedin) {
    $user_html_entities = htmlentities($_SESSION['user']);
    echo " $user_html_entities, you are logged in";
  } else
    echo ' please sign up or log in';
?>

      </div>
    </div>
    <h4 id="footer" class="center">Web App from <i>
      <a href="https://github.com/RobinNixon/lpmj7" target="_blank">
      Learning PHP MySQL & JavaScript</a>
    </i></h4>
  </body>
</html>
