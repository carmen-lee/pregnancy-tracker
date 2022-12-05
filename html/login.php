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
  <title>Login</title>
</head>

<body>
  <div class="login-container">
      <fieldset>
        <h1 class="display-4">Sprout!</h1>
        <p>A pregnancy tracker app</p>
        <br>
        <h3>Log into your account </h3>
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

    <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- JS -->
  <!-- <script src="../js/login.js"></script> -->
</body>

</html>