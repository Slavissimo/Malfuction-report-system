<?php
require 'https://ticketsystemspseke.sk/web/config/config.php';

if(isset($_POST['update'])){
    $status = $_POST['reportStatus'];
    $id = $_GET['id'];
    if($status == "3" or $status == "4"){
        $date = date('Y-m-d H:i:s');
        $query = "UPDATE reports SET report_status = '$status', date_of_completion = '$date'  WHERE id = $id";
        $result = mysqli_query($conn, $query);
    }
    else{
        $query = "UPDATE reports SET report_status = $status  WHERE id = $id";
        $result = mysqli_query($conn, $query);
    }
    header("Location: https://ticketsystemspseke.sk/web/frontend/classrooms.php");
}
if(isset($_POST['notesubmit'])){
    $note = $_POST['notes'];
    $classRoom = $_POST['classRoom'];
    $queue = "UPDATE classrooms SET note='$note' WHERE number=$classRoom";
    $result = mysqli_query($conn, $queue);
    header("Location: https://ticketsystemspseke.sk/web/frontend/classrooms.php");
}
?>