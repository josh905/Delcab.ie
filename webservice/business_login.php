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
$password = "";
$verified = 0;

$rowCount = 0;


$resp["message"] = "received";

$statement = $conn->prepare("SELECT * FROM business WHERE username=?");


$statement->bind_param("s", $usernamePrep);

$usernamePrep = $username;

$statement->execute();

$result = $statement->get_result();

$rowCount = mysqli_num_rows($result);

if($rowCount<1){
	$resp["message"] = "no such username";
	echo json_encode($resp);
	exit();
}


while($row = $result->fetch_assoc()){
	$password = $row['password'];
	$verified = $row['verified'];
}

$resp["message"] = "password is ".$password;


echo json_encode($resp);
