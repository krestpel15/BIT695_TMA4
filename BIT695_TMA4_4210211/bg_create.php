<!DOCTYPE html>
<html lang="en-GB">
<body>
    
<?php

// Validation functions.

function filterName($field){
    // Sanitize boardgame name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
	
    // Validate boardgame name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return $field;
    }else{
        return FALSE;
    }
}

// create a variable
$boardgameid = $_POST["boardgameid"];
$boardgamename=$_POST["boardgamename"];

$withError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate boardgame name
    if(empty($boardgamename)){
        $boardgamenameErr = 'Please enter a boardgame name.';
		$withError = true;
    }else{
        if(filterName($boardgamename)== FALSE){
            $boardgamenameErr = 'Please enter a valid boardgame name.';
			$withError = true;
        }
    }
}

// Connect and save to database and insert validated data.
if($withError == false){
	$connect= new mysqli('localhost','root','root', 'tma4');

	if($connect->connect_error) {
		echo 'Failed to connect';
	} else {
		$sql = "INSERT INTO boardgames(boardgameid, boardgamename) VALUES('$boardgameid','$boardgamename')";
		
		if($connect->query($sql) === true){
			echo 'Record inserted to db';
		} else {
			echo 'Error '.$sql.'<br>'.$connect->error;
		}
	}
}
?>

<h1>Here is the information you have submitted:</h1>
    
 <ol>
		<li>
			<em>Boardgame ID:</em>
			<span><?php echo $boardgameid; ?></span>
			<span style="margin-left: 10px; color: red;"></span>
		</li>
        <li>
			<em>Boardgame Name:</em>
			<span><?php echo $boardgamename; ?></span>
			<span style="margin-left: 10px; color: red;"><?php echo $boardgamenameErr; ?></span>
		</li>
</ol>


<?php

$connect->close();

?>
</body>
</html>