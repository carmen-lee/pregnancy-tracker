
<?php
$servername = "localhost";
$dir = "root";
$password = "";
$dbname = "pregnancy";
// Create connection
$conn = new mysqli($servername, $dir, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
  echo "connection has been made\n";
}
  
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
$conn->close();
?>
