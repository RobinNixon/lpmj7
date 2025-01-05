<?php // Example 02: header.php
  session_start();
  require_once 'functions.php';

  $userstr = 'Welcome Guest';

  if (isset($_SESSION['user'])) {
    $user_html_entities = htmlentities($_SESSION['user']);
    $loggedin = TRUE;
    $userstr  = "Logged in as: $user_html_entities";
  }
  else
    $loggedin = FALSE;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="styles.css">
    <script src="javascript.js"></script>
    <link rel="stylesheet" href="
    https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css
    ">
    <title>Robin's Nest: <?php echo $userstr; ?></title>
  </head>
  <body>
    <div>
      <div>
        <div id="logo"
          class="center">R<img id="robin" src="robin.gif">bin's Nest</div>
        <div class="username"><?php echo $userstr; ?></div>
      </div>
      <div class="content">

<?php
  if ($loggedin) {
?>
        <div class="center">
          <a class="button" 
            href="members.php?view=<?php echo $user_html_entities; ?>">
            <i class="bi-house-door-fill"></i> Home</a>
          <a class="button" href="members.php">
            <i class="bi-person-fill"></i> Members</a>
          <a class="button" href="friends.php">
            <i class="bi-heart-fill"></i> Friends</a><br>
          <a class="button" href="messages.php">
            <i class="bi-envelope-fill"></i> Messages</a>
          <a class="button" href="profile.php">
            <i class="bi-pencil-fill"></i> Edit Profile</a>
          <a class="button" href="logout.php">
            <i class="bi-door-closed-fill"></i> Log out</a>
        </div>
<?php        
  } else {
?>
        <div class="center">
          <a class="button" href="index.php">
            <i class="bi-house-door-fill"></i> Home</a>
          <a class="button" href="signup.php">
            <i class="bi-plus-circle-fill"></i> Sign Up</a>
          <a class="button" href="login.php">
            <i class="bi-check-circle-fill"></i> Log In</a>
        </div>
        <p class="info">(You must be logged in to use this app)</p>
<?php
  }
?>
