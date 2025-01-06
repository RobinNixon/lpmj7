<?php // convert.php
  $f = $c = $f_html_entities = $c_html_entities = '';

  if (isset($_POST['f'])) {
    $f = $_POST['f'];
    $f_html_entities = htmlentities($f);
  }
  if (isset($_POST['c'])) {
    $c = $_POST['c'];
    $c_html_entities = htmlentities($c);
  }

  if (is_numeric($f)) {
    $c = intval((5 / 9) * ($f - 32));
    $out = "$f &deg;F equals $c &deg;C";
  } elseif(is_numeric($c)) {
    $f = intval((9 / 5) * $c + 32);
    $out = "$c &deg;C equals $f &deg;F";
  } else
    $out = "";
?>
<html>
  <head>
    <title>Temperature Converter</title>
  </head>
  <body>
    <pre>
      Enter either Fahrenheit or Celsius and click on Convert

      <b><?php echo $out; ?></b>
      <form method="post" action="">
        <label>Fahrenheit <input type="text" name="f"
          value="<?php echo $f_html_entities; ?>" size="7"></label>
           <label>Celsius <input type="text" name="c"
              value="<?php echo $c_html_entities; ?>" size="7"></label>
                   <input type="submit" value="Convert">
      </form>
    </pre>
  </body>
</html>
