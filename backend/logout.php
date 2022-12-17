<?php
require '../config/config.php';

session_unset();
session_destroy();
header("Location: ../frontend/login.php");


?>