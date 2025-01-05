<?php // Example 12: logout.php
  require_once 'header.php';

  if (isset($_SESSION['user'])) {
    destroySession();
    header('Location: index.php');
  } else
    echo "<div class='center'>You cannot log out because
      you are not logged in</div>";
?>
    </div>
  </body>
</html>
