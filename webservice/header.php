<?php

include_once '../../dbcon.php';

//set date

//any other things to be done for all files.

$conn->query("SET NAMES 'utf8'");


session_start();

$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

date_default_timezone_set('Europe/Dublin');
