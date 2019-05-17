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


$rowCount = 0;


$resp["message"] = "received";

$statement = $conn->prepare("SELECT * FROM business WHERE username=?");


$statement->bind_param("s", $usernamePrep);

$usernamePrep = $username;

$statement->execute();

$result = $statement->get_result();

$rowCount += mysqli_num_rows($result);





$statement = $conn->prepare("SELECT * FROM taxi WHERE username=?");


$statement->bind_param("s", $usernamePrep);

$usernamePrep = $username;

$statement->execute();

$result = $statement->get_result();

$rowCount += mysqli_num_rows($result);



$resp["message"] = $rowCount;


echo json_encode($resp);
