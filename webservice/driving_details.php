<?php

include_once 'header.php';


$resp["message"] = "partial";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}

$drivingurl = $_POST['drivingurl'];

$ch = curl_init();



curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FAILONERROR,1);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_URL, $drivingurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 0);


$response = curl_exec($ch);



curl_close($ch);

/*
$results_array = json_decode($response);


//List of fields available: https://services.cro.ie/datadict.aspx
foreach($results_array as $Object){
    $resp["distance"] = $Object->distance;
    $resp["duration"] = $Object->duration;
}*/

echo $response;
