<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "pregnancy");

$patientID = $_GET['a'];
$index = $_GET['arryInd'];
// echo $index;

$status = $_POST['inputStatus'];
// echo $status;
// 
$int = 0;

$sql = "UPDATE pregnancies SET";
$sql = $sql .  " status = '$status' ";
$int++;
// echo $status;
if (!empty($_POST['inputDate'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $date = $_POST['inputDate'];
    $sql = $sql . "due_date = '$date' ";
    echo $date;
    $int++;
}
if (!empty($_POST['inputBabyName'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $babyName = $_POST['inputBabyName'];
    $sql = $sql . "babyName = '$babyName' ";
    $int++;
}
if (!empty($_POST['inputBabyHealth'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $babyHealth = $_POST['inputBabyHealth'];
    $sql = $sql . "Health = '$babyHealth' ";
    $int++;
}
if (!empty($_POST['inputMomHealth'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $momHealth = $_POST['inputMomHealth'];
    $sql = $sql . "momHealth = '$momHealth' ";
    $int++;
}

$sql = $sql . "WHERE patientID='$patientID' AND id=$index";
echo $sql;
if ($conn->query($sql) === TRUE) {
    header("Location: doctorPregnancy.php?a=$patientID");
} else {
    header("Location: doctorPregnancy.php?a=$patientID");
}
