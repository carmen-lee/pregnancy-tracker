
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CDN -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ea253243da.js" crossorigin="anonymous"></script>
    <title>Doctor Appointments</title>
  </head>
  <body>
    <div class="body">
      <header>
        <nav
          class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill"
        >
          <div class="container-fluid">
            <a class="navbar-brand mb-0 h1" href="doctorPortal.php">Doctor Portal</a>
            <button
              class="navbar-toggler custom-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNavAltMarkup"
              aria-controls="navbarNavAltMarkup"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
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

      <section>
        <h3>Requested Appointments</h3>
        <?php
        //establish connection
        $conn = mysqli_connect("localhost", "root", "", "pregnancy");
        //check connection
        if (!$conn) {
          echo 'Connection failed' . mysqli_connect_error();
        }
        //create query
        $sql_apt = "SELECT date,time,patientId,reason,status FROM appointments WHERE doctorId=$sessionUserId and status='REQUESTED'";
        $result_apt = mysqli_query($conn, $sql_apt);
        $resultsArray_apt = mysqli_fetch_all($result_apt);
        ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Patient First Name</th>
              <th scope="col">Patient Last Name</th>
              <th scope="col">Reason</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
        <?php

        for ($i = 0; $i < sizeof($resultsArray_apt); $i++){
          echo "<tr>";
          for ($j = 0; $j < 5; $j++) {
            if($j == 2) {
              $patientId = $resultsArray_apt[$i][2];
              $sql_patient = "SELECT first_name,last_name FROM Users WHERE id=$patientId";
              $result_patient = mysqli_query($conn, $sql_patient);
              $resultArray_patient = mysqli_fetch_all($result_patient);
              echo "<td>",$resultArray_patient[0][0],"</td>"; 
              echo "<td>",$resultArray_patient[0][1],"</td>"; 
              $j+=1;
            }
            echo "<td>",$resultsArray_apt[$i][$j],"</td>";
          }
          echo "</tr>";
        }
        echo "</tbody>", "</table>";

        ?>
      </section>

      <section>
        <h3>Schedule New Appointment</h3>
        <br>
        <form name="frmContact" method="post" action="doctorAddAppointment.php">
          <p>
            <label for="date">Date</label>
            <input type="date" name="date" id="date" required>

            <label for="time">Time:</label>
            <input type="time" id="time" name="time">
          </p>
          <p>
            <!-- ERROR CANNOT ADD TO DB, NOT GRABBING PATIENT ID -->
            <label for="patient">Patient</label>
            <select name="patient" id="patient" form="patient" required>
              <?php
              //create query
              $sql = "SELECT id,first_name,last_name FROM users WHERE role='PATIENT'";
              $result = mysqli_query($conn, $sql);
              $resultsArray = mysqli_fetch_all($result);
              //dynamically create options
              for ($i = 0; $i < sizeof($resultsArray); $i++){
                $fullName = $resultsArray[$i][1] . ' ' . $resultsArray[$i][2];
                echo "<option value='{$resultsArray[$i][0]}'>{$fullName}</option>";
              }
              ?>
            </select>
          </p>
          <p>
            <label for="Reason">Reason</label> <br>
            <textarea type="text" name="inputReason" id="inputReason"></textarea>
          </p>
          <p>
            <?php
            if(isset($_GET['err'])){
              echo '<p style="color: red;">',$_GET['err'],'</p>';
            }
            if(isset($_GET['succ'])){
              echo '<p style="color: green;">',$_GET['succ'],'</p>';
            }
            ?>
          </p>
          <p>
            <input type="submit" name="Submit" id="Submit" value="Schedule new appointment">
          </p>
        </form>

      </section>

      <section>
        <h3>Upcoming Appointments</h3>
        <?php
        //create query
        $sql_apt = "SELECT date,time,patientId,reason,status FROM appointments WHERE doctorId=$sessionUserId and status='SCHEDULED'";
        $result_apt = mysqli_query($conn, $sql_apt);
        $resultsArray_apt = mysqli_fetch_all($result_apt);
        ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Patient First Name</th>
              <th scope="col">Patient Last Name</th>
              <th scope="col">Reason</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
        <?php

        for ($i = 0; $i < sizeof($resultsArray_apt); $i++){
          echo "<tr>";
          for ($j = 0; $j < 5; $j++) {
            if($j == 2) {
              $patientId = $resultsArray_apt[$i][2];
              $sql_patient = "SELECT first_name,last_name FROM Users WHERE id=$patientId";
              $result_patient = mysqli_query($conn, $sql_patient);
              $resultArray_patient = mysqli_fetch_all($result_patient);
              echo "<td>",$resultArray_patient[0][0],"</td>"; 
              echo "<td>",$resultArray_patient[0][1],"</td>"; 
              $j+=1;
            }
            echo "<td>",$resultsArray_apt[$i][$j],"</td>";
          }
          echo "</tr>";
        }
        echo "</tbody>", "</table>";
        ?>
        
        
      </section>

      <section>
        <h3>Previous Appointments</h3>
        <?php
        //create query
        $sql_apt = "SELECT date,time,patientId,reason,status FROM appointments WHERE doctorId=$sessionUserId and status='COMPLETED' or status='CANCELLED'";
        $result_apt = mysqli_query($conn, $sql_apt);
        $resultsArray_apt = mysqli_fetch_all($result_apt);
        ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Patient First Name</th>
              <th scope="col">Patient Last Name</th>
              <th scope="col">Reason</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
        <?php

        for ($i = 0; $i < sizeof($resultsArray_apt); $i++){
          echo "<tr>";
          for ($j = 0; $j < 5; $j++) {
            if($j == 2) {
              $patientId = $resultsArray_apt[$i][2];
              $sql_patient = "SELECT first_name,last_name FROM Users WHERE id=$patientId";
              $result_patient = mysqli_query($conn, $sql_patient);
              $resultArray_patient = mysqli_fetch_all($result_patient);
              echo "<td>",$resultArray_patient[0][0],"</td>"; 
              echo "<td>",$resultArray_patient[0][1],"</td>"; 
              $j+=1;
            }
            echo "<td>",$resultsArray_apt[$i][$j],"</td>";
          }
          echo "</tr>";
        }
        echo "</tbody>", "</table>";
        ?>
        
      </section>
      
      <?php
      $conn->close();
      ?>
    </div>

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="../js/patientInfo.js"></script>
  </body>
</html>
