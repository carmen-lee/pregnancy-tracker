<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
  <title>Login Page</title>
</head>

<body>
  <div class="col-md-6">
    <div class="login-box">
      <fieldset>
        <h1>Log into your account </h1>
        <br>
        <form name="frmContact" method="post" action="loginAction.php">
          <p>
            <!-- <label for="username">Username </label> -->
            <input type="text" name="inputUserName" id="inputUserName" placeholder="Username" required>
          </p>
          <p>
            <!-- <label for="password">Password</label> -->
            <input type="password" name="inputPassword" id="inputPassword" placeholder="Password" required>
          </p>
          <p>
            <?php
            if (isset($_GET['err'])) {
              echo '<p style="color: red;">', $_GET['err'], '</p>';
            }
            if (isset($_GET['registerSuccess'])) {
              echo '<p style="color: green;">', $_GET['registerSuccess'], '</p>';
            }
            ?>
          </p>
          <p>
            <input type="submit" name="Submit" id="Submit" value="Login">
          </p>
          <p>
            <a href="register.php">Register</a>
          </p>
        </form>
      </fieldset>
    </div>
  </div>
  <div class="col-md-6 login-splash"></div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JS -->
  <!-- <script src="../js/login.js"></script> -->
</body>

</html>