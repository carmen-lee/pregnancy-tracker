<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "pregnancy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$patientId = $_SESSION['sessionUserId'];
$oldPass = $_POST['oldPass'];
$newPass = $_POST['newPass'];
$checkPass = $_POST['checkPass'];

$number = preg_match('@[0-9]@', $newPass);
$uppercase = preg_match('@[A-Z]@', $newPass);
$lowercase = preg_match('@[a-z]@', $newPass);
$specialChars = preg_match('@[^\w]@', $newPass);


$sql = "SELECT userpassword FROM Users WHERE id='$patientId'";
$results = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($results);
$currentPass = $row['userpassword'];

// check if old password matches from database
if ($currentPass != $oldPass) {
    header("Location: patientPortal.php? passwordErr= Incorrect password.");
} else if (strlen($newPass) < 8) {
    header("Location: patientPortal.php? passwordErr= Password must be at least 8 characters in length.");
} else if (!$lowercase) {
    header("Location: patientPortal.php? passwordErr= Password must contain at least one lower case letter.");
} else if (!$uppercase) {
    header("Location: patientPortal.php? passwordErr= Password must contain at least one upper case letter.");
} else if (!$number) {
    header("Location: patientPortal.php? passwordErr= Password must contain at least one number.");
} else if (!$specialChars) {
    header("Location: patientPortal.php? passwordErr= Password must contain at least one special character.");
} else if ($newPass != $checkPass) {
    header("Location: patientPortal.php? passwordErr= New passwords must match.");
} else {
    $sql = "UPDATE Users SET userpassword = '$newPass' WHERE id='$patientId'";
    if ($conn->query($sql) === TRUE) {
        header("Location: patientPortal.php? passwordSucc= Updated Password. ");
    } else {
        header("Location: patientPortal.php? passwordErr= Something went wrong. ");
    }
}
