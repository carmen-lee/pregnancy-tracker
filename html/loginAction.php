<?php
//establish connection
$conn = mysqli_connect("localhost", "root", "", "pregnancy");


//check connection
if (!$conn) {
  echo 'Connection failed' . mysqli_connect_error();
}

//create query
$sql = "SELECT username, userpassword, role FROM Users";
$result = mysqli_query($conn, $sql);

//get user input
$username = $_POST['inputUserName'];
$userpassword = $_POST['inputPassword'];
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

//find user
foreach( $users as $user) {
  if( $username === $user['username'] && $userpassword === $user['userpassword']) {
    //get role of user
    $role = $user['role'];
  } else {
    // incorrect login
    header("Location: login.php? err=Incorrect username/password");
  }
}

//start session
session_start();
$_SESSION['sessionUsername'] = $username;
$_SESSION['sessionUserPassword'] = $userpassword;
$_SESSION['sessionRole'] = $role;

//redirect to the correct home page
if($role == 'Admin'){
  header("Location: admin/adminPortal.php");
}
elseif($role == 'Doctor'){
  header("Location: doctor/doctorPortal.php");
}
elseif($role == 'Patient'){
  header("Location: patient/patientPortal.php");
}



// if($roleType == 'admin'){
//   $sql = "SELECT username, userpassword FROM Users";
//   $result = $conn->query($sql);

//   if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//       if($userName == $row["username"] && $userpassword == $row["userpassword"]){
//         header("Location: admin/adminPortal.php");
//       }
//     }
//   } else {
//       echo "0 results";
//   }
// }
// elseif($roleType == 'doctor'){
//   $sql = "SELECT username, userpassword FROM Users";
//   $result = $conn->query($sql);

//   if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//       if($userName == $row["username"] && $userpassword == $row["userpassword"]){
//         header("Location: doctor/doctorPortal.php");
//       }
//     }
//   } else {
//     echo "0 results";
//   }

// }
// elseif($roleType == 'patient'){
//   $sql = "SELECT username, userpassword FROM Users";
//   $result = $conn->query($sql);

//   if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//       if($userName == $row["username"] && $userpassword == $row["userpassword"]){
//         header("Location: patient/patientPortal.php");
//       }
//     }
//   } else {
//     echo "0 results";
//   }
// }

  

$conn->close();
?>



