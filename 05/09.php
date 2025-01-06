<?php
  class User
  {
    public $name, $password;

    function save_user()
    {
      echo "Save User code goes here";
    }
  }

  $object = new User;
  print_r($object);
?>
