
<?php
if ($_POST['inputUserName'] == "No") {
  // think of scenario when creating a user could be an error
    // date is in the future
  header("Location: register.php? err= Could not create user");
}
else {
  header("Location: login.php? registerSuccess= User created");
}

/* FROM CLASS

$conn = mysqli_connect('localhost', 'admin', 'Aa.123', 'db1');
$username = $_POST['username'];
$password = $_POST['password'];
$empID = $_POST['empID'];

$sql = "insert into USERS values ('$username','$password','USER',$empID)";

if($conn->query($sql)){

    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['userType'] = 'USER';
    $_SESSION['eid'] = $empID;

    header('location:homepage.php');
}else{
    echo $conn->error;
}

*/
?>