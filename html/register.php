
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
    <link rel="stylesheet" href="../css/login.css" />
    <title>Register Page</title>
  </head>
  <body>
    <div class="login-box">
    <fieldset>
      <legend>Pregnancy Register </legend>
      <form name="frmContact" method="post" action="loginAction.php">
        <!-- 
          user
pass
email
phone number
birthdate
add more info (from my info) or add later

         -->
            <p>
                <label for="username">Username </label>
                <input type="text" name="inputUserName" id="inputUserName" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="inputPassword" id="inputPassword" required>
            </p>
            <p>
              <label class="radio-inline">
                  <input type="radio" name="loginType" required value="admin" checked> Administrator
              </label>
              <label class="radio-inline">
                  <input type="radio" name="loginType" required value="doctor"> Doctor
              </label>
              <label class="radio-inline">
                  <input type="radio" name="loginType" required value="patient"> Patient
              </label>
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
              <label for="insurance">Insurance</label>
            </p>
            <p>
                <a href="login.php">Back to Login</a>
                <input type="submit" name="Submit" id="Submit" value="Submit">
            </p>
        </form>
      </fieldset>
    </div>
  
    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <!-- JS -->
    <script src="../js/register.js"></script>
  </body>
</html>


