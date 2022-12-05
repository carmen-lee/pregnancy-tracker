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
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <title>Patient Portal</title>
</head>
<style>
    input[type='text']::placeholder {
        text-align: right;
    }
</style>

<body>
    <?php 
    session_start();
    //get session variables
    $sessionUserId = $_SESSION['sessionUserId'];
    $sessionFirstName = $_SESSION['sessionFirstName'];
    $sessionLastName = $_SESSION['sessionLastName'];
    $sessionRole = $_SESSION['sessionRole'];

    //check that the user has the role doctor, else logout 
    if ($sessionRole !== "PATIENT") {
      header("Location: ../login.php? err=Please login");
    }
    ?>

    <div class="body">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1" href="patientPortal.php">Patient Portal</a>
                <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href="patientPregnancies.php">Pregnancies</a>
                    <a class="nav-link" href="patientAppointments.php">Appointments</a>
                    <a class="nav-link" href="patientMedications.php">Medications</a>
                </div>
                <?php echo $sessionFirstName . " " . $sessionLastName; ?>
                <button type="button" class="btn btn-light" style="float: right;"><a href="../logout.php">Logout</a></button>
                </div>
            </div>
            </nav>
        </header>
        <?php
        if (isset($_GET['err'])) {

            echo '<section><p style="color: red;">', $_GET['err'], '</p></section>';
        }
        if (isset($_GET['succ'])) {
            echo '<section><p style="color: green;">', $_GET['succ'], '</p></section>';
        }
        ?>
        <section>
            <div class="container" style="display: block;">
                <h2 style="margin: 0px;">
                    <?php
                    //establish connection
                    $conn = mysqli_connect("localhost", "root", "", "pregnancy");
                    //check connection
                    if (!$conn) {
                        echo 'Connection failed' . mysqli_connect_error();
                    }

                    //create query
                    $sql = "SELECT * FROM Users WHERE id = $sessionUserId";
                    $result1 = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_all($result1, MYSQLI_ASSOC);

                    foreach ($user as $user1) {
                        $first = $user1['first_name'];
                        $last = $user1['last_name'];
                        $username = $user1['username'];
                        $birthdate = $user1['birthdate'];
                        $email = $user1['email'];
                        $phone = $user1['phone'];
                        $addy = $user1['Address'];
                        $EC_name = $user1['emerCon_name'];
                        $EC_phone = $user1['emerCon_phone'];
                        $EC_relation = $user1['emerCon_relation'];
                    }

                    echo "Welcome " . $first . " " . $last;

                    ?>
                </h2>

            </div>
        </section>
        <form method="post" action="patientEditMyInfoAction.php">
            <section>
                <h3>My Information</h3>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-cake-candles"></i>&nbsp Date of Birth</th>
                            <td align="right">
                                <?php
                                echo '<input type="text" name="bday" id="bday" placeholder="', $birthdate, '"> <br />';
                                ?>
                            </td>

                        </tr>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-envelope"></i>&nbsp Email</th>
                            <td align="right">
                                <?php
                                echo '<input type="text" name="email" id="email" placeholder="', $email, '"> <br />';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-phone"></i>&nbsp Phone Number</th>
                            <td align="right">
                                <?php
                                echo '<input type="text" name="phone" id="phone" placeholder="', $phone, '"> <br />';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-house-user"></i>&nbsp Address</th>
                            <td align="right">
                                <?php
                                echo '<input type="text" name="addy" id="addy" placeholder="', $addy, '"> <br />';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-at"></i>&nbsp Handle</th>
                            <td align="right">
                                <?php
                                echo '<input type="text" name="user" id="user" placeholder="', $username, '"> <br />';
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </section>

            <section>
                <h3>Emergency Contact Information</h3>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-address-book"></i>&nbsp Full Name</th>
                            <td align="right">
                                <?php
                                echo '<input type="text" name="ECname" id="ECname" placeholder="', $EC_name, '"> <br />';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-user-group"></i>&nbsp Relationship</th>
                            <td align="right">
                                <?php
                                echo '<input type="text" name="ECrelation" id="ECrelation" placeholder="', $EC_relation, '"> <br />';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa-solid fa-phone"></i>&nbsp Phone Number</th>
                            <td align="right">
                                <?php
                                echo '<input type="text" name="ECphone" id="ECphone" placeholder="', $EC_phone, '"> <br />';
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <div style="text-align: right; margin:30px">
                <input type="submit" name="Submit" id="Submit" value="Submit">
            </div>
        </form>
    </div>


      <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="../js/patientInfo.js"></script> -->
</body>

</html>