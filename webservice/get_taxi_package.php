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

$packageId = 0;

$resp["message"] = "received";

$statement = $conn->prepare("SELECT * FROM package WHERE taxi_id=? AND delivered=?");

$statement->bind_param("ss", $taxi_id_prep, $delivered_prep);

$taxi_id_prep = $taxi_id;
$delivered_prep = '0';

$statement->execute();

$result = $statement->get_result();

/*
$rowCount = mysqli_num_rows($result);
if($rowCount<1){
	$resp["message"] = "no such taxi driver";
	echo json_encode($resp);
	exit();
}
*/

while($row = $result->fetch_assoc()){
  $packageId = $row["package_id"];
}

$resp["message"] = "package num is ".$packageId;


echo json_encode($resp);
