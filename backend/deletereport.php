<?php 
session_start();
require 'config/config.php';

$id = $_GET['id'];

$query = "DELETE FROM reports WHERE id = $id";
$result = mysqli_query($conn, $query); 

if($result){
    $_SESSION['messageSuccess'] = "Report has been deleted";
    header("Location: ../admin_reports.php");
    exit(0);
}
else{
    $_SESSION['messageDanger'] = "Report has not been deleted";
    header("Location: ../admin_reports.php");
    exit(0);
}
?>