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

$resp["businessId"] = 123;
$resp["regNum"] = 123;
$resp["holderName"] = "none";
$resp["businessName"] = "none";
$resp["dateRegistered"] = "none";
$resp["phone"] = "none";
$resp["dateJoined"] = "none";
$resp["username"] = $username;
$resp["password"] = "none";




$rowCount = 0;


$resp["message"] = "received";

$statement = $conn->prepare("SELECT * FROM business WHERE username=?");


$statement->bind_param("s", $usernamePrep);

$usernamePrep = $username;

$statement->execute();

$result = $statement->get_result();

$rowCount = mysqli_num_rows($result);

if($rowCount<1){
	$resp["message"] = "no such business";
	echo json_encode($resp);
	exit();
}


while($row = $result->fetch_assoc()){
	$resp["businessId"] = $row["business_id"];
	$resp["regNum"] = $row["reg_num"];
	$resp["holderName"] = $row["holder_name"];
	$resp["businessName"] = $row["business_name"];
	$resp["dateRegistered"] = $row["date_registered"];
	$resp["phone"] = $row["phone"];
	$resp["dateJoined"] = $row["date_joined"];
	$resp["password"] = $row["password"];
}

$resp["message"] = "row was fetched";



echo json_encode($resp);
