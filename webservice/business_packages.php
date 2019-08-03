<?php

include_once 'header.php';

$resp["message"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}


$resp["message"] = "received";

$businessId = $_POST["businessId"];

$statement = $conn->prepare("SELECT * FROM package WHERE business_id=? AND time_delivered IS NULL AND time_accepted IS NULL");

$statement->bind_param("s", $businessIdPrep);

$businessIdPrep = $businessId;

$statement->execute();

$result = $statement->get_result();


$rowCount = mysqli_num_rows($result);

$resp["message"] = "details of packages: g3k7b3";

if($rowCount>0){
  while($row = $result->fetch_assoc()){
    $resp["message"].=$row["start_lat"]."j7v4x1".$row["start_lon"]."j7v4x1"
  	.$row["start_ad"]."j7v4x1".$row["end_ad"]."g3k7b3";
  }
  $resp["message"].="n9h3k8";
}


/*
SELECT p.start_lat, p.start_lon, p.start_ad, p.end_ad, t.lat, t.lon
FROM package AS p INNER JOIN taxi AS t ON p.taxi_id=t.taxi_id
WHERE p.business_id=45 AND p.time_delivered IS NULL AND p.time_accepted IS NOT NULL
*/

$statement = $conn->prepare("SELECT p.start_lat, p.start_lon, p.start_ad, p.end_ad, t.lat, t.lon
FROM package AS p INNER JOIN taxi AS t ON p.taxi_id=t.taxi_id
WHERE p.business_id=? AND p.time_delivered IS NULL AND p.time_accepted IS NOT NULL");

$statement->bind_param("s", $businessIdPrep);

$businessIdPrep = $businessId;

$statement->execute();

$result = $statement->get_result();


$rowCount = mysqli_num_rows($result);

if($rowCount>0){
  while($row = $result->fetch_assoc()){
    $resp["message"].=$row["start_lat"]."j7v4x1".$row["start_lon"]."j7v4x1"
  	.$row["start_ad"]."j7v4x1".$row["end_ad"].
    "j7v4x1".$row["lat"]."j7v4x1".$row["lon"]."g3k7b3";
  }
}


echo json_encode($resp);
