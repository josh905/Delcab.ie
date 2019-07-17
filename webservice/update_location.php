<?php

include_once 'header.php';

$resp["message"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}

$package_id = $_POST['package_id'];
$taxi_lat = $_POST['taxi_lat'];
$taxi_lon = $_POST['taxi_lon'];
$time_taxi_updated = date('Y-m-d H:i:s');

$affected = 0;

$resp["message"] = "received";

$statement = $conn->prepare("UPDATE package SET taxi_lat=?, taxi_lon=?, time_taxi_updated=? WHERE package_id=?");


$statement->bind_param("ssss", $taxi_lat_prep, $taxi_lon_prep, $time_taxi_updated_prep, $package_id_prep);

$taxi_lat_prep = $taxi_lat;
$taxi_lon_prep = $taxi_lon;
$time_taxi_updated_prep = $time_taxi_updated;
$package_id_prep = $package_id;

$statement->execute();


//this is the number of rows affected
//and if its none its 0
//and if its an error its -1

$affected = $statement->affected_rows;



$resp["message"] = "completed with ".$affected;


echo json_encode($resp);



?>
