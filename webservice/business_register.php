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
$busName = $_POST['busName'];
$regNum = $_POST['regNum'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

$dateJoined = date('Y-m-d H:i:s');

$affected = 0;

$message = "received";

$statement = $conn->prepare("INSERT INTO business (reg_num, holder_name, business_name, phone, date_joined, email, password) VALUES (?,?,?,?,?,?,?)");


$statement->bind_param("sssssss", $regNumPrep, $holderNamePrep, $busNamePrep, $phonePrep, $dateJoinedPrep, $emailPrep, $passwordPrep);

$regNumPrep = $regNum;
$holderNamePrep = $holderName;
$busNamePrep = $busName;
$phonePrep = $phone;
$dateJoinedPrep = $dateJoined;
$emailPrep = $email;
$passwordPrep = $password;

$statement->execute();


//this is the number of rows affected
//and if its none its 0
//and if its an error its -1

$affected = $statement->affected_rows;


$resp["message"] = "completed with ".$affected;


echo json_encode($resp);



?>

