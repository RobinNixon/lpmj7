<?php // urlget.php
  if (isset($_GET['url']))
  {
    echo file_get_contents('http://' . $_GET['url']);
  }
?>
