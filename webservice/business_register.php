<?php

include_once 'header.php';

$resp["message"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}

$holderName = $_POST['holderName'];
$regNum = $_POST['regNum'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];
$busName = $_POST['busName'];
$busRegDate = $_POST['busRegDate'];


$dateJoined = date('Y-m-d H:i:s');

$affected = 0;

$message = "received";

$statement = $conn->prepare("INSERT INTO business (reg_num, holder_name, business_name, date_registered, phone, date_joined, username, password) VALUES (?,?,?,?,?,?,?,?)");


$statement->bind_param("ssssssss", $regNumPrep, $holderNamePrep, $busNamePrep, $dateRegisteredPrep, $phonePrep, $dateJoinedPrep, $usernamePrep, $passwordPrep);

$regNumPrep = $regNum;
$holderNamePrep = $holderName;
$busNamePrep = $busName;
$dateRegisteredPrep = $busRegDate;
$phonePrep = $phone;
$dateJoinedPrep = $dateJoined;
$usernamePrep = $username;
$passwordPrep = $password;

$statement->execute();


//this is the number of rows affected
//and if its none its 0
//and if its an error its -1

$affected = $statement->affected_rows;



$resp["message"] = "completed with ".$affected;


echo json_encode($resp);



?>
