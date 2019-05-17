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
$taxiNum = (string) $_POST['taxiNum'];


$usernameCount = 0;
$taxiNumCount = 0;


$resp["message"] = "received";

$statement = $conn->prepare("SELECT * FROM business WHERE username=?");


$statement->bind_param("s", $usernamePrep);

$usernamePrep = $username;

$statement->execute();

$result = $statement->get_result();

$usernameCount += mysqli_num_rows($result);




$statement = $conn->prepare("SELECT * FROM taxi WHERE username=?");


$statement->bind_param("s", $usernamePrep);

$usernamePrep = $username;

$statement->execute();

$result = $statement->get_result();

$usernameCount += mysqli_num_rows($result);

if($usernameCount>0){
	$resp["message"] = "username taken";
	echo json_encode($resp);
	exit();
}



$statement = $conn->prepare("SELECT * FROM taxi WHERE taxi_number=?");


$statement->bind_param("s", $taxiNumPrep);

$taxiNumPrep = $taxiNum;

$statement->execute();

$result = $statement->get_result();

$taxiNumCount += mysqli_num_rows($result);

if($taxiNumCount>0){
	$resp["message"] = "taxi num taken";
	echo json_encode($resp);
	exit();
}



//taxi number api mockable

#address is https://demo3947758.mockable.io/registered_taxi_numbers

$handle = curl_init();

$taxiURL = "https://demo3947758.mockable.io/registered_taxi_numbers";

// Set the url
curl_setopt($handle, CURLOPT_URL, $taxiURL);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($handle);

curl_close($handle);


$registeredNums = (string) $output;

if(strpos($registeredNums,$taxiNum)){
	$resp["message"] = "complete";
}
else{
	$resp["message"] = "not taxi num";
}

echo json_encode($resp);
