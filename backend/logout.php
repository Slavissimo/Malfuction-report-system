<?php
session_start();
require '../config/config.php';


unset($_SESSION['userid']);

header("Location: ../frontend/login.php");




?>