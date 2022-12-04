<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'pregnancy');

$inputDate = $_POST['inputDate'];
$inputTime = $_POST['inputTime'];
$reason = $_POST['inputReason'];
$userType = $_SESSION['sessionRole'];

if ($userType == 'DOCTOR') {

	if(isset($_POST['inputPatient'])) {
		$patientId = $_POST['inputPatient'];
	}
	$doctorId = $_SESSION['sessionUserId'];

	$sql = "INSERT INTO appointments(apptDate,apptTime,status,patientId,doctorId,reason) VALUES ('$inputDate', '$inputTime','SCHEDULED','$patientId', '$doctorId', '$reason');";
	if ($conn->query($sql)) {
		header("Location: doctor/doctorAppointments.php? succ= Success ");
	} else {
		header("Location: doctor/doctorAppointments.php? err= 'Error: ' . $sql . '<br>' . $conn->error");
	}
	
} else {
	if(isset($_POST['inputDoctor'])) {
		$doctorId = $_POST['inputDoctor'];
	}
	$patientId = $_SESSION['sessionUserId'];
	$sql = "INSERT INTO appointments(apptDate,apptTime,status,patientId,doctorId,reason) VALUES ('$inputDate', '$inputTime','REQUESTED','$patientId', '$doctorId', '$reason');";
	if ($conn->query($sql)) {
		header("Location: patient/patientAppointments.php? succ= Success ");
	} else {
		header("Location: patient/patientAppointments.php? err= 'Error: ' . $sql . '<br>' . $conn->error");
	}
	
}


$conn->close();

?>

