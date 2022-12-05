
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

$sqln = "SELECT assigned_doctorId FROM Users WHERE assigned_doctorId !='NULL' GROUP BY assigned_doctorId ORDER BY COUNT(assigned_doctorId) ASC LIMIT 1";
// $sqln = "INSERT INTO Users(first_name, last_name, email, userpassword, role, username, birthdate, phone, assigned_doctorId) VALUES ('$first', '$last','$email','$password', 'Patient', '$username', '$birthdate', '$phone', '$docId');";

$docID = mysqli_query($conn, $sqln);
$row = mysqli_fetch_assoc($docID);
$docId = $row['assigned_doctorId'];


$number = preg_match('@[0-9]@', $password);
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $passwords);
$specialChars = preg_match('@[^\w]@', $password);

// header("Location: register.php? err= $conn->error");

if ($userType == 'patient') {
  $sql = "INSERT INTO Users(first_name, last_name, email, userpassword, role, username, birthdate, phone, assigned_doctorId) VALUES ('$first', '$last','$email','$password', 'Patient', '$username', '$birthdate', '$phone', '$docId');";
} else {
  $sql = "INSERT INTO Users(first_name, last_name, email, userpassword, role, username, birthdate, phone) VALUES ('$first', '$last','$email','$password', 'Admin', '$username', '$birthdate', '$phone');";
}

// $conn->close();

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