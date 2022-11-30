<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$userName = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['Key'];
$conn = new mysqli("localhost", "root", "", "pregnancy");

$sql = "UPDATE `Doctors` SET `email` = '$email', `password` = '$password', `firstName` = '$firstName', `lastName` = '$lastName', `username` = '$userName' WHERE `Doctors`.`id` = $id";
$conn->query($sql);
echo "Database has been changed";
?>

