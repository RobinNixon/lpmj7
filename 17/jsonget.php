<?php // jsonget.php
  if (isset($_GET['url']))
  {
    header('Content-Type: application/json');
    $data = [
      'html' => file_get_contents('http://' . $_GET['url']),
      'color' => 'blue',
    ];
    echo json_encode($data);
  }
?>
