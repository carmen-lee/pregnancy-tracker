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
  <title>Patient Pregnancies</title>
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
    $sessionUserID = $_SESSION['sessionUserId'];
    $sessionRole = $_SESSION['sessionRole'];
    //check that the user has the role PATIENT, else logout 
    if ($sessionRole !== "PATIENT") {
      header("Location: ../login.php? err=Please login");
    }
    ?>


    <section>
      <h3>Current pregnancy</h3>
      <?php
      //establish connection
      $conn = mysqli_connect("localhost", "root", "", "pregnancy");
      //check connection
      if (!$conn) {
        echo 'Connection failed' . mysqli_connect_error();
      }

      $sql = "SELECT * FROM pregnancies WHERE patientID = '$sessionUserID' AND status = 'CURRENT'";
      $result = mysqli_query($conn, $sql);
      $resultsArray = mysqli_fetch_all($result);

      ?>

      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%;">Days Left : ???</div>
      </div>
      <table class="table table-hover table-stripped">
        <thead>
          <tr>
            <th>Due date</th>
            <th>Baby's Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < sizeof($resultsArray); $i++) {
            echo "<tr>";
            echo "<td>", $resultsArray[$i][4], "</td>";
            echo "<td>", $resultsArray[$i][7], "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>

    </section>

    <section>
      <h3>Past Pregnancies</h3>
      <?php
      //establish connection
      $conn = mysqli_connect("localhost", "root", "", "pregnancy");
      //check connection
      if (!$conn) {
        echo 'Connection failed' . mysqli_connect_error();
      }

      $sql = "SELECT * FROM pregnancies WHERE patientID = '$sessionUserID' AND status = 'PAST'";
      $result = mysqli_query($conn, $sql);
      $resultsArray = mysqli_fetch_all($result);


      ?>
      <table class="table table-hover table-stripped">
        <thead>
          <tr>
            <th>Due date</th>
            <th>Baby's Name</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < sizeof($resultsArray); $i++) {
            echo "<tr>";
            echo "<td>", $resultsArray[$i][4], "</td>";
            echo "<td>", $resultsArray[$i][7], "</td>";
            echo "</tr>";
          }
          ?>
    </section>
  </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="../js/patientInfo.js"></script> -->
</body>

</html>