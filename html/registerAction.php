
<?php
// if ($_POST['inputUserName'] == "No") {
//   // think of scenario when creating a user could be an error
//   // date is in the future
//   header("Location: register.php? err= Could not create user");
// } else {
//   header("Location: login.php? registerSuccess= User created $roles");
// }

/* FROM CLASS*/

$conn = mysqli_connect('localhost', 'root', '', 'pregnancy');
$username = $_POST['inputUserName'];
$password = $_POST['inputPassword'];
$first = $_POST['inputFirst'];
$last = $_POST['inputLast'];
$userType = $_POST['inputRole'];
$email = $_POST['inputEmail'];
$phone = $_POST['inputPhoneNumber'];
$birthdate = $_POST['inputBirthdate'];

if ($userType == 'patient') {
  $sql = "INSERT INTO Users(first_name, last_name, email, userpassword, role, username, birthdate, phone) VALUES ('$first', '$last','$email','$password', 'Patient', '$username', '$birthdate', '$phone');";
} else {
  $sql = "INSERT INTO Users(first_name, last_name, email, userpassword, role, username, birthdate, phone) VALUES ('$first', '$last','$email','$password', 'Admin', '$username', '$birthdate', '$phone');";
}


if ($conn->query($sql)) {


  session_start();
  $_SESSION['username'] = $username;
  // $_SESSION['userType'] = 'USER';
  // $_SESSION['eid'] = $empID;

  // header('location:login.php');
  header("Location: login.php? registerSuccess= User created $roles");
} else {
  header("Location: register.php? err= $conn->error");
}


?>