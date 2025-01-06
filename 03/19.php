<?php
  static $int = 0;         // Allowed
  static $int = 1 + 2;     // Correct (as of PHP 5.6)
  static $int = sqrt(144); // Disallowed
?>
