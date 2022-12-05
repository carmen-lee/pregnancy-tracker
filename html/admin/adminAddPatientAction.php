


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
	<?php
    $assignedDoctorID = $_POST['assignedDoctorId'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
		$emerCon_name = $_POST['emerCon_name'];
    $emerCon_phone = $_POST['emerCon_phone'];
    $emerCon_relation = $_POST['emerCon_relation'];
    

		$conn = new mysqli("localhost", "root", "", "pregnancy");
		$sql = "INSERT INTO `Users` (`id` , `first_name`, `last_name`, `email`, `userpassword`, `role`, `username`, `assigned_doctorId`, `birthdate`, `phone`, `address`, `emerCon_name`, `emerCon_phone`, `emerCon_relation`) 
		                     VALUES (NULL, '$firstName', '$lastName', '$email', '$password', 'PATIENT', '$username', '$assignedDoctorID', '$birthdate', '$phonenumber', '$address', '$emerCon_name', '$emerCon_phone', '$emerCon_relation')";
		$conn->query($sql);
		$conn->close();


		?>



      <h3>Patient Added</h3>
      <table class="table table-hover">
        <tr>
          <th>Assigned Doctor ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>E-mail</th>
          <th>Username</th>
          <th>Password</th>
          <th>Birthdate</th>
          <th>Phone Number</th>
          <th>Address</th>
          <th>Emergency Contact Name</th>
          <th>Emergency Contact Phone</th>
          <th>Emergency Contact Relation</th>
        </tr>

        <?php
          
            echo "
            <tr>
              <td>".$assignedDoctorID."</td>
              <td>".$_POST['firstName']."</td>
              <td>".$_POST['lastName']."</td>
              <td>".$_POST['email']."</td>
              <td>".$_POST['username']."</td>
              <td>".$_POST['password']."</td>
              <td>".$_POST['birthdate']."</td>
              <td>".$_POST['phonenumber']."</td>
              <td>".$_POST['address']."</td>
              <td>".$_POST['emerCon_name']."</td>
              <td>".$_POST['emerCon_phone']."</td>
              <td>".$_POST['emerCon_relation']."</td>
            </tr>
            ";
        ?>
      </tbody>
    </table>
    <?php
    echo '
      <br>
      <a href="adminPortal.php">Back to Admin Portal</a>
    ';
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