<?php
require '../config/config.php';
require '../backend/loginconfirm.php';

if(!isset($_SESSION['userid'])){
    header("Location: ../frontend/login.php");
}


?>