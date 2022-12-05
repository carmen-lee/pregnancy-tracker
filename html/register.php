<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/ea253243da.js" crossorigin="anonymous"></script>
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
  <title>Register</title>
</head>

<body>
  <div class="register-container">
      <fieldset>
        <h2>Register new user</h2>
        <br>
        <form name="frmContact" method="post" action="registerAction.php">
          <p>
            <label for="username">Username </label>
            <input type="text" name="inputUserName" id="inputUserName" required>
          </p>
          <p>
            <label for="password">Password</label>
            <input type="password" name="inputPassword" id="inputPassword" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8}$" required>
          </p>

          <p>
            <label for="first_name">First Name</label>
            <input type="text" name="inputFirst" id="inputFirst" required>
          </p>
          <p>
            <label for="last_name">Last Name</label>
            <input type="text" name="inputLast" id="inputLast" required>
          </p>
          <p>
            <label for="type">Type</label>
            <select name="inputRole" id="inputRole" required>
              <option value="administrator" disabled>Administrator</option>
              <option value="doctor" disabled>Doctor</option>
              <option value="patient">Patient</option>
            </select>
          </p>
          <p>
            <label for="email">Email</label>
            <input type="email" name="inputEmail" id="inputEmail" required>
          </p>
          <p>
            <label for="phoneNumber">Phone Number</label>
            <input type="tel" name="inputPhoneNumber" placeholder="123-456-7890" id="inputPhoneNumber" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
          </p>
          <p>
            <label for="birthdate">Birthdate</label>
            <input type="date" name="inputBirthdate" id="inputBirthdate" required>
          </p>
          <p>
            <?php
            if (isset($_GET['err'])) {
              echo '<p style="color: red;">', $_GET['err'], '</p>';
            }
            if (isset($_GET['success'])) {
              echo '<p style="color: green;">', $_GET['success'], '</p>';
              // sleep(1);
              header("Location:login.php");
            }
            ?>
          </p>
          <p>
            <input type="submit" name="Submit" id="registerBtn" value="Register" onsubmit="handleSubmit(e)">
          </p>
          <p><a href="login.php">Back to Login</a></p>
        </form>
      </fieldset>
    </div>

    <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JS -->
  <!-- <script src="../js/register.js"></script> -->
</body>

</html>