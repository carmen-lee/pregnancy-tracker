
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <title>Register User</title>
  </head>
  <body>
  
    <div class="col-md-6">
    <div class="login-box">
        <fieldset>
          <h1>Register new user</h1>
          <br>
          <form name="frmContact" method="post" action="registerAction.php">
            <p>
                <label for="username">Username </label>
                <input type="text" name="inputUserName" id="inputUserName" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="inputPassword" id="inputPassword" required>
            </p>
            <p>
              <!-- <label class="radio-inline">
                  <input type="radio" name="loginType" required value="admin" checked> Administrator
              </label>
              <label class="radio-inline">
                  <input type="radio" name="loginType" required value="doctor"> Doctor
              </label>
              <label class="radio-inline">
                  <input type="radio" name="loginType" required value="patient"> Patient
              </label> -->
              <label for="type">Type</label>
              <select name="patient" id="inputPatient" form="patient" required>
                <option value="administrator">Administrator</option>
                <option value="doctor">Doctor</option>
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
              if(isset($_GET['err'])){
                echo '<p style="color: red;">',$_GET['err'],'</p>';
              }
              if(isset($_GET['success'])){
                echo '<p style="color: green;">',$_GET['success'],'</p>';
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
    </div>
    <div class="col-md-6 login-splash"></div>

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <!-- JS -->
    <!-- <script src="../js/register.js"></script> -->
  </body>
</html>


