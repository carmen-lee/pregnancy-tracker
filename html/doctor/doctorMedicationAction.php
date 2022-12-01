<?php
session_start();
$medNameF = $_POST['inputMedicationName'];
$medDosageF = $_POST['inputMedicationDosage'];
$medFrequencyF = $_POST['inputMedicationFrequency'];
$medFoodF = $_POST['inputMedicationFood'];
$patientId = $_POST['patient'];
$doctorId = $_SESSION['sessionUserId'];



header("Location: doctorMedications.php? succ='$medFrequencyF'");

$conn = mysqli_connect("localhost", "root", "", "pregnancy");
$sql = "INSERT INTO medication(id,patientID,medName,medDosage,medFrequency,medFood) VALUES (default,'$patientId','$medNameF','$medDosageF','$medFrequencyF','$medFoodF')";
// $sql = "INSERT INTO medication VALUES (default,3,'medNameF','medDosageF','medFrequencyF','With Food')";

if ($conn->query($sql) === TRUE) {
    header("Location: doctorMedications.php? succ= Medicine has been added");
} else {
    header("Location: doctorMedications.php? err= 'Error: ' . $sql . '<br>' . $conn->error");
}
$conn->close();
