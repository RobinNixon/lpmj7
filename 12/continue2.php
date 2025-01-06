<?php // continue.php = version 2
  session_start();


  if (isset($_SESSION['forename']))
  {
    $forename = $_SESSION['forename'];
    $surname  = $_SESSION['surname'];

    destroy_session_and_data();

    echo htmlspecialchars("Welcome back $forename");
    echo "<br>";
    echo htmlspecialchars("Your full name is $forename $surname.");

  }
  else echo "Please <a href='authenticate.php'>click here</a> to log in.";

  function destroy_session_and_data()
  {
    $_SESSION = array();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 2592000, $params['path']);
    session_destroy();
  }
?>
