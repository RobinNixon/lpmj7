<?php
  class User
  {
    public $name, $password;

    function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }
  }
?>
