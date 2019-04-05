


<?php


include_once 'header.php';


$resp["status"] = "partial";

//if 1 or more of the security keys are invalid, respond that the request failed
if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$resp["status"] = "failed";
	echo json_encode($resp);
	exit();
}

$name = $_POST['name'];
$regNum = $_POST['regNum'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

$dateJoined = date('Y-m-d H:i:s');

$affected = 0;

$statement = $conn->prepare("INSERT INTO business (reg_num, business_name, phone, date_joined, email, password) VALUES (?,?,?,?,?,?)");


$statement->bind_param("ssssss", $namePrep, $regNumPrep, $phonePrep, $dateJoinedPrep, $emailPrep, $passwordPrep);

$namePrep = $name;
$regNumPrep = $regNum;
$phonePrep = $phone;
$dateJoinedPrep = $dateJoined;
$emailPrep = $email;
$passwordPrep = $password;

$statement->execute();


//this is the number of rows affected
//and if its none its 0
//and if its an error its -1

$affected = $statement->affected_rows;


$resp["affected"] = $affected;

$resp["status"] = "complete";

$resp["password"] = $password;

echo json_encode($resp);



?>

