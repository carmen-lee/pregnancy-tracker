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
          <a class="nav-link" href="doctorAppointments.php">Appointments</a>
          <a class="nav-link" href="doctorMedications.php">Medications</a>
          </div>
          <?php echo "<div>Dr. ", $sessionFirstName, " ", $sessionLastName, "</div>" ?>
          <button type="button" class="btn btn-light" style="float: right;"><a href="../logout.php">Logout</a></button>
        </div>
        </div>
      </nav>
    </header>

    <section style = "overflow-x: scroll">
      <h3>Record Currently Editing</h3>
      <table class="table table-hover">
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
        <tbody>
          <?php
            $id = $_GET['a'];
            $conn = new mysqli("localhost", "root", "", "pregnancy");
            $sql = "SELECT * FROM Users WHERE role = 'PATIENT' && id = $id ";
            
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) { 
              echo "
              <tr>
                <td>".$row['id']."</td>
                <td>".$row['assigned_doctorId']."</td>
                <td>".$row['first_name']."</td>
                <td>".$row['last_name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['username']."</td>
                <td>".$row['userpassword']."</td>
                <td>".$row['birthdate']."</td>
                <td>".$row['phone']."</td>
                <td>".$row['address']."</td>
                <td>".$row['emerCon_name']."</td>
                <td>".$row['emerCon_phone']."</td>
                <td>".$row['emerCon_relation']."</td>
              </tr>
              ";
            }
            $conn->close();
          ?>
        
        </tbody>
      </table>
    
      <form name="frmContact" method="post" action="doctorPortalEditAction.php">
        <p>
          <input type="hidden" id="Key" name="Key" value="<?=$id ?>">
        </p>
        <p>
          <label for="doctorID">Assigned Doctor ID</label>
          <input type="text" name="assignedDoctorID" id="assignedDoctorID"> <br/>
        </p>
        <p>
          <label for="firstname">First Name </label>
          <input type="text" name="firstName" id="firstName"> <br/>
        </p>
        <p>
          <label for="lastname">Last Name</label>
          <input type="text" name="lastName" id="lastName"> <br/>
        </p>
        <p>
          <label for="email">E-mail</label>
          <input type="text" name="email" id="email"> <br/>
        </p>
        <p>
          <label for="username">Username</label>
          <input type="text" name="username" id="username"> <br/>
        </p>
        <p>
          <label for="password">Password</label>
          <input type="text" name="password" id="password"> <br/>
        </p>
        <p>
          <label for="username">Birth Date</label>
          <input type="date" name="birthdate" id="birthdate"> <br/>
        </p>
        <p>
          <label for="password">Phone Number</label>
          <input type="text" name="phonenumber" id="phonenumber"> <br/>
        </p>
        <p>
          <label for="password">Address</label>
          <input type="text" name="address" id="address"> <br/>
        </p>
        <p>
          <label for="password">Emergency Contact Name</label>
          <input type="text" name="emerCon_name" id="emerCon_name"> <br/>
        </p>
        <p>
          <label for="password">Emergency Contact Phone</label>
          <input type="text" name="emerCon_phone" id="emerCon_phone"> <br/>
        </p>
        <p>
          <label for="password">Emergency Contact Relation</label>
          <input type="text" name="emerCon_relation" id="emerCon_relation"> <br/>
        </p>
        <input type="submit" name="Submit" id="Submit" value="Submit">
      </form>
      <?php
      echo '
        <br>
        <a href="doctorPortal.php">Cancel</a>
      ';
      ?>
    </section>

  </div>

  </div>

    <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="../js/patientInfo.js"></script> -->
</body>

</html>