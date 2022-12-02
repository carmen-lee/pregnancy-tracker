<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "pregnancy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$medID = $_GET['increment'];
echo $medID;

$sql = "DELETE FROM medication WHERE increment = $medID";
if ($conn->query($sql) === TRUE) {
    header("Location: doctorMedications.php? succ=. ");
} else {
    header("Location: doctorMedications.php? err= Something went wrong. ");
}
