<?php

include_once 'header.php';

$resp["message"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}

$username = $_POST['username'];

$resp["taxiId"] = 123;
$resp["driverName"] = "none";
$resp["username"] = $username;
$resp["password"] = "none";
$resp["taxiNum"] = 123;
$resp["phone"] = "none";
$resp["dateJoined"] = "none";
$resp["password"] = "none";



$rowCount = 0;


$resp["message"] = "received";

$statement = $conn->prepare("SELECT * FROM taxi WHERE username=?");


$statement->bind_param("s", $usernamePrep);

$usernamePrep = $username;

$statement->execute();

$result = $statement->get_result();

$rowCount = mysqli_num_rows($result);

if($rowCount<1){
	$resp["message"] = "no such taxi driver";
	echo json_encode($resp);
	exit();
}


while($row = $result->fetch_assoc()){
	$resp["taxiId"] = $row["taxi_id"];
	$resp["driverName"] = $row["driver_name"];
	$resp["password"] = $row["password"];
	$resp["taxiNum"] = $row["taxi_num"];
	$resp["phone"] = $row["phone"];
	$resp["password"] = $row["password"];
	$resp["dateJoined"] = $row["date_joined"];
}

$resp["message"] = "row was fetched";



echo json_encode($resp);
