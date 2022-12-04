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
  <title>Admin Portal</title>
</head>

<body>
  <div class="body">
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill">
        <div class="container-fluid">
          <a class="navbar-brand mb-0 h1" href="patientPortal.php">Admin Portal</a>
          <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            </div>
            
          </div>
        </div>
      </nav>
    </header>

    <section>
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
    <table class="table table-hover">
    <h3>Doctors to Choose From</h3>
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
          while($row = $result->fetch_assoc()) { 
            echo "
            <tr>
              <td>".$row['id']."</td>
              <td>".$row['first_name']."</td>
              <td>".$row['last_name']."</td>
              <td>".$row['email']."</td>
              <td>".$row['username']."</td>
              <td>".$row['userpassword']."</td>
            </tr>
            ";
          }
          $conn->close();
        ?>
    </table>
    <form name="frmContact" method="post" action="adminEditPatientAction.php">
            <p>
                <input type="hidden" id="Key" name="Key" value="<?=$id ?>">
                <label for="doctorID">Assigned Doctor ID</label>
                <input type="text" name="assignedDoctorID" id="assignedDoctorID" required> <br/>
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
                <label for="username">Birth Date</label>
                <input type="date" name="birthdate" id="birthdate" required> <br/>
                <label for="password">Phone Number</label>
                <input type="text" name="phonenumber" id="phonenumber" required> <br/>
                <label for="password">Address</label>
                <input type="text" name="address" id="address" required> <br/>
                <label for="password">Emergency Contact Name</label>
                <input type="text" name="emerCon_name" id="emerCon_name" required> <br/>
                <label for="password">Emergency Contact Phone</label>
                <input type="text" name="emerCon_phone" id="emerCon_phone" required> <br/>
                <label for="password">Emergency Contact Relation</label>
                <input type="text" name="emerCon_relation" id="emerCon_relation" required> <br/>

                <input type="submit" name="Submit" id="Submit" value="Submit">
            </p>
        </form>
        <?php
          echo '<form method="POST" action="adminPortal.php">
          <input type="submit" name="submit" value="Cancel">  
            </form>';
        ?>

      </table>
    </section>

    <!-- <section>
      <h3>Health Insurance Information</h3>
      <table class="table table-hover">
        <tbody>
          <tr>
            <th scope="row"><i class="fa-solid fa-address-card"></i>&nbsp Insurance Name</th>
            <td align="right">xxxxxxxxx</td>
          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-hashtag"></i>&nbsp Group Number</th>
            <td align="right">xxxxxxxxx</td>
          </tr>
          <tr>
            <th scope="row"><i class="fa-solid fa-hashtag"></i>&nbsp Member ID</th>
            <td align="right">xxxxxxxxx</td>
          </tr>
        </tbody>
      </table>
    </section> -->
  </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle with Popper -->
  <!-- <script src="../js/patientInfo.js"></script> -->
</body>

</html>