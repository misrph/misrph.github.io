<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "all_requests";

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}