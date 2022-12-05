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
  <title>Patient Portal</title>
</head>

<body>

  <?php
  session_start();
  $sessionRole = $_SESSION['sessionRole'];
  $sessionUserId = $_SESSION['sessionUserId'];
  $sessionFirstName = $_SESSION['sessionFirstName'];
  $sessionLastName = $_SESSION['sessionLastName'];
  //check that the user has the role Patient, else logout 
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
  $sql = "SELECT * FROM Users WHERE id = $sessionUserId";
  $result1 = mysqli_query($conn, $sql);
  $user = mysqli_fetch_all($result1, MYSQLI_ASSOC);

  foreach ($user as $user1) {
    $first = $user1['first_name'];
    $last = $user1['last_name'];
    $username = $user1['username'];
    $birthdate = $user1['birthdate'];
    $doctorId = $user1['assigned_doctorId'];
    $email = $user1['email'];
    $phone = $user1['phone'];
    $addy = $user1['address'];
    $EC_name = $user1['emerCon_name'];
    $EC_phone = $user1['emerCon_phone'];
    $EC_relation = $user1['emerCon_relation'];
  }
  $sqln = "SELECT * FROM Users WHERE id = $doctorId";
  $result = mysqli_query($conn, $sqln);
  $doctor = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($doctor as $doctor1) {
    $doctorFirst = $doctor1['first_name'];
    $doctorLast = $doctor1['last_name'];
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
              <a class="nav-link" href="patientAppointments.php">Appointments</a>
              <a class="nav-link" href="patientMedications.php">Medications</a>
            </div>
            <?php echo $first . " " . $last; ?>
            <button type="button" class="btn btn-light logout-btn" style="float: right;"><a href="../logout.php">Logout</a></button>
          </div>
        </div>
      </nav>
    </header>
    
    <section>
      <h2 class="card-title display-6">
        Welcome Back!
      </h2>
    </section>

    <section>
      <h3>
        My Information
        <button type="button" class="btn btn-light btn-sm" style="float: right;">
          <a href='patientEditMyInfo.php?a=' style="text-decoration: none;"><i class="fa-solid fa-user-pen"></i></a>
        </button>
      </h3>
      <?php
      if (isset($_GET['passwordErr'])) {
        echo '<section><p style="color: red;">&nbsp', $_GET['passwordErr'], '</p></section>';
      }
      if (isset($_GET['passwordSucc'])) {
        echo '<section ><p style="color: green;">&nbsp', $_GET['passwordSucc'], '</p></section>';
      }
      ?>
      <table class="table table-hover">
        <tbody>
          <tr>
            <th scope="row"><i class="fa-solid fa-user-doctor"></i>&nbsp Doctor</th>

            <?php
            echo '<td align="right"> Dr. ', $doctorFirst, ' ', $doctorLast, '</td>';
            ?>

          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-cake-candles"></i>&nbsp Date of Birth</th>

            <?php
            echo '<td align="right">', $birthdate, '</td>';
            ?>

          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-envelope"></i>&nbsp Email</th>
            <?php
            echo '<td align="right">', $email, '</td>';
            ?>
          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-phone"></i>&nbsp Phone Number</th>
            <?php
            echo '<td align="right">', $phone, '</td>';
            ?>
          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-house-user"></i>&nbsp Address</th>
            <?php
            echo '<td align="right">', $addy, '</td>';
            ?>
          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-at"></i>&nbsp Username</th>
            <?php
            echo '<td align="right">', $username, '</td>';
            ?>
          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-lock"></i>&nbsp Password</th>
            <td align="right">
              <!-- <button onclick="window.location.href=patientPassword.php" ">Change</button> -->
              <!-- <button type="button" class="btn btn-light btn-sm" style="float: right;"><a href='patientPassword.php?a=' style="text-decoration: none;"><i class="fa-solid fa-pen-to-square"></i></a></button> -->
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>

    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Change password</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="frmContact" method="post" action="patientPasswordAction.php">
              <label for="oldPass">Old Password </label> <br>
              <input type="password" name="oldPass" id="oldPass" required> <br />
              <label for="newPass">New Password </label> <br>
              <input type="password" name="newPass" id="newPass" required> <br />
              <label for="checkPass">Confirm new Password </label> <br>
              <input type="password" name="checkPass" id="checkPass" required> <br /><br />
              <?php
              if (isset($_GET['passwordErr'])) {
                  echo '<p style="color: red;">', $_GET['passwordErr'], '</p>';
              }
              if (isset($_GET['passwordSucc'])) {
                  echo '<p style="color: green;">', $_GET['passwordSucc'], '</p>';
              }
              ?>
              <!-- <input type="submit" name="Submit" id="Submit" value="Submit"> -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <!-- <button type="button" class="btn btn-secondary">Update password</button> -->
            <input type="submit" class="btn btn-secondary" name="Submit" id="Submit" value="Update">
          </div>
            </form>
        </div>
      </div>
    </div>

    <section>
      <h3>Emergency Contact Information</h3>
      <table class="table table-hover">
        <tbody>
          <tr>
            <th scope="row"><i class="fa-solid fa-address-book"></i>&nbsp Full Name</th>
            <?php
            echo '<td align="right">', $EC_name, '</td>';
            ?>
          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-user-group"></i>&nbsp Relationship</th>
            <?php
            echo '<td align="right">', $EC_relation, '</td>';
            ?>
          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-phone"></i>&nbsp Phone Number</th>
            <?php
            echo '<td align="right">', $EC_phone, '</td>';
            ?>
          </tr>
        </tbody>
      </table>
    </section>
    <section class="footer d-flex align-self-center">
      <p>
        Created for CS 441 by Carmen Lee, Cecilia Siu, Edward Sung
      </p>
      <img id="footer-img" src="../../imgs/sprout.jpg" alt="Sprout!">
    </section>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="../js/patientInfo.js"></script> -->
</body>

</html>