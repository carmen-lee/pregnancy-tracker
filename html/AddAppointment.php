<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'pregnancy');

$inputDate = $_POST['inputDate'];
$inputTime = $_POST['inputTime'];
if(isset($_POST['inputPatient'])) {
	$patientId = $_POST['inputPatient'];
}
$doctorId = $_SESSION['sessionUserId'];
$reason = $_POST['inputReason'];
$userType = $_SESSION['sessionRole'];

if ($userType == 'DOCTOR') {
	$sql = "INSERT INTO appointments(apptDate,apptTime,status,patientId,doctorId,reason) VALUES ('$inputDate', '$inputTime','SCHEDULED','$patientId', '$doctorId', '$reason');";
	if ($conn->query($sql)) {
		header("Location: doctorAppointments.php? succ= Success ");
	} else {
		header("Location: doctorAppointments.php? err= 'Error: ' . $sql . '<br>' . $conn->error");
	}
	
} else {
	$sql = "INSERT INTO appointments(apptDate,apptTime,status,patientId,doctorId,reason) VALUES ('$inputDate', '$inputTime','REQUESTED','$patientId', '$doctorId', '$reason');";
	if ($conn->query($sql)) {
		// header("Location: doctorAppointments.php? succ= Success ");
		echo "success";
	} else {
		// header("Location: doctorAppointments.php? err= 'Error: ' . $sql . '<br>' . $conn->error");
		echo $conn->error;
	}
	
}


$conn->close();

?>

