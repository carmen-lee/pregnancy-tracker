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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
  <title>Patient Pregnancies</title>
</head>

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
              <a class="nav-link active" href="patientPregnancies.php">Pregnancies</a>
              <a class="nav-link" href="patientAppointments.php">Appointments</a>
              <a class="nav-link" href="patientMedications.php">Medications</a>
            </div>
            <?php echo $sessionFirstName . " " . $sessionLastName; ?>
            <button type="button" class="btn btn-light logout-btn" style="float: right;"><a href="../logout.php">Logout</a></button>
          </div>
        </div>
      </nav>
    </header>

    <?php
    // from here 
    $sessionUserID = $_SESSION['sessionUserId'];
    $sessionRole = $_SESSION['sessionRole'];
    //check that the user has the role PATIENT, else logout 
    if ($sessionRole !== "PATIENT") {
      header("Location: ../login.php? err=Please login");
    }
    // to here, we can delete? but it doesnt work

    //establish connection
    $conn = mysqli_connect("localhost", "root", "", "pregnancy");
    //check connection
    if (!$conn) {
      echo 'Connection failed' . mysqli_connect_error();
    }

    $sql = "SELECT * FROM pregnancies WHERE patientID = '$sessionUserID' AND status = 'CURRENT'";
    $result = mysqli_query($conn, $sql);
    $resultsArray = mysqli_fetch_all($result);

    if (sizeof($resultsArray) != 0) {

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
    } else {
      $weeks = -1;
      $mPercent = 0;
    }


    ?>

    <section>
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <?php
            if ($weeks == -1) {
              echo '<img src="../../imgs/negative.jpeg" class="d-block mh-50" alt="negative">
            <div class="carousel-caption d-none d-md-block">
              <h5 style = "color: black;">You are not pregnant!</h5>
            </div>';
            } else if ($weeks > 26) {
              echo '<img src="../../imgs/third-trimester.jpeg" class="d-block mh-50" alt="3rd trimester">
            <div class="carousel-caption d-none d-md-block">
              <h5>You are ', $weeks, ' weeks into pregnancy (3rd Trimester)!</h5>
              <p>Baby is almost here!</p>
              <div class="progress">
              <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: ', $mPercent, '%;">
              Time till estimated birth: ', $months, ' months ', $days, ' days 
              </div>
            </div>';
            } else if ($weeks > 12) {
              echo '<img src="../../imgs/second-trimester.jpeg" alt="2nd trimester" class="d-block w-100 center">
            <div class="carousel-caption d-none d-md-block">
              <h5>You are ', $weeks, ' weeks into pregnancy (2nd Trimester)!</h5>
              <p>Almost there!</p>
              <div class="progress">
              <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: ', $mPercent, '%;">
              Time till estimated birth: ', $months, ' months ', $days, ' days 
              </div>
            </div>';
            } else {
              echo '<img src="../../imgs/first-trimester.jpeg" alt="1st trimester" class="d-block w-100">
              <div class="carousel-caption d-none d-md-block">
                <h5>You are ', $weeks, ' weeks into pregnancy (1st Trimester)!</h5>
                <p>Congrats!</p>
                <div class="progress">
                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: ', $mPercent, '%;">
                Time till estimated birth: ', $months, ' months ', $days, ' days 
                </div>
              </div>';
            }
            ?>
          </div>
        </div>
      </div>
    </section>
    <section style="overflow-x: scroll">
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


    <section style="overflow-x: scroll">
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
    <section class="footer d-flex align-self-center">
      <p>
        Created for CS 441 by Carmen Lee, Cicelia Siu, Edward Sung
      </p>
      <img id="footer-img" src="../../imgs/sprout.jpg" alt="Sprout!">
    </section>
  </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="../js/patientInfo.js"></script> -->
</body>

</html>