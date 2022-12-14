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
  <title>Doctor Portal</title>
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
  if ($sessionRole !== "DOCTOR") {
    header("Location: ../login.php? err=Please login");
  }
  ?>

  <div class="body">
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill">
        <div class="container-fluid">
          <a class="navbar-brand mb-0 h1" href="doctorPortal.php">Doctor Portal</a>
          <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
              <!-- <a class="nav-link" href="doctorPortal.php">Home</a> -->
              <a class="nav-link" href="doctorAppointments.php">Appointments</a>
              <a class="nav-link active" href="doctorMedications.php">Medications</a>
            </div>
            <?php echo "<div>Dr. ", $sessionFirstName, " ", $sessionLastName, "</div>" ?>
            <button type="button" class="btn btn-light logout-btn" style="float: right;"><a href="../logout.php">Logout</a></button>
          </div>
        </div>
      </nav>
    </header>
    <?php
    //establish connection
    $conn = mysqli_connect("localhost", "root", "", "pregnancy");
    //check connection
    if (!$conn) {
      echo 'Connection failed' . mysqli_connect_error();
    }
    ?>

    <section style="overflow-x: scroll">
      <h3>Prescribed Medications</h3>
      <!-- <form name="frmContact" method="post" action="doctorMedicationAction.php"> -->
      <form name="frmContact" method="post">
        <p>
          <label for="patient">Patient</label>
          <select name="inputPatient" onchange="this.form.submit()" required>
            <option value="">Select Patient</option>
            <!-- <option>Select Patient</option> -->
            <?php
            $patientName = $_POST['inputPatient'];
            //create query
            $sql = "SELECT id,first_name,last_name FROM users WHERE role='PATIENT'";
            $result = mysqli_query($conn, $sql);
            $resultsArray = mysqli_fetch_all($result);

            //dynamically create options
            for ($i = 0; $i < sizeof($resultsArray); $i++) {
              $patientId = $resultsArray[$i][0];
              $fullName = $resultsArray[$i][1] . ' ' . $resultsArray[$i][2];

              // Figure out how to keep the full name selected onchange
              if ((isset($patientName)) && ($patientName == $patientId)) {
                echo '<option value="', $patientId, '" selected>', $fullName, '</option>';
              } else {
                echo '<option value="', $patientId, '">', $fullName, '</option>';
              }
            }
            ?>
          </select>
        </p>
      </form>
      <?php
      $patientId = $_POST['inputPatient'];
      // //create query
      $sql = "SELECT * FROM medication WHERE patientID = $patientId";
      // $sql = "SELECT * FROM medication";
      $result1 = mysqli_query($conn, $sql);
      $user = mysqli_fetch_all($result1, MYSQLI_ASSOC);

      ?>
      <table class="table table-hover table-stripped">
        <thead>
          <tr>
            <th style="text-align: center;">Manage</th>
            <!-- <th>Patient</th> -->
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
            echo "<td style='text-align: center;'><a href='doctorMedicationDelete.php? increment=" . $row['increment'] . "'> <i class='fa-solid fa-trash-can'></i></a></td>";
            // echo "<td>", $row['patientID'], "</td>";
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

    <section>
      <h3>Prescribe Medication</h3>
      <br>
      <form name="frmContact" method="post" action="doctorMedicationAction.php">
        <p>
          <label for="patient">Patient</label>
          <select name="inputPatient" required>
            <option value="">Select Patient</option>
            <?php
            //create query
            $sql = "SELECT id,first_name,last_name FROM users WHERE role='PATIENT'";
            $result = mysqli_query($conn, $sql);
            $resultsArray = mysqli_fetch_all($result);
            //dynamically create options
            for ($i = 0; $i < sizeof($resultsArray); $i++) {
              $patientId = $resultsArray[$i][0];
              $fullName = $resultsArray[$i][1] . ' ' . $resultsArray[$i][2];
              // echo "<option value={$patientId}>{$patientId}</option>";
              echo '<option value="', $patientId, '">', $fullName, '</option>';
            }
            ?>
          </select>
        </p>
        <div style="display: flex; flex-direction:column;">
          <div>
            <p>
              <label for="MedicationName">Medication Name</label>
              <input type="text" name="inputMedicationName" id="inputMedicationName" required>
            </p>
            <p>
              <label for="MedicationDosage">Dosage</label>
              <input type="text" name="inputMedicationDosage" id="inputMedicationDosage" required>
            </p>
            <p>
              <label for="MedicationFrequency">Frequency</label>
              <input type="text" name="inputMedicationFrequency" id="inputMedicationFrequency" required>
            </p>

            <p>
              <label for="MedicationFood">With or Without Food</label>
              <select name="inputFood" required>
                <option value="With Food">With Food</option>
                <option value="Without Food">Without Food</option>
              </select>
            </p>
          </div>

          <div>
            <input type="submit" name="Submit" id="Submit" value="Add Medicine">
          </div>
        </div>

      </form>
    </section>

    <section class="footer d-flex align-self-center">
      <p>
        Created for CS 441 by Carmen Lee, Cicelia Siu, Edward Sung
      </p>
      <img id="footer-img" src="../../imgs/sprout.jpg" alt="Sprout!">
    </section>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="../js/patientInfo.js"></script>
</body>

</html>