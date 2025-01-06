<?php // urlpost.php
  if (isset($_POST['url']))
  {
    echo file_get_contents('http://' . $_POST['url']);
  }
?>
