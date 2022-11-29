
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
    <link rel="stylesheet" href="../../css/patientInfo.css" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ea253243da.js" crossorigin="anonymous"></script>
    <title>Patient Pregnancies</title>
  </head>
  <body>
    <div class="body">
      <header>
        <nav
          class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill"
        >
          <div class="container-fluid">
            <a class="navbar-brand mb-0 h1" href="patientPortal.php">Patient Portal</a>
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
      <section>
        <div class="card flex-row flex-wrap">
          <div class="card-header border-0">
            <img src="../../imgs/default-avatar.png" width="50px" alt="Profile Picture" />
          </div>
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
        <h3>Pregnancies</h3>
          
      </section>
    </div>
      
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
