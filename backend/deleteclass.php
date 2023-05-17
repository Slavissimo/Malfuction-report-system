<?php 

require 'config/config.php';
require 'loggedinstatus.php';
require 'loginconfirm.php';

$id = $_GET['id'];

$query = "DELETE FROM classrooms WHERE id = $id";
$result = mysqli_query($conn, $query); 

if($result){
    $_SESSION['messageSuccess'] = "Classroom has been deleted";
    header("Location: ../admin_classrooms.php");
    exit(0);
}
else{
    $_SESSION['messageDanger'] = "Classroom has not been deleted";
    header("Location: ../admin_classrooms.php");
    exit(0);
}
?>