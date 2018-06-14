<!DOCTYPE html>
<html lang="en-GB">
<head>
<title>Edit Boardgame</title>
</head>

<body>
<?php

// Create connection
$conn = new mysqli("localhost", "root", "root", "tma4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//Edits the boardgames Table
if(isset($_GET['edit'])){
	$boardgameid = $_GET['edit'];
	
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
			<button class="btn" type="submit" name="update" >UPDATE</button>
</form>
			
<?php


if(isset($_POST['update'])){
	$boardgameid = $_POST["boardgameid"];
	$boardgamename=$_POST["boardgamename"];
	
	$result = mysqli_query($conn, "UPDATE boardgames SET boardgamename='$boardgamename' WHERE boardgames.boardgameid = '$boardgameid'");
	
	header('location: http://localhost/BIT695/tma4_retrieve.php');
}


//Edits the Schedule Table
if(isset($_GET['edit1'])){
	$scheduleid = $_GET['edit1'];
	
$record = mysqli_query($conn, "SELECT * FROM schedule WHERE scheduleid = '$scheduleid'");
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
			<button class="btn" type="submit" name="update" >UPDATE</button>
</form>
			
<?php


if(isset($_POST['update'])){
	$scheduleid = $_POST["scheduleid"];
	$scheduledate=$_POST["scheduledate"];
	$schedulevenue=$_POST["schedulevenue"];
	
	$result = mysqli_query($conn, "UPDATE schedule SET scheduleDate='$scheduledate', scheduleVenue='$schedulevenue' WHERE schedule.scheduleid = '$scheduleid'");
	
	header('location: http://localhost/BIT695/tma4_retrieve.php');
}


//Edits the scoring Table
if(isset($_GET['edit2'])){
	$scoringid = $_GET['edit2'];
	
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
			<button class="btn" type="submit" name="update" >UPDATE</button>
</form>
			
<?php


if(isset($_POST['update'])){
	$scoringid = $_POST["scoringid"];
	$memberid = $_POST["memberid"];
	$score = $_POST["score"];
	
	$result = mysqli_query($conn, "UPDATE scoring SET memberid='$memberid', score='$score' WHERE scoring.scoringid = '$scoringid'");
	
	header('location: http://localhost/BIT695/tma4_retrieve.php');
}

$conn->close();
?>
</body>
</html>
