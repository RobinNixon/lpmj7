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
