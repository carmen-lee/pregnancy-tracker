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
    <title>Doctor Portal</title>
</head>

<body>
    <div class="body">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill">
                <div class="container-fluid">
                    <a class="navbar-brand mb-0 h1" href="doctorPortal.php">Doctor Portal</a>
                    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" href="doctorPortal.php">Home</a>
                            <a class="nav-link" href="doctorAppointments.php">Appointments</a>
                            <a class="nav-link" href="doctorMedications.php">Medications</a>
                        </div>
                        <!-- <button type="button" class="btn btn-light" id="logoutBtn">
                Logout
              </button> -->
                        <button type="button" class="btn btn-light" style="float: right;"><a href="../logout.php">Logout</a></button>
                    </div>
                </div>
            </nav>
        </header>

        <section>
            <div class="card">
                <h2 class="card-title">
                    <?php
                    session_start();
                    //get session variables
                    $sessionUserId = $_SESSION['sessionUserId'];
                    $sessionFirstName = $_SESSION['sessionFirstName'];
                    $sessionLastName = $_SESSION['sessionLastName'];
                    $sessionRole = $_SESSION['sessionRole'];
                    $patientID = $_GET['a'];

                    //check that the user has the role doctor, else logout 
                    if ($sessionRole !== "DOCTOR") {
                        header("Location: ../login.php? err=Please login");
                    }

                    echo "Welcome Dr. ", $sessionFirstName, " ", $sessionLastName;
                    ?>
                </h2>
            </div>
        </section>
        <section>
            <?php

            //establish connection
            $conn = mysqli_connect("localhost", "root", "", "pregnancy");
            //check connection
            if (!$conn) {
                echo 'Connection failed' . mysqli_connect_error();
            }

            $sql = "SELECT first_name, last_name FROM Users WHERE id = '$_GET[a]'";
            $result1 = mysqli_query($conn, $sql);
            $resultsArray = mysqli_fetch_all($result1, MYSQLI_ASSOC);
            echo "<h3> Patient Record for " . $resultsArray[0]['first_name']  . " " . $resultsArray[0]['last_name'] . "</h3>";

            $sql = "SELECT * FROM pregnancies WHERE patientID = '$_GET[a]' AND status = 'CURRENT'";
            $result = mysqli_query($conn, $sql);
            $resultsArray1 = mysqli_fetch_all($result);
            ?>
            <section>
                <?php
                if (sizeof($resultsArray1) == 0) {
                    echo '<h3>Current Pregnancy</h3>';
                    echo '<p>No Current Pregnancies</p>';
                } else {
                    echo '<h3>Current Pregnancy</h3>
                            <table class="table table-hover table-stripped">
                            <thead>';
                    echo ' <thead>
                        <tr>
                            <th>Manage</th>
                            <th>Status</th>
                            <th>Due date</th>
                            <th>Baby Name</th>
                            <th>Baby Health</th>
                            <th>Mom Health</th>
                            </tr>
                        </thead>
                        <tbody>';
                    for ($i = 0; $i < sizeof($resultsArray1); $i++) {
                        echo '<form method="post" action="doctorPregnancyAction.php?a=', $patientID, '&arryInd=', $resultsArray1[$i][0], '">';
                        echo "<tr>";
                        echo "<td style='text-align: center;'><a href='doctorPregnancyDelete.php?a=", $patientID, "&increment=" . $resultsArray1[$i][0] . "'> <i class='fa-solid fa-trash-can'></i></a></td>";
                        echo '<td><select name="inputStatus">
                                    <option value="CURRENT" selected>Current</option>
                                    <option value="PAST">Past</option>
                                </select></td>';
                        echo '<td>
                             <input type="date" name="inputDate" id="inputDate"> <br>Current: ',
                        $resultsArray1[$i][4],
                        '</td>';
                        echo '<td> <input type="text" name="inputBabyName" id="inputBabyName" placeholder ="', $resultsArray1[$i][7], '"></td>';
                        echo '<td> <input type="text" name="inputBabyHealth" id="inputBabyHealth" placeholder ="', $resultsArray1[$i][3], '"></td>';
                        echo '<td> <input type="text" name="inputMomHealth" id="inputMomHealth" placeholder ="', $resultsArray1[$i][2], '"></td>';
                        echo '<td><input type="submit" name="Submit" id="Submit" value="Update Record"></td>';
                        echo "</tr>";

                        echo '</form>';
                    }
                }
                ?>
                </tbody>
                </table>

            </section>
            </form>
            <section>
                <h3>Past Pregnancies</h3>
                <?php
                //establish connection
                $conn = mysqli_connect("localhost", "root", "", "pregnancy");
                //check connection
                if (!$conn) {
                    echo 'Connection failed' . mysqli_connect_error();
                }

                $sql = "SELECT * FROM pregnancies WHERE patientID = '$_GET[a]' AND status = 'PAST'";
                $result = mysqli_query($conn, $sql);
                $resultsArray = mysqli_fetch_all($result);

                ?>
                <table class=" table table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>Manage</th>
                            <th>Status</th>
                            <th>Due date</th>
                            <th>Baby's Name</th>
                            <th>Baby's Health</th>
                            <th>Mom's Health</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < sizeof($resultsArray); $i++) {
                            echo '<form method="post" action="doctorPregnancyAction.php?a=', $patientID, '&arryInd=', $resultsArray[$i][0], '">';
                            echo "<tr>";
                            echo "<td style='text-align: center;'><a href='doctorPregnancyDelete.php?a=", $patientID, "&increment=" . $resultsArray[$i][0] . "'> <i class='fa-solid fa-trash-can'></i></a></td>";
                            echo '<td><select name="inputStatus">
                                    <option value="CURRENT">Current</option>
                                    <option value="PAST" selected>Past</option>
                                </select></td>';
                            echo '<td>
                             <input type="date" name="inputDate" id="inputDate"> <br>Current: ',
                            $resultsArray[$i][4],
                            '</td>';
                            echo '<td> <input type="text" name="inputBabyName" id="inputBabyName" placeholder ="', $resultsArray[$i][7], '"></td>';
                            echo '<td> <input type="text" name="inputBabyHealth" id="inputBabyHealth" placeholder ="', $resultsArray[$i][3], '"></td>';
                            echo '<td> <input type="text" name="inputMomHealth" id="inputMomHealth" placeholder ="', $resultsArray[$i][2], '"></td>';
                            echo '<td><input type="submit" name="Submit" id="Submit" value="Update Record"><td>';
                            echo "</tr>";

                            echo ' </form>';
                        }
                        ?>
                    </tbody>
                </table>

            </section>
            <section>
                <?php
                echo '<h3>Add Pregnancy</h3>
                        <table class="table table-hover table-stripped">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Due date</th>
                                <th>Babys Name</th>
                                <th>Babys Health</th>
                                <th>Moms Health</th>
                            </tr>
                        </thead>
                        <tbody>';
                echo '<form method="post" action="doctorPregnancyAdd.php?a=', $patientID, '">';
                echo "<tr>";

                echo '<td><select name="inputStatus">';
                if (sizeof($resultsArray1) == 0) {
                    echo '<option value="CURRENT" >Current</option>';
                }
                echo '           <option value="PAST" selected>Past</option>
                                </select></td>';
                echo '<td>
                             <input type="date" name="inputDate" id="inputDate"></td>';
                echo '<td> <input type="text" name="inputBabyName" id="inputBabyName" placeholder ="', $resultsArray[$i][7], '"></td>';
                echo '<td> <input type="text" name="inputBabyHealth" id="inputBabyHealth" placeholder ="', $resultsArray[$i][3], '"></td>';
                echo '<td> <input type="text" name="inputMomHealth" id="inputMomHealth" placeholder ="', $resultsArray[$i][2], '"></td>';
                echo '<td><input type="submit" name="Submit" id="Submit" value="Add Record"></td>';
                echo "</tr>";

                echo '</form>';
                ?>
            </section>
        </section>



    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="../js/patientInfo.js"></script>
</body>

</html>