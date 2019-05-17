<?php

include_once 'header.php';


$resp["status"] = "partial";

$resp["busName"] = "none";
$resp["compName"] = "none";
$resp["busRegDate"] = "none";
$resp["compRegDate"] = "none";


//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["message"] = "invalid keys";
	$resp["status"] = "failed";
	echo json_encode($resp);
	exit();
}

$regNum = $_POST['regNum'];



$testdata = array ("company_num"=>$regNum, "company_bus_ind"=>"b", "htmlEnc"=>"1");


// Encode everything that will be sent to query string.
$encoded = '';
foreach($testdata as $name => $value){
    $encoded .= urlencode($name).'='.urlencode($value).'&';
}
// chop off the last ampersand
$encoded = substr($encoded, 0, strlen($encoded)-1);


$ch = curl_init();
$url = "https://services.cro.ie/cws/companies?" . $encoded;

$headers = array( "Authorization: Basic ".base64_encode("joshreynolds749@gmail.com:f60d7bee-08cd-40f3-b2fe-4cb78536622f"),
    "Content-Type: application/json",
    "charset: utf-8");


curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
// curl_setopt($ch, CURLOPT_PROXY, 'http://ip of your proxy:8080');  // Proxy if applicable
curl_setopt($ch, CURLOPT_FAILONERROR,1);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_URL, $url );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 0);

$response = curl_exec($ch);



// Some values from the header if want to take a look...
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$headerOut = curl_getinfo($ch, CURLINFO_HEADER_OUT);


curl_close($ch);

$results_array = json_decode($response);


//List of fields available: https://services.cro.ie/datadict.aspx
foreach($results_array as $Object){
    $resp["busName"] = $Object->company_name;
    $resp["busRegDate"] = $Object->company_reg_date;
}







$testdata = array ("company_num"=>$regNum, "company_bus_ind"=>"c", "htmlEnc"=>"1");


// Encode everything that will be sent to query string.
$encoded = '';
foreach($testdata as $name => $value){
    $encoded .= urlencode($name).'='.urlencode($value).'&';
}
// chop off the last ampersand
$encoded = substr($encoded, 0, strlen($encoded)-1);


$ch = curl_init();
$url = "https://services.cro.ie/cws/companies?" . $encoded;

$headers = array( "Authorization: Basic ".base64_encode("joshreynolds749@gmail.com:f60d7bee-08cd-40f3-b2fe-4cb78536622f"),
    "Content-Type: application/json",
    "charset: utf-8");


curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
// curl_setopt($ch, CURLOPT_PROXY, 'http://ip of your proxy:8080');  // Proxy if applicable
curl_setopt($ch, CURLOPT_FAILONERROR,1);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_URL, $url );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 0);

$response = curl_exec($ch);



// Some values from the header if want to take a look...
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$headerOut = curl_getinfo($ch, CURLINFO_HEADER_OUT);


curl_close($ch);

$results_array = json_decode($response);


//List of fields available: https://services.cro.ie/datadict.aspx
foreach($results_array as $Object){
    $resp["compName"] = $Object->company_name;
    $resp["compRegDate"] = $Object->company_reg_date;
}




$resp["status"] = "complete";


echo json_encode($resp);
