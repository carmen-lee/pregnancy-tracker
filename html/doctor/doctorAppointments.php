
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
                <a class="nav-link active" href="doctorAppointments.php">Appointments</a>
                <a class="nav-link" href="doctorMedications.php">Medications</a>
              </div>
              <?php echo "<div>Dr. ",$sessionFirstName, " ",$sessionLastName,"</div>" ?>
              <button type="button" class="btn btn-light logout-btn" style="float: right;"><a href="../logout.php">Logout</a></button>
            </div>
          </div>
        </nav>
      </header>
      
      <section>
        <h3>Requested Appointments</h3>
        <br>
        <?php
        if(isset($_GET['requestErr'])){
          echo '<p style="color: red;">',$_GET['requestErr'],'</p>';
        }
        if(isset($_GET['requestSucc'])){
          echo '<p style="color: green;">',$_GET['requestSucc'],'</p>';
        }
        ?>
        <table class="table table-hover">
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Patient First Name</th>
            <th scope="col">Patient Last Name</th>
            <th scope="col">Reason</th>
            <th scope="col">Status</th>
          </tr>
          <?php
          //establish connection
          $conn = mysqli_connect("localhost", "root", "", "pregnancy");
          //check connection
          if (!$conn) {
            echo 'Connection failed' . mysqli_connect_error();
          }
          //create query
          $sql_apt = "SELECT id,apptDate,apptTime,patientId,reason,status FROM appointments WHERE doctorId=$sessionUserId and status='REQUESTED'";
          $result = $conn->query($sql_apt);
          while($row = $result->fetch_assoc()) { 
            echo "
              <tr>
                <td>".$row['apptDate']."</td>
                <td>".$row['apptTime']."</td>
            ";
            $sql_patient = "SELECT first_name,last_name FROM Users WHERE id=".$row['patientId']."";
            $result_patient = $conn->query($sql_patient);
            while($row_patient = $result_patient->fetch_assoc()) { 
              echo "
                <td>".$row_patient['first_name']."</td>
                <td>".$row_patient['last_name']."</td> 
              ";
            }
            echo "
                <td>".$row['reason']."</td>
                <td>
                  <a href='doctorCancelApptAction.php?appointmentId=".$row['id']."' class='btn btn-light btn-sm' title='Cancel'><i class='fa-solid fa-xmark'></i></a>
                  <a href='doctorAcceptApptAction.php?appointmentId=".$row['id']."' class='btn btn-light btn-sm'><i class='fa-solid fa-check' title='Accept'></i></a>
                </td>
              </tr>
            ";
          }
          ?>
        </table>
      </section>

      <section>
        <h3>Schedule New Appointment</h3>
        <br>
        <form name="frmContact" method="post" action="../AddAppointment.php">
          <p>
          <label for="date">Date</label>
            <input type="date" name="inputDate" id="inputDate" required>

            <label for="time">Time:</label>
            <input type="time" id="inputTime" name="inputTime">
          </p>
          <p>
            <!-- ERROR CANNOT ADD TO DB, NOT GRABBING PATIENT ID -->
            <label for="patient">Patient</label>
            <select name="inputPatient" required>
              <?php
              //create query
              $sql = "SELECT id,first_name,last_name FROM users WHERE role='PATIENT'";
              $result = mysqli_query($conn, $sql);
              $resultsArray = mysqli_fetch_all($result);
              //dynamically create options
              for ($i = 0; $i < sizeof($resultsArray); $i++){
                $patientId = $resultsArray[$i][0];
                $fullName = $resultsArray[$i][1] . ' ' . $resultsArray[$i][2];
                // echo "<option value={$patientId}>{$patientId}</option>";
                echo '<option value="',$patientId, '">', $fullName, '</option>';
                
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
        if(isset($_GET['cancelErr'])){
          echo '<p style="color: red;">',$_GET['cancelErr'],'</p>';
        }
        if(isset($_GET['cancelSucc'])){
          echo '<p style="color: green;">',$_GET['cancelSucc'],'</p>';
        }
        ?>
        <table class="table table-hover">
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Patient First Name</th>
            <th scope="col">Patient Last Name</th>
            <th scope="col">Reason</th>
            <th scope="col">Status</th>
          </tr>
          <?php
          //establish connection
          $conn = mysqli_connect("localhost", "root", "", "pregnancy");
          //check connection
          if (!$conn) {
            echo 'Connection failed' . mysqli_connect_error();
          }
          //create query
          $sql_apt = "SELECT id,apptDate,apptTime,patientId,reason,status FROM appointments WHERE doctorId=$sessionUserId and status='SCHEDULED'";
          $result = $conn->query($sql_apt);
          while($row = $result->fetch_assoc()) { 
            echo "
              <tr>
                <td>".$row['apptDate']."</td>
                <td>".$row['apptTime']."</td>
            ";
            $sql_patient = "SELECT first_name,last_name FROM Users WHERE id=".$row['patientId']."";
            $result_patient = $conn->query($sql_patient);
            while($row_patient = $result_patient->fetch_assoc()) { 
              echo "
                <td>".$row_patient['first_name']."</td>
                <td>".$row_patient['last_name']."</td> 
              ";
            }
            echo "
                <td>".$row['reason']."</td>
                <td>
                  <a href='doctorCancelApptAction.php?appointmentId=".$row['id']."' class='btn btn-light btn-sm' title='Cancel'><i class='fa-solid fa-xmark'></i></a>
                  <a href='doctorCompleteApptAction.php?appointmentId=".$row['id']."' class='btn btn-light btn-sm' title='Complete'><i class='fa-solid fa-check'></i></a>
                </td>
              </tr>
            ";
          }
          ?>
        </table>
      </section>

      <section>
        <h3>Previous Appointments</h3>
        <br>
        <?php
        //create query
        $sql_apt = "SELECT apptDate,apptTime,patientId,reason,status FROM appointments WHERE doctorId=$sessionUserId and (status='COMPLETED' or status='CANCELLED')";
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
    <script src="../js/patientInfo.js"></script>
  </body>
</html>
