<?php

include_once 'header.php';

$resp["message"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}

$taxiNum = $_POST['taxiNum'];
$password = $_POST['password'];

$statement = $conn->prepare("UPDATE taxi SET password=? WHERE taxi_num=?");


$statement->bind_param("ss", $passwordPrep, $taxiNumPrep);

$passwordPrep = $password;
$taxiNumPrep = $taxiNum;

$statement->execute();


//this is the number of rows affected
//and if its none its 0
//and if its an error its -1

$affected = $statement->affected_rows;


$resp["message"] = "completed with ".$affected;


echo json_encode($resp);
