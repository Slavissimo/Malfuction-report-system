<?php

$host = ""; 
$user = ""; 
$password = ""; 
$db = ""; 

$conn = mysqli_connect($host, $user, $password, $db);

if($conn ->connect_error) {
   die("Connection error, try again!");
}

?> 
