<!DOCTYPE html>
<html lang="en-GB">
<body>
    
<?php

// Validation functions.

function filterMemberId($field){
    // Sanitize member id 
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate member id
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9a-zA-Z\s]+$/")))){
        return $field;
    }else{
        return FALSE;
    }
} 

function filterScore($field){
    // Sanitize integer
    $field = filter_var(trim($field), FILTER_SANITIZE_NUMBER_INT);
	
    if(filter_var($field, FILTER_VALIDATE_INT)){
        return $field;
    }else{
        return FALSE;
    }
}

// create a variable
$memberid = $_POST["memberid"];
$score=$_POST["score"];

$withError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate member id
    if(empty($memberid)){
        $idErr = 'Please enter your member id.';
		$withError = true;
    }else{
        if(filterMemberId($memberid)== FALSE){
            $idErr = 'Please enter a valid member id.';
			$withError = true;
        }
    }

	
	if(empty($score)){
		$scoreErr = 'Please enter your phone number.';
		$withError = true;
	}else{
		if(filterScore($score) == FALSE){
			$scoreErr = 'Please enter a valid phone number.';
			$withError = true;
		}
	}
}


// Connect and save to database and insert validated data to the table.
if($withError == false){
	$connect= new mysqli('localhost','root','root', 'tma4');

	if($connect->connect_error) {
		echo 'Failed to connect';
	} else {
		$sql = "INSERT INTO scoring(scoringid, memberid, score) VALUES('$scoringid','$memberid', '$score')";
		
		if($connect->query($sql) === true){
			echo 'Record inserted to db';
		} else {
			echo 'Error '.$sql.'<br>'.$connect->error;
		}

	}
}
?>

<h1>Here is the information you have submitted:</h1>
    
 <form id="Scoring" method="post" action="http://localhost/BIT695/b_games_create.php">

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
			<input type="submit" value="UPDATE Boardgames Record" />
</form>

<?php
	


$connect->close();

?>
</body>
</html>