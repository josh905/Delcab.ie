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
$taxi_id = $_POST['taxi_id'];
$driver_name = $_POST['driver_name'];
$taxi_num = $_POST['taxi_num'];
$time_accepted = date('Y-m-d H:i:s');


$resp["message"] = "received";

$statement = $conn->prepare("UPDATE package SET taxi_id=?, driver_name=?, taxi_num=?, time_accepted=? WHERE package_id=?");

$statement->bind_param("sssss", $taxi_id_prep, $driver_name_prep, $taxi_num_prep, $time_accepted_prep, $package_id_prep);

$taxi_id_prep = $taxi_id;
$driver_name_prep = $driver_name;
$taxi_num_prep = $taxi_num;
$time_accepted_prep = $time_accepted;
$package_id_prep = $package_id;

$statement->execute();

$affected = $statement->affected_rows;

if($affected < 1){
	$resp["message"] = "could not assign driver";
}
else{
  $resp["message"] = "driver assigned";
}



echo json_encode($resp);
