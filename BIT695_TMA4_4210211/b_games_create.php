<!DOCTYPE html>
<html lang="en-GB">
<head>
<title>Edit Board_games</title>
</head>

<body>

<?php

// Create connection
$conn = new mysqli("localhost", "root", "root", "tma4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// SQL query to Display Details of temp_boardgames
	$results = mysqli_query($conn, "SELECT * FROM temp_boardgames");
// SQL query to Display Details of highest scoringid
	$results2 = mysqli_query($conn, "SELECT * FROM scoring WHERE scoringid=(SELECT max(scoringid) FROM scoring)");


?>

<p> Temp_Boardgames Table </p>
<br>

<table style="width: 50%; height: 50px;" border="1">

	<thead>
		<tr>
			<th>Member ID</th>
			<th>Boardgame ID</th>
			<th>Schedule ID</th>
		</tr>
	</thead>

<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['memberid']; ?></td>
			<td><?php echo $row['boardgameid']; ?></td>
			<td><?php echo $row['scheduleid']; ?></td>
		</tr>
	<?php } ?>
</table>


<br>
<p> Last Score inserted </p>
<br>

<table style="width: 50%; height: 50px;" border="1">

	<thead>
		<tr>
			<th>Scoring ID</th>
			<th>Member ID</th>
			<th>Score</th>
		</tr>
	</thead>

<?php while ($row = mysqli_fetch_array($results2)) { ?>
		<tr>
			<td><?php echo $row['scoringid']; ?></td>
			<td><?php echo $row['memberid']; ?></td>
			<td><?php echo $row['score']; ?></td>
		</tr>
	<?php } ?>
</table>

<br>
<br>
<form name="Insert" method="POST">
	<button class="btn" type="submit" name="insert" >INSERT TO board_games Table</button>
</form>

<?php

//Insert from temp_boardgames to board_games adding a scoringid then truncating to empty temporay table
if(isset($_POST['insert'])){
	$memberid = $_POST['memberid']; 
    $boardgameid =$_POST['boardgameid'];
	$scheduleid = $_POST['scheduleid'];
	$scoringid = $_POST['scoringid'];
	
	
	$result = mysqli_query($conn, "INSERT INTO board_games (memberid, boardgameid, scheduleid, scoringid) 
							SELECT temp_boardgames.memberid, temp_boardgames.boardgameid, temp_boardgames.scheduleid, scoring.scoringid 
							FROM temp_boardgames, scoring 
							WHERE temp_boardgames.memberid = scoring.memberid AND scoringid=(SELECT max(scoringid) FROM scoring)");


	$result2 = mysqli_query($conn, "TRUNCATE TABLE temp_boardgames");

	
	header('location: http://localhost/BIT695/tma4_retrieve.php');
}

$conn->close();
?>
</body>
</html>