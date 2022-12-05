
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
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
    <title>Patient Appointments</title>
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
                <a class="nav-link" href="patientPregnancies.php">Pregnancies</a>
                <a class="nav-link active" href="patientAppointments.php">Appointments</a>
                <a class="nav-link" href="patientMedications.php">Medications</a>
              </div>
              <?php echo $sessionFirstName . " " . $sessionLastName; ?>
              <button type="button" class="btn btn-light" style="float: right;"><a href="../logout.php">Logout</a></button>
            </div>
          </div>
        </nav>
      </header>

      <section>
        <h3>Request New Appointment</h3>
        <br>
        <?php
        if(isset($_GET['cancelErr'])){
          echo '<p style="color: red;">',$_GET['cancelErr'],'</p>';
        }
        if(isset($_GET['cancelSucc'])){
          echo '<p style="color: green;">',$_GET['cancelSucc'],'</p>';
        }
        ?>
        <form name="frmContact" method="post" action="../AddAppointment.php">
          <p>
          <label for="date">Date</label>
            <input type="date" name="inputDate" id="inputDate" required>

            <label for="time">Time:</label>
            <input type="time" id="inputTime" name="inputTime">
          </p>
          <p>
            <label for="doctor">Doctor</label>
            <select name="inputDoctor" required>
              <?php
              //establish connection
              $conn = mysqli_connect("localhost", "root", "", "pregnancy");
              //check connection
              if (!$conn) {
                echo 'Connection failed' . mysqli_connect_error();
              }
              //create query
              $sql = "SELECT id,first_name,last_name FROM users WHERE role='DOCTOR'";
              $result = mysqli_query($conn, $sql);
              $resultsArray = mysqli_fetch_all($result);
              //dynamically create options
              for ($i = 0; $i < sizeof($resultsArray); $i++){
                $doctorId = $resultsArray[$i][0];
                $fullName = $resultsArray[$i][1] . ' ' . $resultsArray[$i][2];
                echo '<option value="',$doctorId, '">', $fullName, '</option>';
                
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
        <br>
        <?php
        //create query
        $sql_apt = "SELECT apptDate,apptTime,doctorId,reason,status FROM appointments WHERE patientId=$sessionUserId and status='SCHEDULED'";
        $result_apt = mysqli_query($conn, $sql_apt);
        $resultsArray_apt = mysqli_fetch_all($result_apt);
        ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Doctor First Name</th>
              <th scope="col">Doctor Last Name</th>
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
              $doctorId = $resultsArray_apt[$i][2];
              $sql = "SELECT first_name,last_name FROM Users WHERE id=$doctorId";
              $result = mysqli_query($conn, $sql);
              $resultArray = mysqli_fetch_all($result);
              echo "<td>",$resultArray[0][0],"</td>"; 
              echo "<td>",$resultArray[0][1],"</td>"; 
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
        <br>
        <?php
        //create query
        $sql_apt = "SELECT apptDate,apptTime,doctorId,reason,status FROM appointments WHERE patientId=$sessionUserId and (status='COMPLETED' or status='CANCELLED')";
        $result_apt = mysqli_query($conn, $sql_apt);
        $resultsArray_apt = mysqli_fetch_all($result_apt);
        ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Doctor First Name</th>
              <th scope="col">Doctor Last Name</th>
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
              $doctorId = $resultsArray_apt[$i][2];
              $sql = "SELECT first_name,last_name FROM Users WHERE id=$doctorId";
              $result = mysqli_query($conn, $sql);
              $resultArray = mysqli_fetch_all($result);
              echo "<td>",$resultArray[0][0],"</td>"; 
              echo "<td>",$resultArray[0][1],"</td>"; 
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
      <section class="footer d-flex align-self-center">
        <p>
          Created for CS 441 by Carmen Lee, Cecilia Siu, Edward Sung
        </p>
        <img id="footer-img" src="../../imgs/sprout.jpg" alt="Sprout!">
      </section>

    </div>

      <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="../js/patientInfo.js"></script> -->
  </body>
</html>
