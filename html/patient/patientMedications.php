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
  <title>Patient Medications</title>
</head>

<body>
  <div class="body">
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill">
        <div class="container-fluid">
          <a class="navbar-brand mb-0 h1" href="patientPortal.php">Patient Portal</a>
          <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" href="patientPortal.php">My Information</a>
              <a class="nav-link" href="patientPregnancies.php">Pregnancies</a>
              <a class="nav-link" href="patientAppointments.php">Appointments</a>
              <a class="nav-link" href="patientMedications.php">Medications</a>
            </div>
            <a href="../logout.php">Logout</a>
          </div>
        </div>
      </nav>
    </header>

    <?php
    session_start();
    $sessionUserName = $_SESSION['sessionUsername'];
    $sessionRole = $_SESSION['sessionRole'];
    //check that the user has the role PATIENT, else logout 
    if ($sessionRole !== "PATIENT") {
      header("Location: ../login.php? err=Please login");
    }

    // //establish connection
    // $conn = mysqli_connect("localhost", "root", "", "pregnancy");
    // //check connection
    // if (!$conn) {
    //   echo 'Connection failed' . mysqli_connect_error();
    // }

    // //create query
    // $sql = "SELECT * FROM Users WHERE id = $sessionUserId";
    // $result1 = mysqli_query($conn, $sql);
    // $user = mysqli_fetch_all($result1, MYSQLI_ASSOC);

    // foreach ($user as $user1) {
    //   $first = $user1['first_name'];
    //   $last = $user1['last_name'];
    //   $username = $user1['username'];
    //   $birthdate = $user1['birthdate'];
    //   $email = $user1['email'];
    //   $phone = $user1['phone'];
    //   $addy = $user1['Address'];
    //   $EC_name = $user1['emerCon_name'];
    //   $EC_phone = $user1['emerCon_phone'];
    //   $EC_relation = $user1['emerCon_relation'];
    // }
    ?>


    <section>
      something here
    </section>

    <section>
      <h3>Prescribed Medications</h3>

    </section>
  </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="../js/patientInfo.js"></script> -->
</body>

</html>