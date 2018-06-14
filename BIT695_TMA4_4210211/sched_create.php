<!DOCTYPE html>
<html lang="en-GB">
<body>
    
<?php

//Validation function

function filterAlphanumeric($field){
    // Sanitize schedule venue 
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate schedule venue
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9a-zA-Z\s]+$/")))){
        return $field;
    }else{
        return FALSE;
    }
} 

function filterDate($field){	
    // Validate scheduledate
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d{4}-((0[1-9])|(1[012]))-((0[1-9]|[12]\d)|3[01])$/")))){
        return $field;
    }else{
        return FALSE;
    }
}


// create a variable
$scheduleid = $_POST["scheduleid"];
$scheduledate=$_POST["scheduledate"];
$schedulevenue=$_POST["schedulevenue"];

$withError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate schedule date
    if(empty($scheduledate)){
        $scheduledateErr = 'Please enter a schedule date.';
		$withError = true;
    }else{
        if(filterDate($scheduledate)== FALSE){
            $scheduledateErr = 'Please enter a valid schedule date.';
			$withError = true;
        }
    }

    // Validate schedule venue
    if(empty($schedulevenue)){
        $schedulevenueErr = 'Please enter a schedule venue.';
		$withError = true;
    }else{
        if(filterAlphanumeric($schedulevenue)== FALSE){
            $schedulevenueErr = 'Please enter a valid schedule venue.';
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
		$sql = "INSERT INTO schedule(scheduleid, scheduleDate, scheduleVenue) VALUES('$scheduleid','$scheduledate', '$schedulevenue')";
		
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
			<em>Schedule ID:</em>
			<span><?php echo $scheduleid; ?></span>
			<span style="margin-left: 10px; color: red;"></span>
		</li>
        <li>
			<em>Schedule Date:</em>
			<span><?php echo $scheduledate; ?></span>
			<span style="margin-left: 10px; color: red;"><?php echo $scheduledateErr; ?></span>
		</li>
		<li>
			<em>Schedule Venue:</em>
			<span><?php echo $schedulevenue; ?></span>
			<span style="margin-left: 10px; color: red;"><?php echo $schedulevenueErr; ?></span>
		</li>
</ol>

<?php

$connect->close();

?>
</body>
</html>