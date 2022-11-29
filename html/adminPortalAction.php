<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli("localhost", "root", "", "pregnancy");
$sql = "INSERT INTO `Doctors`(`id`, `email`, `password`, `firstName`, `lastName`, `username`) VALUES ('0','$email','$password','$firstName' , '$lastName' ,'$username')";
$rs = mysqli_query($conn, $sql);
if($rs)
{
	echo "Contact Records Inserted";
}


$conn->close();


?>