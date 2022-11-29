<?php
$conn = new mysqli("localhost", "root", "", "pregnancy");

$userName = $_POST['inputUserName'];
$userpassword = $_POST['inputPassword'];
$roleType = $_POST['loginType'];

session_start();
$_SESSION['sessionUserName'] = $userName;
$_SESSION['sessionUserPassword'] = $userpassword;
//print 'hello' . $_POST['loginType'];

if($roleType == 'admin'){
  $sql = "SELECT username, userpassword FROM Users";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($userName == $row["username"] && $userpassword == $row["userpassword"]){
        header("Location: adminPortal.php");
        }
  }
}
else {
    echo "0 results";
  }


}
elseif($roleType == 'doctor'){
  $sql = "SELECT id, firstName, lastName FROM Patients";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["firstName"]. " " . $row["lastName"]. "<br>";
      
      }
  }
  else {
    echo "0 results";
  }

}
elseif($roleType == 'patient'){
  $sql = "SELECT id, firstName, lastName FROM Patients";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["firstName"]. " " . $row["lastName"]. "<br>";
      
      }
  }
  else {
    echo "0 results";
  }


}

  

$conn->close();
?>



