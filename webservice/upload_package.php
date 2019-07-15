<?php

include_once 'header.php';

$resp["message"] = "none";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "api failure";
	echo json_encode($resp);
	exit();
}

$business_id = $_POST['business_id'];
$business_name = $_POST['business_name'];
$start_ad = $_POST['start_ad'];
$end_ad = $_POST['end_ad'];
$start_lat = $_POST['start_lat'];
$start_lon = $_POST['start_lon'];
$cur_lat = $_POST['start_lat'];
$cur_lon = $_POST['start_lon'];
$end_lat = $_POST['end_lat'];
$end_lon = $_POST['end_lon'];
$price = $_POST['price'];
$time_added = date('Y-m-d H:i:s');

$affected = 0;

$resp["message"] = "received";

$statement = $conn->prepare("INSERT INTO package (business_id, business_name, start_ad, end_ad, start_lat, start_lon,
cur_lat, cur_lon, end_lat, end_lon, price, time_added) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");


$statement->bind_param("ssssssssssss", $business_id_prep, $business_name_prep, $start_ad_prep, $end_ad_prep, $start_lat_prep,
$start_lon_prep, $cur_lat_prep, $cur_lon_prep, $end_lat_prep, $end_lon_prep, $price_prep, $time_added_prep);

$business_id_prep = $business_id;
$business_name_prep = $business_name;
$start_ad_prep = $start_ad;
$end_ad_prep = $end_ad;
$start_lat_prep = $start_lat;
$start_lon_prep = $start_lon;
$cur_lat_prep = $cur_lat;
$cur_lon_prep = $cur_lon;
$end_lat_prep = $end_lat;
$end_lon_prep = $end_lon;
$price_prep = $price;
$time_added_prep = $time_added;

$statement->execute();


//this is the number of rows affected
//and if its none its 0
//and if its an error its -1

$affected = $statement->affected_rows;



$resp["message"] = "completed with ".$affected;


echo json_encode($resp);



?>
