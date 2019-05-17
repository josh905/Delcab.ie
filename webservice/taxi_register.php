<?php

include_once 'header.php';

$resp["message"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}

$driverName = $_POST['driverName'];
$taxiNum = $_POST['taxiNum'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];

$dateJoined = date('Y-m-d H:i:s');

$affected = 0;

$message = "received";

$statement = $conn->prepare("INSERT INTO taxi (driver_name, username, password, taxi_number, phone, date_joined) VALUES (?,?,?,?,?,?)");


$statement->bind_param("ssssss", $driverNamePrep, $usernamePrep, $passwordPrep, $taxiNumPrep, $phonePrep, $dateJoinedPrep);

$driverNamePrep = $driverName;
$usernamePrep = $username;
$passwordPrep = $password;
$taxiNumPrep = $taxiNum;
$phonePrep = $phone;
$dateJoinedPrep = $dateJoined;

$statement->execute();


//this is the number of rows affected
//and if its none its 0
//and if its an error its -1

$affected = $statement->affected_rows;



$resp["message"] = "completed with ".$affected;


echo json_encode($resp);



?>
