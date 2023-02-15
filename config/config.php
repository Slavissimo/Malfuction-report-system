<?php

$host = "dbadmin.ticketsystemspseke.sk"; 
$user = ""; 
$password = ""; 
$db = "ticketsystem"; 

$conn = mysqli_connect($host, $user, $password, $db);

if($conn ->connect_error) {
   die("Connection error, try again!");
}

?> 
