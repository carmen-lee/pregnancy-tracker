
<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "pregnancy");

$patientID = $_GET['a'];
$doctorId = $_SESSION['sessionUserId'];
// echo $index;

$status = $_POST['inputStatus'];

$int = 0;
$sql = "INSERT INTO pregnancies  VALUES (default, '$doctorId'";

if (!empty($_POST['inputMomHealth'])) {
    $momHealth = $_POST['inputMomHealth'];
    $sql = $sql . ", '$momHealth'";
} else {
    $sql = $sql . ", default";
}

if (!empty($_POST['inputBabyHealth'])) {
    $babyHealth = $_POST['inputBabyHealth'];
    $sql = $sql . ", '$babyHealth'";
    $int++;
} else {
    $sql = $sql . ", default";
}
if (!empty($_POST['inputDate'])) {
    $date = $_POST['inputDate'];
    $sql = $sql . ", '$date'";
    $int++;
} else {
    $sql = $sql . ", default";
}
$sql = $sql .  ", '$status'";
$sql = $sql . ", '$patientID'";
if (!empty($_POST['inputBabyName'])) {
    $babyName = $_POST['inputBabyName'];
    $sql = $sql . ", '$babyName'";
} else {
    $sql = $sql . ", default ";
}

$sql = $sql . ")";

if ($conn->query($sql) === TRUE) {
    echo $sql;
    header("Location: doctorPregnancy.php?a=$patientID");
} else {
    header("Location: doctorPregnancy.php?a=$patientID");
}

?>