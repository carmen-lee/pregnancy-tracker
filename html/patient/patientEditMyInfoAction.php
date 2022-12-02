<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "pregnancy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$patientId = $_SESSION['sessionUserId'];
$int = 0;
$sql = "UPDATE Users SET ";

if (!empty($_POST['bday'])) {
    $bday = $_POST['bday'];
    $sql = $sql . "birthdate = '$bday' ";
    $int++;
}
if (!empty($_POST['email'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $email = $_POST['email'];
    $sql = $sql . "email = '$email' ";
    $int++;
}
if (!empty($_POST['phone'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $phone = $_POST['phone'];
    $sql = $sql . "phone = '$phone' ";
    $int++;
}
if (!empty($_POST['addy'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $addy = $_POST['addy'];
    $sql = $sql . " address = '$addy' ";
    $int++;
}
if (!empty($_POST['user'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $user = $_POST['user'];
    $sql = $sql . "username = '$user' ";
    $int++;
}
if (!empty($_POST['ECname'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $ECname = $_POST['ECname'];
    $sql = $sql . "emerCon_name = '$ECname' ";
    $int++;
}
if (!empty($_POST['ECrelation'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $ECrelation = $_POST['ECrelation'];
    $sql = $sql . "emerCon_relation = '$ECrelation' ";
    $int++;
}
if (!empty($_POST['ECphone'])) {
    if ($int == 1) {
        $sql = $sql . ", ";
        $int--;
    }
    $ECphone = $_POST['ECphone'];
    $sql = $sql . "emerCon_phone = '$ECphone' ";
    $int++;
}

$sql = $sql . "WHERE id='$patientId' ";
if ($int != 1) {
    header("Location: patientPortal.php? err= Nothing Changed. ");
}

if ($conn->query($sql) === TRUE) {
    header("Location: patientPortal.php? succ= Updated Information. ");
} else {
    header("Location: patientPortal.php? err= Something went wrong. ");
}
