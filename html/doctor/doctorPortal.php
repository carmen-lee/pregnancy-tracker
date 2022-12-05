
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
              <div class="navbar-nav me-auto">
                <!-- <a class="nav-link" href="doctorPortal.php">Home</a> -->
                <a class="nav-link" href="doctorAppointments.php">Appointments</a>
                <a class="nav-link" href="doctorMedications.php">Medications</a>
              </div>
              <?php echo "<div>Dr. ",$sessionFirstName, " ",$sessionLastName,"</div>" ?>
              <button type="button" class="btn btn-light" style="float: right;"><a href="../logout.php">Logout</a></button>
            </div>
          </div>
        </nav>
      </header>

      <section>
        <!-- <div class="card flex-row flex-wrap"> -->
          <!-- <div class="card-header border-0">
            <img src="../../imgs/default-avatar.png" width="50px" alt="Profile Picture" />
          </div> -->
          <h2 class="card-title display-3">
            Welcome Back!
          </h2>
        <!-- </div> -->
      </section>


      

      <section>
        <h3>Your Patients</h3>
        <!-- $sql = "SELECT first_name, last_name, email FROM Users WHERE assigned_doctorId=$sessionUserId"; -->
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

        <table class="table table-hover" id ="myTable">
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
          </tr>
          <?php
          //establish connection
          $conn = mysqli_connect("localhost", "root", "", "pregnancy");
          //check connection
          if (!$conn) {
            echo 'Connection failed' . mysqli_connect_error();
          }
          //create query
          $sql = "SELECT id, first_name, last_name, email, phone FROM Users WHERE assigned_doctorId=$sessionUserId";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) { 
            echo "
              <tr>
                <td>".$row['first_name']."</td>
                <td>".$row['last_name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['phone']."</td>
                <td><a href='doctorPortalEdit.php?a="   . $row['id'] . "'>Edit</a></td>
              </tr>
            ";
          }
          $conn->close();
          ?>
        </table>
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

<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>