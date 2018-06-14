<!DOCTYPE html>
<html lang="en-GB">
<head>
<title>Retrieve Tables</title>
</head>

<body>

<?php

// Create connection
$conn = new mysqli("localhost", "root", "root", "tma4");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//SQL code to retrieve four tables from tma4 database
$results = mysqli_query($conn, "SELECT * FROM boardgames");
$results2 = mysqli_query($conn, "SELECT * FROM schedule");
$results3 = mysqli_query($conn, "SELECT * FROM scoring");
$results4 = mysqli_query($conn, "SELECT familyname, boardGameName, scheduleDate, scheduleVenue, score 
								FROM players, boardgames, schedule, scoring, board_games 
								WHERE players.memberid = board_games.memberid AND boardgames.boardgameid = board_games.boardgameid 
								AND schedule.scheduleid = board_games.scheduleid AND 
								scoring.scoringid = board_games.scoringid AND scoring.memberid = players.memberid");

?>

<p> Boardgames Table </p>
<br>

<table style="width: 50%; height: 50px;" border="1">

	<thead>
		<tr>
			<th>Boardgame Id</th>
			<th>Boardgame Name</th>
			<th colspan="5">Action</th>
		</tr>
	</thead>

<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['boardgameid']; ?></td>
			<td><?php echo $row['boardGameName']; ?></td>
			<td>
				<a href="http://localhost/BIT695/joining.php?join=<?php echo $row['boardgameid']?>">JOIN</a>
			</td>
			<td>
				<a href="http://localhost/BIT695/tma4_edit_bg.php?edit=<?php echo $row['boardgameid']?>">EDIT</a>
			</td>
			<td>
				<a href="http://localhost/BIT695/tma4_delete.php?delete=<?php echo $row['boardgameid']?>">DELETE</a>
			</td>
		</tr>
	<?php } ?>
</table>

<br>
<p> Schedule Table </p>
<br>

<table style="width: 50%; height: 50px;" border="1">

	<thead>
		<tr>
			<th>Schedule Id</th>
			<th>Schedule Date</th>
			<th>Schedule Venue</th>
			<th colspan="5">Action</th>
		</tr>
	</thead>

<?php while ($row = mysqli_fetch_array($results2)) { ?>
		<tr>
			<td><?php echo $row['scheduleid']; ?></td>
			<td><?php echo $row['scheduleDate']; ?></td>
			<td><?php echo $row['scheduleVenue']; ?></td>
			<td>
				<a href="http://localhost/BIT695/tma4_edit_bg.php?edit1=<?php echo $row['scheduleid']?>"> EDIT</a>
			</td>
			<td>
				<a href="http://localhost/BIT695/tma4_delete.php?delete1=<?php echo $row['scheduleid']?>">DELETE</a>
			</td>
		</tr>
	<?php } ?>
</table>

<br>
<p> Scoring Table </p>
<br>

<table style="width: 50%; height: 50px;" border="1">

	<thead>
		<tr>
			<th>Scoring Id</th>
			<th>Member Id</th>
			<th>Score</th>
			<th colspan="5">Action</th>
		</tr>
	</thead>

<?php while ($row = mysqli_fetch_array($results3)) { ?>
		<tr>
			<td><?php echo $row['scoringid']; ?></td>
			<td><?php echo $row['memberid']; ?></td>
			<td><?php echo $row['score']; ?></td>
			<td>
				<a href="http://localhost/BIT695/tma4_edit_bg.php?edit2=<?php echo $row['scoringid']?>"> EDIT</a>
			</td>
			<td>
				<a href="http://localhost/BIT695/tma4_delete.php?delete2=<?php echo $row['scoringid']?>">DELETE</a>
			</td>
		</tr>
	<?php } ?>
</table>

<br>
<p> Board_games Table </p>
<br>

<table style="width: 50%; height: 50px;" border="1">

	<thead>
		<tr>
			<th>Member Name</th>
			<th>Boardgame Name</th>
			<th>Schedule Date</th>
			<th>Schedule Venue</th>
			<th>Score</th>
		</tr>
	</thead>

<?php while ($row = mysqli_fetch_array($results4)) { ?>
		<tr>
			<td><?php echo $row['familyname']; ?></td>
			<td><?php echo $row['boardGameName']; ?></td>
			<td><?php echo $row['scheduleDate']; ?></td>
			<td><?php echo $row['scheduleVenue']; ?></td>
			<td><?php echo $row['score']; ?></td>
		</tr>
	<?php } ?>
</table>

<?php

$conn->close();

?>
</body>
</html>