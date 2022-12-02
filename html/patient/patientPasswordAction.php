<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "pregnancy");

$oldPass = $_POST['oldPass'];
$newPass = $_POST['newPass'];
$checkPass = $_POST['checkPass'];


$number = preg_match('@[0-9]@', $newPass);
$uppercase = preg_match('@[A-Z]@', $newPass);
$lowercase = preg_match('@[a-z]@', $newPass);
$specialChars = preg_match('@[^\w]@', $newPass);

// check if old password matches from database
if (strlen($newPass) < 8) {
    header("Location: patientPassword.php? err= Password must be at least 8 characters in length.");
} else if (!$lowercase) {
    header("Location: patientPassword.php? err= Password must contain at least one lower case letter.");
} else if (!$uppercase) {
    header("Location: patientPassword.php? err= Password must contain at least one upper case letter.");
} else if (!$number) {
    header("Location: patientPassword.php? err= Password must contain at least one number.");
} else if (!$specialChars) {
    header("Location: patientPassword.php? err= Password must contain at least one special character.");
} else if ($newPass != $checkPass) {
    header("Location: patientPassword.php? err= New passwords must match.");
} else {
    //update database
    header("Location: patientPortal.php? succ= Updated Password. ");
}
?>