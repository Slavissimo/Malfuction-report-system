<?php
require 'config/config.php';
require 'loginconfirm.php';

if(!isset($_SESSION['userid'])){
    header("Location: ../index.php");
}


?>