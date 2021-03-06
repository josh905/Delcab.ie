<?php

include_once 'header.php';

$resp["message"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}

$taxi_id = $_POST['taxi_id'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];
$last_location_time = date('Y-m-d H:i:s');

$affected = 0;

$resp["message"] = "received";

$statement = $conn->prepare("UPDATE taxi SET lat=?, lon=?, last_location_time=? WHERE taxi_id=?");


$statement->bind_param("ssss", $lat_prep, $lon_prep, $last_location_time_prep, $taxi_id_prep);

$lat_prep = $lat;
$lon_prep = $lon;
$last_location_time_prep = $last_location_time;
$taxi_id_prep = $taxi_id;

$statement->execute();


//this is the number of rows affected
//and if its none its 0
//and if its an error its -1

$affected = $statement->affected_rows;



$resp["message"] = "completed with ".$affected;


echo json_encode($resp);



?>
