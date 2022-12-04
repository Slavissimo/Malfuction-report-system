<?php

$host = "localhost"; 
$user = "root"; 
$password = ""; 
$db = "ticket_system"; 

$conn = mysqli_connect($host, $user, $password, $db);

if($conn ->connect_error) {
   die("Connection error, try again!");
}

?> 
