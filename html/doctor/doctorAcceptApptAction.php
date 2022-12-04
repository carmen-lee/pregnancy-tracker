<?php
$conn = mysqli_connect("localhost", "root", "", "pregnancy");
$appointmentId = $_GET['appointmentId'];
$sql = "UPDATE `appointments` SET `status`='SCHEDULED' WHERE `id`='$appointmentId'";

if ($conn->query($sql) === TRUE) {
    header("Location: doctorAppointments.php? requestSucc= Appointment cancelled");
} else {
    header("Location: doctorAppointments.php? requestErr= 'Error: ' . $sql . '<br>' . $conn->error");
}
$conn->close();
?>