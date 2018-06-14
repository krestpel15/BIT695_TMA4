<!DOCTYPE html>
<html lang="en-GB">
<head>
<title>Delete Data from Tables</title>
</head>

<body>
<?php


// Create connection
$conn = new mysqli("localhost", "root", "root", "tma4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Deletes a Row from boardgames table
if(isset($_GET['delete'])){
	$boardgameid = $_GET['delete'];

// SQL query to Display Details.
$record = mysqli_query($conn, "SELECT * FROM boardgames WHERE boardgameid='$boardgameid'");
		while($row = mysqli_fetch_array($record)){
			$boardgameid = $row['boardgameid'];
			$boardgamename = $row['boardGameName'];
		}
}
?>

<form id="Boardgame" method="post">

			<fieldset class="field-set">
				<legend>Boardgame Details</legend>

				<div class="field-group">
				<!-- Boardgame ID should not be empty and should be Alphanumeric -->
				<label for="boardgameid">Boardgame ID:</label>
				<input type="hidden" name="boardgameid" id="boardgameid" value="<?php echo $boardgameid?>">
				</div>

				<div class="field-group">
				<!-- Boardgame name should not be empty and should be a string not a number -->
				<label for="boardgamename">Boardgame name:</label> 
				<input type="text" name="boardgamename" id="boardgamename" value="<?php echo $boardgamename?>">
				</div>

			</fieldset>
	
			<br>
			<br>
			<button class="btn" type="submit" name="del" >DELETE</button>
</form>

<?php
if(isset($_POST['del'])){
	
    $res = mysqli_query($conn, "DELETE FROM boardgames WHERE boardgameid ='$boardgameid'");
	
	header('location: http://localhost/BIT695/tma4_retrieve.php');
}


//Deletes a row from schedule Table
if(isset($_GET['delete1'])){
	$scheduleid = $_GET['delete1'];

// SQL query to Display Details.
$record = mysqli_query($conn, "SELECT * FROM schedule WHERE scheduleid='$scheduleid'");
		while($row = mysqli_fetch_array($record)){
			$scheduleid = $row['scheduleid'];
			$scheduledate = $row['scheduleDate'];
			$schedulevenue = $row['scheduleVenue'];
		}
}
?>

<br>
<br>
<form id="Schedule" method="post">

			<fieldset class="field-set">
				<legend>Schedule Details</legend>

				<div class="field-group">
				<!-- Schedule ID should not be empty and should be Alphanumeric -->
				<label for="scheduleid">Schedule ID:</label>
				<input type="hidden" name="scheduleid" id="scheduleid" value="<?php echo $scheduleid?>">
				</div>

				<div class="field-group">
				<!-- Schedule Date should not be empty and should be a string not a number -->
				<label for="scheduledate">Schedule date:</label> 
				<input type="text" name="scheduledate" id="scheduledate" value="<?php echo $scheduledate?>">
				</div>
				
				<div class="field-group">
				<!-- Schedule Venue should not be empty and should be a string not a number -->
				<label for="schedulevenue">Schedule venue:</label> 
				<input type="text" name="schedulevenue" id="schedulevenue" value="<?php echo $schedulevenue?>">
				</div>

			</fieldset>
	
			<br>
			<br>
			<button class="btn" type="submit" name="del" >DELETE</button>
</form>

<?php
if(isset($_POST['del'])){
	
    $res = mysqli_query($conn, "DELETE FROM schedule WHERE scheduleid ='$scheduleid'");
	
	header('location: http://localhost/BIT695/tma4_retrieve.php');
}

//Deletes a row from scoring table
if(isset($_GET['delete2'])){
	$scoringid = $_GET['delete2'];
	
$record = mysqli_query($conn, "SELECT * FROM scoring WHERE scoringid='$scoringid'");
		while($row = mysqli_fetch_array($record)){
			$scoringid = $row['scoringid'];
			$memberid = $row['memberid'];
			$score = $row['score'];
		}
}

?>

<form id="Scoring" method="post">

			<fieldset class="field-set">
				<legend>Score Details</legend>

				<div class="field-group">
				<!-- Scoring ID should not be empty and should be Alphanumeric -->
				<label for="scoringid">Scoring ID:</label>
				<input type="hidden" name="scoringid" id="scoringid" value="<?php echo $scoringid?>">
				</div>

				<div class="field-group">
				<!-- Member ID should not be empty and should be a string not a number -->
				<label for="memberid">Member ID:</label> 
				<input type="text" name="memberid" id="memberid" value="<?php echo $memberid?>">
				</div>
				
				<div class="field-group">
				<!-- Score should not be empty and should be a string not a number -->
				<label for="score">Score:</label> 
				<input type="text" name="score" id="score" value="<?php echo $score?>">
				</div>

			</fieldset>
	
			<br>
			<br>
			<button class="btn" type="submit" name="del" >DELETE</button>
</form>
			
<?php


if(isset($_POST['del'])){
	$scoringid = $_POST["scoringid"];
	$memberid = $_POST["memberid"];
	$score = $_POST["score"];
	
	$result = mysqli_query($conn, "DELETE FROM scoring WHERE scoringid ='$scoringid'");
	
	header('location: http://localhost/BIT695/tma4_retrieve.php');
}


$conn->close();
?>
</body>
</html>
