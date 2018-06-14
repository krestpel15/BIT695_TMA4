<!DOCTYPE html>
<html lang="en-GB">
<head>
    <title>Join the Game</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
// Create connection
$conn = new mysqli("localhost", "root", "root", "tma4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Join a member to a selected game, add a venue and date by using id seen from retrieved tables
if(isset($_GET['join'])){
	$boardgameid = $_GET['join'];
	
$record = mysqli_query($conn, "SELECT * FROM boardgames WHERE boardgameid='$boardgameid'");
		while($row = mysqli_fetch_array($record)){
			$boardgameid = $row['boardgameid'];
			$boardgamename = $row['boardGameName'];
		}
}

?>

<form id="Games" method="post">

			<fieldset class="field-set">
				<legend>Game Details</legend>

				<div class="field-group">
				<!-- Boardgame ID should not be empty and should be Alphanumeric -->
				<label for="boardgameid">Boardgame ID:</label>
				<input type="hidden" name="boardgameid" id="boardgameid" value="<?php echo $boardgameid?>">
				</div>

				<div class="field-group">
				<!-- Boardgame name should not be empty and should be a string not a number -->
				<label for="boardgamename">Boardgame Name:</label> 
				<input type="text" name="boardgamename" id="boardgamename" value="<?php echo $boardgamename?>">
				</div>

				<div class="field-group">
				<!-- Member ID should not be empty and should be a string not a number -->
				<label for="memberid">Member ID:</label>
				<input type="text" name="memberid" id="memberid" placeholder="Enter your Member ID">
				</div>
				
				<div class="field-group">
				<!-- Schedule ID should not be empty and should be Alphanumeric -->
				<label for="scheduleid">Schedule ID:</label>
				<input type="text" name="scheduleid" id="scheduleid" placeholder="Enter Preferred Schedule">
				</div>


			</fieldset>
			
			<br>
			<br>
			
			<button class="btn" type="submit" name="join" >JOIN</button>
</form>

<?php
if(isset($_POST['join'])){
	$boardgameid = $_POST["boardgameid"];
	$memberid = $_POST["memberid"];
	$scheduleid = $_POST["scheduleid"];
	
	$result = mysqli_query($conn, "INSERT INTO temp_boardgames(memberid, boardgameid, scheduleid) VALUES ('$memberid', '$boardgameid', '$scheduleid')");
	
	header('location: http://localhost/BIT695/tma4_retrieve.php');
}

$conn->close();
?>
</body>
</html>