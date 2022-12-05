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
  <title>Patient Medications</title>
</head>

<body>

  <?php
  session_start();
  // $sessionUserName = $_SESSION['sessionUsername'];
  $sessionUserID = $_SESSION['sessionUserId'];
  $sessionRole = $_SESSION['sessionRole'];
  $sessionFirstName = $_SESSION['sessionFirstName'];
  $sessionLastName = $_SESSION['sessionLastName'];
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

  //create query
  $sql = "SELECT * FROM medication WHERE patientID = $sessionUserID";
  $result1 = mysqli_query($conn, $sql);
  $user = mysqli_fetch_all($result1, MYSQLI_ASSOC);
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

    <section>
      <h3>Prescribed Medications</h3>
      <br>
      <table class="table table-hover table-stripped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Dosage</th>
            <th>Frequency</th>
            <th>With or Without Food</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($user as $row) {
            echo "<tr>";
            echo "<td>", $row['medName'], "</td>";
            echo "<td>", $row['medDosage'], "</td>";
            echo "<td>", $row['medFrequency'], "</td>";
            echo "<td>", $row['medFood'], "</td>";
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