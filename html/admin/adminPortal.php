

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
            <a href="../logout.php">Logout</a>
            </div>
            
          </div>
        </div>
      </nav>
    </header>
    <section>
      <div class="container" style="display: block;">
        <!-- <div class="card-header border-0">
            <img src="../../imgs/default-avatar.png" width="50px" alt="Profile Picture" />
          </div> -->
        <h2 style="margin: 0px;">
          <?php
          $conn = new mysqli("localhost", "root", "", "pregnancy");
          session_start();
          $sessionUserId = $_SESSION['sessionUserId'];
          $sql = "SELECT * FROM Users WHERE id = $sessionUserId";
          $result1 = mysqli_query($conn, $sql);
          $user = mysqli_fetch_all($result1, MYSQLI_ASSOC);

          foreach ($user as $user1) {
            $first = $user1['first_name'];
            $last = $user1['last_name'];
            $username = $user1['username'];
            $birthdate = $user1['birthdate'];
            $email = $user1['email'];
            $phone = $user1['phone'];
            $addy = $user1['Address'];
            $EC_name = $user1['emerCon_name'];
            $EC_phone = $user1['emerCon_phone'];
            $EC_relation = $user1['emerCon_relation'];
          }

          echo "Welcome " . $first  . $last;
          
          $conn->close();

          ?>
        </h2>

      </div>
    </section>


    <section>
      <div class="container" >
        <div>
        <h3>Add Admin</h3>
        <table class="table table-hover">
          <tbody>
          <form name="frmContact" method="post" action="adminAddAdminAction.php">
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
          </tbody>
        </table>
      </div>
        <div>
          <h3>Add Doctor</h3>
          <table class="table table-hover">
            <tbody>
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
            </tbody>
          </table>
        </div>
        <div>
          <h3>Add Patient</h3>
          <table class="table table-hover">
            <tbody>
            <form name="frmContact" method="post" action="adminAddPatientAction.php">
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
                    <label for="password">Birthdate (20XX-12-XX)</label>
                    <input type="text" name="birthdate" id="birthdate" required> <br/>
                    <label for="password">Phone Number</label>
                    <input type="text" name="phonenumber" id="phonenumber" required> <br/>
                    
                    <input type="submit" name="Submit" id="Submit" value="Submit">
                </p>
            </form>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <section>
      <h3>Admin</h3>
      <table class="table table-hover">
        <caption>TABLE OF ADMINS</caption>
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
          $sql = "SELECT * FROM Users WHERE role = 'ADMIN' ";
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
            <td><a href='adminEditDoctor.php?a="   . $row['id'] . "'>Edit BUTTON NO WORK</a></td>
            <td><a href='adminDeleteDoctor.php?a=" . $row['id'] . "'>Delete BUTTON NO WORK</a></td>
          </tr>
          ";
          }
        ?>
      </table>
    </section>

    <section>
      <h3>Doctors</h3>
      <table class="table table-hover">
        <caption>TABLE OF DOCTORS</caption>
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
            <td><a href='adminEditDoctor.php?a="   . $row['id'] . "'>Edit</a></td>
            <td><a href='adminDeleteDoctor.php?a=" . $row['id'] . "'>Delete</a></td>
          </tr>
          ";
          }
        ?>
      </table>
    </section>

    <section>
      <h3>Patient</h3>
      <table class="table table-hover">
        <caption>TABLE OF PATIENTS</caption>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>E-mail</th>
          <th>Username</th>
          <th>Password</th>
          <th>Birth Date</th>
          <th>Phone Number</th>
        </tr>
        <?php
          $conn = new mysqli("localhost", "root", "", "pregnancy");
          $sql = "SELECT * FROM Users WHERE role = 'PATIENT' ";
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
            <td>".$row['birthdate']."</td>
            <td>".$row['phone']."</td>
            <td><a href='adminEditDoctor.php?a="   . $row['id'] . "'>Edit BUTTON NO WORK</a></td>
            <td><a href='adminDeleteDoctor.php?a=" . $row['id'] . "'>Delete BUTTON NO WORK</a></td>
          </tr>
          ";
          }
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






