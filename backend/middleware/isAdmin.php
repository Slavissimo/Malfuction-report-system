<?php
session_start();

if($_SESSION['userid'] != 1){
    header("Location: ../classrooms.php");
}


?>