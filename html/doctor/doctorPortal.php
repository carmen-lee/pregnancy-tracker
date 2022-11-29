
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
    <title>Doctor Portal</title>
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
            session_start();
            $sessionUserName = $_SESSION['sessionUsername'];
            $sessionRole = $_SESSION['sessionRole'];
            //check that the user has the role doctor, else logout 
            if ($sessionRole !== "Doctor") {
              header("Location: ../login.php? err=Please login");
            }

            echo "Welcome " . $sessionUserName;
            ?>
        </div>
      </section>


      <section>
        <p>[Search Bar]</p>
      </section>

      <section>
        <h3>Your Patients</h3>
        
        
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
