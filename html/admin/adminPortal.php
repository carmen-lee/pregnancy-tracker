
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
    <title>Admin Portal</title>
  </head>
  <body>
    <div class="body">
      <header>
        <nav
          class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill"
        >
          <div class="container-fluid">
            <a class="navbar-brand mb-0 h1" href="adminPortal.php">Admin Portal</a>
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
              <a href="../logout.php">Logout</a>
            </div>
          </div>
        </nav>
      </header>

      <?php 
      session_start();
      $sessionUserName = $_SESSION['sessionUsername'];
      $sessionRole = $_SESSION['sessionRole'];
      //check that the user has the role Admin, else logout 
      if ($sessionRole !== "Admin") {
        header("Location: ../login.php? err=Please login");
      }
      ?>


      <section>
      something here
      </section>

      <section>
        <h3>Add New Doctor</h3>
        <form name="frmContact" method="post" action="adminAddDoctorAction.php">
            <p>
              <label for="firstname">First Name </label>
              <input type="text" name="firstName" id="firstName" required> 
            <!-- </p>
            <p> -->
              <label for="lastname">Last Name</label>
              <input type="text" name="lastName" id="lastName" required> 
            </p>
            <p>
              <label for="username">Username</label>
              <input type="text" name="username" id="username" required> 
              <!-- </p>
              <p> -->
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required> 
              </p>
              <p>
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required> 
              </p>
              
            <input type="submit" name="Submit" id="Submit" value="Submit">
        </form>
      </section>

      <section>
        <h3>All Doctors</h3>
          <?php 
          $conn = new mysqli("localhost", "root", "", "pregnancy");
          $sql = "SELECT * FROM Doctors";
          $result = $conn->query($sql);
          echo "<table>"; // start a table tag in the HTML
            echo"<tr><td>First Name </td><td><tr><td>Second Name </td><td>";
          while($row = $result->fetch_assoc()) {   //Creates a loop to loop through results
            echo "<tr><td>" . htmlspecialchars($row['firstName']) . "</td><td>" . htmlspecialchars($row['lastName']) . "</td></tr>";  //$row['index'] the index here is a field name
          }

          echo "</table>"; //Close the table in HTML

          $conn->close(); //Make sure to close out the database connection
          ?>  
      </section>
      <section>
        <h3>All Patients</h3>
          <?php 
          $conn = new mysqli("localhost", "root", "", "pregnancy");
          $sql = "SELECT * FROM Patients";
          $result = $conn->query($sql);
          echo "<table>"; // start a table tag in the HTML
            echo"<tr><td>First Name </td><td><tr><td>Second Name </td><td>";
          while($row = $result->fetch_assoc()) {   //Creates a loop to loop through results
            echo "<tr><td>" . htmlspecialchars($row['firstName']) . "</td><td>" . htmlspecialchars($row['lastName']) . "</td></tr>";  //$row['index'] the index here is a field name
          }

          echo "</table>"; //Close the table in HTML

          $conn->close(); //Make sure to close out the database connection
          ?>  
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
