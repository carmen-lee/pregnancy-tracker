
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
              <div class="navbar-nav">
                <a class="nav-link" href="adminPortal.php">Home</a>
                <a class="nav-link" href="adminDoctors.php">Doctors</a>
                <a class="nav-link" href="adminPatients.php">Patients</a>
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
      something here
      </section>

      <section>
        <h3>Add New Doctor</h3>
        <form name="frmContact" method="post" action="adminAddDoctorAction.php">
            <p>
                <label for="firstname">First Name </label>
                <input type="text" name="firstName" id="firstName" required> <br/>
                <label for="lastname">Last Name</label>
                <input type="text" name="lastName" id="lastName" required> <br/>
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" required> <br/>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required> <br/>
                <label for="password">Password</label>
                <input type="text" name="password" id="password" required> <br/>
                
                <input type="submit" name="Submit" id="Submit" value="Submit">
            </p>
        </form>
      </section>

      <section>
        <h3>All Doctors</h3>
        <!-- <table class="table table-hover">
          <tbody>
            <tr>
              <th scope="row"><i class="fa-solid fa-address-book"></i>&nbsp Full Name</th>
              <td align="right">xx/xx/xxxx</td>
            </tr>
            <tr>
              <th scope="row"><i class="fa-solid fa-user-group"></i>&nbsp  Relationship</th>
              <td align="right">Sibling</td>
            </tr>
            <tr>
              <th scope="row"><i class="fa-solid fa-phone"></i>&nbsp Phone Number</th>
              <td align="right">(xxx)xxx-xxxx</td>
            </tr> -->

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
          <!-- </tbody>
        </table> -->
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
