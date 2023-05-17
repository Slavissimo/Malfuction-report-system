<?php 
session_start();
require 'config/config.php';

$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = $id";
$result = mysqli_query($conn, $query); 

if($result){
    $_SESSION['messageSuccess'] = "User has been deleted";
    header("Location: ../admin_users.php");
    exit(0);
}
else{
    $_SESSION['messageDanger'] = "User has not been deleted";
    header("Location: ../admin_users.php");
    exit(0);
}
?>