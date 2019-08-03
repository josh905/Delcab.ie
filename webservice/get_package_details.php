<?php

include_once 'header.php';

$resp["message"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}

$taxi_id = $_POST["taxi_id"];

$resp["message"] = "received";

$statement = $conn->prepare("SELECT * FROM package WHERE taxi_id =? AND time_delivered IS NULL");

$statement->bind_param("s", $taxi_id_prep);

$taxi_id_prep = $taxi_id;

$statement->execute();

$result = $statement->get_result();

/*
$rowCount = mysqli_num_rows($result);

if($rowCount<1){
	$resp["message"] = "no packages";
	echo json_encode($resp);
	exit();
}
*/

//$resp["business_name"] = "error = no_name_business.";



while($row = $result->fetch_assoc()){
  $resp["message"] = "package found";
  $resp["package_id"] = $row["package_id"];
  $resp["business_id"] = $row["business_id"];
  $resp["business_name"] = $row["business_name"];
  $resp["start_ad"] = $row["start_ad"];
  $resp["end_ad"] = $row["end_ad"];
  $resp["driver_pay"] = $row["driver_pay"];
  $resp["start_lat"] = $row["start_lat"];
  $resp["start_lon"] = $row["start_lon"];
  $resp["end_lat"] = $row["end_lat"];
  $resp["end_lon"] = $row["end_lon"];
}


echo json_encode($resp);
