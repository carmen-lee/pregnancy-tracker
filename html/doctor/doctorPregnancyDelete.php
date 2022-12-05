<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "pregnancy");
$pregoID = $_GET['increment'];
$patientID = $_GET['a'];
echo $patientID;

$sql = "DELETE FROM `pregnancies` WHERE `pregnancies`.`id` = $pregoID";
if ($conn->query($sql) === TRUE) {
    echo $sql;
    header("Location: doctorPregnancy.php?a=$patientID");
} else {
    header("Location: doctorPregnancy.php?a=$patientID");
}
