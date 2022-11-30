<?php
$date = $_POST['date'];
$time = $_POST['time'];
$patientId = $_POST['patient'];
$doctorId = $_SESSION['sessionUserId'];
$reason = $_POST['inputReason'];

header("Location: doctorAppointments.php? succ= $date,$time,$patientId,$doctorId,$reason");

$conn = mysqli_connect("localhost", "root", "", "pregnancy");
// $sql = "INSERT INTO `appointments`(`id`,`date`, `time`, `status`, `patientId`, `doctorId`, `reason`) VALUES ('0','$date','$appt','SCHEDULED','$patientId','$reason')";
$sql = "INSERT INTO appointments(id,date,time,status,patientId,doctorId,reason) VALUES (DEFAULT,'$date','$time','SCHEDULED','$patientId','$doctorId','$reason')";
if ($conn->query($sql) === TRUE) {
    header("Location: doctorAppointments.php? succ= Appointment has been scheduled");
  } else {
	header("Location: doctorAppointments.php? err= 'Error: ' . $sql . '<br>' . $conn->error");
  }

$conn->close();
?>