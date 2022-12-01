<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli("localhost", "root", "", "pregnancy");
$sql = "INSERT INTO `Users` (`id`, `first_name`, `last_name`, `email`, `userpassword`, `role`, `username`, `assigned_doctorId`, `birthdate`, `phone`) 
VALUES (NULL, '$firstName', '$lastName', '$email', '$password', 'DOCTOR', '$username', NULL, NULL, NULL)";


$rs = mysqli_query($conn, $sql);
if($rs)
{
	echo "Contact Records Inserted";
}


$conn->close();


?>