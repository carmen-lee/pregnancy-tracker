
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
      <section>
        <div class="card flex-row flex-wrap">
          <!-- <div class="card-header border-0">
            <img src="../../imgs/default-avatar.png" width="50px" alt="Profile Picture" />
          </div> -->
          <h2 class="card-title">
            <?php 

            $conn = new mysqli("localhost", "root", "", "pregnancy");
            $sql = "SELECT username, userpassword FROM Users";
            $roleType = $_POST['loginType'];

            session_start();
            $sessionUserName = $_SESSION['sessionUserName'];
            $sessionUserPassword = $_SESSION['sessionUserPassword'];


            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    if($sessionUserName == $row["username"] && $sessionUserPassword == $row["userpassword"]){
                        echo "Welcome " . $sessionUserName;
                    }
                }
            }
            $conn->close();
            ?>
        </div>
      </section>

      <section>
        <h3>Schedule New Appointment</h3>
        <br>
        <form name="frmContact" method="post" action="">
          <p>
            <label for="date">Date</label>
            <input type="date" name="inputDate" id="inputDate" required>
          </p>
          <p>
            <label for="patient">Patient</label>
            <!-- dynamically make select list
              </select><br>

              Project: <select name="pro" id="">

              <option value=""></option>
                  <?php /*
                  foreach($projects as $row){
                    echo '<option value="',$row[0],'">',$row[1],'</option>'; 
                  } */
                  ?>

              </select>
              <input type="submit" value="Assign Project">
             -->
            <select name="patient" id="inputPatient" form="patient" required>
              <option value="a">a</option>
              <option value="b">b</option>
              <option value="c">c</option>
              <option value="d">d</option>
            </select>
          </p>
          <p>
            <label for="Reason">Reason</label> <br>
            <textarea type="text" name="inputReason" id="inputReason" required></textarea>
          </p>
        </form>
      </section>

      <section>
        <h3>Upcoming Appointments</h3>
        
        
      </section>

      <section>
        <h3>Previous Appointments</h3>
        
        
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
