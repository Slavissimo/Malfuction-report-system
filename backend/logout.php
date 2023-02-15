<?php
session_start();
require 'https://ticketsystemspseke.sk/web/config/config.php';


unset($_SESSION['userid']);

header("Location: https://ticketsystemspseke.sk/web/frontend/index.php");




?>