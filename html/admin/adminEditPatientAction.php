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
          <a class="navbar-brand mb-0 h1" href="./adminPortal.php">Admin Portal</a>
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
      <h3>Patient Editied Before</h3>
      <table class="table table-hover">
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
          $id = $_POST['Key'];
          $conn = new mysqli("localhost", "root", "", "pregnancy");
          $sql = "SELECT * FROM Users WHERE role = 'PATIENT' && id = $id ";
          
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
            </tr>
            ";
          }
         
          $conn->close();
        ?>
      </tbody>
    </table>
      </table>
    </section>

    <section>
      <h3>Patient Editied After</h3>
      <table class="table table-hover">
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
          $id = $_POST['Key'];
          $conn = new mysqli("localhost", "root", "", "pregnancy");
          $firstName = $_POST['firstName'];
          $lastName = $_POST['lastName'];
          $email = $_POST['email'];
          $userName = $_POST['username'];
          $password = $_POST['password'];
          $birthdate = $_POST['birthdate'];
          $phonenumber = $_POST['phonenumber'];

          $sql = "UPDATE `Users` SET `first_name` = '$firstName', `last_name` = '$lastName', `email` = '$email', `userpassword` = '$password', `username` = '$userName', `birthdate` = '$birthdate', `phone` = '$phonenumber' WHERE `Users`.`id` = $id";
          $conn->query($sql);


          $sql = "SELECT * FROM Users WHERE role = 'PATIENT' && id = $id ";
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
            </tr>
            ";
          }
          $conn->close();
        ?>
      </tbody>
    </table>
    <?php
    echo '<form method="POST" action="adminPortal.php">
    <input type="submit" name="submit" value="Back to Admin Portal">  
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




