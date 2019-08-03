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

$statement = $conn->prepare("SELECT * FROM package WHERE taxi_id IS NULL AND package_id!=?");

$statement->bind_param("s", $idPrep);

$idPrep = '0';

$statement->execute();

$result = $statement->get_result();


$rowCount = mysqli_num_rows($result);
if($rowCount<1){
	$resp["message"] = "no packages";
	echo json_encode($resp);
	exit();
}


$resp["message"] = "details of packages: g3k7b3";

while($row = $result->fetch_assoc()){
  $resp["message"].=$row["package_id"]."j7v4x1".$row["business_id"]."j7v4x1"
	.$row["business_name"]."j7v4x1".$row["start_lat"]."j7v4x1".$row["start_lon"]
	."j7v4x1".$row["end_lat"]."j7v4x1".$row["end_lon"]."j7v4x1"
	.$row["start_ad"]."j7v4x1".$row["end_ad"]."j7v4x1".$row["driver_pay"]."g3k7b3";
}


echo json_encode($resp);
