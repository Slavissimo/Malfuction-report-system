<?php
require '../backend/loggedinstatus.php';
require '../config/config.php';

if($_SESSION['userid'] != '1'){
    header("Location: ./classrooms.php");
}


?>