<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ea253243da.js" crossorigin="anonymous"></script>
    <title>Password Change</title>
</head>

<body>

</body>
<section>
    <h1>Change Password</h1>
    <form name="frmContact" method="post" action="patientPasswordAction.php">
        <label for="oldPass">Old Password </label>
        <input type="password" name="oldPass" id="oldPass" required> <br />
        <label for="newPass">New Password </label>
        <input type="password" name="newPass" id="newPass" required> <br />
        <label for="checkPass">Old Password </label>
        <input type="password" name="checkPass" id="checkPass" required> <br />
        <?php
        if (isset($_GET['err'])) {
            echo '<p style="color: red;">', $_GET['err'], '</p>';
        }
        if (isset($_GET['succ'])) {
            echo '<p style="color: green;">', $_GET['succ'], '</p>';
        }
        ?>
        <input type="submit" name="Submit" id="Submit" value="Submit">
    </form>
</section>

</html>