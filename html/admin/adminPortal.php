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
  <title>Admin Portal</title>
  <style>
    .container {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
    }
  </style>
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
  if ($sessionRole !== "ADMIN") {
    header("Location: ../login.php? err=Please login");
  }
  ?>

  <div class="body">
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill">
        <div class="container-fluid">
          <a class="navbar-brand mb-0 h1" href="adminPortal.php">Admin Portal</a>
          <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto"></div>
            <?php echo $sessionFirstName . " " . $sessionLastName; ?>
            <button type="button" class="btn btn-light logout-btn" style="float: right;"><a href="../logout.php">Logout</a></button>

          </div>
        </div>
      </nav>
    </header>

    <section style="overflow-x: scroll">
      <h3>
        Admin
        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addAdminModal">
          <i class="fa-solid fa-plus"></i></a>
        </button>
      </h3>
      <br>
      <p>
        <label for="username">Search by Name &nbsp</label>
        <input class="searchbar" type="text" id="myInput" onkeyup="myFunction()" placeholder="">
      </p>
      <table class="table table-hover" id="myTable">
        <tr class="header">
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>E-mail</th>
          <th>Username</th>
          <th>Password</th>
        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "", "pregnancy");
        $sql = "SELECT * FROM Users WHERE role = 'ADMIN' ";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
          echo "
          <tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['username'] . "</td>
            <td>" . $row['userpassword'] . "</td>
            <td>
              <a href='adminEditAdmin.php?a=" . $row['id'] . "' class='btn btn-light btn-sm' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
              <a href='adminDeleteAdmin.php?a=" . $row['id'] . "' class='btn btn-light btn-sm' title='Delete'><i class='fa-solid fa-trash'></i></a>
            </td>

          </tr>
          ";
        }
        ?>
      </table>
    </section>

    <!-- Add Admin Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add admin</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="frmContact" method="post" action="adminAddAdminAction.php">
              <p>
                <label for="firstname">First Name </label><br>
                <input class="formfield" type="text" name="firstName" id="firstName" required> <br />
              </p>
              <p>
                <label for="lastname">Last Name</label><br>
                <input class="formfield" type="text" name="lastName" id="lastName" required> <br />
              </p>
              <p>
                <label for="email">E-mail</label><br>
                <input class="formfield" type="text" name="email" id="email" required> <br />
              </p>
              <p>
                <label for="username">Username</label><br>
                <input class="formfield" type="text" name="username" id="username" required> <br />
              </p>
              <p>
                <label for="password">Password</label><br>
                <input class="formfield" type="text" name="password" id="password" required> <br />
              </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-secondary" name="Submit" id="Submit" value="Add">
          </div>
          </form>
        </div>
      </div>
    </div>

    <section style="overflow-x: scroll">
      <h3>
        Doctors
        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
          <i class="fa-solid fa-plus"></i></a>
        </button>
      </h3>
      <br>
      <p>
        <label for="username">Search by Name &nbsp</label>
        <input class="searchbar" type="text" id="myInput2" onkeyup="myFunction2()" placeholder="">
      </p>

      <table class="table table-hover" id="myTable2">
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>E-mail</th>
          <th>Username</th>
          <th>Password</th>
        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "", "pregnancy");
        $sql = "SELECT * FROM Users WHERE role = 'DOCTOR' ";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
          echo "
          <tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['username'] . "</td>
            <td>" . $row['userpassword'] . "</td>
            <td>
              <a href='adminEditDoctor.php?a=" . $row['id'] . "' class='btn btn-light btn-sm' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
              <a href='adminDeleteDoctor.php?a=" . $row['id'] . "' class='btn btn-light btn-sm' title='Delete'><i class='fa-solid fa-trash'></i></a>
            </td>
          </tr>
          ";
        }
        ?>
      </table>
    </section>

    <!-- Add Doctor Modal -->
    <div class="modal fade" id="addDoctorModal" tabindex="-1" role="dialog" aria-labelledby="addDoctorModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add doctor</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="frmContact" method="post" action="adminAddDoctorAction.php">
              <p>
                <label for="firstname">First Name </label><br>
                <input class="formfield" type="text" name="firstName" id="firstName" required> <br />
              </p>
              <p>
                <label for="lastname">Last Name</label><br>
                <input class="formfield" type="text" name="lastName" id="lastName" required> <br />
              </p>
              <p>
                <label for="email">E-mail</label><br>
                <input class="formfield" type="text" name="email" id="email" required> <br />
              </p>
              <p>
                <label for="username">Username</label><br>
                <input class="formfield" type="text" name="username" id="username" required> <br />
              </p>
              <p>
                <label for="password">Password</label><br>
                <input class="formfield" type="text" name="password" id="password" required> <br />
              </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-secondary" name="Submit" id="Submit" value="Add">
          </div>
          </form>
        </div>
      </div>
    </div>

    <section style="overflow-x: scroll">
      <h3>
        Patient
        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addPatientModal">
          <i class="fa-solid fa-plus"></i></a>
        </button>
      </h3>
      <br>
      <p>
        <label for="username">Search by Name &nbsp</label>
        <input class="searchbar" type="text" id="myInput3" onkeyup="myFunction3()" placeholder="">
      </p>

      <table class="table table-hover " id="myTable3">
        <tr>
          <th>ID</th>
          <th>Assigned Doctor ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>E-mail</th>
          <th>Username</th>
          <th>Password</th>
          <th>Birth Date</th>
          <th>Phone Number</th>
          <th>Address</th>
          <th>Emergency Contact Name</th>
          <th>Emergency Contact Phone</th>
          <th>Emergency Contact Relation</th>

        </tr>
        <?php
        $conn = new mysqli("localhost", "root", "", "pregnancy");
        $sql = "SELECT * FROM Users WHERE role = 'PATIENT' ";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
          $_SESSION['temp'] = $row['id'];
          echo "
          <tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['assigned_doctorId'] . "</td>
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['username'] . "</td>
            <td>" . $row['userpassword'] . "</td>
            <td>" . $row['birthdate'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['address'] . "</td>
            <td>" . $row['emerCon_name'] . "</td>
            <td>" . $row['emerCon_phone'] . "</td>
            <td>" . $row['emerCon_relation'] . "</td>
            <td>
              <a href='adminEditPatient.php?a=" . $row['id'] . "' class='btn btn-light btn-sm' title='Edit'><i class='fa-solid fa-pen-to-square'></i></a>
              <a href='adminDeletePatient.php?a=" . $row['id'] . "' class='btn btn-light btn-sm' title='Delete'><i class='fa-solid fa-trash'></i></a>
            </td>
          </tr>
          ";
        }
        ?>
      </table>
    </section>

    <section class="footer d-flex align-self-center">
      <p>
        Created for CS 441 by Carmen Lee, Cicelia Siu, Edward Sung
      </p>
      <img id="footer-img" src="../../imgs/sprout.jpg" alt="Sprout!">
    </section>

    <!-- Add Patient Modal -->
    <div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add patient</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="frmContact" method="post" action="adminAddPatientAction.php">
              <p>
                <label for="assDocId">Assigned Doctor ID (required)</label><br>
                <input class="formfield" type="text" name="assignedDoctorId" id="assignedDoctorId" required> <br />
              </p>
              <p>
                <label for="firstname">First Name (required) </label><br>
                <input class="formfield" type="text" name="firstName" id="firstName" required> <br />
              </p>
              <p>
                <label for="lastname">Last Name (required)</label><br>
                <input class="formfield" type="text" name="lastName" id="lastName" required> <br />
              </p>
              <p>
                <label for="email">E-mail (required)</label><br>
                <input class="formfield" type="text" name="email" id="email" required> <br />
              </p>
              <p>
                <label for="username">Username (required)</label><br>
                <input class="formfield" type="text" name="username" id="username" required> <br />
              </p>
              <p>
                <label for="password">Password (required)</label><br>
                <input class="formfield" type="text" name="password" id="password" required> <br />
              </p>
              <p>
                <label for="password">Birthdate</label><br>
                <input class="formfield" type="date" name="birthdate" id="birthdate"> <br />
              </p>
              <p>
                <label for="password">Phone Number</label><br>
                <input class="formfield" type="text" name="phonenumber" id="phonenumber"> <br />
              </p>
              <p>
                <label for="password">Address</label><br>
                <input class="formfield" type="text" name="address" id="address"> <br />
              </p>
              <p>
                <label for="password">Emergency Contact Name</label><br>
                <input class="formfield" type="text" name="emerCon_name" id="emerCon_name"> <br />
              </p>
              <p>
                <label for="password">Emergency Contact Phone</label><br>
                <input class="formfield" type="text" name="emerCon_phone" id="emerCon_phone"> <br />
              </p>
              <p>
                <label for="password">Emergency Contact Relation</label><br>
                <input class="formfield" type="text" name="emerCon_relation" id="emerCon_relation"> <br />
              </p>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-secondary" name="Submit" id="Submit" value="Add">
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="../js/patientInfo.js"></script> -->
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
      td = tr[i].getElementsByTagName("td")[1];
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

  function myFunction2() {
    // Declare variables 
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput2");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable2");
    tr = table.getElementsByTagName("tr");
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
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

  function myFunction3() {
    // Declare variables 
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput3");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable3");
    tr = table.getElementsByTagName("tr");
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
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