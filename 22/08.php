<?php // Example 08: profile.php
  require_once 'header.php';

  if (!$loggedin)
    die("</div></body></html>");
  $user = $_SESSION['user'];

  echo "<h3>Your Profile</h3>";

  $stmt = $pdo->prepare('SELECT * FROM profiles WHERE user=?');
  $stmt->execute([$user]);

  if (isset($_POST['text'])) {
    $text = preg_replace('/\s\s+/', ' ', $_POST['text']);
    $text_html_entities = htmlentities($_POST['text']);

    if ($stmt->rowCount())
      $stmt2 = $pdo->prepare('UPDATE profiles SET text=:text WHERE user=:user');
    else
      $stmt2 = $pdo->prepare('INSERT INTO profiles VALUES(:user, :text)');
    $stmt2->execute([':text' => $text, ':user' => $user]);
  } else {
    if ($stmt->rowCount()) {
      $row = $stmt->fetch();
      $text_html_entities = htmlentities($row['text']);
    }
    else $text_html_entities = "";
  }

  if (isset($_FILES['image']['name'])) {
    $saveto = "$user.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = TRUE;

    $info = getimagesize($saveto);
    if ($info) {
      list($w, $h, $type) = $info;
      switch ($type) {
        case IMAGETYPE_GIF:  $src = imagecreatefromgif($saveto); break;
        case IMAGETYPE_JPEG: $src = imagecreatefromjpeg($saveto); break;
        case IMAGETYPE_PNG:  $src = imagecreatefrompng($saveto); break;
        default:             $typeok = FALSE; break;
      }
    }
    else
      $typeok = FALSE;

    if ($typeok) {
      $max = 100;
      $tw  = $w;
      $th  = $h;

      if ($w > $h && $max < $w) {
        $th = $max / $w * $h;
        $tw = $max;
      } elseif ($h > $w && $max < $h) {
        $tw = $max / $h * $w;
        $th = $max;
      } elseif ($max < $w) {
        $tw = $th = $max;
      }

      $tmp = imagecreatetruecolor($tw, $th);
      imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
      imageconvolution($tmp, array(array(-1, -1, -1),
        array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
      imagejpeg($tmp, $saveto);
      imagedestroy($tmp);
      imagedestroy($src);
    }
  }

  showProfile($user, $pdo);
?>
      <form method="post"
        action="profile.php" enctype="multipart/form-data">
      <h3>Enter or edit your details and/or upload an image</h3>
      <textarea
        name="text" cols="50"><?php echo $text_html_entities; ?></textarea>
      <p>Image: <input type="file" name="image" size="14"></p>
      <input type="submit" class="button" value="Save Profile">
      </form>
    </div>
  </body>
</html>
