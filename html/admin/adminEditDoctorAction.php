<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CDN -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../../css/adminPortal.css" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ea253243da.js" crossorigin="anonymous"></script>
    <title>Admin Portal</title>
  </head>
  <body>
    <div class="body">
      <header>
        <nav
          class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill"
        >
          <div class="container-fluid">
            <a class="navbar-brand mb-0 h1" href="adminPortal.php">Admin Portal</a>
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
              
              <!-- <button type="button" class="btn btn-light" id="logoutBtn">
                Logout
              </button> -->
              <a href="../logout.php">Logout</a>
            </div>
          </div>
        </nav>
      </header>
      
      

      <section>
        <h3 style = "text-align:center">Successfully Edited</h3>
        <table class="table table-hover" style = "text-align:center">
          <tbody >
          <?php
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $userName = $_POST['username'];
            $password = $_POST['password'];
            $id = $_POST['Key'];
            $conn = new mysqli("localhost", "root", "", "pregnancy");

            $sql = "UPDATE `Doctors` SET `email` = '$email', `password` = '$password', `firstName` = '$firstName', `lastName` = '$lastName', `username` = '$userName' WHERE `Doctors`.`id` = $id";
            $conn->query($sql);
            $sql = "SELECT * FROM Doctors where id = $id ";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) { 
                echo "
                        <table border=1>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>E-mail</th>
                            <th>Username</th>
                            <th>Password</th>
                        </tr> ";
                echo"

                    <tr>
                    <td>" . $row['id']. "</td>" . 
                    "<td>" . $row['firstName'] . "</td>" .
                    "<td>" . $row['lastName']. "</td>" .
                    "<td>" . $row['email']. "</td>" .
                    "<td>" . $row['username']. "</td>" .
                    "<td>" . $row['password']. "</td>" .
                    "</tr>";
            }
            $conn->close(); //Make sure to close out the database connection
            ?>
          </tbody>
        </table>
        <?php
        echo '<form method="POST" action="adminPortal.php">
        <input type="submit" name="submit" value="Back to Admin Portal">  
          </form>';
          ?>
      </section>
      
    </div>

    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="../js/patientInfo.js"></script>
  </body>
</html>

