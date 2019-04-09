<?php

include_once 'header.php';


$resp["status"] = "partial";
$resp["affected"] = 0;
$resp["message"] = "none";

//the 2 organisations returned from the CRO API
$resp["org1"] = "none";
$resp["org2"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "invalid keys";
	$resp["status"] = "failed";
	echo json_encode($resp);
	exit();
}

$regNum = $_POST['regNum'];

//check CRO API here

$resp["org1"] = "Linda's Bread bread bread bread bread bread bread bread bread bread bread bread bread bread bread bread bread bread";
$resp["org2"] = "Kevin's Hardware";


$resp["status"] = "complete";
echo json_encode($resp);

