<?php


include_once 'header.php';



$test1 = 43.1;


if( ! ( (strpos($_POST['key1'], $key1)!==false) && (strpos($_POST['key2'], $key2)!==false) ) ){
	$fail["failure"] = "failure";
	$fail["requestFailure"] = "requestFailure";
	echo json_encode($fail);
	exit();
}

$dog = $_POST['dog'];
$cat = $_POST['cat'];
$food = $_POST['food'];

$affected = 0;

$statement = $conn->prepare("INSERT INTO test (test_value) VALUES (?)");


$statement->bind_param("s", $valuePrep);

$valuePrep = $dog + $cat;
$statement->execute();





$resp["dogman"] = $dog . " man";

$resp["catwoman"] = $cat . " woman";

$resp["foodstuff"] = $food . " stuff";

echo json_encode($resp);



?>

