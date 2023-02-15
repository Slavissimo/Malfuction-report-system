<?php
require 'https://ticketsystemspseke.sk/web/config/config.php';
require 'https://ticketsystemspseke.sk/web/backend/loginconfirm.php';

if(!isset($_SESSION['userid'])){
    header("Location: https://ticketsystemspseke.sk/web/frontend/index.php");
}


?>