<?php // adduser.php

// The PHP functions

function validate_forename($field)
{
  return ($field == '') ? 'No Forename was entered': '';
}

function validate_surname($field)
{
  return($field == '') ? 'No Surname was entered' : '';
}

function validate_username($field)
{
  if ($field == '')
    return 'No Username was entered';
  else if (strlen($field) < 5)
    return 'Usernames must be at least 5 characters';
  else if (preg_match('/[^a-zA-Z0-9_-]/', $field))
    return 'Only letters, numbers, - and _ in usernames';
  return '';
}

function validate_password($field)
{
  if ($field == '')
    return 'No Password was entered';
  else if (strlen($field) < 6)
    return 'Passwords must be at least 6 characters';
  else if (!preg_match('/[a-z]/', $field)
    || !preg_match('/[A-Z]/', $field)
    || !preg_match('/[0-9]/', $field))
    return 'Passwords require one each of a-z, A-Z and 0-9';
  return '';
}

function validate_age($field)
{
  if ($field == '')
    return 'No Age was entered';
  else if ($field < 18 || $field > 110)
    return 'Age must be between 18 and 110';
  return '';
}

function validate_email($field)
{
  if ($field == '')
    return 'No Email was entered';
  else if (!filter_var($field, FILTER_VALIDATE_EMAIL))
    return 'The Email address is invalid';
  return '';
}

// The PHP code

$forename_html_entities = '';
$surname_html_entities = '';
$username_html_entities = '';
$password_html_entities = '';
$age_html_entities = '';
$email_html_entities = '';
$errors = $values =[];

if ($_POST) {
  foreach ($_POST as $name => $value)
    $values[$name] = trim($value);

  $error = validate_forename($values['forename']);
  if ($error) $errors['forename'] = $error;
  $error = validate_forename($values['forename']);
  if ($error) $errors['forename'] = $error;
  $error = validate_surname($values['surname']);
  if ($error) $errors['surname'] = $error;
  $error = validate_username($values['username']);
  if ($error) $errors['username'] = $error;
  $error = validate_password($values['password']);
  if ($error) $errors['password'] = $error;
  $error = validate_age($values['age']);
  if ($error) $errors['age'] = $error;
  $error = validate_email($values['email']);
  if ($error) $errors['email'] = $error;

  if (!$errors) {
    /*
    This is where you would enter the posted fields into a database,
    reading the $values array, using password_hash for the password,
    then redirecting to a success page.

    For example:
    $stmt = $pdo->prepare('INSERT INTO users VALUES(:fn,:sn,:un,:pw)');
    $stmt->execute([
      ':fn' => $values['forename'],
      ':sn' => $values['surname'],
      ':un' => $values['username'],
      ':pw' => password_hash($values['forename'], PASSWORD_DEFAULT)
    ]);
    header('Location: success.php');
    exit;

    We'll simplify it and just output the data:
    */
    echo "<html><body>Form data successfully validated<pre>";
    echo htmlentities(print_r($values, true));
    echo "</pre></body></html>";
    exit;
  }

  // To echo the values back to the form when validation fails
  $forename_html_entities = htmlentities($_POST['forename']);
  $surname_html_entities = htmlentities($_POST['surname']);
  $username_html_entities = htmlentities($_POST['username']);
  $password_html_entities = htmlentities($_POST['password']);
  $age_html_entities = htmlentities($_POST['age']);
  $email_html_entities = htmlentities($_POST['email']);
}

// The HTML/JavaScript section
?>
<!DOCTYPE html>
<html>
  <head>
    <title>An Example Form</title>
    <style>
      .signup {
        border: 1px solid #999999;
        font: normal 14px helvetica;
        color: #444444;
        background-color: #eeeeee;
        border-spacing: 5px;
      }
      .signup th, .signup td {
        padding: 2px;
      }
      .error {
        color: red;
      }
    </style>
  </head>
  <body>
    <form method="post" action="" id="form">
    <table class="signup">
      <th colspan="2" align="center">Signup Form</th>

      <?php if ($errors) { ?>
      <tr><td colspan="2">Sorry, the following errors were found<br>in your form:
        <p><i class="error">
          <?php foreach ($errors as $error) echo htmlentities($error) . '<br>'; ?>
        </i></p>
      </td></tr>
      <?php } ?>

      <tr><td>Forename</td>
        <td><input type="text" maxlength="32" name="forename" required
          value="<?php echo $forename_html_entities; ?>"></td></tr>
      <tr><td>Surname</td>
        <td><input type="text" maxlength="32" name="surname" required
          value="<?php echo $surname_html_entities; ?>"></td></tr>
      <tr><td>Username</td>
        <td><input type="text" maxlength="16" name="username" required
          value="<?php echo $username_html_entities; ?>"></td></tr>
      <tr><td>Password</td>
        <td><input type="password" name="password" required
          value="<?php echo $password_html_entities; ?>"></td></tr>
      <tr><td>Age</td>
        <td><input type="number" max="110" name="age" required
          value="<?php echo $age_html_entities; ?>"></td></tr>
      <tr><td>Email</td>
        <td><input type="email" maxlength="64" name="email" required
          value="<?php echo $email_html_entities; ?>"></td></tr>
      <tr><td colspan="2" align="center"><input type="submit"
        value="Signup"></td></tr>
    </table>
    </form>
    <script>
      function validateForename(field)
      {
        return (field === "") ? "No Forename was entered." : ""
      }

      function validateSurname(field)
      {
        return (field === "") ? "No Surname was entered." : ""
      }

      function validateUsername(field)
      {
        if (field == "")
          return "No Username was entered."
        else if (field.length < 5)
          return "Usernames must be at least 5 characters."
        else if (/[^a-zA-Z0-9_-]/.test(field))
          return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames."
        return ""
      }

      function validatePassword(field)
      {
        if (field == "")
          return "No Password was entered."
        else if (field.length < 6)
          return "Passwords must be at least 6 characters."
        else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) ||
                 !/[0-9]/.test(field))
          return "Passwords require one each of a-z, A-Z and 0-9."
        return ""
      }

      function validateAge(field)
      {
        if (field == "" || isNaN(field))
          return "No Age was entered."
        else if (field < 18 || field > 110)
          return "Age must be between 18 and 110."
        return ""
      }

      function validateEmail(field)
      {
        return (field === "") ? "No Email was entered." : ""
      }

      function validateFields(form)
      {
        const errors = []
        const elements = {}
        let error = ''

        for (let element of form.elements)
          elements[element.name] = element.value.trim()

        error = validateForename(elements.forename)
        if (error) errors.push({field: 'forename', message: error})
        error = validateSurname(elements.surname)
        if (error) errors.push({field: 'surname', message: error})
        error = validateUsername(elements.username)
        if (error) errors.push({field: 'username', message: error})
        error = validatePassword(elements.password)
        if (error) errors.push({field: 'password', message: error})
        error = validateAge(elements.age)
        if (error) errors.push({field: 'age', message: error})
        error = validateEmail(elements.email)
        if (error) errors.push({field: 'email', message: error})
        return errors
      }

      const validate = function(event)
      {
        const errors = validateFields(event.target)
        if (errors.length) {
          const alerts = []
          for (error of errors) {
            alerts.push(error.field + ": " + error.message)
          }
          alert(alerts.join("\n"))
          event.preventDefault()
        }
      }
      document.getElementById('form').addEventListener('submit', validate)
    </script>
  </body>
</html>
