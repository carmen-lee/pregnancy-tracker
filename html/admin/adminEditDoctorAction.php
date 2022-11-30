<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$userName = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['Key'];

//$conn = new mysqli("localhost", "root", "", "pregnancy");
//$sql = "INSERT INTO `Doctors`(`id`, `email`, `password`, `firstName`, `lastName`, `username`) VALUES ('0','$email','$password','$firstName' , '$lastName' ,'$username')";
//$result = $conn->query($sql);
echo $id;
?>