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
  <title>Doctor Medication</title>
</head>

<body>
  <div class="body">
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill">
        <div class="container-fluid">
          <a class="navbar-brand mb-0 h1" href="doctorPortal.php">Doctor Portal</a>
          <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" href="doctorPortal.php">Home</a>
              <a class="nav-link" href="doctorAppointments.php">Appointments</a>
              <a class="nav-link" href="doctorMedications.php">Medications</a>
            </div>
            <!-- <button type="button" class="btn btn-light" id="logoutBtn">
                Logout
              </button> -->
            <a href="../logout.php">Logout</a>
          </div>
        </div>
      </nav>
    </header>
    <?php
    session_start();
    $sessionUserName = $_SESSION['sessionUsername'];
    $sessionRole = $_SESSION['sessionRole'];
    //check that the user has the role doctor, else logout 
    if ($sessionRole !== "DOCTOR") {
      header("Location: ../login.php? err=Please login");
    }
    //establish connection
    $conn = mysqli_connect("localhost", "root", "", "pregnancy");
    //check connection
    if (!$conn) {
      echo 'Connection failed' . mysqli_connect_error();
    }
    ?>

    <section>
      Search for Patient and show prescribed medications table below
    </section>

    <section>
      <h3>Prescribed Medications</h3>
      <?php
      // //create query
      // $sql = "SELECT * FROM medication WHERE patientID = $sessionUserID";
      $sql = "SELECT * FROM medication";
      $result1 = mysqli_query($conn, $sql);
      $user = mysqli_fetch_all($result1, MYSQLI_ASSOC);

      ?>
      <table class="table table-hover table-stripped">
        <thead>
          <tr>
            <th style="text-align: center;">Manage</th>
            <th>Patient</th>
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
            echo '<td style="text-align: center;"><i class="fa-solid fa-trash-can"></i></td>';
            echo "<td>", $row['patientID'], "</td>";
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
          <label for="MedicationFood">With or Without Food</label> <br>
          <select name="inputFood" id="inputFood" form="Food" required>
            <option value="With Food">With Food</option>
            <option value="Without Food">Without Food</option>
        </p>

        <p>
          <input type="submit" name="Submit" id="Submit" value="Add Medicine">
        </p>
      </form>
    </section>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <script src="../js/patientInfo.js"></script>
</body>

</html>