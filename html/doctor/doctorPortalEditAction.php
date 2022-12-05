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
              <button type="button" class="btn btn-light" style="float: right;"><a href="../logout.php">Logout</a></button>
            </div>
          </div>
        </nav>
      </header>

    <section style = "overflow-x: scroll">
      <h3>Patient Editied Before</h3>
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

        <?php
          $id = $_POST['Key'];
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
      </table>
    </section>

    <section style = "overflow-x: scroll">
      <h3>Patient Editied After</h3>
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

        <?php
          $id = $_POST['Key'];
          $conn = new mysqli("localhost", "root", "", "pregnancy");
          $firstName = $_POST['firstName'];
          $lastName = $_POST['lastName'];
          $email = $_POST['email'];
          $userName = $_POST['username'];
          $password = $_POST['password'];
          $birthdate = $_POST['birthdate'];
          $phonenumber = $_POST['phonenumber'];
          $address = $_POST['address'];
          $emerCon_name = $_POST['emerCon_name'];
          $emerCon_phone = $_POST['emerCon_phone'];
          $emerCon_relation = $_POST['emerCon_relation'];
          $assignedDoctorID = $_POST['assignedDoctorID'];
          $sql = "UPDATE `Users` SET `assigned_doctorId` = 
          '$assignedDoctorID', `first_name` = '$firstName', `last_name` = '$lastName', `email` = '$email', `userpassword` = '$password', 
          `username` = '$userName', `birthdate` = '$birthdate', `phone` = '$phonenumber', `address` = '$address', `emerCon_name` = '$emerCon_name', 
          `emerCon_phone` = '$emerCon_phone', `emerCon_relation` = '$emerCon_relation' WHERE `Users`.`id` = $id";
          $conn->query($sql);


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
    <?php
    echo '<form method="POST" action="doctorPortal.php">
    <input type="submit" name="submit" value="Back to Doctor Portal">  
      </form>';
?>
      </table>
    </section>
  </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="../js/patientInfo.js"></script> -->
</body>

</html>




