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
            <button type="button" class="btn btn-light" style="float: right;"><a href="../logout.php">Logout</a></button>
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
    //establish connection
    $conn = mysqli_connect("localhost", "root", "", "pregnancy");
    //check connection
    if (!$conn) {
      echo 'Connection failed' . mysqli_connect_error();
    }

    $sql = "SELECT * FROM pregnancies WHERE patientID = '$sessionUserID' AND status = 'CURRENT'";
    $result = mysqli_query($conn, $sql);
    $resultsArray = mysqli_fetch_all($result);

    date_default_timezone_set('America/Los_Angeles');
    $today = Date("Y-m-d");
    $diff = strtotime($resultsArray[0][4]) - strtotime($today);

    // Calculate Dates
    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $monthNoFloor = ($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24);
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

    // Calculate Trimester
    $weeks = 36 - floor($diff / (7 * 60 * 60 * 24));


    // Calculate Percent
    $totalMonth = 9;
    $totalDays = 0;
    $mPercent = ($monthNoFloor / $totalMonth) * 100;

    ?>

    <section>
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <?php
            if ($weeks > 26) {
              echo '<img src="../../imgs/third-trimester.jpeg" class="d-block mh-50" alt="3rd trimester">
            <div class="carousel-caption d-none d-md-block">
              <h5>You are ', $weeks, ' weeks into pregnancy (3rd Trimester)!</h5>
              <p>Baby is almost here!</p>
              <div class="progress">
              <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: ', $mPercent, '%;">
              Time till estimated birth: ', $months, ' months ', $days, ' days 
              </div>
            </div>';
            } else if ($weeks > 12) {
              echo '<img src="../../imgs/second-trimester.jpeg" alt="2nd trimester" class="d-block w-100 center">
            <div class="carousel-caption d-none d-md-block">
              <h5>You are ', $weeks, ' weeks into pregnancy (2nd Trimester)!</h5>
              <p>Almost there!</p>
              <div class="progress bg-info">
              <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: ', $mPercent, '%;">
              Time till estimated birth: ', $months, ' months ', $days, ' days 
              </div>
            </div>';
            } else {
              echo '<img src="../../imgs/first-trimester.jpeg" alt="1st trimester" class="d-block w-100">
              <div class="carousel-caption d-none d-md-block">
                <h5>You are ', $weeks, ' weeks into pregnancy (1st Trimester)!</h5>
                <p>Congrats!</p>
                <div class="progress">
                <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: ', $mPercent, '%;">
                Time till estimated birth: ', $months, ' months ', $days, ' days 
                </div>
              </div>';
            }
            ?>
          </div>
        </div>
      </div>
    </section>
    <section>
      <h3>Current Pregnancy</h3>
      <table class="table table-hover table-stripped">
        <thead>
          <tr>
            <th>Due date</th>
            <th>Baby's Name</th>
            <th>Baby's Health</th>
            <th>Mom's Health</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < sizeof($resultsArray); $i++) {
            echo "<tr>";
            echo "<td>", $resultsArray[$i][4], "</td>";
            echo "<td>", $resultsArray[$i][7], "</td>";
            echo "<td>", $resultsArray[$i][3], "</td>";
            echo "<td>", $resultsArray[$i][2], "</td>";
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
            <th>Baby's Health</th>
            <th>Mom's Health</th>
          </tr>
        </thead>
        <form method="post" action="patientPregnanciesAction.php"></form>
        <tbody>
          <?php
          for ($i = 0; $i < sizeof($resultsArray); $i++) {
            echo "<tr>";
            echo "<td>", $resultsArray[$i][4], "</td>";
            echo "<td>", $resultsArray[$i][7], "</td>";
            echo "<td>", $resultsArray[$i][3], "</td>";
            echo "<td>", $resultsArray[$i][2], "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </section>
  </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="../js/patientInfo.js"></script> -->
</body>

</html>