<?php
  function destroy_session_and_data()
  {
    $_SESSION = array();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 2592000, $params['path']);
    session_destroy();
  }
?>
