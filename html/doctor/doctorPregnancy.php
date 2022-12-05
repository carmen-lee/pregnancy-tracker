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
	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400&family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">
	<title>Doctor Portal</title>
</head>

<body>
	<?php
	session_start();
	//get session variables
	$sessionUserId = $_SESSION['sessionUserId'];
	$sessionFirstName = $_SESSION['sessionFirstName'];
	$sessionLastName = $_SESSION['sessionLastName'];
	$sessionRole = $_SESSION['sessionRole'];

<<<<<<< HEAD
	//check that the user has the role doctor, else logout 
	if ($sessionRole !== "DOCTOR") {
	header("Location: ../login.php? err=Please login");
	}
	?>
	<div class="body">
		<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center nav-fill">
			<div class="container-fluid">
			<a class="navbar-brand mb-0 h1" href="doctorPortal.php">Doctor Portal</a>
			<button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav me-auto">
				<a class="nav-link" href="doctorAppointments.php">Appointments</a>
				<a class="nav-link" href="doctorMedications.php">Medications</a>
				</div>
				<?php echo "<div>Dr. ", $sessionFirstName, " ", $sessionLastName, "</div>" ?>
				<button type="button" class="btn btn-light" style="float: right;"><a href="../logout.php">Logout</a></button>
			</div>
			</div>
		</nav>
		</header>
=======
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
>>>>>>> 15f6a67a77b951dd00b63885e492a61a892547fa

		<?php
		//establish connection
		$conn = mysqli_connect("localhost", "root", "", "pregnancy");
		//check connection
		if (!$conn) {
			echo 'Connection failed' . mysqli_connect_error();
		}

<<<<<<< HEAD
		$sql = "SELECT * FROM pregnancies WHERE patientID = '$_GET[a]' AND status = 'CURRENT'";
		$result = mysqli_query($conn, $sql);
		$resultsArray = mysqli_fetch_all($result);
		?>
		<form method="post" action="doctorPregnancyAction.php">
			<section>
				<h3>Current Pregnancy</h3>
				<table class="table table-hover table-stripped">
					<thead>
						<tr>
							<th>Due date</th>
							<th>Baby's Name</th>
							<th>Baby's Health</th>
							<th>Mom's Health</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < sizeof($resultsArray); $i++) {
							echo "<tr>";
							
							echo '<td> <label for="MedicationFrequency">Frequency</label>
							<input type="text" name="inputMedicationFrequency" id="inputMedicationFrequency" >', $resultsArray[$i][4], '</td>';
							echo "<td>", $resultsArray[$i][7], "</td>";
							echo "<td>", $resultsArray[$i][3], "</td>";
							echo "<td>", $resultsArray[$i][2], "</td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</section>

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

=======
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
>>>>>>> 15f6a67a77b951dd00b63885e492a61a892547fa

				?>
				<table class="table table-hover table-stripped">
					<thead>
						<tr>
							<th>Due date</th>
							<th>Baby's Name</th>
							<th>Baby's Health</th>
							<th>Mom's Health</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < sizeof($resultsArray); $i++) {
							echo "<tr>";
							echo "<td>", $resultsArray[$i][4], "</td>";
							echo "<td>", $resultsArray[$i][7], "</td>";
							echo "<td>", $resultsArray[$i][3], "</td>";
							echo "<td>", $resultsArray[$i][2], "</td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</section>
			<input type="submit" name="Submit" id="Submit" value="Update Record">

<<<<<<< HEAD
		</form>

	</div>

	  <!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<!-- JavaScript Bundle with Popper -->
	<script src="../js/patientInfo.js"></script>
=======
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
>>>>>>> 15f6a67a77b951dd00b63885e492a61a892547fa
</body>

</html>