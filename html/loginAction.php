<?php
//establish connection
$conn = mysqli_connect("localhost", "root", "", "pregnancy");
//check connection
if (!$conn) {
  echo 'Connection failed' . mysqli_connect_error();
}

//create query
$sql = "SELECT * FROM Users";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

//get user input
$username = $_POST['inputUserName'];
$userpassword = $_POST['inputPassword'];
$userFound = false;

//find user
//cant we just use a single query to get the user???
foreach ($users as $user) {
  if ($username === $user['username'] && $userpassword === $user['userpassword']) {
    $userFound = true;
    //get role of user
    $role = $user['role'];
    $userId = $user['id'];
    $firstName = $user['first_name'];
    $lastName = $user['last_name'];
    // $email = $user['email'];
    break;
  }
}

if (!$userFound) {
  // incorrect login
  header("Location: login.php? err=Incorrect username/password");
}

//start session
session_start();
// $_SESSION['sessionUsername'] = $username;
// $_SESSION['sessionUserPassword'] = $userpassword;
$_SESSION['sessionRole'] = $role;
$_SESSION['sessionUserId'] = $userId;
$_SESSION['sessionFirstName'] = $firstName;
$_SESSION['sessionLastName'] = $lastName;
// $_SESSION['sessionEmail'] = $email;

//redirect to the correct home page
if ($role == 'ADMIN') {
  header("Location: admin/adminPortal.php");
} elseif ($role == 'DOCTOR') {
  header("Location: doctor/doctorPortal.php");
} elseif ($role == 'PATIENT') {
  header("Location: patient/patientPortal.php");
}

$conn->close();
