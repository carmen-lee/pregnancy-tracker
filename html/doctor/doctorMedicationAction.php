<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "pregnancy");

$medNameF = $_POST['inputMedicationName'];
$medDosageF = $_POST['inputMedicationDosage'];
$medFrequencyF = $_POST['inputMedicationFrequency'];
if (isset($_POST['inputFood'])) {
    $medFoodF = $_POST['inputFood'];
}
if (isset($_POST['inputPatient'])) {
    $patientId = $_POST['inputPatient'];
}
$doctorId = $_SESSION['sessionUserId'];

// header("Location: doctorMedications.php? succ='$medNameF'");
?>
<?php
$sql = "INSERT INTO `medication` VALUES (default,'$patientId','$medNameF','$medDosageF','$medFrequencyF','$medFoodF')";

if ($conn->query($sql)) {
    header("Location: doctorMedications.php? succ= Success ");
} else {
    header("Location: doctorMedications.php? err= 'Error: ' . $sql . '<br>' . $conn->error");
}
$conn->close();
?>