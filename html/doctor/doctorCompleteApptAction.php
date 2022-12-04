<?php
$conn = mysqli_connect("localhost", "root", "", "pregnancy");
$appointmentId = $_GET['appointmentId'];
$sql = "UPDATE `appointments` SET `status`='COMPLETED' WHERE `id`='$appointmentId'";

if ($conn->query($sql) === TRUE) {
    header("Location: doctorAppointments.php? cancelSucc= Appointment completed");
} else {
    header("Location: doctorAppointments.php? cancelErr= 'Error: ' . $sql . '<br>' . $conn->error");
}
$conn->close();
?>